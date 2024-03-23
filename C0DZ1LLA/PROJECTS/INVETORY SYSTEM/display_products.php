<?php
// Include database connection
include 'db_connection.php';

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Check if there are products
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Product Name: " . $row["name"]. " - Price: $" . $row["price"]. " - Quantity: " . $row["quantity"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close database connection
$conn->close();
?>
