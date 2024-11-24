<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baranggay_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Connection failed: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($data['name']) && isset($data['type']) && isset($data['priority'])) {
    $id = $data['id'];
    $name = $data['name'];
    $type = $data['type'];
    $priority = $data['priority'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert into queue table
        $stmt = $conn->prepare("INSERT INTO queue (name, type, priority) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $type, $priority);

        if (!$stmt->execute()) {
            throw new Exception("Execution failed during insert: " . $stmt->error);
        }

        // Determine the table based on type and update `hidden` status
        $tableName = '';
        if ($type === 'Indigency') {
            $tableName = 'indigency_forms';
        } elseif ($type === 'Business Permit') {
            $tableName = 'business_permit';
        } elseif ($type === 'Clearance') {
            $tableName = 'baranggay_clearance';
        }

        if ($tableName) {
            $updateStmt = $conn->prepare("UPDATE $tableName SET hidden = 1 WHERE id = ?");
            $updateStmt->bind_param("i", $id);

            if (!$updateStmt->execute()) {
                throw new Exception("Failed to update hidden status: " . $updateStmt->error);
            }

            $updateStmt->close();
        } else {
            throw new Exception("Unknown table type: " . $type);
        }

        // Commit transaction
        $conn->commit();
        echo json_encode(["success" => true]);

    } catch (Exception $e) {
        // Rollback if any operation fails
        $conn->rollback();
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "Invalid data received"]);
}

$conn->close();
?>
