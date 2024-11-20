<?php
use PHPUnit\Framework\TestCase;

require_once 'controllers/book_controller.php';
require_once 'models/book.php';
require_once 'config/database.php';

class BookControllerTest extends TestCase
{
    private $controller;

    protected function setUp(): void
    {
        // Create a mock database connection
        $mockDatabaseConnection = $this->createMock(database_connection::class);
        $mockDbConnection = $this->createMock(mysqli::class);
        
        // Mock the get_connection method to return the mocked DB connection
        $mockDatabaseConnection->method('get_connection')
                               ->willReturn($mockDbConnection);

        // Create a mock book model
        $mockBook = $this->createMock(book::class);

        // Instantiate the controller with the mocked database connection
        $this->controller = new book_controller();

        // Use reflection to access the private $book property
        $reflection = new ReflectionClass($this->controller);
        $property = $reflection->getProperty('book');
        $property->setAccessible(true);

        // Set the mock book model to the private $book property
        $property->setValue($this->controller, $mockBook);
    }

    public function testSearchBooksReturnsResults(): void
    {
        // Prepare the mock data that the mocked book model should return
        $mockBooks = [
            ['title' => 'Book 1', 'author' => 'Author 1', 'genre' => 'Fiction', 'available_copies' => 3],
            ['title' => 'Book 2', 'author' => 'Author 2', 'genre' => 'Science', 'available_copies' => 5],
        ];

        // Configure the mock to return the mock books
        $this->controller->book
            ->expects($this->once()) // Ensure the method is called once
            ->method('search_books_by_title_or_author')
            ->with($this->equalTo('Book')) // Ensure the method is called with the correct argument
            ->willReturn($mockBooks);

        // Call the method under test
        $result = $this->controller->search_books('Book');

        // Assert that the result contains the mock data
        $this->assertNotNull($result);
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertEquals('Book 1', $result[0]['title']);
    }

    public function testSearchBooksReturnsNoResults(): void
    {
        // Configure the mock to return an empty array (no results)
        $this->controller->book
            ->expects($this->once()) // Ensure the method is called once
            ->method('search_books_by_title_or_author')
            ->with($this->equalTo('Nonexistent Book')) // Ensure correct argument
            ->willReturn([]);

        // Call the method under test
        $result = $this->controller->search_books('Nonexistent Book');

        // Assert that the result is an empty array
        $this->assertEmpty($result);
    }

    public function testSearchBooksWithEmptyTermReturnsEmpty(): void
    {
        // Call the method under test with an empty search term
        $result = $this->controller->search_books('');

        // Assert that the result is an empty array
        $this->assertEmpty($result);
    }
}
?>
