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


// Retrieve JSON data from POST request
$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;

if (!$id) {
    echo json_encode(['success' => false, 'error' => 'No ID provided']);
    exit;
}

// Fetch entry details from the queue table
$query = "SELECT id, name, type, priority FROM queue WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Insert into completed table
    $insertQuery = "INSERT INTO completed (queue_id, name, type, priority) VALUES (?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("issi", $row['id'], $row['name'], $row['type'], $row['priority']);

    if ($insertStmt->execute()) {
        // Update status in queue table
        $updateQuery = "UPDATE queue SET status = 'completed' WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("i", $id);

        if ($updateStmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update queue status']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to insert into completed table']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Entry not found']);
}
?>