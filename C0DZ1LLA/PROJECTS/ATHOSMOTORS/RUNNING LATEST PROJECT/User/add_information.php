<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand = mysqli_real_escape_string($conn, $_POST["brand"]);
    $color = mysqli_real_escape_string($conn, $_POST["color"]);
    $idNumber = mysqli_real_escape_string($conn, $_POST["idNumber"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $extraPrice = mysqli_real_escape_string($conn, $_POST["extraPrice"]);
    $discountPercentage = mysqli_real_escape_string($conn, $_POST["discount"]);

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');

// Using prepared statement for better security
$stmt = $conn->prepare("INSERT INTO information (brand, color, id_number, status, price, extra_price, discount_percentage, timestamp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssddds", $brand, $color, $idNumber, $status, $price, $extraPrice, $discountPercentage, $currentDateTime);

    if ($stmt->execute()) {
        echo "Information added successfully.";
    } else {
        echo "Error adding information: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
