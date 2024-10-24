<?php
$archivo = 'registros.json';

if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $registros = json_decode($contenido, true);
} else {
    echo "No hay registros disponibles.";
    exit;
}
?>

<h2>Resumen de Registros</h2>
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Edad</th>
        <th>Fecha de Nacimiento</th>
        <th>Género</th>
        <th>Intereses</th>
        <th>Comentarios</th>
        <th>Foto de Perfil</th>
    </tr>

    <?php foreach ($registros as $registro): ?>
        <tr>
            <td><?php echo $registro['nombre']; ?></td>
            <td><?php echo $registro['email']; ?></td>
            <td><?php echo $registro['edad']; ?></td>
            <td><?php echo $registro['fecha_nacimiento']; ?></td>
            <td><?php echo $registro['genero']; ?></td>
            <td><?php echo implode(", ", $registro['intereses']); ?></td>
            <td><?php echo $registro['comentarios']; ?></td>
            <td><img src="<?php echo $registro['foto_perfil']; ?>" width="100"></td>
        </tr>
    <?php endforeach; ?>
</table>
