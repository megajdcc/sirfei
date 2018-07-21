<?php 
	require('autoload.php');
/**
 * @author Pablo
 */
 class Vistas{
 	public $nombre;
 	/**
 	 * [El Constructor de la clase Vistas es el encargado de recibir por parametro el nombre desencadenante de la vista a mostrar]
 	 * @param [String] $nombre [Contiene la variable de las distintas opciones opciones en el menu princiapl]
 	 */
 	function __construct($nombre){
 		/**
 		 * El switch acontinuacion es utilizaco como un enrutador para las distintas vistas dinamicas que se mostraran. 
 		 */
 		switch ($nombre) {
 			case 'coordinacion':
					$this->nombre = 'Coordinacion';
					$this->vistacoordinacion();
 				break;
 			case 'cargo':
					$this->nombre = 'Cargo';
					$this->vistacargo();
 				break;
 			case 'departamento':
	 				$this->nombre = 'Departamento';
		 			$this->vistadepartamento();
		 		break;
		 	case 'cat-departamento':
		 			$this->nombre = "Departamento";
 					$this->vistacatdepartamento();
		 		break;
		 	case 'cat-coordinacion':
		 			$this->nombre = "Coordinaciones";
 					$this->vistacatcoordinacion();
 				break;
 			case 'cat-trabajador':
 					$nombre  = "Trabajadores";
 					$this->nombre = $nombre;
 					$this->vistacattrabajador();
		 		break;
		 	case 'cat-cargo':
		 			$this->nombre = "Cargo de trabajo";
		 			$this->vistacatcargo();
		 		break;
		 	case 'cat-tipoequipo':
		 			$this->nombre = "Tipo de Equipo";
 					$this->vistacattipoequipo();
		 		break;
		 	case 'tipoequipo':
		 		$this->nombre = "Tipo de equipo";
				$this->vistatipoequipo();
		 		break;
		 	case 'cat-modelo':
		 		$this->nombre = "Modelos";
		 		$this->vistacatmodelo();
		 		break;
		 	case 'modelo':
		 		$this->nombre = "Modelo";
		 		$this->vistamodelo();
		 		break;
		 	case 'cat-marca':
		 		$this->nombre = "Marcas";
		 		$this->vistacatmarcas();
		 		break;
		 	case 'marca':
		 		$this->nombre = "Marca";
		 		$this->vistamarca();
		 		break;
		 	case 'cat-tiposervicio':
		 		$this->nombre = "Tipo de Servicios";
		 		$this->vistacattiposervicio();
		 		break;
		 	case 'tiposervicio':
		 		$this->nombre = "Tipo de Servicio";
		 		$this->vistatiposervicio();
		 		# code...
		 		break;
		 	case 'cat-estadoservicio':
		 		$this->nombre = "Estados de servicio";
		 		$this->vistacatestadoservicio();
		 		break;
		 	case 'estadoservicio':
		 		$this->nombre = "Estado de Servicio";
		 		$this->vistaestadoservicio();
		 		break;
		 	case 'cat-tipopersona':
		 		$this->nombre = "Tipo de Personas";
		 		$this->vistacattipopersonas();
		 		break;
		 	case 'tipopersona':
		 		$this->nombre = "Tipo de Persona";
		 		$this->vistatipopersona();
		 		break;
		 	case 'cat-equipo':
		 		$this->nombre = "Equipos";
		 		$this->vistacatequipo();
		 		break;
		 	case 'equipo':
		 		$this->nombre = "Equipo";
		 		$this->vistaequipo();
		 		break;
		 	case 'trabajador':
		 		$this->nombre = "Trabajador";
		 		$this->vistatrabajador();
		 		break;
		 	case 'cat-tecnico':
		 		$this->nombre = "Tecnicos";
		 		$this->vistacattecnicos();
		 		break;
		 	case 'tecnico':
		 		$this->nombre = "Tecnico";
		 		$this->vistatecnicos();
		 		break;
		 	case 'cat-solicitudes':
		 		$this->nombre = "Solicitudes";
		 		$this->vistacatsolicitud();
		 		break;
		 	case 'solicitud':
		 		$this->nombre = "Solicitud";
		 		$this->vistasolicitud();
		 		break;
 			default:
 				# code...
 				break;
 		}
 		}
 	

 	/**
 	 * Acontinuacion comienzan los metodos encapsulado de la clase quienes son los encargados de mostrar en pantalla cuada una 
 	 * de las vistas deseada... 
 	 */

 	private function vistacargo(){
 		require_once('views/cargo.php');
 	}

 	private function vistacoordinacion(){
 		require_once('views/coordinacion.php');	
	}

 	private function vistadepartamento(){
 		$Departamento = new Departamento();
 		require_once('views/departamento.php');}

	private function vistacatdepartamento(){
		$Departamento = new Departamento();
		require_once('views/catdepartamento.php');}

	private function vistacatcoordinacion(){
		$Coordinacion = new Coordinacion();
		require_once('views/catcoordinacion.php');}
	
	private function vistacattrabajador(){
		$Trabajador = new Trabajador();
		require_once('views/cattrabajador.php');}

	private function vistacatcargo(){
		$Cargo = new Cargo();
		require_once('views/catcargo.php');}

	private function vistacattipoequipo(){
		$TipoEquipo = new TipoEquipo();
		require_once 'views/cattipoequipo.php';
	}

	private function vistacatmodelo(){
		$Modelo = new Modelo();
		require_once 'views/catmodelo.php';
	}
	private function vistatipoequipo(){
		$TipoEquipo = new TipoEquipo();
		require_once 'views/tipoequipo.php';
	}

	private function vistamodelo(){
		$Modelo = new Modelo();
		require_once 'views/modelo.php';
	}
	private function vistacatmarcas(){
		$Marca = new Marca();
		require_once 'views/catmarcas.php';
	}
	private function vistamarca(){
		$Marca = new Marca();
		require_once 'views/marca.php';
	}
	private function vistacattiposervicio(){
		$TipoServicio = new TipoServicio();
		require_once 'views/cattiposervicio.php';
	}
	private function vistatiposervicio(){
		$TipoServicio = new TipoServicio();
		require_once 'views/tiposervicio.php';
	}

	private function vistacatestadoservicio(){
		$EstadoServicio = new EstadoServicio();
		require_once 'views/catestadoservicio.php';
	}
	private function vistaestadoservicio(){
		$EstadoServicio = new EstadoServicio();
		require_once 'views/estadoservicio.php';
	}
	private function vistacattipopersonas(){
		$TipoPersona = new TipoPersona();
		require_once 'views/cattipopersona.php';
	}

	private function vistatipopersona(){
		$TipoPersona = new TipoPersona();
		require_once 'views/tipopersona.php';
	}
	private function vistacatequipo(){
		$Equipo = new Equipo();
		require_once  'views/catequipo.php';
	}
	private function vistaequipo(){
		$Equipo = new Equipo();
		$TipoEquipo = new TipoEquipo();
		$Modelo = new Modelo();
		$Marca = new Marca();
		require_once  'views/equipo.php';
	}
	private function vistatrabajador(){
		$Trabajador = new Trabajador();
		$TipoPersona = new TipoPersona();
		$Cargo = new Cargo();
		$Departamento = new Departamento();
		$Equipo  = new Equipo();
		include_once 'views/trabajador.php';
	}

	private function vistacattecnicos(){
		$Tecnico = new Tecnico();

		include_once 'views/cattecnico.php';
	}
	private function vistatecnicos(){
		$Tecnico = new Tecnico();
		$TipoPersona = new TipoPersona();
		include_once 'views/tecnico.php';
	}

	private function vistacatsolicitud(){
		$Solicitud = new Solicitud();
		include_once 'views/catsolicitud.php';
	}
	private function vistasolicitud(){
		$Solicitud = new Solicitud();
		$Trabajador = new Trabajador();
		$Tecnico = new Tecnico();
		require_once 'views/solicitud.php';
	}
} 

 ?>