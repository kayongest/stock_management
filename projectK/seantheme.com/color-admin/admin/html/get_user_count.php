<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "av_event_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(*) as total_users FROM users";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    echo json_encode(['total_users' => $row['total_users']]);
} else {
    echo json_encode(['total_users' => 0]);
}

$conn->close();
?>
