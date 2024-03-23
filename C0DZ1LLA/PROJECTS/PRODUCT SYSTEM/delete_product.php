<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    $sql = "DELETE FROM products WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

$conn->close();
?>
