<?php
class Book {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Search for books
    public function search($keyword) {
        $query = "SELECT * FROM books WHERE title LIKE :keyword OR author LIKE :keyword";
        $stmt = $this->conn->prepare($query);
        $searchTerm = "%" . $keyword . "%";
        $stmt->bindParam(":keyword", $searchTerm);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Check book availability
    public function checkAvailability($bookId) {
        $query = "SELECT available FROM books WHERE id = :bookId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":bookId", $bookId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (bool) $result['available'] : false;
    }
}
?>
