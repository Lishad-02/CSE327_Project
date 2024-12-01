<?php
require_once 'models/book.php';

/**
 * Class AddBooksController
 *
 * Handles the process of adding books to the library catalog.
 */
class AddBooksController
{
    /**
     * Displays the Add Book form.
     *
     * @return void
     */
    public function show_add_book_form()
    {
        include 'views/add_book_form.php';
    }

    /**
     * Handles adding a new book or batch of books to the catalog.
     *
     * @return void
     */
    public function add_books()
    {
        global $conn;

        $book = new Book();

        // For single or batch entry
        if (isset($_POST['books'])) 
        {
            $books = json_decode($_POST['books'], true);
            foreach ($books as $book_data) 
            {
                if (!$book->add_new_book($book_data)) 
                {
                    $error = "Error adding book: " . $book_data['title'];
                    include 'views/add_book_error.php';
                    return;
                }
            }
            include 'views/add_book_success.php';
        }       else 
                {
                  $error = "No book data received.";
                  include 'views/add_book_error.php';
                }
    }
}
