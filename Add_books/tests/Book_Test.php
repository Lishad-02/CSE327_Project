<?php

use PHPUnit\Framework\TestCase;

class Book_Test extends TestCase
{
    protected $conn;

    // Set up the database connection
    public function setUp(): void
    {
        // Connect to the test database
        $this->conn = new mysqli('localhost', 'root', '', 'test');
        
        // Check connection
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    // Test function for adding a new book
    public function test_add_new_book()
    {
        // Book data to be inserted
        $book_data = [
            'title' => 'Test Book',
            'author' => 'Test Author',
            'genre' => 'Fiction',
            'description' => 'A test book description.',
            'publication_date' => '2024-12-01',
            'added_by' => 'admin@example.com'
        ];

        // Prepare the query to prevent SQL injection
        $stmt = $this->conn->prepare("
            INSERT INTO books (title, author, genre, description, publication_date, added_by) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            'ssssss', 
            $book_data['title'], 
            $book_data['author'], 
            $book_data['genre'], 
            $book_data['description'], 
            $book_data['publication_date'], 
            $book_data['added_by']
        );

        // Execute the query and verify it worked
        $this->assertTrue($stmt->execute(), "Failed to insert book data.");

        // Verify the book exists in the database
        $result = $this->conn->query("SELECT * FROM books WHERE title = 'Test Book'");
        $this->assertTrue($result->num_rows > 0, "The inserted book was not found in the database.");

        // Cleanup - Remove the test book from the database
        $this->conn->query("DELETE FROM books WHERE title = 'Test Book'");

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection after the test
    public function tearDown(): void
    {
        $this->conn->close();
    }
}
