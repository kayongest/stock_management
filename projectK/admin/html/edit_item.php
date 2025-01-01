<?php
require_once 'config.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['item_id'];
    $itemName = $conn->real_escape_string($_POST['item_name']);
    $itemDescription = $conn->real_escape_string($_POST['item_description']);
    $itemCategory = $conn->real_escape_string($_POST['item_category']);
    $stockLocation = $conn->real_escape_string($_POST['stock_location']);
    $serialNumber = $conn->real_escape_string($_POST['serial_number']);
    $itemStatus = $conn->real_escape_string($_POST['item_status']);
    $itemType = $conn->real_escape_string($_POST['item_type']);

    // Handle file upload if necessary
    if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/"; // Set your upload directory
        $targetFile = $targetDir . basename($_FILES["item_image"]["name"]);
        move_uploaded_file($_FILES["item_image"]["tmp_name"], $targetFile);
    } else {
        // Handle cases where no file is uploaded (e.g., keep the existing image)
        $targetFile = ""; // Set this to the existing image path if necessary
    }

    $sql = "UPDATE items SET item_name='$itemName', item_description='$itemDescription', 
            item_category='$itemCategory', stock_location='$stockLocation', 
            serial_number='$serialNumber', item_status='$itemStatus', item_type='$itemType', 
            item_image='$targetFile', update_date=CURDATE() WHERE id='$itemId'";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Item updated successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to update item: ' . $conn->error;
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request.';
}

echo json_encode($response);
