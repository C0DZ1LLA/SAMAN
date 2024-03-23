<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = mysqli_real_escape_string($conn, $_GET["query"]);

    $sql = "SELECT * FROM products WHERE name LIKE '%$query%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Output product information as in display_products.php
        }
    } else {
        echo "No matching products found.";
    }
}

$conn->close();
?>
