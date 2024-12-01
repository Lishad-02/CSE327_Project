<?php
// Include the database connection file
require 'db1_config.php';

// Query the database
$sql = "SELECT * FROM books";
$stmt = $pdo->query($sql);

// Display books
echo "<h1>Books</h1>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "Title: " . htmlspecialchars($row['title']) . "<br>";
    echo "Author: " . htmlspecialchars($row['author']) . "<br><br>";
}
?>
