<?php 

    session_start();

    if (empty($_SESSION)) {
        header("Location: ./index.php");
        die();
    }

    require_once "Database.php";

    if(isset($_POST["generoNuevo"])) {

        $genero = $_POST["generoNuevo"];

        $db = Database::getInstancia();
        $db->insertarGenero($genero);
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
    <title>Añadir Género</title>
</head>
<body>

    <div class="container w-75 ">
        <div id="formulario" class="container d-flex justify-content-center mt-75">
            <form method="POST">

            <div class="mb-3">
                <label for="generoNuevo" class="form-label letras">Género: </label><br>
                <input id="generoNuevo" class="form-control" type="text" name="generoNuevo" required autofocus placeholder="Introduce un género">
            </div>
                <input type="submit" value="Insertar Género" class="btn btn-primary">
            </form>
        </div>
    </div>
    <div class="centrar">
        <img src="./formulario.png" id="imagen">
    </div>
</body>
</html>