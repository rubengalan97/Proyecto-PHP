<?php 

    session_start();

    if (empty($_SESSION)) {
        header("Location: ./index.php");
        die();
    }

    require_once "Database.php";

    if((isset($_POST["usuarioNuevo"])) && (isset($_POST["passNueva"]))) {

        $usuario = $_POST["usuarioNuevo"];
        $pass = $_POST["passNueva"];

        echo $usuario;
        echo $pass;

        $db = Database::getInstancia();
        $db->insertarUsuario($usuario, $pass);
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
    <title>Añadir Usuario</title>
</head>
<body>

    <div class="container centrar fondo">
        <form method="POST">
            <label for="usuarioNuevo">Nombre de Usuario: </label><br>
            <input id="usuarioNuevo" type="text" name="usuarioNuevo" placeholder="Introduce nombre" required autofocus><br><br>
            <label for="passNueva">Contraseña:</label><br>
            <input id="passNueva" type="password" name="passNueva" placeholder="Introduce password" required><br><br>
            <input type="submit" value="Insertar Usuario" class="btn btn-primary">
        </form>
    </div>

</body>
</html>