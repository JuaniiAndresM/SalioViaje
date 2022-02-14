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
}

$comprar_oportunidad = new comprar_oportunidad();

$comprar_oportunidad->traer_datos_oportunidad($_POST['ID']);

$comprar_oportunidad->traer_transportista();
?>