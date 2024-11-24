<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "baranggay_system";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the business permit table
$sql = "SELECT id, fullname, gender, age, pwd, contact_number, email, business_address, purpose, availability, occupation, front_of_id, back_of_id, submission_date, approval_status FROM business_permit";
$result = $conn->query($sql);

$rows = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Convert binary data to base64 for display
        $row['front_of_id'] = base64_encode($row['front_of_id']);
        $row['back_of_id'] = base64_encode($row['back_of_id']);
        $rows[] = $row;
    }
}

$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($rows);
?>
