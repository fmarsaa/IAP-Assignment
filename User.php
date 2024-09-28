<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($first_name, $last_name, $email, $username, $password) {
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        // Validate password length
        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long");
        }

        $sql = "INSERT INTO users (first_name, last_name, email, username, password) 
                VALUES (:first_name, :last_name, :email, :username, :password)";
        $stmt = $this->conn->prepare($sql);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);

        return $stmt->execute();
    }
}

?>
