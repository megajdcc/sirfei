<?php 
require_once 'autoload.php';

/**
 * @author pablo
 */
class Departamento
{
	public $nombre;
	public $coordinacion;
	private $id;
	private $conexion;
	
	public function listarcatalago(){

		try {
			$this->conexion->beginTransaction();
			$sentenciaSQL = "SELECT d.nombre,d.id, c.nombre as coordinacion,c.id as idcor from departamento as d join coordinacion as c on d.coordinacion = c.id";
			$result = $this->conexion->prepare($sentenciaSQL);
			$result->execute();
			$this->conexion->commit();	
		} catch (PDOException $e) {
			echo $e->getMessage();
			$this->conexion->commit();
		}
		
		while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {

			$nombre   = $fila['nombre'];
			$coordinacion = $fila['coordinacion'];
			$id = $fila['id'];

			?>
			<tr id="fila-<?php echo $id; ?>">
				<td><?php  echo $nombre;?></td>
				<td><?php  echo $coordinacion;?></td>
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
	public function listar(){
		$sentenciaSQL = "SELECT id, nombre from departamento";
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

	public function verificar($nombre, $coordinacion){
		try {

			$param = array(	'nombre' => $nombre,'coordinacion' => $coordinacion);
			$this->conexion->beginTransaction();
			$sentenciaSQL = "SELECT id FROM departamento where nombre =:nombre and coordinacion=:coordinacion";
			$stm = $this->conexion->prepare($sentenciaSQL);
			$stm->execute($param);
			$result = $stm->rowCount();
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

	public function modificar($nombre,$coordinacion,$id){
		$modificacion       = false;
		$this->nombre       = $nombre;
		$this->coordinacion = $coordinacion;
		$this->id           = $id;
		settype($id, 'integer');
		try {
			$dato = array('nombre' =>$nombre,'coordinacion' => $coordinacion, 'id'=>$id);
		$this->conexion->beginTransaction();
		$sentenciaSQL = 'UPDATE departamento set nombre = :nombre, coordinacion = :coordinacion where id =:id ';
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

	public function registrar($nombre, $coordinacion = null){
		$result = false;
		$dato = array('nombre' => $nombre, 'coordinacion' => $coordinacion);
		$this->conexion->beginTransaction();
		$sql = "INSERT INTO departamento(nombre,coordinacion) values (:nombre,:coordinacion)";
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
			$sql = "DELETE FROM departamento where id =:id";
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
		$dato = null;
		try {
			$this->conexion->beginTransaction();
			$sql = "SELECT dep.nombre, dep.id, c.nombre as coordinacion, c.id as idcoordinacion 
						from departamento as dep 
						join coordinacion as c on dep.coordinacion = c.id 
						where dep.id = :id";

			$stm = $this->conexion->prepare($sql);
			$result = $stm->execute(array('id'=>$id));

			if($result){
				$this->conexion->commit();

				$dato = $stm->fetch(PDO::FETCH_ASSOC);
			
			}else{
				$this->conexion->rollBack();
			}	
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
		return $dato;
	}
	function __construct()
	{
		$this->conexion = new Conexion();
	}
}

 ?>