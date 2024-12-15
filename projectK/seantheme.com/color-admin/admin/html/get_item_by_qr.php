<?php
// Example: get_item_by_qr.php
header('Content-Type: application/json');

if (!isset($_GET['qr_code_url'])) {
    echo json_encode(['status' => 'error', 'message' => 'QR code URL is missing']);
    exit;
}

$qrCodeUrl = $_GET['qr_code_url'];

// Assuming $pdo is your database connection
$stmt = $pdo->prepare("SELECT * FROM items WHERE qr_code_url = :qr_code_url");
$stmt->bindParam(':qr_code_url', $qrCodeUrl);
$stmt->execute();

$item = $stmt->fetch(PDO::FETCH_ASSOC);

if ($item) {
    echo json_encode(['status' => 'success', 'item' => $item]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No item found']);
}
?>
