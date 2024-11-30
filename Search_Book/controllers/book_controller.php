<?php

/**
 * Book Controller
 * 
 * Handles requests related to books and connects the view with the model.
 */

require_once 'config/database.php';
require_once 'models/book.php';

class book_controller
{
    private $book_model;

    /**
     * Constructor to initialize the book model.
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
     * @param string $search_term
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

