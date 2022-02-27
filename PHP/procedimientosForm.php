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

	public function register_transportista($empresa,$idUsuario){
		$this->idUsuario = $idUsuario;
		$this->registrar_empresa("TTA",$empresa);
	}

	public function register_chofer($empresa,$idUsuario){
		$this->idUsuario = $idUsuario;
		$this->registrar_empresa("CHO",$empresa);
	}

	public function register_anfitrion($empresa,$idUsuario){
		$this->idUsuario = $idUsuario;
		$this->registrar_empresa("ANF",$empresa);
	}

	public function register_agente($empresa,$idUsuario){
		$this->idUsuario = $idUsuario;
		$this->registrar_empresa("AGT",$empresa);
	}

	public function register_hotel($datos){
		//$this->registrar_usuarios("HTL", $datos);
	}

	private function registrar_empresa($tipoUsuario,$empresa){

		for ($x=0; $x < count($empresa); $x++) {
			$this->register_empresa($x,$tipoUsuario,$this->idUsuario,$empresa[$x]);
			for ($i=0; $i < count($empresa[$x]["VEHICULOS"]); $i++) { 
				if ($tipoUsuario == "CHO") {
					//rut_ec = RUT de la empresa creada por el chofer.
    				//rut = RUT de la agencia contratista del chofer.
					$rut_ec = $empresa[$x]["RUT"];
					$rut = $empresa[$x]["CHOFERES_SUB"]; 
				}else{
					$rut = $empresa[$x]["RUT"];
					$rut_ec = "0";
				}
				$this->register_vehiculo($rut,$rut_ec,$empresa[$x]["VEHICULOS"][$i]);
			}
		}
	}

	public function guardar_vehiculos($vehiculos,$rut){
		for ($x=0; $x < count($vehiculos); $x++) {
			$this->register_vehiculo($rut,0,$vehiculos[$x]);
		}
	}
}

$procedimientosForm = new procedimientosForm();

if ($_POST['tipo'] == 1) {
	$datos = json_decode($_POST["datos"],true);
	echo $procedimientosForm->registrar_usuarios($_POST["tipoUsuario"],$datos);
	unset($_POST['tipo']);
}else{

	switch ($_POST['tipo']) {

		case '2':
		$empresa = json_decode($_POST["empresas"],true);
		$procedimientosForm->register_transportista($empresa,$_POST['idUsuario']);
		break;
		case '3':
		$empresa = json_decode($_POST["empresas"],true);
		$procedimientosForm->register_chofer($empresa,$_POST['idUsuario']);
		break;
		case '4':
		$empresa = json_decode($_POST["empresas"],true);
		$procedimientosForm->register_anfitrion($empresa,$_POST['idUsuario']);
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
		$empresa = json_decode($_POST["empresas"],true);
		$procedimientosForm->register_agente($empresa,$_POST['idUsuario']);
		break;
		case 'empresas':
		echo $procedimientosForm->empresas();
		break;
		case 'vehiculos':
		echo json_encode($procedimientosForm->datos_vehiculos());
		break;
		case 'guardar-vehiculos':
		$datos = json_decode($_POST["vehiculos"],true);
		echo $procedimientosForm->guardar_vehiculos($datos,$_POST['rut']);
		break;
		case 'vehiculos-agenda':
		session_start();
		$vehiculos = array();
		for ($i=0; $i < count($_SESSION['datos_usuario']['RUT_EMPRESAS']); $i++) { 
			$vehiculos[] = $procedimientosForm->datos_vehiculos_por_rut($_SESSION['datos_usuario']['RUT_EMPRESAS'][$i]);
		}
		echo json_encode($vehiculos);
		break;
		case 'login':
		echo $procedimientosForm->login($_POST['usuario'],$_POST['pin']);
		break;
		case 'visita':
		echo $procedimientosForm->agrego_visita();
		break;
	}

}



?>