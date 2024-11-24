<?php
session_start();
include('dbconfig.php');  // Include database configuration

// Add cache-control headers to prevent browser from caching the login page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
header('Content-Type: application/json');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for missing fields
    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit();
    }

    // Query to check user credentials
    $sql = "SELECT * FROM admin WHERE username = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === FALSE) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
        exit();
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];

            // Successful login
            echo json_encode(["status" => "success", "message" => "Login successful", "redirect" => "../ADMIN/Admin.php"]);
        } else {
            // Invalid password
            echo json_encode(["status" => "invalid_password", "message" => "Invalid password"]);
        }
    } else {
        // Invalid username or email
        echo json_encode(["status" => "invalid_credentials", "message" => "Username or email not found."]);
    }
}
?>
