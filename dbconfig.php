<?php

$conn = mysqli_connect('127.0.0.1', 'root', '');
if (!$conn){
    echo "Connection Failed", mysqli_error($conn);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS kolekcija ";
if (!$conn->query($sql) === TRUE) {
    echo "Error creating database: " . $conn->error;
} 




?>
