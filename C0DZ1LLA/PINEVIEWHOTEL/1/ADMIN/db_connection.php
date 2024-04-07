<?php
// Establish connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "!@#9797Qwe";
$dbname = "booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
