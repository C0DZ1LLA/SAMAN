// Utility function to format numbers
function formatNumber(number) {
    return number !== undefined && number !== null ? "€" + number.toFixed(2) : "€0.00";
}

// Calculator functions
function calculate(operation) {
    var num1 = parseFloat(document.getElementById('num1').value);
    var num2 = parseFloat(document.getElementById('num2').value);
    var result = 0;

    switch (operation) {
        case 'add':
            result = num1 + num2;
            break;
        case 'subtract':
            result = num1 - num2;
            break;
        case 'multiply':
            result = num1 * num2;
            break;
        case 'divide':
            result = num1 / num2;
            break;
        default:
            break;
    }

    document.getElementById('calcResult').textContent = result.toFixed(2);

    // Store the result in a data attribute for later use in VAT calculation
    document.getElementById('calcResult').setAttribute('data-result', result);
}

// VAT calculation function
function calculateVAT() {
    var vatPercentage = parseFloat(document.getElementById('vatPercentage').value);

    // Check if the entered percentage is valid
    if (isNaN(vatPercentage) || vatPercentage < 0) {
        alert("Please enter a valid VAT percentage.");
        return;
    }

    // Retrieve the result from the data attribute
    var result = parseFloat(document.getElementById('calcResult').getAttribute('data-result'));

    // Check if the result is valid
    if (isNaN(result)) {
        alert("Please perform a calculation before calculating VAT.");
        return;
    }

    // Calculate VAT amount
    var vatResult = result * (vatPercentage / 100);

    document.getElementById('vatCalculationResult').textContent = vatResult.toFixed(2);
}

// Product functions
function addProduct() {
    var productName = document.getElementById('productName').value;
    var productQuantity = parseInt(document.getElementById('productQuantity').value, 10);
    var bulkPrice = parseFloat(document.getElementById('bulkPrice').value);
    var retailPrice = parseFloat(document.getElementById('retailPrice').value);
    var isBox = document.getElementById('isBox').checked;
    var boxQuantity = isBox ? parseInt(document.getElementById('boxQuantity').value, 10) || 1 : 1; // Default to 1 if not provided

    // Calculate cost and profit difference
    var quantityCost = bulkPrice * productQuantity;
    var retailCost = retailPrice * productQuantity;
    var profitDifference = (retailPrice - bulkPrice) * productQuantity;

    // If it's a box, update properties for the box
    if (isBox) {
        productQuantity *= boxQuantity;
        quantityCost = bulkPrice * productQuantity;
        retailCost = retailPrice * productQuantity;
        profitDifference = (retailPrice - bulkPrice) * productQuantity;
    }

    // Create a product object
    var product = {
        productName: productName,
        productQuantity: productQuantity,
        bulkPrice: bulkPrice,
        retailPrice: retailPrice,
        quantityCost: quantityCost,
        retailCost: retailCost,
        profitDifference: profitDifference
    };

    // If it's a box, add box-related properties to the new product
    if (isBox) {
        product.isBox = true;
        product.boxQuantity = boxQuantity;
        product.boxBulkPrice = bulkPrice * boxQuantity;
        product.boxRetailPrice = retailPrice * boxQuantity;
    }

    // Get existing products from local storage
    var existingProducts = JSON.parse(localStorage.getItem('products')) || [];

    // Add the new product to the array
    existingProducts.push(product);

    // Save the updated array back to local storage
    localStorage.setItem('products', JSON.stringify(existingProducts));

    // Update the product list and total profit
    updateProductList();
    updateTotalProfit();
}

function updateProductList() {
    // Get products from local storage
    var storedProducts = JSON.parse(localStorage.getItem('products')) || [];

    // Display products
    var productListDiv = document.getElementById('productList');
    productListDiv.innerHTML = ''; // Clear previous content

    storedProducts.forEach(function (product, index) {
        var productDiv = document.createElement('div');
        productDiv.className = 'product';

        // Update calculations for quantityCost, retailCost, and profitDifference
        var quantityCost = product.bulkPrice * product.productQuantity;
        var retailCost = product.retailPrice * product.productQuantity;
        var profitDifference = (product.retailPrice - product.bulkPrice) * product.productQuantity;

        if (product.isBox) {
            product.productQuantity *= product.boxQuantity;
            quantityCost = product.bulkPrice * product.productQuantity;
            retailCost = product.retailPrice * product.productQuantity;
            profitDifference = (product.retailPrice - product.bulkPrice) * product.productQuantity;
        }

        productDiv.innerHTML =
            "<p>Name: " + (product.productName || '') + "</p>" +
            "<p>Quantity: " + (product.productQuantity || '') + "</p>" +
            "<p>Bulk Price: " + formatNumber(product.bulkPrice) + "</p>" +
            "<p>Retail Price: " + formatNumber(product.retailPrice) + "</p>" +
            "<p>Quantity Cost: " + formatNumber(quantityCost) + "</p>" +
            "<p>Retail Cost: " + formatNumber(retailCost) + "</p>" +
            "<p>Profit Difference: " + formatNumber(profitDifference) + "</p>" +
            "<button onclick=\"editProduct(" + index + ")\">Edit</button>" +
            "<button onclick=\"deleteProduct(" + index + ")\">Delete</button>";

        productListDiv.appendChild(productDiv);
    });
}

