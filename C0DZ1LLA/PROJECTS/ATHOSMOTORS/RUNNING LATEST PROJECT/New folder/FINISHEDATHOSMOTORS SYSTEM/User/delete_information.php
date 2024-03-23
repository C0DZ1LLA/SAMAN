<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Mark the record as "deleted" or "Error" instead of deleting
    $sql = "UPDATE information SET status = 'deleted' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record marked as deleted successfully.";
    } else {
        echo "Error marking record as deleted: " . $conn->error;
    }
}

$conn->close();
?>
