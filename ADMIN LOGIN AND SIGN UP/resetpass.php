<?php
session_start();

// Database connection details
$servername = "localhost";  
$username = "root";        
$password = "";             
$dbname = "baranggay_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

if (isset($_POST['email'], $_POST['new_password'], $_POST['confirm_password'])) {
    // Sanitize and validate inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format."]);
        exit();
    }

    if ($newPassword !== $confirmPassword) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match."]);
        exit();
    }

    if (strlen($newPassword) < 8) {
        echo json_encode(["status" => "error", "message" => "Password must be at least 8 characters long."]);
        exit();
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // Check if the email exists
    $sql = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "SQL error: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email exists, update the password
        $update_sql = "UPDATE admin SET password = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);
        if ($update_stmt === false) {
            echo json_encode(["status" => "error", "message" => "SQL error: " . $conn->error]);
            exit();
        }

        $update_stmt->bind_param("ss", $hashedPassword, $email);
        $update_stmt->execute();

        echo json_encode(["status" => "success", "message" => "Password reset successful!"]);
    } else {
        // Email not found
        echo json_encode(["status" => "error", "message" => "Email not found."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "All fields are required."]);
}

$conn->close();
?>
