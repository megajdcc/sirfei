<?php
require_once 'autoload.php';

/**
  *@author Pablo 
  */
 class Modelo{
 	
 	private $conexion;
 	public $model,$id;

 	function __construct(){
 		$this->conexion = new Conexion();
 	}

 	function ListarCatalogo(){

		$this->conexion->beginTransaction();
		$sentenciaSQL = "SELECT model,id from modelo";
		$result = $this->conexion->prepare($sentenciaSQL);
		$result->execute();
		$this->conexion->commit();
		while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
			$modelo = $fila['model'];
			$id     = $fila['id'];
			?>
			<tr id="fila-<?php echo $id; ?>">
				<td><?php  echo $modelo;?></td>

                <td>
					<div class="dropdown conf-seleccion">
                    <button class ="dropdown conf" type="button" id="conf" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Configuración"><i class="fa fa-cog"></i>
                    </button>
					
                    <div class="dropdown-menu selec" aria-labelledby="conf">
                    <button class="seleccion" name="ver" value="<?php echo $id; ?>" data-toggle="tooltip" data-placement="top" title="Coordinacion">
                        <i class=" fa fa-wpforms"></i>
                        Ver modelo
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
	public function listarmodelo(){
		$sentenciaSQL = "SELECT model,id from modelo";
		$stm =$this->conexion->prepare($sentenciaSQL);
		$result = $stm->execute();
		if ($result) {
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
					$modelo =$row["model"];
					$id     =$row["id"];
				echo '<OPTION value='.$id.'>'.$modelo.'</OPTION>';
			}
		}
		
	}
	function Verificar($nombre){

		$result = false;
		$this->conexion->beginTransaction();

		$sql = "SELECT * FROM modelo where model = :nombre";

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

		$sql = "INSERT INTO modelo (model) values(:nombre)";

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
		$sql = "DELETE FROM Modelo where id =:id";

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
			$sql = "select * from Modelo where id =:id";
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
			$sql = "UPDATE Modelo SET model = :nombre where id =:id";
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
	function capturarmodel($id){
		try {
			$this->conexion->beginTransaction();

			$sql = "SELECT model from modelo where id =:id";
			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':id',$id,PDO::PARAM_INT);

			$result = $stm->execute();

			if($result){
				$this->conexion->commit();

				$fila = $stm->fetch(PDO::FETCH_ASSOC);
				return $fila['model'];
			}else{
				$this->conexion->rollBack();
			}
		} catch (PDOException $e) {
			
		}
	}
 } ?>