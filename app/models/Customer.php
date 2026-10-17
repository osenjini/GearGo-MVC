<?php
require_once __DIR__ . '/../config/Database.php';

/** Customer — reads/writes on the `customer` table. */
class Customer
{
    private mysqli $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->conn->prepare("SELECT * FROM customer WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = ($res && $res->num_rows === 1) ? $res->fetch_assoc() : null;
        $stmt->close();
        return $row;
    }

    public function findById($customerId): ?array
    {
        $res = $this->conn->query("SELECT firstname, lastname, phonenumber FROM customer WHERE CustomerID = '" . $this->conn->real_escape_string((string)$customerId) . "'");
        return ($res && $row = $res->fetch_assoc()) ? $row : null;
    }

    /** Matches register.php's cross-table uniqueness check for customer signups. */
    public function emailExistsAnywhere(string $email): bool
    {
        $stmt = $this->conn->prepare("SELECT email FROM customer WHERE email = ? UNION SELECT email FROM shopowner WHERE email = ?");
        $stmt->bind_param("ss", $email, $email);
        $stmt->execute();
        $exists = $stmt->get_result()->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    public function create(string $firstname, string $lastname, string $email, string $phone, string $address, string $hashedPassword): int|false
    {
        $stmt = $this->conn->prepare("INSERT INTO customer (firstname, lastname, email, phonenumber, address, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstname, $lastname, $email, $phone, $address, $hashedPassword);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $id = $stmt->insert_id;
        $stmt->close();
        return $id;
    }
}
