document.addEventListener("DOMContentLoaded", function() {
    // Function to fetch and display products
    function displayProducts() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_products.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    var products = JSON.parse(xhr.responseText);
                    var productContainer = document.getElementById("product-container");
                    productContainer.innerHTML = ""; // Clear previous content
                    products.forEach(function(product) {
                        var productItem = document.createElement("div");
                        productItem.classList.add("product-item");
                        productItem.innerHTML = `
                            <h2>${product.name}</h2>
                            <p>Price: $${product.price}</p>
                            <p>Quantity: ${product.quantity}</p>
                            <p>Total Profit: $${product.total_profit}</p>
                            <input type="number" id="add-quantity-${product.id}" placeholder="Quantity to add">
                            <button id="add-btn-${product.id}">Add Quantity</button>
                            <button id="subtract-btn-${product.id}">Subtract Quantity</button>
                        `;
                        // Add click event listener to subtract quantity
                        productItem.querySelector(`#subtract-btn-${product.id}`).addEventListener("click", function() {
                            var newQuantity = parseInt(product.quantity) - 1;
                            if (newQuantity >= 0) {
                                updateQuantity(product.id, newQuantity);
                                product.quantity = newQuantity;
                                productItem.querySelector("p:nth-child(3)").textContent = "Quantity: " + newQuantity;
                            } else {
                                alert("Out of stock!");
                            }
                        });
                        // Add click event listener to add quantity
                        productItem.querySelector(`#add-btn-${product.id}`).addEventListener("click", function() {
                            var additionalQuantity = parseInt(productItem.querySelector(`#add-quantity-${product.id}`).value);
                            if (additionalQuantity > 0) {
                                updateQuantity(product.id, product.quantity + additionalQuantity);
                                product.quantity += additionalQuantity;
                                productItem.querySelector("p:nth-child(3)").textContent = "Quantity: " + product.quantity;
                            } else {
                                alert("Please enter a valid quantity to add.");
                            }
                        });
                        productContainer.appendChild(productItem);
                    });
                } else {
                    console.error("Error fetching products: " + xhr.responseText);
                }
            }
        };
        xhr.send();
    }

// Function to update quantity
function updateQuantity(productId, newQuantity) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_quantity.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                // Quantity updated successfully, no need to do anything
            } else {
                console.error("Error updating quantity: " + xhr.responseText);
            }
        }
    };
    xhr.send("id=" + encodeURIComponent(productId) + "&quantity=" + encodeURIComponent(newQuantity));
}


// Periodically fetch and display products every 5 seconds
setInterval(displayProducts, 5000);


    // Display products when the page loads
    displayProducts();
});
