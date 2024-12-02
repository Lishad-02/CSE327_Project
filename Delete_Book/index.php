<?php
require_once 'controllers/book_controller.php';

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $controller = new BookController();
    $controller->delete_book($_GET['book_id']);
} else {
    include 'views/delete_book.php';
}
?>
