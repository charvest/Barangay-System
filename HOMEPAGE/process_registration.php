<?php
$servername = "localhost"; // Change if your DB is on another server
$username = "root"; // DB username
$password = ""; // DB password
$dbname = "registration_db"; // DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $reason = $_POST['reason'];
    $form_type = $_POST['form_type'];

    // Handle ID front upload
    $id_front = null;
    if (isset($_FILES['id_front']) && $_FILES['id_front']['error'] === UPLOAD_ERR_OK) {
        $id_front = file_get_contents($_FILES['id_front']['tmp_name']);
    }

    // Handle ID back upload
    $id_back = null;
    if (isset($_FILES['id_back']) && $_FILES['id_back']['error'] === UPLOAD_ERR_OK) {
        $id_back = file_get_contents($_FILES['id_back']['tmp_name']);
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO registrations (name, address, reason, id_front, id_back, form_type) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $address, $reason, $id_front, $id_back, $form_type);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
