<?php
// db_connection.php
$servername = "localhost";
$username = "root";
$password = "(S19A1M13A1N14)";
$dbname = "carwashdatabase";

// Create a new mysqli object for database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for a successful connection
if ($conn->connect_error) {
    // If connection fails, terminate with an error message
    die("Connection failed: " . $conn->connect_error);
}

// Note: In production, consider using a more secure method to store and retrieve database credentials.
// Avoid displaying detailed error messages to users in a production environment.
?>