<?php
// update_queue_status.php
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

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$status = $data['status'];
$hidden = $data['hidden'];

// Update status and hidden columns for the given id
$sql = "UPDATE queue SET status = ?, hidden = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $status, $hidden, $id);

$response = [];

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = $conn->error;
}

// Close the database connection
$stmt->close();
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
