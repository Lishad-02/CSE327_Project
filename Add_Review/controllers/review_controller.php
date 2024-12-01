<?php
/**
 * Controller for managing reviews.
 *
 * @package library_management_system
 */

require_once '../models/review_model.php';

class review_controller 
{
    private $review_model;

    /**
     * Constructor to initialize the review model.
     */
    public function __construct() 
    {
        $this->review_model = new review_model();
    }

    /**
     * Adds a review based on user input.
     *
     * @param int $book_id Book ID.
     * @param int $user_id User ID.
     * @param string $review_text Review content.
     * @param int $rating Rating score.
     * @return void
     */
    public function add_review($book_id, $user_id, $review_text, $rating) 
    {
        if ($this->review_model->add_review($book_id, $user_id, $review_text, $rating)) {
            header("Location: ../views/success.php");
        } else {
            header("Location: ../views/error.php");
        }
    }
}
?>
