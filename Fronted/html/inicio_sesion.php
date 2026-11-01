<!DOCTYPE html>
<html lang="es">
<?php
$mensaje = "";

// Solo procesa los datos si se envió el formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../../Backend/php/conexion.php";

    // Usamos el operador ?? para evitar los errores de claves indefinidas
    $nombre = $_POST["nombre"] ?? '';
    $correo = $_POST["correo"] ?? '';
    $contrasena = $_POST["contrasena"] ?? '';

    if (isset($conexion)) {
        $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')";

        if ($conexion->query($sql) === TRUE) {
            $mensaje = "¡Registro exitoso en Huellitas Felices!";
        } else {
            $mensaje = "Error: " . $conexion->error;
        }
    } else {
        $mensaje = "No se pudo conectar a la base de datos.";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión - Huellitas Felices</title>
    <link rel="stylesheet" href="../css/sesion.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" href="../img/log.png">
</head>
<body>
    <div class="fo"></div>

    <div class="contenedor-principal">
        <img src="../img/users.png" alt="Usuario Huellitas Felices">
        
        <form action="" method="POST">
            
            <h1>Inicio de sesión</h1>
            
            <input type="text" name="nombre" placeholder="Ingresa tu nombre" required>
            <input type="email" name="correo" placeholder="Ingresa tu correo electrónico" required>
            <input type="password" name="contrasena" placeholder="Ingresa tu contraseña" required>
            
            <button type="submit">Iniciar sesión</button>

            <a class="m" href="http://localhost/huellitas_felices/Fronted/html/registro.php">Registrarse</a>

        </form>
    </div>
</body>
</html>