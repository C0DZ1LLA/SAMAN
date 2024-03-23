<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO messages (username, message, ip_address) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $message, $ip_address);

    if ($stmt->execute()) {
        echo "Message saved successfully.";
    } else {
        echo "Error saving message.";
    }

    // Close the statement
    $stmt->close();
}

// Load and display messages in bottom-to-top order
$sql = "SELECT * FROM messages ORDER BY timestamp DESC";
$result = $conn->query($sql);

if ($result === false) {
    // Print the error message and SQL query for debugging purposes
    echo "Error: " . $conn->error . "<br>";
    echo "Query: " . $sql;
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p><strong>" . htmlspecialchars($row["username"]) . ":</strong> " . htmlspecialchars($row["message"]) . " <span>(" . htmlspecialchars($row["timestamp"]) . ")</span></p>";
        }
    } else {
        echo "No messages yet.";
    }
}

$conn->close();
?>
