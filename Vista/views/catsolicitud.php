<section class="catalago">
<form name="form-solicitud" action="../Controller/solicitud.php" method="POST" onsubmit="return validarsolicitud()">
	<header class="cab-catalago">
		<h2><?php echo $this->nombre; ?></h2>
	</header>
	<article class="cat">
		<table  id="example" class="display" cellspacing="0" width="100%">
		<thead>
            <tr>
                <th>Nro de Solicitud</th>
                <th>Fecha</th>
                <th>Hora</th>
              	<th>Trabajador</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
   			<?php 
   				$Solicitud->listarcatalago();
   			 ?>
        </tbody>
		</table>
	</article>
	<footer class="pie-vista">
        <button class ="b-grabar" type="submit" name="asignar-tecnico">Asignar solicitud</button>
		<button class ="b-grabar" type="submit" name="nuevo">Nueva solicitud</button>
		<button class ="b-salir" type="submit" name="salir">Salir</button>
	</footer>
  </form>
</section>

   <script>  
 $(document).ready(function() {
    var t = $('#example').DataTable( {
      "paging":         false,
      "scrollY":        "150px",
        "scrollCollapse": true,
         "language": {
                        "lengthMenu": "Mostar _MENU_ registros por pagina",
                        "info": "",
                        "infoEmpty": "No se Encontro ninguna Solicitud",
                        "infoFiltered": "(filtrada de _MAX_ registros)",
                        "search": "Buscar:",
                        "paginate": {
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },
                    },
        "columnDefs": [ {
            "searchable": true,
            "orderable": true,
            "targets": 0
        } ],
        "order": [[ 0, 'asc' ]]
    } );
} );

</script>
<!--         <script type    ="text/javascript">
        $(function(){
        $('[data-toggle ="tooltip"]').tooltip();
        });
        </script>
        <script type="text/javascript">        
        $(function(){
        $('[data-toggle ="popover"]').popover()
        });
</script> -->