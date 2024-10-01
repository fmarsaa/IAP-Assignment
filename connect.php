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
        echo "<div class='alert alert-success text-center' role='alert'>
                Signup was successful! You can now log in.
              </div>";
    } else {
        echo "<div class='alert alert-danger text-center' role='alert'>
                Failed to register user. Please try again.
              </div>";
    }
    $confirm_password = $_POST['confirm_password'];
    
    if ($password !== password_hash($confirm_password, PASSWORD_DEFAULT)) {
        echo "Passwords do not match.";
        exit();
    }
    $query = "SELECT * FROM registration WHERE email = :email";
$stmt = $db->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "Email already registered.";
    exit();
}

}

?>
