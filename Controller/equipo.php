<?php
session_start();
require_once('autoload.php');
$Equipo = new Equipo();

if (isset($_REQUEST['nuevo'])) {
	unset($_SESSION['numero']);
	unset($_SESSION['serial']);
	unset($_SESSION['tipo']);
	unset($_SESSION['model']);
	unset($_SESSION['marca']);

	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../Vista/sirfei.php?token=equipo');
}
if (isset($_REQUEST['ver'])) {
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	$numero  = $_POST['ver'];

	$result = $Equipo->capturardatos($numero);

			$_SESSION['numero']       = $result['numero'];
			$_SESSION['serial']       = $result['serial'];
			$_SESSION['modelo']       = $result['modelo'];
			$_SESSION['marca']        = $result['marca'];
			$_SESSION['tipoequipo']   = $result['tipoequipo'];
			$_SESSION['idtipoequipo'] = $result['idtipoequipo'];
			$_SESSION['idmodelo']     = $result['idmodelo'];
			$_SESSION['idmarca']      = $result['idmarca'];	

	header('location: ../Vista/sirfei.php?token=equipo');
}
if (isset($_REQUEST['grabar'])) {
	// si es para modificar consulto si existe el id... 
	if (isset($_SESSION['numero'])) {
		
		$numero = $_SESSION['numero'];
		$serial = $_POST['serial'];
		$tipo   = $_POST['tipo'];
		$modelo = $_POST['modelo'];
		$marca  = $_POST['marca'];
		
		$verificar  =$Equipo->verificar($numero, $serial);
		if ($verificar) {
			unset($_SESSION['modif-exito']);
			$_SESSION['existe']          = true;
				$_SESSION['numero'] = $_POST['numero'];
				$_SESSION['serial'] = $_POST['serial'];
				$_SESSION['idtipoequipo']   = $_POST['tipo'];
				$TipoEquipo = new TipoEquipo();
				$_SESSION['tipo'] =  $TipoEquipo->capturarnombre($_SESSION['idtipo']);
				$_SESSION['idmodelo'] = $_POST['modelo'];
				
				$Modelo = new Modelo();
				$_SESSION['modelo'] = $Modelo->capturarmodel($_SESSION['idmodelo']);
				$_SESSION['idmarca']  = $_POST['marca'];
				$Marca = new Marca();
				$_SESSION['marca'] = $Marca->capturarnombre($_SESSION['idmarca']);
			header('location: ../Vista/sirfei.php?token=equipo');
		}else{
		unset($_SESSION['existe']);
		$modificacion = $Equipo->modificar($numero,$serial,$tipo,$modelo,$marca);
		if ($modificacion) {
				$_SESSION['numero'] = $_SESSION['numero'];
				$_SESSION['serial'] = $_POST['serial'];
				$_SESSION['idtipoequipo']   = $_POST['tipo'];
				$TipoEquipo = new TipoEquipo();
				$_SESSION['tipo'] =  $TipoEquipo->capturarnombre($_SESSION['idtipo']);
				$_SESSION['idmodelo'] = $_POST['modelo'];
				
				$Modelo = new Modelo();
				$_SESSION['modelo'] = $Modelo->capturarmodel($_SESSION['idmodelo']);
				$_SESSION['idmarca']  = $_POST['marca'];
				$Marca = new Marca();

				$_SESSION['marca'] = $Marca->capturarnombre($_SESSION['idmarca']);
			$_SESSION['modif-exito']   = true;
			header('location: ../Vista/sirfei.php?token=equipo');
		}
	}
	}else{
		$numero = $_POST['numero'];
		$serial = $_POST['serial'];
		$tipo   = $_POST['tipo'];
		$modelo = $_POST['modelo'];
		$marca  = $_POST['marca'];
		
		$verificar = $Equipo->verificar($numero,$serial);
		if ($verificar) {
			$_SESSION['existe']      = true;
				$_SESSION['numero'] = $_POST['numero'];
				$_SESSION['serial'] = $_POST['serial'];
				$_SESSION['idtipoequipo']   = $_POST['tipo'];
				$TipoEquipo = new TipoEquipo();
				$_SESSION['tipo'] =  $TipoEquipo->capturarnombre($_SESSION['idtipo']);
				$_SESSION['idmodelo'] = $_POST['modelo'];
				
				$Modelo = new Modelo();
				$_SESSION['modelo'] = $Modelo->capturarmodel($_SESSION['idmodelo']);
				$_SESSION['idmarca']  = $_POST['marca'];
				$Marca = new Marca();
				$_SESSION['marca'] = $Marca->capturarnombre($_SESSION['idmarca']);
			
			header('location: ../Vista/sirfei.php?token=equipo');
		}else{
			$registro = $Equipo->registrar($numero,$serial,$tipo,$modelo,$marca);
			if ($registro) {
				// echo "si registro...";
				$_SESSION['numero'] = $_POST['numero'];
				$_SESSION['serial'] = $_POST['serial'];
				$_SESSION['idtipoequipo']   = $_POST['tipo'];
				$TipoEquipo = new TipoEquipo();
				$_SESSION['tipo'] =  $TipoEquipo->capturarnombre($_SESSION['idtipo']);
				$_SESSION['idmodelo'] = $_POST['modelo'];
				
				$Modelo = new Modelo();
				$_SESSION['modelo'] = $Modelo->capturarmodel($_SESSION['idmodelo']);
				$_SESSION['idmarca']  = $_POST['marca'];
				$Marca = new Marca();
				$_SESSION['marca'] = $Marca->capturarnombre($_SESSION['idmarca']);
				$_SESSION['save-exito']      = true;
				header('location: ../Vista/sirfei.php?token=equipo');
			}else{
				// echo "no registro";
					$_SESSION['numero'] = $_POST['numero'];
				$_SESSION['serial'] = $_POST['serial'];
				$_SESSION['idtipoequipo']   = $_POST['tipo'];
				$TipoEquipo = new TipoEquipo();
				$_SESSION['tipo'] =  $TipoEquipo->capturarnombre($_SESSION['idtipo']);
				$_SESSION['idmodelo'] = $_POST['modelo'];
				
				$Modelo = new Modelo();
				$_SESSION['modelo'] = $Modelo->capturarmodel($_SESSION['idmodelo']);
				$_SESSION['idmarca']  = $_POST['marca'];
				$Marca = new Marca();
				$_SESSION['marca'] = $Marca->capturarnombre($_SESSION['idmarca']);
				$_SESSION['save-exito']      = false;
				header('location: ../Vista/sirfei.php?token=equipo');
			}
		}
	}
}
if (isset($_REQUEST['eliminar'])) {
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	if (isset($_SESSION['numero'])) {
		$eliminacion = $Equipo->eliminar($_SESSION['numero']);
	}else{
		// echo  $_POST['eliminar'];
		$eliminacion = $Equipo->eliminar($_POST['eliminar']);
	}
	if ($eliminacion == true) {
		$_SESSION['eliminacion'] = true;
		unset($_SESSION['numero']);
		header('location: ../Vista/sirfei.php?token=cat-equipo');
	}else{
		$_SESSION['eliminacion']     = false;
		unset($_SESSION['numero']);
	   header('location: ../Vista/sirfei.php?token=equipo');
	}
	}

if (isset($_REQUEST['salir'])) {
	unset($_SESSION['nombre']);
	unset($_SESSION['descripcion']);
	unset($_SESSION['id']);
	unset($_SESSION['eliminacion']);
	unset($_SESSION['modif-exito']);
	unset($_SESSION['save-exito']);
	unset($_SESSION['existe']);
	header('location: ../Vista/sirfei.php');
}
 ?>
