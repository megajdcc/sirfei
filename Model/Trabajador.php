<?php

require_once 'autoload.php';

/**
 * @author Pablo... 
 */
class Trabajador extends Persona{
	
	public $identificador,$cedulaperson,$cargo,$departamento,$equipo;
	private $conexion;

	public function listarcatalago(){

		$this->conexion->beginTransaction();
		$sentenciaSQL = "SELECT 
		p.cedula,
		p.nombre,
		p.apellido,
		tp.nombre as tipopersona,
		t.identificador ,
		t.id
		from persona as p 	join tipopersona as tp on p.idtipoperson = tp.id 
			 				join trabajador as t on p.cedula = t.cedulaperson";

		$result = $this->conexion->prepare($sentenciaSQL);
		$result->execute();
		$this->conexion->commit();
		while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {

			$cedula   = $fila['cedula'];
			$nombre   = $fila['nombre'];
			$apellido   = $fila['apellido'];
			$tipopersona   = $fila['tipopersona'];
			$identificacion   = $fila['identificador'];
			
			$id = $fila['id'];
			?>
			<tr id="fila-<?php echo $cedula; ?>">
				<td><?php  echo $cedula;?></td>
				<td><?php  echo $nombre;?></td>
				<td><?php  echo $apellido;?></td>
				<td><?php  echo $tipopersona;?></td>
				<td><?php  echo $identificacion;?></td>
                <td>
					<div class="dropdown conf-seleccion">
                    <button class ="dropdown conf" type="button" id="conf" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Configuración"><i class="fa fa-cog"></i>
                    </button>
					
                    <div class="dropdown-menu selec" aria-labelledby="conf">
                    <button class="seleccion" name="ver" value="<?php echo  $identificacion; ?>" data-toggle="tooltip" data-placement="top" title="Coordinacion">
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

	function Verificar($identificacion,$cedula){

		$result = false;
		$this->conexion->beginTransaction();

		$sql = "SELECT * FROM trabajador  as t
				join persona as p on t.cedulaperson = p.cedula
		where identificador = :identificador or p.cedula = :cedula";

		$stm = $this->conexion->prepare($sql);
		$stm->bindParam(':identificador',$identificacion, PDO::PARAM_STR);
		$stm->bindParam(':cedula',$cedula, PDO::PARAM_INT);
		$result = $stm->execute();

		if($result){
			$this->conexion->commit();
			$result = $stm->fetch();
		} 
		return $result;
	}

	function registrart($cedula,$nombre,$apellido,$tipopersona,$identificador, $cargo,$departamento,$equipo){
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

				$sql = "INSERT INTO trabajador(identificador,cedulaperson,cargo,departamento,equipo)
							values(:identificador,:cedula,:cargo,:departamento,:equipo)";
				$stm1 = $this->conexion->prepare($sql);

				$stm1->bindParam(':identificador', $identificador,PDO::PARAM_STR);
				$stm1->bindParam(':cedula', $cedula,PDO::PARAM_INT);
				$stm1->bindParam(':cargo', $cargo,PDO::PARAM_INT);
				$stm1->bindParam(':departamento', $departamento,PDO::PARAM_INT);
				$stm1->bindParam(':equipo', $equipo,PDO::PARAM_INT);

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
	function modificart($cedula,$nombre,$apellido,$tipopersona,$identificador, $cargo,$departamento,$equipo){
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

				$sql = "UPDATE trabajador set cedulaperson = :cedula,cargo = :cargo,departamento = :departamento, 
				equipo =:equipo where identificador = :identificador";
				$stm1 = $this->conexion->prepare($sql);

				$stm1->bindParam(':identificador', $identificador,PDO::PARAM_STR);
				$stm1->bindParam(':cedula', $cedula,PDO::PARAM_INT);
				$stm1->bindParam(':cargo', $cargo,PDO::PARAM_INT);
				$stm1->bindParam(':departamento', $departamento,PDO::PARAM_INT);
				$stm1->bindParam(':equipo', $equipo,PDO::PARAM_INT);

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

	function capturardatos($identificador){
		try {
			$this->conexion->beginTransaction();
			$sql = "select p.cedula,
			p.nombre,
			p.apellido,
			p.idtipoperson as idtipoperson,
			tp.nombre as tipopersona,
			t.identificador,
			t.cargo as idcargo,
			t.departamento as iddepartamento,
			t.equipo as equipo,
			c.nombre as cargo, 
			d.nombre as departamento
			from persona as p 
				join tipopersona as tp on p.idtipoperson = tp.id 
				join trabajador as t on p.cedula = t.cedulaperson
				join cargo as c on t.cargo = c.id
				join departamento as d on t.departamento = d.id
				where t.identificador =:identificador";
			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':identificador',$identificador,PDO::PARAM_STR);
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
			$sql = "DELETE FROM trabajador where cedulaperson = :cedula";

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
	public function listatrabajador(){
		$sentenciaSQL = "SELECT CONCAT(p.nombre,' ',p.apellido) as nombre, t.id as idtrabajador FROM persona as p 
		join	trabajador as t on p.cedula = t.cedulaperson";
		$stm =$this->conexion->prepare($sentenciaSQL);
		$result = $stm->execute();
		if ($result) {
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
					$nombre =$row["nombre"];
					$idtrabajador     =$row["idtrabajador"];
				echo '<OPTION value='.$idtrabajador.'>'.$nombre.'</OPTION>';
			}
		}
		
	}
	function __construct(){

		$this->conexion = new Conexion();
	}
}

 ?>