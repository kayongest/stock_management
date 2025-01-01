<?php
// Include database connection
include 'config.php';

// Ensure the stock ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $stock_id = $_GET['id'];

    // Prepare SQL query to get stock details
    $query = "SELECT * FROM stock WHERE id = :stock_id LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':stock_id', $stock_id, PDO::PARAM_INT);
    
    // Execute the query
    $stmt->execute();

    // Check if the stock item exists
    if ($stmt->rowCount() > 0) {
        // Fetch the stock details
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Return item details as JSON
        echo json_encode($item);
    } else {
        // If the stock item is not found
        echo json_encode(['error' => 'Stock item not found.']);
    }
} else {
    echo json_encode(['error' => 'Stock ID not provided.']);
}
?>
