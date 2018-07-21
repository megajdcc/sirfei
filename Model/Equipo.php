<?php 
	require_once 'autoload.php';


/**
 * @author Pablo Bastardo
 */
class Equipo{
	
	private $conexion;
	public $numero,$serial,$tipo,$model,$marca;
	
	function __construct(){
		$this->conexion = new Conexion();
	}

	function ListarCatalogo(){

		$this->conexion->beginTransaction();
		$sentenciaSQL = "SELECT e.numero,
						e.serial,
						t.nombre as tipoequipo,
						m.model,
						ma.nombre as marca
						from equipo as e join tipoequipo as t on e.tipo = t.id
										join	Modelo as m on e.model = m.id
										join	marca as ma on e.marca = ma.id";
		$result = $this->conexion->prepare($sentenciaSQL);
		$result->execute();
		$this->conexion->commit();
		while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
			$numero     = $fila['numero'];
			$serial     = $fila['serial'];
			$tipoequipo = $fila['tipoequipo'];
			$modelo      = $fila['model'];
			$marca      = $fila['marca'];
			?>
			<tr id="fila-<?php echo $numero; ?>">
				<td><?php  echo $numero;?></td>
				<td><?php  echo $serial;?></td>
				<td><?php  echo $tipoequipo;?></td>
				<td><?php  echo $modelo;?></td>
				<td><?php  echo $marca;?></td>

                <td>
					<div class="dropdown conf-seleccion">
                    <button class ="dropdown conf" type="button" id="conf" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Configuración"><i class="fa fa-cog"></i>
                    </button>
					
                    <div class="dropdown-menu selec" aria-labelledby="conf">
                    <button class="seleccion" name="ver" value="<?php echo $numero; ?>" data-toggle="tooltip" data-placement="top" title="Equipo">
                        <i class=" fa fa-wpforms"></i>
                        Ver
                    </button>
                    <button class="seleccion" name="eliminar" value="<?php echo $numero; ?>" data-toggle="tooltip" data-placement="top" title="Recuerde estar seguro antes de eliminar">
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

	function Verificar($numero,$serial){

		$result = false;
		$this->conexion->beginTransaction();

		$sql = "SELECT * FROM equipo where numero = :numero and serial = :serial ";

		$stm = $this->conexion->prepare($sql);
		$stm->bindParam(':numero', $numero,PDO::PARAM_INT);
		$stm->bindParam(':serial', $serial,PDO::PARAM_STR);
		$result = $stm->execute();

		if($result){
			$this->conexion->commit();
			$result = $stm->fetch();
		} 
		return $result;
	}
	function registrar($numero,$serial,$tipo,$modelo,$marca){
		$result = false;
		try {
			$this->conexion->beginTransaction();

			$sql = "INSERT INTO equipo (numero,serial,tipo,model,marca) values(:numero,:serial,:tipo,:modelo,:marca)";

			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':numero', $numero, PDO::PARAM_INT);
			$stm->bindParam(':serial', $serial, PDO::PARAM_STR);
			$stm->bindParam(':tipo', $tipo, PDO::PARAM_INT);
			$stm->bindParam(':modelo', $modelo, PDO::PARAM_INT);
			$stm->bindParam(':marca', $marca, PDO::PARAM_INT);
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
	function modificar($numero,$serial,$tipo,$modelo,$marca){
		try {
			$result = false;
			$this->conexion->beginTransaction();
			$sql = "UPDATE equipo SET serial = :serial, tipo = :tipo, model = :modelo, marca = :marca where numero =:numero";
			$stm = $this->conexion->prepare($sql);
			
			$stm->bindParam(':serial', $serial, PDO::PARAM_STR);
			$stm->bindParam(':tipo', $tipo, PDO::PARAM_INT);
			$stm->bindParam(':modelo', $modelo, PDO::PARAM_INT);
			$stm->bindParam(':marca', $marca, PDO::PARAM_INT);
			$stm->bindParam(':numero', $numero, PDO::PARAM_INT);
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
	function capturardatos($numero){
	
		try {
			$this->conexion->beginTransaction();
			$sql = "select e.numero,
			e.serial,
			e.tipo as idtipoequipo,
			e.model as idmodelo,
			e.marca as idmarca,
			t.nombre as tipoequipo,
			m.model as modelo,
			mar.nombre as marca 
			from equipo as e join tipoequipo as t on e.tipo = t.id 
							join Modelo as m on e.model = m.id
							join marca as mar on e.marca = mar.id 
			where e.numero =:numero";
			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':numero',$numero,PDO::PARAM_INT);
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
	function eliminar($numero){
		$result = false ;

		$this->conexion->beginTransaction();
		$sql = "DELETE FROM equipo where numero =:numero";

		$stm = $this->conexion->prepare($sql);
		$stm->bindParam(':numero',$numero, PDO::PARAM_INT);
		$result = $stm->execute();
		if($result){
			$this->conexion->commit();
		}else{
			$this->conexion->rollBack();
		}
		return $result;		
	}
	public function listar(){
		$sentenciaSQL = "SELECT numero from equipo";
		$stm =$this->conexion->prepare($sentenciaSQL);
		$result = $stm->execute();
		if ($result) {
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
					$numero =$row["numero"];
				echo '<OPTION value='.$numero.'>'.$numero.'</OPTION>';
			}
		}
		
	}

}

 ?>