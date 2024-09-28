<?php

require_once 'User.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Previous code...

        if ($user->createUser($first_name, $last_name, $email, $username, $password)) {
            header("Location: login.php");
            exit;
        } else {
            echo "Failed to register user.";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
