<?php
/**
 * @file config.php
 * @brief Configuration file for the database connection.
 *
 * @details This file establishes a connection to the MySQL database.
 */

// Database connection settings
$host = 'localhost';      // Database host (usually localhost)
$username = 'root';       // Database username
$password = '';           // Database password (empty for default MySQL setup)
$dbname = 'library_system'; // Database name

// Create a connection to the MySQL database using MySQLi
$db_connection = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($db_connection->connect_error) {
    // If connection fails, display the error and terminate
    die("Connection failed: " . $db_connection->connect_error);
}

// Set the character set to utf8 for better support for different characters
$db_connection->set_charset('utf8');

// Make the $db_connection globally available for other files
?>
