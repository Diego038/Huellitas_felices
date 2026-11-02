
<?php
session_start();

include "../../Backend/php/conexion.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $correo = trim($_POST["correo"] ?? "");
    $contrasena = $_POST["contrasena"] ?? "";

    $sql = "SELECT * FROM usuarios WHERE correo = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if ($usuario && password_verify($contrasena, $usuario["contrasena"])) {

        session_regenerate_id(true);

        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        $_SESSION["nombre"] = $usuario["nombre"] ?? "";
        $_SESSION["correo"] = $usuario["correo"];

        $stmt->close();
        $conexion->close();

        header("Location: ../index.html");
        exit;

    } else {
        $error = "Correo o contraseña incorrectos.";
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

    <title>Registro | Huellitas Felices</title>

    <link rel="stylesheet" href="../css/registro.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" href="../img/log.png">
</head>

<body>

    <div class="fo"></div>

    <main class="contenedor">

        <img src="../img/users.png"
            alt="Icono de usuario"
            class="logo">

        <form action="registro.php" method="POST">

            <h1>Registro</h1>

            <input
                type="email"
                name="correo"
                placeholder="Ingresa tu correo electrónico"
                autocomplete="email"
                required
            >

            <input
                type="password"
                name="contrasena"
                placeholder="Ingresa tu contraseña"
                autocomplete="current-password"
                required
            >

            <button type="submit">Continuar</button>

            <?php if (!empty($error)): ?>
                <p class="error">
                    <?php echo htmlspecialchars($error); ?>
                </p>
            <?php endif; ?>

            <a class="m" href="http://localhost/huellitas_felices/Fronted/html/inicio_sesion.php">
                Crear cuenta
            </a>

        </form>

    </main>

</body>
</html>