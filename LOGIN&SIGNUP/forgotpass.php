<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icon.png" type="image/x-icon">
    <link rel="stylesheet" href="forgotpass.css"> <!-- External CSS -->
    <title>Barangay Kalawaan - Forgot Password</title>
</head>
<body>
    <div class="login-signup-form">
        <div class="image-section">
            <img src="login1.webp" alt="Forgot Password Image">
        </div>
        <div class="form-section">
            <div class="form-container">
                <img src="Barangay.png" alt="Barangay Logo" class="Logo">
                <h1>Forgot your password?</h1>
                <p>Please enter your email address to receive an OTP for resetting your password.</p>
                
                <!-- Email Form for OTP Submission -->
                <form id="forgotPasswordForm" action="sendmail.php" method="post">
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <button type="submit" class="btn">Send OTP</button>
                </form>

                <!-- Alerts -->
                <div class="custom-alert" id="successAlert">
                    ✔ OTP sent successfully! Please check your email.
                </div>
                <div class="custom-alert error" id="errorAlert">
                    ✘ Error: Unable to send OTP. Please try again.
                </div>

                <p class="account">Remember your password? <a href="../LOGIN&SIGNUP/loginpage.php">Login</a></p>
            </div>
        </div>
    </div>

    <!-- External JS -->
    <script src="forgotpass.js"></script>
</body>
</html>
