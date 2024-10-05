<?php

require_once 'Database.php';
require 'vendor/autoload.php'; 

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($fname, $lname, $email, $username, $password) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long");
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the registration table
        $sql = "INSERT INTO registration (fname, lname, email, username, password, is_verified) 
                VALUES (:fname, :lname, :email, :username, :password, 0)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            // User inserted successfully, generate and send the verification code
            $userId = $this->conn->lastInsertId();
            
            // Send verification code and redirect to verification page
            $this->sendVerificationCode($email, $userId);
            
            // Redirect to the verification page
            header("Location: verification.php");
            exit(); // Stop further execution
        }

        return false;
    }

    private function sendVerificationCode($email, $userId) {
        // Generate a four-digit verification code
        $verificationCode = random_int(1000, 9999);

        // Insert the verification code into the verification_codes table
        $sql = "INSERT INTO verification_codes (user_id, code) VALUES (:user_id, :code)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':code', $verificationCode);
        $stmt->execute();

        // Send the code via email using PHPMailer
        return $this->sendEmail($email, $verificationCode);
    }

    private function sendEmail($email, $verificationCode) {
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'fatmamarsa2@gmail.com';
            $mail->Password = 'thfj kjry nrzm zdbf';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Email content
            $mail->setFrom('fatmamarsa2@gmail.com', 'Fatma');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'HEYY LOVE <3 !!'; 
            $mail->Body = "<strong>STOP EATING SHAWARMA'S EVERYDAY: WHEN THE WORLD (ME) NEEDED HIM MOST HE VANISHED :( ATLEAST IT'S WORKING NOW:)  $verificationCode</strong>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            throw new Exception("Failed to send verification email: " . $mail->ErrorInfo);
        }
    }
}
