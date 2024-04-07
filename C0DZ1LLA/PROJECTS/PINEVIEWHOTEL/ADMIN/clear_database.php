<?php
// Include database connection file
include 'db_connection.php';

// Truncate the bookings table (or execute any other logic to clear the database)
$sql = "TRUNCATE TABLE bookings";
if ($conn->query($sql) === TRUE) {
    echo "Database cleared successfully";
} else {
    echo "Error clearing database: " . $conn->error;
}

// Close database connection
$conn->close();

// Redirect back to the admin panel
header('Location: admin.php');
exit;
?>
