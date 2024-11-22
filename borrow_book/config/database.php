<?php
/**
 * database.php
 * Handles the database connection configuration.
 */

// Database configuration
$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "library_db2"; 

// Establish database connection
$conn = new mysqli($server_name, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
?>
