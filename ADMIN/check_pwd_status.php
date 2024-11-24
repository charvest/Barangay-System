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

$id = $_GET['id'];
$pwdStatus = 'no';

// Check across all tables for PWD status
$tables = ["indigency_forms", "business_permit", "baranggay_clearance"];
foreach ($tables as $table) {
    $stmt = $conn->prepare("SELECT pwd FROM $table WHERE id = ? AND pwd = 'yes'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $pwdStatus = 'yes';
        break;
    }

    $stmt->close();
}

echo json_encode(["success" => true, "pwd" => $pwdStatus]);
$conn->close();
?>
