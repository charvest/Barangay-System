<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Database connection details
$servername = "localhost";  
$username = "root";        
$password = "";             
$dbname = "baranggay_system"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

date_default_timezone_set('Asia/Manila'); 

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email'])) {
    // Sanitize the email input
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    // Validate the email input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format."]);
        exit();
    }

    // Prepare and execute SQL to check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "SQL error: " . $conn->error]);
        exit();
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email exists, generate OTP
        $otp = rand(100000, 999999);
        $otp_expiry = date("Y-m-d H:i:s", strtotime("+15 minutes")); // OTP expires in 15 minutes

        // Update the user record with OTP and expiry time using prepared statements
        $update_sql = "UPDATE users SET otp = ?, otp_expiry = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);
        if ($update_stmt === false) {
            echo json_encode(["status" => "error", "message" => "SQL error: " . $conn->error]);
            exit();
        }
        $update_stmt->bind_param("sss", $otp, $otp_expiry, $email);
        $update_stmt->execute();

        // Send OTP via PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'johnraybarte83@gmail.com'; // Your SMTP email
            $mail->Password   = 'hasw xcip nwgx fpwb';  // Your SMTP email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('your-email@gmail.com', 'Barangay Kalawaan');
            $mail->addAddress($email);  // Send the OTP to the user's email

            // Content - Use htmlspecialchars to prevent XSS
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for Password Reset';
            $mail->Body    = "<h3>Your OTP is: <b>" . htmlspecialchars($otp, ENT_QUOTES, 'UTF-8') . "</b></h3>";

            if ($mail->send()) {
                echo json_encode(["status" => "success", "message" => "OTP sent successfully."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Mail sending failed."]);
            }

        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
        }
    } else {
        // Email does not exist
        echo json_encode(["status" => "error", "message" => "Email not found."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Email is required."]);
}

// Close the database connection
$conn->close();
?>
