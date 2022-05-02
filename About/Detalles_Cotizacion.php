<?php 
  
  session_start(); 
  /*
  if(!isset($_SESSION['usuario'])){
      header('Location: https://www.salioviaje.com.uy/Login');
  }else{
    
    if($_SESSION['tipo_usuario'] == "Chofer"){
      header('Location: https://www.salioviaje.com.uy/');
    }
    
  }
  */
  require_once "../PHP/procedimientosBD.php";

  $cotizaciones = new procedimientosBD();
  $cotizaciones = json_decode($cotizaciones->traer_viajes_cotizando_por_id($_GET['ID']), true);

  switch($cotizaciones[0]['TIPO']){
    case "Traslados":
      $TIPO_VIAJE = "Traslado";
      break;

    case "Tour":
      $TIPO_VIAJE = "Tour o Servicio por Hora";
      break;

    case "Transfer In":
      $TIPO_VIAJE = "Transfer de Arribo";
      break;

    case "Transfer Out":
      $TIPO_VIAJE = "Transfer de Partida";
      break;

    case "Solo Ida":
      $TIPO_VIAJE = "Fiesta o Evento - Ida";
      break;

    case "Solo Vuelta":
      $TIPO_VIAJE = "Fiesta o Evento - Vuelta";
      break;

    case "Ida y Vuelta":
      $TIPO_VIAJE = "Fiesta o Evento - Ida y Vuelta";
      break;
  }

  if(isset($cotizaciones[0]['FECHA_SALIDA'])){
    $fecha_salida = date("d-m-Y", strtotime($cotizaciones[0]['FECHA_SALIDA']));  
  }
  if(isset($cotizaciones[0]['FECHA_ARRIBO'])){
    $fecha_arribo = date("d-m-Y", strtotime($cotizaciones[0]['FECHA_ARRIBO']));  
  }
  if(isset($cotizaciones[0]['FECHA_REGRESO'])){
    $fecha_regreso = date("d-m-Y", strtotime($cotizaciones[0]['FECHA_REGRESO']));  
  }
  if(isset($cotizaciones[0]['FECHA_PARTIDA'])){
    $fecha_partida = date("d-m-Y", strtotime($cotizaciones[0]['FECHA_PARTIDA']));  
  }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Cotizacion #<?php echo $_GET['ID']; ?></title>

    <!-- // Meta Etiquetas -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    />

    <meta name="author" content="TotumDev" />

    <meta
      name="description"
      content="Plataforma que optimiza el traslado ocasional de personas."
    />
    <meta
      name="keywords"
      content="SalióViaje, transporte, transfer, alquiler con chofer, combis para fiestas, Salió Viaje, traslados"
    />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.salioviaje.com.uy/Viajar" />
    <meta property="og:title" content="SalióViaje | Viajar" />
    <meta
      property="og:description"
      content="Plataforma que optimiza el traslado ocasional de personas."
    />
    <meta
      property="og:image"
      content="https://www.salioviaje.com.uy/media/images/MetaImagen.png"
    />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Viajar" />
    <meta
      property="twitter:title"
      content="SalióViaje | Viajar"
    />
    <meta
      property="twitter:description"
      content="Plataforma que optimiza el traslado ocasional de personas."
    />
    <meta
      property="twitter:image"
      content="https://www.salioviaje.com.uy/media/images/MetaImagen.png"
    />

    <!-- // Fin de Meta Etiquetas -->

    <!-- Links -->
    <link
      rel="shortcut icon"
      href="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="https://www.salioviaje.com.uy/styles/styles.css" />

    <!-- Scripts -->
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/web.js"></script>
    <script src="https://www.salioviaje.com.uy/t2voice/functionsJS.js"></script>
  </head>
  <body>
    <div id="header"></div>

    <div id="pre-loader">
      <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>




    <a href="https://www.salioviaje.com.uy/FAQ" target="_BLANK" id="faq-float">
      <i class="fas fa-question"></i>
    </a>
    <a href="https://wa.link/mmdp0q" target="_BLANK" id="whatsapp-float">
      <img src="https://www.salioviaje.com.uy/media/images/whatsapp.png" alt="">
    </a>

    <section class="cotizacion-detalles-wrapper">
        <div class="cotizacion">
          <div class="cotizacion-header">
            <div class="driver-info">
              <div class="driver-icon">
                <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje">
              </div>
            </div>
            <div class="cotizacion-buttons">
              <?php 
                
                if (isset($_SESSION["usuario"])) {
                    if ($_SESSION['datos_usuario']['TIPO_USUARIO'] == "TTA" || $_SESSION['datos_usuario']['TIPO_USUARIO'] == "ADM") {
                        echo "<button class='cotizar-button' onclick='location.href= \"https://docs.google.com/forms/d/e/1FAIpQLSeQtd-s1ngnM-F-HbLYHhIOSW1_L0GiUZKoVoiXdnWWV5nsBg/viewform\"'><i class='fas fa-chart-line'></i> Cotizar</button>";                     
                    }
                }

               ?>
            </div>
          </div>
          <div class="cotizacion-content">

            <div class="cotizacion-info">
              <h2>Información:</h2>
              <?php
              echo '<p><b>N° Cotización: </b>'.$cotizaciones[0]['ID'].'</p>
                    <p><b>Tipo de Viaje: </b>'.$TIPO_VIAJE.'</p>';
              
                if($TIPO_VIAJE == "Transfer de Arribo"){
                    echo '
                    <p><b>Fecha del Arribo: </b>'.$fecha_salida.'</p>
                    <p><b>Hora del Arribo: </b>'.$cotizaciones[0]["HORA"].'</p>
                    <p><b>Número del Vuelo / Barco: </b>'.$cotizaciones[0]["NRO_BARCO_VUELO"].'</p>
                    <p><b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>
                    <p><b>Cantidad de Equipaje: </b>'.$cotizaciones[0]["EQUIPAJE"].'</p>';
                }else if($TIPO_VIAJE == "Transfer de Partida"){
                    echo '
                    <p><b>Fecha del Partida: </b>'.$fecha_partida.'</p>
                    <p><b>Hora para pasar a buscar: </b>'.$cotizaciones[0]["HORA"].'</p>
                    <p><b>Número del Vuelo / Barco: </b>'.$cotizaciones[0]["NRO_VUELO_BARCO"].'</p>
                    <p><b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>
                    <p><b>Cantidad de Equipaje: </b>'.$cotizaciones[0]["EQUIPAJE"].'</p>';
                }else if($TIPO_VIAJE == "Fiesta o Evento - Ida"){
                    echo '
                    <h3>Datos de la Ida:</h3>
                    <p><b>Fecha de ida: </b>'.$fecha_salida.'</p>
                    <p><b>Hora: </b>'.$cotizaciones[0]["HORA"].'</p>
                    <p><b>Origen: </b>'.$cotizaciones[0]["LOCALIDAD_ORIGEN"].', '.$cotizaciones[0]["BARRIO_ORIGEN"].'</p>
                    <p><b>Destino o Punto de Interés: </b>'.$cotizaciones[0]["BARRIO_DESTINO"].', '.$cotizaciones[0]["PUNTO_DESTINO"].'</p>
                    <p><b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>';
                }else if($TIPO_VIAJE == "Fiesta o Evento - Vuelta"){
                    echo '
                    <h3>Datos de la Vuelta:</h3>
                    <p><b>Fecha de vuelta: </b>'.$fecha_regreso.'</p>
                    <p><b>Hora: </b>'.$cotizaciones[0]["HORA"].'</p>
                    <p><b>Origen o Punto de Interés: </b>'.$cotizaciones[0]["BARRIO_ORIGEN"].', '.$cotizaciones[0]["PUNTO_ORIGEN"].'</p>
                    <p><b>Destino: </b>'.$cotizaciones[0]["LOCALIDAD_DESTINO"].', '.$cotizaciones[0]["BARRIO_DESTINO"].', '.$cotizaciones[0]["DIRECCION_DESTINO"].'</p>
                    <p><b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>';
                }else if($TIPO_VIAJE == "Fiesta o Evento - Ida y Vuelta"){
                    echo '
                    <h2>Datos de la Ida:</h2>
                    <p><b>Fecha de ida: </b>'.$fecha_salida.'</p>
                    <p><b>Hora: </b>'.$cotizaciones[0]["HORA_SALIDA"].'</p>
                    <p><b>Origen: </b>'.$cotizaciones[0]["LOCALIDAD_ORIGEN"].', '.$cotizaciones[0]["BARRIO_ORIGEN"].'</p>
                    <p><b>Destino o Punto de Interés: </b>'.$cotizaciones[0]["BARRIO_DESTINO"].', '.$cotizaciones[0]["PUNTO_DESTINO"].'</p>
                    <p><b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>';

                    echo '
                    <h2>Datos de la Vuelta:</h2>
                    <p><b>Fecha de vuelta: </b>'.$fecha_regreso.'</p>
                    <p><b>Hora: </b>'.$cotizaciones[0]["HORA_REGRESO"].'</p>
                    <p><b>Origen o Punto de Interés: </b>'.$cotizaciones[0]["BARRIO_ORIGEN"].', '.$cotizaciones[0]["PUNTO_ORIGEN"].'</p>
                    <p><b>Destino: </b>'.$cotizaciones[0]["LOCALIDAD_DESTINO"].', '.$cotizaciones[0]["BARRIO_DESTINO"].', '.$cotizaciones[0]["DIRECCION_DESTINO"].'</p>
                    <p><b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>';
                }else{
                    echo '
                    <p><b>Fecha de Salida: </b>'.$fecha_salida.'</p>
                    <p><b>Hora: </b>'.$cotizaciones[0]["HORA"].'</p>
                    <p><b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>';
                }

                if($TIPO_VIAJE == "Transfer de Arribo"){
                    echo '
                    <p><b>Aeropuerto / Puerto: </b>'.$cotizaciones[0]['LOCALIDAD_ORIGEN'].'</p>
                    <p><b>Destino: </b>'.$cotizaciones[0]["LOCALIDAD_DESTINO"].', '.$cotizaciones[0]["BARRIO_DESTINO"].'</p>';
                }
                if($TIPO_VIAJE == "Transfer de Partida"){
                    echo '
                    <p><b>Origen: </b>'.$cotizaciones[0]['LOCALIDAD_ORIGEN'].','.$cotizaciones[0]['BARRIO_ORIGEN'].'</p>
                    <p><b>Aeropuerto / Puerto: </b>'.$cotizaciones[0]["LOCALIDAD_DESTINO"].', '.$cotizaciones[0]["BARRIO_DESTINO"].'</p>';
                }
                
                if($TIPO_VIAJE == "Traslado"){
                    echo '<p><b>Origen: </b>'.$cotizaciones[0]["LOCALIDAD_ORIGEN"].', '.$cotizaciones[0]["BARRIO_ORIGEN"].'</p>';
                }else if($TIPO_VIAJE == "Tour o Servicio por Hora"){
                    echo '<p><b>Origen: </b>'.$cotizaciones[0]["LOCALIDAD_ORIGEN"].', '.$cotizaciones[0]["BARRIO_ORIGEN"].'</p>';
                }
                
                if($TIPO_VIAJE == "Tour o Servicio por Hora"){
                    echo '<p><b>Ciudad del Servicio: </b>'.$cotizaciones[0]["BARRIO_DESTINO"].'</p>';
                    echo '<p><b>Duración del Servicio en horas: </b>'.$cotizaciones[0]["DURACION"].'</p>';
                }

                if($TIPO_VIAJE == "Traslado"){
                    echo '<p><b>Destino o Punto de Interés: </b>'.$cotizaciones[0]["LOCALIDAD_DESTINO"].', '.$cotizaciones[0]["BARRIO_DESTINO"].', '.$cotizaciones[0]["DIRECCION_DESTINO"].'</p>';
                }
                

                if(isset($paradas_ida_array) || isset($paradas_vuelta_array)){    

                    if(isset($paradas_ida_array)){
                        if(count($paradas_ida_array,true) > 0){
                            echo '<p><b>Paradas (Ida): </b>';
                        
                            for($a = 0; $a < count($paradas_ida_array); $a++){
                                if($paradas_ida_array[$a] != ""){
                                    if($a == (count($paradas_ida_array) - 1)){
                                        $mail->Body .= $paradas_ida_array[$a] . '.';
                                    }else{
                                        $mail->Body .= $paradas_ida_array[$a] . ', ';
                                    }
                                }
                            }
                            echo '</p>';
                        }
                    }

                    if(isset($paradas_vuelta_array)){
                        if(count($paradas_vuelta_array,true) > 0){
                            echo '<p><b>Paradas (Vuelta): </b>';
                        
                            for($a = 0; $a < count($paradas_vuelta_array); $a++){
                                if($paradas_vuelta_array[$a] != ""){
                                    if($a == (count($paradas_vuelta_array) - 1)){
                                        $mail->Body .= $paradas_vuelta_array[$a] . '.';
                                    }else{
                                        $mail->Body .= $paradas_vuelta_array[$a] . ', ';
                                    }
                                }
                            }
                            echo '</p>';
                        }
                    }
                }

                if(isset($cotizaciones[0]['OBSERVACIONES'])){
                    if($cotizaciones[0]['OBSERVACIONES'] != ""){
                        echo '<h2>Observaciones:</h2>
                        <p>'.$cotizaciones[0]['OBSERVACIONES'].'</p>';
                    }
                }
                if(isset($cotizaciones[0]['MASCOTAS'])){
                    echo '<h2>Mascotas:</h2>';
                    if($cotizaciones[0]['MASCOTAS'] == "Con mascota"){
                      echo '<p>Admitidas</p>';
                    }else{
                      echo '<p>No Admitidas</p>';
                    }
                }
              ?>
            </div>
          </div>
        </div>
    </section>

    <div id="footer"></div>
  </body>
</html>
