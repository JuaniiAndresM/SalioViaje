<?php  

/**
 * 
 */
class validaciones 
{
	private $PATTERN_NOMBRES = "/^([A-Z][a-z]+([ ]?[a-z]?['-]?[A-Z][a-z]+)*)$/i";
	private $PATTERN_CI = "/^[0-9]{7,8}$/i";
	private $PATTERN_MAIL = "/.+@[a-z]{4,5}.+\.[?=com]\w.+/i";
	private $PATTERN_DIRECCION = "/^[a-zA-Z_]+([a-zA-Z0-9\s]*)$/i";
	private $PATTERN_TELEFONO = "/^(?=09[1-9]){3}[0-9]{9}$/i";
	private $PATTERN_PIN = "/[0-9]{4}/i";

	private $PATTERN_RUT = "/^[\d]{12}$/i";
	private $PATTERN_RAZON_SOCIAL = "/^[a-zA-Z_]+([a-zA-Z0-9\s\.]*)$/i";
	private $PATTERN_NUMERO_MTOP = "/^[\d]{8,10}$/i";
	private $PATTERN_PASSWORD_MTOP = "/^([\w\d]){8,10}$/i";

	private $PATTERN_MATRICULA = "/^(\w){3}([0-9]){4}$/i";
	private $PATTERN_MARCA = "/^([A-Z][a-z]+([ ]?[a-z]?['-]?[A-Z][a-z]+)*)$/i";
	private $PATTERN_MODELO = "/^[a-zA-Z_]+([a-zA-Z0-9\s\.]*)$/i";
	private $PATTERN_COMBUSTIBLE = "/^([A-Z][a-z]+([ ]?[a-z]?['-]?[A-Z][a-z]+)*)$/i";
	private $PATTERN_CAPACIDAD_PASAJEROS = "/[0-9]{0,3}/i";
	private $PATTERN_CAPACIDAD_EQUIPAJE = "/[0-9]{0,3}/i";
	
	function __construct($tipo,$datos)
	{
		switch ($tipo) {
			case 'PAX-TTA-ASE':
				$validacion = $this->validar_formulario_usuario_TTA_PAX_ASE($datos);
				if($validacion == 1){ echo "VALIDO"; } else {echo $validacion;}
				break;
			case 'CHO':
				$validacion = $this->validar_formulario_usuario_CHO($datos);
				if($validacion == 1){ echo "VALIDO"; } else {echo $validacion;}
				break;
			case 'EMP':
				$validacion = $this->validar_formulario_empresa($datos);
				if($validacion == 1){ echo "VALIDO"; } else {echo $validacion;}				
				break;
			case 'VIH':
				$validacion = $this->validar_formulario_vehiculo($datos);				
				if($validacion == 1){ echo "VALIDO"; } else {echo $validacion;}
				break;
			case 'ANF-AGT':
				$validacion = $this->validar_formulario_usuario_ANF_AGT($datos);				
				if($validacion == 1){ echo "VALIDO"; } else {echo $validacion;}
				break;
			case 'HTL':
				$validacion = $this->validar_formulario_usuario_HTL($datos);				
				if($validacion == 1){ echo "VALIDO"; } else {echo $validacion;}
				break;							
			default:
				echo "Esperando para validar...";
				break;
		}
	}

	private function validar_formulario_usuario_TTA_PAX_ASE($datos){

		$VALIDACION = array();
		$DATOS_VACIOS = null;
		$errores = 0;

		foreach (json_decode($datos) as $clave => $valor){
     		if ($valor != null || $valor != '') {
     			switch ($clave) {
     				case 'CI':
     						$CI = preg_match($this->PATTERN_CI, $valor);
     						$VALIDACION['CI'] = $CI;
     					break;
     				case 'NOMBRE':
     						$NOMBRE = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['NOMBRE'] = $NOMBRE;
     					break;
     				case 'APELLIDO':
     						$APELLIDO = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['APELLIDO'] = $APELLIDO;
     					break;
     				case 'CORREO':
     						$MAIL = preg_match($this->PATTERN_MAIL, $valor);
     						$VALIDACION['MAIL'] = $MAIL;
     					break;
     				case 'DIRECCION':
     						$DIRECCION = preg_match($this->PATTERN_DIRECCION, $valor);
     						$VALIDACION['DIRECCION'] = $DIRECCION;
     					break;
     				case 'BARRIO':
     						$BARRIO = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['BARRIO'] = $BARRIO;
     					break;
     				case 'DEPARTAMENTO':
     						$DEPARTAMENTO = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['DEPARTAMENTO'] = $DEPARTAMENTO;
     					break;
     				case 'TELEFONO':
     						$TELEFONO = preg_match($this->PATTERN_TELEFONO, $valor);
     						$VALIDACION['TELEFONO'] = $TELEFONO;
     					break;
     				case 'PIN':
     						$VALOR_PIN = $valor;
     						$PIN = preg_match($this->PATTERN_PIN, $valor);
     						$VALIDACION['PIN'] = $PIN;
     					break;
     				case 'RE-PIN':
     						$RE_PIN = preg_match($this->PATTERN_PIN, $valor);
     						if($VALOR_PIN == $valor){
     							$PIN_MATCH = 1;
     						}else{ $PIN_MATCH = 0; }
     						$VALIDACION['PIN-MATCH'] = $PIN_MATCH;
     					break;
     			}
     		}
		}

		if (count($VALIDACION) != 10) {
			$DATOS_VACIOS = "Err-1";
		}

		foreach ($VALIDACION as $clave => $valor){
     		if ($valor  == 0) {
     			$errores++;
     		}
		}

		if($DATOS_VACIOS == null && $errores == 0) { return true; } elseif ($DATOS_VACIOS != null) { return $DATOS_VACIOS; } else { return json_encode($VALIDACION);}

	}
	
