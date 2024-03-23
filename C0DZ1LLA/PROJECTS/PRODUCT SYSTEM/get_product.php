<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product = [
            "name" => $row["name"],
            "bulk_price" => $row["bulk_price"],
            "sell_price" => $row["sell_price"],
            "bulk_cost" => $row["bulk_cost"],
            "quantity" => $row["quantity"]
        ];

        echo json_encode($product);
    } else {
        echo "Product not found.";
    }
}

$conn->close();
?>
