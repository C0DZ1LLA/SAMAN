<?php
// Include database connection file
include 'db_connection.php';

// Retrieve and sanitize form data
if(isset($_POST['arrival'], $_POST['departure'], $_POST['rooms'], $_POST['adults'], $_POST['children'], $_POST['infants'], $_POST['group'])) {
    // Sanitize form data
    $arrival = $conn->real_escape_string($_POST['arrival']);
    $departure = $conn->real_escape_string($_POST['departure']);
    $room_type = $conn->real_escape_string($_POST['rooms']);
    $adults = intval($_POST['adults']);
    $children = intval($_POST['children']);
    $infants = intval($_POST['infants']);
    $group = $conn->real_escape_string($_POST['group']);

    // Insert booking data into the database
    $sql = "INSERT INTO bookings (arrival_date, departure_date, room_type, adults, children, infants, group_number) 
            VALUES ('$arrival', '$departure', '$room_type', '$adults', '$children', '$infants', '$group')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to admin page with success message
        header("Location: admin.php?status=success");
        exit();
    } else {
        // Redirect back to admin page with error message
        header("Location: admin.php?status=error");
        exit();
    }
} else {
    // Redirect back to admin page with error message if form fields are empty
    header("Location: admin.php?status=error");
    exit();
}

// Close database connection
$conn->close();
?>
