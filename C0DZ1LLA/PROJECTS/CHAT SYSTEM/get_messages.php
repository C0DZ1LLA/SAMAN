<?php
include 'db_connection.php';

$sql = "SELECT * FROM messages ORDER BY timestamp DESC";
$result = $conn->query($sql);

if ($result === false) {
    // Handle the error
    echo "Error: " . $conn->error . "<br>";
    echo "Query: " . $sql;
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $username = htmlspecialchars($row["username"]);
            $message = htmlspecialchars($row["message"]);
            $timestamp = htmlspecialchars($row["timestamp"]);

            echo "<p><strong>{$username}:</strong> {$message} <span>({$timestamp})</span></p>";
        }
    } else {
        echo "No messages yet.";
    }
}

$conn->close();
?>
