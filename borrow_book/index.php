<?php
/**
 * index.php
 * Handles the routing of requests to the borrow controller.
 */

require_once 'config/database.php';
require_once 'controllers/borrow_controller.php';

// Create instance of borrow controller
$controller = new borrow_controller();

// Handle POST request for borrowing a book
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $controller->borrow_book();
} 
else 
{
    $controller->show_borrow_form();
}
?>

