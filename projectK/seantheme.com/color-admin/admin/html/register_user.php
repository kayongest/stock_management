<?php
require 'config.php'; // Include database connection

// Check if form data is received via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if all fields are filled
    if (empty($full_name) || empty($phone) || empty($email) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit();
    }

    // Hash the password for security
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Default role is 'User'
    $role = 'User';

    // Prepare the SQL statement to insert a new user
    $sql = "INSERT INTO users (full_name, phone, email, password_hash, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssss", $full_name, $phone, $email, $password_hash, $role);

        if ($stmt->execute()) {
            // Registration successful
            echo json_encode(['status' => 'success', 'message' => 'Registration successful!']);
        } else {
            // Error in execution
            echo json_encode(['status' => 'error', 'message' => 'Error in registration. Please try again.']);
        }
        $stmt->close();
    } else {
        // Error preparing statement
        echo json_encode(['status' => 'error', 'message' => 'Database error. Please try again.']);
    }

    // Close connection
    $conn->close();
}
?>
