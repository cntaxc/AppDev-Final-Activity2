<?php
include "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM books WHERE id=$id");
    $book = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];

    $sql = "UPDATE books SET title='$title', author='$author', year='$year', isbn='$isbn' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: manager.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Book</title></head>
<body>
<h2>Edit Book</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
    <input type="text" name="title" value="<?php echo $book['title']; ?>" required>
    <input type="text" name="author" value="<?php echo $book['author']; ?>" required>
    <input type="number" name="year" value="<?php echo $book['year']; ?>" required>
    <input type="text" name="isbn" value="<?php echo $book['isbn']; ?>" required>
    <button type="submit">Update</button>
</form>
</body>
</html>
