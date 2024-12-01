<?php
// Include the database configuration
require_once 'config/database.php';

// Establish database connection
$db = new Database();
$pdo = $db->getConnection();

// Fetch books and members for the form
$booksQuery = "SELECT id, title, available FROM books WHERE available = 1";
$booksStmt = $pdo->query($booksQuery);
$books = $booksStmt->fetchAll(PDO::FETCH_ASSOC);

$membersQuery = "SELECT id, name FROM members WHERE active = 1";
$membersStmt = $pdo->query($membersQuery);
$members = $membersStmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = $_POST['book_id'] ?? null;
    $memberId = $_POST['member_id'] ?? null;
    $borrowDate = date('Y-m-d'); // Current date
    $dueDate = date('Y-m-d', strtotime('+14 days')); // Default borrow duration: 14 days

    if ($bookId && $memberId) {
        try {
            // Insert reservation
            $stmt = $pdo->prepare(
                "INSERT INTO reservations (book_id, member_id, borrow_date, due_date) 
                VALUES (:book_id, :member_id, :borrow_date, :due_date)"
            );
            $stmt->execute([
                ':book_id' => $bookId,
                ':member_id' => $memberId,
                ':borrow_date' => $borrowDate,
                ':due_date' => $dueDate,
            ]);

            // Update book availability
            $updateStmt = $pdo->prepare("UPDATE books SET available = 0 WHERE id = :book_id");
            $updateStmt->execute([':book_id' => $bookId]);

            $message = "Book reserved successfully!";
        } catch (Exception $e) {
            $message = "Error: " . $e->getMessage();
        }
    } else {
        $message = "Please select both a book and a member.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Reservation</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Book Reservation</h1>
        <form method="POST" action="">
            <div>
                <label for="book_id">Select Book:</label>
                <select name="book_id" id="book_id" required>
                    <option value="">-- Select a Book --</option>
                    <?php foreach ($books as $book): ?>
                        <option value="<?= htmlspecialchars($book['id']) ?>">
                            <?= htmlspecialchars($book['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="member_id">Select Member:</label>
                <select name="member_id" id="member_id" required>
                    <option value="">-- Select a Member --</option>
                    <?php foreach ($members as $member): ?>
                        <option value="<?= htmlspecialchars($member['id']) ?>">
                            <?= htmlspecialchars($member['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit">Reserve Book</button>
        </form>

        <?php if (!empty($message)): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
