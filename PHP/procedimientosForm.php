<?php 
require ('procedimientosBD.php');
/**
 * 
 */
class procedimientosForm extends procedimientosBD
{
	private $idUsuario = null;

	public function register_usuarios($tipo,$datos){
		/*
		Hago un if para validar y si todos los datos son correctos mando los datos a los procedimientos de la BD
		*/	
		return $this->register_usuario($tipo, $datos);
	}

	public function register_transportista($usuario,$empresa){
		/*
		Hago un if para validar y si todos los datos son correctos mando los datos a los procedimientos de la BD
		*/
		$this->idUsuario = $this->register_usuarios("TTA",$usuario);
		for ($x=0; $x < count($empresa); $x++) {

			$this->register_empresa("TTA",$this->idUsuario,$empresa[$x]);

			for ($i=0; $i < count($empresa[$x]["VEHICULOS"]); $i++) { 
				$this->register_vehiculo($empresa[$x]["RUT"],"0",$empresa[$x]["VEHICULOS"][$i]);
			}

		}
		//echo json_encode($empresa);
		
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
		$procedimientosForm->register_pasajero("PAX",$datos);
		break;
	case '2':
		$usuario = json_decode($_POST["datos_Usuario"],true);
		$empresa = json_decode($_POST["empresas"],true);
		$procedimientosForm->register_transportista($usuario,$empresa);
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