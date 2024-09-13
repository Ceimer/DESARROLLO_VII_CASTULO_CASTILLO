<?php
include 'utilidades_texto.php';

$frases = [
    "Desarrollo 7 es la mejor materia",
    "Profe por que me puso 3/10 en el taller #2. ",
    "Este examen me estresa"
];
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
                <th>Frase</th>
                <th>Palabras</th>
                <th>Vocales</th>
                <th>Frase Invertida</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($frases as $frase): ?>
                <tr>
                    <td><?php echo $frase; ?></td>
                    <td><?php echo contar_palabras($frase); ?></td>
                    <td><?php echo contar_vocales($frase); ?></td>
                    <td><?php echo invertir_palabras($frase); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

