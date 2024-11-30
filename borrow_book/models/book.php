<?php

/**
 * @file book.php
 * @brief The main purpose of this file is to manage book-related operations
 * 
 * @date 23-11-2024
 * 
 * @author Md Aurongojeb Lishad
 */

/**
 * This book class handles the book availability and update the book available copies.
 */

class book
{

    /**
     * Checks if a book is available or not for borrowing.
     *
     * @param int "$book_id" --> The unique ID of the book .
     * @return boolean:: Returns true if the book is available, false otherwise.
     */

    public function is_available($book_id)
    {
        global $conn;

        //SQL Query to retrieve available copies database
        $query = "SELECT available_copies FROM books WHERE book_id = ?";

        $stmt = $conn->prepare($query);

        $stmt->bind_param("i", $book_id);

        // Execute the SQL query.
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        // Return true if the book is available 
        return $row && $row['available_copies'] > 0;
    }

    /**
     * Decrease the available copies of a book by one.
     *
     * @param int "$book_id" --> The unique ID of the book .
     * @return void
     */

    public function decrement_copies($book_id)
    {
        global $conn;

        //sql query for decrese the available copies in datbase
        $query = "UPDATE books SET available_copies = available_copies - 1 WHERE book_id = ?";

        $stmt = $conn->prepare($query);

        $stmt->bind_param("i", $book_id);

        $stmt->execute();

        $stmt->close();
    }
}
