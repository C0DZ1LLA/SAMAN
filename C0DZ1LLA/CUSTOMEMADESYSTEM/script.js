document.addEventListener("DOMContentLoaded", function() {
    // Retrieve products from local storage or set default products
    let products = JSON.parse(localStorage.getItem('products')) || [
        { id: 1, name: "Colombia Las Flores Packaged 200g", price: 9.05, quantity: 0, total_profit: 0.00, category: "Microfarm Project" },
    { id: 2, name: "Espresso Master Blend Packed 250g", price: 7.81, quantity: 0, total_profit: 0.00, category: "Espresso" },
    { id: 2, name: "Espresso Master Blend Packed 250g", price: 7.81, quantity: 0, total_profit: 0.00, category: "Espresso" },
    { id: 3, name: "Espresso Silk River Blend Packaged 250g", price: 7.24, quantity: 0, total_profit: 0.00, category: "Espresso" },
    { id: 4, name: "Espresso Volcano Blend Packed 250g", price: 7.14, quantity: 0, total_profit: 0.00, category: "Espresso" },
    { id: 5, name: "Espresso Master Blend (Bulk)", price: 4.36, quantity: 0, total_profit: 0.00, category: "Espresso" },
    { id: 6, name: "Espresso Silk River Blend (Bulk)", price: 4.07, quantity: 0, total_profit: 0.00, category: "Espresso" },
    { id: 7, name: "Rwanda Gisanga Packed 200g", price: 7.62, quantity: 0, total_profit: 0.00, category: "Single Varieties" },
    { id: 8, name: "Colombia Dulima Packed 200g", price: 7.14, quantity: 0, total_profit: 0.00, category: "Single Varieties" },
    { id: 9, name: "Ethiopia Guji Packed 200g", price: 7.33, quantity: 0, total_profit: 0.00, category: "Single Varieties" },
    { id: 10, name: "Peru Santa Teresa Packaged 200g", price: 7.33, quantity: 0, total_profit: 0.00, category: "Single Varieties" },
    { id: 11, name: "Indonesia Sumatra Packaged 200g", price: 7.33, quantity: 0, total_profit: 0.00, category: "Single Varieties" },
    { id: 12, name: "Brazil Alta Mogiana Packaged 200g", price: 7.14, quantity: 0, total_profit: 0.00, category: "Single Varieties" },
    { id: 13, name: "Colombia Organic Packaged 200g", price: 7.62, quantity: 0, total_profit: 0.00, category: "Single Varieties" },
    { id: 14, name: "Colombia Dulima (Bulk)", price: 4.57, quantity: 0, total_profit: 0.00, category: "Single Varieties" },
    { id: 15, name: "Ethiopia Guji (Bulk)", price: 4.86, quantity: 0, total_profit: 0.00, category: "Single Varieties" },
    { id: 16, name: "Peru Santa Teresa (Bulk)", price: 4.86, quantity: 0, total_profit: 0.00, category: "Single Varieties" },
    { id: 17, name: "Indonesia Sumatra (Bulk)", price: 4.86, quantity: 0, total_profit: 0.00, category: "Single Varieties" },
    { id: 18, name: "Brazil Alta Mogiana (Bulk)", price: 4.57, quantity: 0, total_profit: 0.00, category: "Single Varieties" },
    { id: 19, name: "Espresso Affection Aluminum Capsules (10 pcs)", price: 4.10, quantity: 0, total_profit: 0.00, category: "Capsules" },
    { id: 20, name: "Espresso Serenity Aluminum Capsules (10 pcs)", price: 4.10, quantity: 0, total_profit: 0.00, category: "Capsules" },
    { id: 21, name: "Espresso Bliss Aluminum Capsules (10 pcs)", price: 4.10, quantity: 0, total_profit: 0.00, category: "Capsules" },
    { id: 22, name: "Euphoria Espresso Aluminum Capsules (10 pcs)", price: 4.10, quantity: 0, total_profit: 0.00, category: "Capsules" },
    { id: 23, name: "Compassion Espresso Aluminum Capsules (10 pcs)", price: 4.29, quantity: 0, total_profit: 0.00, category: "Capsules" },
    { id: 24, name: "Espresso Colombia Aluminum Capsules (10 pcs)", price: 4.29, quantity: 0, total_profit: 0.00, category: "Capsules" },
    { id: 25, name: "Espresso Peru Aluminum Capsules (10 pcs)", price: 4.29, quantity: 0, total_profit: 0.00, category: "Capsules" },
    { id: 26, name: "Indonesia Organic Espresso Aluminum Capsules (10 pcs)", price: 4.57, quantity: 0, total_profit: 0.00, category: "Capsules" },
    { id: 27, name: "Day Dream Blend Packaged 250g", price: 5.62, quantity: 0, total_profit: 0.00, category: "Filter" },
    { id: 28, name: "Day Dream Blend (Bulk)", price: 3.07, quantity: 0, total_profit: 0.00, category: "Filter" },
    { id: 29, name: "Déjà Vu Blend Packaged 250g", price: 5.33, quantity: 0, total_profit: 0.00, category: "Filter" },
    { id: 30, name: "Déjà Vu Blend (Bulk)", price: 3.00, quantity: 0, total_profit: 0.00, category: "Filter" },
    { id: 31, name: "Filter Aromatic 'Banoffee' Packaged 200gr", price: 5.52, quantity: 0, total_profit: 0.00, category: "Aromatic Filter" },
    { id: 32, name: "Filter Aromatic 'Bueno' Packaged 200gr", price: 5.52, quantity: 0, total_profit: 0.00, category: "Aromatic Filter" },
    { id: 33, name: "Aromatic (Bulk)", price: 3.83, quantity: 0, total_profit: 0.00, category: "Aromatic Filter" },
    { id: 34, name: "Silent Breeze 200gr", price: 6.67, quantity: 0, total_profit: 0.00, category: "Decaffeine" },
    { id: 35, name: "Caramel Breeze 200g", price: 6.29, quantity: 0, total_profit: 0.00, category: "Decaffeine" },
    { id: 36, name: "Cypriot Special Packaged 170g", price: 2.67, quantity: 0, total_profit: 0.00, category: "Greek / Cypriot" },
    { id: 37, name: "Cypriot Dark Coffee Packaged 170gr", price: 2.57, quantity: 0, total_profit: 0.00, category: "Greek / Cypriot" },
    { id: 38, name: "Cypriot Decaffeinated Packed 170g", price: 3.24, quantity: 0, total_profit: 0.00, category: "Greek / Cypriot" },
    { id: 39, name: "Cypriot Coffee Traditional Packed 170gr", price: 2.48, quantity: 0, total_profit: 0.00, category: "Greek / Cypriot" },
    { id: 40, name: "Greek Coffee Traditional (Bulk)", price: 1.90, quantity: 0, total_profit: 0.00, category: "Greek / Cypriot" },
    { id: 41, name: "Greek Dark Coffee (Bulk)", price: 2.04, quantity: 0, total_profit: 0.00, category: "Greek / Cypriot" },
    { id: 42, name: "Greek Coffee Special (Bulk)", price: 2.21, quantity: 0, total_profit: 0.00, category: "Greek / Cypriot" },
    { id: 43, name: "Coffeeccino Packed 200g", price: 4.29, quantity: 0, total_profit: 0.00, category: "Momentary" },
    { id: 44, name: "Instant Classic Packed 100g", price: 3.05, quantity: 0, total_profit: 0.00, category: "Momentary" },
    { id: 45, name: "Instant Flavored Caramel Packaged 100g", price: 3.71, quantity: 0, total_profit: 0.00, category: "Momentary" },
    { id: 46, name: "Chocolate Drink Sugar Free Packaged 250g", price: 4.50, quantity: 0, total_profit: 0.00, category: "Chocolates" },
    { id: 47, name: "Chocolate Drink with Hazelnut Flavor Packaged 250g", price: 4.50, quantity: 0, total_profit: 0.00, category: "Chocolates" },
    { id: 48, name: "Chocolate Drink Packaged 250g", price: 3.40, quantity: 0, total_profit: 0.00, category: "Chocolates" },
    { id: 49, name: "Earl Gray Pyramid (Black Tea) (10 pcs.)", price: 2.50, quantity: 0, total_profit: 0.00, category: "Tea" },
    { id: 50, name: "English Breakfast Pyramid (Black Tea) (10 pcs.)", price: 2.50, quantity: 0, total_profit: 0.00, category: "Tea" },
    { id: 51, name: "Green Tea Pyramid (10 pcs.)", price: 2.50, quantity: 0, total_profit: 0.00, category: "Tea" },
    { id: 52, name: "Pyramid Cinnamon Spicy Herbal Tea (10 pcs.)", price: 3.00, quantity: 0, total_profit: 0.00, category: "Herbs" },
    { id: 53, name: "Pyramid Ginger Blend Herbal Tea (10 pcs.)", price: 3.00, quantity: 0, total_profit: 0.00, category: "Herbs" },
        // Eco Friendly
        { id: 54, name: "Reusable Mug Gray 12oz", price: 13.50, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 55, name: "Reusable Mug Blue 12oz", price: 13.50, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 56, name: "Reusable Mug Light Purple 12oz", price: 13.50, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 57, name: "Reusable Mug Red 16oz", price: 16.50, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 58, name: "Mug Reusable Black 16oz", price: 16.50, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 59, name: "Kaffeeform Reusable Coffee Mug 12oz", price: 18.00, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 60, name: "Reusable Tumbler 12oz", price: 1.50, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 61, name: "Reusable Tumbler 16oz", price: 2.00, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 62, name: "Thermos Coffee Island Le Baton 500ml", price: 32.00, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 63, name: "Coffee Island Thermos (White)", price: 11.00, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 64, name: "Coffee Island Thermos (Grey)", price: 11.00, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 65, name: "Coffee Island Thermos (Multicolor)", price: 13.00, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 66, name: "Reusable Metal Straw (Gold)", price: 4.95, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 67, name: "Reusable Metal Straw (Silver)", price: 4.95, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 68, name: "Reusable Metal Straw (Bronze)", price: 4.95, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
        { id: 69, name: "Reusable Metal Straw (Black)", price: 4.95, quantity: 0, total_profit: 0.00, category: "Eco Friendly" },
    
        // Coffee Makers
        { id: 70, name: "Coffee machine V60", price: 16.80, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
        { id: 71, name: "Dripper V60 Red (Plastic)", price: 9.00, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
        { id: 72, name: "Filters for V60 (100 pcs)", price: 5.80, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
        { id: 73, name: "Chemex Jug Coffee Maker (3 Cups)", price: 40.00, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
        { id: 74, name: "Paper Filters for Chemex (100 pcs)", price: 12.50, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
        { id: 75, name: "French Press 300ml (Olive wood)", price: 29.00, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
        { id: 76, name: "Aeropress Extraction Vessel", price: 29.00, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
        { id: 77, name: "Aeropress filters (350 pcs)", price: 8.50, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
        { id: 78, name: "Eco Cleaning Capsules", price: 7.50, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
        { id: 79, name: "Ceramic Coffee Grinder", price: 41.40, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
        { id: 80, name: "Moka Espresso Maker (3 Cups)", price: 25.00, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
        { id: 81, name: "Machine for making Afro-milk", price: 35.00, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
        { id: 82, name: "Shaker for Cold Milk Foam", price: 15.70, quantity: 0, total_profit: 0.00, category: "Coffee Makers" },
    
        // Bottles and Teapots
        { id: 83, name: "Bottle for Iced Tea 750ml (Red)", price: 28.00, quantity: 0, total_profit: 0.00, category: "Bottles and Teapots" },
        { id: 84, name: "Bottle for Iced Tea 750ml (Green)", price: 28.00, quantity: 0, total_profit: 0.00, category: "Bottles and Teapots" },
        { id: 85, name: "Teapot-Cup 200ml (Red)", price: 16.80, quantity: 0, total_profit: 0.00, category: "Bottles and Teapots" },
        { id: 86, name: "Teapot-Cup 200ml (Green)", price: 16.80, quantity: 0, total_profit: 0.00, category: "Bottles and Teapots" },
    
        // Lifestyle
        { id: 87, name: "Airtight Storage Box 'Airplane' 250gr", price: 11.00, quantity: 0, total_profit: 0.00, category: "Lifestyle" },
        { id: 88, name: "Tea Storage Container 'Every day is a new adventure' 100g", price: 9.50, quantity: 0, total_profit: 0.00, category: "Lifestyle" },
        { id: 89, name: "Airtight Storage Box 'Bowling' 250gr", price: 11.00, quantity: 0, total_profit: 0.00, category: "Lifestyle" },
        { id: 90, name: "Tea Storage Container 'Theres always time for tea' 100g", price: 9.50, quantity: 0, total_profit: 0.00, category: "Lifestyle" },
        { id: 91, name: "Little Prince Mug", price: 12.00, quantity: 0, total_profit: 0.00, category: "Lifestyle" },
            // New Savory Items
            { id: 92, name: "Kritsini with Gruyere", price: 1.80, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 93, name: "Cricinia Multi-seeded", price: 1.80, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 94, name: "Nut bar with Pistachio, Date and Chocolate Drops 45g", price: 1.60, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 95, name: "Feta Pie with Honey & Sesame Seeds", price: 2.50, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 96, name: "Round Bread Roll from Thessaloniki", price: 1.20, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 97, name: "Wholemeal Bun with Cream Cheese & Turkey", price: 2.60, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 98, name: "Handmade Sausage Pie with Cheese Filling & Sauce", price: 2.70, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 99, name: "Handmade Pie with Cretan Graviera", price: 2.90, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 100, name: "Handmade Pie with Graviera & Luntza", price: 2.90, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 101, name: "Bun with Tomato & Olive", price: 2.70, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 102, name: "Handmade Pizza", price: 2.50, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 103, name: "Butter Croissant", price: 2.10, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 104, name: "Elioti Tylichti", price: 2.30, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 105, name: "Hallumoti Tylichti", price: 2.30, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 106, name: "Tahino Pie", price: 2.50, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 107, name: "Country Twisted Pie with Spinach & Feta", price: 2.70, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 108, name: "Country Twisted Pie with Spinach", price: 2.70, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 109, name: "Flogera with Cream Cheese", price: 2.50, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 110, name: "Sesame Crackers with Honey & Tahini 70g", price: 1.60, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 111, name: "Corn Kritsini with Corn Flakes & Sunflower Seed 70g", price: 1.60, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 112, name: "Cheese Kritsini with Regato & Dry Cretan Anthotiro 70g", price: 1.60, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 113, name: "Salty Snacks 80g", price: 1.70, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 114, name: "Dried Fruits & Nuts Without Salt 80g", price: 2.00, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 115, name: "Dried Fruits 80g", price: 2.00, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 116, name: "Mixed Nuts Without Salt 80g", price: 2.00, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
            { id: 117, name: "Mixed Nuts 80g", price: 1.70, quantity: 0, total_profit: 0.00, category: "New Savory Items" },
        
            // Sandwiches
            { id: 118, name: "Turkey & Cheese Toast", price: 2.60, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 119, name: "Baguette with Lountza & Halloumi", price: 4.00, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 120, name: "Panini with Rosto & Halloumi", price: 4.00, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 121, name: "Caesar's Baguette with Chicken", price: 4.20, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 122, name: "Mediterranean Vegetable Bucket", price: 3.90, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 123, name: "Tone Triangle", price: 3.90, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 124, name: "Laganaki Club Sandwich", price: 4.20, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 125, name: "Green Tortilla with Chicken, Goat Cheese & Cranberries", price: 4.20, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 126, name: "Multi-seeded Baguette with Chicken & Avocado", price: 4.20, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 127, name: "Whole Tortilla with Turkey, Cheese & Mustard", price: 3.90, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 128, name: "Granary Triangle with Chicken, Egg & Avocado", price: 4.00, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 129, name: "Panini with Chicken, Feta & Pesto", price: 4.00, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 130, name: "Chia Triangle with Turkey & Cream Cheese", price: 4.20, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 131, name: "Linseed Ciabatta with Salami & Prosciutto", price: 4.20, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 132, name: "Tortillas with Chicken & Honey Mustard", price: 4.20, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
            { id: 133, name: "Traditional Triara", price: 5.00, quantity: 0, total_profit: 0.00, category: "Sandwiches" },
        
            // Salads
            { id: 134, name: "Salad with Chicken & Parmesan", price: 5.25, quantity: 0, total_profit: 0.00, category: "Salads" },
            { id: 135, name: "Pasta Salad with Chicken", price: 5.25, quantity: 0, total_profit: 0.00, category: "Salads" },
            { id: 136, name: "Salad with Arugula, Parmesan & Pomegranate", price: 5.25, quantity: 0, total_profit: 0.00, category: "Salads" },
        
            // Cold Snacks
            { id: 137, name: "Fresh Fruits", price: 3.50, quantity: 0, total_profit: 0.00, category: "Cold Snacks" },
            { id: 138, name: "Yogurt Dessert with Honey & Walnuts", price: 2.75, quantity: 0, total_profit: 0.00, category: "Cold Snacks" },
            { id: 139, name: "Yogurt Granola & Gooseberry Dessert", price: 2.75, quantity: 0, total_profit: 0.00, category: "Cold Snacks" }
        ];

        



        // Function to display products by category
    function displayProductsByCategory(category) {
        const productContainer = document.getElementById("product-container");
        productContainer.innerHTML = ""; // Clear previous content

        products.forEach(product => {
            if (product.category === category || category === "All") {
                const productItem = document.createElement("div");
                productItem.classList.add("product-item");
                productItem.innerHTML = `
                    <h3>${product.name}</h3>
                    <p>Unit Price: €${product.price}</p>
                    <p>Quantity Total: ${product.quantity}</p>
                    <p>Unit Cost: €${product.total_profit}</p>
                    <input type="number" id="add-quantity-${product.id}" placeholder="Quantity to add">
                    <button id="add-btn-${product.id}">Add Quantity</button>
                    <button class="subtract-btn">Subtract Quantity</button>
                `;

                // Add click event listener to subtract quantity
                productItem.querySelector(`.subtract-btn`).addEventListener("click", () => {
                    subtractQuantity(product.id, product.price);
                });

                // Add click event listener to add quantity
                productItem.querySelector(`#add-btn-${product.id}`).addEventListener("click", () => {
                    addQuantity(product.id);
                });

                productContainer.appendChild(productItem);
            }
        });
    }
    

    // Function to update quantity in local storage
    function updateLocalStorage() {
        localStorage.setItem('products', JSON.stringify(products));
    }

    // Function to subtract quantity
    function subtractQuantity(productId, price) {
        products = products.map(product => {
            if (product.id === productId && product.quantity > 0) {
                product.quantity -= 1;
                product.total_profit += price; // Update total profit based on product's price
            }
            return product;
        });
        updateLocalStorage();
        const selectedCategory = document.getElementById("category-selector").value;
        displayProductsByCategory(selectedCategory);
    }

    // Function to add quantity
    function addQuantity(productId) {
        const additionalQuantity = parseInt(document.getElementById(`add-quantity-${productId}`).value);
        if (!isNaN(additionalQuantity) && additionalQuantity > 0) {
            products = products.map(product => {
                if (product.id === productId) {
                    product.quantity += additionalQuantity;
                }
                return product;
            });
            updateLocalStorage();
            const selectedCategory = document.getElementById("category-selector").value;
            displayProductsByCategory(selectedCategory);
        } else {
            alert("Please enter a valid quantity to add.");
        }
    }

    // Populate the category selector options
    function populateCategorySelector() {
        const categorySelector = document.getElementById("category-selector");
        const categories = products.map(product => product.category);
        const uniqueCategories = [...new Set(categories)];
        uniqueCategories.forEach(category => {
            const option = document.createElement("option");
            option.text = category;
            categorySelector.add(option);
        });
    }

    // Display products based on the selected category
    document.getElementById("category-selector").addEventListener("change", function() {
        const selectedCategory = this.value;
        displayProductsByCategory(selectedCategory);
    });

    // Populate category selector and display products when the page loads
    populateCategorySelector();
    displayProductsByCategory("All");

    // Function to update product quantity
    function updateProductQuantity(productId, quantity) {
        const product = products.find(p => p.id === productId);
        if (product) {
            product.quantity = parseInt(quantity);
            // Update total profit
            product.total_profit = (product.price * product.quantity).toFixed(2);
            // Save updated products to localStorage
            localStorage.setItem('products', JSON.stringify(products));
        }
    }

    // Function to handle quantity input change
    function handleQuantityChange(event) {
        const productId = parseInt(event.target.dataset.productId);
        const quantity = event.target.value;
        updateProductQuantity(productId, quantity);
    }

    // Function to export products data
    function exportProductsData() {
        const data = JSON.stringify(products, null, 2);
        const blob = new Blob([data], { type: 'application/json' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'products.json';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    }

    // Event listener for quantity input change
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', handleQuantityChange);
    });

    // Event listener for export button click
    document.getElementById('export-btn').addEventListener('click', exportProductsData);
});

