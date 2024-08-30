<?php

// Función para leer el inventario desde el archivo JSON
function leerInventario($archivo) {
    $contenido = file_get_contents($archivo);
    return json_decode($contenido, true);
}

// Función para ordenar el inventario alfabéticamente por nombre del producto
function ordenarInventarioPorNombre(&$inventario) {
    usort($inventario, function($a, $b) {
        return strcmp($a['nombre'], $b['nombre']);
    });
}

// Función para mostrar un resumen del inventario ordenado
function mostrarResumenInventario($inventario) {
    ordenarInventarioPorNombre($inventario);
    echo "Resumen del Inventario:\n";
    echo str_pad("Nombre", 20) . str_pad("Precio", 10) . str_pad("Cantidad", 10) . "\n";
    echo str_repeat("-", 40) . "\n";
    foreach ($inventario as $producto) {
        echo str_pad($producto['nombre'], 20) . 
             str_pad("$" . number_format($producto['precio'], 2), 10) . 
             str_pad($producto['cantidad'], 10) . "\n";
    }
}

// Función para calcular el valor total del inventario
function calcularValorTotalInventario($inventario) {
    return array_sum(array_map(function($producto) {
        return $producto['precio'] * $producto['cantidad'];
    }, $inventario));
}

// Función para generar un informe de productos con stock bajo (menos de 5 unidades)
function generarInformeStockBajo($inventario) {
    $productosBajoStock = array_filter($inventario, function($producto) {
        return $producto['cantidad'] < 5;
    });

    if (empty($productosBajoStock)) {
        echo "No hay productos con stock bajo.\n";
    } else {
        echo "Informe de Productos con Stock Bajo:\n";
        echo str_pad("Nombre", 20) . str_pad("Cantidad", 10) . "\n";
        echo str_repeat("-", 30) . "\n";
        foreach ($productosBajoStock as $producto) {
            echo str_pad($producto['nombre'], 20) . str_pad($producto['cantidad'], 10) . "\n";
        }
    }
}

// Script principal
$archivoInventario = 'inventario.json';

// Leer el inventario
$inventario = leerInventario($archivoInventario);

// Mostrar resumen del inventario
mostrarResumenInventario($inventario);

// Calcular y mostrar el valor total del inventario
$valorTotal = calcularValorTotalInventario($inventario);
echo "\nValor total del inventario: $" . number_format($valorTotal, 2) . "\n";

// Generar y mostrar informe de productos con stock bajo
generarInformeStockBajo($inventario);

?>
