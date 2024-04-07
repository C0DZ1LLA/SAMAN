<?php
// Check if booking ID is provided
if(isset($_POST['booking_id'])) {
    // Include the database connection file
    include 'db_connection.php';

    // Escape the booking ID to prevent SQL injection
    $bookingId = $conn->real_escape_string($_POST['booking_id']);

    // Perform database query to fetch booking details by ID
    $sql = "SELECT * FROM bookings WHERE booking_id = '$bookingId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch booking details
        $row = $result->fetch_assoc();
        $arrivalDate = $row['arrival_date'];
        // Fetch other booking details as needed

        // Display the form for editing
        echo '<form id="booking-form" action="update_booking.php" method="POST">';
        echo '<input type="hidden" name="booking_id" value="' . $bookingId . '">';
        echo 'Arrival Date: <input type="text" name="arrival_date" value="' . $arrivalDate . '"><br>';
        // Add other input fields for other booking details
        echo '<button type="submit">Save Changes</button>';
        echo '</form>';
    } else {
        echo "Error: No booking found for the provided ID.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Error: Booking ID not provided.";
}
?>
