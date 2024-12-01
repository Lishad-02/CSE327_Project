<?php
// Include the config file for database connection
require_once('../config.php');

// Handle POST request to add review
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $user_id = $_POST['user_id']; // Typically from session or user data
    $review_text = $_POST['review_text'];
    $rating = $_POST['rating'];

    // Check if the user exists
    $check_user_query = "SELECT id FROM users WHERE id = $user_id";
    $check_user_result = $conn->query($check_user_query);

    if ($check_user_result->num_rows == 0) {
        // User does not exist
        echo "The user does not exist!";
    } else {
        // Check if the book exists
        $check_book_query = "SELECT id FROM books WHERE id = $book_id";
        $check_book_result = $conn->query($check_book_query);

        if ($check_book_result->num_rows == 0) {
            // Book does not exist
            echo "The book does not exist!";
        } else {
            // Prevent duplicate reviews for the same book and user
            $check_review_query = "SELECT * FROM reviews WHERE book_id = $book_id AND user_id = $user_id";
            $check_review_result = $conn->query($check_review_query);

            if ($check_review_result->num_rows > 0) {
                echo "You have already submitted a review for this book.";
            } else {
                // Insert the new review into the database
                $insert_review_query = "INSERT INTO reviews (book_id, user_id, review_text, rating)
                                        VALUES ('$book_id', '$user_id', '$review_text', '$rating')";

                if ($conn->query($insert_review_query) === TRUE) {
                    echo "Your review has been submitted successfully!";
                } else {
                    echo "Error: " . $conn->error;
                }
            }
        }
    }
}
?>

<!-- HTML Form for adding a review -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a Book Review</title>
</head>
<body>
    <h2>Write a Book Review</h2>
    <form method="POST" action="add_review.php">
        <label for="book_id">Book ID:</label><br>
        <input type="text" id="book_id" name="book_id" required><br><br>

        <label for="user_id">User ID:</label><br>
        <input type="text" id="user_id" name="user_id" required><br><br>

        <label for="review_text">Review:</label><br>
        <textarea id="review_text" name="review_text" required></textarea><br><br>

        <label for="rating">Rating (1-5):</label><br>
        <input type="number" id="rating" name="rating" min="1" max="5" required><br><br>

        <input type="submit" value="Submit Review">
    </form>
</body>
</html>
