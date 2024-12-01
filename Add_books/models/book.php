<?php

class Book
{
    /**
     * Adds a new book to the database.
     *
     * @param array $book_data An associative array with keys: title, author, genre, description, publication_date.
     * @return bool True on success, false otherwise.
     */
    public function add_new_book($book_data)
    {
        global $conn;

        $query = "INSERT INTO books (title, author, genre, description, publication_date, added_by)
                  VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param
        (
            "ssssss",
            $book_data['title'],
            $book_data['author'],
            $book_data['genre'],
            $book_data['description'],
            $book_data['publication_date'],
            $book_data['added_by']
        );

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}
?>
