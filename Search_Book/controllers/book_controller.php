<?php

/**
 * @file book_controller.php
 * 
 * @brief the purpose of this file is to control the search book related operations
 * 
 * @date 30-11-2024
 * 
 * @author Md Aurongojeb Lishad
 */

require_once 'config/database.php';
require_once 'models/book.php';

/**
 * Class book_controller
 * 
 * This class acts as a controller to handle book search functionality. It initializes the book model 
 * and provides methods to perform operations related to search books.
 * 
 */
class book_controller
{
    /**
     * @var book_model 
     */
    private $book_model;

    /**
     * Constructor for the book model.
     * 
     * The constructor connects to the database using the "database_connection" class and 
     * initializes the "book_model" to handle book related operations.
     */
    public function __construct()
    {
        $database = new database_connection();
        $connection = $database->connect_to_database();
        $this->book_model = new book_model($connection);
    }

    /**
     * Search books based on a search term.
     * 
     * This method takes a search term as input from user and use the "book_model" to retrieve a list 
     * of books that match with the search term. If the search term is empty, it returns an empty array.
     * 
     * @param string "search_term"--> The term use to search for the book.
     * @return array 
     */
    public function search_books($search_term)
    {
        if (empty($search_term))
        {
            return [];
        }

        return $this->book_model->search_books($search_term);
    }
}
?>

