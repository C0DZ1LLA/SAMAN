<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Validate and sanitize input
    $id = intval($_GET["id"]); // Ensure $id is an integer

    // Use a prepared statement to retrieve the status
    $stmt = $conn->prepare("SELECT status FROM information WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($status);

    // Check if a row was found
    if ($stmt->fetch()) {
        // Construct a JSON response
        $response = array(
            "status" => htmlspecialchars($status)
        );
        echo json_encode($response); // Return JSON response
    } else {
        // If no row was found, return a JSON response with an error message
        $response = array(
            "error" => "Status not available"
        );
        echo json_encode($response); // Return JSON response
    }

    // Close the statement
    $stmt->close();
}

$conn->close();
?>
