<!-- 
    @file borrowForm.php
    @brief View for displaying the borrow book form.
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Book</title>
</head>
<body>
    <h2>Borrow a Book</h2>
    <form action="index.php" method="POST">
        <label for="email">User Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="book_id">Book ID:</label>
        <input type="number" id="book_id" name="book_id" required><br><br>
        
        <button type="submit">Borrow Book</button>
    </form>
</body>
</html>