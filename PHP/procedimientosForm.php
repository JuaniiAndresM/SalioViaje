<?php 
require ('procedimientosBD.php');
/**
 * 
 */
class procedimientosForm extends procedimientosBD
{
	private $idUsuario = null;


	public function register_transportista($usuario,$empresa){

		//echo json_encode($empresa);
		$this->idUsuario = $this->registrar_usuarios("TTA",$usuario);
		$this->registrar_empresa("TTA",null,$empresa);
	}

	public function register_chofer($usuario,$contratista,$empresa){
		/*
		Hago un if para validar y si todos los datos son correctos mando los datos a los procedimientos de la BD
		*/	
		$this->idUsuario = $this->registrar_usuarios("CHO",$usuario);
		$this->registrar_empresa("CHO",$contratista,$empresa);
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

	private function registrar_empresa($tipoUsuario,$contratista,$empresa){
		/*
		Hago un if para validar y si todos los datos son correctos mando los datos a los procedimientos de la BD
		*/
		echo $this->idUsuario;
		for ($x=0; $x < count($empresa); $x++) {

			$this->register_empresa($tipoUsuario,$this->idUsuario,$empresa[$x]);

			for ($i=0; $i < count($empresa[$x]["VEHICULOS"]); $i++) { 
				if ($tipoUsuario == "CHO") {
					$rut_ec = $empresa[$x]["RUT"];
					$rut = $contratista;
				}else{
					$rut = $empresa[$x]["RUT"];
					$rut_ec = "0";
				}
				$this->register_vehiculo($rut,$rut_ec,$empresa[$x]["VEHICULOS"][$i]);
			}

		}
	}

	private function registrar_usuarios($tipo,$datos){
		/*
		Hago un if para validar y si todos los datos son correctos mando los datos a los procedimientos de la BD
		*/	
		return $this->register_usuario($tipo, $datos);
	}
}

$procedimientosForm = new procedimientosForm();

switch ($_POST['tipo']) {
	case '1':
		$datos = json_decode($_POST["datos"],true);
		$procedimientosForm->registrar_usuarios("PAX",$datos);
		break;
	case '2':
		$usuario = json_decode($_POST["datos_Usuario"],true);
		$empresa = json_decode($_POST["empresas"],true);
		$procedimientosForm->register_transportista($usuario,$empresa);
		break;
	case '3':
		$usuario = json_decode($_POST["datos_Usuario"],true);
		$empresa = json_decode($_POST["empresas"],true);
		$procedimientosForm->register_chofer($usuario,$usuario["AGENCIA_CONTRATISTA"],$empresa);
		break;
	case '4':
		$datos = json_decode($_POST["datos"],true);
		$procedimientosForm->register_anfitrion($datos);
		break;
	case '5':
		$datos = json_decode($_POST["datos"],true);
		$procedimientosForm->register_hotel($datos);
		break;
	case 'empresas':
		echo $procedimientosForm->empresas();
		break;
}

?>