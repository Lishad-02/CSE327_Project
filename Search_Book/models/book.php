<?php

/** 
 * Book Model
 * 
 * Manages book-related data interactions with the database.
 */

class book
{
    private $db_connection;
    private $table_name = 'books';

    /**
     * Constructor to initialize database connection
     *
     * @param mysqli $db_connection
     */
    public function __construct($db_connection)
    {
        $this->db_connection = $db_connection;
    }

    /**
     * Search books by title or author
     *
     * @param string $search_term
     * @return array
     */
    public function search_books_by_title_or_author($search_term)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE title LIKE ? OR author LIKE ?";
        $stmt = $this->db_connection->prepare($query);
        $search_term_with_wildcards = "%" . $search_term . "%";
        $stmt->bind_param('ss', $search_term_with_wildcards, $search_term_with_wildcards);
        $stmt->execute();
        $result = $stmt->get_result();
        $books = [];

        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }

        return $books;
    }
}
?>
