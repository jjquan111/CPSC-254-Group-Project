<?php
session_start();
// Check if the user is already logged in, if yes then redirect them to the calendar page
if (isset($_SESSION['user_id'])) {
    header("Location: dynamic_full_calendar.php");
    exit;
}

// Simple navigation for the user
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Calendar App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .options {
            display: flex;
            justify-content: space-between;
            width: 200px;
            margin: 20px 0;
        }
        a {
            color: #333;
            text-decoration: none;
        }
        a:hover {
            color: #007BFF;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Calendar App</h1>
        <p>Please choose one of the following options:</p>
        <div class="options">
            <a href="login.php">Login</a>
            <a href="register.php">Sign Up</a>
        </div>
    </div>
</body>
</html>
