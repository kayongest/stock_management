<?php
// Start output buffering
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// Include your database connection file
require_once 'config.php';

$response = [];

// Check for database connection error
if ($conn->connect_error) {
    $response['status'] = 'error';
    $response['message'] = 'Database connection failed: ' . $conn->connect_error;
    echo json_encode($response);
    exit;
}

try {
    $start_time = microtime(true); // Start time for query execution

    // Prepared statement to fetch items
    $stmt = $conn->prepare("SELECT id, B.name AS brand_name, C.name AS category_name, C.description AS item_description, item_category, serial_number, qr_code_url, stock_location, item_status, item_type, date_added FROM items I 
                                        JOIN brands B ON B.brand_id = I.brand_id
                                        JOIN categories C ON C.category_id = I.category_id");
    
    if (!$stmt) {
        throw new Exception("SQL Error: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Query to get the total number of items
    $count_query = "SELECT COUNT(*) AS total_items FROM items";
    $count_result = $conn->query($count_query);

    if ($count_result) {
        $total_items = $count_result->fetch_assoc()['total_items'];
    } else {
        throw new Exception("Failed to fetch total item count");
    }

    if ($result) {
        // Check the number of rows returned
        if ($result->num_rows > 0) {
            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            $response['status'] = 'success';
            $response['items'] = $items;
            $response['total_items'] = $total_items; // Add the total item count to the response
        } else {
            $response['status'] = 'success';
            $response['items'] = [];
            $response['message'] = 'No items found in the database';
            $response['total_items'] = $total_items; // Still include the total count
        }
    }

    $stmt->close();
    $end_time = microtime(true); // End time for query execution
    $execution_time = $end_time - $start_time; // Execution time
    $response['execution_time'] = $execution_time . ' seconds';
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = 'Failed to fetch items: ' . $e->getMessage();
}

// Output the final JSON response
echo json_encode($response);

// Clean the output buffer
?>
