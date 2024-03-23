<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C0DZ1LLA Systems</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container" id="chat-container">
        <div id="chat-messages"></div>
        <div id="chat-input">
            <input type="text" id="username" placeholder="Username" autocomplete="off">
<textarea id="message" placeholder="Type your message" rows="3" autocomplete="off"></textarea>

            <button id="send-button" onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
