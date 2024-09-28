<?php

require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Previous code...

    if ($user->createUser($first_name, $last_name, $email, $username, $password)) {
        echo "User registered successfully!";
        $users = $user->readUsers();
        echo "<pre>";
        print_r($users);
        echo "</pre>";
    } else {
        echo "Failed to register user.";
    }
}

?>
