
 <?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$tasks = $_SESSION['tasks'] ?? [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tareas personales del <?php echo ($_SESSION['username']); ?> </title>
</head>
<body>
<?php
    if (isset($_GET['error'])) {
        echo "<p style='color:red;'>ERROR </p>";

        echo "<p style='color:red;'>LA FECHA DEBE SER DE MAÑANA EN ADELANTE </p>";
    }
    ?>
    <a href="logout.php">Cerrar Sesión</a>

    <h3>Lista de Tareas</h3>
    <?php if (empty($tasks)): ?>
        <p>No tienes tareas pendientes.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li><?php echo htmlspecialchars($task['title']) . " - Fecha límite: " . htmlspecialchars($task['due_date']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <h3> Nuevas Tareas +</h3>
    <form action="agregar_tarea.php" method="POST">
        <label for="title">Título de la tarea:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="due_date">Fecha límite:</label>
        <input type="date" id="due_date" name="due_date" required><br>
        <button type="submit">Agregar Tarea</button>
    </form>

    
</body>
</html>
