
<?php
require_once 'validaciones.php';
require_once 'sanitizacion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = [];
    $datos = [];

    // Procesar y validar cada campo
    $campos = ['nombre', 'email', 'sitio_web', 'genero', 'intereses', 'comentarios'];
    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            $valor = $_POST[$campo];
            $valorSanitizado = call_user_func("sanitizar" . ucfirst($campo), $valor);
            $datos[$campo] = $valorSanitizado;

            if (!call_user_func("validar" . ucfirst($campo), $valorSanitizado)) {
                $errores[] = "El campo $campo no es válido.";
            }
        }
    }

    // Procesar la foto de perfil
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
        if (!validarFotoPerfil($_FILES['foto_perfil'])) {
            $errores[] = "La foto de perfil no es válida.";
        } else {
            $rutaDestino = 'uploads/' . basename($_FILES['foto_perfil']['name']);
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaDestino)) {
                $datos['foto_perfil'] = $rutaDestino;
            } else {
                $errores[] = "Hubo un error al subir la foto de perfil.";
            }
        }
    }

    // Mostrar resultados o errores
    if (empty($errores)) {
        echo "<h2>Datos Recibidos:</h2>";
        foreach ($datos as $campo => $valor) {
            if ($campo === 'intereses') {
                echo "$campo: " . implode(", ", $valor) . "<br>";
            } elseif ($campo === 'foto_perfil') {
                echo "$campo: <img src='$valor' width='100'><br>";
            } else {
                echo "$campo: $valor<br>";
            }
        }
    } else {
        echo "<h2>Errores:</h2>";
        foreach ($errores as $error) {
            echo "$error<br>";
        }
    }
} else {
    echo "Acceso no permitido.";
}

// Modificar la sección de mostrar resultados
if (empty($errores)) {
    echo "<h2>Datos Recibidos:</h2>";
    echo "<table border='1'>";
    foreach ($datos as $campo => $valor) {
        echo "<tr>";
        echo "<th>" . ucfirst($campo) . "</th>";
        if ($campo === 'intereses') {
            echo "<td>" . implode(", ", $valor) . "</td>";
        } elseif ($campo === 'foto_perfil') {
            echo "<td><img src='$valor' width='100'></td>";
        } else {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<h2>Errores:</h2>";
    echo "<ul>";
    foreach ($errores as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
}
if (isset($_POST['fecha_nacimiento'])) {
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $fechaNacimientoSanitizada = sanitizarFechaNacimiento($fechaNacimiento);
    $datos['fecha_nacimiento'] = $fechaNacimientoSanitizada;

    if (!validarFechaNacimiento($fechaNacimientoSanitizada)) {
        $errores[] = "La fecha de nacimiento no es válida.";
    } else {
        // Cálculo de la edad
        $fechaActual = new DateTime();
        $fechaNacimiento = new DateTime($fechaNacimientoSanitizada);
        $edadCalculada = $fechaActual->diff($fechaNacimiento)->y;
        $datos['edad'] = $edadCalculada;
    }
}
if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
    if (!validarFotoPerfil($_FILES['foto_perfil'])) {
        $errores[] = "La foto de perfil no es válida.";
    } else {
        // Generar un nombre único para la imagen
        $nombreUnico = uniqid() . "_" . basename($_FILES['foto_perfil']['name']);
        $rutaDestino = 'uploads/' . $nombreUnico;
        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaDestino)) {
            $datos['foto_perfil'] = $rutaDestino;
        } else {
            $errores[] = "Hubo un error al subir la foto de perfil.";
        }
    }
}
if (!empty($errores)) {
    // Guardar los datos actuales en la sesión para mostrarlos en el formulario
    session_start();
    $_SESSION['errores'] = $errores;
    $_SESSION['datos'] = $datos;
    header('Location: formulario.php');
    exit;
}
if (empty($errores)) {
    $archivo = 'registros.json';
    $registros = [];

    // Leer el archivo JSON si existe
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        $registros = json_decode($contenido, true);
    }

    // Añadir los nuevos datos al array de registros
    $registros[] = $datos;

    // Guardar el array actualizado en el archivo JSON
    file_put_contents($archivo, json_encode($registros, JSON_PRETTY_PRINT));

    // Redireccionar a la página de resumen
    header('Location: resumen.php');
    exit;
}
if (!empty($errores)) {
    session_start();
    $_SESSION['errores'] = $errores;
    $_SESSION['datos'] = $datos;
    header('Location: formulario.html');
    exit;
}
if (empty($errores)) {
    session_unset();
    session_destroy();
    // Guardar datos en JSON y redirigir como se indicó anteriormente
}

echo "<br><a href='formulario.html'>Volver al formulario</a>";
?>