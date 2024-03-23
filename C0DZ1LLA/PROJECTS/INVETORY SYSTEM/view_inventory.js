$(document).ready(function() {
    // Function to load and display products
    function loadProducts() {
        $.get('get_products.php', function(data) {
            $('#product-list').html(data);
        });
    }

    // Load products on page load
    loadProducts();

    // Function to subtract quantity of a product
    $(document).on('click', '.subtract-quantity', function() {
        var productId = $(this).data('id');
        $.post('subtract_quantity.php', { id: productId }, function(response) {
            alert(response);
            loadProducts(); // Refresh product list
        });
    });
});
