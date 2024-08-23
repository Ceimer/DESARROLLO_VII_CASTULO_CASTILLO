<?php

// 1. Patrón de triángulo rectángulo con asteriscos (*)
echo "Patrón de triángulo rectángulo:<br>";
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}

echo "<br>";

// 2. Secuencia de números del 1 al 20, mostrando solo los números impares
echo "Números impares del 1 al 20:<br>";
$numero = 1;
while ($numero <= 20) {
    if ($numero % 2 != 0) {
        echo $numero . "<br>";
    }
    $numero++;
}

echo "<br>";

// 3. Contador regresivo desde 10 hasta 1, saltando el número 5
echo "Contador regresivo desde 10 hasta 1 (saltando el número 5):<br>";
$contador = 10;
do {
    if ($contador != 5) {
        echo $contador . "<br>";
    }
    $contador--;
} while ($contador >= 1);

?>
