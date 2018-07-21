<?php if (isset($_SESSION['solicitud'])) {
		$solicitud    = $_SESSION['solicitud'];
		$trabajador   = $_SESSION['trabajador'];
		$idtrabajador = $_SESSION['idtrabajador'];
		$fecha        = $_SESSION['fecha']; 
		$hora         = $_SESSION['hora'];
		$descripcion  = $_SESSION['descripcion'];
		

		?>
		<div class="vista">
 		<form name="form-solicitud" action="../Controller/solicitud.php" method="POST"  onsubmit="return validarsolicitud()">
		<header class="cab-vista">
		<h2><?php echo $this->nombre; ?></h2>
		</header>
		

		<main class="cuerpo-vista">
		<div class="container trabajador">
			<div class="row">
				<div class="persona col-xs-6">
					<table>
					<tr>
					<td>Número de solicitud:</td>
					<td>
					
					<input type="number" name="solicitud" placeholder="<?php echo $solicitud; ?>" id="solicitud" value="<?php echo $solicitud; ?>" class="solicitud" maxlength="30" disabled>
					</td>
					</tr>
					<tr>
					<td>Fecha:</td>
						<td><input type="datepicker" name="fecha"  class="datepicker" data-date-format="yyyy-mm-dd" placeholder="Cuando se hizo la solictud? ..." data-provide="datepicker" id="fecha" value="<?php echo $fecha; ?>"></td>
					</tr>
					<tr>
						<td>Hora:</td>
						<td><input type="time" name="hora"id="hora" class="hora" value="<?php echo $hora; ?>" ></td>
					</tr>
					<tr>
						<td>Trabajador:</td>
						<td><select name="trabajador" disabled>
							<option value="<?php echo $idtrabajador?>" ><?php echo $trabajador; ?></option>
							<?php 
							$Trabajador->listatrabajador();
							 ?>
						</select></td>
					</tr>
					</table>
				</div>
				<div class="trabajador col-xs-6">
					  <table>
					 	<tr>
					 		<td>Descripcción:</td>
					 		<td><textarea name="descripcion" rows="2" cols="3" placeholder="Descripción de solicitud" class="formacion"><?php echo $descripcion; ?></textarea></td>
					 	</tr>
					 </table>
				 </div>
			</div>
		</div>
		</main>
		<footer class="pie-vista">
			<!-- <button class ="b-grabar" type="submit" name="procesar" onclick="javascript: validarr = true;">Procesar</button> -->
			<!-- <button class ="b-eliminar" type="submit" name="eliminar">Eliminar</button> -->
			<button class ="b-salir" type="submit" name="salir" onclick="javascript: validarr = false;">Salir</button>
		</footer>
		</form>
		
	</div>
		<?php
}else if(!isset($_SESSION['solicitud']) and !isset($_SESSION['asignacion'])){?>
	<div class="vista">
 		<form name="form-solicitud" action="../Controller/solicitud.php" method="POST" onsubmit="return validarsolicitud()">
		<header class="cab-vista">
		<h2><?php echo $this->nombre; ?></h2>
		</header>
			
		<main class="cuerpo-vista">
		<div class="container trabajador">
			<div class="row">
				<div class="persona col-xs-6">
					<table>
					<tr>
					<td>Número de solicitud:</td>
					<td>
					<?php $nro = $Solicitud->nrosolicitud();?>
					<input type="number" name="solicitud" placeholder="<?php echo $nro; ?>" id="solicitud" value="<?php echo $nro; ?>" class="solicitud" maxlength="30" disabled>
					</td>
					</tr>
					<tr>
					<td>Fecha:</td>
						<td><input type="datepicker" name="fecha"  class="datepicker" data-date-format="yyyy-mm-dd" placeholder="Cuando se hizo la solictud? ..." data-provide="datepicker" id="fecha"></td>
					</tr>
					<tr>
						<td>Hora:</td>
						<td><input type="time" name="hora"id="hora" class="hora" ></td>
					</tr>
					<tr>
						<td>Trabajador:</td>
						<td><select name="trabajador">
							<option value="0">Seleccione</option>
							<?php 
							$Trabajador->listatrabajador();
							 ?>
						</select></td>
					</tr>
					</table>
				</div>
				<div class="trabajador col-xs-6">
					 <table>
					 	<tr>
					 		<td>Descripcción:</td>
					 		<td><textarea name="descripcion" rows="2" cols="3" placeholder="Descripción de solicitud" class="formacion"></textarea></td>
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
<?php }else if(isset($_SESSION['asignacion'])){?>
<div class="vista-asignacion">
 		<form form name="form-solicitud" action="../Controller/solicitud.php" method="POST" onsubmit="return validarsolicitud()">
		<header class="cab-vista">
		<h2><?php echo $this->nombre; ?></h2>
		</header>
		<?php 
			if (isset($_SESSION['solicitudasignada']) and $_SESSION['solicitudasignada'] == true) {?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>Exito!</strong> Se ha procesado exitosamente la/s solicitudes...
				</div>
			<?php } ?>
		<main class="cuerpo-vista">
		<div class="row">
			<section class="izq col-lg-6">
				<section class="top">
					<article name="responsable" class="list-responsable">
					<label for="">Responsable</label>
					<select name="responsable">
						<option value="<?php echo null; ?>">Seleccione</option>
						<?php $Tecnico->listartecnico(); ?>
					</select>
				</article>
				</section>
				<section class="botton">
				<article name="observacion" class="t-observacion">
					<label for="">Observación</label>
					<textarea name="observacion" class="text-observacion" placeholder="Ingrese la observación obtenida"></textarea>
				</article>
				</section>
			</section>
			<section class="der col-lg-6">
				<article name="list-solicitudes" class="listsolicitudes">
					<table>
						<thead>
							<th>Nro de solicitud</th>
							<th>Fecha</th>
							<th>Seleccione</th>
						</thead>
						<tbody>
							<?php 
							$result = $Solicitud->sinasignar(); 
							foreach ($result as $row => $result) { 
								$solicitud = $result['nrosolicitud'];?>
								<tr id="fila-<?php echo $result['nrosolicitud']; ?>">
								<td><?php echo $result['nrosolicitud'] ;?></td>
								<td><?php echo $result['fecha'] ;?></td>

								<td><?php echo '<input type="checkbox" name="solicitud[]" id="solicitud" class="radius" 
								value="'.$solicitud.'">';?></td>
								</tr>
							
											
							<?php } ?>
						
						</tbody>
					</table>
				</article>
			</section>
		</div>
		</main>
		<footer class="pie-vista">
			<button class ="b-grabar" type="submit" name="asignar" value="submit" onclick="javascript: validarsolic = true ">Asignar</button>
			<!-- <button class ="b-eliminar" type="submit" name="eliminar">Eliminar</button> -->
			<button class ="b-salir" type="submit" name="salir"  onclick="javascript: validartrab = false ">Salir</button>
		</footer>
		</form>
	</div>
 <?php } ?>