<?php
// Database connection parameters
$host = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = "root"; // Replace with your database password
$database = "gestion_absence"; // Replace with your database name

// Create a connection to the database
$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Set character set to UTF-8 (optional)
$mysqli->set_charset("utf8");

// You can include this file on other pages to use the $mysqli object for database operations
?>
