<?php

require_once 'Database.php';

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($first_name, $last_name, $email, $username, $password) {
        // Code to store user in database will be added later
    }
}

// Create a new user instance
$database = new Database();
$db = $database->connect();
$user = new User($db);

?>
