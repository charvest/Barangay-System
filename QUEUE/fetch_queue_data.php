<?php
// fetch_queue_data.php
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

// Fetch queue data with explicit cast for priority field, excluding hidden rows
$sql = "SELECT id, name, type, CAST(priority AS UNSIGNED) AS priority, created_at, status 
        FROM queue 
        WHERE hidden = 0 
        ORDER BY priority DESC, created_at ASC";
$result = $conn->query($sql);

$queueData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $queueData[] = $row;
    }
}

// Close the database connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($queueData);
?>
