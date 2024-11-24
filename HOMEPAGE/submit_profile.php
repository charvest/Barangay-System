<?php
session_start();
include('../LOGIN&SIGNUP/dbconfig.php');  

header('Content-Type: application/json'); 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['email'])) {
    $email = filter_var($_SESSION['email'], FILTER_SANITIZE_EMAIL);
    $new_email = filter_var($_POST['email'] ?? $email, FILTER_SANITIZE_EMAIL);
    $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
    $fullname = htmlspecialchars($_POST['fullname'] ?? '', ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES, 'UTF-8');

    if (empty($username) || empty($fullname) || empty($new_email) || empty($address)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format."]);
        exit;
    }

    $emailCheckQuery = "SELECT email FROM user_profile WHERE email = ? AND email != ?";
    $stmt = $conn->prepare($emailCheckQuery);
    $stmt->bind_param("ss", $new_email, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "This email is already associated with another account."]);
        exit;
    }

    $emailCheckQuery = "SELECT email FROM users WHERE email = ? AND email != ?";
    $stmt = $conn->prepare($emailCheckQuery);
    $stmt->bind_param("ss", $new_email, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "This email is already associated with another account."]);
        exit;
    }

    $uploadDir = '../uploads/profile_pictures/';
    $profilePicturePath = htmlspecialchars($_POST['existing_profile_picture'] ?? '', ENT_QUOTES, 'UTF-8');

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png'];
        $fileType = mime_content_type($_FILES['profile_picture']['tmp_name']);
        $fileSize = $_FILES['profile_picture']['size'];

        // Check file type and size (limit to 2MB)
        if (!in_array($fileType, $allowedTypes)) {
            echo json_encode(["status" => "error", "message" => "Invalid file type. Only JPEG and PNG are allowed."]);
            exit;
        } elseif ($fileSize > 2 * 1024 * 1024) { // 2MB limit
            echo json_encode(["status" => "error", "message" => "File size must be less than 2MB."]);
            exit;
        }

        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileExt = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid() . '.' . $fileExt;
        $destPath = $uploadDir . $newFileName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $profilePicturePath = $destPath;
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload profile picture."]);
            exit;
        }
    }

    $query = "UPDATE user_profile SET email = ?, username = ?, fullname = ?, address = ?, profile_picture = ? WHERE email = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "Database error: " . htmlspecialchars($conn->error)]);
        exit;
    }

    $stmt->bind_param("ssssss", $new_email, $username, $fullname, $address, $profilePicturePath, $email);
    $profileUpdated = $stmt->execute();
    $stmt->close();

    $query = "UPDATE users SET username = ? WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $email);
    $userUpdated = $stmt->execute();
    $stmt->close();

    if ($profileUpdated && $userUpdated) {
        echo json_encode(["status" => "success", "message" => "Profile updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update profile."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request or user not logged in."]);
}
?>
