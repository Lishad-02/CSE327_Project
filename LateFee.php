<?php
class LateFee {
    private $pdo;
    private $lateFeePerDay = 5; // Example: $5 per day.

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function calculateLateFee($reservationId) {
        $query = "SELECT due_date, return_date FROM reservations WHERE id = :reservationId";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['reservationId' => $reservationId]);
        $reservation = $stmt->fetch();

        if (!$reservation) {
            return "Reservation not found.";
        }

        $dueDate = new DateTime($reservation['due_date']);
        $returnDate = new DateTime($reservation['return_date'] ?? 'now');

        if ($returnDate <= $dueDate) {
            return 0;
        }

        $lateDays = $dueDate->diff($returnDate)->days;
        return $lateDays * $this->lateFeePerDay;
    }
}
?>
