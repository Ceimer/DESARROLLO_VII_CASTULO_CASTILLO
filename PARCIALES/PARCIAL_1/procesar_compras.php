<?php
include'funciones_tienda.php';
$productos = array(
    "agua" => 100,
    "soda" => 200,
    "helado" => 1000,
    "galletas" => 99,
    "papitas" => 6000);
   
   
   
    $carrito = array(
        "agua" => 2,
        "soda" => 3,
        "helado" => 1,
        "galletas" => 1,
        "papitas" => 0);
    

    
$subtotal = 0;
foreach ($carrito as $producto => $cantidad) {
    $subtotal += $productos[$producto] * $cantidad;
}

$descuento = calcular_descuento($subtotal);
$impuesto = aplicar_impuestos($subtotal);
$total_a_pagar = calcular_total($subtotal, $descuento, $impuesto);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carrito as $producto => $cantidad): ?>
                <?php if ($cantidad > 0): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto); ?></td>
                        <td class="right"><?php echo htmlspecialchars($cantidad); ?></td>
                        <td class="right">$<?php echo htmlspecialchars(number_format($productos[$producto], 2)); ?></td>
                        <td class="right">$<?php echo htmlspecialchars(number_format($productos[$producto] * $cantidad, 2)); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" class="right"><strong>Subtotal:</strong></td>
                <td class="right">$<?php echo number_format($subtotal, 2); ?></td>
            </tr>
            <tr>
                <td colspan="3" class="right"><strong>Descuento:</strong></td>
                <td class="right">$<?php echo number_format($descuento, 2); ?></td>
            </tr>
            <tr>
                <td colspan="3" class="right"><strong>Impuesto (7%):</strong></td>
                <td class="right">$<?php echo number_format($impuesto, 2); ?></td>
            </tr>
            <tr>
                <td colspan="3" class="right"><strong>Total a Pagar:</strong></td>
                <td class="right">$<?php echo number_format($total_a_pagar, 2); ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>