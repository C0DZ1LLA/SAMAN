<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $choice = isset($_POST['choice']) ? $_POST['choice'] : null;

    if ($choice && ($choice == 1 || $choice == 2)) {
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        include 'db_connection.php';  // Include your database connection file
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $checkQuery = "SELECT * FROM poll_data WHERE ip_address = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("s", $ipAddress);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $insertQuery = "INSERT INTO poll_data (ip_address, choice) VALUES (?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("si", $ipAddress, $choice);
            $stmt->execute();
            echo "success";
        } else {
            echo "duplicate";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "invalid_choice";
    }
} else {
    echo "invalid_request";
}
?>
