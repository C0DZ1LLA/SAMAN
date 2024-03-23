<?php
include 'db_connection.php';

$sql = "SELECT * FROM information WHERE status NOT IN ('deleted', 'Error')";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Start the main container for columns
        echo "<div class='columns'>";

        while ($row = $result->fetch_assoc()) {
            // Set color based on status
            $statusColor = '';
            switch ($row['status']) {
                case 'Wash':
                    $statusColor = 'red';
                    break;
                case 'Pending':
                    $statusColor = 'red';
                    break;
                case 'Ready':
                    $statusColor = 'green';
                    break;
                default:
                    $statusColor = 'orange';
                    break;
            }

            // Calculate the total price
            $selectPrice = floatval($row["price"]);
            $extraPrice = floatval($row["extra_price"]);
            $discountPercentage = floatval($row["discount_percentage"]);
            
            // Calculate the total price by adding the select price and extra price
            $totalPrice = $selectPrice + $extraPrice;

            // Apply discount if any
            $discountAmount = $totalPrice * ($discountPercentage / 100);
            $totalPrice -= $discountAmount;

            // Update the total price in the database
            $updateStmt = $conn->prepare("UPDATE information SET total_price = ? WHERE id = ?");
            $updateStmt->bind_param("di", $totalPrice, $row["id"]);
            $updateStmt->execute();

            // Start a new container for each information row
            echo "<div class='column'>";
            // HTML output for each row
            echo "<div class='container' style='text-align: center; padding: 40px; color: $statusColor;'>";
            echo "<div class='information'>";
            echo "<p style='font-size: 36px;'>Vehicle Brand: " . htmlspecialchars($row['brand']) . "</p>";
            echo "<p style='font-size: 36px;'>Vehicle Color: " . htmlspecialchars($row['color']) . "</p>";
            echo "<p style='font-size: 36px;'>Vehicle Number: " . htmlspecialchars($row['id_number']) . "</p>";
            echo "<p style='font-size: 36px;'>Status: " . htmlspecialchars($row['status']) . "</p>";
            echo "</div>"; // Close the information container
            echo "</div>"; // Close the main container
            echo "</div>"; // Close the column
        }

        // End the main container for columns
        echo "</div>";
    } else {
        echo "No information available";
    }
} else {
    // Handle SQL query error
    echo "Error: " . $conn->error;
}

$conn->close();
?>
