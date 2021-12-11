<?php

    session_start();

    if(empty($_SESSION)) {
        header("Location: ./index.php");
        die();
    } else {
        $_SESSION = [];
        session_destroy();
        header("Location: ./index.php");
        die();
    }
?>