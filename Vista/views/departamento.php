<?php 
	 $Coordinacion  = new Coordinacion();
?>
<?php if (isset($_SESSION['id'])) {
		$id             = $_SESSION['id'];
		$nombre         = $_SESSION['nombre'];
		$coordinacion   = $_SESSION['coordinacion'];
		$idcoordinacion = $_SESSION['idcoordinacion'];
		?>
		<div class="vista">
 		<form name="form-material" action="../Controller/departamento.php" method="POST" onsubmit="return validacioncoordinacion()>
		<header class="cab-vista">
		<h2><?php echo $this->nombre; ?></h2>
		</header>
		<?php 
			if (isset($_SESSION['save-exito']) and $_SESSION['save-exito'] == true) {?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Exito!</strong> Se ha registrado exitosamente el departamento...
				</div>
		<?php 	}elseif (isset($_SESSION['modif-exito']) and $_SESSION['modif-exito'] == true) {?>
				<div class="alert alert-info alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Exito!</strong> Ha modificado exitosamente el departamento
				</div>
		<?php }elseif (isset($_SESSION['existe']) and $_SESSION['existe'] == true){ ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> El codigo del departamento ya existe intente con otro...
				</div>
		<?php  }elseif (isset($_SESSION['eliminacion']) and $_SESSION['eliminacion'] == false){?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> El departamento, se esta utilizando imposible de eliminar...
				</div>
		<?php  }elseif(isset($_SESSION['save-exito']) and $_SESSION['save-exito'] == false){?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> No se pudo registrar El departamento, verifique o pongase en contacto con el desarrollador...
				</div>
		<?php  }?>

		<main class="cuerpo-vista">
		<div class="container">
			<div class="seleccio">
				<table class="table-sup">
					<thead>
						<th>Nombre</th>
						<th>Coordinación</th>
					
					</thead>
					<tbody>
						<td>
							<input type="text" name="nombre" placeholder="Indique nombre del departamento" class="nombdepar" value="<?php echo $nombre; ?>">
						</td>
						<td>
							<select name="coordinacion" id="cordi">
							<option value="<?php echo $idcoordinacion; ?>"><?php echo $coordinacion; ?></option>
							<?php $Coordinacion->listarcoordinacion(); ?>
							</select>
						</td>
					</tbody>
				</table>
			</div>
			
		</div>
		</main>
		<footer class="pie-vista">
			<button class ="b-grabar" type="submit" name="grabar" value="submit" onclick="javascript: validarm = true;">Grabar</button>
			<button class ="b-eliminar" type="submit" name="eliminar">Eliminar</button>
			<button class ="b-salir" type="submit" name="salir" onclick="javascript: validarm = false;">Salir</button>
		</footer>
		</form>
	</div>
		<?php
}else{?>
	<div class="vista">

 		<form  name="form-departamento" action="../Controller/departamento.php" method="POST" onsubmit="return validaciondepartamento()">
		<header class="cab-vista">
		<h2><?php echo $this->nombre; ?></h2>
		</header>
		<main class="cuerpo-vista">
		<div class="container">
			<div class="seleccio">
				<table class="table-sup">
					<thead>
						<th>Nombre</th>
						<th>Coordinación</th>
					</thead>
					<tbody>
						<td>
						<input type="text" name="nombre" placeholder="Indique nombre del departamento" class="nombdepar">
						</td>
						<td>
							<select name="coordinacion" id="cordi">
							<option value="<?php echo $null; ?>">Seleccione</option>
							<?php $Coordinacion->listarcoordinacion(); ?>
							</select>
						</td>
					</tbody>
				</table>
			</div>
			
		</div>
		</main>
		<footer class="pie-vista">
			<button class ="b-grabar" type="submit" name="grabar" value="submit" onclick="javascript: validarm = true;">Grabar</button>
			<!-- <button class ="b-eliminar" type="submit" name="eliminar">Eliminar</button> -->
			<button class ="b-salir" type="submit" name="salir" onclick="javascript: validarm = false;">Salir</button>
		</footer>
		</form>
	</div>

	
<script type ="text/javascript">
			$(document).ready(function()
			{
			// Parametros para e tipo de material
				$("#tipm").change(function () {
					$("#tipm option:selected").each(function () {
						//alert($(this).val());
						elegido=$(this).val();
						$.post("../controlador/material.php", { elegido: elegido }, function(data){
						$("#unidad").html(data);
				});         
				});
				})
			});
</script>

<?php } ?>
