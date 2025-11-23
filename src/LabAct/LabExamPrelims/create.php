<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];

    $sql = "INSERT INTO books (title, author, year, isbn) VALUES ('$title', '$author', '$year', '$isbn')";

    if ($conn->query($sql) === TRUE) {
        header("Location: manager.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
