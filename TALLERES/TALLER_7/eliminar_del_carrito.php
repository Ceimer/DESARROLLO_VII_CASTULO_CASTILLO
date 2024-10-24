<?php
require 'config_sesion.php';

// Verificar si el ID del producto es válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $producto_id = (int)$_GET['id'];

    // Eliminar el producto del carrito
    if (isset($_SESSION['carrito'][$producto_id])) {
        unset($_SESSION['carrito'][$producto_id]);
    }
}

// Redirigir al carrito
header('Location: ver_carrito.php');
exit;
?>
