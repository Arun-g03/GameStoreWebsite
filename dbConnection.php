<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "gamesitedatabase";

// Create connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Display error message if connection fails
    echo "Connection failed: " . $e->getMessage();
    die(); // Terminate script execution
}


