<?php
// delete_approved_row.php
header('Content-Type: application/json');

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baranggay_system";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Connection failed: " . $conn->connect_error]));
}

// Retrieve the data from POST request
$data = json_decode(file_get_contents("php://input"), true);
$id = isset($data['id']) ? intval($data['id']) : null;
$name = $data['name'] ?? null;
$type = $data['type'] ?? null;
$priority = isset($data['priority']) ? intval($data['priority']) : 0;

// Validate required data
if (!$id || !$name || !$type) {
    echo json_encode(["success" => false, "error" => "Missing required data"]);
    exit();
}

// Define the tables to search
$tables = [
    "indigency_forms" => "reason_for_request",
    "business_permit" => "purpose",
    "baranggay_clearance" => "purpose"
];

// Track if row is found and processed
$rowFound = false;

foreach ($tables as $table => $purposeField) {
    // Query to check if row exists in the table with approved status
    $checkQuery = "SELECT * FROM $table WHERE id = ? AND approval_status = 'approved'";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rowFound = true;

        // Insert into queue using the provided code snippet
        $insertQueueStmt = $conn->prepare("INSERT INTO queue (name, type, priority) VALUES (?, ?, ?)");
        $insertQueueStmt->bind_param("ssi", $name, $type, $priority);

        if ($insertQueueStmt->execute()) {
            // Delete the row from the original table after moving it to the queue
            $deleteQuery = "DELETE FROM $table WHERE id = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("i", $id);

            if ($deleteStmt->execute()) {
                echo json_encode(["success" => true, "message" => "Row successfully deleted and sent to queue"]);
            } else {
                echo json_encode(["success" => false, "error" => "Failed to delete row: " . $deleteStmt->error]);
            }

            $deleteStmt->close();
        } else {
            echo json_encode(["success" => false, "error" => "Failed to insert into queue: " . $insertQueueStmt->error]);
        }

        $insertQueueStmt->close();
        break;  // Exit the loop once the row is found and processed
    }
    $stmt->close();
}

if (!$rowFound) {
    echo json_encode(["success" => false, "error" => "No matching approved row found for ID $id"]);
}

// Close the database connection
$conn->close();
?>
