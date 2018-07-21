<?php 
require_once 'autoload.php';

/**
 * @author Pablo Bastardo
 * @since v1.1
 */
class EstadoServicio{
	
	/**
	 * Variable de clases 
	 */
	
	/**
	 * [$conexion es una variable de tipo objeto que almacenará la instancia del objecto Conexion class]
	 * @var [object]
	 */
	private $conexion; 
	private $condicion,$id;


	function __construct(){
		$this->conexion = new Conexion();
	}

	/**
	 * Metodos de la clase TipoEquipo... 
	 * 
	 */
	
	function ListarCatalogo(){

		$this->conexion->beginTransaction();
		$sentenciaSQL = "SELECT condicion,id from estadoservicio";
		$result = $this->conexion->prepare($sentenciaSQL);
		$result->execute();
		$this->conexion->commit();
		while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
			$nombre = $fila['condicion'];
			$id     = $fila['id'];
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

	function Verificar($nombre){

		$result = false;
		$this->conexion->beginTransaction();

		$sql = "SELECT * FROM estadoservicio where condicion = :nombre";

		$stm = $this->conexion->prepare($sql);
		$result = $stm->execute(array('nombre' => $nombre));

		if($result){
			$this->conexion->commit();
			$result = $stm->fetch();
		} 
		return $result;
	}

	function registrar($nombre){
		$result = false;
		$this->conexion->beginTransaction();

		$sql = "INSERT INTO estadoservicio (condicion) values(:nombre)";

		$stm = $this->conexion->prepare($sql);
		$stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
		$result = $stm->execute();
		if($result){
			$this->conexion->commit();
		}else{
			$this->conexion->rollBack();
		}

		return $result;
	}

	function eliminar($id){
		$result = false ;

		$this->conexion->beginTransaction();
		$sql = "DELETE FROM estadoservicio where id =:id";

		$stm = $this->conexion->prepare($sql);
		$stm->bindParam(':id',$id, PDO::PARAM_INT);
		$result = $stm->execute();
		if($result){
			$this->conexion->commit();
		}else{
			$this->conexion->rollBack();
		}
		return $result;		
	}

	function capturardatos($id){
		try {
			$this->conexion->beginTransaction();
			$sql = "select * from estadoservicio where id =:id";
			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':id',$id,PDO::PARAM_INT);
			$result = $stm->execute();

			if($result){
				$this->conexion->commit();
				 return $stm->fetch(PDO::FETCH_ASSOC);
			}else{
				$this->conexion->rollBack();
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	function modificar($nombre,$id){
		try {
			$result = false;
			$this->conexion->beginTransaction();
			$sql = "UPDATE estadoservicio SET condicion = :nombre where id =:id";
			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':nombre',$nombre,PDO::PARAM_STR);
			$stm->bindParam(':id', $id,PDO::PARAM_INT);
			$result = $stm->execute();

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
}
 ?>