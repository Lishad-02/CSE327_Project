<?php

/** 
 * Book Controller
 * 
 * Handles all book-related operations such as searching, displaying, and managing books.
 */

require_once 'config/database.php';
require_once 'models/book.php';

/**
 * Book controller class to manage book-related functionalities
 */
class book_controller
{
    private $database_connection;
    private $book;

    /**
     * Constructor to initialize database and book model
     */
    public function __construct()
    {
        $this->database_connection = new database_connection();
        $this->book = new book($this->database_connection->get_connection());
    }

    /**
     * Search books based on a search term
     *
     * @param string $search_term
     * @return array
     */
    public function search_books($search_term)
    {
        if (empty($search_term)) {
            return [];
        }

        return $this->book->search_books_by_title_or_author($search_term);
    }
}
?>
