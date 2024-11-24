<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baranggay_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Get the user email from session
$email = $_SESSION['email'];  
date_default_timezone_set('Asia/Manila');
$current_date = date('Y-m-d H:i:s');
$one_day_ago = date('Y-m-d H:i:s', strtotime('-1 day'));

// Check submission count in the last 24 hours
$query = $conn->prepare("SELECT COUNT(*) FROM business_permit WHERE email = ? AND submission_date >= ?");
$query->bind_param("ss", $email, $one_day_ago);
$query->execute();
$query->bind_result($submission_count);
$query->fetch();
$query->close();

if ($submission_count >= 3) {
    echo json_encode(["status" => "error", "message" => "You have reached the daily limit of 3 applications for the Business Permit."]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs to prevent XSS and malicious code injection
    $fullname = filter_var(trim($_POST['fullname']), FILTER_SANITIZE_STRING);
    $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
    $contact_number = filter_var($_POST['contact_number'], FILTER_SANITIZE_STRING);
    $business_address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
    $occupation = filter_var($_POST['occupation'], FILTER_SANITIZE_STRING);
    $pwd = filter_var($_POST['permit-pwd'], FILTER_SANITIZE_STRING);
    $email = filter_var($_SESSION['email'], FILTER_SANITIZE_EMAIL);
    $availability = filter_var($_POST['availability'], FILTER_SANITIZE_STRING);
    $purpose = filter_var(trim($_POST['purpose']), FILTER_SANITIZE_STRING);
    $submission_date = date('Y-m-d H:i:s');

    // File upload validation
    $allowedTypes = ['image/jpeg', 'image/png'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    $front_of_id_data = null;
    $back_of_id_data = null;

    // Validate files
    if (isset($_FILES['permit-id-front']) && $_FILES['permit-id-front']['error'] === UPLOAD_ERR_OK) {
        if ($_FILES['permit-id-front']['size'] > $maxFileSize) {
            echo json_encode(["status" => "error", "message" => "The front ID file is too large. Maximum size is 2MB."]);
            exit();
        }
        if (!in_array($_FILES['permit-id-front']['type'], $allowedTypes)) {
            echo json_encode(["status" => "error", "message" => "Only JPG and PNG files are allowed for the front ID."]);
            exit();
        }
        $front_of_id_data = file_get_contents($_FILES['permit-id-front']['tmp_name']);
    }

    if (isset($_FILES['permit-id-back']) && $_FILES['permit-id-back']['error'] === UPLOAD_ERR_OK) {
        if ($_FILES['permit-id-back']['size'] > $maxFileSize) {
            echo json_encode(["status" => "error", "message" => "The back ID file is too large. Maximum size is 2MB."]);
            exit();
        }
        if (!in_array($_FILES['permit-id-back']['type'], $allowedTypes)) {
            echo json_encode(["status" => "error", "message" => "Only JPG and PNG files are allowed for the back ID."]);
            exit();
        }
        $back_of_id_data = file_get_contents($_FILES['permit-id-back']['tmp_name']);
    }

    // Prepared statement to insert data into the database
    $stmt = $conn->prepare("INSERT INTO business_permit (fullname, age, gender, contact_number, business_address, occupation, pwd, email, front_of_id, back_of_id, availability, purpose, submission_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssssssssss", $fullname, $age, $gender, $contact_number, $business_address, $occupation, $pwd, $email, $front_of_id_data, $back_of_id_data, $availability, $purpose, $submission_date);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Your application has been submitted!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "There was an error submitting your application. Please try again."]);
    }

    $stmt->close();
    $conn->close();
}
?>
