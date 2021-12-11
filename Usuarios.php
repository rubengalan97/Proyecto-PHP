<?php

require_once "Database.php";


class Usuario {

    private $idUsu ;
	private $usuario ;
	private $password ;

    public static function encontrarUsuario(string $usuario, string $password):?Usuario {			
		$db  = Database::getInstancia() ;
		$total = $db->consulta("SELECT * FROM usuario WHERE nomUsu='$usuario' AND passUsu='$password' ;")->total() ;
		return ($total)?$db->recuperar("Usuario"):null ;
	}

}

