<?php
require_once '../includes/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $db = new Database();
        $conn = $db->getConnection();

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO members (username, password) VALUES (:username, :password)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            header('Location: login.php');
            exit;
        } else {
            $error = "Registration failed. Username might already exist.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<h2>Register</h2>
<?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
<form action="" method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="login.php">Login</a>.</p>
<?php include '../includes/footer.php'; ?>
