<?php

require_once 'Database.php';

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($fname, $lname, $email, $username, $password) {
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        // Validate password length
        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long");
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement
        $sql = "INSERT INTO users (fname, lname, email, username, password) 
                VALUES (:fname, :lname, :email, :username, :password)";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);

        // Execute the statement
        return $stmt->execute();
    }

    public function readUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
