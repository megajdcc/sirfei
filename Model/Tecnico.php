<?php

require_once 'autoload.php';

/**
 * @author Pablo... 
 */
class Tecnico extends Persona{
	
	public $formacion,$personcedul;
	private $conexion;

	public function listarcatalago(){

		$this->conexion->beginTransaction();
		$sentenciaSQL = "SELECT 
		p.cedula,
		p.nombre,
		p.apellido,
		tp.nombre as tipopersona
		from persona as p 	join tipopersona as tp on p.idtipoperson = tp.id 
			 				join tecnico as t on p.cedula = t.personacedul";

		$result = $this->conexion->prepare($sentenciaSQL);
		$result->execute();
		$this->conexion->commit();
		while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {

			$cedula      = $fila['cedula'];
			$nombre      = $fila['nombre'];
			$apellido    = $fila['apellido'];
			$tipopersona = $fila['tipopersona'];

			?>
			<tr id="fila-<?php echo $cedula; ?>">
				<td><?php  echo $cedula;?></td>
				<td><?php  echo $nombre;?></td>
				<td><?php  echo $apellido;?></td>
				<td><?php  echo $tipopersona;?></td>
                <td>
					<div class="dropdown conf-seleccion">
                    <button class ="dropdown conf" type="button" id="conf" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Configuración"><i class="fa fa-cog"></i>
                    </button>
					
                    <div class="dropdown-menu selec" aria-labelledby="conf">
                    <button class="seleccion" name="ver" value="<?php echo  $cedula; ?>" data-toggle="tooltip" data-placement="top" title="Coordinacion">
                        <i class=" fa fa-wpforms"></i>
                        Ver
                    </button>
                    <button class="seleccion" name="eliminar" value="<?php echo  $cedula; ?>" data-toggle="tooltip" data-placement="top" title="Recuerde estar seguro antes de eliminar">
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

	function Verificar($cedula){

		$result = false;
		$this->conexion->beginTransaction();

		$sql = "SELECT * FROM tecnico  as t
				join persona as p on t.personacedul = p.cedula
		where t.personacedul = :cedula ";

		$stm = $this->conexion->prepare($sql);
		$stm->bindParam(':cedula',$cedula, PDO::PARAM_INT);
		$result = $stm->execute();

		if($result){
			$this->conexion->commit();
			$result = $stm->fetch();
		} 
		return $result;
	}

	function registrart($cedula,$nombre,$apellido,$tipopersona,$formacion){
		$result = false;

		try {
			$this->conexion->beginTransaction();
			$sql = "INSERT INTO persona(cedula,nombre,apellido,idtipoperson)
						values(:cedula,:nombre,:apellido,:tipopersona)";

			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':cedula',$cedula,PDO::PARAM_INT);
			$stm->bindParam(':nombre',$nombre,PDO::PARAM_STR);
			$stm->bindParam(':apellido',$apellido,PDO::PARAM_STR);
			$stm->bindParam(':tipopersona',$tipopersona,PDO::PARAM_INT);

			$result = $stm->execute();

			if($result){

				$sql = "INSERT INTO tecnico(formacion,personacedul)
							values(:formacion,:cedula)";
				$stm1 = $this->conexion->prepare($sql);

				$stm1->bindParam(':formacion', $formacion,PDO::PARAM_STR);
				$stm1->bindParam(':cedula', $cedula,PDO::PARAM_INT);
				

				$result = $stm1->execute();
				if($result){
					$this->conexion->commit();
				}else{
					$this->conexion->rollBack();
				}
			}else{
				$this->conexion->rollBack();
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			if($tran = $this->conexion->inTransaction()){
				$this->conexion->rollBack();
			}
		
		}
		return $result;
	}
	function modificart($cedula,$nombre,$apellido,$tipopersona,$formacion){
		$result = false;

		try {
			$this->conexion->beginTransaction();
			$sql = "UPDATE persona set nombre = :nombre,apellido = :apellido,idtipoperson = :tipopersona where cedula =:cedula";
			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':cedula',$cedula,PDO::PARAM_INT);
			$stm->bindParam(':nombre',$nombre,PDO::PARAM_STR);
			$stm->bindParam(':apellido',$apellido,PDO::PARAM_STR);
			$stm->bindParam(':tipopersona',$tipopersona,PDO::PARAM_INT);

			$result = $stm->execute();

			if($result){

				$sql = "UPDATE tecnico set formacion = :formacion
				where personacedul = :cedula";
				$stm1 = $this->conexion->prepare($sql);

				$stm1->bindParam(':formacion', $formacion,PDO::PARAM_STR);
				$stm1->bindParam(':cedula', $cedula,PDO::PARAM_INT);
				

				$result = $stm1->execute();
				if($result){
					$this->conexion->commit();
				}else{
					$this->conexion->rollBack();
				}
			}else{
				$this->conexion->rollBack();
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			if($tran = $this->conexion->inTransaction()){
				$this->conexion->rollBack();
			}
		
		}
		return $result;
	}

	function capturardatos($cedula){
		try {
			$this->conexion->beginTransaction();
			$sql = "select p.cedula,
			p.nombre,
			p.apellido,
			p.idtipoperson as idtipoperson,
			tp.nombre as tipopersona,
			t.formacion		
			from persona as p 
				join tipopersona as tp on p.idtipoperson = tp.id 
				join tecnico as t on p.cedula = t.personacedul
				where t.personacedul =:cedula";
			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':cedula',$cedula,PDO::PARAM_STR);
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
	function eliminart($cedula){
		$result = false;
		try {
			$this->conexion->beginTransaction();
			$sql = "DELETE FROM tecnico where personacedul = :cedula";

			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':cedula',$cedula,PDO::PARAM_INT);
			$result = $stm->execute();
			// echo $result;
			if($result){
				$sql = "DELETE FROM persona where cedula =:cedula";
				$stm = $this->conexion->prepare($sql);
				$stm->bindParam(':cedula',$cedula,PDO::PARAM_INT);
				$result = $stm->execute();
				if($result){
					$this->conexion->commit();
				}else{
					$this->conexion->rollBack();
				}
				
			}else{
				$this->conexion->rollBack();
			}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
		return $result;	
	}

	function listartecnico(){

		$sql = "SELECT concat(p.nombre, ' ', p.apellido) as nombre, t.id from persona as p
							join tecnico as t on p.cedula = t.personacedul";
		$stm = $this->conexion->prepare($sql);
		 $result = $stm->execute();

		if($result){
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
					$nombre =$row["nombre"];
					$id     =$row["id"];
				echo '<OPTION value='.$id.'>'.$nombre.'</OPTION>';
			}
		}
	}
	function __construct(){

		$this->conexion = new Conexion();
	}
}

 ?>