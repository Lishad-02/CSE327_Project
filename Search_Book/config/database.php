<?php

/** 
 * Database connection configuration
 * 
 * This file contains the settings required to connect to the database.
 */

class database_connection
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'library_db2';
    private $connection;

    /**
     * Establish a database connection
     *
     * @return mysqli
     */
    public function get_connection()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        return $this->connection;
    }
}
?>
