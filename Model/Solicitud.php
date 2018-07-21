<?php

require_once 'autoload.php';

/**
 * @author Pablo... 
 */
class Solicitud{
	
	public $nro,$fecha,$hora,$descripcion,$trabajador;

	private $conexion;

	public function listarcatalago(){

		$this->conexion->beginTransaction();
		$sentenciaSQL = "SELECT 
		s.nrosolicitud as solicitud,
		s.fecha,
		s.hora,
		concat(p.nombre,' ',p.apellido) as trabajador
		from persona as p 	join trabajador as t on p.cedula = t.cedulaperson 
			 				join solicitud as s on t.id = s.trabajador
			 				where s.asignada = 0";

		$result = $this->conexion->prepare($sentenciaSQL);
		$result->execute();
		$this->conexion->commit();
		while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {

			$solicitud = $fila['solicitud'];
			$fecha     = $fila['fecha'];
			$hora      = $fila['hora'];
			$trabajador = $fila['trabajador'];

			?>
			<tr id="fila-<?php echo $solicitud; ?>">
				<td><?php  echo $solicitud;?></td>
				<td><?php  echo $fecha;?></td>
				<td><?php  echo $hora;?></td>
				<td><?php  echo $trabajador;?></td>
                <td>
					<div class="dropdown conf-seleccion">
                    <button class ="dropdown conf" type="button" id="conf" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Configuración"><i class="fa fa-cog"></i>
                    </button>
					
                    <div class="dropdown-menu selec" aria-labelledby="conf">
                    <button class="seleccion" name="ver" value="<?php echo  $solicitud; ?>" data-toggle="tooltip" data-placement="top" title="Solicitud">
                        <i class=" fa fa-wpforms"></i>
                        Ver
                    </button>
                     
                    <button class="seleccion" name="eliminar" value="<?php echo  $solicitud; ?>" data-toggle="tooltip" data-placement="top" title="Recuerde estar seguro antes de eliminar">
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

	function registrar($nrosolicitud,$fecha,$hora,$descripcion,$trabajador){
		$result = false;


		try {
			$this->conexion->beginTransaction();
			$sql = "INSERT INTO solicitud(fecha,hora,descripcion,trabajador)
						values(:fecha,:hora,:descripcion,:trabajador)";

			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':fecha',$fecha,PDO::PARAM_STR);
			$stm->bindParam(':hora',$hora,PDO::PARAM_STR);
			$stm->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
			$stm->bindParam(':trabajador',$trabajador,PDO::PARAM_INT);

			$result = $stm->execute();
			// echo $result;
			if($result){
				$this->conexion->commit();
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

	function capturardatos($solicitud){
		try {
			$this->conexion->beginTransaction();
			$sql = "select s.nrosolicitud, s.fecha,s.hora,s.descripcion,s.trabajador, 
			concat(p.nombre,' ', p.apellido) as trabajador, t.id 
			from persona as p join trabajador as t on p.cedula = t.cedulaperson
			join solicitud as s on t.id = s.trabajador
				where s.nrosolicitud = :solicitud";
			$stm = $this->conexion->prepare($sql);
			$stm->bindParam(':solicitud',$solicitud,PDO::PARAM_STR);
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

	function nrosolicitud(){

		$sql = "SELECT max(nrosolicitud) as nro from solicitud";
		$stm = $this->conexion->prepare($sql);

		$result = $stm->execute();

		if($result){

			$fil = $stm->fetch(PDO::FETCH_ASSOC);
			$nro = $fil['nro'];

			$nro +=1;

		}

		return $nro;

	}
	public function sinasignar(){
		$sentenciaSQL = "SELECT s.nrosolicitud, s.fecha from solicitud as s 
						 WHERE s.asignada =0 order by s.fecha asc";
		$stm = $this->conexion->prepare($sentenciaSQL);
		$result = $stm->execute();
		if($result){
			$result = $stm->fetchAll();
		}
		return $result;
	}
	function asignarsolicitudes($solicitud,$tecnico,$observacion = null){
		if($this->conexion->inTransaction()){
			$this->conexion->rollBack();
		}

		$result = false;
		try {
			$this->conexion->beginTransaction();
			$sql = "INSERT INTO tecnicodesolicitud(idsolicitud,idtecnico,observacion)
					values(:solicitud,:tecnico,:observacion)";

			$stm             = $this->conexion->prepare($sql);
			$stm->bindParam(':solicitud', $solicitud, PDO::PARAM_INT);
			$stm->bindParam(':tecnico', $tecnico, PDO::PARAM_INT);
			$stm->bindParam(':observacion', $observacion, PDO::PARAM_STR);

			$result = $stm->execute();
			if($result){
				$sql = "UPDATE solicitud set asignada = 1 where nrosolicitud = :solicitud";
				$stm = $this->conexion->prepare($sql);
				$stm->bindParam(':solicitud',$solicitud, PDO::PARAM_INT);
				$result = $stm->execute();
				if($result){
					$this->conexion->commit();
				}else{
					$this->conexion->rollBack();
				}	
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
		return $result;
	}
	function __construct(){

		$this->conexion = new Conexion();
	}
}

 ?>