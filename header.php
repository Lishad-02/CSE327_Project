<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="search.php">Search Books</a></li>
        <?php if (isset($_SESSION['username'])): ?>
            <li><a href="reserve.php">Reserve Book</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>
