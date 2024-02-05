<?php
include 'db_connection.php';  // Include your database connection file
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$resultsQuery = "SELECT choice, COUNT(*) as count FROM poll_data GROUP BY choice";
$resultsResult = $conn->query($resultsQuery);

$liveResults = [
    'option1' => 0,
    'option2' => 0
];

while ($row = $resultsResult->fetch_assoc()) {
    $choice = $row['choice'];
    $count = $row['count'];
    $liveResults["option$choice"] = $count;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($liveResults);
?>
