<?php
// add_product.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure required parameters are set
    $requiredParams = ["productName", "productQuantity", "bulkPrice", "retailPrice"];
    foreach ($requiredParams as $param) {
        if (!isset($_POST[$param])) {
            die("Error: Missing required parameter - $param");
        }
    }

    // Sanitize input values
    $productName = htmlspecialchars($_POST["productName"]);
    $productQuantity = (int)$_POST["productQuantity"];
    $bulkPrice = (float)$_POST["bulkPrice"];
    $retailPrice = (float)$_POST["retailPrice"];

    // Validate numeric values
    if (!is_numeric($productQuantity) || !is_numeric($bulkPrice) || !is_numeric($retailPrice)) {
        die("Error: Invalid numeric input");
    }

    // Calculate cost and profit difference
    $quantityCost = $bulkPrice * $productQuantity;
    $retailCost = $retailPrice * $productQuantity;
    $profitDifference = ($retailPrice - $bulkPrice) * $productQuantity;

    // If it's a box, double the profit difference
    if (isset($_POST["isBox"]) && $_POST["isBox"] == "true") {
        $profitDifference *= 2;
    }

    // Save product details to products_local.json
    $newProduct = [
        "productName" => $productName,
        "productQuantity" => $productQuantity,
        "bulkPrice" => $bulkPrice,
        "retailPrice" => $retailPrice,
        "quantityCost" => $quantityCost,
        "retailCost" => $retailCost,
        "profitDifference" => $profitDifference
    ];

    // Get existing products from local storage
    $existingProducts = json_decode(file_get_contents("products_local.json"), true) ?: [];

    // Add the new product to the array
    $existingProducts[] = $newProduct;

    // Save the updated array back to local storage
    file_put_contents("products_local.json", json_encode($existingProducts));

    echo "Product added successfully.";
}
?>
