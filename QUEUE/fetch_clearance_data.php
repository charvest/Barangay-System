<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "baranggay_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the baranggay_clearance table
$sql = "SELECT id, fullname, age, gender, marital_status, pwd, purpose, front_of_id, back_of_id, availability, address, contact_number, submission_date, email, approval_status FROM baranggay_clearance";
$result = $conn->query($sql);

$rows = array();

if ($result->num_rows > 0) {
    // Fetch each row as an associative array and store it in the $rows array
    while($row = $result->fetch_assoc()) {
        // Store binary data (front_of_id and back_of_id) in base64 for JSON compatibility
        $row['front_of_id'] = base64_encode($row['front_of_id']);
        $row['back_of_id'] = base64_encode($row['back_of_id']);
        $rows[] = $row;
    }
} 

// Close the connection
$conn->close();

// Return the result as JSON
header('Content-Type: application/json');
echo json_encode($rows);
?>
