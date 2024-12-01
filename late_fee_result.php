<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Late Fee Result</title>
</head>
<body>
    <h1>Late Fee Calculation</h1>
    <p>Reservation ID: <?= htmlspecialchars($reservationId) ?></p>
    <p>Late Fee: $<?= htmlspecialchars($fee) ?></p>
    <a href="../views/late_fee_form.php">Back</a>
</body>
</html>
