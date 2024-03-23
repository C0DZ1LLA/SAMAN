$(document).ready(function() {
    // Function to fetch and display dashboard metrics
    function displayDashboardMetrics() {
        // Send a GET request to 'dashboard_metrics.php' to fetch metrics data
        $.get('dashboard_metrics.php', function(data) {
            var metrics = JSON.parse(data);

            // Update dashboard with fetched metrics data
            $('#totalProducts').text(metrics.totalProducts);
            $('#totalRevenue').text('$' + metrics.totalRevenue);
            
            var topSellingProducts = '';
            metrics.topSellingProducts.forEach(function(product) {
                topSellingProducts += '<li>' + product.name + ' - ' + product.quantitySold + ' units sold</li>';
            });
            $('#topSellingProducts').html(topSellingProducts);
        });
    }

    // Initial display of dashboard metrics
    displayDashboardMetrics();
});
