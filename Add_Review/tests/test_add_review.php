<?php
/**
 * Test file for Add Review functionality.
 *
 * @package library_management_system
 */

require_once '../models/review_model.php';

function test_add_review() 
{
    $review_model = new review_model();
    $result = $review_model->add_review(1, 1, 'Great book!', 5);

    if ($result) 
    {
        echo "Test passed: Review added successfully.";
    } 
    else 
    {
        echo "Test failed: Unable to add review.";
    }
}

test_add_review();
?>
