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
			case 'emp':
				$this->empresas = $this->datos_empresas();
				break;
			case 'vih':
				$this->vehiculos = $this->datos_vehiculos();
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
		return json_encode($this->empresas);
	}

	public function getVehiculos(){
		/*
			Panel de administrador
		*/
		return json_encode($this->vehiculos);
	}
}

$Backend = new Backend($_POST['opcion']);

if ($_POST['opcion'] == "usr") {
	echo $Backend->getUsuarios();
} else if($_POST['opcion'] == "emp") {
	echo $Backend->getEmpresas();
} else {
	echo $Backend->getVehiculos();
}


 ?>