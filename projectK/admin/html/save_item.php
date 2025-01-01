<?php
// Database connection
$host = 'localhost';
$db = 'av_event_management';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get form data
$item_id = $_POST['item_id'];
$item_name = $_POST['item_name'];
$item_description = $_POST['item_description'];
$item_category = $_POST['item_category'];
$serial_number = $_POST['serial_number'];
$stock_location = $_POST['stock_location'];
$item_status = $_POST['item_status'];

// Handle file upload
$item_image = '';
if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['item_image']['name']);
    
    if (move_uploaded_file($_FILES['item_image']['tmp_name'], $uploadFile)) {
        $item_image = $uploadFile;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to upload image']);
        exit();
    }
}

// Insert or update the item
if (empty($item_id)) {
    // Insert new item
    $sql = "INSERT INTO items (item_name, item_description, item_category, serial_number, stock_location, item_status, item_image) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $item_name, $item_description, $item_category, $serial_number, $stock_location, $item_status, $item_image);
} else {
    // Update existing item
    $sql = "UPDATE items SET item_name = ?, item_description = ?, item_category = ?, serial_number = ?, stock_location = ?, item_status = ?, item_image = ?
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $item_name, $item_description, $item_category, $serial_number, $stock_location, $item_status, $item_image, $item_id);
}

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to save item']);
}

$stmt->close();
$conn->close();
?>
