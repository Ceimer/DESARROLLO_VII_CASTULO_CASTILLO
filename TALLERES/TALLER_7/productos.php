<?php
require 'config_sesion.php';

// Lista de productos
$productos = [
    1 => ['nombre' => 'Producto 1', 'precio' => 10],
    2 => ['nombre' => 'Producto 2', 'precio' => 20],
    3 => ['nombre' => 'Producto 3', 'precio' => 30],
    4 => ['nombre' => 'Producto 4', 'precio' => 40],
    5 => ['nombre' => 'Producto 5', 'precio' => 50],
];

// Mostrar lista de productos
echo '<h2>Lista de Productos</h2>';
echo '<ul>';
foreach ($productos as $id => $producto) {
    echo "<li>{$producto['nombre']} - {$producto['precio']} USD 
            <a href='agregar_al_carrito.php?id=$id'>Añadir al carrito</a></li>";
}
echo '</ul>';
echo '<a href="ver_carrito.php">Ver Carrito</a>';
?>
