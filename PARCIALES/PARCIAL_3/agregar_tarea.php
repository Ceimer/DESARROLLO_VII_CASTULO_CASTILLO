<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $due_date = $_POST['due_date'];

    if (empty($title) || empty($due_date) || strtotime($due_date) <= time()) {
        header("Location: dashboard.php?error=1");
        exit();
    }

    // agregar tareas a la lista 
    $_SESSION['tasks'][] = [
        'title' => $title,
        'due_date' => $due_date
    ];

    header("Location: dashboard.php");
    exit();
}
?>
