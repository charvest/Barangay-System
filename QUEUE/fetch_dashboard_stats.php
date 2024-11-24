<?php
// Database connection (adjust the credentials)
$host = "localhost";
$username = "root";
$password = "";
$dbname = "baranggay_system";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Count new users
$newUsersResult = $conn->query("SELECT COUNT(user_id) as newUsers FROM users");
$newUsers = $newUsersResult->fetch_assoc()['newUsers'];

// Count approved requests
$approvedRequestsQuery = "
    SELECT COUNT(*) AS approvedRequests FROM (
        SELECT approval_status FROM baranggay_clearance WHERE approval_status = 'approved'
        UNION ALL
        SELECT approval_status FROM business_permit WHERE approval_status = 'approved'
        UNION ALL
        SELECT approval_status FROM indigency_forms WHERE approval_status = 'approved'
    ) AS approved";
$approvedRequestsResult = $conn->query($approvedRequestsQuery);
$approvedRequests = $approvedRequestsResult->fetch_assoc()['approvedRequests'];

// Count pending requests
$pendingRequestsQuery = "
    SELECT COUNT(*) AS pendingRequests FROM (
        SELECT approval_status FROM baranggay_clearance WHERE approval_status = 'pending'
        UNION ALL
        SELECT approval_status FROM business_permit WHERE approval_status = 'pending'
        UNION ALL
        SELECT approval_status FROM indigency_forms WHERE approval_status = 'pending'
    ) AS pending";
$pendingRequestsResult = $conn->query($pendingRequestsQuery);
$pendingRequests = $pendingRequestsResult->fetch_assoc()['pendingRequests'];

// Return data as JSON
echo json_encode([
    'newUsers' => $newUsers,
    'approvedRequests' => $approvedRequests,
    'pendingRequests' => $pendingRequests
]);

$conn->close();
?>
