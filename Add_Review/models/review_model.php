<?php
/**
 * @file review_model.php
 * @brief Model for managing reviews in the library management system.
 *
 * @details Handles database operations for reviews, such as adding a new review.
 */

class review_model
{
    /**
     * @var mysqli $db_connection Database connection instance.
     */
    private $db_connection;

    /**
     * @brief Constructor to initialize the database connection.
     */
    public function __construct()
    {
        // Include the configuration file for the DB connection
        require_once __DIR__ . '/../config.php';

        global $db_connection; // Access the global $db_connection
        $this->db_connection = $db_connection;

        // Validate the connection
        if (!$this->db_connection || $this->db_connection->connect_error) {
            throw new Exception("Database connection failed: " . $this->db_connection->connect_error);
        }
    }

    /**
     * @brief Add a new review to the database.
     *
     * @param int $book_id ID of the book being reviewed.
     * @param int $user_id ID of the user submitting the review.
     * @param string $review_text The text of the review.
     * @param int $rating The rating given by the user.
     * @return bool True if the review was added successfully, false otherwise.
     */
    public function add_review($book_id, $user_id, $review_text, $rating)
    {
        $query = "
            INSERT INTO reviews (book_id, user_id, review_text, rating, review_date) 
            VALUES (?, ?, ?, ?, NOW())
        ";

        $stmt = $this->db_connection->prepare($query);
        if (!$stmt) {
            throw new Exception("Failed to prepare SQL statement: " . $this->db_connection->error);
        }

        // Bind parameters and execute the query
        $stmt->bind_param("iisi", $book_id, $user_id, $review_text, $rating);
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute SQL query: " . $stmt->error);
        }

        return true;
    }
}
?>
