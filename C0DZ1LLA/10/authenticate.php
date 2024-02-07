<?php
include 'db_connection.php'
session_start();

function authenticateUser($username, $password, $conn) {
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $dbUsername, $dbPassword);
        $stmt->fetch();

        if (password_verify($password, $dbPassword)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $dbUsername;
            return true;
        }
    }

    $stmt->close();
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    include 'db_connection.php';  // Include your database connection file
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (authenticateUser($username, $password, $conn)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
