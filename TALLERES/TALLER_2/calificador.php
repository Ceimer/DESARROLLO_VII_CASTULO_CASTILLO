<?php

// Declaración de la variable calificación
$calificacion = 60;

// Determinación de la letra correspondiente a la calificación
if ($calificacion >= 90 && $calificacion <= 100) {
    $letra = 'A';
} elseif ($calificacion >= 80 && $calificacion < 90) {
    $letra = 'B';
} elseif ($calificacion >= 70 && $calificacion < 80) {
    $letra = 'C';
} elseif ($calificacion >= 60 && $calificacion < 70) {
    $letra = 'D';
} else {
    $letra = 'F';
}

// Impresión del mensaje de calificación
echo "Tu calificación es $letra. ";

// Uso del operador ternario para añadir "Aprobado" o "Reprobado"
echo ($letra != 'F') ? "Aprobado" : "Reprobado";

// Uso del switch para imprimir un mensaje adicional basado en la letra de la calificación
switch ($letra) {
    case 'A':
        echo ". Excelente trabajo";
        break;
    case 'B':
        echo ". Buen trabajo";
        break;
    case 'C':
        echo ". Trabajo aceptable";
        break;
    case 'D':
        echo ". Necesitas mejorar";
        break;
    case 'F':
        echo ". Debes esforzarte más";
        break;
    default:
        echo ". Calificación no válida";
        break;
}

?>
