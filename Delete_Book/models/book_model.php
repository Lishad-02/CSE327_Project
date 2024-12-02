<?php
require_once '../database.php';

class BookModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->get_connection();
    }

    public function get_book_by_id($book_id)
    {
        $query = "SELECT * FROM books WHERE book_id = :book_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete_book($book_id)
    {
        $query = "DELETE FROM books WHERE book_id = :book_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':book_id', $book_id);
        return $stmt->execute();
    }
}
?>
