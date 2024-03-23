// Function to add product
function addProduct() {
    var name = $('#name').val();
    var bulkPrice = $('#bulkPrice').val();
    var sellPrice = $('#sellPrice').val();
    var bulkCost = $('#bulkCost').val();
    var quantity = $('#quantity').val();

    $.post('add_product.php', {
        name: name,
        bulkPrice: bulkPrice,
        sellPrice: sellPrice,
        bulkCost: bulkCost,
        quantity: quantity
    }, function(data) {
        updateProductList();
    });
}

// Function to update the product list
function updateProductList() {
    $.get('display_products.php', function(data) {
        $('#productList').html(data);
    });
}

// Initial product list update
updateProductList();

// Function to open the edit modal for a specific product
// Function to open the edit modal for a specific product
function editProduct(id) {
    $.get('get_product.php', { id: id }, function(product) {
        $('#editName').val(product.name);
        $('#editBulkPrice').val(product.bulk_price);
        $('#editSellPrice').val(product.sell_price);
        $('#editBulkCost').val(product.bulk_cost);
        $('#editQuantity').val(product.quantity);

        // Store the product ID in the modal's data-id attribute
        $('#editModal').data('id', id).show();
        $('#modalOverlay').show();
    });
}


// Function to save changes to a product
function saveProduct() {
    var id = $('#editModal').data('id');
    var name = $('#editName').val();
    var sellPrice = $('#editSellPrice').val();
    var bulkCost = $('#editBulkCost').val();
    var quantity = $('#editQuantity').val();

    $.post('update_product.php', {
        id: id,
        name: name,
        sellPrice: sellPrice,
        bulkCost: bulkCost,
        quantity: quantity
    }, function(data) {
        closeModal();
        updateProductList();
    });
}

// Function to delete a product
function deleteProduct(id) {
    $.post('delete_product.php', { id: id }, function(data) {
        updateProductList();
    });
}

// Function to close the modal
function closeModal() {
    $('#editModal').hide();
    $('#modalOverlay').hide();
}
