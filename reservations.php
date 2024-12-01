<?php
require_once 'includes/db_config.php';  // Include the database configuration

class Reservation {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // Method to create a reservation
    public function createReservation($book_id, $member_id) {
        $query = "INSERT INTO reservations (book_id, member_id, status) VALUES (:book_id, :member_id, 'active')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Method to cancel a reservation
    public function cancelReservation($reservation_id, $member_id) {
        $query = "UPDATE reservations SET status = 'cancelled' WHERE id = :reservation_id AND member_id = :member_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':reservation_id', $reservation_id, PDO::PARAM_INT);
        $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
