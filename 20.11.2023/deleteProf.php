<?php
// Include the database connection file
include('db_connection.php');

// Check if the student ID is provided via GET
if (isset($_GET['prof_id'])) {
    $prof_id = $_GET['prof_id'];

    // Perform the deletion query based on the student ID
    $sql = "DELETE FROM professors WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $prof_id);

    if ($stmt->execute()) {
        // Deletion successful
        $stmt->close();

        // Redirect back to the original page after deletion
        header("Location: admin_dashboard_prof.php"); // Replace with the actual page name
        exit();
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>