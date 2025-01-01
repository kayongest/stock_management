<?php
// Include database connection
include 'config.php';

// Function to handle image upload
function upload_image($file) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    if (getimagesize($file["tmp_name"]) === false) {
        return ['success' => false, 'message' => 'File is not an image.'];
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        return ['success' => false, 'message' => 'File already exists.'];
    }

    // Check file size (limit to 5MB for example)
    if ($file["size"] > 5000000) {
        return ['success' => false, 'message' => 'File is too large.'];
    }

    // Allow certain file formats
    $allowed_types = ['jpg', 'png', 'jpeg', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        return ['success' => false, 'message' => 'Only JPG, JPEG, PNG, GIF files are allowed.'];
    }

    // Attempt to upload the image
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ['success' => true, 'path' => $target_file];
    }

    return ['success' => false, 'message' => 'Failed to upload the file.'];
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate POST data
    $stock_name = isset($_POST['stock_name']) ? htmlspecialchars($_POST['stock_name']) : null;
    $stock_category = isset($_POST['stock_category']) ? htmlspecialchars($_POST['stock_category']) : null;
    $stock_location = isset($_POST['stock_location']) ? htmlspecialchars($_POST['stock_location']) : null;
    $serial_number = isset($_POST['serial_number']) ? htmlspecialchars($_POST['serial_number']) : null;
    $stock_status = isset($_POST['stock_status']) ? htmlspecialchars($_POST['stock_status']) : null;
    $stock_id = isset($_POST['stock_id']) ? $_POST['stock_id'] : null;

    // Check for missing required fields
    if (!$stock_name || !$stock_category || !$stock_location || !$serial_number || !$stock_status) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Default image URL to null
    $image_url = null;

    // Handle image upload if a file is provided
    if (isset($_FILES['stock_image']) && $_FILES['stock_image']['error'] === UPLOAD_ERR_OK) {
        $image_upload_result = upload_image($_FILES['stock_image']);
        if (!$image_upload_result['success']) {
            echo json_encode(['success' => false, 'message' => $image_upload_result['message']]);
            exit;
        }
        $image_url = $image_upload_result['path'];
    }

    try {
        // Prepare the query for saving or updating stock data
        if ($stock_id) {
            // Update existing stock item
            $query = "UPDATE stock SET 
                        stock_name = :stock_name,
                        stock_category = :stock_category,
                        stock_location = :stock_location,
                        serial_number = :serial_number,
                        stock_status = :stock_status,
                        stock_image = :stock_image,
                        last_updated = CURRENT_TIMESTAMP
                      WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $stock_id, PDO::PARAM_INT);
        } else {
            // Insert new stock item
            $query = "INSERT INTO stock (stock_name, stock_category, stock_location, serial_number, stock_status, stock_image) 
                      VALUES (:stock_name, :stock_category, :stock_location, :serial_number, :stock_status, :stock_image)";
            $stmt = $pdo->prepare($query);
        }

        // Bind parameters
        $stmt->bindParam(':stock_name', $stock_name);
        $stmt->bindParam(':stock_category', $stock_category);
        $stmt->bindParam(':stock_location', $stock_location);
        $stmt->bindParam(':serial_number', $serial_number);
        $stmt->bindParam(':stock_status', $stock_status);
        $stmt->bindParam(':stock_image', $image_url);

        // Execute the query
        $stmt->execute();

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}
?>
