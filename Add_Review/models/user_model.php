<?php
/**
 * Model for managing users.
 *
 * @package library_management_system
 */

require_once '../config.php';

class user_model 
{
    /**
     * Retrieves a user by their ID.
     *
     * @param int $user_id User ID.
     * @return array|bool Associative array of user details or false on failure.
     */
    public function get_user_by_id($user_id) 
    {
        global $conn;
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Adds a new user to the database.
     *
     * @param string $name User's name.
     * @param string $email User's email.
     * @return bool True on success, false otherwise.
     */
    public function add_user($name, $email) 
    {
        global $conn;
        $query = "INSERT INTO users (name, email) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $name, $email);
        return $stmt->execute();
    }
}
?>
