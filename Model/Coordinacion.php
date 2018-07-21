<?php 
require_once 'autoload.php';

/**
 * @author pablo
 */
class Coordinacion
{
	public $nombre;
	private $id;
	private $conexion;
	
	public function listarcatalago(){

		$this->conexion->beginTransaction();
		$sentenciaSQL = "SELECT nombre,id from coordinacion";
		$result = $this->conexion->prepare($sentenciaSQL);
		$result->execute();
		$this->conexion->commit();
		while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {

			$nombre   = $fila['nombre'];
			$id = $fila['id'];
			?>
			<tr id="fila-<?php echo $id; ?>">
				<td><?php  echo $nombre;?></td>

                <td>
					<div class="dropdown conf-seleccion">
                    <button class ="dropdown conf" type="button" id="conf" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Configuración"><i class="fa fa-cog"></i>
                    </button>
					
                    <div class="dropdown-menu selec" aria-labelledby="conf">
                    <button class="seleccion" name="ver" value="<?php echo $id; ?>" data-toggle="tooltip" data-placement="top" title="Coordinacion">
                        <i class=" fa fa-wpforms"></i>
                        Ver
                    </button>
                    <button class="seleccion" name="eliminar" value="<?php echo $id; ?>" data-toggle="tooltip" data-placement="top" title="Recuerde estar seguro antes de eliminar">
                        <i class=" fa fa-remove"></i>
                        Eliminar
                    </button>
                    </div>
                    </div>
                </td>
            </tr>
			<?php
		}
	}

	public function verificar($nombre){

		try {
			$param = array(	'nombre' => $nombre);
			$this->conexion->beginTransaction();
			$sentenciaSQL = "SELECT id FROM coordinacion where nombre =:nombre";
			$stm = $this->conexion->prepare($sentenciaSQL);
			$result = $stm->execute($param);

			if($result){
				$this->conexion->commit();
				$fila = $stm->fetch(PDO::FETCH_ASSOC);
				if(!$fila){
					$result = false;
				}
			}else{
				$this->conexion->rollBack();
			}
			return $result;
		} catch (PDOException $e) {
			die("ERROR: ". $e->getMessage());
		}
	}

	public function modificar($nombre,$id){
		$modificacion = false;
		$this->nombre      = $nombre;
		$this->id          = $id;
		settype($id, 'integer');
		try {
			$dato = array('nombre' =>$nombre,'id' => $id);
		$this->conexion->beginTransaction();
		$sentenciaSQL = 'UPDATE coordinacion set nombre = :nombre where id = :id';
		$stm = $this->conexion->prepare($sentenciaSQL);
		$result = $stm->execute($dato);
		$result = $stm->columnCount();
		if ($result) {
			$modificacion = true;
		}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
		
		return $modificacion;
	}

	public function registrar($nombre){
		$result = false;
		$dato = array('nombre' => $nombre);
		$this->conexion->beginTransaction();
		$sql = "INSERT INTO coordinacion(nombre ) values (:nombre)";
		$stm = $this->conexion->prepare($sql);
		$result = $stm->execute($dato);

		if($result){
			$this->conexion->commit();
		}else{
			$this->conexion->rollBack();
		}
		return $result;
	}

	public function eliminar($id){
		$result = false;
		try {
			settype($id, 'integer');

			$this->conexion->beginTransaction();
			$sql = "DELETE FROM coordinacion where id =:id";
			$stm = $this->conexion->prepare($sql);
			$result = $stm->execute(array('id' =>$id));
			if($result){
					$this->conexion->commit();
			}else{
				$this->conexion->rollBack();
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
		return $result;
	}

	public function capturardatos($id){

		$this->conexion->beginTransaction();
		$sql = "SELECT * from coordinacion where id = :id";

		$stm = $this->conexion->prepare($sql);
		$result = $stm->execute(array('id'=>$id));

		if($result){
			$this->conexion->commit();

			$dato = $stm->fetch(PDO::FETCH_ASSOC);
		
		}else{
			$this->conexion->rollBack();
		}
		return $dato;
	}
	public function listarcoordinacion(){
 		
 		$this->conexion->beginTransaction();
 		$sql = "SELECT * FROM coordinacion";
 		$stm = $this->conexion->prepare($sql);
 		$result = $stm->execute();

 		if($result){
 			$this->conexion->commit();
 			if($row = $stm->fetch(PDO::FETCH_ASSOC)){
 				
					$nombre = $row['nombre'];
					$id     = $row['id'];
 					echo '<OPTION value='.$id.'>'.$nombre.'</OPTION>';

 			}
 		}
	}
	function __construct()
	{
		$this->conexion = new Conexion();
	}
}

 ?>