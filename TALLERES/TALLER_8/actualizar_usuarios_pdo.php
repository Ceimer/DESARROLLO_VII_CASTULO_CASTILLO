<?php
require_once "config_pdo.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    
    // Consulta SQL para actualizar el usuario
    $sql = "UPDATE usuarios SET nombre = :nombre WHERE email = :email";
    
    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        
        if($stmt->execute()){
            echo "Usuario actualizado con éxito.";
        } else{
            echo "ERROR: No se pudo ejecutar $sql. " . $stmt->errorInfo()[2];
        }
    }
    
    unset($stmt);
}

unset($pdo);
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div><label>Nombre</label><input type="text" name="nombre" required></div>
    <div><label>Email</label><input type="email" name="email" required></div>
    <input type="submit" value="Actualizar Usuario">
</form>
