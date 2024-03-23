<?php
include 'db_connection.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-item'>";
        echo "<h2>" . htmlspecialchars($row["name"]) . "</h2>";
        echo "<p>Bulk Cost: $" . htmlspecialchars($row["bulk_cost"]) . "</p>";
        echo "<p>Sell Price: $" . htmlspecialchars($row["sell_price"]) . "</p>";
        echo "<p>Quantity: " . htmlspecialchars($row["quantity"]) . "</p>";
        echo "<p>Total Cost: $" . htmlspecialchars($row["total_cost"]) . "</p>";
        echo "<p>Total Profit: $" . htmlspecialchars($row["total_profit"]) . "</p>";
        echo "<button onclick='editProduct(" . $row["id"] . ")'>Edit</button>";
        echo "<button onclick='deleteProduct(" . $row["id"] . ")'>Delete</button>";
        echo "</div>";
    }
} else {
    echo "No products available.";
}

$conn->close();
?>
