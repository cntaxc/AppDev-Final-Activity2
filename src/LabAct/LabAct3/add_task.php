<!DOCTYPE html>
<html>
<head>
    <title>Add New Task</title>
    <style>
        form { max-width: 400px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="date"] { width: 100%; padding: 8px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 10px 15px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .error { color: red; font-weight: bold; margin-bottom: 10px; }
        .success { color: green; font-weight: bold; margin-bottom: 10px; }
    </style>
</head>
<body>
    <?php
    include("db.php");

    $error = "";
    $success = "";

    $task_name = "";
    $task_date = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $task_name = trim($_POST['task_name'] ?? '');
        $task_date = $_POST['task_date'] ?? '';

        if (empty($task_name)) {
            $error = "Task name is required.";
        } elseif (empty($task_date)) {
            $error = "Task date is required.";
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $task_date)) {
            $error = "Invalid date format. Use YYYY-MM-DD.";
        } else {
            $stmt = $conn->prepare("INSERT INTO tasks (task_name, task_date) VALUES (?, ?)");
            $stmt->bind_param("ss", $task_name, $task_date);

            if ($stmt->execute()) {
                $success = "Task added successfully.";
                $task_name = $task_date = "";
            } else {
                $error = "Error adding task: " . $stmt->error;
            }
        }
    }
    ?>

    <h1>Add New Task</h1>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="task_name">Task Name *</label>
        <input type="text" id="task_name" name="task_name" required value="<?= htmlspecialchars($task_name) ?>">

        <label for="task_date">Task Date (YYYY-MM-DD) *</label>
        <input type="date" id="task_date" name="task_date" required value="<?= htmlspecialchars($task_date) ?>">

        <button type="submit">Add Task</button>
    </form>

    <p><a href="index.php">Back to Task List</a></p>
</body>
</html>
