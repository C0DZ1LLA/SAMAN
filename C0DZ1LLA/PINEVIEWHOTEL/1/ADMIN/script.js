$(document).ready(function(){
    // Open the edit modal when clicking the edit button
    $('.edit-btn').on('click', function() {
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
                // You can implement a function to reload the booking details here
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
});
