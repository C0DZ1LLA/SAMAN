<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = mysqli_real_escape_string($conn, $_POST["productId"]);
    $quantityToRemove = mysqli_real_escape_string($conn, $_POST["quantityToRemove"]);

    // Get product details
    $sql = "SELECT * FROM products WHERE id = '$productId'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentQuantity = $row["quantity"];
        $sellPrice = $row["sell_price"];
        $bulkCost = $row["bulk_cost"];
        $profit = $row["profit"]; // Added this line to retrieve the current profit
    } else {
        echo "Product not found.";
        exit();
    }

    // Calculate total profit for the transaction
    $profitChange = ($sellPrice - $bulkCost) * $quantityToRemove; // Calculate profit change for this transaction
    $newProfit = $profit + $profitChange; // Calculate new profit

    // Update quantity and total profit in database
    $newQuantity = $currentQuantity - $quantityToRemove;
    $sql = "UPDATE products SET quantity = '$newQuantity', profit = '$newProfit' WHERE id = '$productId'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Quantity subtracted successfully.";
    } else {
        echo "Error subtracting quantity: " . $conn->error;
    }
}

$conn->close();
?>
