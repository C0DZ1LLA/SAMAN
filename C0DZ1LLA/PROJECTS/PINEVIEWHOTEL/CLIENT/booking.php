<?php
// Establish connection to MySQL database (Update credentials as necessary)
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

// Retrieve and sanitize form data
if(isset($_POST['arrival'], $_POST['departure'], $_POST['rooms'], $_POST['adults'], $_POST['children'], $_POST['infants'], $_POST['group'])) {
    $arrival = $_POST['arrival'];
    $departure = $_POST['departure'];
    $room_type = $_POST['rooms']; // Assuming room type is submitted from the form
    $adults = intval($_POST['adults']);
    $children = intval($_POST['children']);
    $infants = intval($_POST['infants']);
    $group = $_POST['group'];

    // Validate form data
    if(empty($arrival) || empty($departure) || empty($room_type) || $adults < 1) {
        die("Error: Please fill in all required fields.");
    }

    // Check room availability
    $available_rooms = checkRoomAvailability($conn, $arrival, $departure, $room_type);
    if ($available_rooms < 1) {
        // Return no rooms error response
        echo json_encode(array(
            'success' => false,
            'error' => 'no_rooms',
            'message' => "No rooms available for the selected dates."
        ));
        exit; // Stop further execution
    }

    // Calculate total price
    $total_price = calculateTotalPrice($arrival, $departure, $room_type, $conn);

    // Insert booking data into the database using prepared statement
    $stmt = $conn->prepare("INSERT INTO bookings (arrival_date, departure_date, room_type, adults, children, infants, group_number, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $arrival, $departure, $room_type, $adults, $children, $infants, $group, $total_price);
    if ($stmt->execute()) {
        // Output booking details
        echo json_encode(array(
            'success' => true,
            'message' => "Booking successful!",
            'total_price' => $total_price,
            'arrival_date' => $arrival,
            'departure_date' => $departure,
            'room_type' => $room_type,
            'adults' => $adults,
            'children' => $children,
            'infants' => $infants,
            'group_number' => $group
        ));
    } else {
        echo json_encode(array(
            'success' => false,
            'message' => "Error: " . $stmt->error
        ));
    }
    $stmt->close();
} else {
    die("Error: All form fields are required.");
}

// Close database connection
$conn->close();

// Function to check room availability
function checkRoomAvailability($conn, $arrival, $departure, $room_type) {
    // Check room availability based on arrival and departure dates and room type
    $stmt = $conn->prepare("SELECT COUNT(*) AS total_booked_rooms FROM bookings WHERE room_type = ? AND ((arrival_date <= ? AND departure_date >= ?) OR (arrival_date <= ? AND departure_date > ?) OR (arrival_date < ? AND departure_date >= ?))");
    $stmt->bind_param("sssssss", $room_type, $arrival, $departure, $arrival, $arrival, $departure, $departure);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $total_booked_rooms = $row['total_booked_rooms'];
        
        // Fetch total rooms for the given room type
        $stmt = $conn->prepare("SELECT capacity FROM rooms WHERE room_type = ?");
        $stmt->bind_param("s", $room_type);
        $stmt->execute();
        $rooms_result = $stmt->get_result();
        $rooms_row = $rooms_result->fetch_assoc();
        $total_rooms = $rooms_row['capacity'];

        $available_rooms = $total_rooms - $total_booked_rooms;
        return $available_rooms;
    } else {
        die("Error: " . $conn->error);
    }
}

// Function to calculate total price
function calculateTotalPrice($arrival, $departure, $room_type, $conn) {
    // Fetch price per night for the selected room type from the database
    $stmt = $conn->prepare("SELECT price FROM rooms WHERE room_type = ?");
    $stmt->bind_param("s", $room_type);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $price_row = $result->fetch_assoc();
        $price_per_night = $price_row['price'];
        // Calculate total nights stayed
        $num_nights = intval((strtotime($departure) - strtotime($arrival)) / (60 * 60 * 24));
        // Calculate total price
        $total_price = $price_per_night * $num_nights;
        return $total_price;
    } else {
        die("Error: " . $conn->error);
    }
}
?>
