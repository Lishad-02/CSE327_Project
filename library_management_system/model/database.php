<?php
/* This is a multi-line comment in PHP
   Database configuration settings */

   $host = 'localhost';
   $db = 'library_management';
   $user = 'root'; // Default for XAMPP
   $pass = ''; // Empty by default
   
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>