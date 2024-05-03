<?php
$host = 'localhost'; 
$dbname = 'calendar';
$username = 'root'; // Change to the username you created with appropriate privileges
$password = 'new_password'; // Change to the password for the new user

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

