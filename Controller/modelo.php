<?php
session_start();
require_once('autoload.php');
$Modelo = new Modelo();

if (isset($_REQUEST['nuevo'])) {
	unset($_SESSION['nombre']);
	unset($_SESSION['id']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../vista/sirfei.php?token=modelo');
}

if (isset($_REQUEST['ver'])) {
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	$id  = $_POST['ver'];

	$result = $Modelo->capturardatos($id);
		$id     = $result['id'];
		$nombre = $result['model'];
		$_SESSION['nombre'] = $nombre;
		$_SESSION['id']     = $id;
header('location: ../Vista/sirfei.php?token=modelo');
}
if (isset($_REQUEST['grabar'])) {
	// si es para modificar consulto si existe el id... 
	
	if (isset($_SESSION['id'])) {
		$nombre    = $_POST['nombre'];
		$result = $Modelo->Verificar($nombre);
		echo $result;
		if(!$result){
			$modificacion = $Modelo->modificar($nombre,$_SESSION['id']);
			if ($modificacion) {
				$_SESSION['id']          = $_SESSION['id'];
				$_SESSION['nombre']      = $_POST['nombre'];
				$_SESSION['modif-exito']   = true;
				header('location: ../Vista/sirfei.php?token=modelo');
			}else{
				$_SESSION['modif-exito']   = false;
				header('location: ../Vista/sirfei.php?token=modelo');
			}
		}else{
			$_SESSION['existe'] = true;
				header('location: ../Vista/sirfei.php?token=modelo');
		}
		
	
	}else{
		$nombre = $_POST['nombre'];
		$verificar = $Modelo->verificar($nombre);
		if ($verificar) {
			$_SESSION['existe']      = true;
			$_SESSION['nombre']      = $_POST['nombre'];
			header('location: ../Vista/sirfei.php?token=modelo');
		}else{
			$registro = $Modelo->registrar($nombre);
			if ($registro) {
				// echo "si registro...";
				$_SESSION['nombre']          = $_POST['nombre'];
				$_SESSION['save-exito']      = true;
				header('location: ../Vista/sirfei.php?token=modelo');
			}else{
				// echo "no registro";
				$_SESSION['nombre']      = $_POST['nombre'];
				$_SESSION['save-exito']      = false;
				header('location: ../Vista/sirfei.php?token=modelo');
			}
		}
	}
}

if (isset($_REQUEST['eliminar'])) {
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);

	if (isset($_SESSION['id'])) {
		$eliminacion = $Modelo->eliminar($_SESSION['id']);
	}else{
		// echo  $_POST['eliminar'];
		$eliminacion = $Modelo->eliminar($_POST['eliminar']);
	}
	if ($eliminacion == true) {
		$_SESSION['eliminacion'] = true;
		unset($_SESSION['id']);
		header('location: ../Vista/sirfei.php?token=cat-modelo');
	}else{
		$_SESSION['eliminacion']     = false;
		unset($_SESSION['id']);
	   header('location: ../Vista/sirfei.php?token=modelo');
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
