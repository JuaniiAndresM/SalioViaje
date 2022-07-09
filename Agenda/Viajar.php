<?php
$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
session_start();

require_once '../PHP/procedimientosBD.php';
$regiones_mtop = new procedimientosBD();
$barrios = json_decode($regiones_mtop->traer_barrios(), true);
$regiones = json_decode($regiones_mtop->traer_regiones_mtop(), true);
?>


<head> 
   <!-- ==================================================================== -->
    <title>Salió Viaje | Cartelera Viajes Rebajados | No Lo Dejes Pasar</title>
    <meta name="description" content="No te pierdas la Cartelera de Oportunidades con el 50 hasta el 90% OFF ni la de Ofertas con el 10 al 40% OFF se venden rápido, van y vienen."/>
    <meta name="keywords" content="Salió Viaje | Cartelera Viajes Rebajados | No Dejes Pasar"/>
    <meta name="robots" content="index,follow"/>

    
    
    <!-- ==================================================================== -->   
    
    <!-- // Meta Etiquetas -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <meta name="author" content="Daniel Schlebinger" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.salioviaje.com.uy" />
    <meta property="og:title" content="Salió Viaje | Plataforma que optimiza el traslado ocasional de personas" />
    <meta property="og:description" content="Plataforma que optimiza el traslado ocasional de personas."/>
    <meta property="og:image" content="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg" type="image/x-icon"  title="Logo | Salió Viaje" >

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://www.salioviaje.com.uy" />
    <meta property="twitter:title" content="Salió Viaje | Plataforma que optimiza el traslado ocasional de personas"/>
    <meta property="twitter:description" content="Plataforma que optimiza el traslado ocasional de personas."/>
    <meta property="twitter:image" content="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg" type="image/x-icon"  title="Logo | Salió Viaje" >

    <!-- // Fin de Meta Etiquetas -->

    <!-- Links -->
    <link rel="shortcut icon" href="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://www.salioviaje.com.uy/styles/styles.min.css">
    <link rel="publisher" href="https://www.salioviaje.com.uy" />  
    <link rel="canonical" href="https://www.salioviaje.com.uy"/>  
    
    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/1e193e3a23.js" crossorigin="anonymous"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/web.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/viajar.js"></script>
    <script src="https://www.salioviaje.com.uy/Plugins/waypoints/lib/noframework.waypoints.min.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/gurucuteco.js"></script>
    
  </head>
  <body>
    <input type="text" class="session-output" value='<?php if(isset($_SESSION['usuario'])){ echo 0; }else{ echo 1; }; ?>' >
    <input type="text" class="session-input" value='<?php echo $_GET['opcion']; ?>'>

    <script>
      window.onload = function (){
        timeoutformulario(<?php if(isset($_GET['opcion'])){ echo $_GET['opcion']; }else{ echo '""'; }; ?>);
      }

    </script>
    <div id="header"></div>

    <div id="pre-loader">
      <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>

    <div id="modal"></div>
    <div id="gurucuteco"></div>
      <a href="https://www.salioviaje.com.uy/FAQ" title="Frequently Asked Questions"  target="_BLANK" id="faq-float" >
        <i class="fas fa-question" > </i> </a>
      
      <a href="https://wa.link/mxnwzm" title="WhatsApp | Salió Viaje"  target="_BLANK" id="whatsapp-float">
        <img src="https://www.salioviaje.com.uy/media/images/whatsapp.webp" title="WhatsApp | Salió Viaje" alt="Logo WhatsApp | Salió Viaje" /> 
      </a>

    <div class="viajar-wrapper">
      <h1 class="title">¡No se pierda nuestras oportunidades y ofertas!</h1>
      <section class="oportunidades-viajar" id="Oportunidades">
        <h2>
        <i class="fa-solid fa-tags" id="icon"></i> Oportunidades (<span id="contador-oportunidades"></span>)
        </h2>
        <hr />
        <h3 class="description">
          Conseguí las mejores oportunidades con nosotros.
        </h3>
        <div class="oportunidades-wrapper">
          <div class="filter-wrapper">
            <div class="search"></div>

            <div class="button-filtrar">
              <button onclick="filtros(1)"><i class="fas fa-sort-amount-down"></i> Filtrar</button>
            </div>
          </div>

          <div id="filters">

            <div class="input" id="destino">
              <i class="fas fa-location-dot" id="icon"></i>
              <input list="RegionesMTOP" id="origen_oportunidad" placeholder="Origen" onkeyup="filtrar_divs('Oportunidad')" />
              <datalist id="RegionesMTOP">
                        <?php
                          if (isset($regiones)) {
                            for ($i=0; $i < count($regiones); $i++) { 
                            ?>
                            <option value="<?php echo $regiones[$i]['REGION'] ?>">
                            <?php
                            }
                          }
                        ?>
              </datalist>
            </div>

            <div class="input" id="destino">
              <i class="fas fa-route" id="icon"></i>
              <input list="RegionesMTOP" id="destino_oportunidad" placeholder="Destino" onkeyup="filtrar_divs('Oportunidad')" >
            </div>

            <div class="input" id="origen">
              <i class="far fa-calendar-alt" id="icon"></i>
              <input type="date" id="fecha_oportunidad" placeholder="Fecha y Hora" onchange="filtrar_divs('Oportunidad')" />
            </div>

            <button onclick="eliminar_filtros('Oportunidad')"><i class="fas fa-arrows-rotate"></i></button>

          </div>

          <div class="list-empty">
            <p>Lo sentimos, no hay oportunidades disponibles.</p>
          </div>
          <div class="oportunidades-list">
          </div>
        </div>
      </section>
      <section class="ofertas-viajar" id="Ofertas">
        <h2>
          <i class="fa-solid fa-percent" id="icon"></i> Ofertas (0)
        </h2>
        <hr />
        <h3 class="description">Conseguí las mejores ofertas con nosotros.</h3>
        <div class="ofertas-wrapper">

          <div class="filter-wrapper">
            <div class="search">
              <i class="fas fa-search"></i>
              <input
                type="text"
                placeholder="Buscar"
                id="searchbar"
                onkeyup="buscarOportunidades()"
              />
            </div>

            <div class="button-filtrar">
              <button onclick="filtros(2)"><i class="fas fa-sort-amount-down"></i> Filtrar</button>
            </div>
          </div>

          <div id="filters2">

            <div class="input" id="origen">
              <i class="fas fa-location-dot" id="icon"></i>
              <input list="Origen" id="origen_2" placeholder="Origen" />
              <datalist id="Origen">
                <option value="Canelones"></option>
                <option value="Montevideo"></option>
                <option value="Tacuarembó"></option>
                <option value="Maldonado"></option>
                <option value="Rivera"></option>
              </datalist>
            </div>

            <div class="input" id="destino">
              <i class="fas fa-route" id="icon"></i>
              <input list="Destino" id="destino_2" placeholder="Destino">
              <datalist id="Destino">
                <option value="Canelones">
                <option value="Montevideo">
                <option value="Tacuarembó">
                <option value="Maldonado">
                <option value="Rivera">
              </datalist>
            </div>

            <div class="input" id="fecha">
              <i class="far fa-calendar-alt" id="icon"></i>
              <input type="date" id="fecha_2" placeholder="Fecha y Hora" />
            </div>

            <button onclick="eliminar_filtros('Ofertas')"><i class="fas fa-arrows-rotate"></i></button>

          </div>

          <div class="list-empty2">
            <p>Lo sentimos, de momento no hay ofertas disponibles.</p>
          </div>

          <div class="ofertas-list">

            <div class="oportunidad_oferta">
              <div class="oportunidad-left">
                <div class="id">
                  <h3>#034</h3>
                </div>
                <div class="travel">
                  <p><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Origen: Montevideo.</p>
                  <p><i class="fas fa-route" aria-hidden="true"></i> Destino: Maldonado.</p>
                </div>
                <div class="travel">
                <p><i class="fa-solid fa-road"></i> Tramo: Ida.</p>
                  <p><i class="far fa-calendar-alt" aria-hidden="true"></i> 30/08/2022</p>
                </div>
                <div class="travel">
                  <p class="precio"><i class="fa-solid fa-hand-holding-dollar"></i> $9.000</p>
                </div>
              </div>

              <div class="oportunidad-right">

                <div class="travel">
                  <h2 class="discount">
                    40%
                  </h2>
                  <h4>¡DE DESCUENTO!</h4>
                </div>

                <div class="button-wrapper">
                    <button><i class="fas fa-info" aria-hidden="true"></i> Detalles</button>
                </div>

              </div>
            </div>

          </div>
        </div>
      </section>

      <section class="salioviaje" id="Cotizacion">
        <h2>
        <i class="fa-solid fa-hand-holding-dollar" id="icon"></i> Solicitar una Cotización
        </h2>
        <hr />
        <h3 class="description">
          Es gratis y sin compromiso. ¡No te lo pierdas!
        </h3>
        <button id="agendar" class="button-agendar" onclick="desplegar(this, <?php if (!isset($_SESSION['usuario'])) {echo 1;} else {echo 2;}?>)">
          <i class="fas fa-clipboard-list"></i> Formulario
        </button>
        <div class="salioviaje-desplegable">
          <div class="formulario-viaje">

            <div class="user-info">
              <div class="user-icon">
                <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje-White.svg" title="Logo | Salió Viaje" alt="Logo Salió Viaje">
              </div>
              <div class="info">
                <h3><?php echo $_SESSION['usuario']; ?></h3>
                <p><i class="fas fa-user"></i> <?php echo $_SESSION['tipo_usuario']; ?></p>
              </div>
            </div>

            <div class="progress-bar">
              <span class="line"></span>
              <span class="progress"></span>

              <span class="circle1"></span>
              <span class="circle2"></span>
              <span class="circle3"></span>
            </div>

            <div class="step_1">

              <div class="input flex">
                <i class="fas fa-suitcase-rolling" id="icon"></i>
                <select name="" id="select_users" onchange="select_usuario()">
                  <option value="0" selected disabled hidden >Tipo de Viaje</option>
                  <option value="1">Traslado</option>
                  <option value="2">Tour o Servicio por Horas.</option>
                  <option value="3">Transfer (Aeropuerto / Puerto)</option>
                  <option value="4">Fiestas o Eventos</option>
                </select>
                <button class="gurucuteco-button" onclick="openGurucuteco(2)"><i class="fa-solid fa-circle-question"></i></button>
              </div>

              <p class="info"><i class="fas fa-info-circle"></i> Seleccione un tipo de viaje a realizar.</p>

            </div>

            <div class="step_2_traslado">

              <h3 class="title"><i class="fas fa-bus"></i> Traslado <button class="gurucuteco-button" onclick="openGurucuteco(7)"><i class="fa-solid fa-circle-question"></i></button></h3>

              <div class="formulario-grid">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Salida <span class="obligatorio">*</span></p> 
                    <input type="date" id="fecha_salida"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_traslado_origen" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_traslado_origen" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <?php
                          if (isset($barrios)) {
                            for ($i=0; $i < count($barrios); $i++) { 
                            ?>
                            <option value="<?php echo $barrios[$i] ?>">
                            <?php
                            }
                          }
                        ?>
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_traslado_origen" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                      <option value="ARTIGAS">
                      <option value="CANELONES">
                      <option value="CERRO LARGO">
                      <option value="SAN JOSE">
                      <option value="FLORIDA">
                      <option value="SORIANO">
                      <option value="RIO NEGRO">
                      <option value="TACUAREMBÓ">
                      <option value="RIVERA">
                      <option value="MONTEVIDEO">
                      <option value="ROCHA">
                      <option value="SALTO">
                      <option value="RIVERA">
                      <option value="PAYSANDU">
                      <option value="TREINTA Y TRES">
                      <option value="FLORES"> 
                      <option value="COLONIA">
                      <option value="MALDONADO"> 
                      <option value="LAVALLEJA">
                      </datalist>
                    </div>

                  </div>
                  

                  

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_traslado"></textarea>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-route"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_traslado_destino"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_traslado_destino">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad</p>
                      <input list="Localidad" id="localidad_traslado_destino">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas <span class="obligatorio">*</span></p>
                  <select name="mascota" id="mascotas_traslado">
                  <option vlaue="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                </div>

              </div>

              <p class="mensaje-error">Debe completar todos los campos.</p>

            </div>

            <div class="step_2_tour">

              <h3 class="title"><i class="fas fa-city"></i> Tour o Servicio por Horas. <button class="gurucuteco-button" onclick="openGurucuteco(6)"><i class="fa-solid fa-circle-question"></i></button></h3>

              <div class="formulario-grid">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Salida<span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_salida_tour"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_salida_tour" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_barrios" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_tour" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>


                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_tour"/>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_tour"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-city"></i> Ciudad a visitar<span class="obligatorio">*</span></p>

                    <input list="Destino" id="destino_tour">
                    <datalist id="Destino">
                      <option value="Canelones">
                      <option value="Montevideo">
                      <option value="Tacuarembó">
                      <option value="Maldonado">
                      <option value="Rivera">
                    </datalist>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-clock"></i> Duración (Horas) <span class="obligatorio">*</span></p>
                    <input type="number" id="duracion_tour"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas <span class="obligatorio">*</span></p>
                  <select name="mascota" id="mascota_tour">
                  <option vlaue="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_tour"></textarea>
                  </div>

                </div>

              </div>

              <p class="mensaje-error">Debe completar todos los campos.</p>

            </div>

            <div class="step_2_transfer">

              <h3 class="title"><i class="fas fa-plane-departure"></i> Transfer (Aeropuerto / Puerto)</h3>

              <div class="input flex">
                <i class="fas fa-plane" id="icon"></i>
                <select name="" id="select_transfer" onchange="select_transfer()">
                  <option value="0" selected disabled hidden >Seleccione una Tipo de Transfer</option>
                  <option value="1">Transfer de Arribos</option>
                  <option value="2">Transfer de Partidas</option>
                </select>
                <button class="gurucuteco-button" onclick="openGurucuteco(5)"><i class="fa-solid fa-circle-question"></i></button>
              </div>

              <p class="info"><i class="fas fa-info-circle"></i> Seleccione un tipo de transfer a realizar.</p>


              <div class="formulario-grid" id="transfer_in">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Arribo <span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_regreso_transfer_in"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-plane-arrival"></i> Origen (Puerto o Aeropuerto) <span class="obligatorio">*</span></p>
                    <input list="Aeropuertos" id="aeropuerto_transfer_in">
                      <datalist id="Aeropuertos">
                        <option value="Aeropuerto Internacional de Carrasco Gral. Cesáreo L. Berisso">
                        <option value="Aeropuerto Internacional C/C Carlos A. Curbelo de Laguna del Sauce">
                        <option value="Puerto de Montevideo">
                        <option value="Puerto de Colonia">
                      </datalist>
                  </div>


                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_transfer_in"/>
                  </div>

                  <div class="input">
                    <p><i class="fa fa-ticket"></i> N° de Vuelo / Barco <span class="obligatorio">*</span></p>
                    <input type="text" id="nro_vuelo_barco_in"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas <span class="obligatorio">*</span></p>
                  <select name="mascota" id="mascotas_transfer_in">
                  <option vlaue="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-suitcase-rolling"></i> Equipaje (Cant. Maletas) <span class="obligatorio">*</span></p>
                    <input type="number" id="equipaje_transfer_in"/>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_transfer_in"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-route"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_transfer_in" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_transfer_in" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_transfer_in" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_transfer_in"></textarea>
                  </div>

                </div>

              </div>

              <div class="formulario-grid" id="transfer_out">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Partida <span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_salida_transfer_out"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_transfer_out" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_transfer_out" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_transfer_out" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_transfer_out"/>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora que pasan a buscar <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_transfer_out"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-plane-departure"></i> Destino (Puerto o Aeropuerto) <span class="obligatorio">*</span></p>
                    <input list="Aeropuertos" id="aeropuerto_transfer_out">
                  </div>

                  <div class="input">
                    <p><i class="fas fa-suitcase-rolling"></i> Equipaje (Cant. Maletas) <span class="obligatorio">*</span></p>
                    <input type="number" id="equipaje_transfer_out"/>
                  </div>

                  <div class="input">
                    <p><i class="fa fa-ticket"></i> N° de Vuelo / Barco <span class="obligatorio">*</span></p>
                    <input type="text" id="nro_vuelo_barco_out"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas <span class="obligatorio">*</span></p>
                    <select name="mascota" id="mascotas_transfer_out">
                    <option vlaue="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_transfer_out"></textarea>
                  </div>

                </div>

              </div>

              <p class="mensaje-error">Debe completar todos los campos.</p>

            </div>

            <div class="step_2_fiestas">

              <h3 class="title"><i class="fas fa-glass-cheers"></i> Fiestas o Eventos</h3>

              <div class="input flex">
                <i class="fas fa-exchange-alt" id="icon"></i>
                <select name="" id="select_fiesta" onchange="select_fiesta()">
                  <option value="0" selected disabled hidden >Seleccione un Tramo</option>
                  <option value="1">Solo Ida</option>
                  <option value="2">Solo Vuelta</option>
                  <option value="3">Ida y Vuelta</option>
                </select>
                <button class="gurucuteco-button" onclick="openGurucuteco(4)"><i class="fa-solid fa-circle-question"></i></button>
              </div>

              <p class="info"><i class="fas fa-info-circle"></i> Seleccione un tipo de tramo a realizar.</p>

              <div class="formulario-grid" id="fiesta_ida">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Salida <span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_salida_fiestas_ida"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_fiestas_ida" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_fiestas_ida" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_fiestas_ida" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_fiesta_ida"/>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_fiesta_ida"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-route"></i> Destino o Punto de Interés <span class="obligatorio">*</span></p>
                    <input type="text" id="destino_fiesta_ida">
                  </div>

                  <div class="input">
                    <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                    <input list="Barrio" id="fiestasida_origen_barrios">
                    <datalist id="Barrio">
                      <option value="Barrio 1">
                      <option value="Barrio 2">
                      <option value="Barrio 3">
                      <option value="Barrio 4">
                      <option value="Barrio 5">
                    </datalist>
                  </div>

                  <div class="input">
                    <p><i class="fa-solid fa-globe"></i> Localidad</p>
                    <input list="Localidad" id="fiestasida_origen_localidad">
                    <datalist id="Localidad">
                      <option value="Localidad 1">
                      <option value="Localidad 2">
                      <option value="Localidad 3">
                      <option value="Localidad 4">
                      <option value="Localidad 5">
                    </datalist>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_fiesta_ida"></textarea>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas <span class="obligatorio">*</span></p>
                    <select name="mascota" id="mascotas_fiestas_ida">
                    <option vlaue="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                </div>

              </div>

              <div class="formulario-grid" id="fiesta_vuelta">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Regreso <span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_regreso_fiestas_vuelta"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-map-marker-alt"></i> Origen o Punto de Interés <span class="obligatorio">*</span></p>
                    <input type="text" id="origen_fiestas_vuelta">
                  </div>

                  <div class="input">
                    <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                    <input list="Barrio" id="fiestasvuelta_origen_barrios">
                    <datalist id="Barrio">
                      <option value="Barrio 1">
                      <option value="Barrio 2">
                      <option value="Barrio 3">
                      <option value="Barrio 4">
                      <option value="Barrio 5">
                    </datalist>
                  </div>

                  <div class="input">
                    <p><i class="fa-solid fa-globe"></i> Localidad</p>
                    <input list="Localidad" id="fiestasvuelta_origen_localidad">
                    <datalist id="Localidad">
                      <option value="Localidad 1">
                      <option value="Localidad 2">
                      <option value="Localidad 3">
                      <option value="Localidad 4">
                      <option value="Localidad 5">
                    </datalist>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_fiesta_vuelta"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas <span class="obligatorio">*</span></p>
                    <select name="mascota" id="mascotas_fiestas_vuelta">
                    <option vlaue="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_fiesta_vuelta"></textarea>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_fiesta_vuelta"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_fiesta_vuelta" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_fiesta_vuelta" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_fiesta_vuelta" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>
                  </div>

                </div>

              </div>

              <div class="formulario-grid" id="fiesta_idavuelta">
                <div class="column">

                  <h3><i class="fas fa-arrow-circle-up"></i> Ida</h3>

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Salida <span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_salida_fiestas_idavuelta"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_ida_origen_fiestas_idavuelta" onchange="rellenar('Direccion_Origen')" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_ida_origen_fiestas_idavuelta" onchange="rellenar('Barrio_Origen')" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_ida_origen_fiestas_idavuelta" onchange="rellenar('Localidad_Origen')" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-route"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_ida_destino_fiestas_idavuelta" onchange="rellenar('Direccion_Destino')"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_ida_destino_fiestas_idavuelta" onchange="rellenar('Barrio_Destino')">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad</p>
                      <input list="Localidad" id="localidad_ida_destino_fiestas_idavuelta" onchange="rellenar('Localidad_Destino')">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>
                    
                  </div>

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_ida_fiestas_idavuelta" onchange="rellenar('Cantidad_Pasajeros')"/>
                  </div>

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_ida_fiestas_idavuelta" onchange="verificar_largo_fiesta()"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea  id="observaciones_fiesta_idavuelta"></textarea>
                  </div>

                </div>

                <div class="column">

                  <h3><i class="fas fa-arrow-circle-down"></i> Vuelta</h3>

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Regreso <span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_regreso_fiestas_idavuelta"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_vuelta_origen_fiestas_idavuelta"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_vuelta_origen_fiestas_idavuelta">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad</p>
                      <input list="Localidad" id="localidad_vuelta_origen_fiestas_idavuelta">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-route"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_vuelta_destino_fiestas_idavuelta" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_vuelta_destino_fiestas_idavuelta" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_vuelta_destino_fiestas_idavuelta" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>
                    
                  </div>

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_vuelta_fiestas_idavuelta"/>
                  </div>

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_vuelta_fiestas_idavuelta" onchange="verificar_largo_fiesta()"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas <span class="obligatorio">*</span></p>
                    <select name="mascota" id="mascotas_fiestas_idavuelta">
                    <option vlaue="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                </div>

              </div>

              <p class="mensaje-error">Debe completar todos los camposs.</p>

            </div>

            <div class="step_3" id="Paradas">

              <div class="loader_step3">
                <i class="fas fa-spinner" id="spinner"></i>
              </div>

              <div class="paradas-wrapper" id="paradas_ida">
                <div class="input">
                  <p><i class="fas fa-stopwatch"></i> Paradas - <i class="fas fa-arrow-circle-up"></i> (Ida)</p>
                  <form action="javascript:void(0)" method="post">
                    <input id="paradas_1" onchange="paradas(1)">
                  </form>
                  
                </div>
                <div class="tags" id="tags_paradas_1">
                </div>
              </div>

              <div class="paradas-wrapper" id="paradas_vuelta">
                <div class="input">
                  <p><i class="fas fa-stopwatch"></i> Paradas - <i class="fas fa-arrow-circle-down"></i> (Vuelta)</p>
                  <form action="javascript:void(0)" method="post">
                    <input id="paradas_2" onchange="paradas(2)">
                  </form>
                </div>
                <div class="tags" id="tags_paradas_2">
                </div>
              </div>

              <button class="button-viajar" onclick="volver()"><i class="fas fa-arrow-circle-left"></i> Volver</button>
              <?php
              if($_SESSION['datos_usuario']['DIRECCION'] == ""){
                echo '<button class="button-viajar" onclick="finalizar(1,1)" id="submit">Enviar Solicitud <i class="fas fa-paper-plane"></i></button>';
              }else{
                echo '<button class="button-viajar" onclick="finalizar(1,2)" id="submit">Enviar Solicitud <i class="fas fa-paper-plane"></i></button>';
              }
              ?>
            </div>

            <div class="step_4">

              <div class="send-wrapper">

                <div class="sending-icon">
                  <i class="fas fa-spinner"></i>
                </div>
              </div>

            </div>

            <div class="step_5">

              <div class="send-wrapper">

                <div class="send-icon">
                  <i class="fas fa-check-circle"></i>
                </div>

                <div class="send-info">
                  <h2>¡Solicitud Enviada!</h2>
                  <p>En breve te llegaran cotizaciones a tu correo electrónico.</p>
                  <button class="button-viajar" onclick="nueva_cotizacion()"><i class="fas fa-plus-circle"></i> Nueva Cotización</button>
                  
                </div>

              </div>

            </div>

          </div>
        </div>
      </section>
    </div>
    <script>
          if($(`.session-input`).val() == `` && $(`.session-output`).val() == 0){
                desplegar(document.getElementById("agendar"), $(".session-output").val());
          }else{
              if (localStorage.getItem("origen") == 1) {
              console.log("Desplegar Function")
              localStorage.removeItem("origen")
              desplegar(document.getElementById("agendar"), <?php if (!isset($_SESSION['usuario'])) {echo 1;} else {echo 2;}?>)
              select_usuario()
            }
          }
          

          var waypoint = new Waypoint({
            element: document.getElementById('Cotizacion'),
            handler: function(direction) {
              if($(`.session-output`).val() == 0 && $("#select_users").val() == null){
                openGurucuteco(2);
              }
            },
            offset: 300 
          })


          


    </script>

    <div id="footer"></div>
  </body>
</html>
