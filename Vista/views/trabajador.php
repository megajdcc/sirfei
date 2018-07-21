<?php if (isset($_SESSION['identificador'])) {
		$nombre         = $_SESSION['nombre'];
		$apellido       = $_SESSION['apellido'] ;
		$cedula         = $_SESSION['cedula'] ;
		 $tipopersona    = $_SESSION['tipopersona']; 
		$idtipoperson  = $_SESSION['idtipoperson'] ;
		$cargo          = $_SESSION['cargo'] ;
		$equipo         = $_SESSION['equipo'] ;
		$departamento   = $_SESSION['departamento'] ;
		$idcargo        = $_SESSION['idcargo'] ;
		$iddepartamento = $_SESSION['iddepartamento'] ;
		$identificador = $_SESSION['identificador'] ;

		?>
		<div class="vista">
 		<form name="form-trabajador" action="../Controller/trabajador.php" method="POST"  onsubmit="return validartrabajador()">
		<header class="cab-vista">
		<h2><?php echo $this->nombre; ?></h2>
		</header>
		<?php 
			if (isset($_SESSION['save-exito']) and $_SESSION['save-exito'] == true) {?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Exito!</strong> Se ha registrado exitosamente el trabajador...
				</div>
		<?php 	}elseif (isset($_SESSION['modif-exito']) and $_SESSION['modif-exito'] == true) {?>
				<div class="alert alert-info alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Exito!</strong> Ha modificado exitosamente el trabajador...
				</div>
		<?php }elseif (isset($_SESSION['existe']) and $_SESSION['existe'] == true){ ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> El trabajador ya existe intente con otro.
				</div>
		<?php  }elseif (isset($_SESSION['eliminacion']) and $_SESSION['eliminacion'] == false){?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> El trabajador, se esta utilizando imposible de eliminar...
				</div>
		<?php  }elseif(isset($_SESSION['save-exito']) and $_SESSION['save-exito'] == false){?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> No se pudo registrar El trabajador, verifique o pongase en contacto con el desarrollador...
				</div>
		<?php  }?>

		<main class="cuerpo-vista">
		<div class="container trabajador">
			<div class="row">
				<div class="persona col-xs-6">
					<table>
					<tr>
						<td>Cédula:</td>
						<td><input type="text" name="cedula" placeholder="cedula" class="cedula" id="cedula" maxlength="9" value="<?php echo $cedula; ?>" disabled/></td>
					</tr>
					<tr>
						<td>Nombre:</td>
						<td><input type="text" name="nombre" placeholder="nombre" class="nombre" id="nombre" maxlength="25" value="<?php echo $nombre; ?>"></td>
					</tr>
					<tr>
						<td>Apellido:</td>
						<td><input type="text" name="apellido" placeholder="apellido" class="apellido" id="apelldio" maxlength="25" value="<?php echo $apellido; ?>"></td>
					</tr>
					<tr>
						<td>Tipo de persona:</td>
						<td><select name="tipopersona">
							<option value="<?php echo $idtipoperson ?>"><?php echo $tipopersona; ?></option>
							<?php 
							$TipoPersona->listartipo();
							 ?>
						</select></td>
					</tr>
					</table>
				</div>
				<div class="trabajador col-xs-6">
					  <table>
					 	<tr>
					 		<td>Identificación:</td>
					 		<td><input type="text" name="identificacion" id="codigo" placeholder="identificador" class="identificador" maxlength="50" value="<?php echo $identificador ;?>" disabled></td>
					 	</tr>
					 	<tr>
					 		<td>Cargo:</td>
					 		<td><select name="cargo">
					 			<option value="<?php echo $idcargo; ?>"><?php echo $cargo; ?></option>
					 		<?php 
					 			$Cargo->listar();
					 		 ?>

					 		</select></td>
					 	</tr>
					 	<tr>
					 		<td>Departamento:</td>
					 		<td><select name="departamento">
					 			<option value="<?php  $iddepartamento;?>"><?php echo $departamento; ?></option>
					 		<?php 
					 			$Departamento->listar();
					 		 ?>

					 		</select></td>
					 	</tr>
					 	<tr>
					 		<td>Equipo:</td>
					 		<td><select name="equipo">
					 			<option value="<?php echo $equipo; ?>"><?php echo $equipo; ?></option>
					 		<?php 
					 			$Equipo->listar();
					 		 ?>

					 		</select></td>
					 	</tr>
					 </table>
				 </div>
			</div>
		</div>
		</main>
		<footer class="pie-vista">
			<button class ="b-grabar" type="submit" name="grabar" onclick="javascript: validarr = true;">Grabar</button>
			<button class ="b-eliminar" type="submit" name="eliminar">Eliminar</button>
			<button class ="b-salir" type="submit" name="salir" onclick="javascript: validarr = false;">Salir</button>
		</footer>
		</form>
		<script>
			function validarreponsable(){
			
			var cedula          = document.forms["form-responsable"]["cedula"].value;
			var nombre          = document.forms["form-responsable"]["nombre"].value;
			var apellido        = document.forms["form-responsable"]["apellido"].value;
			var fechanacimiento = document.forms["form-responsable"]["fechanac"].value;
			var codigo          = document.forms["form-responsable"]["codigo"].value;
			var status          = document.forms["form-responsable"]["staus"].value;
			alert(status);
			if (validarres) {

			if ( isNaN(cedula) || cedula == null || cedula.length < 7 ) {
			alert('[ERROR] Debe ingresar un cedula...');
			return false;
			}else if ( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) ) {
			alert('[ERROR] Debe ingresar un nombre...');
			return false;
			}else if ( apellido == null || apellido.length == 0 || /^\s+$/.test(apellido) ) {
			alert('[ERROR] Debe ingresar un apellido...');
			return false;
			}else if ( fechanacimiento == null || fechanacimiento.length == 0 || /^\s+$/.test(fechanacimiento) ) {
			alert('[ERROR] Debe ingresar una fecha de nacimiento...');
			return false;
			}else if ( codigo == null || codigo.length == 0 || /^\s+$/.test(codigo) ) {
			alert('[ERROR] Debe ingresar un codigo ...');
			return false;
			}else if ( status == null || status.length == 0 || /^\s+$/.test(status) ) {
			alert('[ERROR] Debe ingresar un status...');
			return false;
			}
			return true;
			}
			return true;
		}
		</script>
	</div>
		<?php
}else{?>
	<div class="vista">
 		<form name="form-trabajador" action="../Controller/trabajador.php" method="POST" onsubmit="return validartrabajador()">
		<header class="cab-vista">
		<h2><?php echo $this->nombre; ?></h2>
		</header>
		<main class="cuerpo-vista">
		<div class="container trabajador">
			<div class="row">
				<div class="persona col-xs-6">
					<table>
					<tr>
						<td>Cédula:</td>
						<td><input type="text" name="cedula" placeholder="cedula" id="cedula" class="cedula" maxlength="9"></td>
					</tr>
					<tr>
						<td>Nombre:</td>
						<td><input type="text" name="nombre" placeholder="nombre" id="nombre" class="nombre" maxlength="25"></td>
					</tr>
					<tr>
						<td>Apellido:</td>
						<td><input type="text" name="apellido" placeholder="apellido" id="apellido" class="apellido" maxlength="25"></td>
					</tr>
					<tr>
						<td>Tipo de persona:</td>
						<td><select name="tipopersona">
							<option value="0">Seleccione</option>
							<?php 
							$TipoPersona->listartipo();
							 ?>
						</select></td>
					</tr>
					</table>
				</div>
				<div class="trabajador col-xs-6">
					 <table>
					 	<tr>
					 		<td>Identificación:</td>
					 		<td><input type="text" name="identificacion" id="codigo" placeholder="identificador" class="identificador" maxlength="50"></td>
					 	</tr>
					 	<tr>
					 		<td>Cargo:</td>
					 		<td><select name="cargo">
					 			<option value="0">Seleccione</option>
					 		<?php 
					 			$Cargo->listar();
					 		 ?>

					 		</select></td>
					 	</tr>
					 	<tr>
					 		<td>Departamento:</td>
					 		<td><select name="departamento">
					 			<option value="0">Seleccione</option>
					 		<?php 
					 			$Departamento->listar();
					 		 ?>

					 		</select></td>
					 	</tr>
					 	<tr>
					 		<td>Equipo:</td>
					 		<td><select name="equipo">
					 			<option value="0">Seleccione número</option>
					 		<?php 
					 			$Equipo->listar();
					 		 ?>

					 		</select></td>
					 	</tr>
					 </table>
				 </div>
			</div>
		</div>
		</main>
		<footer class="pie-vista">
			<button class ="b-grabar" type="submit" name="grabar" value="submit" onclick="javascript: validarr = true;">Grabar</button>
			<!-- <button class ="b-eliminar" type="submit" name="eliminar">Eliminar</button> -->
			<button class ="b-salir" type="submit" name="salir" onclick="javascript: validarr = false;">Salir</button>
		</footer>
		</form>
	</div>
	<script type="text/javascript">
	var datepicker = $.fn.datepicker.noConflict(); // return $.fn.datepicker to previously assigned value
$.fn.bootstrapDP = datepicker;                 // give $().bootstrapDP the bootstrap-datepicker functionality
</script>
<?php } ?>