<?php
include('db_connection.php');

if (isset($_POST['submit'])) 
{
    // Get form data
    $book_title = mysqli_real_escape_string($conn, $_POST['title']);
    $book_author = mysqli_real_escape_string($conn, $_POST['author']);
    $book_genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $book_description = mysqli_real_escape_string($conn, $_POST['description']);
    $publication_date = $_POST['publication_date'];

    // Insert data into the books table
    $sql = "INSERT INTO books (title, author, genre, description, publication_date, added_on)
            VALUES ('$book_title', '$book_author', '$book_genre', '$book_description', '$publication_date', NOW())";

    if ($conn->query($sql) === TRUE) 
    {
        echo "New book added successfully. <a href='index.php'>Go back to Home</a>";
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
