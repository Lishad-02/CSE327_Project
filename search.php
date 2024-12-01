<?php
session_start();
require_once '../includes/db_config.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$books = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $keyword = $_POST['keyword'] ?? '';

    if ($keyword) {
        $db = new Database();
        $conn = $db->getConnection();

        $query = "SELECT * FROM books WHERE title LIKE :keyword OR author LIKE :keyword";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':keyword', "%$keyword%");
        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<?php include '../includes/header.php'; ?>
<h2>Search Books</h2>
<form action="" method="POST">
    <input type="text" name="keyword" placeholder="Enter title or author" required><br>
    <button type="submit">Search</button>
</form>
<?php if ($books): ?>
    <ul>
        <?php foreach ($books as $book): ?>
            <li>
                <?php echo htmlspecialchars($book['title']) . " by " . htmlspecialchars($book['author']); ?>
                <?php if ($book['available']): ?>
                    <a href="reserve.php?book_id=<?php echo $book['id']; ?>">Reserve</a>
                <?php else: ?>
                    (Not Available)
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <p>No books found.</p>
<?php endif; ?>
<?php include '../includes/footer.php';
 ?>
