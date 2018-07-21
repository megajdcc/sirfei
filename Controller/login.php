<?php 
include('../Controller/autoload.php');
$Usuario = new Usuario();
// con el if evaluamos que la variables $_post no este vacia ...
	if(!empty($_POST)) // 
	{
		$result = $Usuario->loguear($_POST['usuario'],$_POST['contrasena']);
		if ($result['id'] != 0) {
				$id = $result['id'];
				$_SESSION['idsession']             = $id;
			 header('location: sirfei.php');
			
			
		}else{
			$error = "El nombre de usuario y contrasena son incorrectos ";
			//echo "<SCRIPT languaje='javascript'> alert('El nombre de usuario y contrasena son incorrectos');</SCRIPT>";
		}
	}
 ?>
