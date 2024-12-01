<?php

/**
 * @file database.php
 * @brief The purpose of this file is to establish a connection to the MySQL database for Search operatrion
 * 
 * @date 30-11-2024
 * 
 * @author Md Aurongojeb Lishad
 */


/** 
 * Class database_connection
 * This class handles the connection to the MySQL database for the earch operatrion*/
class database_connection
{
    /**
     * @var string "host" The hostname of the database 
     */
    private $host = 'localhost';
    /**
     * @var string "username" The username for accessing the database 
     */
    private $username = 'root';
    /**
     * @var string "password" The password for the database 
     */
    private $password = '';
    /**
     * @var string "db_name"--> The name of the database 
     */
    private $db_name = 'library_db2';

    /**
     * 
     * This method creates a new "mysqli" object to connect to the database using the 
     * specifisic host, username, password, and database name.If the connection fails, 
     * an error message will arrise, and the script will stops.
     * 
     * @return mysqli  (mysqli represent the database connection.)
     * 
     */
    public function connect_to_database()
    {
        $connection = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($connection->connect_error) {
            die("Database connection failed: " . $connection->connect_error);
        }

        return $connection;
    }
}
