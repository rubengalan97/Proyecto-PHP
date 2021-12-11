<?php
	require_once "Database.php" ;

	class Filmoteca {


		private $idFil ;
		private $nomGen ;
		private $nomPel;

		public function __get($key) {
			if (property_exists("Filmoteca", $key)) return $this->$key ;
			throw new Exception ;
		}
        public function __set($key, $value) {			
			switch($key) {
				case "nomGen":
				case "nomPel":
				default: 
					throw new Exception ;
            }
		}

		public function actualizar() {
			$db = Database::getInstancia() ;
			$sql = "UPDATE filmoteca SET nomGen = '{$this->nomGen}',nomPel  = '{$this->nomPel}' WHERE idFil={$this->idFil};" ;

			$db->consulta($sql) ;
		}

		public static function buscarId($id):?Filmoteca
		{
			$db = Database::getInstancia() ;
			$db->consulta("SELECT * FROM filmoteca WHERE idFil=$id ;") ;
			return $db->recuperar("Filmoteca") ;
		}

	}
