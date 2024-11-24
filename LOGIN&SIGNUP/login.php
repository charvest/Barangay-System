<?php
session_start();
include('../LOGIN&SIGNUP/dbconfig.php');  // Include database configuration

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
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit();
    }

    // Query to check user credentials in the `users` table
    $sql = "SELECT * FROM users WHERE username = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
        exit();
    }
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];

            // Successful login
            echo json_encode([
                "status" => "success",
                "message" => "Login successful",
                "redirect" => "../HOMEPAGE/index.php"
            ]);
        } else {
            echo json_encode(["status" => "invalid_password", "message" => "Invalid password"]);
        }
    } else {
        echo json_encode(["status" => "invalid_credentials", "message" => "Invalid username or email"]);
    }

    $stmt->close();
}

?>