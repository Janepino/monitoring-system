<?php
session_start();

// Database connection settings
$host = 'localhost';
$dbname = 'garage_system';
$username = 'root';
$password = '';

// Connect to database
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to check if user is logged in
function checkLogin() {
    if(!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}
?>
