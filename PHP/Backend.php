<?php 
require ('procedimientosBD.php');
/**
 * 
 */
class Backend extends procedimientosBD
{
	private $visitas = 0;
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
			case 'visitas':
			$this->visitas = $this->traigo_visitas();
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
		public function getVisitas(){
		/*
			Panel de administrador
		*/
			return json_encode($this->visitas);
		}
		public function actualizar_tablas_dashboard_usuarios(){

			$contenido_tbody = 0;
			$datos = $this->datos_usuarios();

			for ($i=0; $i < count($datos); $i++) { 
				if ($i==0) {
					$contenido_tbody = "
						<tr class='".$datos[$i]['TIPO_USUARIO']."'>
							<td>".$datos[$i]['TIPO_USUARIO']."</td>
							<td>".$datos[$i]['NOMBRE']."</td>
							<td>".$datos[$i]['APELLIDO']."</td>
							<td>".$datos[$i]['DEPARTAMENTO']."</td>
							<td>".$datos[$i]['TELEFONO']."</td>
							<td>
								<div class='button-wrapper'>
									<button id=".$datos[$i]['ID']." disabled><i class='far fa-eye'></i></button>
								</div>
							</td>
						</tr>
					";

				}else{
					$contenido_tbody = $contenido_tbody."
						<tr class='".$datos[$i]['TIPO_USUARIO']."'>
							<td>".$datos[$i]['TIPO_USUARIO']."</td>
							<td>".$datos[$i]['NOMBRE']."</td>
							<td>".$datos[$i]['APELLIDO']."</td>
							<td>".$datos[$i]['DEPARTAMENTO']."</td>
							<td>".$datos[$i]['TELEFONO']."</td>
							<td>
								<div class='button-wrapper'>
									<button id=".$datos[$i]['ID']." disabled><i class='far fa-eye'></i></button>
									<button id=".$datos[$i]['ID']." disabled><i class='fas fa-edit'></i></button>
									<button id=".$datos[$i]['ID']." disabled><i class='fas fa-trash-alt'></i></button>
								</div>
							</td>
						</tr>
					";
				}

			}
			return $contenido_tbody;
		}

		public function actualizar_tablas_dashboard_empresas(){
			$EMPRESAS_DASHBOARD = 0;
			$datos_e = $this->datos_empresas();
			for ($i=0; $i < count($datos_e); $i++) { 
				if ($i==0) {
		 			$EMPRESAS_DASHBOARD = '
                		<div class="propietario">
                  			<div class="propietario-left">
                    			<div class="propietario-icon">
                      			<i class="fas fa-building"></i>
                    			</div>
                    				<div class="propietario-info">
                      				<h3>'.$datos_e[$i]["NOMBRE_EMPRESA"].'</h3>
                      				<p><i class="fas fa-bus"></i> 2 Vehiculos</p>
                    			</div>
                  			</div>
                  			<div class="propietario-button">
							  	<button id="'.$datos_e[$i]["ID"].'" disabled><i class="far fa-eye"></i></button>
								<button id="'.$datos_e[$i]["ID"].'" disabled><i class="fas fa-edit"></i></button>
								<button id="'.$datos_e[$i]["ID"].'" disabled><i class="fas fa-trash-alt"></i></button>
                  			</div>
                		</div>
					';
				}else{

					$EMPRESAS_DASHBOARD = $EMPRESAS_DASHBOARD.'

                		<div class="propietario">
                  			<div class="propietario-left">
                    			<div class="propietario-icon">
                      			<i class="fas fa-building"></i>
                    			</div>
                    				<div class="propietario-info">
                      				<h3>'.$datos_e[$i]["NOMBRE_EMPRESA"].'</h3>
                      				<p><i class="fas fa-bus"></i> 2 Vehiculos</p>
                    			</div>
                  			</div>
                  			<div class="propietario-button">
								<button id="'.$datos_e[$i]["ID"].'" disabled><i class="far fa-eye"></i></button>
								<button id="'.$datos_e[$i]["ID"].'" disabled><i class="fas fa-edit"></i></button>
								<button id="'.$datos_e[$i]["ID"].'" disabled><i class="fas fa-trash-alt"></i></button>
                  			</div>
                		</div>
					';
				}
			}

			return $EMPRESAS_DASHBOARD;
		}
	}

	$Backend = new Backend($_POST['opcion']);

	if ($_POST['opcion'] == "usr") {
		echo $Backend->getUsuarios();
	} else if($_POST['opcion'] == "emp") {
		echo $Backend->getEmpresas();
	} else if($_POST['opcion'] == "visitas") {
		echo $Backend->getVisitas();
	} else if($_POST['opcion'] == "tab_dashboard_usuarios") {
		echo $Backend->actualizar_tablas_dashboard_usuarios();
	} else if($_POST['opcion'] == "tab_dashboard_empresas") {
		echo $Backend->actualizar_tablas_dashboard_empresas();
	} else {
		echo $Backend->getVehiculos();
	}


?>