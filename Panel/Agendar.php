<?php 

$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');

  }else{
    if($_SESSION['tipo_usuario'] == "Pasajero"){
      header('Location: https://www.salioviaje.com.uy/');
    }
  }

  require_once '../PHP/procedimientosBD.php';
  $regiones_mtop = new procedimientosBD();
  $regiones_mtop = json_decode($regiones_mtop->traer_regiones_mtop(), true);
  $rutas = new procedimientosBD();
  $rutas = json_decode($rutas->traer_rutas_mtop(), true);
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Agendar Viaje</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Agendar" />
    <meta property="og:title" content="SalióViaje | Agendar Viaje" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Agendar" />
    <meta
      property="twitter:title"
      content="SalióViaje | Agendar Viaje"
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>

    <script src="https://www.salioviaje.com.uy/Javascript/panel.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/agendar.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
    <script type="text/javascript">
        // window.onload = function(){
        //   $("#step-next-1").on('click', function() {
        //     etapa_1();
        //   });
        //   $("#step-next-2").on('click', function() {
        //     etapa_2();
        //   });
        // }
    </script>
  </head>
  <body>
    <div id="pre-loader">
      <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>

    <header class="panel-header" id="header">
      <div class="header-left">
        <div class="header-menu">
          <button onclick="navbar()"><i class="fas fa-bars"></i></button>
        </div>
        <div class="header-title">
          <h2>Agendar Viaje</h2>
        </div>
      </div>
      <div class="header-right">
        <div class="header-user">
          <div class="icon"><img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje"></div>
          <div class="user">
          <h2><?php echo $_SESSION['usuario']; ?></h2> 
          <p><i class="fas fa-user-tie"></i> <?php echo $_SESSION['tipo_usuario'] ?></p>
          </div>
          <button id="cerrar_session_dashboard"><i class="fas fa-sign-out-alt"></i></button>
        </div>
      </div>
    </header>

    <nav class="nav-hidden active" id="panel-navbar"></nav>

    <section class="panel" id="panel">

        <div class="agendarViaje">
          <div class="info-user">
            <div class="column1">
              <div class="user-icon">
                <i class="fas fa-user"></i>
              </div>
              <div class="user-name">
                <h3><?php echo $_SESSION['usuario']; ?></h3>
                <p><i class="fas fa-bus"></i> <?php echo $_SESSION['tipo_usuario']; ?></p>
              </div>
            </div>
            <div class="column2">
              <div>
                <p><i class="fas fa-address-card"></i> <?php echo $_SESSION['datos_usuario']['CI']; ?></p>
                <p><i class="fas fa-phone"></i> 0<?php echo $_SESSION['datos_usuario']['TELEFONO']; ?></p>
                <p><i class="fas fa-map-marker-alt"></i> <?php echo $_SESSION['datos_usuario']['BARRIO'].", ".$_SESSION['datos_usuario']['DEPARTAMENTO']; ?></p>
              </div>
            </div>
          </div>

          <h2 class="step_title"><i class="fas fa-book"></i> Agendar Viaje</h2>
          
          <div id="step_1">
            <div class="inputs-wrapper-agendar">

            <div class="column">

                <div class="vehicle">
                  <div class="vehicle-icon">
                    <i class="fas fa-bus"></i>
                  </div>
                  <div class="vehicle-info">
                    <h3><i class="fas fa-info"></i> Información del Vehículo</h3>
                    <p class="matricula"><i class="fas fa-address-card"></i></p>
                    <p class="marca"><i class="fas fa-car"></i></p>
                    <p class="modelo"><i class="fas fa-list"></i></p>
                    <p class="capacidad"><i class="fas fa-users"></i></p>
                    <p class="combustible"><i class="fas fa-gas-pump"></i></p>
                  </div>
                </div>

                <div class="empty-list">
                  <p>No hay ningun vehículo seleccionado.</p>
                </div>

              </div>
              <!--


              formularios


              -->
              <div class="column">
                <div class="input" id="vehiculos">
                  <i class="fas fa-bus" id="icon"></i>
                  <select name="" id="vehiculos-select">
                    <option value="0" selected disabled hidden>Seleccione un Vehículo</option>
                  </select>
                </div>

                <div class="input" id="pasajeros">
                  <i class="fas fa-user-friends" id="icon"></i>
                  <input type="number" pattern="[1-9]" min="0" id="pasajeros-input" placeholder="Cantidad de Pasajeros" oninput="this.value = Math.abs(this.value)" onkeyup="precio_referencia();"/>
                </div>

                <div class="input" id="km">
                  <i class="fas fa-road" id="icon"></i>
                  <input type="number" pattern="[1-9]" min="0" id="distancia-input" placeholder="Distancia del Viaje" oninput="this.value = Math.abs(this.value)" onkeyup="precio_referencia();"/>
                  <p id="end-text">km</p>
                </div>

              </div>
            </div>
            <p id="mensaje-error1" class="mensaje-error"></p>
          </div>
          
          <div id="step_2">
            <p id="mensaje-agenda-info"></p>

            <div class="inputs-wrapper-agendar">
              <div class="column">
                <h2 class="step_title"><i class="fas fa-road"></i> Tramo N° 1</h2>

                <div class="input" id="tipo">
                  <i class="fas fa-list-ul" id="icon"></i>
                  <select name="" id="tipo-select_1" onchange="select_tipo(1)">
                    <option value="0" selected disabled hidden>Seleccione un Tipo</option>
                    <option value="1" >Agendar</option>
                    <option value="2" >Oportunidad</option>
                  </select>
                </div>

                <div class="input" id="descuento1">
                  <i class="fas fa-tags" id="icon"></i>
                  <select name="" id="desc_oport1" placeholder="Descuento de la Oportunidad">
                    <option value="0" disabled selected hidden>Seleccione un Descuento</option>
                    <option value="50">50%</option>
                    <option value="60">60%</option>
                    <option value="70">70%</option>
                    <option value="80">80%</option>
                    <option value="90">90%</option>
                  </select>
                </div>

                <div class="input" id="origen">
                  <i class="far fa-calendar-alt" id="icon"></i>
                  <input type="datetime-local" id="fecha_1" placeholder="Fecha y Hora" onchange="calcular_hora()" />
                </div>

                <div class="input" id="origen">
                  <i class="fas fa-map-marker-alt" id="icon"></i>
                  <input list="RegionesMTOP" id="origen_1" placeholder="Origen" onchange="select_origen_destino(1)">
                  <datalist id="RegionesMTOP">
                        <?php
                          if (isset($regiones_mtop)) {
                            for ($i=0; $i < count($regiones_mtop); $i++) { 
                            ?>
                            <option value="<?php echo trim($regiones_mtop[$i]['REGION'],' ').", ".$regiones_mtop[$i]['DPTO'] ?>">
                            <?php
                            }
                          }
                        ?>
                  </datalist>
                </div>

                <div class="input" id="destino">
                  <i class="fas fa-route" id="icon"></i>
                  <input list="RegionesMTOP" id="destino_1" placeholder="Destino" onchange="select_origen_destino(2)"> 
                </div>

                <div class="input" id="precioref">
                  <i class="fas fa-dollar-sign" id="icon"></i>
                  <input type="number" id="precioref_1" placeholder="Precio de Referencia" onchange="checkInput(1)"  oninput="this.value = Math.abs(this.value)" />
                </div>
              </div>

              <div class="column">
                <h2 class="step_title"><i class="fas fa-road"></i> Tramo N° 2</h2>

                <div class="input" id="tipo">
                  <i class="fas fa-list-ul" id="icon"></i>
                  <select name="" id="tipo-select_2" onchange="select_tipo(2)">
                    <option value="0" selected disabled hidden>Seleccione un Tipo</option>
                    <option value="1" >Agendar</option>
                    <option value="2" >Oportunidad</option>
                  </select>
                </div>

                <div class="input" id="descuento2">
                  <i class="fas fa-tags" id="icon"></i>
                  <select name="" id="desc_oport2" placeholder="Descuento de la Oportunidad">
                    <option value="0" disabled selected hidden>Seleccione un Descuento</option>
                    <option value="50">50%</option>
                    <option value="60">60%</option>
                    <option value="70">70%</option>
                    <option value="80">80%</option>
                    <option value="90">90%</option>
                  </select>
                </div>

                <div class="input" id="origen">
                  <i class="far fa-calendar-alt" id="icon"></i>
                  <input type="datetime-local" id="fecha_2" placeholder="Fecha y Hora" onchange="calcular_hora_invertido()" />
                </div>

                <div class="input" id="origen">
                  <i class="fas fa-map-marker-alt" id="icon"></i>
                  <input list="RegionesMTOP" id="origen_2" placeholder="Origen" onchange="select_origen_destino(3)">
                </div>

                <div class="input" id="destino">
                  <i class="fas fa-route" id="icon"></i>
                  <input list="RegionesMTOP" id="destino_2" placeholder="Destino" onchange="select_origen_destino(4)">
                </div>

                <div class="input" id="precioref">
                  <i class="fas fa-dollar-sign" id="icon"></i>
                  <input type="number" id="precioref_2" placeholder="Precio de Referencia" onchange="checkInput(2)"  oninput="this.value = Math.abs(this.value)" />
                </div>

              </div>
            </div>
            <p id="mensaje-error2" class="mensaje-error"></p>
          </div>

          <div id="step_3">
            <div class="inputs-wrapper-agendar-rutas">
              <div class="column">
                <h2 class="step_title"><i class="fas fa-road"></i> Rutas</h2>
                
                <div class="input" id="rutas">
                  <i class="fas fa-road" id="icon"></i>
                  <input list="Rutas" id="rutas_1" placeholder="Rutas" onchange="rutas()">
                  <datalist id="Rutas">
                    <?php
                      if (isset($rutas)) {
                        for ($i=0; $i < count($rutas); $i++) { 
                          ?>
                            <option value="<?php echo $rutas[$i]['RUTA'] ?>">
                          <?php
                        }
                      }
                    ?>
                  </datalist> 
                </div>

                <div class="tags" id="tags_1">
                </div>

              </div>
            </div>
            <p id="mensaje-error3" class="mensaje-error"></p>

            <button class="button-agendar" id="button_volver" onclick="volver()">
              <i class="fas fa-arrow-circle-left"></i> Volver
            </button>
            <button class="button-agendar" id="step-agendar" onclick="cargar_vista_previa()">
              <i class="fas fa-book"></i> Agendar
            </button>
            <button class="button-agendar" id="step-agendar_MTOP_vista_previa" onclick="verificar_rutas_para_MTOP()">
              <i class="fas fa-id-card"></i> Agendar con MTOP
            </button>
          </div>

          <div id="step_4">
            <hr>

            <div class="vehicle-resumen">
              <div class="vehicle-icon">
                <i class="fas fa-bus"></i>
              </div>
              <div class="vehicle-info">
                <h3><i class="fas fa-info"></i> Información del Vehículo</h3>
                    <p class="matricula"><i class="fas fa-address-card"></i></p>
                    <p class="marca"><i class="fas fa-car"></i></p>
                    <p class="modelo"><i class="fas fa-list"></i></p>
                    <p class="capacidad"><i class="fas fa-users"></i></p>
                    <p class="combustible"><i class="fas fa-gas-pump"></i></p>
              </div>
            </div>

            <hr>

            <h2 class="step_title"><i class="fas fa-compass"></i> Información del Viaje</h2>
            
            <div class="info">
              <p class="pasajeros"><i class="fas fa-user-friends"></i> 13</p>
              <p class="distancia"><i class="fas fa-road"></i> 120km</p>
              <p class="mtop"><i class="fas fa-address-card"></i> MTOP: No</p>
            </div>           

            <div class="inputs-wrapper-agendar">
              
              <div class="column_resumen">
                <div class="column-wrapper">
                  <h2 class="step_title"><i class="fas fa-road"></i> Tramo N° 1</h2>
                  
                  <div class="info">
                    <b><i class="fas fa-list-ul"></i> Tipo</b>
                    <p class="tipo_1">Oportunidad</p>
                  </div>

                  <div class="info">
                    <b><i class="fas fa-tags"></i> Porcentaje de Descuento</b>
                    <p class="porcentaje_1">50%</p>
                  </div>
                  
                  <div class="info">
                    <b><i class="far fa-calendar-alt"></i> Fecha y Hora</b>
                    <p class="fecha_1">18/02/22 18:30</p>
                  </div>
                  <div class="info">
                    <b><i class="fas fa-map-marker-alt"></i> Origen</b>
                    <p class="origen_1">Montevideo</p>
                  </div>
                  <div class="info">
                    <b><i class="fas fa-route"></i> Destino</b>
                    <p class="destino_1">Maldonado</p>
                  </div>
                  <div class="info">
                    <b><i class="fas fa-dollar-sign"></i> Precio</b>
                    <p class="precio_1">$4080</p>
                  </div>
                </div>
              </div>

              <div class="column_resumen">
                <div class="column-wrapper">
                  <h2 class="step_title"><i class="fas fa-road"></i> Tramo N° 2</h2>
                  
                  <div class="info">
                    <b><i class="fas fa-list-ul"></i> Tipo</b>
                    <p class="tipo_2"></p>
                  </div>

                  <div class="info">
                    <b><i class="fas fa-tags"></i> Porcentaje de Descuento</b>
                    <p class="porcentaje_2">40%</p>
                  </div>
                  
                  <div class="info">
                    <b><i class="far fa-calendar-alt"></i> Fecha y Hora</b>
                    <p class="fecha_2">19/02/22 03:30</p>
                  </div>
                  <div class="info">
                    <b><i class="fas fa-map-marker-alt"></i> Origen</b>
                    <p class="origen_2">Maldonado</p>
                  </div>
                  <div class="info">
                    <b><i class="fas fa-route"></i> Destino</b>
                    <p class="destino_2">Montevideo</p>
                  </div>
                  <div class="info">
                    <b><i class="fas fa-dollar-sign"></i> Precio</b>
                    <p class="precio_2">$4080</p>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="rutas">
              <b><i class="fas fa-route"></i> Rutas</b>
              <p class="rutas_ingresadas"></p>
            </div>
            <div class="button-wrapper">
              <button class="button-agendar" id="button_volver" onclick="volver()">
                <i class="fas fa-arrow-circle-left"></i> Volver
              </button>
              <button class="button-agendar" id="step-agendar_MTOP" onclick="finalizar()">
                <i class="fas fa-check"></i> Finalizar
              </button>
            </div>
          </div>

        </div>
    </section>
  </body>
</html>
