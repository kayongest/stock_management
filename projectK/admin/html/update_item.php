<?php
// update_item.php
include 'config.php'; // Include your database connection

header('Content-Type: application/json'); // Set content type to JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate input
    $requiredFields = ['item_id', 'item_name', 'item_description', 'item_status', 'item_category', 'stock_location', 'serial_number', 'item_type'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(['status' => 'error', 'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required.']);
            exit;
        }
    }

    // Get form data
    $itemId = $_POST['item_id'];
    $itemName = $_POST['item_name'];
    $itemDescription = $_POST['item_description'];
    $itemStatus = $_POST['item_status'];
    $itemCategory = $_POST['item_category'];
    $stockLocation = $_POST['stock_location'];
    $serialNumber = $_POST['serial_number'];
    $itemType = $_POST['item_type'];

    // Handle image upload
    $itemImage = null;
    if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] == UPLOAD_ERR_OK) {
        // Define the target directory
        $targetDir = "uploads/";
        $fileName = basename($_FILES['item_image']['name']);
        $targetFilePath = $targetDir . $fileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['item_image']['tmp_name'], $targetFilePath)) {
            $itemImage = $fileName; // Save the image name for the database
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to upload image.']);
            exit;
        }
    }

    // Prepare and execute update query
    $query = "UPDATE items SET item_name=?, item_description=?, item_status=?, item_category=?, stock_location=?, serial_number=?, item_type=?";
    if ($itemImage) {
        $query .= ", item_image=?"; // Include image field if uploaded
    }
    $query .= " WHERE id=?";
    
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        // Bind parameters
        if ($itemImage) {
            $stmt->bind_param("ssssssssi", $itemName, $itemDescription, $itemStatus, $itemCategory, $stockLocation, $serialNumber, $itemType, $itemImage, $itemId);
        } else {
            $stmt->bind_param("sssssssi", $itemName, $itemDescription, $itemStatus, $itemCategory, $stockLocation, $serialNumber, $itemType, $itemId);
        }

        // Execute the statement
        if ($stmt->execute()) {
            // Return updated item data
            $updatedItem = [
                'id' => $itemId,
                'item_name' => $itemName,
                'item_description' => $itemDescription,
                'item_status' => $itemStatus,
                'item_category' => $itemCategory,
                'stock_location' => $stockLocation,
                'serial_number' => $serialNumber,
                'item_type' => $itemType,
                'item_image' => $itemImage, // Include image in the response
            ];
            echo json_encode(['status' => 'success', 'message' => 'Item updated successfully.', 'updated_item' => $updatedItem]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update item. Error: ' . $stmt->error]);
        }
        $stmt->close(); // Close the statement
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
    }
}

$conn->close(); // Close the database connection
?>
