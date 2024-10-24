<?php
require 'config_sesion.php';

// Verificar si hay algo en el carrito
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo 'El carrito está vacío.<br>';
    echo '<a href="productos.php">Volver a la tienda</a>';
    exit;
}

// Calcular el total de la compra
$total = 0;
$productos = [
    1 => ['nombre' => 'Producto 1', 'precio' => 10],
    2 => ['nombre' => 'Producto 2', 'precio' => 20],
    3 => ['nombre' => 'Producto 3', 'precio' => 30],
    4 => ['nombre' => 'Producto 4', 'precio' => 40],
    5 => ['nombre' => 'Producto 5', 'precio' => 50],
];

foreach ($_SESSION['carrito'] as $producto_id => $cantidad) {
    $producto = $productos[$producto_id];
    $total += $producto['precio'] * $cantidad;
}

// Vaciar el carrito
unset($_SESSION['carrito']);

// Pedir el nombre del usuario y guardarlo en una cookie por 24 horas
if (isset($_POST['nombre'])) {
    $nombre_usuario = htmlspecialchars(trim($_POST['nombre']));
    setcookie('nombre_usuario', $nombre_usuario, time() + 86400, "", "", true, true); // Cookie segura
    echo "<h2>Gracias por tu compra, $nombre_usuario.</h2>";
} else {
    echo '<form method="post" action="checkout.php">';
    echo 'Introduce tu nombre para finalizar la compra: <input type="text" name="nombre" required>';
    echo '<input type="submit" value="Finalizar">';
    echo '</form>';
    exit;
}

// Mostrar el resumen de la compra
echo "<h2>Total de la compra: $total USD</h2>";
echo '<a href="productos.php">Volver a la tienda</a>';
?>
