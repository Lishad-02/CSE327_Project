<?php
/**
 * @file database.php
 * 
 * @brief This file sets up the connection to the database for Borrowing Function.
 * 
 * It defines database credentials (servername,username,password and database name)
 * then perform to establish a connection with the database.It checks whether the connection is successful or not
 * if not, it terminates the script and displays the error message.
 * 
 * @date 22-11-2024
 * 
 * @author Md Aurongojeb Lishad
 */


// Database configuration
$server_name = "localhost"; /**< The server where the databse hosted(Localhost) */
$db_username = "root"; /**< The username for the databse*/
$db_password = ""; /**< The password for the database( Empty by default as it is a local server) */
$db_name = "library_db2";  /**< Name of the database */

// Establish database connection
$conn = new mysqli($server_name, $db_username, $db_password, $db_name); /**< Execute database connection */

// Check connection
if ($conn->connect_error) 
{ 
    //if connection fails display error message
    die("Connection failed: " . $conn->connect_error);
}
?>