	private function validar_formulario_usuario_CHO($datos){


		$VALIDACION = array();
		$DATOS_VACIOS = null;
		$errores = 0;

		foreach (json_decode($datos) as $clave => $valor){
     		if ($valor != null || $valor != '') {
     			switch ($clave) {
     				case 'RUT':
     						$RUT = preg_match($this->PATTERN_RUT, $valor);
     						$VALIDACION['RUT'] = $RUT;
     					break;
     				case 'NOMBRE':
     						$NOMBRE = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['NOMBRE'] = $NOMBRE;
     					break;
     				case 'APELLIDO':
     						$APELLIDO = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['APELLIDO'] = $APELLIDO;
     					break;
     				case 'CORREO':
     						$MAIL = preg_match($this->PATTERN_MAIL, $valor);
     						$VALIDACION['MAIL'] = $MAIL;
     					break;
     				case 'DIRECCION':
     						$DIRECCION = preg_match($this->PATTERN_DIRECCION, $valor);
     						$VALIDACION['DIRECCION'] = $DIRECCION;
     					break;
     				case 'BARRIO':
     						$BARRIO = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['BARRIO'] = $BARRIO;
     					break;
     				case 'DEPARTAMENTO':
     						$DEPARTAMENTO = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['DEPARTAMENTO'] = $DEPARTAMENTO;
     					break;
     				case 'TELEFONO':
     						$TELEFONO = preg_match($this->PATTERN_TELEFONO, $valor);
     						$VALIDACION['TELEFONO'] = $TELEFONO;
     					break;
     				case 'PIN':
     						$VALOR_PIN = $valor;
     						$PIN = preg_match($this->PATTERN_PIN, $valor);
     						$VALIDACION['PIN'] = $PIN;
     					break;
     				case 'RE-PIN':
     						$RE_PIN = preg_match($this->PATTERN_PIN, $valor);
     						if($VALOR_PIN == $valor){
     							$PIN_MATCH = 1;
     						}else{ $PIN_MATCH = 0; }
     						$VALIDACION['PIN-MATCH'] = $PIN_MATCH;
     					break;
     				case 'AGENCIA_CONTRATISTA':
     						if($valor == 0){
     							$AGENCIA_CONTRATISTA = 0;
     						}else{ $AGENCIA_CONTRATISTA = 1; }
     						$VALIDACION['AGENCIA_CONTRATISTA'] = $AGENCIA_CONTRATISTA;
     					break;
     			}
     		}
		}

		if (count($VALIDACION) != 11) {
			$DATOS_VACIOS = "Hay datos vacios...";
		}

		foreach ($VALIDACION as $clave => $valor){
     		if ($valor  == 0) {
     			$errores++;
     		}
		}

		if($DATOS_VACIOS == null && $errores == 0) { return true; } elseif ($DATOS_VACIOS != null) { return $DATOS_VACIOS; } else { return json_encode($VALIDACION);}

	}

