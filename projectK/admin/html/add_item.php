<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log');

// Include your database connection file
require_once 'config.php';

$response = [];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Log POST and FILES data for debugging
    error_log(print_r($_POST, true));
    error_log(print_r($_FILES, true));

    // Get the form data with default values to avoid undefined index notices
    $subcategory_id = $_POST['subcategory'] ?? ''; // Change to subcategory_id
    $item_name = $_POST['item_name'] ?? '';
    $item_description = $_POST['item_description'] ?? '';
    $item_category = $_POST['item_category'] ?? '';
    $serial_number = $_POST['serial_number'] ?? '';
    $stock_location = $_POST['stock_location'] ?? '';
    $item_status = $_POST['item_status'] ?? '';
    $item_type = $_POST['item_type'] ?? 'Existing';
    $date_added = date('Y-m-d');

    // Validate required fields
    if (empty($subcategory_id) || empty($item_name) || empty($serial_number) || empty($item_category) || empty($stock_location) || empty($item_status)) {
        respondWithError('Please fill in all required fields.');
    }

    // Validate category and status
    $valid_categories = ['VIDEO', 'IT', 'SOUND', 'SIS', 'LIGHTS', 'OTHER'];
    if (!in_array($item_category, $valid_categories)) {
        respondWithError('Invalid category.');
    }

    $valid_statuses = ['New', 'Working', 'Faulty', 'Needs Repair', 'Repaired', 'Leased'];
    if (!in_array($item_status, $valid_statuses)) {
        respondWithError('Invalid status.');
    }

    // Handle file upload
    $target_dir = "uploads/";
    $item_image = '';

    if (!empty($_FILES['item_image']['name'])) {
        $target_file = $target_dir . basename($_FILES['item_image']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate image file types
        $valid_image_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $valid_image_types)) {
            respondWithError('Only JPG, JPEG, PNG, and GIF files are allowed.');
        }

        if (!move_uploaded_file($_FILES['item_image']['tmp_name'], $target_file)) {
            respondWithError('Failed to upload the image.');
        }
        $item_image = basename($_FILES['item_image']['name']);
    }

    // Insert the item into the database
    $stmt = $conn->prepare("INSERT INTO items (item_name, subcategory_id, item_description, item_category, serial_number, stock_location, item_status, item_type, item_image, date_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        respondWithError('Database error: Failed to prepare statement.');
    }

    // Bind parameters for the statement
    $stmt->bind_param('ssssssssss', $item_name, $subcategory_id, $item_description, $item_category, $serial_number, $stock_location, $item_status, $item_type, $item_image, $date_added);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the inserted item's ID
        $item_id = $stmt->insert_id;

        // Generate the QR code URL with more detailed data (as JSON)
        $qr_data = json_encode([
            'item_id' => $item_id,
            'item_name' => $item_name,
            'item_description' => $item_description
        ]);
        $qr_code_url = "https://quickchart.io/qr?text=" . urlencode($qr_data);

        // Update the item with the generated QR code URL
        $update_stmt = $conn->prepare("UPDATE items SET qr_code_url = ? WHERE id = ?");
        if (!$update_stmt) {
            error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            respondWithError('Database error: Failed to prepare update statement.');
        }

        $update_stmt->bind_param('si', $qr_code_url, $item_id);

        if ($update_stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Item added successfully.';
            $response['item_id'] = $item_id;
            $response['qr_code_url'] = $qr_code_url; // Return the QR code URL if needed
        } else {
            respondWithError('Database error: Failed to update QR code URL.');
        }

        $update_stmt->close();
    } else {
        respondWithError('Database error: Failed to insert item.');
    }

    $stmt->close();
    $conn->close();
} else {
    respondWithError('Invalid request method.');
}

// Function to respond with error message
function respondWithError($message)
{
    global $response;
    $response['status'] = 'error';
    $response['message'] = $message;
    echo json_encode($response);
    exit;
}

// Output the final JSON response
echo json_encode($response);

?>
