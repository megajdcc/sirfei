<?php
session_start();
require_once('autoload.php');
$Trabajador = new Trabajador();

if (isset($_REQUEST['nuevo'])) {
	unset($_SESSION['cedula']);
	unset($_SESSION['identificador']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../vista/sirfei.php?token=trabajador');
}
if (isset($_REQUEST['ver'])) {
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	$identificador  = $_POST['ver'];

	$result = $Trabajador->capturardatos($identificador);
			$_SESSION['cedula']    = $result['cedula'];
			$_SESSION['nombre']    = $result['nombre'];
			$_SESSION['apellido']    = $result['apellido'];
			$_SESSION['idtipoperson']    = $result['idtipoperson'];
			$_SESSION['tipopersona']    = $result['tipopersona'];
			$_SESSION['identificador']    = $result['identificador'];
			$_SESSION['idcargo']    = $result['idcargo'];
			$_SESSION['cargo']    = $result['cargo'];
			$_SESSION['iddepartamento']    = $result['iddepartamento'];
			$_SESSION['departamento']    = $result['departamento'];
			$_SESSION['equipo']    = $result['equipo'];

	header('location: ../Vista/sirfei.php?token=trabajador');
}
if (isset($_REQUEST['grabar'])) {
	// si es para modificar consulto si existe el id... 
	
	if (isset($_SESSION['cedula'])) {
		$cedula         = $_SESSION['cedula'];
		$nombre         = $_POST['nombre'];
		$apellido       = $_POST['apellido'];
		$tipopersona    = $_POST['tipopersona'];
		$identificacion = $_SESSION['identificacion'];
		$cargo          = $_POST['cargo'];
		$departamento   = $_POST['departamento'];
		$equipo         = $_POST['equipo'];

		$modificacion = $Trabajador->modificart($cedula,$nombre,$apellido,$tipopersona, $identificacion, $cargo, $departamento, $equipo);
		if ($modificacion) {
			$_SESSION['cedula']   = $_SESSION['cedula'];
			$_SESSION['nombre']   = $_POST['nombre'];
			$_SESSION['apellido'] = $_POST['apellido'];


			$_SESSION['idtipopersona'] = $_POST['tipopersona'];

			$TipoPersona = new TipoPersona();
			$_SESSION['tipopersona'] = $TipoPersona->capturarNombre($_SESSION['idtipopersona']);

			$_SESSION['identificacion']      = $_SESSION['identificacion'];

			$_SESSION['idcargo'] = $_POST['cargo'];
			$Cargo = new Cargo();
			$_SESSION['cargo'] = $Cargo->capturarNombre($_SESSION['idcargo']);

			$_SESSION['equipo'] = $_POST['equipo'];
			$_SESSION['modif-exito']   = true;
			header('location: ../Vista/sirfei.php?token=trabajador');
		}else{
			$_SESSION['modif-exito']   = false;
			header('location: ../Vista/sirfei.php?token=trabajador');
		}
	
	}else{
		$cedula         = $_POST['cedula'];
		$nombre         = $_POST['nombre'];
		$apellido       = $_POST['apellido'];
		$tipopersona    = $_POST['tipopersona'];
		$identificacion = $_POST['identificacion'];
		$cargo          = $_POST['cargo'];
		$departamento   = $_POST['departamento'];
		$equipo         = $_POST['equipo'];
		
		$verificar = $Trabajador->verificar($cedula,$identificacion);
		echo $verificar;
		if ($verificar) {
			$_SESSION['existe']   = true;
			$_SESSION['cedula']   = $_POST['cedula'];
			$_SESSION['nombre']   = $_POST['nombre'];
			$_SESSION['apellido'] = $_POST['apellido'];


			$_SESSION['idtipopersona'] = $_POST['tipopersona'];

			$TipoPersona = new TipoPersona();
			$_SESSION['tipopersona'] = $TipoPersona->capturarNombre($_SESSION['idtipopersona']);

			$_SESSION['identificacion']      = $_POST['identificacion'];

			$_SESSION['idcargo'] = $_POST['cargo'];
			$Cargo = new Cargo();
			$_SESSION['cargo'] = $Cargo->capturarNombre($_SESSION['idcargo']);

			$_SESSION['equipo'] = $_POST['equipo'];
			
			header('location: ../Vista/sirfei.php?token=trabajador');
		}else{
			$registro = $Trabajador->registrart($cedula,$nombre,$apellido,$tipopersona, $identificacion, $cargo, $departamento, $equipo);

			if ($registro) {
				// echo "si registro...";
				$_SESSION['nombre']          = $_POST['nombre'];
				$_SESSION['save-exito']      = true;
				header('location: ../Vista/sirfei.php?token=trabajador');
			}else{
				// echo "no registro";
				$_SESSION['nombre']      = $_POST['nombre'];
				$_SESSION['save-exito']      = false;
				header('location: ../Vista/sirfei.php?token=trabajador');
			}
		}
	}
}

if (isset($_REQUEST['eliminar'])) {
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);

	if (isset($_SESSION['cedula'])) {
		$eliminacion = $Trabajador->eliminart($_SESSION['cedula']);
	}else{
		// echo  $_POST['eliminar'];
		$eliminacion = $Trabajador->eliminart($_POST['eliminar']);

	}
	if ($eliminacion) {
		$_SESSION['eliminacion'] = true;
		unset($_SESSION['identificacion']);
		header('location: ../Vista/sirfei.php?token=cat-trabajador');
	}else{
		$_SESSION['eliminacion']     = false;
		unset($_SESSION['identificacion']);
	   header('location: ../Vista/sirfei.php?token=trabajador');
	}
	}

if (isset($_REQUEST['salir'])) {
	unset($_SESSION['nombre']);
	unset($_SESSION['descripcion']);
	unset($_SESSION['identificacion']);
	unset($_SESSION['cedula']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../Vista/sirfei.php');
}
 ?>
