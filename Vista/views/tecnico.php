<?php if (isset($_SESSION['cedula'])) {
		$nombre         = $_SESSION['nombre'];
		$apellido       = $_SESSION['apellido'] ;
		$cedula         = $_SESSION['cedula'] ;
		$tipopersona    = $_SESSION['tipopersona']; 
		$idtipoperson  = $_SESSION['idtipoperson'] ;
		$formacion          = $_SESSION['formacion'] ;
		

		?>
		<div class="vista">
 		<form name="form-tecnico" action="../Controller/tecnico.php" method="POST"  onsubmit="return validartecnico()">
		<header class="cab-vista">
		<h2><?php echo $this->nombre; ?></h2>
		</header>
		<?php 
			if (isset($_SESSION['save-exito']) and $_SESSION['save-exito'] == true) {?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Exito!</strong> Se ha registrado exitosamente el tecnico...
				</div>
		<?php 	}elseif (isset($_SESSION['modif-exito']) and $_SESSION['modif-exito'] == true) {?>
				<div class="alert alert-info alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Exito!</strong> Ha modificado exitosamente el tecnico...
				</div>
		<?php }elseif (isset($_SESSION['existe']) and $_SESSION['existe'] == true){ ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> El tecnico ya existe intente con otro.
				</div>
		<?php  }elseif (isset($_SESSION['eliminacion']) and $_SESSION['eliminacion'] == false){?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> El tecnico, se esta utilizando imposible de eliminar...
				</div>
		<?php  }elseif(isset($_SESSION['save-exito']) and $_SESSION['save-exito'] == false){?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> No se pudo registrar El tecnico, verifique o pongase en contacto con el desarrollador...
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
					 		<td>Formación:</td>
					 		<td><input type="text" name="formacion" id="codigo" placeholder="Formación" class="identificador" maxlength="50" value="<?php echo $formacion ;?>" ></td>
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
		
	</div>
		<?php
}else{?>
	<div class="vista">
 		<form name="form-tecnico" action="../Controller/tecnico.php" method="POST" onsubmit="return validartecnico()">
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
					 		<td>Formación:</td>
					 		<td><input type="text" name="formacion" id="codigo" placeholder="Formación del tecnico" class="formacion" maxlength="50"></td>
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