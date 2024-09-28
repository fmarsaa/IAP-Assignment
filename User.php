<?php

require_once 'Database.php';

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($first_name, $last_name, $email, $username, $password) {
        
    }

    public function readUsers() {
        
    }
}

?>
