<?php

require_once 'User.php';
require_once 'Database.php';

$database = new Database();
$conn = $database->connect();

$user = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user->createUser($fname, $lname, $email, $username, $password)) {
        // Instead of redirecting, display a success message using Bootstrap
        echo "<div class='alert alert-success text-center' role='alert'>
                Signup was successful! You can now log in.
              </div>";
    } else {
        echo "<div class='alert alert-danger text-center' role='alert'>
                Failed to register user. Please try again.
              </div>";
    }
}

?>
