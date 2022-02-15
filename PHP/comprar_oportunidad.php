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
	}

	public function traer_transportista(){
		echo $this->traer_datos_transportista(json_decode($this->datosOportunidad, true)['ID_TRANSPORTISTA']);
	}

	public function traer_datos_pasajero(){
		
	}

	public function constancia_de_administradores(){
		
	}

	public function estado_oportunidad($estado,$id){
		$this->cambio_estado_oportunidad($estado,$id);
	}
}

$comprar_oportunidad = new comprar_oportunidad();


if ($_POST['opcion'] == 1) {
	$comprar_oportunidad->traer_datos_oportunidad($_POST['ID']);
	$comprar_oportunidad->traer_transportista();
} else if ($_POST['opcion'] == 2){
	$comprar_oportunidad->estado_oportunidad($_POST['ESTADO'],$_POST['ID']);
}


?>