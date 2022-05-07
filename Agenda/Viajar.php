<?php
$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
session_start();
?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | ¡Viajá Barato!</title>

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
    <script src="https://www.salioviaje.com.uy/Javascript/viajar.js"></script>
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

    <a href="https://www.salioviaje.com.uy/FAQ" target="_BLANK" id="faq-float">
      <i class="fas fa-question"></i>
    </a>
    <a href="https://wa.link/mmdp0q" target="_BLANK" id="whatsapp-float">
      <img src="https://www.salioviaje.com.uy/media/images/whatsapp.png" alt="">
    </a>

    <div class="viajar-wrapper">
      <section class="oportunidades-viajar">
        <h2>
          Oportunidades
        </h2>
        <hr />
        <p class="description">
          Conseguí las mejores oportunidades con nosotros.
        </p>
        <div class="oportunidades-wrapper">
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
              <button onclick="filtros(1)"><i class="fas fa-sort-amount-down"></i> Filtrar</button>
            </div>
          </div>

          <div id="filters">

            <div class="input" id="destino">
              <i class="fas fa-location-dot" id="icon"></i>
              <input list="Origen" id="destino_2" placeholder="Origen" />
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

            <div class="input" id="origen">
              <i class="far fa-calendar-alt" id="icon"></i>
              <input type="date" id="fecha_2" placeholder="Fecha y Hora" />
            </div>

          </div>

          <div class="list-empty">
            <p>Lo sentimos, de momento no hay oportunidades disponibles.</p>
          </div>
          <div class="oportunidades-list">
          </div>
        </div>
      </section>
      <section class="ofertas-viajar">
        <h2>
          Ofertas
        </h2>
        <hr />
        <p class="description">Conseguí las mejores ofertas con nosotros.</p>
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

            <div class="input" id="destino">
              <i class="fas fa-location-dot" id="icon"></i>
              <input list="Origen" id="destino_2" placeholder="Origen" />
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

            <div class="input" id="origen">
              <i class="far fa-calendar-alt" id="icon"></i>
              <input type="date" id="fecha_2" placeholder="Fecha y Hora" />
            </div>

          </div>

          <div class="list-empty2">
            <p>Lo sentimos, de momento no hay ofertas disponibles.</p>
          </div>
        </div>
      </section>

      <section class="salioviaje" id="Cotizacion">
        <h2>
          Solicitar una Cotización
        </h2>
        <hr />
        <p class="description">
          Es gratis y sin compromiso. ¡No te lo pierdas!
        </p>
        <button id="agendar" class="button-agendar" onclick="desplegar(this, <?php if (!isset($_SESSION['usuario'])) {echo 1;} else {echo 2;}?>)">
          <i class="fas fa-clipboard-list"></i> Formulario
        </button>
        <div class="salioviaje-desplegable">
          <div class="formulario-viaje">

            <div class="user-info">
              <div class="user-icon">
                <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje">
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

              <div class="input">
                <i class="fas fa-suitcase-rolling" id="icon"></i>
                <select name="" id="select_users" onchange="select_usuario()">
                  <option value="0" selected disabled hidden >Tipo de Viaje</option>
                  <option value="1">Traslado</option>
                  <option value="2">Tour o Servicio por Horas.</option>
                  <option value="3">Transfer</option>
                  <option value="4">Fiestas o Eventos</option>
                </select>
              </div>

              <p class="info"><i class="fas fa-info-circle"></i> Seleccione un tipo de viaje a realizar.</p>

            </div>

            <div class="step_2_traslado">

              <h3 class="title"><i class="fas fa-bus"></i> Traslado</h3>

              <div class="formulario-grid">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Salida</p>
                    <input type="date" id="fecha_salida"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes</p>
                      <input type="text" id="direccion_traslado_origen"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_traslado_origen">
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
                      <input list="Localidad" id="localidad_traslado_origen">
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
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros</p>
                    <input type="number" id="cant_pasajeros"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_traslado"></textarea>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora</p>
                    <input type="time" id="hora"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-route"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes</p>
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
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas</p>
                  <select name="mascota" id="mascotas_traslado">
                  <option vlaue="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                </div>

              </div>

              <p class="mensaje-error">Debe completar todos los campos.</p>

              <button class="button-viajar" onclick="volver()"><i class="fas fa-arrow-circle-left"></i> Volver</button>
              <button class="button-viajar" onclick="finalizar()">Siguiente <i class="fas fa-arrow-circle-right"></i></button>

            </div>

            <div class="step_2_tour">

              <h3 class="title"><i class="fas fa-city"></i> Tour o Servicio por Horas.</h3>

              <div class="formulario-grid">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Salida</p>
                    <input type="date" id="fecha_salida_tour"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes</p>
                      <input type="text" id="direccion_salida_tour"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_barrios">
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
                      <input list="Localidad" id="localidad_tour">
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
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros</p>
                    <input type="number" id="cant_pasajeros_tour"/>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora</p>
                    <input type="time" id="hora_tour"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-city"></i> Ciudad</p>

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
                    <p><i class="fas fa-clock"></i> Duración (Horas)</p>
                    <input type="number" id="duracion_tour"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas</p>
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

              <button class="button-viajar" onclick="volver()"><i class="fas fa-arrow-circle-left"></i> Volver</button>
              <button class="button-viajar" onclick="finalizar()">Siguiente <i class="fas fa-arrow-circle-right"></i></button>

            </div>

            <div class="step_2_transfer">

              <h3 class="title"><i class="fas fa-plane-departure"></i> Transfer</h3>

              <div class="input">
                <i class="fas fa-plane" id="icon"></i>
                <select name="" id="select_transfer" onchange="select_transfer()">
                  <option value="0" selected disabled hidden >Seleccione una Tipo de Transfer</option>
                  <option value="1">Transfer de Arribos</option>
                  <option value="2">Transfer de Partidas</option>
                </select>
              </div>


              <div class="formulario-grid" id="transfer_in">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Arribo</p>
                    <input type="date" id="fecha_regreso_transfer_in"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-plane-arrival"></i> Origen (Puerto o Aeropuerto)</p>
                    <input type="text" id="aeropuerto_transfer_in">
                  </div>


                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros</p>
                    <input type="number" id="cant_pasajeros_transfer_in"/>
                  </div>

                  <div class="input">
                    <p><i class="fa fa-ticket"></i> N° de Vuelo / Barco</p>
                    <input type="text" id="nro_vuelo_barco_in"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas</p>
                  <select name="mascota" id="mascotas_transfer_in">
                  <option vlaue="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-suitcase-rolling"></i> Equipaje (Cant. Maletas)</p>
                    <input type="number" id="equipaje_transfer_in"/>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora de pasar a buscar</p>
                    <input type="time" id="hora_transfer_in"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-route"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes</p>
                      <input type="text" id="direccion_transfer_in"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_transfer_in">
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
                      <input list="Localidad" id="localidad_transfer_in">
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
                    <p><i class="far fa-calendar-alt"></i> Fecha de Partida</p>
                    <input type="date" id="fecha_salida_transfer_out"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes</p>
                      <input type="text" id="direccion_transfer_out"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_transfer_out">
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
                      <input list="Localidad" id="localidad_transfer_out">
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
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros</p>
                    <input type="number" id="cant_pasajeros_transfer_out"/>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora que pasan a buscar</p>
                    <input type="time" id="hora_transfer_out"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-plane-departure"></i> Destino (Puerto o Aeropuerto)</p>
                    <input type="text" id="aeropuerto_transfer_out">
                  </div>

                  <div class="input">
                    <p><i class="fas fa-suitcase-rolling"></i> Equipaje (Cant. Maletas)</p>
                    <input type="number" id="equipaje_transfer_out"/>
                  </div>

                  <div class="input">
                    <p><i class="fa fa-ticket"></i> N° de Vuelo / Barco</p>
                    <input type="text" id="nro_vuelo_barco_out"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas</p>
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

              <button class="button-viajar" onclick="volver()"><i class="fas fa-arrow-circle-left"></i> Volver</button>
              <button class="button-viajar" onclick="finalizar()">Siguiente <i class="fas fa-arrow-circle-right"></i></button>

            </div>

            <div class="step_2_fiestas">

              <h3 class="title"><i class="fas fa-glass-cheers"></i> Fiestas o Eventos</h3>

              <div class="input">
                <i class="fas fa-exchange-alt" id="icon"></i>
                <select name="" id="select_fiesta" onchange="select_fiesta()">
                  <option value="0" selected disabled hidden >Seleccione un Tramo</option>
                  <option value="1">Solo Ida</option>
                  <option value="2">Solo Vuelta</option>
                  <option value="3">Ida y Vuelta</option>
                </select>
              </div>

              <div class="formulario-grid" id="fiesta_ida">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Salida</p>
                    <input type="date" id="fecha_salida_fiestas_ida"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes</p>
                      <input type="text" id="direccion_fiestas_ida"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_fiestas_ida">
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
                      <input list="Localidad" id="localidad_fiestas_ida">
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
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros</p>
                    <input type="number" id="cant_pasajeros_fiesta_ida"/>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora</p>
                    <input type="time" id="hora_fiesta_ida"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-route"></i> Destino o Punto de Interés</p>
                    <input type="text" id="destino_fiesta_ida">
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-house-building"></i> Barrio</p>
                    <input list="Destino" id="fiestasida_origen_barrios">
                    <datalist id="Destino">
                      <option value="Canelones">
                      <option value="Montevideo">
                    </datalist>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_fiesta_ida"></textarea>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas</p>
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
                    <p><i class="far fa-calendar-alt"></i> Fecha de Regreso</p>
                    <input type="date" id="fecha_regreso_fiestas_vuelta"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-map-marker-alt"></i> Origen o Punto de Interés</p>
                    <input type="text" id="origen_fiestas_vuelta">
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-house-building"></i> Barrio</p>
                    <input list="Destino" id="fiestasvuelta_origen_barrios">
                    <datalist id="Destino">
                      <option value="Canelones">
                      <option value="Montevideo">
                    </datalist>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros</p>
                    <input type="number" id="cant_pasajeros_fiesta_vuelta"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas</p>
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
                    <p><i class="far fa-calendar-alt"></i> Hora</p>
                    <input type="time" id="hora_fiesta_vuelta"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes</p>
                      <input type="text" id="direccion_fiesta_vuelta"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_fiesta_vuelta">
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
                      <input list="Localidad" id="localidad_fiesta_vuelta">
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
                    <p><i class="far fa-calendar-alt"></i> Fecha de Salida</p>
                    <input type="date" id="fecha_salida_fiestas_idavuelta"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes</p>
                      <input type="text" id="direccion_ida_origen_fiestas_idavuelta"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_ida_origen_fiestas_idavuelta">
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
                      <input list="Localidad" id="localidad_ida_origen_fiestas_idavuelta">
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
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes</p>
                      <input type="text" id="direccion_ida_destino_fiestas_idavuelta"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_ida_destino_fiestas_idavuelta">
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
                      <input list="Localidad" id="localidad_ida_destino_fiestas_idavuelta">
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
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros</p>
                    <input type="number" id="cant_pasajeros_ida_fiestas_idavuelta"/>
                  </div>

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora</p>
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
                    <p><i class="far fa-calendar-alt"></i> Fecha de Regreso</p>
                    <input type="date" id="fecha_regreso_fiestas_idavuelta"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes</p>
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
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes</p>
                      <input type="text" id="direccion_vuelta_destino_fiestas_idavuelta"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_vuelta_destino_fiestas_idavuelta">
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
                      <input list="Localidad" id="localidad_vuelta_destino_fiestas_idavuelta">
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
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros</p>
                    <input type="number" id="cant_pasajeros_vuelta_fiestas_idavuelta"/>
                  </div>

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora</p>
                    <input type="time" id="hora_vuelta_fiestas_idavuelta" onchange="verificar_largo_fiesta()"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp Mascotas</p>
                    <select name="mascota" id="mascotas_fiestas_idavuelta">
                    <option vlaue="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                </div>

              </div>

              <p class="mensaje-error">Debe completar todos los campos.</p>

              <button class="button-viajar" onclick="volver()"><i class="fas fa-arrow-circle-left"></i> Volver</button>
              <button class="button-viajar" onclick="finalizar()">Siguiente <i class="fas fa-arrow-circle-right"></i></button>

            </div>

            <div class="step_3" id="Paradas">

              <div class="loader_step3">
                <i class="fas fa-spinner" id="spinner"></i>
              </div>

              <div class="paradas-wrapper" id="paradas_ida">
                <div class="input">
                  <p><i class="fas fa-stopwatch"></i> Paradas - <i class="fas fa-arrow-circle-up"></i> (Ida)</p>
                  <input id="paradas_1" onchange="paradas(1)">
                </div>
                <div class="tags" id="tags_paradas_1">
                </div>
              </div>

              <div class="paradas-wrapper" id="paradas_vuelta">
                <div class="input">
                  <p><i class="fas fa-stopwatch"></i> Paradas - <i class="fas fa-arrow-circle-down"></i> (Vuelta)</p>
                  <input id="paradas_2" onchange="paradas(2)">
                </div>
                <div class="tags" id="tags_paradas_2">
                </div>
              </div>

              <button class="button-viajar" onclick="volver()"><i class="fas fa-arrow-circle-left"></i> Volver</button>
              <button class="button-viajar" onclick="finalizar(1)">Enviar Solicitud <i class="fas fa-paper-plane"></i></button>

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
          if (localStorage.getItem("origen") == 1) {
            console.log("Desplegar Function")
            localStorage.removeItem("origen")
            desplegar(document.getElementById("agendar"), <?php if (!isset($_SESSION['usuario'])) {echo 1;} else {echo 2;}?>)
            select_usuario()
          }
    </script>

    <div id="footer"></div>
  </body>
</html>
