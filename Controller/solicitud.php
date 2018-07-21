<?php
session_start();
require_once('autoload.php');
$Solicitud = new Solicitud();
$nrosolicitud = $Solicitud->nrosolicitud();
if (isset($_REQUEST['nuevo'])) {
	unset($_SESSION['solicitud']);
	 	unset($_SESSION['asignacion']);
	unset($_SESSION['solicitudasignada']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../vista/sirfei.php?token=solicitud');
}
if (isset($_REQUEST['ver'])) {
	unset($_SESSION['eliminacion']);
	 	unset($_SESSION['asignacion']);
	unset($_SESSION['solicitudasignada']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	$solicitud  = $_POST['ver'];

	$result = $Solicitud->capturardatos($solicitud);
			$_SESSION['solicitud']    = $result['nrosolicitud'];
			$_SESSION['trabajador']    = $result['trabajador'];
			$_SESSION['idtrabajador']    = $result['id'];
			$_SESSION['descripcion']    = $result['descripcion'];
			$_SESSION['fecha']    = $result['fecha'];
			$_SESSION['hora']    = $result['hora'];

	header('location: ../Vista/sirfei.php?token=solicitud');
}
if (isset($_REQUEST['grabar'])) {
	// si es para modificar consulto si existe el id... 
	
	if (isset($_SESSION['solicitud'])) {
		$cedula      = $_SESSION['cedula'];
		$nombre      = $_POST['nombre'];
		$apellido    = $_POST['apellido'];
		$tipopersona = $_POST['tipopersona'];
		$formacion   = $_SESSION['formacion'];


		$modificacion = $Tecnico->modificart($cedula,$nombre,$apellido,$tipopersona, $formacion);
		if ($modificacion) {
			$_SESSION['cedula']   = $_SESSION['cedula'];
			$_SESSION['nombre']   = $_POST['nombre'];
			$_SESSION['apellido'] = $_POST['apellido'];


			$_SESSION['idtipopersona'] = $_POST['tipopersona'];

			$TipoPersona = new TipoPersona();
			$_SESSION['tipopersona'] = $TipoPersona->capturarNombre($_SESSION['idtipopersona']);

			$_SESSION['formacion']      = $_SESSION['formacion'];
			$_SESSION['modif-exito']   = true;
			header('location: ../Vista/sirfei.php?token=tecnico');
		}else{
			$_SESSION['modif-exito']   = false;
			header('location: ../Vista/sirfei.php?token=tecnico');
		}
	
	}else{
		$fecha        = $_POST['fecha'];
		echo $fecha;
		$hora         = $_POST['hora'];
		$descripcion = $_POST['descripcion'];
		$trabajador   = $_POST['trabajador'];
		echo $trabajador;
		$registro = $Solicitud->registrar($nrosolicitud,$fecha,$hora,$descripcion,$trabajador);

			if ($registro) {
				header('location: ../Vista/sirfei.php?token=cat-solicitudes');
			}else{
				$_SESSION['save-exito']      = false;
				header('location: ../Vista/sirfei.php?token=cat-solicitudes');
			}
		}
	}

if (isset($_REQUEST['salir'])) {
	unset($_SESSION['solicitud']);
	 	unset($_SESSION['asignacion']);
	unset($_SESSION['solicitudasignada']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../Vista/sirfei.php');
}

if (isset($_REQUEST['asignar-tecnico'])) {
	$_SESSION['asignacion'] = true;
	unset($_SESSION['solicitud']);

	header('location: ../Vista/sirfei.php?token=solicitud');
}

if(isset($_REQUEST['asignar'])){
	$solicitud = $_POST['solicitud'];

	$tecnico = $_POST['responsable'];
	$observacion = $_POST['observacion'];
	$result = false;
	for ($i=0; $i<count($solicitud) ; $i++) { 
      			$solicitudes =  $solicitud[$i];
      			$result = $Solicitud->asignarsolicitudes($solicitudes,$tecnico,$observacion);
      		}
      if($result){
      	$_SESSION['solicitudasignada'] = true;
      	$_SESSION['asignacion'] = true;
	unset($_SESSION['solicitud']);

	header('location: ../Vista/sirfei.php?token=solicitud');
      }else{
      	unset($_SESSION['asignacion']);
      		header('location: ../Vista/sirfei.php?token=cat-solicitud');
      }

}	
 ?>
