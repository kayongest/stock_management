<?php
session_start();
include 'config.php'; // Assuming you have a connection file

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the inputs
    if (empty($email) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill all fields.']);
        exit();
    }

    // Query to check if the user exists
    $stmt = $conn->prepare("SELECT user_id, full_name, password_hash, photo, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if user exists
    if (!$user) {
        echo json_encode(['status' => 'error', 'message' => 'Email does not exist.']);
        exit();
    }

    // Verify the password
    if (password_verify($password, $user['password_hash'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['photo'] = $user['photo']; // Store the user's photo

        // Determine redirection URL based on role
        $redirect_url = ($user['role'] == 'Admin') ? 'admin_dashboard.php' : 'items.php';

        // Send a success message with user info and redirection URL
        echo json_encode([
            'status' => 'success',
            'full_name' => $user['full_name'],
            'photo' => $user['photo'],
            'redirect_url' => $redirect_url
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password.']);
    }

    $stmt->close();
    $conn->close();
}
?>
