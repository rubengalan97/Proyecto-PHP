<?php

require_once "Usuarios.php" ;

	Class Sesion {

		private static ?Sesion $instancia = null ;

		private function __clone() {}
		private function __construct() {}

		public static function Sesion():Sesion {

			if(self::$instancia==null) self::$instancia = new Sesion ;
			return self::$instancia ;
		}

		public function login(string $usu, string $pass):bool {

			$usuario = Usuario::encontrarUsuario($usu, $pass) ;

			if (!is_null($usuario)):

				session_start() ;
				$_SESSION["_user"] = serialize($usuario) ;
 				header("Location: ./main.php") ;
				die() ;

			endif ;

			return false ;
		}
	}