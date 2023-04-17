<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Replace with your database credentials
$host = "localhost";
$username = "root";
$password = "Root";
$db = "zpm_inventory_db";
echo "started";

// Create a new database connection
$conn = new mysqli($host, $username, $password);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database
$sql = "CREATE DATABASE $db";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
