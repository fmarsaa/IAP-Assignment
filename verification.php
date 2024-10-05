<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Code | My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f9f9f9; }
        .verification-wrapper { max-width: 400px; margin: 80px auto; background-color: white; padding: 30px; text-align: center; }
        .code-input input { width: 60px; height: 60px; font-size: 24px; text-align: center; }
        .resend-link { margin-top: 15px; }
    </style>
</head>
<body>

    <div class="verification-wrapper">
        <h2 class="form-title">Enter Verification Code</h2>
        <p class="form-subtitle">We have sent a 4-digit code to your email. Please enter it below.</p>

        <form action="https://localhost/ASSIGNMENT2/code.php" method="POST">
            <div class="code-input">
                <input type="text" maxlength="1" name="digit1" required>
                <input type="text" maxlength="1" name="digit2" required>
                <input type="text" maxlength="1" name="digit3" required>
                <input type="text" maxlength="1" name="digit4" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-4">Verify</button>
        </form>

        <div class="resend-link">
            <a href="resend_code.php">Resend Code</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
