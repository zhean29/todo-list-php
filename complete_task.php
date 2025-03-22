<?php
include 'db.php';

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("UPDATE tasks SET is_completed = 1 WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: index.php");
?>

