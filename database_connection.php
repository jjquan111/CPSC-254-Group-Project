<?php
$host = '127.0.0.1';  // Use IP address to force TCP connection
$dbname = 'calendar';
$username = 'your_username'; // Ensure this is your actual MySQL username
$password = 'your_password'; // Ensure this is your actual MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

