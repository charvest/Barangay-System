<?php
session_start();
// If user is already logged in, redirect to homepage
if (isset($_SESSION['email'])) {
    header("Location: ../HOMEPAGE/Index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="icon.png" type="image/x-icon" />
    <link rel="stylesheet" href="login.css" />
    <title>Barangay Kalawaan</title>
  </head>
  <body>
    
    <div class="login-signup-form">
      <div class="image-section">
        <img src="login1.webp" alt="Login Image" />
      </div>
      <div class="form-section">
        <div class="form-container">
          <img src="Barangay.png" alt="Barangay-Logo" class="Logo" />
          <h1>Barangay Kalawaan</h1>
          <form id="loginForm" action="login.php" method="post">
            <input
              type="text"
              name="username"
              placeholder="Enter your username"
              required
           />
            <input
              type="email"
              name="email"
              placeholder="Enter your email"
              required
            />

            <!-- Password Input with Visibility Toggle -->
            <div class="password-wrapper">
              <input
                type="password"
                name="password"
                id="loginPassword"
                placeholder="Enter your password"
                required
              />
            </div>

            <!-- Forgot Password Link -->
            <div class="forgot-password">
              <a href="forgotpass.php" id="forgotPasswordLink"
                >Forgot your password?</a
              >
            </div>

            <!-- Custom Alert for success (Hidden by default) -->
            <div class="custom-alert" id="successAlert">
              ✔ Success! Login successful.
            </div>

            <!-- Custom Alert for errors (Hidden by default) -->
            <div class="custom-alert error" id="errorAlert">
              ✘ Error: Invalid email or password.
            </div>

            <button class="btn" type="submit">Login</button>
            <p class="account">
              Don’t have an account? <a href="Signup.php">Sign up</a>
            </p>
          </form>
        </div>
      </div>
    </div>

    <!-- JavaScript for login form -->
    <script src="login.js"></script>
  </body>
</html>
