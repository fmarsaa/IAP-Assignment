<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($first_name, $last_name, $email, $username, $password) {
        $sql = "INSERT INTO users (first_name, last_name, email, username, password) 
                VALUES (:first_name, :last_name, :email, :username, :password)";
        $stmt = $this->conn->prepare($sql);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

?>
