<?php

/**
 * @file index.php
 * The main purpose of this file is to handle book borrowing requests by routing them to the appropriate methods in the borrow_controller.
 * 
 * @date 21-11-2024
 * 
 * @author Md Aurongojeb Lishad
 */

require_once 'config/database.php';
require_once 'controllers/borrow_controller.php';

/**
 * @class borrow_handler
 * @brief Handles book borrowing requests by routing them to the different borrow_controller methods.
 *  
 * 
 */
class borrow_handler
{

    /**
     * @var borrow_controller $controller
     * Instance of the borrow_controller to handle book borrowing operations.
     */
    private $controller;

    /**
     * @brief Constructor to initialize the borrow_controller .
     */
    public function __construct()
    {
        $this->controller = new borrow_controller();
    }


    /**
     * @brief This function handles the HTTP request and routes it to the appropriate controller method.
     * 
     * If the request method is POST, it calls the borrow_book() method to process the borrowing request.
     * Otherwise, it calls the show_borrow_form() method to display the book borrowing form.
     */
    public function handle_request()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Call the borrow_book method to process the borrowing request.
            $this->controller->borrow_book();
        } else {

            // Call the show_borrow_form method to display the borrow form.
            $this->controller->show_borrow_form();
        }
    }
}

// create object of the borrow_handler class and handle the request.
$borrow_handler = new borrow_handler();
$borrow_handler->handle_request();
