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

$receiverId = $_GET['receiver_id']; // Get the ID of the message receiver

// Retrieve messages from the messages table for the given receiver
// You may need to modify the query based on your database schema
$sql = "SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iiii", $_SESSION['user_id'], $receiverId, $receiverId, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

$messages = array();
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

// Close the database connection
$stmt->close();
$mysqli->close();

// Return the messages as JSON
header("Content-Type: application/json");
echo json_encode($messages);
?>
