<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $attribute = $_GET["attribute"];

    // Modify SQL query to sort products by the selected attribute
    $sql = "SELECT * FROM products ORDER BY $attribute";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Output product information as in display_products.php
        }
    } else {
        echo "No products available.";
    }
}

$conn->close();
?>
