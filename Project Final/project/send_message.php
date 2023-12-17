<?php
include('db_connection.php');

session_start(); // Start the session to track the current user

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
}

// Include your database connection code here
// Example:
// $db = new mysqli('localhost', 'username', 'password', 'your_database');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senderId = $_SESSION['user_id']; // Get the ID of the logged-in user
    $receiverId = $_POST['receiver_id']; // Get the ID of the message receiver
    $message = $_POST['message']; // Get the message content

    // Validate input (e.g., check for empty message)
    if (empty($message)) {
        // Handle validation errors (e.g., return an error response)
        echo json_encode(['error' => 'Message cannot be empty']);
        exit();
    }

    // Insert the message into the messages table
    // Use prepared statements to prevent SQL injection
    $stmt = $mysqli->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $senderId, $receiverId, $message);

    if ($stmt->execute()) {
        // Message sent successfully
        echo json_encode(['success' => 'Message sent']);
    } else {
        // Error occurred while sending the message
        echo json_encode(['error' => 'Failed to send message']);
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();
} else {
    // Handle invalid request method (e.g., return an error response)
    echo json_encode(['error' => 'Invalid request method']);
}
?>
