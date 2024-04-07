<?php
include 'db_connection.php';

// Check if form data is provided via POST
if(isset($_POST['booking_id'])) {
    // Escape form data to prevent SQL injection
    $bookingId = $conn->real_escape_string($_POST['booking_id']);
    $roomType = $conn->real_escape_string($_POST['room_type']);
    $arrivalDate = $conn->real_escape_string($_POST['arrival_date']);
    $departureDate = $conn->real_escape_string($_POST['departure_date']);
    $adults = $conn->real_escape_string($_POST['adults']);
    $children = $conn->real_escape_string($_POST['children']);
    $infants = $conn->real_escape_string($_POST['infants']);
    $groupNumber = $conn->real_escape_string($_POST['group_number']);
    $totalPrice = $conn->real_escape_string($_POST['total_price']);

    // Perform database update query
    $sql = "UPDATE bookings SET 
            room_type = '$roomType', 
            arrival_date = '$arrivalDate', 
            departure_date = '$departureDate', 
            adults = '$adults', 
            children = '$children', 
            infants = '$infants', 
            group_number = '$groupNumber', 
            total_price = '$totalPrice' 
            WHERE booking_id = '$bookingId'";

    if ($conn->query($sql) === TRUE) {
        // Close the modal popup using JavaScript
        echo "<script>$('#edit-modal').hide();</script>";
        echo "Booking details updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Error: Form data not provided.";
}
?>
