<?php
include 'db_connection.php';

$sql = "SELECT * FROM information WHERE status NOT IN ('deleted', 'Error')";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
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

// Determine the option text for the selected price
$optionText = '';
switch ($row['price']) {
    case 0:
        $optionText = "NO WASH";
        break;
    case 10:
        $optionText = "NORMAL IN & OUT FOAM WASH";
        break;
    case 15:
        $optionText = "FOAM AND CERAMIC IN & OUT WASH";
        break;
    case 7:
        $optionText = "ONLY OUT WASH";
        break;
    case 5:
        $optionText = "ONLY IN WASH";
        break;
    case 5:
        $optionText = "ENGINE WASH";
        break;
    case 20:
        $optionText = "PLATINUM WASH";
        break;
    case 30:
        $optionText = "GOLD WASH";
        break;
    case 40:
        $optionText = "DIAMOND WASH";
        break;
    case 50:
        $optionText = "VIP WASH";
        break;
    default:
        $optionText = "UNKNOWN";
        break;
}

            // HTML output for each row
            echo "<div class='information'>";
            echo "<p>Vehicle Brand: " . htmlspecialchars($row['brand']) . "</p>";
            echo "<p>Vehicle Color: " . htmlspecialchars($row['color']) . "</p>";
            echo "<p>Vehicle Number: " . htmlspecialchars($row['id_number']) . "</p>";
            echo "<p>Status: " . htmlspecialchars($row['status']) . "</p>";
            echo "<p>Option: " . htmlspecialchars($optionText) . "</p>";
            echo "<p>Price: €<span id='price{$row['id']}'>" . htmlspecialchars($row['price']) . "</span></p>";
            echo "<p>Extra Price: €" . htmlspecialchars($row['extra_price']) . "</p>";
            echo "<p>Discount Percentage: %" . htmlspecialchars($row['discount_percentage']) . "</p>";
            echo "<p>Total Price: €" . htmlspecialchars($row['total_price']) . "</p>";
            
            echo "<button onclick='editInformation({$row['id']})'>EDIT</button>";
            echo "<button onclick='deleteInformation({$row['id']})'>DELETE</button>";

            echo "</div>";
        }
    } else {
        echo "No information available";
    }
} else {
    // Handle SQL query error
    echo "Error: " . $conn->error;
}

$conn->close();
?>
