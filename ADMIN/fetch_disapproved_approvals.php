<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baranggay_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch disapproved approvals from all tables
$query = "
    SELECT fullname, 'Indigency' AS type, reason_for_request AS purpose, submission_date, approval_status 
    FROM indigency_forms 
    WHERE approval_status = 'disapproved'
    UNION
    SELECT fullname, 'Business Permit' AS type, purpose, submission_date, approval_status 
    FROM business_permit 
    WHERE approval_status = 'disapproved'
    UNION
    SELECT fullname, 'Clearance' AS type, purpose, submission_date, approval_status 
    FROM baranggay_clearance 
    WHERE approval_status = 'disapproved'
";

$result = $conn->query($query);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Store each row
    }
}

echo json_encode($data);

$conn->close();
?>
