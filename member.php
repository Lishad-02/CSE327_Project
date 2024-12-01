<?php
// Include the database configuration file
include 'db_config.php'; 

// Start the session
session_start();

// Check if the member is logged in
if (!isset($_SESSION['member_id'])) {
    header('Location: login.php'); // Redirect to login if not authenticated
    exit;
}

// Get the logged-in member's ID and username from the session
$member_id = $_SESSION['member_id'];
$username = $_SESSION['username'];

// Create a database connection
$database = new Database();
$conn = $database->getConnection();

try {
    // Fetch member details (e.g., status, number of active reservations)
    $query = "SELECT status, 
              (SELECT COUNT(*) FROM reservations WHERE member_id = :member_id AND status = 'active') AS active_reservations
              FROM members 
              WHERE id = :member_id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);
    $stmt->execute();
    $memberDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch active reservations for the member
    $reservationsQuery = "SELECT r.id AS reservation_id, b.title, b.author, r.reservation_date, r.status
                          FROM reservations r
                          JOIN books b ON r.book_id = b.id
                          WHERE r.member_id = :member_id
                          ORDER BY r.reservation_date DESC";

    $reservationsStmt = $conn->prepare($reservationsQuery);
    $reservationsStmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);
    $reservationsStmt->execute();
    $reservations = $reservationsStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error fetching member data: " . $e->getMessage());
}
?>