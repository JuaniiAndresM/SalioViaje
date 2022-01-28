<?php 
require ('procedimientosBD.php');
/**
 * 
 */
class procedimientosForm extends procedimientosBD
{
	public function register_pasajero($datos){
		/*
		Hago un if para validar y si todos los datos son correctos mando los datos a los procedimientos de la BD
		*/	
		$this->register("PAX", $datos);
	}

	public function register_transportista($datos){
		/*
		Hago un if para validar y si todos los datos son correctos mando los datos a los procedimientos de la BD
		*/	
		$this->register("TTA", $datos);
	}

	public function register_chofer($datos){
		/*
		Hago un if para validar y si todos los datos son correctos mando los datos a los procedimientos de la BD
		*/	
		$this->register("CHO", $datos);
	}

	public function register_anfitrion($datos){
		/*
		Hago un if para validar y si todos los datos son correctos mando los datos a los procedimientos de la BD
		*/	
		$this->register("ANF", $datos);
	}

	public function register_hotel($datos){
		/*
		Hago un if para validar y si todos los datos son correctos mando los datos a los procedimientos de la BD
		*/	
		$this->register("AGT", $datos);
	}
}

$procedimientosForm = new procedimientosForm();

switch ($_POST['tipo']) {
	case '1':
		$datos = json_decode($_POST["datos"],true);
		$procedimientosForm->register_pasajero($datos);
		break;
	case '2':
		$datos = json_decode($_POST["datos"],true);
		$procedimientosForm->register_transportista($datos);
		break;
	case '3':
		$datos = json_decode($_POST["datos"],true);
		$procedimientosForm->register_chofer($datos);
		break;
	case '4':
		$datos = json_decode($_POST["datos"],true);
		$procedimientosForm->register_anfitrion($datos);
		break;
	case '5':
		$datos = json_decode($_POST["datos"],true);
		$procedimientosForm->register_hotel($datos);
		break;
}

?>