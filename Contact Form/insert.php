<?php
// Database connection
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "gar22164148"; // Your MySQL username
$password = "tNADoh7I3yCn8xM"; // Your MySQL password
$database = "gar22164148"; // Your MySQL database name ==

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// SQL query to insert data into table
$sql = "INSERT INTO contact_details (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
