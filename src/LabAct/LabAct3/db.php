<?php
$servername = "db"; 
$username = "root";
$password = "rootpassword";
$dbname = "task_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create tasks table if not exists
$sql = "CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255) NOT NULL,
    task_date DATE NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending'
)";
if (!$conn->query($sql)) {
    die("Error creating table: " . $conn->error);
}
?>
