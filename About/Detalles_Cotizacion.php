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

  $cotizacion = new procedimientosBD();
  $cotizaciones = json_decode($cotizacion->traer_viajes_cotizando_por_id($_GET['ID']), true);
  $paradas = json_decode($cotizacion->traer_paradas_viajes_cotizando_por_id($_GET['ID']), true);
  $solicitante = $cotizacion->info_usuario_profile($cotizaciones[0]['ID_SOLICITANTE']);

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
    <meta name="robots" content="noindex,nofollow"/>
    <meta name="author" content="Daniel Schlebinger" />

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
    <link rel="stylesheet" href="https://www.salioviaje.com.uy/styles/styles.min.css" />

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
    <a href="https://wa.link/mxnwzm" target="_BLANK" id="whatsapp-float">
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
                        echo "<button class='cotizar-button' onclick='location.href= \"https://www.salioviaje.com.uy/Cotizar/" . $_GET['ID'] . "\"'><i class='fas fa-chart-line'></i> Cotizar</button>";                     
                    }
                }else{
                  echo "<button class='cotizar-button' onclick='location.href= \"https://www.salioviaje.com.uy/Login\"'><i class='fas fa-chart-line'></i> Cotizar</button>";                     
                }

               ?>
            </div>
          </div>
          <div class="cotizacion-content">

            <div class="cotizacion-info">
              <?php
              echo '<p><i class="fas fa-address-card"></i> <b>N° de Viaje: </b>'.$cotizaciones[0]['ID'].'</p>
                    <p><i class="fas fa-list-ol"></i> <b>Tipo de Viaje: </b>'.$TIPO_VIAJE.'</p>';
              
                if($TIPO_VIAJE == "Transfer de Arribo"){
                    echo '
                    <p><i class="fas fa-calendar-days"></i> <b>Fecha del Arribo: </b>'.$fecha_salida.'</p>
                    <p><i class="fas fa-clock"></i> <b>Hora del Arribo: </b>'.$cotizaciones[0]["HORA"].'</p>
                    <p><i class="fas fa-ticket"></i> <b>Número del Vuelo / Barco: </b>'.$cotizaciones[0]["NRO_BARCO_VUELO"].'</p>
                    <p><i class="fas fa-people-group"></i> <b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>
                    <p><i class="fas fa-briefcase"></i> <b>Cantidad de Equipaje: </b>'.$cotizaciones[0]["EQUIPAJE"].'</p>';
                }else if($TIPO_VIAJE == "Transfer de Partida"){
                    echo '
                    <p><i class="fas fa-calendar-days"></i> <b>Fecha del Partida: </b>'.$fecha_salida.'</p>
                    <p><i class="fas fa-clock"></i> <b>Hora para pasar a buscar: </b>'.$cotizaciones[0]["HORA"].'</p>
                    <p><i class="fas fa-ticket"></i> <b>Número del Vuelo / Barco: </b>'.$cotizaciones[0]["NRO_BARCO_VUELO"].'</p>
                    <p><i class="fas fa-people-group"></i> <b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>
                    <p><i class="fas fa-briefcase"></i> <b>Cantidad de Equipaje: </b>'.$cotizaciones[0]["EQUIPAJE"].'</p>';
                }else if($TIPO_VIAJE == "Fiesta o Evento - Ida"){
                    echo '
                    <h3><i class="fas fa-arrow-up"></i> Datos de la Ida:</h3>
                    <p><i class="fas fa-calendar-days"></i> <b>Fecha de ida: </b>'.$fecha_salida.'</p>
                    <p><i class="fas fa-clock"></i> <b>Hora: </b>'.$cotizaciones[0]["HORA"].'</p>
                    <p><i class="fas fa-location-dot"></i> <b>Origen: </b>'.$cotizaciones[0]["LOCALIDAD_ORIGEN"].', '.$cotizaciones[0]["BARRIO_ORIGEN"].'</p>
                    <p><i class="fas fa-route"></i> <b>Destino o Punto de Interés: </b>'.$cotizaciones[0]["BARRIO_DESTINO"].', '.$cotizaciones[0]["PUNTO_DESTINO"].'</p>
                    <p><i class="fas fa-people-group"></i> <b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>';
                }else if($TIPO_VIAJE == "Fiesta o Evento - Vuelta"){
                    echo '
                    <h3><i class="fas fa-arrow-down"></i> Datos de la Vuelta:</h3>
                    <p><i class="fas fa-calendar-days"></i> <b>Fecha de vuelta: </b>'.$fecha_regreso.'</p>
                    <p><i class="fas fa-clock"></i> <b>Hora: </b>'.$cotizaciones[0]["HORA"].'</p>
                    <p><i class="fas fa-location-dot"></i> <b>Origen o Punto de Interés: </b>'.$cotizaciones[0]["BARRIO_ORIGEN"].', '.$cotizaciones[0]["PUNTO_ORIGEN"].'</p>
                    <p><i class="fas fa-route"></i> <b>Destino: </b>'.$cotizaciones[0]["LOCALIDAD_DESTINO"].', '.$cotizaciones[0]["BARRIO_DESTINO"].', '.$cotizaciones[0]["DIRECCION_DESTINO"].'</p>
                    <p><i class="fas fa-people-group"></i> <b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>';
                }else if($TIPO_VIAJE == "Fiesta o Evento - Ida y Vuelta"){
                    echo '
                    <h2><i class="fas fa-arrow-up"></i> Datos de la Ida:</h2>
                    <p><i class="fas fa-calendar-days"></i> <b>Fecha de ida: </b>'.$fecha_salida.'</p>
                    <p><i class="fas fa-clock"></i> <b>Hora: </b>'.$cotizaciones[0]["HORA"].'</p>
                    <p><i class="fas fa-location-dot"></i> <b>Origen: </b>'.$cotizaciones[0]["LOCALIDAD_ORIGEN"].', '.$cotizaciones[0]["BARRIO_ORIGEN"].'</p>
                    <p><i class="fas fa-route"></i> <b>Destino o Punto de Interés: </b>'.$cotizaciones[0]["LOCALIDAD_DESTINO"].', '.$cotizaciones[0]["BARRIO_DESTINO"].', '.$cotizaciones[0]["DIRECCION_DESTINO"].'</p>
                    <p><i class="fas fa-people-group"></i> <b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>';

                    if(isset($paradas)){
                      $paradas_ida_array = array();

                      for($a = 0; $a < count($paradas); $a++){
                        if($paradas[$a]['TRAMO'] == "ida"){
                          array_push($paradas_ida_array, $paradas[$a]['CONTENIDO']);
                        }
                      }

                      if(count($paradas_ida_array) > 0){
                        echo '<p><i class="fas fa-flag"></i> <b>Paradas (Ida): </b>';
                    
                        for($a = 0; $a < count($paradas_ida_array); $a++){
                            if($paradas_ida_array[$a] != ""){
                                if($a == (count($paradas_ida_array) - 1)){
                                  echo $paradas_ida_array[$a] . '.';
                                }else{
                                  echo $paradas_ida_array[$a] . ', ';
                                }
                            }
                        }
                        echo '</p>';
                      }
                    }else{
                      echo '<p><i class="fas fa-flag"></i> <b>Paradas (Ida): No hay paradas.</b>';
                    }

                    echo '
                    <h2><i class="fas fa-arrow-down"></i> Datos de la Vuelta:</h2>
                    <p><i class="fas fa-calendar-days"></i> <b>Fecha de vuelta: </b>'.$fecha_regreso.'</p>
                    <p><i class="fas fa-clock"></i> <b>Hora: </b>'.$cotizaciones[0]["HORA_REGRESO"].'</p>
                    <p><i class="fas fa-location-dot"></i> <b>Origen o Punto de Interés: </b>'.$cotizaciones[0]["LOCALIDAD_ORIGEN_VUELTA"].', '.$cotizaciones[0]["BARRIO_ORIGEN_VUELTA"].', '.$cotizaciones[0]["DIRECCION_ORIGEN_VUELTA"].'</p>
                    <p><i class="fas fa-route"></i> <b>Destino: </b>'.$cotizaciones[0]["LOCALIDAD_DESTINO_VUELTA"].', '.$cotizaciones[0]["BARRIO_DESTINO_VUELTA"].'</p>
                    <p><i class="fas fa-people-group"></i> <b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>';

                    if(isset($paradas)){
                      $paradas_vuelta_array = array();

                      for($a = 0; $a < count($paradas); $a++){
                        if($paradas[$a]['TRAMO'] == "vuelta"){
                          array_push($paradas_vuelta_array, $paradas[$a]['CONTENIDO']);
                        }
                      }

                      if(count($paradas_vuelta_array) > 0){
                        echo '<p><i class="fas fa-flag"></i> <b>Paradas (Vuelta): </b>';
                    
                        for($a = 0; $a < count($paradas_vuelta_array); $a++){
                            if($paradas_vuelta_array[$a] != ""){
                                if($a == (count($paradas_vuelta_array) - 1)){
                                  echo $paradas_vuelta_array[$a] . '.';
                                }else{
                                  echo $paradas_vuelta_array[$a] . ', ';
                                }
                            }
                        }
                        echo '</p>';
                      }
                    }else{
                      echo '<p><i class="fas fa-flag"></i> <b>Paradas (Vuelta): No hay paradas.</b>';
                    }

                    
                }else{
                    echo '
                    <p><i class="fas fa-calendar-days"></i> <b>Fecha de Salida: </b>'.$fecha_salida.'</p>
                    <p><i class="fas fa-clock"></i> <b>Hora:</b>'.$cotizaciones[0]["HORA"].'</p>
                    <p><i class="fas fa-people-group"></i> <b>Cantidad de Pasajeros: </b>'.$cotizaciones[0]["CANTIDAD_PASAJEROS"].'</p>';
                }

                if($TIPO_VIAJE == "Transfer de Arribo"){
                    echo '
                    <p><i class="fas fa-plane"></i> <b>Aeropuerto / Puerto: </b>'.$cotizaciones[0]['LOCALIDAD_ORIGEN'].'</p>
                    <p><i class="fas fa-route"></i> <b>Destino: </b>'.$cotizaciones[0]["LOCALIDAD_DESTINO"].', '.$cotizaciones[0]["BARRIO_DESTINO"].'</p>';
                }
                if($TIPO_VIAJE == "Transfer de Partida"){
                    echo '
                    <p><i class="fas fa-location-dot"></i> <b>Origen: </b>'.$cotizaciones[0]['LOCALIDAD_ORIGEN'].','.$cotizaciones[0]['BARRIO_ORIGEN'].'</p>
                    <p><i class="fas fa-plane"></i> <b>Aeropuerto / Puerto: </b>'.$cotizaciones[0]["LOCALIDAD_DESTINO"].', '.$cotizaciones[0]["BARRIO_DESTINO"].'</p>';
                }
                
                if($TIPO_VIAJE == "Traslado"){
                    echo '<p><i class="fas fa-location-dot"></i> <b>Origen: </b>'.$cotizaciones[0]["LOCALIDAD_ORIGEN"].', '.$cotizaciones[0]["BARRIO_ORIGEN"].'</p>';
                }else if($TIPO_VIAJE == "Tour o Servicio por Hora"){
                    echo '<p><i class="fas fa-location-dot"></i> <b>Origen: </b>'.$cotizaciones[0]["LOCALIDAD_ORIGEN"].', '.$cotizaciones[0]["BARRIO_ORIGEN"].'</p>';
                }
                
                if($TIPO_VIAJE == "Tour o Servicio por Hora"){
                    echo '<p><i class="fas fa-city"></i> <b>Ciudad del Servicio: </b>'.$cotizaciones[0]["BARRIO_DESTINO"].'</p>';
                    echo '<p><i class="fas fa-stopwatch"></i> <b>Duración del Servicio en horas: </b>'.$cotizaciones[0]["DURACION"].'</p>';
                }

                if($TIPO_VIAJE == "Traslado"){
                    echo '<p><i class="fas fa-route"></i> <b>Destino o Punto de Interés: </b>'.$cotizaciones[0]["LOCALIDAD_DESTINO"].', '.$cotizaciones[0]["BARRIO_DESTINO"].', '.$cotizaciones[0]["DIRECCION_DESTINO"].'</p>';
                }

                if(isset($paradas) && $TIPO_VIAJE != "Fiesta o Evento - Ida y Vuelta"){
                    $paradas_ida_array = array();
                    $paradas_vuelta_array = array();

                    for($a = 0; $a < count($paradas); $a++){
                      if($paradas[$a]['TRAMO'] == "ida"){
                        array_push($paradas_ida_array, $paradas[$a]['CONTENIDO']);
                      }else if($paradas[$a]['TRAMO'] == "vuelta"){
                        array_push($paradas_vuelta_array, $paradas[$a]['CONTENIDO']);
                      }
                    }

                    if(count($paradas_ida_array) > 0){
                      echo '<p><i class="fas fa-flag"></i> <b>Paradas (Ida): </b>';
                  
                      for($a = 0; $a < count($paradas_ida_array); $a++){
                          if($paradas_ida_array[$a] != ""){
                              if($a == (count($paradas_ida_array) - 1)){
                                echo $paradas_ida_array[$a] . '.';
                              }else{
                                echo $paradas_ida_array[$a] . ', ';
                              }
                          }
                      }
                      echo '</p>';
                    }

                    if(count($paradas_vuelta_array) > 0){
                      echo '<p><i class="fas fa-flag"></i> <b>Paradas (Vuelta): </b>';
                  
                      for($a = 0; $a < count($paradas_vuelta_array); $a++){
                          if($paradas_ida_array[$a] != ""){
                              if($a == (count($paradas_vuelta_array) - 1)){
                                echo $paradas_vuelta_array[$a] . '.';
                              }else{
                                echo $paradas_vuelta_array[$a] . ', ';
                              }
                          }
                      }
                      echo '</p>';
                    }
                }else if(!isset($paradas) && $TIPO_VIAJE != "Fiesta o Evento - Ida y Vuelta"){
                  echo '<p><i class="fas fa-flag"></i> <b>Paradas: </b>No hay paradas.</p>';
                }

                if(isset($cotizaciones[0]['OBSERVACIONES'])){
                    if($cotizaciones[0]['OBSERVACIONES'] != ""){
                        echo '<p><i class="fas fa-comment-dots"></i> <b>Observaciones: </b>'.$cotizaciones[0]['OBSERVACIONES'].'</p>';
                    }else{
                      echo '<p><i class="fas fa-comment-dots"></i> <b>Observaciones: </b>No</p>';
                    }
                }else{
                  echo '<p><i class="fas fa-comment-dots"></i> <b>Observaciones: </b>No</p>';
                }
                if(isset($cotizaciones[0]['MASCOTAS'])){
                    if($cotizaciones[0]['MASCOTAS'] == "Con mascota"){
                      echo '<p><i class="fas fa-dog"></i> <b>Mascotas: </b>Con Mascotas</p>';
                    }else{
                      echo '<p><i class="fas fa-dog"></i> <b>Mascotas: </b>No</p>';
                    }
                }
                if($_SESSION['tipo_usuario'] == "Administrador"){
                  echo '<h2><i class="fas fa-id-card"></i> Información del Solicitante:</h2>
                  <p><i class="fas fa-user"></i> <b>Nombre del Solicitante: </b>'.$solicitante[0]['NOMBRE'].''.$solicitante[0]['APELLIDO'].'</p>
                  <p><i class="fas fa-phone"></i> <b>Teléfono: </b><a href="tel:0'.$solicitante[0]['TELEFONO'].'">0'.$solicitante[0]['TELEFONO'].'</a></p>
                  <p><i class="fas fa-envelope"></i> <b>Mail: </b><a href="mailto:'.$solicitante[0]['EMAIL'].'">'.$solicitante[0]['EMAIL'].'</a></p>
                  <p><i class="fas fa-map-location-dot"></i> <b>Dirección: </b>'.$solicitante[0]['DEPARTAMENTO'].', '.$solicitante[0]['BARRIO'].'</p>';  
                }
                ?>
            </div>
          </div>
        </div>
    </section>

    <div id="footer"></div>
  </body>
</html>
