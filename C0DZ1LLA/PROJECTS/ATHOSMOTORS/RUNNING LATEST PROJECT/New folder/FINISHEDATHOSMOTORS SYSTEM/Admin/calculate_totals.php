<?php
include 'db_connection.php';

// Function to calculate totals
function calculateTotals() {
    global $conn;

    // Total number of brands
    $sql = "SELECT brand, COUNT(*) AS total_count FROM information GROUP BY brand";
    $result = $conn->query($sql);
    $brandTotals = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $brandTotals[$row['brand']] = $row['total_count'];
        }
    }

    // Total discounts given by brand
    $sql = "SELECT brand, SUM(discount_percentage) AS total_discounts FROM information GROUP BY brand";
    $result = $conn->query($sql);
    $brandDiscounts = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $brandDiscounts[$row['brand']] = $row['total_discounts'];
        }
    }

    // Other calculations...

    // Prepare the data to be returned
    $totalsData = array(
        'total_brands' => count($brandTotals),
        'brand_totals' => $brandTotals,
        'brand_discounts' => $brandDiscounts,
        // Add other totals here...
    );

    return $totalsData;
}

// Call the function and echo the JSON response
echo json_encode(calculateTotals());

$conn->close();
?>
