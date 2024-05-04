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
            background: linear-gradient(to bottom, #ADD8E6, #FBCEB1);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 50%;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
         .options {
            display: flex;
            justify-content: center;
        }
        .options a {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .options a:hover {
            background-color: #0056b3;
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
