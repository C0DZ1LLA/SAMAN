<?php
// Include database connection file
include 'db_connection.php';

// Fetch all data from the database
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Set CSV headers
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="C0DZ1LLA SYSTEM BOOKING.csv"');

    // Open file pointer for writing CSV data
    $output = fopen('php://output', 'w');

    // Write CSV headers
    fputcsv($output, array('Booking ID', 'Room Type', 'Arrival Date', 'Departure Date', 'Adults', 'Children', 'Infants', 'Group Number', 'Total Price'));

    // Fetch and write CSV data
    while($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    // Close file pointer
    fclose($output);
} else {
    echo "No data found";
}

// Close database connection
$conn->close();
?>
