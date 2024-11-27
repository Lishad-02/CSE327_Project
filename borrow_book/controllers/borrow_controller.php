<?php
/**
 * @file borrow_controller.php
 * 
 * @brief This file handles borrowing books in the library system.
 * 
 * It checks a book is available or not, 
 * create a borrow record and update book availability,when a book is borrowed.
 * 
 * need "models/book.php" & "models/borrow.php" file to run this file.
 * 
 * @date 22-11-2024
 * 
 * @author Md Aurongojeb Lishad
 */

require_once 'models/book.php'; 
require_once 'models/borrow.php'; 

/**
 * Class borrow_controller
 * 
 * This class is used to handle the borrowing of books. 
 * It shows the borrow form for taking input from user, checks book availability, and updates the database 
 * when a book is borrowed.
 */


class borrow_controller 
{
     /**
     * Shows the borrow form to the user.
     * 
     * @brief Show the page where users can enter their borrowing details.
     * 
     * @return void
     */
    
    public function show_borrow_form() 
    {
        include 'views/borrow_form.php';
    }

    /**
     * Handles the process of borrowing a book.
     * 
     * @brief This Method checks if a book is available or not, creates a borrow record, 
     * and updates the book's available copies.
     * 
     * **Steps:**
     * - Gets the user email and book ID from the form.
     * - Checks if the book is available.
     * - If available, creates a borrow record and updates the number of available copies.
     * - If not available or if there is an error, shows an error page.
     * 
     * 
     * 
     * @see is_available() --- Check if the book has available copies.
     * @see create_borrow_record() ---  Create a record for the borrowed book.
     * @see decrement_copies() --- Reduce the number of available copies in the database.
     * 
     * @return type: void
     */
    
     

    public function borrow_book() 
    {
     /** 
      *
      * **Inline Details** */
        global $conn; /**< The database connection. */

        $user_email = $_POST['email']; /**< user_email: Get user's email from the form. */
        $book_id = $_POST['book_id'];  /**< book_id: Get Book ID from the form. */

        $book = new book();  /**< Create a Book object to manage book-related actions. */
        $borrow = new borrow();  /**< Create a Borrow object to handle borrowing actions. */

        // Check if the book is available
        if ($book->is_available($book_id)) 
        {
            // Borrow the book
            $due_date = date('Y-m-d', strtotime('+7 days')); /**< Sets the due date 7 days from now. */
            if ($borrow->create_borrow_record($user_email, $book_id, $due_date)) 
            {
                // Update available copies
                $book->decrement_copies($book_id); /**< Reduces the number of available copies. */
                include 'views/borrow_success.php'; /**< Shows the success message. */
            } 
            else 
            {
                $error = "Error occurred while borrowing the book."; /**< Error message for failure. */
                include 'views/borrow_error.php'; /**< Shows the error message. */
            }
        } 
        else 
        {
            $error = "No available copies for this book."; /**< Error message for unavailable books. */
            include 'views/borrow_error.php'; /**< Shows the error message */
        }
    }
}
?>