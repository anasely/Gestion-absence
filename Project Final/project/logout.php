<?php
// Start or resume the session
session_start();

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page (change 'login.php' to your actual login page URL)
header("Location: login.php");
exit();
?>