<?php 

  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: /SalioViaje/Login');

  }else{
    if($_SESSION['tipo_usuario'] == "Pasajero"){
      header('Location: /SalioViaje/');
    }
  }

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
      href="/SalioViaje/media/svg/Favicon-SalioViaje.svg"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="/SalioViaje/styles/styles.css" />

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>

    <script src="/SalioViaje/Javascript/panel.js"></script>
    <script src="/SalioViaje/Javascript/settings.js"></script>
    <script src="/SalioViaje/Javascript/agendar.js"></script>
    <script src="/SalioViaje/Javascript/loader.js"></script>
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
          <h2>Empresas</h2>
        </div>
      </div>
      <div class="header-right">
        <div class="header-user">
          <div class="icon"><img src="/SalioViaje/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje"></div>
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
                <p><i class="fas fa-address-card"></i> 5487923-9</p>
                <p><i class="fas fa-phone"></i> 098 234 717</p>
                <p><i class="fas fa-map-marker-alt"></i> Ciudad de la Costa, Canelones.</p>
              </div>
            </div>
          </div>

          <h2 class="step_title"><i class="fas fa-book"></i> Agendar Viaje</h2>

          <div class="progress-bar">
            <span class="line"></span>
            <span class="progress"></span>
            <span class="circle1"></span>
            <span class="circle2"></span>
            <span class="circle3"></span>
          </div>
          
          <div id="step_1">
            <div class="inputs-wrapper-agendar">

            <div class="column">

                <div class="vehicle">
                  <div class="vehicle-icon">
                    <i class="fas fa-bus"></i>
                  </div>
                  <div class="vehicle-info">
                    <h3>Información del Vehiculo</h3>
                    <p><i class="fas fa-address-card"></i> STU6574</p>
                    <p><i class="fas fa-car"></i> Hyundai</p>
                    <p><i class="fas fa-list"></i> H1 2001</p>
                    <p><i class="fas fa-users"></i> 12</p>
                    <p><i class="fas fa-gas-pump"></i> Diesel</p>
                  </div>
                </div>

                <div class="empty-list">
                  <p>No hay ningun vehiculo seleccionado.</p>
                </div>

              </div>

              <div class="column">
                <div class="input" id="vehiculos">
                  <i class="fas fa-bus" id="icon"></i>
                  <select name="" id="vehiculos-select">
                    <option value="0" selected disabled hidden>Seleccione un Vehiculo</option>
                  </select>
                </div>

                <div class="input" id="pasajeros">
                  <i class="fas fa-users" id="icon"></i>
                  <input type="number" id="pasajeros-input" placeholder="Cantidad de Pasajeros" />
                </div>

                <div class="input" id="km">
                  <i class="fas fa-road" id="icon"></i>
                  <input type="number" id="distancia-input" placeholder="Distancia del Viaje" />
                  <p id="end-text">km</p>
                </div>

              </div>
            </div>
            <p id="mensaje-error1" class="mensaje-error"></p>

            <button class="button-agendar" id="button_volver" onclick="volver()">
              <i class="fas fa-arrow-circle-left"></i> Volver
            </button>
            <button class="button-agendar" id="step-next" onclick="next()">
              <i class="fas fa-arrow-circle-right"></i> Siguiente
            </button>
          </div>
          
          <div id="step_2">
            <div class="inputs-wrapper-agendar">

              <div class="column">
                <h2 class="step_title"><i class="fas fa-road"></i> Tramo N° 1</h2>

                <div class="input" id="tipo">
                  <i class="fas fa-list-ul" id="icon"></i>
                  <select name="" id="tipo-select_1">
                    <option value="0" selected disabled hidden>Seleccione un Tipo</option>
                    <option value="1" >Agendar</option>
                    <option value="2" >Oportunidad</option>
                  </select>
                </div>

                <div class="input" id="origen">
                  <i class="far fa-calendar-alt" id="icon"></i>
                  <input type="datetime-local" id="fecha_1" placeholder="Fecha y Hora" />
                </div>

                <div class="input" id="origen">
                  <i class="fas fa-map-marker-alt" id="icon"></i>
                  <input list="Origen" id="origen_1" placeholder="Origen" onchange="select_origen_destino(1)">
                  <datalist id="Origen">
                    <option value="Canelones">
                    <option value="Montevideo">
                    <option value="Tacuarembó">
                    <option value="Maldonado">
                    <option value="Rivera">
                  </datalist> 
                </div>

                <div class="input" id="destino">
                  <i class="fas fa-route" id="icon"></i>
                  <input list="Destino" id="destino_1" placeholder="Destino" onchange="select_origen_destino(2)">
                  <datalist id="Destino">
                    <option value="Canelones">
                    <option value="Montevideo">
                    <option value="Tacuarembó">
                    <option value="Maldonado">
                    <option value="Rivera">
                  </datalist> 
                </div>

                <div class="input" id="precioref">
                  <i class="fas fa-dollar-sign" id="icon"></i>
                  <input type="number" id="precioref_1" placeholder="Precio de Referencia" />
                </div>
              </div>

              <div class="column">
                <h2 class="step_title"><i class="fas fa-road"></i> Tramo N° 2</h2>

                <div class="input" id="tipo">
                  <i class="fas fa-list-ul" id="icon"></i>
                  <select name="" id="tipo-select_2">
                    <option value="0" selected disabled hidden>Seleccione un Tipo</option>
                    <option value="1" >Agendar</option>
                    <option value="2" >Oportunidad</option>
                  </select>
                </div>

                <div class="input" id="origen">
                  <i class="far fa-calendar-alt" id="icon"></i>
                  <input type="datetime-local" id="fecha_2" placeholder="Fecha y Hora" />
                </div>

                <div class="input" id="origen">
                  <i class="fas fa-map-marker-alt" id="icon"></i>
                  <input list="Origen" id="origen_2" placeholder="Origen" onchange="select_origen_destino(3)">
                  <datalist id="Origen">
                    <option value="Canelones">
                    <option value="Montevideo">
                    <option value="Tacuarembó">
                    <option value="Maldonado">
                    <option value="Rivera">
                  </datalist>  
                </div>

                <div class="input" id="destino">
                  <i class="fas fa-route" id="icon"></i>
                  <input list="Destino" id="destino_2" placeholder="Destino" onchange="select_origen_destino(4)">
                  <datalist id="Destino">
                    <option value="Canelones">
                    <option value="Montevideo">
                    <option value="Tacuarembó">
                    <option value="Maldonado">
                    <option value="Rivera">
                  </datalist> 
                </div>

                <div class="input" id="precioref">
                  <i class="fas fa-dollar-sign" id="icon"></i>
                  <input type="number" id="precioref_2" placeholder="Precio de Referencia" />
                </div>

              </div>
            </div>
            <p id="mensaje-error1" class="mensaje-error"></p>

            <button class="button-agendar" id="button_volver" onclick="volver()">
              <i class="fas fa-arrow-circle-left"></i> Volver
            </button>
            <button class="button-agendar" id="step-next" onclick="next()">
              <i class="fas fa-arrow-circle-right"></i> Siguiente
            </button>
          </div>

          <div id="step_3">
            <div class="inputs-wrapper-agendar">
              <div class="column">
                <h2 class="step_title"><i class="fas fa-road"></i> Rutas N° 1</h2>
                <div class="input" id="rutas">
                  <i class="fas fa-road" id="icon"></i>
                  <input list="Rutas" id="rutas_1" placeholder="Rutas" onchange="rutas()">
                  <datalist id="Rutas">
                    <option value="Ruta 1">
                    <option value="Ruta 2">
                    <option value="Ruta 3">
                    <option value="Ruta 4">
                  </datalist> 
                </div>

                <div class="tags" id="tags_1">
                </div>

              </div>
              <div class="column">
                <h2 class="step_title"><i class="fas fa-road"></i> Rutas N° 2</h2>
                <div class="input" id="rutas">
                  <i class="fas fa-road" id="icon"></i>
                  <input list="Rutas2" id="rutas_2" placeholder="Rutas" onchange="rutas()">
                  <datalist id="Rutas2">
                    <option value="Ruta 1">
                    <option value="Ruta 2">
                    <option value="Ruta 3">
                    <option value="Ruta 4">

                  </datalist> 
                </div>

                <div class="tags" id="tags_2">

                </div>

              </div>
            </div>
            <p id="mensaje-error1" class="mensaje-error"></p>

            <button class="button-agendar" id="button_volver" onclick="volver()">
              <i class="fas fa-arrow-circle-left"></i> Volver
            </button>
            <button class="button-agendar" id="step-agendar" onclick="agendar()">
              <i class="fas fa-book"></i> Agendar
            </button>
            <button class="button-agendar" id="step-agendar_MTOP" onclick="Agendar_MTOP()">
              <i class="fas fa-id-card"></i> Agendar con MTOP
            </button>
          </div>

        </div>
    </section>
  </body>
</html>
