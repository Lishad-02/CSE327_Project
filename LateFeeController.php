<?php
require_once '../models/LateFee.php';
require_once '../config/database.php';

$lateFee = new LateFee($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservationId = $_POST['reservation_id'] ?? null;

    if ($reservationId) {
        $fee = $lateFee->calculateLateFee($reservationId);
        include '../views/late_fee_result.php';
    } else {
        echo "Please provide a reservation ID.";
    }
}
?>
