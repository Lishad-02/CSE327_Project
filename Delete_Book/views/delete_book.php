<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Delete Book</h1>
    <form action="../index.php" method="GET">
        <label for="book_id">Enter Book ID:</label>
        <input type="text" id="book_id" name="book_id" required>
        <button type="submit" name="action" value="delete">Delete Book</button>
    </form>
</body>
</html>
