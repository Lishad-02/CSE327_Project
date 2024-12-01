<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Late Fee</title>
</head>
<body>
    <form action="../controllers/LateFeeController.php" method="POST">
        <label for="reservation_id">Reservation ID:</label>
        <input type="text" id="reservation_id" name="reservation_id" required>
        <button type="submit">Calculate Late Fee</button>
    </form>
</body>
</html>
