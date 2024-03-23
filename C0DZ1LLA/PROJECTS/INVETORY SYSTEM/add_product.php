<?php
// Include database connection
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $productName = mysqli_real_escape_string($conn, $_POST["productName"]);
    $productPrice = mysqli_real_escape_string($conn, $_POST["productPrice"]);
    $productQuantity = mysqli_real_escape_string($conn, $_POST["productQuantity"]);

    // Insert product into database
    $sql = "INSERT INTO products (name, price, quantity) VALUES ('$productName', '$productPrice', '$productQuantity')";
    // After adding a new product
UPDATE products SET total_quantity = total_quantity + $newQuantity;


    if ($conn->query($sql) === TRUE) {
        // Product added successfully
        echo "Product added successfully.";
    } else {
        // Error adding product
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
