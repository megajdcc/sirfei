<?php 
session_start();
if (isset($_SESSION['idsession'])) {
	header('location: sirfei.php');
}
 include('../Controller/login.php');
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>

 	<meta charset="UTF-8">
 	<title>SIRFEI</title>
 </head>
 <!-- Cargando fuentes  -->
	<link href='fonts/EBGaramond.css' rel='stylesheet' type='text/css'>
<!--  Cargando iconos -->
    <link href='css/font-awesome.min.css' rel='stylesheet' type='text/css'>
<!-- css -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/estilos.css">
<!-- js  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
 <body>
 <section class="login">
 	<div class="container">
 	<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" onsubmit="CamposVaciosEnLogin()">
			<header class="cabecera-login">
				<!-- aca se puede colocar una cabecera si se desea  -->
			</header>
			<div class="row">
			<main class="principal-login col-xs-5">
				
					<header class="cab-int text-center">
						<img src="imagen/logo.png" name="logo" alt="Logotipo" class="logotipo">
					</header >
				
				<div class="formulario-login">
				<input type="text" id="usuario" name="usuario" placeholder="Usuario" maxlength="25">
				<input type="password" id="contrasena" name="contrasena"  placeholder="Contrase&ntilde;a" maxlength="25">
				<?php 
				if (isset($error)) {?>
					<div class="alert alert-danger" role="alert" style="margin-top: 1rem">
					<strong>Oh hubo un error!</strong>p
					<i class="alert-link">Verifique</i>
					su Usuario y/o Contraseña...
					</div>
				<?php } ?>	
				<input type="submit" class="boton" name="Entrar" value="Entrar" onclick="CamposVaciosEnLogin()">
				</div>
			</main>
			</div>
	</form>
</div>
</section>
 	
	
 </body>
 </html>
