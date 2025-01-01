<?php
include 'config.php'; // Ensure this file is included correctly

if (isset($_GET['id'])) {
    $itemId = intval($_GET['id']); // Sanitize input
    $stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($item = $result->fetch_assoc()) {
        echo json_encode($item);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Item not found.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No ID provided.']);
}
?>
