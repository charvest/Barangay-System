<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baranggay_system"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST data is set
if (isset($_POST['id']) && isset($_POST['status']) && isset($_POST['table'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];
    $table = $_POST['table'];

    // Log the received table name for debugging
    error_log("Received table name: $table");

    // Sanitize table name to prevent SQL injection
    $allowedTables = ['indigency_forms', 'baranggay_clearance', 'business_permit'];
    if (!in_array($table, $allowedTables)) {
        echo json_encode(["success" => false, "error" => "Invalid table name"]);
        exit();
    }

    // Update the specified table and ID with the given status
    $query = "UPDATE $table SET approval_status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param('si', $status, $id);
        $success = $stmt->execute();
        $stmt->close();

        echo json_encode(["success" => $success]);
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Missing required data"]);
}

// Close database connection
$conn->close();
?>
