<?php
$servername = "localhost";
$username = "root";
$password = "root";
if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'Why you no have mysqli!!!';
} else {
    echo 'Day is saved!';
}
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

$conn->close();
?>