<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "av_event_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $role = $conn->real_escape_string($_POST['role']);
    $password = $conn->real_escape_string($_POST['password']); // Get the password field

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $photo = ''; // Initialize photo variable
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an image
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $photo = $target_file; // Save the uploaded photo path
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error uploading file']);
                exit();
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'File is not an image']);
            exit();
        }
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (full_name, phone, email, password_hash, photo, role) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fullname, $phone, $email, $password_hash, $photo, $role);

    // Execute the statement
    if ($stmt->execute()) {
        $user_id = $stmt->insert_id; // Get the new user ID

        // Return response with the correct photo URL
        echo json_encode([
            'status' => 'success',
            'message' => 'User added successfully',
            'user_id' => $user_id,
            'photo' => !empty($photo) ? $photo : "../assets/img/user/default-user.jpg" // Return the uploaded photo path or default image
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add user']);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
