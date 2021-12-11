<?php 

    session_start();

    if (empty($_SESSION)) {
        header("Location: ./index.php");
        die();
    }

    require_once "Database.php";


    if((isset($_POST["peliculaNueva"])) && (isset($_POST["duracionNueva"])) && (isset($_POST["fechaNueva"]))) {

        $pelicula = $_POST["peliculaNueva"];
        $duracion = $_POST["duracionNueva"];
        $fecha = $_POST["fechaNueva"];
    
        $db = Database::getInstancia();
        $db->insertarPelicula($pelicula, $duracion, $fecha);
        header("Location: ./main.php");
        die();
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./styleForm.css" type="text/css">
    <title>Añadir Pelicula</title>
</head>
<body>

    <div class="container centrar fondo">
        <form method="POST">
            <label for="peliculaNueva">Nombre de la pelicula: </label><br>
            <input id="peliculaNueva" type="text" name="peliculaNueva" placeholder="Introduce nombre" required autofocus><br><br>
            <label for="duracionNueva">Duracion: </label><br>
            <input id="duracionNueva" type="number" name="duracionNueva" placeholder="Introduce duracion" required><br><br>
            <label for="fechaNueva">Fecha lanzamiento: </label><br>
            <input id="fechaNueva" type="date" name="fechaNueva" required><br><br>
            <input type="submit" value="Insertar Pelicula" class="btn btn-primary">
        </form>
    </div>

</body>
</html>