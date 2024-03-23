<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $bulkPrice = mysqli_real_escape_string($conn, $_POST["bulkPrice"]);
    $sellPrice = mysqli_real_escape_string($conn, $_POST["sellPrice"]);
    $bulkCost = mysqli_real_escape_string($conn, $_POST["bulkCost"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

    $totalCost = $bulkCost * $quantity;
    $totalProfit = ($sellPrice - $bulkCost) * $quantity;

    $sql = "UPDATE products 
            SET name = '$name', bulk_price = '$bulkPrice', sell_price = '$sellPrice', 
                bulk_cost = '$bulkCost', quantity = '$quantity', 
                total_cost = '$totalCost', total_profit = '$totalProfit'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully.";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

$conn->close();
?>
