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
$query = $conn->prepare("SELECT COUNT(*) FROM indigency_forms WHERE email = ? AND submission_date >= ?");
$query->bind_param("ss", $email, $one_day_ago);
$query->execute();
$query->bind_result($submission_count);
$query->fetch();
$query->close();

if ($submission_count >= 3) {
    echo json_encode(["status" => "error", "message" => "You have reached the daily limit of 3 applications for the Certificate of Indigency."]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate inputs to prevent XSS and malicious code injection
    $fullname = filter_var(trim($_POST['fullname']), FILTER_SANITIZE_STRING);
    $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
    $contact_number = filter_var($_POST['contact_number'], FILTER_SANITIZE_STRING);
    $years_in_kalawaan = filter_var($_POST['years_in_kalawaan'], FILTER_VALIDATE_INT);
    $address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
    $marital_status = filter_var($_POST['marital_status'], FILTER_SANITIZE_STRING);
    $pwd = filter_var($_POST['pwd'], FILTER_SANITIZE_STRING);
    $reason_for_request = filter_var(trim($_POST['reason_for_request']), FILTER_SANITIZE_STRING);
    $availability = filter_var($_POST['availability'], FILTER_SANITIZE_STRING);
    
    // Sanitize the email in case it comes from the session
    $email = filter_var($_SESSION['email'], FILTER_SANITIZE_EMAIL);
    $submission_date = date('Y-m-d H:i:s');

    // File upload validation
    $allowedTypes = ['image/jpeg', 'image/png'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    $front_of_id_data = null;
    $back_of_id_data = null;

    // Validate files
    if (isset($_FILES['front_of_id']) && $_FILES['front_of_id']['error'] === UPLOAD_ERR_OK) {
        if ($_FILES['front_of_id']['size'] > $maxFileSize) {
            echo json_encode(["status" => "error", "message" => "The front ID file is too large. Maximum size is 2MB."]);
            exit();
        }
        if (!in_array($_FILES['front_of_id']['type'], $allowedTypes)) {
            echo json_encode(["status" => "error", "message" => "Only JPG and PNG files are allowed for front ID."]);
            exit();
        }
        $front_of_id_data = file_get_contents($_FILES['front_of_id']['tmp_name']);
    }

    if (isset($_FILES['back_of_id']) && $_FILES['back_of_id']['error'] === UPLOAD_ERR_OK) {
        if ($_FILES['back_of_id']['size'] > $maxFileSize) {
            echo json_encode(["status" => "error", "message" => "The back ID file is too large. Maximum size is 2MB."]);
            exit();
        }
        if (!in_array($_FILES['back_of_id']['type'], $allowedTypes)) {
            echo json_encode(["status" => "error", "message" => "Only JPG and PNG files are allowed for back ID."]);
            exit();
        }
        $back_of_id_data = file_get_contents($_FILES['back_of_id']['tmp_name']);
    }

    // Prepared statement to insert data into the database
    $stmt = $conn->prepare("INSERT INTO indigency_forms (fullname, age, gender, contact_number, years_in_kalawaan, address, marital_status, pwd, reason_for_request, email, front_of_id, back_of_id, availability, submission_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sississsssssss", $fullname, $age, $gender, $contact_number, $years_in_kalawaan, $address, $marital_status, $pwd, $reason_for_request, $email, $front_of_id_data, $back_of_id_data, $availability, $submission_date);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Your information has been submitted!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "There was an error submitting your form. Please try again."]);
    }

    $stmt->close();
    $conn->close();
}
?>
