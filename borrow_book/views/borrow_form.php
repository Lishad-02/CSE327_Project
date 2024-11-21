<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Book</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body class="form-page">
    <div class="form-container">
        <h2>Borrow a Book</h2>
        <form action="index.php" method="POST">
            <label for="email">User Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="book_id">Book ID:</label>
            <input type="number" id="book_id" name="book_id" required>
            
            <button type="submit">Borrow Book</button>
        </form>
    </div>
</body>
</html>
