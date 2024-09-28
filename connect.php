<?php

require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $database = new Database();
    $db = $database->connect();
    $user = new User($db);

    if ($user->createUser($first_name, $last_name, $email, $username, $password)) {
        echo "User registered successfully!";
    } else {
        echo "Failed to register user.";
    }
}

?>
