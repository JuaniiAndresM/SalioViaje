<?php 
require_once 'procedimientosBD.php';
/**
 * 
 */
class comprar_oportunidad extends procedimientosBD
{

	private $telefono_transportista = null;
	private $nombre_transportista = null;
	private $datosOportunidad = null;

	public function traer_datos_oportunidad($id){
		$this->datosOportunidad = $this->traer_oportunidades_por_id($id);
		return $this->datosOportunidad;
	}

	public function traer_transportista(){
		echo $this->traer_datos_transportista($this->datosOportunidad[0]['ID_TRANSPORTISTA']);
	}

	public function traer_datos_pasajero(){
		
	}

	public function constancia_de_administradores(){
		
	}

	public function estado_oportunidad($estado,$id){
		$id_comprador = json_decode($this->obtener_id_comprador($id),true);
		$this->cambio_estado_oportunidad($estado,$id,$id_comprador[0]);
	}
}

$comprar_oportunidad = new comprar_oportunidad();

session_start();

if ($_POST['opcion'] == 1) {
	$comprar_oportunidad->traer_datos_oportunidad($_POST['ID']);
	$comprar_oportunidad->traer_transportista();
} else if ($_POST['opcion'] == 2){
	$comprar_oportunidad->estado_oportunidad($_POST['ESTADO'],$_POST['ID']);
} else if ($_POST['opcion'] == 3){
	echo json_encode($comprar_oportunidad->traer_datos_oportunidad($_POST['ID']));
} else if ($_POST['opcion'] == 4){
	echo $comprar_oportunidad->traer_viajes_cotizando_por_id($_POST['ID']);
}


?>