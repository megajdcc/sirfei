<?php 
	require_once 'autoload.php';
/**
 * @author Pablo
 */
class TipoPersona{
	public $nombre,$descripcion;
	private $id;
	private $conexion;

	public function listarcatalogo(){
		$this->conexion->beginTransaction();
		$sentenciaSQL = "SELECT nombre,id from tipopersona ";
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
                    <button class="seleccion" name="ver" value="<?php echo $id; ?>" data-toggle="tooltip" data-placement="top" title="Cargo">
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

	public function consultar($nombre){
		$this->conexion->beginTransaction();
		$dato = array('nombre' =>$nombre);

		$sql = "select * from tipopersona where nombre = :nombre";
		$stm = $this->conexion->prepare($sql);
		$result = $stm->execute($dato);
		if($result != 0){
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
				 echo $row['nombre'];
			}
		}
		$stm->closeCursor();
	}
	function capturardatos($id){
		try {
			$this->conexion->beginTransaction();
			$sql = "select * from tipopersona where id =:id";
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
	function Verificar($nombre){

		$result = false;
		$this->conexion->beginTransaction();

		$sql = "SELECT * FROM tipopersona where nombre = :nombre";

		$stm = $this->conexion->prepare($sql);
		$result = $stm->execute(array('nombre' => $nombre));

		if($result){
			$this->conexion->commit();
			$result = $stm->fetch();
		} 
		return $result;
	}
	public function registrar($nombre,$descripcion = null){
		$result = false;
		try {
			
			$dato = array('nombre' => $nombre, 'descripcion' => $descripcion);
			$this->conexion->beginTransaction();
			$sql = "INSERT INTO tipopersona(nombre,descripcion) 
									values(:nombre,:descripcion)";
			$stm = $this->conexion->prepare($sql);
			$resultado = $stm->execute($dato);
		
			if($resultado){
			$result = true;
			$this->conexion->commit();
			}else{
				$this->conexion->rollBack();
				
			} 
		
		} catch (PDOException $e) {
			 echo $e->getMessage();
		}
		// $stm->closeCursor();
		return $result;
	}

	function modificar($nombre,$descripcion = null, $id){
		try {
			$result = false;
			$this->conexion->beginTransaction();
			$sql = "UPDATE tipopersona SET nombre = :nombre, descripcion =:descripcion where id =:id";
			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':nombre',$nombre,PDO::PARAM_STR);
			$stm->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
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

	public function eliminar($id){
		$result = false;

		$dato = array('id' => $id);

		try {
			$this->conexion->beginTransaction();
			$sql = "DELETE FROM tipopersona where id = :id";
			$stm = $this->conexion->prepare($sql);
			$result = $stm->execute($dato);

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

	public function listartipo(){
		$sentenciaSQL = "SELECT id, nombre from tipopersona";
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

	function capturarNombre($id){
		try {
			$this->conexion->beginTransaction();

			$sql = "SELECT nombre from tipopersona where id =:id";
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
	function __construct(){
		$this->conexion = new Conexion();
	}
}
 ?>