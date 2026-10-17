<?php
require_once __DIR__ . '/../config/Database.php';

/** ShopOwner — reads/writes on the `shopowner` table (and its Payment record on signup). */
class ShopOwner
{
    private mysqli $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->conn->prepare("SELECT * FROM shopowner WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = ($res && $res->num_rows === 1) ? $res->fetch_assoc() : null;
        $stmt->close();
        return $row;
    }

    public function findById($supplierId): ?array
    {
        $res = $this->conn->query("SELECT Shopname, Shopaddress, phonenumber FROM shopowner WHERE SupplierID = '" . $this->conn->real_escape_string((string)$supplierId) . "'");
        return ($res && $row = $res->fetch_assoc()) ? $row : null;
    }

    /** Matches register.php's cross-table uniqueness check for owner signups. */
    public function emailExistsAnywhere(string $email): bool
    {
        $stmt = $this->conn->prepare("SELECT email FROM shopowner WHERE email = ? UNION SELECT email FROM customer WHERE email = ?");
        $stmt->bind_param("ss", $email, $email);
        $stmt->execute();
        $exists = $stmt->get_result()->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    public function create(string $firstname, string $lastname, string $shopname, string $phone, string $email, string $shopaddress, string $hashedPassword): int|false
    {
        $stmt = $this->conn->prepare("INSERT INTO shopowner (firstname, lastname, Shopname, phonenumber, email, Shopaddress, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstname, $lastname, $shopname, $phone, $email, $shopaddress, $hashedPassword);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $id = $stmt->insert_id;
        $stmt->close();

        // Record initial monthly subscription fee
        $this->conn->query("INSERT INTO Payment (SupplierID, amount) VALUES ('" . $id . "', 2000.00)");

        return $id;
    }
}
