<?php
session_start();

// Check if the user is logged in
if(!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Check if the IP address matches the one stored in the session
if(isset($_SESSION['ip_address']) && $_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR']) {
    // IP address does not match, redirect to login page
    header("Location: index.php");
    exit();
}

// Define project directories and their corresponding pins
$projects = array(
    "Project 1" => array("pin" => "1234", "directory" => "index.php"),
    "Project 2" => array("pin" => "5678", "directory" => "2"),
    "Project 3" => array("pin" => "9012", "directory" => "4")
);

// Check if pin is submitted
if(isset($_POST['pin'])) {
    $pin = $_POST['pin'];
    $project = $_POST['project'];

    // Verify pin
    if(isset($projects[$project]) && $pin === $projects[$project]['pin']) {
        $_SESSION['project'] = $projects[$project]['directory'];
        header("Location: " . $_SESSION['project']); // Redirect to project directory
        exit();
    } else {
        $pin_error = "Invalid pin. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
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

    .dashboard {
        background-color: #000;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
        padding: 40px;
        width: 300px;
        color: #ffd700;
        position: relative;
        overflow: hidden;
    }

    .dashboard h2 {
        margin-bottom: 20px;
        color: #ffd700;
        text-align: center;
        font-size: 30px;
    }

    .pin-input {
        width: 100%;
        padding: 10px;
        border: none;
        border-bottom: 2px solid #ffd700;
        background-color: transparent;
        color: #ffd700;
        outline: none;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .pin-input::placeholder {
        color: #aaa;
    }

    .btn {
        background-color: #ffd700;
        color: #000;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 18px;
        font-weight: bold;
        width: 100%;
        margin-bottom: 10px;
    }

    .btn:hover {
        background-color: #ffcc00;
    }

    .error-message {
        color: #ff0000;
        margin-bottom: 10px;
        text-align: center;
    }
</style>
</head>
<body>

<div class="dashboard">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <form action="" method="post">
        <select name="project" class="pin-input" required>
            <option value="" disabled selected>Select Project</option>
            <?php foreach($projects as $project => $data): ?>
                <option value="<?php echo $project; ?>"><?php echo $project; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="password" name="pin" class="pin-input" placeholder="Enter Pin" required>
        <input type="submit" value="Open Project" class="btn">
        <?php if(isset($pin_error)) echo "<p class='error-message'>$pin_error</p>"; ?>
    </form>
</div>

</body>
</html>
