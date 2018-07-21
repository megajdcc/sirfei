<?php 
	// setlocale(LC_TIME, 'es_PR.UTF-8');
	// $fecha1 = date_default_timezone_get();

	// date_default_timezone_set ('America/Caracas');
	$fecha = strftime("%A, %d de %B del %Y");
	$hora = strftime("%H:%M %p ");
	$buendia = strftime("%p");
	$fecha = strftime("%A, %d de %B del %Y");
	if (strftime("%A") == "Sunday") {
		$dia = " Domingo";
	}elseif (strftime("%A") == "Monday") {
		$dia = "Lunes";
	}elseif (strftime("%A") == "Tuesday") {
		$dia = "Martes";
	}elseif (strftime("%A") == "Wednesday") {
		$dia = "Miercoles";
	}elseif (strftime("%A") == "Thursday") {
		$dia = "Jueves";
	}elseif (strftime("%A") == "Friday") {
		$dia = "Viernes";
	}elseif (strftime("%A") == "Saturday") {
		$dia = "Sabado";
	}

	$nrodia = strftime("%d");
	$mes = strftime("%B");
	if (strftime("%B") == "January") {
		$mes = "Enero";
	}elseif(strftime("%B") == "February") {
		$mes = "Febrero";
	}elseif(strftime("%B") == "March") {
		$mes = "Marzo";
	}elseif (strftime("%B") == "April") {
		$mes = "Abril";
	}elseif (strftime("%B") == "May") {
		$mes = "Mayo";
	}elseif (strftime("%B") == "June") {
		$mes = "Junio";
	}elseif (strftime("%B") == "july") {
		$mes = "Julio";
	}elseif (strftime("%B") == "August") {
		$mes = "Agosto";
	}elseif (strftime("%B") == "September") {
		$mes = "Septiembre";
	}elseif (strftime("%B") == "October") {
		$mes = "Octubre";
	}elseif (strftime("%B") == "November") {
		$mes = "Noviembre";
	}elseif (strftime("%B") == "December") {
		$mes = "Diciembre";
	}
	 ?>
	 <script type="text/javascript">
	function muestraReloj() {
	var fechaHora = new Date();
	var horas = fechaHora.getHours();
	var minutos = fechaHora.getMinutes();
	var segundos = fechaHora.getSeconds();
	
	var sufijo = ' am';
		if(horas > 12) {
		horas = horas - 12;
		sufijo = ' pm';
	}
 

	if(horas < 10) { horas = '0' + horas; }
	if(minutos < 10) { minutos = '0' + minutos; }
	if(segundos < 10) { segundos = '0' + segundos; }
	
	document.getElementById("reloj").innerHTML = horas+':'+minutos+':'+segundos + ' ' + sufijo;
	}
	
	window.onload = function() {
	setInterval(muestraReloj, 1000);
	}
</script>