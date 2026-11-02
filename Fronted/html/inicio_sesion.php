
<?php
include "../../Backend/php/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $contrasena = $_POST["contrasena"] ?? "";

    // Encriptar la contraseña
    $contrasena_segura = password_hash($contrasena, PASSWORD_DEFAULT);

    // Preparar consulta
    $sql = "INSERT INTO usuarios (nombre, correo, contrasena)
            VALUES (?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param("sss", $nombre, $correo, $contrasena_segura);

    if ($stmt->execute()) {

        $mensaje = "¡Registro exitoso en Huellitas Felices!";

    } else {

        if ($conexion->errno == 1062) {
            $mensaje = "Este correo ya está registrado.";
        } else {
            $mensaje = "Error al registrar: " . $stmt->error;
        }
    }

    $stmt->close();
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inicio de sesión</title>

    <link rel="stylesheet" href="../css/sesion.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" href="../img/log.png">
</head>

<body>

    <div class="fo"></div>

    <div class="contenedor-principal">

        <img src="../img/users.png" alt="Usuario Huellitas Felices">

        <form action="" method="POST">

            <h1>Crear cuenta</h1>

            <input
                type="text"
                name="nombre"
                placeholder="Ingresa tu nombre"
                required
            >

            <input
                type="email"
                name="correo"
                placeholder="Ingresa tu correo electrónico"
                required
            >

            <input
                type="password"
                name="contrasena"
                placeholder="Ingresa tu contraseña"
                autocomplete="new-password"
                required
            >

            <button type="submit">Crear cuenta</button>

            <?php if (!empty($mensaje)): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endif; ?>

            <a class="m" href="http://localhost/huellitas_felices/Fronted/html/registro.php">
                Iniciar sesión
            </a>

        </form>

    </div>

</body>
</html>