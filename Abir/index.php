<?php
include('db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Library Management System</h1>

    <!-- Add New Book Form -->
    <form action="add_book.php" method="POST">
        <label for="title">Book Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre"><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>

        <label for="publication_date">Publication Date:</label>
        <input type="date" id="publication_date" name="publication_date"><br>

        <button type="submit" name="submit">Add Book</button>
    </form>

    <!-- History of Added Books -->
    <h2>Book Addition History</h2>
    <?php
    $sql = "SELECT * FROM books ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>Title</th><th>Author</th><th>Genre</th><th>Description</th><th>Publication Date</th><th>Date Added</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row['title']."</td><td>".$row['author']."</td><td>".$row['genre']."</td><td>".$row['description']."</td><td>".$row['publication_date']."</td><td>".$row['added_on']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No books added yet.";
    }
    ?>
</body>
</html>
