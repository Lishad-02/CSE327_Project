<?php

/**
 * @file borrow.php
 * 
 * @brief The purpose of this file is to handle borrowing operations
 * 
 * @date 23-11-2024
 * 
 * @author Md Aurongojeb Lishad
 */

/**
 * The borrow class store the borrow records in databse.
 */


class borrow 
{

    /**
     * Creates a new borrow record in the system.
     *
     * @param string "$user_email" -->The email address of the user who borrow the book.
     * @param int "$book_id" --> The unique ID of the book .
     * @param string "$due_date" --> The due date for returning the borrowed book (format: Year-Month-Day).
     * @return boolean :Returns true if the borrow record was created successfully, false otherwise.
     */

    public function create_borrow_record($user_email, $book_id, $due_date) 
    {
        //the global database connection
        global $conn;

        //SQL query for insert borrow record in databse
        $query = "INSERT INTO borrow (user_email, book_id, borrow_date, due_date) VALUES (?, ?, NOW(), ?)";

        $stmt = $conn->prepare($query);

        $stmt->bind_param("sis", $user_email, $book_id, $due_date);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }
}
?>
