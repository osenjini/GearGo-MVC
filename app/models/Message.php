<?php
require_once __DIR__ . '/../config/Database.php';

/** Message — the `message` + `sends` tables that make up the buyer/owner chat. */
class Message
{
    private mysqli $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    /** Sends a chat message and records who it's between (and which item, if any). */
    public function send(string $text, $customerId, $supplierId, string $senderType, int $itemId): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO message (messagetext, Sentdatetime) VALUES (?, NOW())");
        $stmt->bind_param("s", $text);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $messageId = $stmt->insert_id;
        $stmt->close();

        $stmt2 = $this->conn->prepare("INSERT INTO sends (CustomerID, SupplierID, messageID, sender_type, Itemid) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("iiisi", $customerId, $supplierId, $messageId, $senderType, $itemId);
        $ok = $stmt2->execute();
        $stmt2->close();

        return $ok;
    }

    /** Full chat history between one customer and one supplier. */
    public function historyBetween($customerId, $supplierId): mysqli_result|bool
    {
        $history_query = "SELECT m.messageID, m.messagetext, m.Sentdatetime, s.sender_type, s.Itemid
                          FROM message m
                          JOIN sends s ON m.messageID = s.messageID
                          WHERE s.CustomerID = '" . $this->conn->real_escape_string((string)$customerId) . "' AND s.SupplierID = '" . $this->conn->real_escape_string((string)$supplierId) . "'
                          ORDER BY m.Sentdatetime ASC";
        return $this->conn->query($history_query);
    }

    /** Distinct customer threads for a shop owner's inbox, most recent first. */
    public function inboxForSupplier($supplierId): mysqli_result|bool
    {
        $safeSupplier = $this->conn->real_escape_string((string)$supplierId);
        $query = "SELECT DISTINCT c.CustomerID, c.firstname, c.lastname, c.email, c.phonenumber, i.Itemid, i.Itemname, i.image_path,
                  (SELECT Sentdatetime FROM message m JOIN sends s2 ON m.messageID = s2.messageID WHERE s2.CustomerID = c.CustomerID AND s2.SupplierID = '$safeSupplier' AND s2.Itemid = i.Itemid ORDER BY m.messageID DESC LIMIT 1) as latest_time
                  FROM sends s
                  JOIN customer c ON c.CustomerID = s.CustomerID
                  JOIN Item i ON i.Itemid = s.Itemid
                  WHERE s.SupplierID = '$safeSupplier'
                  ORDER BY latest_time DESC";
        return $this->conn->query($query);
    }
}
