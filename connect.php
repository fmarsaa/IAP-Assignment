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
        header("Location: login.php");
        exit;
    } else {
        echo "Failed to register user.";
    }
}

?>
