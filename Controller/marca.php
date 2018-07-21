<?php
session_start();
require_once('autoload.php');
$Marca = new Marca();

if (isset($_REQUEST['nuevo'])) {
	unset($_SESSION['nombre']);
	unset($_SESSION['id']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../vista/sirfei.php?token=marca');
}

if (isset($_REQUEST['ver'])) {
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	$id  = $_POST['ver'];

	$result = $Marca->capturardatos($id);
		$id     = $result['id'];
		$nombre = $result['nombre'];
		$_SESSION['nombre'] = $nombre;
		$_SESSION['id']     = $id;
	header('location: ../Vista/sirfei.php?token=marca');
}
if (isset($_REQUEST['grabar'])) {
	// si es para modificar consulto si existe el id... 
	
	if (isset($_SESSION['id'])) {
		$nombre    = $_POST['nombre'];
		$result = $Marca->Verificar($nombre);
		if(!$result){
			$modificacion = $Marca->modificar($nombre,$_SESSION['id']);
			if ($modificacion) {
				$_SESSION['id']          = $_SESSION['id'];
				$_SESSION['nombre']      = $_POST['nombre'];
				$_SESSION['modif-exito']   = true;
				header('location: ../Vista/sirfei.php?token=marca');
			}else{
				$_SESSION['modif-exito']   = false;
				header('location: ../Vista/sirfei.php?token=marca');
			}
		}else{
			$_SESSION['existe'] = true;
				header('location: ../Vista/sirfei.php?token=marca');
		}
		
	
	}else{
		$nombre = $_POST['nombre'];
		$verificar = $Marca->verificar($nombre);
		if ($verificar) {
			$_SESSION['existe']      = true;
			$_SESSION['nombre']      = $_POST['nombre'];
			header('location: ../Vista/sirfei.php?token=marca');
		}else{
			$registro = $Marca->registrar($nombre);
			if ($registro) {
				// echo "si registro...";
				$_SESSION['nombre']          = $_POST['nombre'];
				$_SESSION['save-exito']      = true;
				header('location: ../Vista/sirfei.php?token=marca');
			}else{
				// echo "no registro";
				$_SESSION['nombre']      = $_POST['nombre'];
				$_SESSION['save-exito']      = false;
				header('location: ../Vista/sirfei.php?token=marca');
			}
		}
	}
}

if (isset($_REQUEST['eliminar'])) {
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);

	if (isset($_SESSION['id'])) {
		$eliminacion = $Marca->eliminar($_SESSION['id']);
	}else{
		// echo  $_POST['eliminar'];
		$eliminacion = $Marca->eliminar($_POST['eliminar']);
	}
	if ($eliminacion == true) {
		$_SESSION['eliminacion'] = true;
		unset($_SESSION['id']);
		header('location: ../Vista/sirfei.php?token=cat-marca');
	}else{
		$_SESSION['eliminacion']     = false;
		unset($_SESSION['id']);
	   header('location: ../Vista/sirfei.php?token=marca');
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
