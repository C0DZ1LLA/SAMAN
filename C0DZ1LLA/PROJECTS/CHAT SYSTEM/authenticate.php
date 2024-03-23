<?php
include 'db_connection.php';

// Get data from the client-side
$data = json_decode(file_get_contents("php://input"));

// Sanitize input to prevent SQL injection (in production, use prepared statements)
$username = mysqli_real_escape_string($conn, $data->username);
$password = mysqli_real_escape_string($conn, $data->password);
$folderName = mysqli_real_escape_string($conn, $data->folderName);

// Query the database for the user's credentials for the specific folder using prepared statement
$stmt = $conn->prepare("SELECT * FROM folders WHERE folderName = ? AND password = ?");
$stmt->bind_param("ss", $folderName, $password);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($resultUsername, $resultPassword, $projectPath);
    $stmt->fetch();
    $response = array("authenticated" => true, "projectPath" => $projectPath);
} else {
    $response = array("authenticated" => false);
}

// Close the statement
$stmt->close();

// Send the JSON response to the client
echo json_encode($response);
?>
