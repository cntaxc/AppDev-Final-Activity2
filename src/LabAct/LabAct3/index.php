<?php
session_start();
include("db.php");

// Handle POST requests for completing tasks
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete_id'])) {
    $id = (int) $_POST['complete_id'];

    $stmt = $conn->prepare("UPDATE tasks SET status = 'Completed' WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Task #$id has been marked as completed.";
        header("Location: index.php");
        exit();
    } else {
        die("Error updating task: " . $stmt->error);
    }
}

// Handle POST requests for deleting tasks
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = (int) $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Task #$id has been deleted.";
        header("Location: index.php");
        exit();
    } else {
        die("Error deleting task: " . $stmt->error);
    }
}

// Fetch all tasks for display
$result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 10px; text-align: left; }
        th { background: #f2f2f2; }
        .success { color: green; font-weight: bold; margin-bottom: 10px; }
        button { padding: 5px 10px; border-radius: 5px; border: none; cursor: pointer; }
        .btn-complete { background: #4CAF50; color: white; }
        .btn-delete { background: #f44336; color: white; }
    </style>
</head>
<body>
    <h1>Task List</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <p class="success"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <a href="add_task.php">Add New Task</a><br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Task Name</th>
            <th>Task Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['task_name']) ?></td>
                    <td><?= $row['task_date'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <?php if ($row['status'] === 'Pending'): ?>
                            <form style="display:inline;" method="post" action="index.php" onsubmit="return confirm('Mark this task as completed?');">
                                <input type="hidden" name="complete_id" value="<?= $row['id'] ?>">
                                <button class="btn-complete" type="submit">Complete</button>
                            </form>
                        <?php else: ?>
                            ✔ Done
                        <?php endif; ?>

                        <form style="display:inline;" method="post" action="index.php" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                            <button class="btn-delete" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No tasks found</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
