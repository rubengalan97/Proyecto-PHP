<?php


    session_start();

    if(empty($_SESSION)) {
        header("Location: ./index.php");
        die();
    }

    require_once "Database.php";

    if(isset($_POST["genero"]) && (isset($_POST["pelicula"]))) {

        $idGenero = $_POST["genero"];
        $idPelicula = $_POST["pelicula"];

        if($_POST["genero"] == "otroGen") {

            $idGenero = $_POST["nuevoGenero"];
            $db = Database::getInstancia();
            $db->insertarGenero($idGenero);
            $prueba = $db->recuperarId($idGenero);
            $idGenero = $prueba["idGenero"];
            $db->insertarFilmoteca($idGenero, $idPelicula);
            header("Location: ./main.php");
            die();
            
        } else {
            $db = Database::getInstancia();
            $db->insertarFilmoteca($idGenero, $idPelicula);
            header("Location: ./main.php");
            die();
        } 
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./styleForm.css" type="text/css">
    <script src="./form.js"></script>
    <title>Añadir Filmoteca</title>
</head>
<body>

<h2>Añadir a la filmoteca</h2>

<div class="container centrar fondo"> 
    <form method="POST">

    <?php
        $db = Database::getInstancia();

        $generos = $db->consulta("SELECT * FROM genero;")->recuperarTodos();
        $peliculas = $db->consulta("SELECT * FROM pelicula;")->recuperarTodos();

    ?>

        <label for="genero">Selecciona el genero:</label><br>
        <select name="genero" id="genero">
        <?php

            foreach($generos as $item) {
        ?>
        <option name="nomGenE" value="<?=$item->idGenero?>"><?=$item->nomGen?></option>
        <?php
            }
        ?>
        
        <option name=nomGenE value="otroGen" id="otroGen">Otro:</option>
        </select>
        <input type="hidden" id="nuevoGenero" name="nuevoGenero" placeholder="Introduce otro">
        <br><br>
        <label for="pelicula">Selecciona la peliculas:</label><br>
        <select name="pelicula" id="pelicula">
        <?php

            foreach($peliculas as $pelis) {
        ?>
        <option name="nomPelE" value="<?=$pelis->idPelicula?>"><?=$pelis->nomPel?></option>
        <?php
            }
        ?>
    </select>
    <br>
    <br>
    <input type="submit" value="Añadir a la filmoteca" class="btn btn-primary"/>
</form>
</div>
    
</body>
</html>