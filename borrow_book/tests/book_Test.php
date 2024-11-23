<?php

use PHPUnit\Framework\TestCase;

require_once 'config/database.php';
require_once 'models/book.php';
require_once 'models/borrow.php';
require_once 'controllers/borrow_controller.php';

class borrow_book_test extends TestCase
{
    private $book;
    private $borrow;
    private $controller;

    public static function setUpBeforeClass(): void
    {
        global $conn;
        require 'config/database.php';
    }

    protected function setUp(): void
    {
        $this->book = new book();
        $this->borrow = new borrow();
        $this->controller = new borrow_controller();

        // Clear test data from borrow and books tables
        global $conn;
        $conn->query("DELETE FROM borrow WHERE book_id = 1 AND user_email = 'testuser@example.com'");
        $conn->query("DELETE FROM books WHERE book_id = 1");
    }

    public function test_is_available()
    {
        global $conn;

        // Insert a test record for the book with available copies
        $conn->query("INSERT INTO books (book_id, available_copies) VALUES (1, 1)");

        // Check availability of the book
        $this->assertTrue($this->book->is_available(1));
    }

    public function test_decrement_copies()
    {
        global $conn;

        // Insert a test record for the book
        $conn->query("INSERT INTO books (book_id, available_copies) VALUES (1, 1)");

        // Call decrement and verify
        $this->book->decrement_copies(1);
        $result = $conn->query("SELECT available_copies FROM books WHERE book_id = 1");
        $row = $result->fetch_assoc();
        $this->assertEquals(0, $row['available_copies']);
    }

    public function test_borrow_book()
    {
        global $conn;

        // Insert a test record for the book with available copies
        $conn->query("INSERT INTO books (book_id, available_copies) VALUES (1, 1)");

        // Simulate a POST request to borrow the book
        $_POST['email'] = 'testuser@example.com';
        $_POST['book_id'] = 1;

        // Call borrow_book method to simulate borrowing the book
        $this->controller->borrow_book();

        // Check if the borrow record was created in the borrow table
        $result = $conn->query("SELECT * FROM borrow WHERE user_email = 'testuser@example.com' AND book_id = 1");
        $this->assertTrue($result->num_rows > 0);

        // Check if the available copies of the book were decremented
        $result = $conn->query("SELECT available_copies FROM books WHERE book_id = 1");
        $row = $result->fetch_assoc();
        $this->assertEquals(0, $row['available_copies']);
    }

    public function test_borrow_book_no_available_copies()
    {
        global $conn;

        // Insert a test record for the book with no available copies
        $conn->query("INSERT INTO books (book_id, available_copies) VALUES (1, 0)");

        // Simulate a POST request to borrow the book
        $_POST['email'] = 'testuser@example.com';
        $_POST['book_id'] = 1;

        // Call borrow_book method to simulate borrowing the book
        ob_start();
        $this->controller->borrow_book();
        $output = ob_get_clean();

        // Assert that the error message for no available copies is shown
        $this->assertStringContainsString('No available copies for this book.', $output);
    }

    protected function tearDown(): void
    {
        // Clean up the test data after each test
        global $conn;
        $conn->query("DELETE FROM borrow WHERE book_id = 1 AND user_email = 'testuser@example.com'");
        $conn->query("DELETE FROM books WHERE book_id =1");
    }
}
