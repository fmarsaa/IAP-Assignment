<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($first_name, $last_name, $email, $username, $password) {
        // Previous code...
    }

    public function readUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
