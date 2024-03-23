<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $bulkPrice = mysqli_real_escape_string($conn, $_POST["bulkPrice"]);
    $sellPrice = mysqli_real_escape_string($conn, $_POST["sellPrice"]);
    $bulkCost = mysqli_real_escape_string($conn, $_POST["bulkCost"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

    $totalCost = $bulkCost * $quantity;
    $totalProfit = ($sellPrice - $bulkCost) * $quantity;

    $sql = "INSERT INTO products (name, bulk_price, sell_price, bulk_cost, quantity, total_cost, total_profit)
            VALUES ('$name', '$bulkPrice', '$sellPrice', '$bulkCost', '$quantity', '$totalCost', '$totalProfit')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully.";
    } else {
        echo "Error adding product: " . $conn->error;
    }
}

$conn->close();
?>
