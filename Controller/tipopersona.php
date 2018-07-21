<?php
session_start();
require_once('autoload.php');
$TipoPersona = new TipoPersona();

if (isset($_REQUEST['nuevo'])) {
	unset($_SESSION['nombre']);
	unset($_SESSION['descripcion']);
	unset($_SESSION['id']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../vista/sirfei.php?token=tipopersona');
}

if (isset($_REQUEST['ver'])) {
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	$id  = $_POST['ver'];

	$result = $TipoPersona->capturardatos($id);
		$id          = $result['id'];
		$nombre      = $result['nombre'];
		$descripcion = $result['descripcion'];
		$_SESSION['nombre']      = $nombre;
		$_SESSION['descripcion'] = $descripcion;
		$_SESSION['id']          = $id;
	header('location: ../Vista/sirfei.php?token=tipopersona');
}
if (isset($_REQUEST['grabar'])) {
	// si es para modificar consulto si existe el id... 
	
	if (isset($_SESSION['id'])) {
		$nombre    = $_POST['nombre'];
		$descripcion    = $_POST['descripcion'];
		$result = $TipoPersona->Verificar($nombre);
		if(!$result){
			$modificacion = $TipoPersona->modificar($nombre,$_SESSION['id']);
			if ($modificacion) {
				$_SESSION['id']          = $_SESSION['id'];
				$_SESSION['nombre']      = $_POST['nombre'];
				$_SESSION['descripcion'] = $_POST['descripcion'];
				$_SESSION['modif-exito']   = true;
				header('location: ../Vista/sirfei.php?token=tipopersona');
			}else{
				$_SESSION['modif-exito']   = false;
				header('location: ../Vista/sirfei.php?token=tipopersona');
			}
		}else{
			$_SESSION['existe'] = true;
				header('location: ../Vista/sirfei.php?token=tipopersona');
		}
	}else{
		$nombre      = $_POST['nombre'];
		$descripcion = $_POST['descripcion'];
		$verificar = $TipoPersona->verificar($nombre);
		if ($verificar) {
			$_SESSION['existe']      = true;
			$_SESSION['nombre']      = $_POST['nombre'];
			$_SESSION['descripcion'] = $_POST['descripcion'];
			header('location: ../Vista/sirfei.php?token=tipopersona');
		}else{
			$registro = $TipoPersona->registrar($nombre);
			if ($registro) {
				// echo "si registro...";
				$_SESSION['nombre']      = $_POST['nombre'];
				$_SESSION['descripcion'] = $_POST['descripcion'];
				$_SESSION['save-exito']  = true;
				header('location: ../Vista/sirfei.php?token=tipopersona');
			}else{
				// echo "no registro";
				$_SESSION['nombre']      = $_POST['nombre'];
				$_SESSION['descripcion'] = $_POST['descripcion'];
				$_SESSION['save-exito']      = false;
				header('location: ../Vista/sirfei.php?token=tipopersona');
			}
		}
	}
}

if (isset($_REQUEST['eliminar'])) {
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);

	if (isset($_SESSION['id'])) {
		$eliminacion = $TipoPersona->eliminar($_SESSION['id']);
	}else{
		// echo  $_POST['eliminar'];
		$eliminacion = $TipoPersona->eliminar($_POST['eliminar']);
	}
	if ($eliminacion == true) {
		$_SESSION['eliminacion'] = true;
		unset($_SESSION['id']);
		header('location: ../Vista/sirfei.php?token=cat-tipopersona');
	}else{
		$_SESSION['eliminacion'] = false;
		unset($_SESSION['id']);
	   header('location: ../Vista/sirfei.php?token=tipopersona');
	}
	}

if (isset($_REQUEST['salir'])) {
	unset($_SESSION['nombre']);
	unset($_SESSION['id']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../Vista/sirfei.php');
}
 ?>
