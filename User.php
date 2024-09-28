<?php

require_once 'Database.php';

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($first_name, $last_name, $email, $username, $password) {
        // Prepare SQL statement
        $sql = "INSERT INTO users (first_name, last_name, email, username, password) 
                VALUES (:first_name, :last_name, :email, :username, :password)";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        
        return $stmt->execute();
    }

    public function readUsers() {
        
    }
}

?>
