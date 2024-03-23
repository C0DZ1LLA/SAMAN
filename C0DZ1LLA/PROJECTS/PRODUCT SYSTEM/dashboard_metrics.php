<?php
include 'db_connection.php';

// Fetch total number of products
$sqlTotalProducts = "SELECT COUNT(*) AS totalProducts FROM products";
$resultTotalProducts = $conn->query($sqlTotalProducts);
$rowTotalProducts = $resultTotalProducts->fetch_assoc();
$totalProducts = $rowTotalProducts['totalProducts'];

// Fetch total revenue
$sqlTotalRevenue = "SELECT SUM(sell_price * quantity) AS totalRevenue FROM products";
$resultTotalRevenue = $conn->query($sqlTotalRevenue);
$rowTotalRevenue = $resultTotalRevenue->fetch_assoc();
$totalRevenue = $rowTotalRevenue['totalRevenue'];

// Fetch top selling products
$sqlTopSellingProducts = "SELECT name, SUM(quantity) AS quantitySold FROM products GROUP BY name ORDER BY quantitySold DESC LIMIT 5";
$resultTopSellingProducts = $conn->query($sqlTopSellingProducts);
$topSellingProducts = array();
while ($rowTopSellingProducts = $resultTopSellingProducts->fetch_assoc()) {
    $topSellingProducts[] = array(
        'name' => $rowTopSellingProducts['name'],
        'quantitySold' => $rowTopSellingProducts['quantitySold']
    );
}

// Combine all metrics data into an array
$metrics = array(
    'totalProducts' => $totalProducts,
    'totalRevenue' => $totalRevenue,
    'topSellingProducts' => $topSellingProducts
);

// Encode metrics data as JSON and output
echo json_encode($metrics);

$conn->close();
?>
