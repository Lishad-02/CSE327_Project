<?php
/**
 * book.php
 * Defines methods related to book management.
 */

class book 
{
    public function is_available($book_id) 
    {
        global $conn;
        $query = "SELECT available_copies FROM books WHERE book_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row && $row['available_copies'] > 0;
    }

    public function decrement_copies($book_id) 
    {
        global $conn;
        $query = "UPDATE books SET available_copies = available_copies - 1 WHERE book_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->close();
    }
}
?>
