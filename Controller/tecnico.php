<?php
session_start();
require_once('autoload.php');
$Tecnico = new Tecnico();

if (isset($_REQUEST['nuevo'])) {
	unset($_SESSION['cedula']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../vista/sirfei.php?token=tecnico');
}
if (isset($_REQUEST['ver'])) {
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	$cedula  = $_POST['ver'];

	$result = $Tecnico->capturardatos($cedula);
			$_SESSION['cedula']    = $result['cedula'];
			$_SESSION['nombre']    = $result['nombre'];
			$_SESSION['apellido']    = $result['apellido'];
			$_SESSION['idtipoperson']    = $result['idtipoperson'];
			$_SESSION['tipopersona']    = $result['tipopersona'];
			$_SESSION['formacion']    = $result['formacion'];

	header('location: ../Vista/sirfei.php?token=tecnico');
}
if (isset($_REQUEST['grabar'])) {
	// si es para modificar consulto si existe el id... 
	
	if (isset($_SESSION['cedula'])) {
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
		$cedula         = $_POST['cedula'];
		$nombre         = $_POST['nombre'];
		$apellido       = $_POST['apellido'];
		$tipopersona    = $_POST['tipopersona'];
		$formacion = $_POST['formacion'];
		
		
		$verificar = $Tecnico->verificar($cedula);
		if ($verificar) {
			$_SESSION['existe']   = true;
			$_SESSION['cedula']   = $_POST['cedula'];
			$_SESSION['nombre']   = $_POST['nombre'];
			$_SESSION['apellido'] = $_POST['apellido'];


			$_SESSION['idtipopersona'] = $_POST['tipopersona'];

			$TipoPersona = new TipoPersona();
			$_SESSION['tipopersona'] = $TipoPersona->capturarNombre($_SESSION['idtipopersona']);

			$_SESSION['formacion']      = $_POST['formacion'];

			
			
			header('location: ../Vista/sirfei.php?token=tecnico');
		}else{
			$registro = $Tecnico->registrart($cedula,$nombre,$apellido,$tipopersona, $formacion);

			if ($registro) {
				// echo "si registro...";
				$_SESSION['cedula']   = $_POST['cedula'];
				$_SESSION['nombre']   = $_POST['nombre'];
				$_SESSION['apellido'] = $_POST['apellido'];


				$_SESSION['idtipopersona'] = $_POST['tipopersona'];

				$TipoPersona = new TipoPersona();
				$_SESSION['tipopersona'] = $TipoPersona->capturarNombre($_SESSION['idtipopersona']);

				$_SESSION['formacion']      = $_POST['formacion'];

				$_SESSION['save-exito']      = true;
				header('location: ../Vista/sirfei.php?token=tecnico');
			}else{
				// echo "no registro";
				$_SESSION['cedula']   = $_POST['cedula'];
				$_SESSION['nombre']   = $_POST['nombre'];
				$_SESSION['apellido'] = $_POST['apellido'];


				$_SESSION['idtipopersona'] = $_POST['tipopersona'];

				$TipoPersona = new TipoPersona();
				$_SESSION['tipopersona'] = $TipoPersona->capturarNombre($_SESSION['idtipopersona']);

				$_SESSION['formacion']      = $_POST['formacion'];

				$_SESSION['save-exito']      = false;

				header('location: ../Vista/sirfei.php?token=tecnico');
			}
		}
	}
}

if (isset($_REQUEST['eliminar'])) {
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);

	if (isset($_SESSION['cedula'])) {
		$eliminacion = $Tecnico->eliminart($_SESSION['cedula']);
	}else{
		// echo  $_POST['eliminar'];
		$eliminacion = $Tecnico->eliminart($_POST['eliminar']);

	}
	if ($eliminacion) {
		$_SESSION['eliminacion'] = true;
		unset($_SESSION['cedula']);
		header('location: ../Vista/sirfei.php?token=cat-tecnico');
	}else{
		$_SESSION['eliminacion']     = false;
		unset($_SESSION['cedula']);
	   header('location: ../Vista/sirfei.php?token=tecnico');
	}
	}

if (isset($_REQUEST['salir'])) {
	unset($_SESSION['nombre']);
	unset($_SESSION['descripcion']);
	unset($_SESSION['cedula']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../Vista/sirfei.php');
}
 ?>
