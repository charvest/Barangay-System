<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="signup.css" />
    <!-- SIGN UP IN CSS -->
    <link rel="icon" href="icon.png" type="image/png" />
    <!-- ICON TO -->
    <title>Barangay Kalawaan</title>
    <!-- TITLE SA WEBPAGE -->
  </head>
  <body>
    <div class="login-signup-form">
      <div class="form-section">
        <div class="form-container">
          <!-- BARANGAY KALAWAAN PO ITO PICTURE NA TO -->
          <img src="Barangay.png" alt="Barangay-Logo" class="Logo" />
          <h1>Barangay Kalawaan</h1>
          <form id="signupForm" action="user_signup.php" method="post">
            <input
              type="text"
              name="username"
              placeholder="Enter your username"
              required
            />
            <!-- Added Username Field -->
            <input
              type="email"
              name="email"
              placeholder="Enter your email"
              required
            />

            <!-- Password Field with Eye Icon -->
            <div class="password-wrapper">
              <input
                type="password"
                name="password"
                id="password"
                placeholder="Create password"
                required
              />
              <span
                class="toggle-password"
                onclick="togglePasswordVisibility('password', 'togglePasswordIcon')"
              >
                <svg
                  id="togglePasswordIcon"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  width="24"
                  height="24"
                  class="eye-icon"
                >
                  <!-- Slashed eye icon initially (password hidden) -->
                  <path
                    d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 12a4.5 4.5 0 110-9 4.5 4.5 0 010 9zM2 12l4-4m6 0l-4 4"
                  ></path>
                </svg>
              </span>
            </div>

            <!-- Confirm Password Field with Eye Icon -->
            <div class="password-wrapper">
              <input
                type="password"
                name="confirm_password"
                id="confirm_password"
                placeholder="Confirm your password"
                required
              />
              <span
                class="toggle-password"
                onclick="togglePasswordVisibility('confirm_password', 'toggleConfirmPasswordIcon')"
              >
                <svg
                  id="toggleConfirmPasswordIcon"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  width="24"
                  height="24"
                  class="eye-icon"
                >
                  <!-- Slashed eye icon initially (password hidden) -->
                  <path
                    d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 12a4.5 4.5 0 110-9 4.5 4.5 0 010 9zM2 12l4-4m6 0l-4 4"
                  ></path>
                </svg>
              </span>
            </div>

            <!-- Alert box for success message -->
            <div class="custom-alert" id="successAlert">
              ✔ Success! Sign up successful.
            </div>

            <!-- Alert box for errors (password length, username taken, etc.) -->
            <div class="custom-alert error" id="errorAlert">
              ✘ Error: Something went wrong.
            </div>

            <button class="btn" type="submit">Sign up</button>
            <p class="account">
              Already have an account? <a href="../LOGIN&SIGNUP/loginpage.php">Login</a>
            </p>
            <!-- ALREADY AN ACCOUNT TO  -->
          </form>
        </div>
      </div>
      <!-- PICTURE PO ITO  -->
      <div class="image-section">
        <img src="login1.webp" alt="Sign Up Image" />
        <!-- SIGN UP IMAGE -->
      </div>
    </div>

    <!-- JavaScript to Toggle Password Visibility -->
    <script>
      function togglePasswordVisibility(passwordFieldId, iconId) {
          const passwordField = document.getElementById(passwordFieldId);
          const icon = document.getElementById(iconId);
          const eyeIcon = `
              <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 12a4.5 4.5 0 110-9 4.5 4.5 0 010 9zM12 9a3 3 0 100 6 3 3 0 000-6z"></path>`;
          const eyeSlashIcon = `
              <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 12a4.5 4.5 0 110-9 4.5 4.5 0 010 9zM2 12l4-4m6 0l-4 4"></path>`;

          if (passwordField.type === 'password') {
              passwordField.type = 'text';
              icon.innerHTML = eyeIcon; // Regular eye icon for "show password"
          } else {
              passwordField.type = 'password';
              icon.innerHTML = eyeSlashIcon; // Eye slash icon for "hide password"
          }
      }
    </script>
    <script src="signup.js"></script>
  </body>
</html>
