<?php
class Member {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register a new member
    public function register($username, $password) {
        $query = "INSERT INTO members (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashedPassword);

        return $stmt->execute();
    }

    // Login a member
    public function login($username, $password) {
        $query = "SELECT id, password FROM members WHERE username = :username AND status = 'active'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user['id']; // Return member ID if login is successful
        }
        return false;
    }
}
?>
