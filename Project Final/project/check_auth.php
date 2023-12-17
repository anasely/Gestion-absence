<?php
// Start or resume the session
if (!isset($_SESSION)) {
    session_start();
}
// Check if the user is logged in (assuming you store user ID in 'user_id' session variable)
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: login.php"); // Replace 'login.php' with your actual login page URL
    exit(); // Terminate the script after redirection
}
?>