<?php

/** 
 * @file index.php
 * @brief The entry point for book search functionality.
 * The main purpose of this file is to handle search book requests by routing them to the appropriate methods in different files for search book.
 * 
 * @date 30-11-2024
 * @author Md Aurongojeb Lishad
 */

require_once 'controllers/book_controller.php';

/**
 * Class index_controller
 * 
 * Handles the routing for searching books.
 */
class index_controller
{
    /**
     * Process the request and redirect the appropriate view.
     */
    public function handle_request()
    {
        if (isset($_GET['search_term'])) {
            $this->handle_search($_GET['search_term']);
        } else {
            $this->redirect_inputView();
        }
    }

    /**
     * Handle the search operation and redirect the results view.
     *
     * @param string "search_term" .
     */
    private function handle_search($search_term)
    {
        $book_controller = new book_controller();
        $books = $book_controller->search_books($search_term);

        if (empty($books)) {
            $error = "No search results found!";
            include 'views/search_book_input.php';
        } else {
            include 'views/search_book_result.php';
        }
    }

    /**
     * redirect the input view for searching books.
     */
    private function redirect_inputView()
    {
        include 'views/search_book_input.php';
    }
}

// Create an instance of index_controller and handle the request.
$indexController = new index_controller();
$indexController->handle_request();
?>
