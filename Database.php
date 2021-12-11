<?php
    
    error_reporting(E_ERROR) ;
	ini_set("display-errors",0) ;

	class Database {

		private static ?Database $instancia = null;
		private $result ;
		private $mysqli ;

		private function __clone() { }

		/**
		 * Realizamos la conexión con el servidor de bases de datos
		 */
		private function __construct() { 
			$this->mysqli = new mysqli("localhost","root","", "videoclub") ;

			if ($this->mysqli->connect_errno)
				throw new Exception("Se ha producido un error de conexión con la base de datos.") ;
			//
			$this->mysqli->set_charset("utf8") ;			
		}

		/**
		 * Instanciamos la clase Database si no se ha hecho previamente,
		 * y devolvemos dicha instancia.
		 */
		public static function getInstancia() {
			if (self::$instancia==null) self::$instancia = new Database ;
			return self::$instancia ;
		}

		public function consulta(string $sql):?Database {

			$this->result = $this->mysqli->query($sql) ;
			return $this ;
		}
		public function insertarUsuario(string $usuario, string $password) {
			$sql = "INSERT INTO usuario (nomUsu, passUsu) VALUES ('$usuario', '$password');";
			// escapamos la consulta
			$sql = $this->mysqli->real_escape_string($sql) ;
			$this->mysqli->query($sql);
		}

		public function insertarPelicula(string $pelicula, int $duracion, string $fecha) {
			// escapamos los datos introducidos
			$pelicula = $this->mysqli->real_escape_string($pelicula) ;
			$duracion = $this->mysqli->real_escape_string($duracion) ;
			$fecha = $this->mysqli->real_escape_string($fecha) ;

			$fecha = date_create($fecha);
        	$fecha = date_format($fecha, 'Y-m-d');
			$sql = "INSERT INTO pelicula (nomPel, Duracion, fec_Pel) VALUES ('$pelicula', '$duracion', '$fecha');";
	
			$this->mysqli->query($sql);
		}
		public function insertarGenero(string $genero) {
			// escapamos el dato introducido
			$genero = $this->mysqli->real_escape_string($genero) ;
			$sql = "INSERT INTO genero (nomGen) VALUES ('$genero');";

			$this->mysqli->query($sql);
		}
		public function insertarFilmoteca(string $idGen, string $idFil) {
			$idGen = $this->mysqli->real_escape_string($idGen) ;
			$idFil = $this->mysqli->real_escape_string($idFil) ;

			$sql = "INSERT INTO filmoteca (idGenero, idPelicula) VALUES ('$idGen', '$idFil');";
			$this->mysqli->query($sql);
		}

		public function recuperar(string $clas = "StdClass") {
			return $this->result->fetch_object($clas) ;
		}
		public function recuperarId(string $genero) {
			$genero = $this->mysqli->real_escape_string($genero) ;
			$sql = "SELECT idGenero FROM genero WHERE nomGen = '$genero';";
			if ($resultado = $this->mysqli->query($sql)) {
				return $resultado->fetch_assoc();
			}
		}

		public function recuperarTodos(string $clas = "StdClass"):array {
			$datos = [] ;
			while($item = $this->recuperar($clas))
				array_push($datos, $item) ;
			return $datos ;
		}

		public function actualizarFilmoteca(string $id, string $genero, string $pelicula) {
			$id = $this->mysqli->real_escape_string($id) ;
			$genero = $this->mysqli->real_escape_string($genero) ;
			$pelicula = $this->mysqli->real_escape_string($pelicula) ;
			$sql = "UPDATE filmoteca SET idGenero = $genero, idPelicula = $pelicula WHERE idFil = $id;";
			$this->mysqli->query($sql);
		}

		public function borrarFilmoteca(string $idFil) {

			$idFil = $this->mysqli->real_escape_string($idFil);
			$sql = "DELETE FROM filmoteca WHERE filmoteca.idFil = $idFil;";
			$this->mysqli->query($sql);
		}

		public function total():?int {
			return $this->result->num_rows ;
		}

		public function totalColumnas():?int {
			return $this->result->field_count;
		}

		public function __destruct() {
			$this->mysqli->close() ;			
		}
	}