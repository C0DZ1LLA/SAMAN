<?php
// Include database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Mark the record as "Deleted" instead of deleting it
    $sql = "UPDATE information SET status = 'Deleted' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Record marked as deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error marking record as deleted: ' . $conn->error]);
    }
}

$conn->close();
?>
