<?php
include 'db_connection.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve parameters
$productId = $_POST['id'];
$newQuantity = $_POST['quantity'];


// Fetch product data
$sql_fetch_product = "SELECT * FROM products WHERE id=$productId";
$result_fetch_product = $conn->query($sql_fetch_product);
$row = $result_fetch_product->fetch_assoc();
$price = $row['price'];
$currentQuantity = $row['quantity'];
$currentTotalProfit = $row['total_profit'];

// Calculate total profit earned from selling the product
if ($newQuantity < $currentQuantity) {
    $quantitySold = $currentQuantity - $newQuantity;
    $totalProfit = $currentTotalProfit + ($quantitySold * $price);
} else {
    $totalProfit = $currentTotalProfit;
}
   // Update quantity in database
   $sql = "UPDATE products SET quantity = $newQuantity, total_profit = price * $newQuantity, total_quantity = $newQuantity WHERE id = $productId";

   if (mysqli_query($conn, $sql)) {
       echo "Quantity updated successfully";
   } else {
       echo "Error updating quantity: " . mysqli_error($conn);
   }
// Update quantity and total profit in the database
$sql = "UPDATE products SET quantity=$newQuantity, total_profit=$totalProfit WHERE id=$productId";
if ($conn->query($sql) === TRUE) {
    echo "Quantity updated successfully";
} else {
    echo "Error updating quantity: " . $conn->error;
}

$conn->close();
?>