<?php
require_once __DIR__ . '/../config/Database.php';

/** Review — the `review` table (ratings + text left on an item). */
class Review
{
    private mysqli $conn;
    public string $lastError = '';

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function create(int $rating, string $text, $customerId, int $itemId): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO review (Rating, review_text, CustomerID, Itemid) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isii", $rating, $text, $customerId, $itemId);
        $ok = $stmt->execute();
        if (!$ok) {
            $this->lastError = $this->conn->error;
        }
        $stmt->close();
        return $ok;
    }

    /** All reviews for an item, newest first, joined with the reviewer's name. */
    public function forItem(int $itemId): mysqli_result|bool
    {
        $query = "SELECT r.*, c.firstname, c.lastname
                  FROM review r
                  JOIN customer c ON r.CustomerID = c.CustomerID
                  WHERE r.Itemid = '" . $this->conn->real_escape_string((string)$itemId) . "'
                  ORDER BY r.review_date DESC";
        return $this->conn->query($query);
    }

    public function averageRating(int $itemId): float
    {
        $res = $this->conn->query("SELECT AVG(Rating) AS avg_rate FROM review WHERE Itemid = '" . $this->conn->real_escape_string((string)$itemId) . "'");
        if ($res && $row = $res->fetch_assoc()) {
            return round(floatval($row['avg_rate']), 1);
        }
        return 0.0;
    }
}
