<?php
// Include the database connection file
include('db_connection.php');

// Check if the student ID is provided via GET
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Perform the deletion query based on the student ID
    $sql = "DELETE FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Deletion successful
        $stmt->close();

        // Redirect back to the original page after deletion
        header("Location: admin_dashboard_user.php"); // Replace with the actual page name
        exit();
    } else {
        echo "Error: " . $mysqli->error;

    }
}

// Close the database connection
$mysqli->close();
?>