    <!DOCTYPE html>

<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ./registro.php");
    exit;
}

include "../../Backend/php/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $raza = $_POST["raza"];
    $edad = (int) $_POST["edad"];
    $sexo = $_POST["sexo"];
    $estado = $_POST["estado"];
    $tipo = $_POST["tipo_animal"];

    // Elegir la tabla
    if ($tipo == "ave") {
        $tabla = "aves";
    } elseif ($tipo == "conejo") {
        $tabla = "conejos";
    } elseif ($tipo == "gato") {
        $tabla = "gatos";
    } elseif ($tipo == "perro") {
        $tabla = "perros";
    } else {
        die("Tipo de animal no válido.");
    }

    // Guardar los datos
    $sql = "INSERT INTO $tabla (nombre, raza, edad, sexo, estado)
            VALUES (?, ?, ?, ?, ?)";

    $consulta = $conexion->prepare($sql);

    $consulta->bind_param(
        "ssiss",
        $nombre,
        $raza,
        $edad,
        $sexo,
        $estado
    );

    if ($consulta->execute()) {
        $mensaje = "¡Mascota guardada correctamente!";
    } else {
        $mensaje = "Error al guardar la mascota.";
    }

    $consulta->close();
}
?>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../css/puplicar.css?v=<?php echo time(); ?>">
        <link rel="icon" type="image/png" href="../img/log.png">
    </head>
    <body>
        <header>
            <h2 ><a href="">Marketplace</a></h2>
            <h2><a href="">Contacto</a></h2>
            <img src="../img/log.png" alt="">
            <a class="o" href="http://localhost/huellitas_felices/Fronted/html/registro.php"><img src="../img/user.png" alt=""></a>
            <h2>Publicar</h2>
        </header>

        <form action="publicar.php" method="POST">
            <h1>Formulario de Adopcion</h1>

            <input type="text" name="nombre" placeholder="Escribe el nombre de la mascota">

            <input type="text" name="raza" placeholder="Escribe la raza">

            <input type="number" name="edad" placeholder="Escribe la edad">

            <input type="text" name="sexo" placeholder="Escribe el sexo">

            <input type="text" name="estado" placeholder="Escribe el estado">

<button type="submit" name="tipo_animal" value="ave">Ave</button>
<button type="submit" name="tipo_animal" value="conejo">Conejo</button>
<button type="submit" name="tipo_animal" value="gato">Gato</button>
<button type="submit" name="tipo_animal" value="perro">Perro</button>
        </form>
    </body>
    </html>