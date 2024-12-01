<?php
/**
 * @file add_book.php
 * @brief This file handles adding a new book to the database.
 *
 * @details This script processes the form submission to insert new book details
 * into the database. It collects data from the user input, sanitizes it to
 * prevent SQL injection, and then inserts the book data into the 'books' table.
 * If successful, it displays a success message with a link to go back to the home page.
 * If there is an error, the error message is displayed.
 */

// Include the database connection file
include('db_connection.php');

// Check if the form has been submitted
if (isset($_POST['submit'])) {

    /**
     * @var string $book_title The title of the book provided by the user.
     * @var string $book_author The author of the book provided by the user.
     * @var string $book_genre The genre of the book provided by the user.
     * @var string $book_description The description of the book provided by the user.
     * @var string $publication_date The publication date of the book provided by the user.
     */
    
    // Sanitize form data to prevent SQL injection
    $book_title = mysqli_real_escape_string($conn, $_POST['title']);
    $book_author = mysqli_real_escape_string($conn, $_POST['author']);
    $book_genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $book_description = mysqli_real_escape_string($conn, $_POST['description']);
    $publication_date = $_POST['publication_date'];

    // SQL query to insert the book data into the 'books' table
    $sql = "INSERT INTO books (title, author, genre, description, publication_date, added_on)
            VALUES ('$book_title', '$book_author', '$book_genre', '$book_description', '$publication_date', NOW())";

    // Execute the query and check if it was successful
    if ($conn->query($sql) === TRUE) {
        // If successful, display a success message with a link to the home page
        echo "New book added successfully. <a href='index.php'>Go back to Home</a>";
    } else {
        // If there's an error, display the error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
