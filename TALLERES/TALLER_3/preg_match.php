
<?php
// Ejemplo básico de preg_match()
$texto = "El código postal es 12345";
$patron = "/\d{5}/"; // Busca 5 dígitos consecutivos
if (preg_match($patron, $texto, $coincidencias)) {
    echo "Código postal encontrado: {$coincidencias[0]}</br>";
} else {
    echo "No se encontró un código postal válido.</br>";
}

// Ejemplo de validación de email
function validarEmail($email) {
    $patron = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($patron, $email);
}

$email1 = "usuario@example.com";
$email2 = "usuario@.com";
echo "¿'{$email1}' es un email válido? " . (validarEmail($email1) ? "Sí" : "No") . "</br>";
echo "¿'{$email2}' es un email válido? " . (validarEmail($email2) ? "Sí" : "No") . "</br>";

// Ejercicio: Extraer el nombre de usuario de una dirección de Twitter
function extraerUsuarioTwitter($tweet) {
    $patron = "/@([a-zA-Z0-9_]+)/";
    if (preg_match($patron, $tweet, $coincidencias)) {
        return $coincidencias[1];
    }
    return null;
}

$tweet = "Sígueme en @usuario_ejemplo para más contenido!";
$usuario = extraerUsuarioTwitter($tweet);
echo "</br>Usuario de Twitter extraído: " . ($usuario ? "@$usuario" : "No se encontró usuario") . "</br>";

// Bonus: Extraer información de una cadena con formato específico
$info = "Nombre: Juan, Edad: 30, Ciudad: Madrid";
$patron = "/Nombre: ([^,]+), Edad: (\d+), Ciudad: ([^,]+)/";
if (preg_match($patron, $info, $coincidencias)) {
    echo "</br>Información extraída:</br>";
    echo "Nombre: {$coincidencias[1]}</br>";
    echo "Edad: {$coincidencias[2]}</br>";
    echo "Ciudad: {$coincidencias[3]}</br>";
}

// Extra: Validar formato de número de teléfono
function validarTelefono($telefono) {
    $patron = "/^(\+\d{1,3}[- ]?)?\d{9,10}$/";
    return preg_match($patron, $telefono);
}

$telefono1 = "+34 123456789";
$telefono2 = "123-456-7890";
echo "</br>¿'{$telefono1}' es un teléfono válido? " . (validarTelefono($telefono1) ? "Sí" : "No") . "</br>";
echo "¿'{$telefono2}' es un teléfono válido? " . (validarTelefono($telefono2) ? "Sí" : "No") . "</br>";


// Modificación de la función extraerEtiquetasHTML() para capturar etiquetas y sus atributos
function extraerEtiquetasHTML($html) {
    // Captura la etiqueta completa junto con sus atributos
    $patron = "/<(\w+)([^>]*)>/";
    preg_match_all($patron, $html, $coincidencias);

    // Crear un array asociativo donde la clave es la etiqueta y el valor son los atributos
    $resultado = [];
    for ($i = 0; $i < count($coincidencias[1]); $i++) {
        $etiqueta = $coincidencias[1][$i];
        $atributos = trim($coincidencias[2][$i]); // Elimina espacios en blanco alrededor de los atributos
        $resultado[] = ["etiqueta" => $etiqueta, "atributos" => $atributos];
    }

    return $resultado;
}

$html = '<a href="https://www.example.com" class="enlace">Este es un enlace</a> en un <p id="parrafo1">párrafo</p>.';
$etiquetas = extraerEtiquetasHTML($html);

// Mostrar las etiquetas y sus atributos
foreach ($etiquetas as $elemento) {
    echo "Etiqueta: " . $elemento['etiqueta'] . "</br>";
    echo "Atributos: " . ($elemento['atributos'] ? $elemento['atributos'] : "Sin atributos") . "</br></br>";
}
?>

