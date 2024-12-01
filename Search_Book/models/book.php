<?php

/**
 * @file book.php
 * @brief This file handles search book operation related queries. 
 * 
 * @date 30-11-2024
 * @author Md Aurongojeb Lishad
 */

/**
 * Class book_model
 * 
 * This class is used to handle all database operations related to books,
 * such as: searching for books by title or author.
 * 
 */

class book_model
{
    private $database_connection;

    /**
     * Constructor to initialize the database connection.
     * 
     * This constructor sets up the database connection for the `book_model` class 
     * 
     * @param mysqli "database_connection" 
     */

    public function __construct($database_connection)
    {
        $this->database_connection = $database_connection;
    }

    /**
     * This method is for Search books by title or author.For this it send a sql query ,store the results and return that results.
     *
     * @param string "search_term"
     * @return array
     */

    public function search_books($search_term)
    {
        $query = "Select * From books where title Like ? OR author Like ?  ";
        $statement = $this->database_connection->prepare($query);

        $search_term = "%" . $search_term . "%";
        $statement->bind_param('ss', $search_term, $search_term);

        $statement->execute();
        $result = $statement->get_result();

        $books = $result->fetch_all(MYSQLI_ASSOC);

        $statement->close();
        return $books;
    }
}
