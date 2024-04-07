<?php
include 'db_connection.php';

// Retrieve all booking information
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo '<div class="booking-details">';
    while($row = $result->fetch_assoc()) {
        echo '<div class="booking">';
        echo '<h3>Room Type: ' . $row["room_type"]. '</h3>';
        echo '<p>Arrival Date: ' . $row["arrival_date"]. '</p>';
        echo '<p>Departure Date: ' . $row["departure_date"]. '</p>';
        echo '<p>Number of Adults: ' . $row["adults"]. '</p>';
        echo '<p>Number of Children: ' . $row["children"]. '</p>';
        echo '<p>Number of Infants: ' . $row["infants"]. '</p>';
        echo '<p>Group Number: ' . $row["group_number"]. '</p>';
        echo '<p>Total Price: ' . $row["total_price"]. '</p>';
        echo '<button class="edit-btn" data-id="' . $row["booking_id"] . '">Edit</button>'; // Add edit button
        // Add more fields as needed
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "0 results";
}

// Close database connection
$conn->close();
?>
