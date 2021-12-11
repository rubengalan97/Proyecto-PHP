<?php 

    session_start(); //Iniciamos sesion

    if (empty($_SESSION)) {
        header("Location: ./index.php");
        die();
    }

    require_once "Database.php"; //Nos traemos el archivo Database.php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./stylemain.css" type="text/css">
    <title>Pagina principal</title>
</head>
<body>

    <a href="logout.php" id="salir">Cerrar sesion</a><br>

    <?php
        $db = Database::getInstancia() ;
		$totalFilas = $db->consulta("SELECT COUNT(*) FROM filmoteca")->total();

        $datos = $db->consulta("SELECT idFil, nomGen, nomPel, Duracion, fec_Pel FROM filmoteca JOIN pelicula ON pelicula.idPelicula = filmoteca.idPelicula JOIN genero ON genero.idGenero = filmoteca.idGenero ORDER BY 1;")
        ->recuperarTodos();

    ?>

    <h2>Filmoteca</h2>

    <table id="tabla">
    
        <tr>
            <th>IdFil</th>
            <th>Genero</th>
            <th>Nombre</th>
            <th>Duracion</th>
            <th>Fecha de estreno</th>
        </tr>

        <?php

            foreach($datos as $resultados) {
                echo "<tr>";
                echo "<td>";
                echo $resultados->idFil;
                echo "</td>";
                echo "<td>";
                echo $resultados->nomGen;
                echo "</td>";
                echo "<td>";
                echo $resultados->nomPel;
                echo "</td>";
                echo "<td>";
                echo $resultados->Duracion." min";
                echo "</td>";
                echo "<td>";
                echo $resultados->fec_Pel;
                echo "</td>";
                echo "<td>";
                ?>
                <a href="./editarFilmoteca.php?idFil=<?=$resultados->idFil?>&nomGen=<?=$resultados->nomGen?>&nomPel=<?=$resultados->nomPel?>"><button class="btn btn-success">Editar</button></a>
                <?php
                echo "</td>";
                echo "<td>";
                ?>
                <a href="./borrarFilmoteca.php?idFil=<?=$resultados->idFil?>"><button class="btn btn-danger">Borrar</button></a>
                <?php
                echo "</td>";
            echo "</tr>";

            }
        ?>
    </table><br>
    <div class="main-button d-flex justify-content-center">
        <a href="./subirUsuario.php"><button class="bt btn-primary boton">Añadir usuario</button></a>
        <a href="./subirGenero.php"><button class="bt btn-primary boton">Añadir género</button></a>
        <a href="./subirPelicula.php"><button class="bt btn-primary boton">Añadir pelicula</button></a>
        <a href="./subirFilmoteca.php"><button class="bt btn-primary boton">Añadir a la filmoteca</button></a>
    </div>
    
    <div id="imagenes">
        <img src="./peliculas.jpg" id="img">
    </div>



</body>
</html>