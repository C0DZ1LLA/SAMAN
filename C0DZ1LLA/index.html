<?php
session_start();

// Function to load user data from JSON file
function loadUsers() {
    $usersFile = 'users.json';
    if (file_exists($usersFile)) {
        $jsonString = file_get_contents($usersFile);
        return json_decode($jsonString, true);
    }
    return ['users' => []];
}

// Function to save user data to JSON file
function saveUsers($users) {
    $usersFile = 'users.json';
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
}

// Login functionality
if (isset($_POST['login'])) {
    // Load users from JSON file
    $users = loadUsers();

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    foreach ($users['users'] as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $user['email']; // Retrieve email from user data

            header("Location: LOGGED.php");
            exit();
        }
    }

    $login_error = "Invalid username or password.";
}

// HTML form remains the same
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login System</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
<style>
    body {
        background-color: #000;
        font-family: 'Orbitron', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        overflow: hidden;
    }

    .login-box {
        background-color: #000;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
        padding: 40px;
        width: 300px;
        color: #ffd700;
        position: relative;
        overflow: hidden;
    }

    .login-box h2 {
        margin-bottom: 20px;
        color: #ffd700;
        text-align: center;
        font-size: 30px;
    }

    .textbox {
        margin-bottom: 20px;
        position: relative;
    }

    .textbox input {
        width: 100%;
        padding: 10px;
        border: none;
        border-bottom: 2px solid #ffd700;
        background-color: transparent;
        color: #ffd700;
        outline: none;
        font-size: 16px;
        font-weight: bold;
    }

    .textbox input::placeholder {
        color: #aaa;
    }

    .textbox label {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
        transition: all 0.3s ease;
        font-size: 16px;
        font-weight: bold;
        color: #aaa;
    }

    .textbox input:focus + label, .textbox input:valid + label {
        top: -20px;
        font-size: 12px;
        color: #ffd700;
    }

    .textbox input:focus {
        border-bottom: 2px solid #ffd700;
    }

    .textbox input[type="submit"] {
        background-color: #ffd700;
        color: #000;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 18px;
        font-weight: bold;
    }

    .textbox input[type="submit"]:hover {
        background-color: #ffcc00;
    }

    .error-message {
        color: #ff0000;
        margin-bottom: 10px;
        text-align: center;
    }

    .neon-glow {
        position: absolute;
        top: -50px;
        left: -50px;
        right: -50px;
        bottom: -50px;
        z-index: -1;
        pointer-events: none;
        border-radius: 50%;
        box-shadow: 0 0 50px 20px rgba(255, 215, 0, 0.5);
        animation: shine 2s infinite linear;
    }

    @keyframes shine {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    html, body {
        width: 100%;
        height: 100%;
        margin: 0;
        overflow: hidden;
    }
</style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <form action="" method="post">
        <div class="textbox">
            <input type="text" name="username" required>
            <label>Username</label>
        </div>
        <div class="textbox">
            <input type="password" name="password" required>
            <label>Password</label>
        </div>
        <div class="textbox">
            <input type="email" name="email" required>
            <label>Email</label>
        </div>
        <input type="submit" value="Login" name="login">
        <?php if(isset($login_error)) echo "<p class='error-message'>$login_error</p>"; ?>
    </form>
    <div class="neon-glow"></div>
</div>
<script>
// JavaScript to enter full-screen mode on page load
document.addEventListener('DOMContentLoaded', function() {
    var element = document.documentElement;

    if (element.requestFullscreen) {
        element.requestFullscreen();
    } else if (element.webkitRequestFullscreen) { /* Safari */
        element.webkitRequestFullscreen();
    } else if (element.msRequestFullscreen) { /* IE11 */
        element.msRequestFullscreen();
    } else if (element.mozRequestFullScreen) { /* Firefox */
        element.mozRequestFullScreen();
    }
});
</script>

</body>
</html>