<?php
/**
 * @file borrow_controller.php
 * @brief Handles borrowing functionality for the library system.
 *
 * This file contains the `borrow_controller` class, which includes methods 
 * for rendering the borrow form and processing book borrowing logic.
 */

require_once 'models/book.php'; /**< Includes the Book model. */
require_once 'models/borrow.php'; /**< Includes the Borrow model. */

/**
 * @class borrow_controller
 * @brief Controller class to handle book borrowing functionalities.
 */
class borrow_controller 
{
    /**
     * @brief Renders the borrow form view.
     *
     * This method is responsible for including the borrow form view 
     * to allow users to input borrowing details.
     *
     * @return void Displays the borrow form to the user.
     */
    public function show_borrow_form() 
    {
        include 'views/borrow_form.php';
    }

    /**
     * @brief Processes the book borrowing functionality.
     *
     * This method handles the logic for borrowing a book:
     * - Checks if the book is available.
     * - Creates a borrow record in the system.
     * - Updates the available copies of the book.
     * - Includes views for success or error outcomes.
     *
     * @global object $conn: Database connection object used for database operations.
     *
     * @return void This method does not return any value. It includes views for success or error outcomes.
     */
    public function borrow_book() 
    {
        global $conn; // Database connection object

        $user_email = $_POST['email']; // User's email address obtained from the POST request
        $book_id = $_POST['book_id'];  // Book ID obtained from the POST request

        $book = new book();  // Instance of the Book model
        $borrow = new borrow();  // Instance of the Borrow model

        // Check if the book is available
        if ($book->is_available($book_id)) 
        {
            // Borrow the book
            $due_date = date('Y-m-d', strtotime('+7 days')); // Calculate the due date for the borrowed book
            if ($borrow->create_borrow_record($user_email, $book_id, $due_date)) 
            {
                // Update available copies
                $book->decrement_copies($book_id); // Decrement the available copies of the book
                include 'views/borrow_success.php'; // Display success view
            } 
            else 
            {
                $error = "Error occurred while borrowing the book."; // Error message for borrow failure
                include 'views/borrow_error.php'; // Display error view
            }
        } 
        else 
        {
            $error = "No available copies for this book."; // Error message for unavailable book copies
            include 'views/borrow_error.php'; // Display error view
        }
    }
}
?>
