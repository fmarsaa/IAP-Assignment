<?php

require_once 'Database.php';

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($fname, $lname, $email, $username, $password) {
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        
        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long");
        }

        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $sql = "INSERT INTO registration (fname, lname, email, username, password) 
                VALUES (:fname, :lname, :email, :username, :password)";
        $stmt = $this->conn->prepare($sql);

        
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);

        
        return $stmt->execute();
    }


}

?>
