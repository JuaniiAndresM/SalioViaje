<?php 
require ('procedimientosBD.php');
/**
 * 
 */
class Backend extends procedimientosBD
{
	private $EMPRESAS_DASHBOARD = "";
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
									<button id=".$datos[$i]['ID']." onclick='ver_usuario(".$datos[$i]['ID'].")'><i class='far fa-eye'></i></button>
									<button id=".$datos[$i]['ID']." onclick='editarUsuario(".$datos[$i]['ID'].")'><i class='fas fa-edit'></i></button>
									<button id=".$datos[$i]['ID']." onclick='eliminar_usuario(".$datos[$i]['ID'].")'><i class='fas fa-trash-alt'></i></button>
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
									<button id=".$datos[$i]['ID']." onclick='ver_usuario(".$datos[$i]['ID'].")'><i class='far fa-eye'></i></button>
									<button id=".$datos[$i]['ID']." onclick='editarUsuario(".$datos[$i]['ID'].")'><i class='fas fa-edit'></i></button>
									<button id=".$datos[$i]['ID']." onclick='eliminar_usuario(".$datos[$i]['ID'].")'><i class='fas fa-trash-alt'></i></button>
								</div>
							</td>
						</tr>
					";
				}

			}
			return $contenido_tbody;
		}

		public function actualizar_tablas_dashboard_empresas(){

			$datos_e = $this->datos_empresas();
			session_start();
			for ($i=0; $i < count($datos_e); $i++) { 
				if ($_SESSION['datos_usuario']['TIPO_USUARIO'] == 'TTA' && $_SESSION['datos_usuario']['ID'] == $datos_e[$i]["ID_OWNER"]) {
					$this->tabla_empresas($i,$datos_e);
				}else if ($_SESSION['datos_usuario']['TIPO_USUARIO'] == 'CHO' && $_SESSION['datos_usuario']['ID'] == $datos_e[$i]["ID_OWNER"]) {
					$this->tabla_empresas($i,$datos_e);
				}else if ($_SESSION['datos_usuario']['TIPO_USUARIO'] == 'ADM') {
					$this->tabla_empresas($i,$datos_e);
				}
			}

			return $this->EMPRESAS_DASHBOARD;
		}

		private function tabla_empresas($i,$datos_e){
			require_once '../PHP/procedimientosBD.php';
			$info_empresa = new procedimientosBD();
    		$vehiculos = $info_empresa->traer_datos_vehiculo($datos_e[$i]["RUT"]);
			if($vehiculos != null){
				$size = sizeof($vehiculos);
			}else{
				$size = 0;
			}
				if ($i==0) {
		 			$this->EMPRESAS_DASHBOARD = '
                		<div class="propietario">
                  			<div class="propietario-left">
                    			<div class="propietario-icon">
                      			<i class="fas fa-building"></i>
                    			</div>
                    				<div class="propietario-info">
                      				<h3>'.$datos_e[$i]["NOMBRE_EMPRESA"].'</h3>
                      				<p><i class="fas fa-bus"></i> '.$size.' Vehiculos</p>
                    			</div>
                  			</div>
                  			<div class="propietario-button">
							  	<button id="'.$datos_e[$i]["RUT"].'" onclick="verEmpresa('.$datos_e[$i]['RUT'].')"><i class="far fa-eye"></i></button>
								<button id="'.$datos_e[$i]["RUT"].'" onclick="editarEmpresa('.$datos_e[$i]['RUT'].')"><i class="fas fa-edit"></i></button>
								<button id="'.$datos_e[$i]["RUT"].'" onclick="eliminarEmpresa('.$datos_e[$i]['RUT'].')"><i class="fas fa-trash-alt"></i></button>
                  			</div>
                		</div>
					';
				}else{
					$this->EMPRESAS_DASHBOARD = $this->EMPRESAS_DASHBOARD.'

                		<div class="propietario">
                  			<div class="propietario-left">
                    			<div class="propietario-icon">
                      			<i class="fas fa-building"></i>
                    			</div>
                    				<div class="propietario-info">
                      				<h3>'.$datos_e[$i]["NOMBRE_EMPRESA"].'</h3>
                      				<p><i class="fas fa-bus"></i> '.$size.' Vehiculos</p>
                    			</div>
                  			</div>
                  			<div class="propietario-button">
							  <button id="'.$datos_e[$i]["RUT"].'" onclick="verEmpresa('.$datos_e[$i]['RUT'].')"><i class="far fa-eye"></i></button>
							  <button id="'.$datos_e[$i]["RUT"].'" onclick="editarEmpresa('.$datos_e[$i]['RUT'].')"><i class="fas fa-edit"></i></button>
							  <button id="'.$datos_e[$i]["RUT"].'" onclick="eliminarEmpresa('.$datos_e[$i]['RUT'].')"><i class="fas fa-trash-alt"></i></button>
                  			</div>
                		</div>
					';
				}
			}

		public function agregar_div_faq(){

			$faq = null;
			$contador = 0;
			$datos = json_decode($this->traer_preguntas(), true);
			for ($i=0; $i < count($datos); $i++) { 
				if ($contador == 0) {
					$faq = '
                         <div class="faq-question" id="'.$datos[$i]["ID"].'">
                            <h3>'.$datos[$i]["PREGUNTA"].'</h3>
                            <p>'.$datos[$i]["RESPUESTA"].'</p>
                         </div>
					';
				} else {
					$faq = $faq.'
                         <div class="faq-question" id="'.$datos[$i]["ID"].'">
                            <h3>'.$datos[$i]["PREGUNTA"].'</h3>
                            <p>'.$datos[$i]["RESPUESTA"].'</p>
                         </div>
					';
				}
				$contador++;
			}
			
			return $faq;

		}

		public function faq_acordion(){
			/*
			*/
            $faq = null;

			$contador = 0;

			$datos = json_decode($this->traer_preguntas(), true);

			for ($i=0; $i < count($datos); $i++) { 
				if ($contador == 0) {
					$faq = '
                    <div class="accordion-item">
                    	<button class="accordion-link" onclick="desplegar(this)">
                        		<div class="faq-left">
                            		<div class="faq-icon">
                                	<i class="fas fa-question"></i>
                            		</div>
                            		<h4>'.$datos[$i]["PREGUNTA"].'</h4>
                        		</div>
                        	<div class="faq-right">
                            	<i class="fas fa-angle-down" id="arrow-down"></i>
                        	</div>
                    	</button>

                    	<div class="content">
                        	<p>'.$datos[$i]["RESPUESTA"].'</p>
                    	</div>
                	</div>
					';
				} else {
					$faq = $faq.'
                    <div class="accordion-item">
                    	<button class="accordion-link" onclick="desplegar(this)">
                        		<div class="faq-left">
                            		<div class="faq-icon">
                                	<i class="fas fa-question"></i>
                            		</div>
                            		<h4>'.$datos[$i]["PREGUNTA"].'</h4>
                        		</div>
                        	<div class="faq-right">
                            	<i class="fas fa-angle-down" id="arrow-down"></i>
                        	</div>
                    	</button>

                    	<div class="content">
                        	<p>'.$datos[$i]["RESPUESTA"].'</p>
                    	</div>
                	</div>
					';
				}
				$contador++;
			}
			
			return $faq;
		}
	}

	$Backend = new Backend($_POST['opcion']);

	//mostrarPreguntasSeccionFAQ

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
	} else if($_POST['opcion'] == "agregarPregunta") {
		echo $Backend->agregar_pregunta($_POST['datos']);
	} else if($_POST['opcion'] == "mostrarPreguntas") {
		echo $Backend->agregar_div_faq();
	} else if($_POST['opcion'] == "mostrarPreguntasSeccionFAQ") {
		echo $Backend->faq_acordion();
	} else if($_POST['opcion'] == "datosPreguntasFAQ") {
		echo $Backend->traer_pregunta_por_id($_POST['ID']);
	} else if($_POST['opcion'] == "editarPreguntaFAQ") {
		echo $Backend->editar_pregunta_FAQ($_POST['ID'],$_POST['PREGUNTA'],$_POST['RESPUESTA']);
	} else if($_POST['opcion'] == "borrarPreguntaFAQ") {
		echo $Backend->borrar_pregunta_FAQ($_POST['ID']);
	} else if($_POST['opcion'] == "agendarViaje") {
		echo $Backend->agendar_viaje($_POST['datos']);
	} else if($_POST['opcion'] == "agregarOportunidad") {
		echo $Backend->agregar_oportunidad($_POST['datos']);
	} else {
		echo $Backend->getVehiculos();
	}


?>