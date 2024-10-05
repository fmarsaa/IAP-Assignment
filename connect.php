<?php
require_once 'user.php'; // Include the user class
require_once 'Database.php';

// Establish a connection to the database
$database = new Database();
$conn = $database->connect();

$user = new User($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Capture the form input
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validate password match
        if ($password !== $confirm_password) {
            throw new Exception("Passwords do not match.");
        }

        // Create a new user and send the verification code
        if ($user->createUser($fname, $lname, $email, $username, $password)) {
            echo "User registered successfully! Please check your email for the verification code.";
        } else {
            echo "Error registering user.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
