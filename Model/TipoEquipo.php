<?php 
require_once 'autoload.php';

/**
 * @author Pablo Bastardo
 * @since v1.1
 */
class TipoEquipo{
	
	/**
	 * Variable de clases 
	 */
	
	/**
	 * [$conexion es una variable de tipo objeto que almacenará la instancia del objecto Conexion class]
	 * @var [object]
	 */
	private $conexion; 
	private $nombre,$id;


	function __construct(){
		$this->conexion = new Conexion();
	}

	/**
	 * Metodos de la clase TipoEquipo... 
	 * 
	 */
	
	function ListarCatalogo(){

		$this->conexion->beginTransaction();
		$sentenciaSQL = "SELECT nombre,id from tipoequipo";
		$result = $this->conexion->prepare($sentenciaSQL);
		$result->execute();
		$this->conexion->commit();
		while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
			$nombre = $fila['nombre'];
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

		$sql = "SELECT * FROM tipoequipo where nombre = :nombre";

		$stm = $this->conexion->prepare($sql);
		$result = $stm->execute(array('nombre' => $nombre));

		if($result){
			$this->conexion->commit();
			$result = $stm->fetch();
		} 
		return $result;
	}

	public function listartipoequipo(){
		$sentenciaSQL = "SELECT id, nombre from tipoequipo";
		$stm =$this->conexion->prepare($sentenciaSQL);
		$result = $stm->execute();
		if ($result) {
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
					$nombre =$row["nombre"];
					$id     =$row["id"];
				echo '<OPTION value='.$id.'>'.$nombre.'</OPTION>';
			}
		}
		
	}
	function registrar($nombre){
		$result = false;
		$this->conexion->beginTransaction();

		$sql = "INSERT INTO tipoequipo (nombre) values(:nombre)";

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
		$sql = "DELETE FROM tipoequipo where id =:id";

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
			$sql = "select * from tipoequipo where id =:id";
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
			$sql = "UPDATE tipoequipo SET nombre = :nombre where id =:id";
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

	function capturarnombre($id){
		try {
			$this->conexion->beginTransaction();

			$sql = "SELECT nombre from tipoequipo where id =:id";
			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':id',$id,PDO::PARAM_INT);

			$result = $stm->execute();

			if($result){
				$this->conexion->commit();

				$fila = $stm->fetch(PDO::FETCH_ASSOC);
				return $fila['nombre'];
			}else{
				$this->conexion->rollBack();
			}
		} catch (PDOException $e) {
			
		}
	}
}
 ?>