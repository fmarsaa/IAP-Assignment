<?php

require_once 'User.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Previous code...

        if ($user->createUser($first_name, $last_name, $email, $username, $password)) {
            echo "User registered successfully!";
        } else {
            echo "Failed to register user.";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
