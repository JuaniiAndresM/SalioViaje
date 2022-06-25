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
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Cargar Oferta</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Cargar_Oferta" />
    <meta property="og:title" content="SalióViaje | Cargar Oferta" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Cargar_Oferta" />
    <meta
      property="twitter:title"
      content="SalióViaje | Cargar Oferta"
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>

    <script src="https://www.salioviaje.com.uy/Javascript/panel.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/agendar.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/ofertas.js"></script>
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
          <h2>Cargar Oferta</h2>
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

    <datalist id="RegionesMTOP">
        <?php
            if (isset($regiones_mtop)) {
            for ($i=0; $i < count($regiones_mtop); $i++) { 
            ?>
            <option value="<?php echo $regiones_mtop[$i]['REGION'].",".$regiones_mtop[$i]['DPTO'] ?>">
            <?php
            }
            }
        ?>
    </datalist>

    <nav class="nav-hidden active" id="panel-navbar"></nav>

    <section class="panel" id="panel">
        <div class="form-container">
            <div class="select-container">
                <h2>Tipo de Oferta</h2>
                <h3>Seleccione el Tipo de Oferta a realizar.</h3>
                <div class="input">
                    <i class="fa-solid fa-list-ol" class="icon"></i>
                    <select name="ofertaType" id="ofertaType" onchange="selectType()">
                        <option value="0" disabled hidden selected>Seleccione una de las opciones</option>
                        <option value="1">Transporte</option>
                        <option value="2">Paquetes</option>
                    </select>
                </div>
            </div>

            <div class="main-form-container transporte">
                <h3><i class="fa-solid fa-van-shuttle"></i> Transporte</h3>
                <hr>
                <div class="columns-divider">
                    <div class="col-l">
                        
                        <div class="input">
                            <i class="fa-solid fa-van-shuttle"></i>
                            <select name="ofertaType">
                                <option value="0" disabled hidden selected>Seleccione una matrícula</option>
                                <option value="1">AAT 1234</option>
                                <option value="2">AAU 8976</option>
                            </select>
                        </div>

                        <div class="input">
                            <i class="fa-solid fa-people-group"></i>
                            <input type="number" id="capacidadVehiculo" placeholder="Capacidad del Vehículo">
                        </div>

                        <div class="input" id="km">
                            <i class="fas fa-road" id="icon"></i>
                            <input type="number" pattern="[1-9]" class="right-i" min="0" id="distanciaKm" placeholder="Distancia" oninput="this.value = Math.abs(this.value)"/>
                            <p id="end-text">km</p>
                        </div>

                        <div class="input">
                            <i class="fa-solid fa-location-dot"></i>
                            <input list="RegionesMTOP" id="origen" placeholder="Origen">
                        </div>

                        <div class="input">
                            <i class="fa-solid fa-route"></i>
                            <input list="RegionesMTOP" id="destino" placeholder="Destino">
                        </div>

                        <div class="input">
                            <i class="fa-solid fa-arrow-down-up-across-line"></i>
                            <select name="tramoType">
                                <option value="0" disabled hidden selected>Seleccione un Tramo</option>
                                <option value="1">Ida</option>
                                <option value="2">Vuelta</option>
                                <option value="3">Ida y Vuelta</option>
                            </select>
                        </div>

                        <div class="input">
                            <i class="fa-solid fa-clock"></i>
                            <select name="horarioType">
                                <option value="0" selected>Todo el Día</option>
                                <option value="1">Mañana (00:00 - 12:00)</option>
                                <option value="2">Tarde (12:00 - 24:00)</option>
                            </select>
                        </div>

                    </div>

                    <div class="col-r">
                        
                        <div class="input">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                            <input type="number" id="precioViaje" placeholder="Precio del Viaje">
                        </div>

                        <div class="input">
                            <i class="fa-solid fa-hourglass"></i>
                            <input type="number" id="precioEspera" placeholder="Precio Hora de Espera">
                        </div>

                        <div class="input">
                            <i class="fa-solid fa-stopwatch"></i>
                            <input type="number" id="precioParada" placeholder="Precio por Parada">
                        </div>

                        <div class="input">
                            <i class="fa-solid fa-percent"></i>
                            <select name="descuentoOferta">
                                <option value="0" disabled hidden selected>Seleccione un Descuento</option>
                                <option value="1">10%</option>
                                <option value="2">20%</option>
                                <option value="3">30%</option>
                                <option value="4">40%</option>
                            </select>
                        </div>

                        <div class="input">
                            <i class="far fa-calendar-alt" id="icon"></i>
                            <input type="date" id="fechaPromocion" placeholder="Fecha de Promoción" onchange="addFecha()"/>
                        </div>

                        <div class="date-container">
                            
                        </div>

                    </div>
                </div>

                <div class="main-bottom-container">
                    <a href="https://www.salioviaje.com.uy/Ofertas_Dashboard"><i class="fa-solid fa-chevron-left"></i> Volver</a>
                    <button><i class="fa-solid fa-file-circle-plus"></i> Cargar Oferta</button>
                    <button><i class="fa-solid fa-broom"></i> Limpiar Campos</button>
                </div>
            </div>
        </div>
    </section>
  </body>
</html>
