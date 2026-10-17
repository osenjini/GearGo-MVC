<?php
require_once __DIR__ . '/../config/Database.php';

/**
 * Item
 * All reads/writes on the `Item` table (spare parts listings), plus the
 * small `adds` relationship table used when an owner lists a new item.
 */
class Item
{
    private mysqli $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    /** Marketplace listing query, with optional search / tab filters. */
    public function search(string $search, string $viewTab, string $role, $userId): mysqli_result|bool
    {
        $where_clauses = [];

        if ($role === 'owner' && $viewTab === 'my_items') {
            $where_clauses[] = "Item.SupplierID = '" . $this->conn->real_escape_string($userId) . "'";
        }

        if ($search !== '') {
            $safeSearch = $this->conn->real_escape_string($search);
            $where_clauses[] = "(Item.Itemname LIKE '%$safeSearch%' OR shopowner.Shopname LIKE '%$safeSearch%')";
        }

        if ($role === 'customer' && $viewTab === 'saved') {
            $where_clauses[] = "Item.Itemid IN (SELECT Itemid FROM saves WHERE CustomerID='" . $this->conn->real_escape_string($userId) . "')";
        } elseif ($role === 'customer' && $viewTab === 'reserved') {
            $where_clauses[] = "Item.Itemid IN (SELECT reserves.Itemid FROM reserves JOIN reservation ON reserves.reservationID = reservation.reservationID WHERE reserves.CustomerID='" . $this->conn->real_escape_string($userId) . "' AND reservation.Status='Reserved')";
        }

        $where_sql = count($where_clauses) > 0 ? "WHERE " . implode(" AND ", $where_clauses) : "";

        $query = "SELECT Item.*, shopowner.Shopname, shopowner.Shopaddress, shopowner.phonenumber, shopowner.SupplierID,
                  (SELECT COUNT(*) FROM review WHERE review.Itemid = Item.Itemid) AS review_count,
                  (SELECT AVG(Rating) FROM review WHERE review.Itemid = Item.Itemid) AS avg_rating
                  FROM Item
                  JOIN shopowner ON Item.SupplierID = shopowner.SupplierID
                  $where_sql
                  ORDER BY Item.Itemid DESC";

        return $this->conn->query($query);
    }

    /** Item + shop owner details for the product-details page. */
    public function findWithShop(int $itemId): ?array
    {
        $stmt = $this->conn->prepare("SELECT Item.*, shopowner.Shopname, shopowner.Shopaddress, shopowner.phonenumber, shopowner.firstname, shopowner.lastname, shopowner.email AS shop_email, shopowner.created_date AS shop_joined
                       FROM Item
                       JOIN shopowner ON Item.SupplierID = shopowner.SupplierID
                       WHERE Item.Itemid = ?");
        $stmt->bind_param("i", $itemId);
        $stmt->execute();
        $res = $stmt->get_result();
        $item = ($res && $res->num_rows > 0) ? $res->fetch_assoc() : null;
        $stmt->close();
        return $item;
    }

    /** Plain item lookup by id, scoped to a supplier (used by owner edit page). */
    public function findForSupplier(int $itemId, $supplierId): ?array
    {
        $stmt = $this->conn->prepare("SELECT * FROM Item WHERE Itemid = ? AND SupplierID = ?");
        $stmt->bind_param("ii", $itemId, $supplierId);
        $stmt->execute();
        $res = $stmt->get_result();
        $item = ($res && $res->num_rows > 0) ? $res->fetch_assoc() : null;
        $stmt->close();
        return $item;
    }

    /** Basic quantity/status lookup used before reserving. */
    public function getStock(int $itemId): ?array
    {
        $res = $this->conn->query("SELECT quantity, availabilitystatus FROM Item WHERE Itemid='" . $this->conn->real_escape_string((string)$itemId) . "'");
        return ($res && $row = $res->fetch_assoc()) ? $row : null;
    }

    /** Small lookup used when confirming a save (chat prompt) and in chat.php. */
    public function getBasicDetails(int $itemId): ?array
    {
        $res = $this->conn->query("SELECT Itemname, Price, quantity, availabilitystatus, image_path FROM Item WHERE Itemid = '" . $this->conn->real_escape_string((string)$itemId) . "'");
        return ($res && $row = $res->fetch_assoc()) ? $row : null;
    }

    /** Item + shop name lookup used to build the "saved" flash prompt. */
    public function getNameAndShop(int $itemId): ?array
    {
        $res = $this->conn->query("SELECT Item.Itemname, Item.SupplierID, shopowner.Shopname FROM Item JOIN shopowner ON Item.SupplierID = shopowner.SupplierID WHERE Item.Itemid = '" . $this->conn->real_escape_string((string)$itemId) . "'");
        return ($res && $row = $res->fetch_assoc()) ? $row : null;
    }

    public function updateStockAfterReserve(int $itemId, int $newQuantity, string $newStatus): bool
    {
        $stmt = $this->conn->prepare("UPDATE Item SET quantity=?, availabilitystatus=? WHERE Itemid=?");
        $stmt->bind_param("isi", $newQuantity, $newStatus, $itemId);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function create(int $supplierId, string $itemName, float $price, int $quantity, string $status, string $imagePath): int|false
    {
        $stmt = $this->conn->prepare("INSERT INTO Item (SupplierID, Itemname, Price, quantity, availabilitystatus, image_path) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isdiss", $supplierId, $itemName, $price, $quantity, $status, $imagePath);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $newId = $stmt->insert_id;
        $stmt->close();

        $this->conn->query("INSERT INTO adds (SupplierID, Itemid) VALUES ('" . $this->conn->real_escape_string((string)$supplierId) . "', '" . $newId . "')");
        return $newId;
    }

    public function update(int $itemId, $supplierId, string $itemName, float $price, int $quantity, string $status, string $imagePath): bool
    {
        $stmt = $this->conn->prepare("UPDATE Item SET Itemname = ?, Price = ?, quantity = ?, availabilitystatus = ?, image_path = ? WHERE Itemid = ? AND SupplierID = ?");
        $stmt->bind_param("sdissii", $itemName, $price, $quantity, $status, $imagePath, $itemId, $supplierId);
        $ok = $stmt->execute();
        if (!$ok) {
            $this->lastError = $this->conn->error;
        }
        $stmt->close();
        return $ok;
    }

    public string $lastError = '';

    public function deleteForSupplier(int $itemId, $supplierId): bool
    {
        $stmt = $this->conn->prepare("DELETE FROM Item WHERE Itemid = ? AND SupplierID = ?");
        $stmt->bind_param("ii", $itemId, $supplierId);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    /** Delete + fetch image path in one step, matching marketplace.php's delete_item action. */
    public function findImageForSupplier(int $itemId, $supplierId): ?array
    {
        $res = $this->conn->query("SELECT Itemid, image_path FROM Item WHERE Itemid='" . (int)$itemId . "' AND SupplierID='" . $this->conn->real_escape_string((string)$supplierId) . "'");
        return ($res && $res->num_rows > 0) ? $res->fetch_assoc() : null;
    }

    public function getError(): string
    {
        return $this->conn->error;
    }
}
