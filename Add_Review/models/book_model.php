<?php
/**
 * Model for managing books.
 *
 * @package library_management_system
 */

require_once '../config.php';

class book_model 
{
    /**
     * Retrieves a book by its ID.
     *
     * @param int $book_id Book ID.
     * @return array|bool Associative array of book details or false on failure.
     */
    public function get_book_by_id($book_id) 
    {
        global $conn;
        $query = "SELECT * FROM books WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $book_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Inserts a new book into the database.
     *
     * @param string $title Book title.
     * @param string $author Book author.
     * @return bool True on success, false otherwise.
     */
    public function add_book($title, $author) 
    {
        global $conn;
        $query = "INSERT INTO books (title, author) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $title, $author);
        return $stmt->execute();
    }
}
?>
