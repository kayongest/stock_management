<?php
$servername = "localhost";
$username = "clement";
$password = "clement123";
$dbname = "av_event_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
