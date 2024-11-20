<?php

/** 
 * Index Page
 * 
 * The entry point of the application that manages the routing and displays search results.
 */

require_once 'controllers/book_controller.php';

if (isset($_GET['search_term'])) {
    $search_term = $_GET['search_term'];
    $book_controller = new book_controller();
    $books = $book_controller->search_books($search_term);

    if (empty($books)) {
        $error = "No search results found!";
        include 'views/search_book_input.php';
    } else {
        include 'views/search_book_result.php'; // Include the search result view
    }
} else {
    include 'views/search_book_input.php';
}
?>
