<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baranggay_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs to prevent XSS or invalid data
    $fullname = filter_var(trim($_POST['fname']), FILTER_SANITIZE_STRING);
    $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $contact_number = filter_var($_POST['contact_number'], FILTER_SANITIZE_STRING);
    $address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
    $marital_status = filter_var($_POST['marital-status'], FILTER_SANITIZE_STRING);
    $pwd = filter_var($_POST['clearance-pwd'], FILTER_SANITIZE_STRING);
    $purpose = filter_var(trim($_POST['purpose']), FILTER_SANITIZE_STRING);
    $availability = filter_var($_POST['availability'], FILTER_SANITIZE_STRING);
    $submission_date = date('Y-m-d H:i:s');
    $one_day_ago = date('Y-m-d H:i:s', strtotime('-1 day'));

    // Check submission limit (preventing multiple applications in a short period)
    $query = $conn->prepare("SELECT COUNT(*) FROM baranggay_clearance WHERE email = ? AND submission_date >= ?");
    $query->bind_param("ss", $email, $one_day_ago);
    $query->execute();
    $query->bind_result($submission_count);
    $query->fetch();
    $query->close();

    if ($submission_count >= 3) {
        echo json_encode(["status" => "error", "message" => "You have reached the daily limit of 3 applications for the Barangay Clearance."]);
        exit();
    }

    // File upload validation
    $allowedTypes = ['image/jpeg', 'image/png'];
    $maxFileSize = 2 * 1024 * 1024; // 2 MB

    // Validate front and back ID files
    if ($_FILES['clearance-id-front']['error'] === UPLOAD_ERR_OK && $_FILES['clearance-id-back']['error'] === UPLOAD_ERR_OK) {
        // Check if files are of allowed types and size
        if (!in_array($_FILES['clearance-id-front']['type'], $allowedTypes) || $_FILES['clearance-id-front']['size'] > $maxFileSize) {
            echo json_encode(["status" => "error", "message" => "Invalid front ID file. Only JPG/PNG files under 2MB are allowed."]);
            exit();
        }

        if (!in_array($_FILES['clearance-id-back']['type'], $allowedTypes) || $_FILES['clearance-id-back']['size'] > $maxFileSize) {
            echo json_encode(["status" => "error", "message" => "Invalid back ID file. Only JPG/PNG files under 2MB are allowed."]);
            exit();
        }

        // Process files (store their content as binary data)
        $front_of_id_data = file_get_contents($_FILES['clearance-id-front']['tmp_name']);
        $back_of_id_data = file_get_contents($_FILES['clearance-id-back']['tmp_name']);
    } else {
        echo json_encode(["status" => "error", "message" => "Error uploading ID files."]);
        exit();
    }

    // Prepared statement to insert data into the database with availability
    $stmt = $conn->prepare("INSERT INTO baranggay_clearance (fullname, age, email, contact_number, address, gender, marital_status, pwd, purpose, front_of_id, back_of_id, availability, submission_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssssssssss", $fullname, $age, $email, $contact_number, $address, $gender, $marital_status, $pwd, $purpose, $front_of_id_data, $back_of_id_data, $availability, $submission_date);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Your information has been submitted!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'There was an error submitting your form. Please try again.']);
    }

    $stmt->close();
    $conn->close();
}
?>
