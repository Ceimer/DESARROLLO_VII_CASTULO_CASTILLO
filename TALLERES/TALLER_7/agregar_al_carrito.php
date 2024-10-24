<?php
require 'config_sesion.php';

// Verificar si el ID del producto es válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $producto_id = (int)$_GET['id'];

    // Si el carrito no está inicializado, lo creamos como un array vacío
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Añadir el producto al carrito, incrementar la cantidad si ya existe
    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]++;
    } else {
        $_SESSION['carrito'][$producto_id] = 1;
    }
}

// Redirigir a la página de productos o carrito
header('Location: productos.php');
exit;
?>
