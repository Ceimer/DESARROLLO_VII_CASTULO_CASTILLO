<?php
$nombre_completo = "Castulo Alejandro Castillo Lamela";
$edad = 21;
$correo ="castuloacastillo28@gmail.com";
$telefono = "6483-3284";

define("OCUPACION", "Estudiante");

echo "Me llamo $nombre_completo y soy " . OCUPACION . "de la utp, tengo $edad años"; 
echo"<br>";
print  "Me puedes contactar llamando al $telefono o escribiendome al correo $correo";

echo "<br>Información de debugging:<br>";
var_dump($nombre_completo);
echo "<br>";
var_dump($edad);
echo "<br>";
var_dump($correo);
echo "<br>";
var_dump($telefono);
echo "<br>";
var_dump(OCUPACION);
?>