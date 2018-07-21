<?php 
session_start();
if (!isset($_SESSION['idsession'])) {
	 header('location: login.php');
}	
	include('../Model/Usuario.php'); 
	$Usuario = new Usuario();

	$fila = $Usuario->datosesion($_SESSION['idsession']);
	while ($datos = $fila->fetch(PDO::FETCH_ASSOC)) {
			$nombre_s      = $datos['nombre'];
			$apellido_s    = $datos['apellido'];
			$usuario_s    = $datos['usuario'];
			$tipousuario_s = $datos['tipopersona'];
	}

	$fecha1 = date_default_timezone_get();
	$hora1 = strftime("%H:%M %p ");
	$date = new DateTime();
     // setlocale(LC_TIME, 'es_PR.UTF-8');
     date_default_timezone_set ('America/Puerto_Rico');
     $buendia = strftime("%p"); 
     $noche = strftime("%H");
     if ($buendia == "AM") {
            $horario = "Que tengas un Feliz Dia";
        }elseif($buendia == "PM") {
            $horario = "Que tengas una feliz Tarde";
        };
        if($buendia == "PM" AND $noche >= "18") {
            $horario = "Que tengas una feliz noche";
        }
// require_once('../controlador/principal.php');
require_once('vistas.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
	<title>SIRFEI</title>
	<script src="plugin/Jquery/jquery.js"></script>
	<!-- Cargando fuentes  -->
	<link href='fonts/EBGaramond.css' rel='stylesheet' type='text/css'>
<!--  Cargando iconos -->
    <link href='css/font-awesome.min.css' rel='stylesheet' type='text/css'>
<!-- css -->
	<link rel ="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="plugin/datepicker/css/bootstrap-datepicker.css"> 
    <script src="js/validaciones.js" type="text/javascript"></script>

<!-- js  -->
	<script src = "graphis/highcharts.js"> </script>
	<script src="graphis/modules/data.js"></script>
	<script src="graphis/modules/exporting.js"></script>
<!-- 	<script src="graphis/modules/drilldown.js"></script> -->
<!-- 	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
	<script src="plugin/datepicker/js/bootstrap-datepicker.js"></script>
  	<script src="plugin/datepicker/js/bootstrap-datepicker.es.min.js"></script>
<!-- Jquery -->
    
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>

   <link type="text/css" rel="stylesheet" href="css/datatables/jquery.dataTables.css" />
   	<!-- Calendario -->
 <script type="text/javascript">
  $(document).ready(function() {
		$('.datepicker').datepicker({
		format: 'yyyy/mm/dd',
		forceparse: true,
	
		 endDate: '-0d'
		});
       });
</script>
<script type="text/javascript">
	$(function(){
	$('[data-toggle="tooltip"]').tooltip();
	});
</script>

</head>
<body>
<!-- <?php include_once("../GoogleAnalytics/analyticstracking.php"); ?> -->
<section class="prin-scma">
			<div class="opcion-scma">
			<header class="logotipo">
				<img src="" alt="Logo de Sirfei">
			</header>
			<nav class="menu-scma">
			<?php include('menu.php'); ?> 
			</nav>
			</div>
			<div class="movimiento">
				<header class="cabecera-scma">
				<h3 class="bienvenido"><span class="icon-home"></span>Bienvenido <?php echo $nombre_s .", ".$horario. "."; ?></h3>
				<article class="logo-institucional">
					 <a href="http://www.seniat.gob.ve/" target="_blank" class="logo-gubernamental" >
					 <img src="img/logoseniat.png" alt="logo-gubernamental" class="logo-gubernamental" title="Ir a Pagina Oficial del seniat"></a>
				</article>
				</header>
				<main class="proc-scma">
				<section class="procesos">
						
					<?php 
					if (isset($_GET['token']))
					{
						$Vistas = new Vistas($_GET['token']);
					}
					?>
				</section>
				<div class="botones">
				<a href="cerrar.php">
				<button type="submit" class="exit" name="exit" value="Salir">
					<strong style="margin: 5px;" class="fa fa-sign-in"></strong>
					<strong>Salir</strong>
				</button>
				</a>
				</div>
				</main>
				<footer class="pie-scma">

					<article class="pie-nombre">
						<p><strong>Usuario: </strong><?php echo $nombre_s." ".$apellido_s;?></p>
					</article>
					<article class="pie-tipousuario">
						<p><strong>Tipo de usuario: </strong><?php echo $tipousuario_s; ?></p>
					</article>
					<article class="fecha-hora">
							<?php include('fecha.php'); 
							setlocale(LC_TIME, 'es_PR.UTF-8');
							$fecha = $dia.", ".strftime("%d")." de ".$mes. " del ". strftime("%Y");?>
					<p><?php echo $fecha; ?></p>		
					</article>
					<article class="hora">
						<p id="reloj"></p>
					</article>
				</footer>
			</div>
</section>
</body>
</html>