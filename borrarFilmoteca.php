<?php

    session_start();

    if(empty($_SESSION)) {
        header("Location: ./index.php");
        die();
    } else {

        require_once "Database.php";

        if(isset($_GET["idFil"])) {

            $idFil = $_GET["idFil"];
    
            $db = Database::getInstancia();
            $db->borrarFilmoteca($idFil);
            header("Location: ./main.php");
            die();
        } else {
            header("Location: ./main.php");
            die();
        }
    }

?>