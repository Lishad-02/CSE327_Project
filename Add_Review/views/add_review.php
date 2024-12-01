<?php
/**
 * @file add_review.php
 * @brief View for adding a review for a book.
 *
 * @details Displays a form where users can submit their review for a book.
 */

require_once __DIR__ . '/../config.php';  // Include the configuration file for DB connection
require_once __DIR__ . '/../models/review_model.php';  // Include the review model

// Initialize the review model
$review_model = new review_model();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the POST request
    $book_id = $_POST['book_id'];
    $user_id = $_POST['user_id'];
    $review_text = $_POST['review_text'];
    $rating = $_POST['rating'];

    try {
        // Add the review to the database
        $review_model->add_review($book_id, $user_id, $review_text, $rating);
        echo "Review added successfully!";
    } catch (Exception $e) {
        // If an error occurs, display the error message
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review</title>

    <!-- Internal CSS -->
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        /* Container */
        .container {
            width: 60%;
            margin: 0 auto;
            max-width: 1200px;
        }

        /* Header */
        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        /* Form Section */
        .form-section {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
        }

        .form-section label {
            font-size: 1rem;
            display: block;
            margin-bottom: 10px;
        }

        .form-section input,
        .form-section select,
        .form-section textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .form-section textarea {
            height: 150px;
            resize: vertical;
        }

        /* Button Styles */
        button {
            background-color: #5cb85c;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #4cae4c;
        }

        /* Footer Section */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            margin-top: 40px;
        }

        footer p {
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            h1 {
                font-size: 2rem;
            }

            .form-section label {
                font-size: 0.9rem;
            }

            .form-section input,
            .form-section select,
            .form-section textarea {
                font-size: 0.9rem;
            }

            button {
                font-size: 0.9rem;
                padding: 10px 18px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Add Your Review</h1>

        <div class="form-section">
            <form action="add_review.php" method="POST">
                <label for="book_id">Book ID:</label>
                <input type="text" name="book_id" id="book_id" required>

                <label for="user_id">User ID:</label>
                <input type="text" name="user_id" id="user_id" required>

                <label for="review_text">Review:</label>
                <textarea name="review_text" id="review_text" required></textarea>

                <label for="rating">Rating (1-5):</label>
                <input type="number" name="rating" id="rating" min="1" max="5" required>

                <button type="submit">Submit Review</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Library Management System</p>
    </footer>

</body>
</html>
