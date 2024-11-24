<?php
// Database connection details
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

// Check if all OTP digits are provided
if (isset($_POST['digit-1'], $_POST['digit-2'], $_POST['digit-3'], $_POST['digit-4'], $_POST['digit-5'], $_POST['digit-6'])) {
    // Sanitize the OTP digits to remove unwanted characters
    $otp_digits = [
        filter_var($_POST['digit-1'], FILTER_SANITIZE_NUMBER_INT),
        filter_var($_POST['digit-2'], FILTER_SANITIZE_NUMBER_INT),
        filter_var($_POST['digit-3'], FILTER_SANITIZE_NUMBER_INT),
        filter_var($_POST['digit-4'], FILTER_SANITIZE_NUMBER_INT),
        filter_var($_POST['digit-5'], FILTER_SANITIZE_NUMBER_INT),
        filter_var($_POST['digit-6'], FILTER_SANITIZE_NUMBER_INT)
    ];

    // Concatenate the sanitized OTP digits
    $otp = implode("", $otp_digits);

    // Prepare SQL query with prepared statements to prevent SQL injection
    $sql = "SELECT otp, otp_expiry FROM users WHERE otp = ? AND otp_expiry > NOW()";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        // Handle SQL error
        echo json_encode(["status" => "error", "message" => "SQL error: " . htmlspecialchars($conn->error)]);
        exit();
    }

    // Bind the sanitized OTP value
    $stmt->bind_param("s", $otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // OTP is valid, fetch data for debugging
        $row = $result->fetch_assoc();
        echo json_encode([
            "status" => "success", 
            "message" => "OTP verified successfully.",
            "otp" => htmlspecialchars($row['otp']),
            "otp_expiry" => htmlspecialchars($row['otp_expiry']),
            "server_time" => htmlspecialchars(date("Y-m-d H:i:s"))
        ]);
    } else {
        // OTP is invalid or expired
        echo json_encode(["status" => "error", "message" => "Invalid or expired OTP."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "OTP is required."]);
}

// Close the database connection
$conn->close();
?>
