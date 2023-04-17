<?php
$host = "localhost";
$username = "root";
$password = "Root";
$db = "zpm_inventory_db";

// Create a new database connection
$conn = new mysqli($host, $username, $password);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//delete the database
mysqli_select_db($conn, $db);
mysqli_query($conn, "DROP DATABASE $db");
echo "Database '$db' deleted successfully";
mysqli_close($conn);
?>
