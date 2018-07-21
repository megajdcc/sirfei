<?php 

/**
 * @author Pablo
 */
class Persona
{

	/**
	 * [$cedula description]
	 * @var [integer]
	 */
	protected $cedula;
	public $nombre, $apellido;
	/**
	 * [$conexion description]
	 * @var [Obejct]
	 */
	private $conexion; 
	
	/**
	 * [El metodo de consulta se realiza con la intencion  de buscar a la persona con el unico parametro unico de cualquier persona en venezuela que es su dato nacional identificativo DNI]
	 * @param  [bigint] $cedula [La cedula es el dato identificativo de cualquier persona por lo tal buscaremos con este parametro.]
	 */
	public function consultar($cedula){
		
		$this->conexion->beginTransaction();

		$dato = array('cedula' =>$cedula);

		$sql = "select p.nombre,p.apellido,p.cedula, tp.nombre as tipoperson, tp.profesion 
					from persona  as p
					join tipopersona as tp on p.idtipoperson = tp.id 
					where p.cedula =:cedula";

		$stm = $this->conexion->prepare($sql);
		$result = $stm->execute($dato);
		if($result != 0){
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

				 echo $row['nombre'];
				// echo $row['apellido'];
				// echo $row['cedula'];
				// echo $row['tipoperson'];
			}
			
		}
		$stm->closeCursor();
	}

	/**
	 * [registrar description]
	 * @param  [type] $cedula      [description]
	 * @param  [type] $nombre      [description]
	 * @param  [type] $apellido    [description]
	 * @param  [type] $tipopersona [description]
	 * @return [type]              [description]
	 */
	public function registrar($cedula,$nombre,$apellido,$tipopersona){
		$result = false;
		try {
			$this->conexion->beginTransaction();
			$dato = array('cedula' => $cedula,'nombre' => $nombre,'apellido' => $apellido,'tipopersona' => $tipopersona);
			$sql = "INSERT INTO persona(cedula,nombre,apellido,idtipoperson) 
									values(:cedula,:nombre,:apellido,:tipopersona)";
			$stm = $this->conexion->prepare($sql);
			$resultado = $stm->execute($dato);
			if($resultado != 0){
			$result = true;
		} 
		
		} catch (PDOException $e) {
			 echo $e->getMessage();
		}
		$stm->closeCursor();
		return $result;
	}

	/**
	 * [eliminar description]
	 * @param  [bigint] $cedula [utilizaremos la cedula para eliminar los datos]
	 * @return [boolean]$result [dato retornado que indica si se ejecuto con exito o no la sentencia sql]
	 */
	public function eliminar($cedula){
		$result = false;
		try {
			$this->conexion->beginTransaction();
			$dato = array('cedula' => $cedula);
			$sql = "DELETE from persona where cedula = :cedula";
			$stm = $this->conexion->prepare($sql);
			$resultado = $stm->execute($dato);
			if($resultado != 0){
				$result = true;
			}
			
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		$stm->closeCursor();
		return $result;
	}

	/**
	 * [modificar description]
	 * @param  [type] $dato [description]
	 * @return [type]       [description]
	 */
	public function modificar($dato){
		$result = false;
		try {
			$this->conexion->beginTransaction();
			$sql = "UPDATE persona set nombre = :nombre, apellido = :apellido, 
			idtipoperson = :tipopersona where cedula = :cedula";
			$stm = $this->conexion->prepare($sql);
			$resultado = $stm->execute($dato);
			// echo $stm->columnCount();
			if($resultado != 0){
				$result = true;
			}
		
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		$stm->closeCursor();
		return $result;
	}

	/**
	 * [Constructor de la class persona, no recibe ningun parametro pero si se encarga de crear una instancia nueva
	 * de Conexion object y la asigna a la variable local conexion]
	 */
	function __construct(){
		$this->conexion = new Conexion();
	}
}
// $conec = new Persona;
// $dato = array(
// 	'cedula' => 20464273, 
// 	'nombre' => "juancarloss", 
// 	'apellido' => "colmenarez", 
// 	'tipopersona' => 1);
// // $conec->consultar(20464273);
// echo $conec->modificar($dato);
 ?>