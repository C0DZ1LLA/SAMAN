<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $id = intval($_POST["id"]); // Ensure $id is an integer
    $newStatus = mysqli_real_escape_string($conn, $_POST["status"]);

    // Check if the new status is valid (assuming you have a predefined list of valid statuses)
    $validStatuses = ['In Wash', 'Pending', 'Ready']; // Example of valid statuses
    if (!in_array($newStatus, $validStatuses)) {
        echo "Error: Invalid status.";
        exit; // Stop script execution
    }

    $stmt = $conn->prepare("UPDATE information SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $newStatus, $id);

    if ($stmt->execute()) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
