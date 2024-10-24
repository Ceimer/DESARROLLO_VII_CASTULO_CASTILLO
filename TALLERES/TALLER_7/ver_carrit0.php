<?php
require 'config_sesion.php';

$productos = [
    1 => ['nombre' => 'Producto 1', 'precio' => 10],
    2 => ['nombre' => 'Producto 2', 'precio' => 20],
    3 => ['nombre' => 'Producto 3', 'precio' => 30],
    4 => ['nombre' => 'Producto 4', 'precio' => 40],
    5 => ['nombre' => 'Producto 5', 'precio' => 50],
];

echo '<h2>Carrito de Compras</h2>';

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo 'El carrito está vacío.<br>';
} else {
    $total = 0;
    echo '<ul>';
    foreach ($_SESSION['carrito'] as $producto_id => $cantidad) {
        $producto = $productos[$producto_id];
        $subtotal = $producto['precio'] * $cantidad;
        $total += $subtotal;
        echo "<li>{$producto['nombre']} - {$producto['precio']} USD x $cantidad = $subtotal USD 
                <a href='eliminar_del_carrito.php?id=$producto_id'>Eliminar</a></li>";
    }
    echo '</ul>';
    echo "Total: $total USD<br>";
    echo '<a href="checkout.php">Finalizar compra</a>';
}
echo '<br><a href="productos.php">Seguir comprando</a>';
?>
