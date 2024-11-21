<?php
/**
 * borrow.php
 * Handles borrow record operations.
 */

class borrow 
{
    public function create_borrow_record($user_email, $book_id, $due_date) 
    {
        global $conn;
        $query = "INSERT INTO borrow (user_email, book_id, borrow_date, due_date) VALUES (?, ?, NOW(), ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sis", $user_email, $book_id, $due_date);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}
?>