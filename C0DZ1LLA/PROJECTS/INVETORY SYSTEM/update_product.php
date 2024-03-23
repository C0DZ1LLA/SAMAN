<?php
include 'db_connection.php'; // Include your database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["productId"];
    $action = $_POST["action"]; // Action: 'subtract' or 'add'

    if ($action === "subtract") {
        // Subtract from quantity and add to total profit
        $sql = "UPDATE products SET quantity = quantity - 1, total_profit = total_profit + price WHERE id = $productId";
    } elseif ($action === "add") {
        // Add to quantity (if needed) and subtract from total profit
        $sql = "UPDATE products SET quantity = quantity + 1, total_profit = total_profit - price WHERE id = $productId AND quantity > 0";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully.";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

$conn->close();
?>
