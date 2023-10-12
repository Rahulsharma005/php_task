<?php
// Database configuration
$servername = "localhost"; // Change to your MySQL server name (usually "localhost" for XAMPP)
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$database = "Skillify_db"; // Change to your MySQL database name

// Create a database connection
$mysqli = new mysqli($servername, $username, $password, $database);

// echo "Connected successfully";
// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
