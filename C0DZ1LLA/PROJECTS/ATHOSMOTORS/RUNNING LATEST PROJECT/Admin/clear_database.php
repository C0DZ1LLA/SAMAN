<?php
// Include database connection file
include 'db_connection.php';

// SQL query to delete all records from the information table
$sql = "DELETE FROM information";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Database cleared successfully";
} else {
    echo "Error clearing database: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
