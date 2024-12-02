<?php
/* This is a multi-line comment in PHP
   Displays confirmation of member registration */

$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
</head>
<body>
    <h1>Registration Successful!</h1>
    <p>Thank you for registering. Your membership ID is: <?php echo htmlspecialchars($id); ?></p>
</body>
</html>