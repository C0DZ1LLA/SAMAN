<?php
// display_products.php

// Get existing products from local storage
$existingProducts = json_decode(file_get_contents("products_local.json"), true) ?: [];

// Display products with bulk price, retail price, and cost
if (!empty($existingProducts)) {
    foreach ($existingProducts as $product) {
        echo <<<HTML
        <div class='product'>
            <p>Name: {$product['productName']}</p>
            <p>Quantity: {$product['productQuantity']}</p>
            <p>Bulk Price: $ {$product['bulkPrice']}</p>
            <p>Retail Price: $ {$product['retailPrice']}</p>
            <p>Quantity Cost: $ {$product['quantityCost']}</p>
            <p>Retail Cost: $ {$product['retailCost']}</p>
            <p>Profit Difference: $ {$product['profitDifference']}</p>
        </div>
HTML;
    }
} else {
    echo "No products available";
}
?>
