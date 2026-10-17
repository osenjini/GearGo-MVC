<?php
require_once __DIR__ . '/../config/Database.php';

/** SavedItem — the `saves` table (a customer's bookmark list). */
class SavedItem
{
    private mysqli $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function save($customerId, int $itemId): bool
    {
        return (bool)$this->conn->query(
            "INSERT INTO saves (CustomerID, Itemid) VALUES ('" . $this->conn->real_escape_string((string)$customerId) . "', '" . $itemId . "') ON DUPLICATE KEY UPDATE saved_date=NOW()"
        );
    }

    public function unsave($customerId, int $itemId): bool
    {
        return (bool)$this->conn->query(
            "DELETE FROM saves WHERE CustomerID='" . $this->conn->real_escape_string((string)$customerId) . "' AND Itemid='" . $itemId . "'"
        );
    }
}
