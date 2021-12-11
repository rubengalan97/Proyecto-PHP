<?php

    session_start();

    if(empty($_SESSION)) {
        header("Location: ./index.php");
        die();
    }

    require_once("Database.php");

    if (!empty($_POST)) {

        $id  = $_POST["id"];

        $genero = $_POST["genero"];
        $pelicula = $_POST["pelicula"];

        $db = Database::getInstancia();
        $db->actualizarFilmoteca($id, $genero, $pelicula);
        
		header("Location: main.php") ;
		die() ;
    }

    $id = $_GET["idFil"]??"" ;
    $nomGen = $_GET["nomGen"]??"";
    $nomPel = $_GET["nomPel"]??"" ;

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
    <title>Editar Filmoteca</title>
</head>
<body>

    <h2>Editar Filmoteca</h2>
    <div class="container centrar fondo">
        <form method="POST">

        <?php
                $db = Database::getInstancia();
                $generos = $db->consulta("SELECT * FROM genero;")->recuperarTodos();
                $peliculas = $db->consulta("SELECT * FROM pelicula;")->recuperarTodos();

        ?>
            <input type="hidden" name="id" value="<?=$id?>"/>
            <label for="genero">Generos:</label><br>
            <select name="genero" id="genero">
                <?php

                    foreach($generos as $item) {
                        if ($item->nomGen == $nomGen) { 
                        ?>
                            <option name="nomGenE" value="<?=$item->idGenero?>" selected><?=$item->nomGen?></option>
                        <?php
                        } else {
                        ?>
                            <option name="nomGenE" value="<?=$item->idGenero?>"><?=$item->nomGen?></option>
                        <?php
                        }
                    }
                ?>
            </select>
            <br><br>
            <label for="pelicula">Peliculas:</label><br>
            <select name="pelicula" id="pelicula">
                <?php

                    foreach($peliculas as $pelis) {

                        if ($pelis->nomPel == $nomPel) {   
                        ?>
                            <option name="nomPelE" value="<?=$pelis->idPelicula?>" selected><?=$pelis->nomPel?></option>
                        <?php
                        } else {
                            ?>
                            <option name="nomPelE" value="<?=$pelis->idPelicula?>"><?=$pelis->nomPel?></option>
                            <?php
                        }
                    }
                ?>
            </select>
            <br>
            <br>
            <input type="submit" value="Guardar" class="btn btn-primary"/>
        </form>
    </div>
</body>
</html>