	private function validar_formulario_usuario_ANF_AGT($datos){


		$VALIDACION = array();
		$DATOS_VACIOS = null;
		$errores = 0;

		foreach (json_decode($datos) as $clave => $valor){
     		if ($valor != null || $valor != '') {
     			switch ($clave) {
     				case 'RUT':
     						$RUT = preg_match($this->PATTERN_RUT, $valor);
     						$VALIDACION['RUT'] = $RUT;
     					break;
     				case 'NOMBRE':
     						$NOMBRE = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['NOMBRE'] = $NOMBRE;
     					break;
     				case 'APELLIDO':
     						$APELLIDO = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['APELLIDO'] = $APELLIDO;
     					break;
     				case 'CORREO':
     						$MAIL = preg_match($this->PATTERN_MAIL, $valor);
     						$VALIDACION['MAIL'] = $MAIL;
     					break;
     				case 'DIRECCION':
     						$DIRECCION = preg_match($this->PATTERN_DIRECCION, $valor);
     						$VALIDACION['DIRECCION'] = $DIRECCION;
     					break;
     				case 'BARRIO':
     						$BARRIO = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['BARRIO'] = $BARRIO;
     					break;
     				case 'DEPARTAMENTO':
     						$DEPARTAMENTO = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['DEPARTAMENTO'] = $DEPARTAMENTO;
     					break;
     				case 'TELEFONO':
     						$TELEFONO = preg_match($this->PATTERN_TELEFONO, $valor);
     						$VALIDACION['TELEFONO'] = $TELEFONO;
     					break;
     				case 'PIN':
     						$VALOR_PIN = $valor;
     						$PIN = preg_match($this->PATTERN_PIN, $valor);
     						$VALIDACION['PIN'] = $PIN;
     					break;
     				case 'RE-PIN':
     						$RE_PIN = preg_match($this->PATTERN_PIN, $valor);
     						if($VALOR_PIN == $valor){
     							$PIN_MATCH = 1;
     						}else{ $PIN_MATCH = 0; }
     						$VALIDACION['PIN-MATCH'] = $PIN_MATCH;
     					break;
     			}
     		}
		}

		if (count($VALIDACION) != 10) {
			$DATOS_VACIOS = "Hay datos vacios...";
		}


		foreach ($VALIDACION as $clave => $valor){
     		if ($valor  == 0) {
     			$errores++;
     		}
		}

		if($DATOS_VACIOS == null && $errores == 0) { return true; } elseif ($DATOS_VACIOS != null) { return $DATOS_VACIOS; } else { return json_encode($VALIDACION);}

	}

	private function validar_formulario_usuario_HTL($datos){


		$VALIDACION = array();
		$DATOS_VACIOS = null;
		$errores = 0;

		foreach (json_decode($datos) as $clave => $valor){
			if ($valor != null || $valor != '') {
				switch ($clave) {
					case 'CI':
							$CI = preg_match($this->PATTERN_CI, $valor);
							$VALIDACION['CI'] = $CI;
						break;
					case 'NOMBRE':
							$NOMBRE = preg_match($this->PATTERN_NOMBRES, $valor);
							$VALIDACION['NOMBRE'] = $NOMBRE;
						break;
					case 'APELLIDO':
							$APELLIDO = preg_match($this->PATTERN_NOMBRES, $valor);
							$VALIDACION['APELLIDO'] = $APELLIDO;
						break;
					case 'CORREO':
							$MAIL = preg_match($this->PATTERN_MAIL, $valor);
							$VALIDACION['MAIL'] = $MAIL;
						break;
					case 'DIRECCION':
							$DIRECCION = preg_match($this->PATTERN_DIRECCION, $valor);
							$VALIDACION['DIRECCION'] = $DIRECCION;
						break;
					case 'BARRIO':
							$BARRIO = preg_match($this->PATTERN_NOMBRES, $valor);
							$VALIDACION['BARRIO'] = $BARRIO;
						break;
					case 'DEPARTAMENTO':
							$DEPARTAMENTO = preg_match($this->PATTERN_NOMBRES, $valor);
							$VALIDACION['DEPARTAMENTO'] = $DEPARTAMENTO;
						break;
					case 'TELEFONO':
							$TELEFONO = preg_match($this->PATTERN_TELEFONO, $valor);
							$VALIDACION['TELEFONO'] = $TELEFONO;
						break;
					case 'PIN':
							$VALOR_PIN = $valor;
							$PIN = preg_match($this->PATTERN_PIN, $valor);
							$VALIDACION['PIN'] = $PIN;
						break;
					case 'RE-PIN':
							$RE_PIN = preg_match($this->PATTERN_PIN, $valor);
							if($VALOR_PIN == $valor){
								$PIN_MATCH = 1;
							}else{ $PIN_MATCH = 0; }
							$VALIDACION['PIN-MATCH'] = $PIN_MATCH;
						break;
				}
			}
	   }

		if (count($VALIDACION) != 10) {
			$DATOS_VACIOS = "Hay datos vacios...";
		}


		foreach ($VALIDACION as $clave => $valor){
     		if ($valor  == 0) {
     			$errores++;
     		}
		}

		if($DATOS_VACIOS == null && $errores == 0) { return true; } elseif ($DATOS_VACIOS != null) { return $DATOS_VACIOS; } else { return json_encode($VALIDACION);}

	}

