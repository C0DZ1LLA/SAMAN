<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C0DZ1LLA BOOKING SYSTEM</title>
    <link rel="stylesheet" href="css/admin.css">
    <!-- Add jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Add your custom JavaScript code -->
    <script>
        $(document).ready(function(){
            $('#booking-form').submit(function(e) {
                e.preventDefault(); // Prevent the form from submitting

                // Serialize form data
                var formData = $(this).serialize();

                // Submit form data via AJAX
                $.ajax({
                    url: 'booking.php',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Display modal with booking details
                            $('#booking-details-modal').html(`
                                <h2>Booking Details</h2>
                                <p>Arrival Date: ${response.arrival_date}</p>
                                <p>Departure Date: ${response.departure_date}</p>
                                <p>Room Type: ${response.room_type}</p>
                                <p>Adults: ${response.adults}</p>
                                <p>Children: ${response.children}</p>
                                <p>Infants: ${response.infants}</p>
                                <p>Group Number: ${response.group_number}</p>
                                <p>Total Price: $${response.total_price}</p>
                            `);
                            $('#booking-details-modal').show();
                        } else {
                            // Display error message
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Handle errors if needed
                    }
                });
            });

            // Function to reload booking details
            function reloadBookingDetails() {
                $.ajax({
                    url: 'booking_details.php', // URL to fetch booking details
                    method: 'GET', // Use GET method to fetch data
                    success: function(response) {
                        $('.booking-details').html(response); // Update booking details section with latest data
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Handle errors if needed
                    }
                });
            }

            // Open the edit modal when clicking the edit button
            $(document).on('click', '.edit-btn', function() {
                var bookingId = $(this).data('id');
                $('#edit-modal').show();

                // Fetch booking details for the selected bookingId and populate the modal form
                $.ajax({
                    url: 'fetch_booking_details.php',
                    method: 'POST',
                    data: {booking_id: bookingId},
                    success: function(response) {
                        $('#edit-modal .modal-content').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            // Handle form submission for editing
            $(document).on('submit', '#booking-form', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Serialize form data
                var formData = $(this).serialize();

                // Submit form data via AJAX
                $.ajax({
                    url: 'update_booking.php',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Hide the modal popup after successful update
                        $('#edit-modal').hide();
                        // Reload the booking details after update
                        reloadBookingDetails();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Handle errors if needed
                    }
                });
            });

            // Close the modal when clicking the close button
            $('.close').on('click', function() {
                $('#edit-modal').hide();
            });

            // Close the modal when clicking outside of it
            $(window).on('click', function(event) {
                if (event.target == $('#edit-modal')[0]) {
                    $('#edit-modal').hide();
                }
            });

            // Initial loading of booking details
            reloadBookingDetails();

            // Automatically refresh the booking details every 5 seconds
            setInterval(reloadBookingDetails, 5000); // Adjust the interval as needed (in milliseconds)

            // Export to CSV
            $('#exportCSV').on('click', function() {
                window.location.href = 'export_csv.php';
            });

            // Export to PDF
            $('#exportPDF').on('click', function() {
                window.location.href = 'export_pdf.php';
            });

            // Clear Database and Refresh Page
            $('#clearDB').on('click', function() {
                if (confirm("Are you sure you want to clear the database?")) {
                    $.ajax({
                        url: 'clear_database.php',
                        method: 'GET',
                        success: function(response) {
                            // Reload the page after clearing the database
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            // Handle errors if needed
                        }
                    });
                }
            });

            // Delete booking
            $(document).on('click', '.delete-btn', function() {
                var bookingId = $(this).data('id');
                if (confirm("Are you sure you want to delete this booking?")) {
                    $.ajax({
                        url: 'delete_booking.php',
                        method: 'POST',
                        data: {booking_id: bookingId},
                        success: function(response) {
                            // Reload the booking details after deletion
                            reloadBookingDetails();
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            // Handle errors if needed
                        }
                    });
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Booking Panel</h1>
        <h2>Made by SAMAN</h2>
        <?php include 'booking_details.php'; ?>
    </div>
    
    <button id="exportCSV">Export CSV</button>
    <button id="refreshPage">Refresh Page</button>
    <button id="clearDB">Clear Database</button>

    <!-- Modal popup for editing -->
    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Booking</h2>
            <!-- Add form for editing here -->
        </div>
    </div>
</body>
</html>
