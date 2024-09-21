
<?php
// 1. Crear un arreglo de 10 nombres de ciudades
$ciudades = ["Nueva York", "Tokio", "Londres", "París", "Sídney", "Río de Janeiro", "Moscú", "Berlín", "Ciudad del Cabo", "Toronto"];

// 2. Imprimir el arreglo original
echo "Ciudades originales:<br>";
print_r($ciudades);

// 3. Agregar 2 ciudades más al final del arreglo
array_push($ciudades, "Dubái", "Singapur");

// 4. Eliminar la tercera ciudad del arreglo
array_splice($ciudades, 2, 1);

// 5. Insertar una nueva ciudad en la quinta posición
array_splice($ciudades, 4, 0, "Mumbai");

// 6. Imprimir el arreglo modificado
echo "<br>Ciudades modificadas:<br>";
print_r($ciudades);

// 7. Crear una función que imprima las ciudades en orden alfabético
function imprimirCiudadesOrdenadas($arr) {
    $ordenado = $arr;
    sort($ordenado);
    echo "Ciudades en orden alfabético:<br>";
    foreach ($ordenado as $ciudad) {
        echo "- $ciudad<br>";
    }
}

// 8. Llamar a la función
imprimirCiudadesOrdenadas($ciudades);

// TAREA: Crea una función que cuente y retorne el número de ciudades que comienzan con una letra específica
function contarCiudadesPorInicial($arr, $letra) {
    $contador = 0;
    foreach ($arr as $ciudad) {
        if (stripos($ciudad, $letra) === 0) {
            $contador++;
        }
    }
    return $contador;
}

// Ejemplo de uso de la función contarCiudadesPorInicial
$letraBuscada = 'S';
$numCiudades = contarCiudadesPorInicial($ciudades, $letraBuscada);
echo "<br>Número de ciudades que comienzan con la letra '$letraBuscada': $numCiudades<br>";

// Otro ejemplo de uso de la función con la letra 'T'
$letraBuscada2 = 'T';
$numCiudades2 = contarCiudadesPorInicial($ciudades, $letraBuscada2);
echo "Número de ciudades que comienzan con la letra '$letraBuscada2': $numCiudades2<br>";

?>