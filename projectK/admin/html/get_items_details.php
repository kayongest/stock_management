<?php
// Database connection
$host = "localhost";
$dbname = "av_event_management";
$username = "root"; // adjust based on your DB credentials
$password = "";     // adjust based on your DB credentials

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get serial_number from query
    $serial_number = $_GET['serial_number'] ?? '';

    // Fetch item details by serial_number
    $stmt = $pdo->prepare("SELECT * FROM items WHERE serial_number = :serial_number");
    $stmt->bindParam(':serial_number', $serial_number);
    $stmt->execute();

    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        echo json_encode($item);
    } else {
        echo json_encode(['error' => 'Item not found']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
