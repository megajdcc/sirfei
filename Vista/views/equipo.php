
<?php if (isset($_SESSION['numero'])) {
	
	$numero =$_SESSION['numero'];
	$serial =$_SESSION['serial'];
	$tipo   =$_SESSION['tipoequipo'];
	$modelo =$_SESSION['modelo'];
	$marca  =$_SESSION['marca'];

	$idtipo  = $_SESSION['idtipoequipo'];
	$idmodel = $_SESSION['idmodelo'];
	$idmarca = $_SESSION['idmarca'];
	?>
	<div class="vista-sol">
	<form name="form-equipo" action="../Controller/equipo.php" method="POST" onsubmit="return validacionequipo()">
		<header class="cab-vista">
				<h2 ><?php echo $this->nombre;?></h2>
		</header>
		<?php 
			if (isset($_SESSION['save-exito']) and $_SESSION['save-exito'] == true) {?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Exito!</strong> Se ha registrado exitosamente el equipo...
				</div>
		<?php 	}elseif (isset($_SESSION['modif-exito']) and $_SESSION['modif-exito'] == true) {?>
				<div class="alert alert-info alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Exito!</strong> Ha modificado exitosamente el equipo
				</div>
		<?php }elseif (isset($_SESSION['existe']) and $_SESSION['existe'] == true){ ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> El codigo del equipo ya existe intente con otro...
				</div>
		<?php  }elseif (isset($_SESSION['eliminacion']) and $_SESSION['eliminacion'] == false){?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> El equipo, se esta utilizando imposible de eliminar...
				</div>
		<?php  }elseif(isset($_SESSION['save-exito']) and $_SESSION['save-exito'] == false){?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Error!</strong> No se pudo registrar El equipo, verifique o pongase en contacto con el desarrollador...
				</div>
		<?php  }?>
		
		<main class="cuerpo-vista">
		<div class="container">
			<article class="solicitud">
			<div class="row">
					<div class="izq col-xs-12">
					<div class="direccion">
					<table width="100%">
						<thead>
							<th>Tipo</th>
							<th>Modelo</th>
							<th>Marcar</th>
						</thead>
						<tbody>
							<tr>
								<td>
									<select name="tipo" enabled>
										<option value="<?php echo $idtipo; ?>"><?php echo $tipo; ?></option>
										<?php $TipoEquipo->listartipoequipo(); ?>
									</select>
								</td>
								<td>
									<select name="modelo" enabled>
										<option value="<?php echo $idmodel; ?>"><?php echo $modelo; ?></option>
										<?php $Modelo->listarmodelo(); ?>
									</select>
								</td>
								<td>
									<select name="marca" enabled>
										<option value="<?php echo $idmarca; ?>"><?php echo $marca; ?></option>
										<?php $Marca->listarmarca(); ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
					<div class="numero">
					<label for="">Número:</label>
					<input type="text" name="numero" class="numero" value="<?php echo $numero;?>" placeholder="Ingrese el número de identificación del equipo..." disabled>
					</div>
					<div class="serial">
						<label for="">Serial:</label>
						<input type="text" name="serial" value="<?php echo $serial;?>" class="serial" placeholder="Ingrese el número de serial del equipo">
					</div>
			
				
				</div>
				
					
			</div>
			</article>
		</div>
		</main>
		<footer class="pie-vista">
			<button class ="b-grabar" type="submit" name="grabar">Grabar</button>
			<button class ="b-eliminar" type="submit" name="eliminar" >Eliminar</button>
			<button class ="b-salir" type="submit" name="salir">Salir</button>
		</footer>
			</form>
</div>
<?php }else{?>
	<div class="vista-sol">
	<form name="form-equipo" action="../Controller/equipo.php" onsubmit="return validacionequipo()" method="POST" >
		<header class="cab-vista">
		<h2 ><?php echo $this->nombre; ?></h2>
		</header>
		<main class="cuerpo-vista">
		<div class="container">
			<article class="solicitud">
			<div class="row">
				<div class="izq col-xs-12">
				<div class="direccion">
					<table width="100%">
						<thead>
							<th>Tipo</th>
							<th>Modelo</th>
							<th>Marca</th>
						</thead>
						<tbody>
							<tr>
								<td>
									<select name="tipo" enabled>
										<option value="Seleccione">Seleccione</option>
										<?php $TipoEquipo->listartipoequipo(); ?>
									</select>
								</td>
								<td>
									<select name="modelo" enabled>
										<option value="Seleccione">Seleccione</option>
										<?php $Modelo->listarmodelo(); ?>
									</select>
								</td>
								<td>
									<select name="marca" enabled>
										<option value="Seleccione">Seleccione</option>
										<?php $Marca->listarmarca(); ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="numero">
				<label for="">Número:</label>
				<input type="text" name="numero" class="numero" placeholder="Ingrese el número de identificación del equipo...">
				</div>
				<div class="serial">
					<label for="">Serial:</label>
					<input type="text" name="serial" class="serial" placeholder="Ingrese el número de serial del equipo">
				</div>
				</div>					
			</div>
			</article>
		</div>
		</main>
		<footer class="pie-vista">
			<button class ="b-grabar" type="submit" name="grabar" value="submit" onclick="javascript: validar = true">Grabar</button>
			<!-- <button class ="b-eliminar" type="submit" name="eliminar">Eliminar</button> -->
			<button class ="b-salir" type="submit" name="salir">Salir</button>
		</footer>
			</form>
</div>
<?php } ?>
