<?php 
require ('procedimientosBD.php');
/**
 * 
 */
class procedimientosForm extends procedimientosBD
{
	private $idUsuario = null;

	public function registrar_usuarios($tipo,$datos){
		return $this->register_usuario($tipo, $datos);
	}

	public function register_transportista($usuario,$empresa,$idUsuario){
		$this->idUsuario = $idUsuario;
		$this->registrar_usuarios("TTA",$usuario);
		$this->registrar_empresa("TTA",null,$empresa);
	}

	public function register_chofer($usuario,$contratista,$empresa){
		$this->idUsuario = $this->registrar_usuarios("CHO",$usuario);
		$this->registrar_empresa("CHO",$contratista,$empresa);
	}

	public function register_anfitrion($usuario,$empresa){
		$this->idUsuario = $this->registrar_usuarios("ANF",$usuario);
		$this->registrar_empresa("ANF",null,$empresa);
	}

	public function register_agente($usuario,$empresa){
		$this->idUsuario = $this->registrar_usuarios("AGT",$usuario);
		$this->registrar_empresa("AGT",null,$empresa);
	}

	public function register_hotel($datos){
		$this->registrar_usuarios("HTL", $datos);
	}

	private function registrar_empresa($tipoUsuario,$contratista,$empresa){
		echo json_encode($empresa);
		for ($x=0; $x < count($empresa); $x++) {
		$this->register_empresa($tipoUsuario,$this->idUsuario,$empresa[$x]);
			for ($i=0; $i < count($empresa[$x]["VEHICULOS"]); $i++) { 
				if ($tipoUsuario == "CHO") {
					 //rut_ec = RUT de la empresa creada por el chofer.
    				//rut = RUT de la agencia contratista del chofer.
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
		$procedimientosForm->register_transportista($usuario,$empresa,$_POST['idUsuario']);
		break;
	case '3':
		$usuario = json_decode($_POST["datos_Usuario"],true);
		$empresa = json_decode($_POST["empresas"],true);
		$procedimientosForm->register_chofer($usuario,$usuario["AGENCIA_CONTRATISTA"],$empresa);
		break;
	case '4':
		$usuario = json_decode($_POST["datos_Usuario"],true);
		$empresa = json_decode($_POST["empresas"],true);
		$procedimientosForm->register_anfitrion($usuario,$empresa);
		break;
	case '5':
		$datos = json_decode($_POST["datos"],true);
		$procedimientosForm->register_hotel($datos);
		break;
	case '6':
		$datos = json_decode($_POST["datos"],true);
		$procedimientosForm->registrar_usuarios("ASE",$datos);
		break;
	case '7':
		$usuario = json_decode($_POST["datos_Usuario"],true);
		$empresa = json_decode($_POST["empresas"],true);
		$procedimientosForm->register_agente($usuario,$empresa);
		break;
	case 'empresas':
		echo $procedimientosForm->empresas();
		break;
	case 'login':
		echo $procedimientosForm->login($_POST['usuario'],$_POST['pin']);
		break;
	case 'visita':
		echo $procedimientosForm->agrego_visita();
		break;
}

?>