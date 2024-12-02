<?php
require_once '../models/book_model.php';

class BookController
{
    private $book_model;

    public function __construct()
    {
        $this->book_model = new BookModel();
    }

    public function delete_book($book_id)
    {
        $book = $this->book_model->get_book_by_id($book_id);
        if ($book) {
            if ($this->book_model->delete_book($book_id)) {
                header('Location: ../views/book_deleted.php');
            } else {
                echo "Error: Unable to delete the book.";
            }
        } else {
            echo "Error: Book not found.";
        }
    }
}
?>
