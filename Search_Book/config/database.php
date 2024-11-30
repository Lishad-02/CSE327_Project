<?php

/**
 * Database Connection
 * 
 * Handles the connection to the database.
 */

class database_connection
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'library_db2';

    /**
     * Establish a database connection.
     *
     * @return mysqli
     */
    public function connect_to_database()
    {
        $connection = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($connection->connect_error)
        {
            die("Database connection failed: " . $connection->connect_error);
        }

        return $connection;
    }
}
?>
