<?php
require_once __DIR__ . '/../config/Database.php';

/** Reservation — the `reservation` + `reserves` tables (24h hold on an item). */
class Reservation
{
    private mysqli $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    /** Cancels reservations whose 24h window has expired and restocks their items. */
    public function releaseExpired(): void
    {
        $expired_res = $this->conn->query("SELECT reservation.reservationID, reserves.Itemid FROM reservation JOIN reserves ON reservation.reservationID = reserves.reservationID WHERE reservation.Status = 'Reserved' AND reservation.expiredatetime < NOW()");
        if ($expired_res && $expired_res->num_rows > 0) {
            while ($exp = $expired_res->fetch_assoc()) {
                $res_id = $exp['reservationID'];
                $exp_item_id = $exp['Itemid'];
                $this->conn->query("UPDATE reservation SET Status='Cancelled' WHERE reservationID='$res_id'");
                $this->conn->query("UPDATE Item SET quantity = quantity + 1, availabilitystatus='IN STOCK' WHERE Itemid='$exp_item_id'");
            }
        }
    }

    /** Creates the reservation + reserves-link rows for a 24h hold. */
    public function reserve($customerId, int $itemId): int|false
    {
        $expire_time = date('Y-m-d H:i:s', strtotime('+24 hours'));
        $stmt = $this->conn->prepare("INSERT INTO reservation (expiredatetime, Status) VALUES (?, 'Reserved')");
        $stmt->bind_param("s", $expire_time);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $resId = $stmt->insert_id;
        $stmt->close();

        $stmt2 = $this->conn->prepare("INSERT INTO reserves (CustomerID, Itemid, reservationID) VALUES (?, ?, ?)");
        $stmt2->bind_param("iii", $customerId, $itemId, $resId);
        $stmt2->execute();
        $stmt2->close();

        return $resId;
    }
}
