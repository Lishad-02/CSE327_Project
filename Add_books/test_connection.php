<?php
// Database connection parameters
$servername = "localhost";  // MySQL host, typically 'localhost'
$username = "root";         // Default XAMPP MySQL username
$password = "";             // Default XAMPP MySQL password (empty by default)
$dbname = "test";           // Replace with an existing database name, or create one for testing

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    // If connection fails, display error
    die("Connection failed: " . $conn->connect_error);
} else {
    // If connection is successful, display success message
    echo "Connected successfully to the database '$dbname'!";
}

// Close the connection
$conn->close();
?>
