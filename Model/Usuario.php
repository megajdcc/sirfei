<?php 
require_once 'autoload.php';
/**
 * @author Pablo
 */
class Usuario extends Persona{
	
	public $usuario,$contrasena;
	private $conexion;
	private $id;

	public function setId($id){
		$this->id = $id;
	}
	public function Listar(){

		// $this->conexion->beginTransaction();


	}
	public function loguear($usuario,$contrasena){
		try {
			$this->usuario =$usuario;
			$this->contrasena = sha1($contrasena);
			// verificamos inicio de session...
			$sentenciaSQL = ('SELECT id FROM usuario WHERE usuario = ? AND contrasena = ? ');
			$resultado = $this->conexion->prepare($sentenciaSQL);
			$resultado->execute(array($this->usuario, $this->contrasena));
			return $resultado->fetch();
			 // ->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			print($e);
			die("ERROR :".$e->getMessage() );
		}

		$resultado->closeCursor();
	}
	public function datosesion($id){
		$this->setId($id);
		$sentenciaSQL = "SELECT p.cedula, p.nombre,p.apellido,u.usuario,tp.nombre as tipopersona FROM persona as p 
		join usuario as u on p.cedula = u.cedulperson
		join tipopersona as tp on p.idtipoperson = tp.id
		where u.id = ?";
		$result = $this->conexion->prepare($sentenciaSQL);
		$result->execute(array($this->id));
		return $result;
	}
	function __construct(){
		$this->conexion = new Conexion();
	}
}

 ?>