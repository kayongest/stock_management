<?php
header('Content-Type: application/json');
include 'config.php'; // Ensure you have your database connection here

// Get the scanned QR code data
$qrCodeData = isset($_GET['qr_code_url']) ? $_GET['qr_code_url'] : '';

// Decode the JSON data from the QR code
$data = json_decode(urldecode($qrCodeData), true);

// Check if the required data is available
if (isset($data['Item ID'])) {
    $itemId = $data['Item ID'];

    // Prepare SQL statement to fetch item data
    $stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the item data
        $item = $result->fetch_assoc();
        echo json_encode($item);
    } else {
        echo json_encode(['error' => 'Item not found.']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid QR code data.']);
}

$conn->close();
?>
