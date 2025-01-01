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

$sql = "SELECT user_id, full_name, email, phone, role, photo, created_at FROM users";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$userCount = count($users);
$conn->close();

header('Content-Type: application/json');
echo json_encode(['users' => $users, 'count' => $userCount]);
?>
