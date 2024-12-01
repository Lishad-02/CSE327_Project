<?php
$mysqli = new mysqli('localhost', 'root', '', 'test');

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

echo "Connected successfully!<br>";

$result = $mysqli->query("SHOW TABLES LIKE 'books'");
if ($result && $result->num_rows > 0) {
    echo "The 'books' table exists!";
} else {
    echo "The 'books' table does NOT exist!";
}

$mysqli->close();
?>
