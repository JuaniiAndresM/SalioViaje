<?php 
require ('procedimientosBD.php');
/**
 * 
 */
class Backend extends procedimientosBD
{
	private $datos = array();
	private $usuarios = array();
	private $empresas = array();
	private $vehiculos = array();

	function __construct($opcion)
	{
		switch ($opcion) {
			case 'usr':
				$this->usuarios = $this->datos_usuarios();
				break;
		}
	}

	public function getCantidadUsuarios(){
		/*
			Panel de administrador
		*/
	}

	public function getUsuarios(){
		/*
			Panel de administrador
		*/
		return json_encode($this->usuarios);
	}

	public function getEmpresas(){
		/*
			Panel de administrador
		*/
	}

	public function getVehiculos(){
		/*
			Panel de administrador
		*/
	}
}

$Backend = new Backend($_POST['opcion']);

echo $Backend->getUsuarios();
 ?>