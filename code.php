<?php
session_start();
require_once 'Database.php';

class Verification {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function verifyCode($userId, $inputCode) {
        $sql = "SELECT code FROM verification_codes WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId);

        if (!$stmt->execute()) {
            return "Database error: " . implode(", ", $stmt->errorInfo());
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $code = $row['code'];
            if ($inputCode === $code) {
                $this->updateVerificationStatus($userId);
                header("Location: login.html");
                exit();
            } else {
                return "Invalid verification code.";
            }
        } else {
            return "No verification code found.";
        }
    }

    private function updateVerificationStatus($userId) {
        $sql = "UPDATE registration SET is_verified = 1 WHERE id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    }
}

class VerificationHandler {
    private $verification;

    public function __construct($db) {
        $this->verification = new Verification($db);
    }

    public function handleVerification($userId, $digits) {
        $inputCode = implode("", $digits); // Combine digits into a single code
        return $this->verification->verifyCode($userId, $inputCode);
    }
}

if (!isset($_SESSION['user_id'])) {
    echo "User ID not found. Session data: " . print_r($_SESSION, true);
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ensure all digits are set
    $digits = [
        $_POST['digit1'] ?? '',
        $_POST['digit2'] ?? '',
        $_POST['digit3'] ?? '',
        $_POST['digit4'] ?? ''
    ];

    // Optional: Check if any digit is empty
    if (in_array('', $digits)) {
        echo "Please fill in all fields.";
        exit();
    }

    $verificationHandler = new VerificationHandler($db);
    $result = $verificationHandler->handleVerification($userId, $digits);

    if ($result) {
        echo $result; 
    }
}
