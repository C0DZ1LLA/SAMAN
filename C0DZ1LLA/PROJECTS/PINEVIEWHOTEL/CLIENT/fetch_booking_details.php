<?php
// Include the database connection file
include 'db_connection.php';

// Check if booking ID is provided via POST
if(isset($_POST['booking_id'])) {
    // Escape the booking ID to prevent SQL injection
    $bookingId = $conn->real_escape_string($_POST['booking_id']);

    // Perform database query to fetch booking details by ID
    $sql = "SELECT * FROM bookings WHERE booking_id = '$bookingId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch booking details
        $row = $result->fetch_assoc();
        $roomType = $row['room_type'];
        $arrivalDate = $row['arrival_date'];
        $departureDate = $row['departure_date'];
        $adults = $row['adults'];
        $children = $row['children'];
        $infants = $row['infants'];
        $groupNumber = $row['group_number'];
        $totalPrice = $row['total_price'];

        // Display the form for editing
        echo '<form id="booking-form" action="update_booking.php" method="POST">';
        echo '<input type="hidden" name="booking_id" value="' . $bookingId . '">';
        echo 'Room Type: <input type="text" name="room_type" value="' . $roomType . '"><br>';
        echo 'Arrival Date: <input type="text" name="arrival_date" value="' . $arrivalDate . '"><br>';
        echo 'Departure Date: <input type="text" name="departure_date" value="' . $departureDate . '"><br>';
        echo 'Number of Adults: <input type="text" name="adults" value="' . $adults . '"><br>';
        echo 'Number of Children: <input type="text" name="children" value="' . $children . '"><br>';
        echo 'Number of Infants: <input type="text" name="infants" value="' . $infants . '"><br>';
        echo 'Group Number: <input type="text" name="group_number" value="' . $groupNumber . '"><br>';
        echo 'Total Price: <input type="text" name="total_price" value="' . $totalPrice . '"><br>';
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
