$(document).ready(function () {
    loadMessages();
    setInterval(loadMessages, 2000); // Reload messages every 2 seconds
});

function loadMessages() {
    $.ajax({
        url: 'get_messages.php',
        method: 'GET',
        success: function (data) {
            // Replace the content of the chat-messages div
            $('#chat-messages').html(data);
        }
    });
}


function sendMessage() {
    var username = $('#username').val();
    var message = $('#message').val();

    $.post('save_message.php', { username: username, message: message }, function(data) {
        loadMessages();
        $('#message').val('');
    });
}
