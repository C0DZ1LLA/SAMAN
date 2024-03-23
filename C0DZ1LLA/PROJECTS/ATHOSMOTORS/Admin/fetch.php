<?php
// Include your database connection
include 'db_connection.php';

// Query to select all information from the database
$sql = "SELECT * FROM information";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Output HTML for each information entry

        echo "<div class='information'>";
        echo "<p>Vehicle Brand: " . htmlspecialchars($row['brand']) . "</p>";
        echo "<p>Vehicle Color: " . htmlspecialchars($row['color']) . "</p>";
        echo "<p>Vehicle Number: " . htmlspecialchars($row['id_number']) . "</p>";
        echo "<p>Status: " . htmlspecialchars($row['status']) . "</p>";
        echo "<p>Price: €" . htmlspecialchars($row['price']) . "</p>";
        echo "<p>Extra Price: €" . htmlspecialchars($row['extra_price']) . "</p>";
        echo "<p>Discount Percentage: %" . htmlspecialchars($row['discount_percentage']) . "</p>";
        echo "<p>Total Price: €" . htmlspecialchars($row['total_price']) . "</p>";
        
        // Add more fields as needed
        echo "</div>";
    }
} else {
    // Output message if no information is available
    echo "No information available";
}

// Close the database connection
$conn->close();
?>
