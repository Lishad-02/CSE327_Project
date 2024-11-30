<?php

/**
 * Book Model
 * 
 * Handles all database operations related to books.
 */

class book_model
{
    private $database_connection;

    /**
     * Constructor to initialize the database connection.
     *
     * @param mysqli $database_connection
     */
    public function __construct($database_connection)
    {
        $this->database_connection = $database_connection;
    }

    /**
     * Search books by title or author.
     *
     * @param string $search_term
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
?>
