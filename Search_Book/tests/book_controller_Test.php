<?php

use PHPUnit\Framework\TestCase;
require_once 'controllers/book_controller.php';

class test_book_controller extends TestCase
{
    private $book_controller;

    protected function setUp(): void
    {
        // Initialize the Book Controller with the actual database
        $this->book_controller = new book_controller();
    }

    public function test_search_books_returns_results()
    {
        // Insert a test book into the database
        $db_connection = (new database_connection())->connect_to_database();
        $test_title = 'Test Book';
        $test_author = 'Test Author';
        $db_connection->query("INSERT INTO books (title, author) VALUES ('$test_title', '$test_author')");

        // Perform the search
        $result = $this->book_controller->search_books('Test Book');

        // Assert the search result contains the test book
        $this->assertNotEmpty($result);
        $this->assertEquals('Test Book', $result[0]['title']);
        $this->assertEquals('Test Author', $result[0]['author']);

        // Clean up: remove the test book from the database
        $db_connection->query("DELETE FROM books WHERE title = '$test_title'");
        $db_connection->close();
    }

    public function test_search_books_returns_empty()
    {
        // Perform a search for a non-existent book
        $result = $this->book_controller->search_books('Nonexistent Book');

        // Assert the search result is empty
        $this->assertEmpty($result);
    }
}
?>

