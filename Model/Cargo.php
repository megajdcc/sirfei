<?php 
require_once 'autoload.php';

/**
 * @author pablo
 */
class Cargo
{
	public $nombre;
	public $descripcion;
	private $id;
	private $conexion;
	
	public function listarcatalago(){

		$this->conexion->beginTransaction();
		$sentenciaSQL = "SELECT nombre,id from cargo ";
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
                        Ver cargo
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

	public function verificar($nombre, $descripcion = null){
		try {

			$param = array(	'nombre' => $nombre,'descripcion' => $descripcion);
			$this->conexion->beginTransaction();
			$sentenciaSQL = "SELECT id FROM cargo where nombre =:nombre and descripcion=:descripcion";
			$stm = $this->conexion->prepare($sentenciaSQL);
			$stm->execute($param);
			$result = $stm->rowCount();
			if($result){
				$this->conexion->commit();
			}else{
				$this->conexion->rollBack();
			}
			return $result;
		} catch (PDOException $e) {
			die("ERROR: ". $e->getMessage());
		}
	}

	public function modificar($nombre,$descripcion = null,$id){
		$modificacion = false;
		$this->nombre      = $nombre;
		$this->descripcion = $descripcion;
		$this->id          = $id;
		settype($id, 'integer');
		try {
			$dato = array('nombre' =>$nombre,'descripcion' => $descripcion);
		$this->conexion->beginTransaction();
		$sentenciaSQL = 'UPDATE cargo set nombre = :nombre, descripcion = :descripcion where id ="'.$id.'"';
		$stm = $this->conexion->prepare($sentenciaSQL);
		$result = $stm->execute($dato);
		if ($result) {
			$modificacion = true;
		}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
		
		return $modificacion;
	}

	public function registrar($nombre, $descripcion = null){
		$result = false;
		$dato = array('nombre' => $nombre, 'descripcion' => $descripcion);
		$this->conexion->beginTransaction();
		$sql = "INSERT INTO cargo(nombre,descripcion) values (:nombre,:descripcion)";
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
			$sql = "DELETE FROM cargo where id =:id";
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
		$sql = "SELECT * from cargo where id = :id";

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

	public function listar(){
		$sentenciaSQL = "SELECT id, nombre from cargo";
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

			$sql = "SELECT nombre from cargo where id =:id";
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
	function __construct()
	{
		$this->conexion = new Conexion();
	}
}

 ?>