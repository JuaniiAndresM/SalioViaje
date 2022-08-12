<?php 
require_once '../PHP/procedimientosBD.php';

$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');
  }elseif(!$_SESSION['datos_usuario']['TIPO_USUARIO'] == "TTA" || !$_SESSION['datos_usuario']['TIPO_USUARIO'] == "ADM") {
    header('Location: https://www.salioviaje.com.uy/Login');
  }

$BD = new procedimientosBD();

$COTIZACIONES = json_decode($BD->traer_cotizaciones_recibidas_por_id_solicitante($_SESSION['datos_usuario']['ID']), true);

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Cotizaciones Recibidas</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Cotizaciones_Recibidas" />
    <meta property="og:title" content="SalióViaje | Cotizaciones Recibidas" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Cotizaciones_Recibidas" />
    <meta
      property="twitter:title"
      content="SalióViaje | Cotizaciones Recibidas"
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
    <script src="https://www.salioviaje.com.uy/Plugins/JQuery/jquery.min.js"></script>
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>

    <script src="https://www.salioviaje.com.uy/Javascript/panel.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/cotizaciones.js"></script>
    <script type="text/javascript">
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

    <div id="modal"></div>

    <header class="panel-header" id="header">
      <div class="header-left">
        <div class="header-menu">
          <button onclick="navbar()"><i class="fas fa-bars"></i></button>
        </div>
        <div class="header-title">
          <h2>Cotizaciones Recibidas</h2>
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
      <div class="section-usuarios">
        <div class="usuarios-recientes">
          <div class="usuarios-info">
            <h2><i class="fas fa-hand-holding-dollar"></i> Cotizaciones Recibidas</h2>
          </div>
          <div class="filters">
            <div class="search">
              <i class="fas fa-search"></i>
              <input
                type="text"
                placeholder="Buscar"
                id="searchbar"
                onkeyup="buscarUsuarios(5)"
              />
            </div>
            <!-- <div class="filters2">

              <div class="input">
                <i class="far fa-calendar-alt" id="icon"></i>
                <input type="date" id="date_agenda">
              </div>

              <div class="input">
                <i class="fas fa-clock" id="icon"></i>
                <input type="time" id="time_agenda">
              </div>

              <div class="input">
                <i class="fas fa-list" id="icon"></i>
                <select id="estado_agenda">
                  <option value="0" disabled selected hidden>Seleccione un Estado</option>
                  <option value="1">En Venta</option>
                  <option value="2">Indefinido</option>
                  <option value="2">Aprobado</option>
                  <option value="3">Rechazado</option>
                </select>
              </div>

              <button class="reload-filters">
                <i class="fa fa-refresh"></i>
              </button>

            </div> -->
          </div>
          <div class="table-overflow">
            <table class="usuarios-table" id="search-cotizaciones-recibidas-table">
              <thead>
                <tr>
                  <th id="ID">ID Viaje<i class="fas fa-angle-down"></i></th>
                  <th>ID Cotización<i class="fas fa-angle-down"></i></th>
                  <th>Reputación <i class="fas fa-angle-down"></i></th>
                  <th>Marca / Modelo <i class="fas fa-angle-down"></i></th>
                  <th>Capacidad <i class="fas fa-angle-down"></i></th>
                  <th>Seña <i class="fas fa-angle-down"></i></th>
                  <th>Precio <i class="fas fa-angle-down"></i></th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tbody-cotizaciones-recibidas">
              <?php
                for ($i=0; $i < count($COTIZACIONES); $i++) { 
                  ?>
                  <tr>
                    <td><?php echo $COTIZACIONES[$i]['ID_VIAJE_COTIZADO']; ?></td>
                    <td><?php echo $COTIZACIONES[$i]['ID']; ?></td>
                    <td>
                      <div class="reputacion">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                      </div>
                    </td>
                    <td><?php echo $COTIZACIONES[$i]['MARCA']; ?>, <?php echo $COTIZACIONES[$i]['MODELO']; ?></td>
                    <td><?php echo $COTIZACIONES[$i]['CAPACIDAD']; ?></td>
                    <td>$<?php echo number_format( $COTIZACIONES[$i]["SENIA"], 0,'','.') ?></td>
                    <td>$<?php echo number_format( $COTIZACIONES[$i]["PRECIO"], 0,'','.') ?></td>
                    <td>
                      <div class="button-wrapper">
                        <button class="button tooltip left" data-tooltip="Aceptar Cotización" onclick="aceptarCotizacion(<?php echo $COTIZACIONES[$i]['ID']. ',' . $COTIZACIONES[$i]['ID_VIAJE_COTIZADO'] . ',1' ?>)"><i class="fas fa-dollar-sign"></i></button>
                        <button class="button tooltip left" data-tooltip="Rechazar Cotización" onclick="eliminarCotizacion(<?php echo $COTIZACIONES[$i]['ID'] ?>)"><i class="fas fa-ban"></i></button>
                      </div>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