	private function validar_formulario_empresa($datos){


		$VALIDACION = array();
		$DATOS_VACIOS = null;
		$TIENE_MTOP = null;
		$errores = 0;

		foreach (json_decode($datos) as $clave => $valor){
     		if ($valor != null || $valor != '' && $clave != 'VEHICULOS') {
     			switch ($clave) {
     				case 'RUT':
     						$RUT = preg_match($this->PATTERN_RUT, $valor);
     						$VALIDACION['RUT'] = $RUT;
     					break;
     				case 'NOMBRE_COMERCIAL':
     						$NOMBRE_COMERCIAL = preg_match($this->PATTERN_NOMBRES, $valor);
     						$VALIDACION['NOMBRE_COMERCIAL'] = $NOMBRE_COMERCIAL;
     					break;
     				case 'RAZON_SOCIAL':
     						$RAZON_SOCIAL = preg_match($this->PATTERN_RAZON_SOCIAL, $valor);
     						$VALIDACION['RAZON_SOCIAL'] = $RAZON_SOCIAL;
     					break;
     				case 'NUMERO_MTOP':
     						if ($valor != null) {
     							$TIENE_MTOP = 1;
     							$MTOP = preg_match($this->PATTERN_NUMERO_MTOP, $valor);
     							$VALIDACION['MTOP'] = $MTOP;
     						}else{$TIENE_MTOP = 0;}
     					break;
     				case 'PASSWORD_MTOP':
     						if ($TIENE_MTOP == 1) {
     					    	$PASSWORD_MTOP = preg_match($this->PATTERN_PASSWORD_MTOP, $valor);
     							$VALIDACION['PASSWORD_MTOP'] = $PASSWORD_MTOP;
     						}
     					break;
     			}
     		}
		}

		if (count($VALIDACION) == 3 && $TIENE_MTOP == 0) {
			$DATOS_VACIOS = null;
		}else if(count($VALIDACION) != 5){
			$DATOS_VACIOS = "Err-1";
		}

		foreach ($VALIDACION as $clave => $valor){
     		if ($valor  == 0) {
     			$errores++;
     		}
		}

		if($DATOS_VACIOS == null && $errores == 0) { return true; } elseif ($DATOS_VACIOS != null) { return $DATOS_VACIOS; } else { return json_encode($VALIDACION);}

	}

	private function validar_formulario_vehiculo($datos){

		$VALIDACION = array();
		$DATOS_VACIOS = null;
		$errores = 0;

		foreach (json_decode($datos) as $clave => $valor){
     		if ($valor != null || $valor != '') {
     			switch ($clave) {
     				case 'MATRICULA':
     						$MATRICULA = preg_match($this->PATTERN_MATRICULA, $valor);
     						$VALIDACION['MATRICULA'] = $MATRICULA;
     					break;
     				case 'MARCA':
     						$MARCA = preg_match($this->PATTERN_MARCA, $valor);
     						$VALIDACION['MARCA'] = $MARCA;
     					break;
     				case 'MODELO':
     						$MODELO = preg_match($this->PATTERN_MODELO, $valor);
     						$VALIDACION['MODELO'] = $MODELO;
     					break;
     				case 'COMBUSTIBLE':
     						if ($valor == "0") {
     							$VALIDACION['COMBUSTIBLE'] = 0;
     						}else { $VALIDACION['COMBUSTIBLE'] = 1; }
     					break;
     				case 'CAPACIDAD_PASAJEROS':
     						$CAPACIDAD_PASAJEROS = preg_match($this->PATTERN_CAPACIDAD_PASAJEROS, $valor);
     						$VALIDACION['CAPACIDAD_PASAJEROS'] = $CAPACIDAD_PASAJEROS;
     					break;
     				case 'CAPACIDAD_EQUIPAJE':
     						$CAPACIDAD_EQUIPAJE = preg_match($this->PATTERN_CAPACIDAD_EQUIPAJE, $valor);
     						$VALIDACION['CAPACIDAD_EQUIPAJE'] = $CAPACIDAD_EQUIPAJE;
     					break;
     				case 'PET_FRIENDLY':
     						if ($valor == "0") {
     							$VALIDACION['PET_FRIENDLY'] = 0;
     						}else { $VALIDACION['PET_FRIENDLY'] = 1; }
     						
     					break;
     			}
     		}
		}

		if (count($VALIDACION) != 7) {
			$DATOS_VACIOS = "Err-1";
		}


		foreach ($VALIDACION as $clave => $valor){
     		if ($valor  == 0) {
     			$errores++;
     		}
		}

		if($DATOS_VACIOS == null && $errores == 0) { return true; } elseif ($DATOS_VACIOS != null) { return $DATOS_VACIOS; } else { return json_encode($VALIDACION);}

	}

}

$Validar = new validaciones($_POST['tipo'],$_POST['datos']);

?>