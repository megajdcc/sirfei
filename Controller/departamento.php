<?php
session_start();
require_once('autoload.php');
$Departamento = new Departamento();

if (isset($_REQUEST['nuevo'])) {
	unset($_SESSION['nombre']);
	unset($_SESSION['id']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../Vista/sirfei.php?token=departamento');
}
if (isset($_REQUEST['ver'])) {
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	$id  = $_POST['ver'];

	$result = $Departamento->capturardatos($id);
			$id             = $result['id'];
			$nombre         = $result['nombre'];
			$coordinacion   = $result['coordinacion'];
			$idcoordinacion = $result['idcoordinacion'];
			$_SESSION['nombre'] = $nombre;
			$_SESSION['id']     = $id;
			$_SESSION['coordinacion'] = $coordinacion;
			$_SESSION['idcoordinacion']     = $idcoordinacion;

	header('location: ../Vista/sirfei.php?token=departamento');
}
if (isset($_REQUEST['grabar'])) {
	// si es para modificar consulto si existe el id... 
	
	if (isset($_SESSION['id'])) {
		$nombre    = $_POST['nombre'];
		$idcoordinacion = $_POST['coordinacion'];
		$modificacion = $Departamento->modificar($nombre,$idcoordinacion,$_SESSION['id']);
		if ($modificacion) {
			$_SESSION['id']          = $_SESSION['id'];
			$_SESSION['nombre']      = $_POST['nombre'];
			$_SESSION['modif-exito']   = true;
			header('location: ../Vista/sirfei.php?token=departamento');
		}else{
			$_SESSION['modif-exito']   = false;
			header('location: ../Vista/sirfei.php?token=departamento');
		}
	
	}else{
		$nombre      = $_POST['nombre'];
		$coordinacion = $_POST['coordinacion'];


		$verificar = $Departamento->verificar($nombre, $coordinacion);
		if ($verificar) {
			$_SESSION['existe']      = true;
			$_SESSION['nombre']      = $_POST['nombre'];
			
			header('location: ../Vista/sirfei.php?token=departamento');
		}else{
			$registro = $Departamento->registrar($nombre,$coordinacion);
			if ($registro) {
				// echo "si registro...";
				$_SESSION['nombre']          = $_POST['nombre'];
				$_SESSION['save-exito']      = true;
				header('location: ../Vista/sirfei.php?token=departamento');
			}else{
				// echo "no registro";
				$_SESSION['nombre']      = $_POST['nombre'];
				$_SESSION['save-exito']      = false;
				header('location: ../Vista/sirfei.php?token=departamento');
			}
		}
	}
}

if (isset($_REQUEST['eliminar'])) {
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);

	if (isset($_SESSION['id'])) {
		$eliminacion = $Departamento->eliminar($_SESSION['id']);
	}else{
		// echo  $_POST['eliminar'];
		$eliminacion = $Departamento->eliminar($_POST['eliminar']);
	}
	if ($eliminacion == true) {
		$_SESSION['eliminacion'] = true;
		unset($_SESSION['id']);
		header('location: ../Vista/sirfei.php?token=cat-departamento');
	}else{
		$_SESSION['eliminacion']     = false;
		unset($_SESSION['id']);
	   header('location: ../Vista/sirfei.php?token=departamento');
	}
	}

if (isset($_REQUEST['salir'])) {
	unset($_SESSION['nombre']);
	unset($_SESSION['coordinacion']);
	unset($_SESSION['id']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../Vista/sirfei.php');
}
 ?>
