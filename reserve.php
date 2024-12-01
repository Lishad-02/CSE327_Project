<?php
session_start();
require_once '../includes/db_config.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];
    $userId = $_SESSION['user_id'];

    $db = new Database();
    $conn = $db->getConnection();

    // Reserve the book
    $query = "INSERT INTO reservations (book_id, member_id) VALUES (:book_id, :member_id)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':book_id', $bookId);
    $stmt->bindParam(':member_id', $userId);

    if ($stmt->execute()) {
        header('Location: search.php');
        exit;
    } else {
        $error = "Failed to reserve the book.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<h2>Reserve Book</h2>
<?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
<p>Unable to reserve book. <a href="search.php">Back to Search</a></p>
<?php include '../includes/footer.php'; 
?>
