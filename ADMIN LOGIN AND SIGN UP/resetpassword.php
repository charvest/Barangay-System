<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icon.png" type="image/x-icon">
    <link rel="stylesheet" href="resetpass.css">
    <title>Barangay Kalawaan - Reset Password</title>
</head>
<body>
    <div class="login-signup-form">
        <div class="image-section">
            <img src="2.1.png" alt="Reset Password Image">
        </div>
        <div class="form-section">
            <div class="form-container">
                <img src="Barangay.png" alt="Barangay-Logo" class="Logo">
                <h1>Reset Your Password</h1>
                <form id="resetPasswordForm" action="resetpass.php" method="post">
                    <input type="email" name="email" placeholder="Enter your email" required>
                
                    <div class="password-wrapper">
                        <input type="password" name="new_password" id="newPassword" placeholder="Enter your new password" required>
                    </div>
                
                    <div class="password-wrapper">
                        <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm your new password" required>
                    </div>
                
                    <div class="custom-alert" id="successAlert">
                        ✔ Password reset successful!
                    </div>
                    <div class="custom-alert error" id="errorAlert">
                        ✘ Error: Passwords do not match or are invalid.
                    </div>
                
                    <button class="btn" type="submit">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- JavaScript for password reset form -->
    <script src="resetpass.js"></script>
</body>
</html>
