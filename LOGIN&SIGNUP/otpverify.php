<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icon.png" type="image/x-icon">
    <link rel="stylesheet" href="otpverify.css"> <!-- External CSS -->
    <title>Barangay Kalawaan - Verify OTP</title>
</head>
<body>
    <div class="login-signup-form">
        <div class="image-section">
            <img src="login1.webp" alt="Verify OTP Image">
        </div>
        <div class="form-section">
            <div class="form-container">
                <img src="Barangay.png" alt="Barangay Logo" class="Logo">
                <h1>Enter OTP</h1>
                <p>Please enter the OTP sent to your email to verify your account.</p>
                
                <!-- OTP Verification Form -->
                <form id="otpVerifyForm" action="verifyotp.php" method="post">
                    <div class="otp-inputs">
                        <input type="text" maxlength="1" class="otp" name="digit-1" required>
                        <input type="text" maxlength="1" class="otp" name="digit-2" required>
                        <input type="text" maxlength="1" class="otp" name="digit-3" required>
                        <input type="text" maxlength="1" class="otp" name="digit-4" required>
                        <input type="text" maxlength="1" class="otp" name="digit-5" required>
                        <input type="text" maxlength="1" class="otp" name="digit-6" required>
                    </div>

                    <button type="submit" class="btn">Verify OTP</button>
                </form>

                <!-- Alerts -->
                <div class="custom-alert" id="successAlert">
                    ✔ OTP verified successfully! You can now reset your password.
                </div>
                <div class="custom-alert error" id="errorAlert">
                    ✘ Error: Invalid OTP or expired. Please try again.
                </div>
            </div>
        </div>
    </div>

    <!-- External JS -->
    <script src="otpverify.js"></script>
</body>
</html>