<?php
include 'db.php';

// Fetch tasks
$stmt = $conn->prepare("SELECT * FROM tasks ORDER BY created_at DESC");
$stmt->execute();
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>TO-DO LIST</h2>
        <p class="sidebar-title">Zyrille Zhean Corpuz <br> BSIT WMT 2-1</p>
    </aside>
    
    <!-- Main Content -->
    <main class="main-content">
        <h1>New Task</h1>
        <form action="add_task.php" method="POST">
            <input type="text" name="task_name" placeholder="Task" required>
            <button type="submit" class="btn-add">Add Task</button>
        </form>

        <h2>Task Lists</h2>
        <ul class="task-list">
            <?php foreach ($tasks as $task): ?>
                <?php if (!$task['is_completed']): ?>
                    <li>
                        <span><?= htmlspecialchars($task['task_name']) ?></span>
                        <div class="button-group">
                            <a href="complete_task.php?id=<?= $task['id'] ?>" class="btn-complete">Complete</a>
                            <a href="delete_task.php?id=<?= $task['id'] ?>" class="btn-delete">Delete</a>
                        </div>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>

        <h2>Completed Tasks</h2>
        <ul class="completed-task-list">
            <?php foreach ($tasks as $task): ?>
                <?php if ($task['is_completed']): ?>
                    <li class="completed"><?= htmlspecialchars($task['task_name']) ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </main>
</div>

</body>
</html>