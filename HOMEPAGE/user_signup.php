<?php
// Database configuration
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "baranggay_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $email = $_POST['email'];
    $username = $_POST['username']; 
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if username already exists
    $check_username = "SELECT username FROM users WHERE username = '$username'";
    $result_username = $conn->query($check_username);

    if ($result_username->num_rows > 0) {
        echo "username_taken"; // Return 'username_taken' if username already exists
        exit();
    }

    // Check if email already exists
    $check_email = "SELECT email FROM users WHERE email = '$email'";
    $result_email = $conn->query($check_email);

    if ($result_email->num_rows > 0) {
        echo "email_taken"; // Return 'email_taken' if email already exists
        exit();
    }

    // Password validation: Require at least one lowercase and one uppercase letter
    $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z]).{6,}$/";

    // Validation: Check if passwords match
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Validation: Check password strength (only uppercase and lowercase letter check)
    if (!preg_match($passwordRegex, $password)) {
        die("Password must contain at least one uppercase and one lowercase letter.");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Get the current date
    $date = date('Y-m-d H:i:s');

    // Insert the data into the users table
    $sql = "INSERT INTO users (email, username, password, date)
            VALUES ('$email', '$username', '$hashed_password', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "success"; // Return 'success' when the registration is successful
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