function saveText() {
    var textInput = document.getElementById("textInput").value;

    // Save text locally (for simplicity, using localStorage)
    var savedTexts = JSON.parse(localStorage.getItem('savedTexts')) || [];
    savedTexts.push(textInput);
    localStorage.setItem('savedTexts', JSON.stringify(savedTexts));

    alert("Text saved: " + textInput);
    closeModal();
    updateSavedTexts(); // Update the displayed saved texts
}

function updateSavedTexts() {
    var savedTexts = JSON.parse(localStorage.getItem('savedTexts')) || [];
    var savedTextsDiv = document.getElementById('savedTexts');

    // Clear previous content
    savedTextsDiv.innerHTML = '';

    // Display saved texts
    savedTexts.forEach(function (text) {
        var textDiv = document.createElement('div');
        textDiv.className = 'saved-text';
        textDiv.textContent = text;
        savedTextsDiv.appendChild(textDiv);
    });
}

function updateTotalProfit() {
    // Get products from local storage
    var storedProducts = JSON.parse(localStorage.getItem('products')) || [];

    // Calculate total profit difference
    var totalProfit = storedProducts.reduce(function (total, product) {
        var profitDifference = (product.retailPrice - product.bulkPrice) * product.productQuantity;

        if (product.isBox) {
            profitDifference = (product.retailPrice - product.bulkPrice) * product.productQuantity;
        }

        return total + profitDifference;
    }, 0);

    // Check if totalProfit is NaN or undefined
    if (isNaN(totalProfit) || totalProfit === undefined) {
        totalProfit = 0;
    }

    // Update total profit value in the UI
    document.getElementById('totalProfitValue').textContent = (totalProfit);
}

// Function to update the edited product
function updateProduct() {
    var storedProducts = JSON.parse(localStorage.getItem('products')) || [];
    var indexToEdit = localStorage.getItem('indexToEdit');

    // Retrieve the edited product details from the form
    var editedProduct = {
        productName: document.getElementById('editProductName').value,
        productQuantity: parseInt(document.getElementById('editProductQuantity').value, 10) || 0, // Handle NaN or non-numeric input
        bulkPrice: parseFloat(document.getElementById('editBulkPrice').value) || 0, // Handle NaN or non-numeric input
        retailPrice: parseFloat(document.getElementById('editRetailPrice').value) || 0, // Handle NaN or non-numeric input
        isBox: document.getElementById('editIsBox').checked,
        boxQuantity: parseInt(document.getElementById('editBoxQuantity').value, 10) || 1
    };

    // Update the product at the specified index
    storedProducts[indexToEdit] = editedProduct;

    // If it's a box, update properties for the box
    if (editedProduct.isBox) {
        editedProduct.productQuantity *= editedProduct.boxQuantity;
    }

    // Save the updated array back to local storage
    localStorage.setItem('products', JSON.stringify(storedProducts));

    // Close the edit modal
    closeModal();

    // Update the product list and total profit
    updateProductList();
    updateTotalProfit();
}

// Function to edit a product
function editProduct(index) {
    // Save the index of the product being edited to local storage
    localStorage.setItem('indexToEdit', index);

    // Open the edit modal with the stored index
    openEditModal(index);
}

// Function to open the edit modal
function openEditModal(index) {
    var storedProducts = JSON.parse(localStorage.getItem('products')) || [];
    var productToEdit = storedProducts[index];

    // Populate the edit form fields with the product details
    document.getElementById('editProductName').value = productToEdit.productName;
    document.getElementById('editProductQuantity').value = productToEdit.productQuantity;
    document.getElementById('editBulkPrice').value = productToEdit.bulkPrice;
    document.getElementById('editRetailPrice').value = productToEdit.retailPrice;
    document.getElementById('editIsBox').checked = productToEdit.isBox || false;
    document.getElementById('editBoxQuantity').value = productToEdit.boxQuantity || 1;

    // Display the edit modal
    document.getElementById('editProductModal').style.display = 'block';
}

// Function to delete a product
function deleteProduct(index) {
    var storedProducts = JSON.parse(localStorage.getItem('products')) || [];

    // Remove the product at the specified index
    storedProducts.splice(index, 1);

    // Save the updated array back to local storage
    localStorage.setItem('products', JSON.stringify(storedProducts));

    // Update the product list and total profit
    updateProductList();
    updateTotalProfit();
}

// Function to close the edit modal
function closeModal() {
    document.getElementById('editProductModal').style.display = 'none';
}

// Initial product list update
updateProductList();
// Initial total profit update
updateTotalProfit();
