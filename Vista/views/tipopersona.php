<?php if (isset($_SESSION['nombre'])) {
		$nombre     = $_SESSION['nombre'];
		$descripcion = $_SESSION['descripcion'] ;
		?>
		<div class="vista">
 		<form name="form-tipopersona" action="../Controller/tipopersona.php" method="POST"  onsubmit="return validartipopersona()">
		<header class="cab-vista">
		<h2><?php echo $this->nombre; ?></h2>
		</header>
		<?php 
			if (isset($_SESSION['save-exito']) and $_SESSION['save-exito'] == true) {?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Exito!</strong> Se ha registrado exitosamente el tipo de persona...
				</div>
		<?php 	}elseif (isset($_SESSION['modif-exito']) and $_SESSION['modif-exito'] == true) {?>
				<div class="alert alert-info alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Exito!</strong> Ha modificado exitosamente el tipo de persona...
				</div>
		<?php }elseif (isset($_SESSION['existe']) and $_SESSION['existe'] == true){ ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> El tipo de persona ya existe intente con otro.
				</div>
		<?php  }elseif (isset($_SESSION['eliminacion']) and $_SESSION['eliminacion'] == false){?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> El tipo de persona, se esta utilizando imposible de eliminar...
				</div>
		<?php  }elseif(isset($_SESSION['save-exito']) and $_SESSION['save-exito'] == false){?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> No se pudo registrar El tipo de persona, verifique o pongase en contacto con el desarrollador...
				</div>
		<?php  }?>

		<main class="cuerpo-vista">
		<div class="container">
			<div class="row">
				<div class="persona">
					<table>
					<tr>
						<td>Nombre:</td>
						<td><input type="text" name="nombre" placeholder="Ingrese  un tipo de persona" class="tipopersona" id="tipopersona" maxlength="9" value="<?php echo $nombre; ?>" ></td>
					</tr>

					</table>
				</div>
				<div class="usuario">
					 <table>
					 	<tr>
					 		<td>Descripción</td>
					 		<td>
					 		<textarea name="descripcion" placeholder="Descripción del tipo de persona" id="descripcion" rows="4"><?php echo $descripcion; ?></textarea>
					 		</td>
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
 		<form name="form-tipopersona" action="../Controller/tipopersona.php" method="POST" onsubmit="return validartipopersona()">
		<header class="cab-vista">
		<h2><?php echo $this->nombre; ?></h2>
		</header>
		<main class="cuerpo-vista">
		<div class="container">
			<div class="row">
				<div class="persona">
					<table>
					<tr>
						<td>Nombre:</td>
						<td><input type="text" name="nombre" placeholder="Nombre del tipo de persona" id="nombre" class="nombre" maxlength="50"></td>
					</tr>
					<tr>
						<td>Descripción:</td>
						<td>
							<textarea name="descripcion" placeholder="Descripción del tipo de persona" id="descripcion" rows="4"></textarea>
							</td>
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