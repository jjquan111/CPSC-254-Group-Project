<?php
session_start();
require 'database_connection.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dynamic_full_calendar.php");
        exit;
    } else {
        $message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .main {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input {
            margin: 10px 0;
            padding: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            margin: 10px 0;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main">
            <h1>Login To Your Account</h1>
            <?php if (!empty($message)): ?>
                <p class="message"><?= $message ?></p>
            <?php endif; ?>
            <form method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="Username" required>
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" required>
                <div class="wrap">
                    <button type="submit">Login</button>
                </div>
            </form>
            <button type="button" onclick="window.location.href = 'index.php';">Back</button>
        </div>
    </div>
</body>

</html>