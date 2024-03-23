<?php
include 'db_connection.php';

// Select all records from the database
$sql = "SELECT * FROM information";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize an empty CSV string
    $csv = '';

    // Add column headers to the CSV string
    $csv .= "Brand,Color,ID Number,Status,Price,Extra Price,Discount Percentage,Total Price,Date\n";

    // Loop through each row and add data to the CSV string
    while ($row = $result->fetch_assoc()) {
        // Format the date
        $date = date('Y-m-d H:i:s', strtotime($row['timestamp']));

        // Add row data to the CSV string
        $csv .= "{$row['brand']},{$row['color']},{$row['id_number']},{$row['status']},{$row['price']},{$row['extra_price']},{$row['discount_percentage']},{$row['total_price']},{$date}\n";
    }

    // Send headers to force download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="information.csv"');

    // Output the CSV string
    echo $csv;
} else {
    echo "No records found";
}

$conn->close();
?>
