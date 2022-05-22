<?php 
require_once '../PHP/procedimientosBD.php';

$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');
  }else{
    $info_usuario = new procedimientosBD();

    if ($_SESSION['datos_usuario']['TIPO_USUARIO'] == "ADM") {
      //traer_viajes
      $oportunidades = json_decode($info_usuario->traer_oportunidades(), true);
      $vehiculos = json_decode($info_usuario->traer_viajes(), true);
    } else {
      $vehiculos = $info_usuario->traer_agenda_usuario($_SESSION['datos_usuario']["ID"]);
      // $oportunidades = $info_usuario->traer_oportunidades_usuario($_SESSION['datos_usuario']["ID"]);
    }

  }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Agenda</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Agenda" />
    <meta property="og:title" content="SalióViaje | Agenda" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Agenda" />
    <meta
      property="twitter:title"
      content="SalióViaje | Agenda"
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
    <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/filtros.js"></script>
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

    <header class="panel-header" id="header">
      <div class="header-left">
        <div class="header-menu">
          <button onclick="navbar()"><i class="fas fa-bars"></i></button>
        </div>
        <div class="header-title">
          <h2>Agenda</h2>
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
            <h2><i class="fas fa-book"></i> <?php if($_SESSION['tipo_usuario'] == "Administrador"){ echo 'Viajes'; }else{ echo 'Mis Viajes';} ?></h2>
          </div>
          <div class="filters">
            <div class="search">
              <i class="fas fa-search"></i>
              <input
                type="text"
                placeholder="Buscar"
                id="searchbar"
                onkeyup="buscarUsuarios(6)"
              />
            </div>
            <div class="filters2">

              <div class="input">
                <i class="far fa-calendar-alt" id="icon"></i>
                <input type="date" id="date_agenda" onchange="filtroAgenda()">
              </div>

              <div class="input">
                <i class="fas fa-clock" id="icon"></i>
                <input type="time" id="time_agenda" onchange="filtroAgenda()">
              </div>

              <div class="input">
                <i class="fas fa-list" id="icon"></i>
                <select id="estado_agenda" onchange="filtroAgenda()">
                  <option value="0" disabled selected hidden>Seleccione un Estado</option>
                  <option value="En Venta">En Venta</option>
                  <option value="Comprado">Comprado</option>
                  <option value="Reconfirmado">Reconfirmado</option>
                  <option value="Vencido">Vencido</option>
                  <option value="Cancelado">Cancelado</option>
                  <option value="Cotizando">Cotizando</option>
                  <option value="Cotizado">Cotizado</option>
                </select>
              </div>

              <button class="reload-filters" onclick="filtroAgenda_reload()">
                <i class="fa fa-refresh"></i>
              </button>

            </div>
          </div>
          <div class="table-overflow">
            <table class="usuarios-table" id="search-agendar-table">
              <thead>
                <tr>
                  <th id="ID">ID <i class="fas fa-angle-down"></i></th>
                  <th>Fecha <i class="fas fa-angle-down"></i></th>
                  <th>Hora <i class="fas fa-angle-down"></i></th>
                  <th>Vehículo <i class="fas fa-angle-down"></i></th>
                  <th>Origen <i class="fas fa-angle-down"></i></th>
                  <th>Destino <i class="fas fa-angle-down"></i></th>
                  <th>Distancia <i class="fas fa-angle-down"></i></th>
                  <th>Pasajeros <i class="fas fa-angle-down"></i></th>
                  <th>Precio <i class="fas fa-angle-down"></i></th>
                  <th>Descuento <i class="fas fa-angle-down"></i></th>
                  <th>Estado <i class="fas fa-angle-down"></i></th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tbody-agenda">
              <?php 
                  
                  if($vehiculos === null){
                    
                  }else{
                    $size = sizeof($vehiculos);
                    for($i = 0; $i< sizeof($vehiculos); $i++){

                      $info = explode(" ", $vehiculos[$i]['FECHA']);
                      $FECHA =$info[0];
                      $HORA = $info[1];
                      echo '<tr>
                          <td>'.$vehiculos[$i]['ID'].'</td>
                          <td>'.$FECHA.'</td>
                          <td>'.$HORA.'</td>
                          <td>'.$vehiculos[$i]['VEHICULO'] .'</td>
                          <td>'.$vehiculos[$i]['ORIGEN'].'</td>
                          <td>'.$vehiculos[$i]['DESTINO'].'</td>
                          <td>'.$vehiculos[$i]['DISTANCIA'].' km</td>
                          <td>'.$vehiculos[$i]['CANTIDAD_PASAJERO'].'</td>
                          <td>$'.number_format( $vehiculos[$i]['PRECIO'], 0,'','.').'</td>
                          <td>-</td>
                          <td>'.$vehiculos[$i]['ESTADO'].'</td>
                      </tr>';
                    }
                  }
                  if($oportunidades === null){
                    
                  }else{
                    $size = sizeof($oportunidades);
                    for($i = 0; $i< sizeof($oportunidades); $i++){
                      $info = explode(" ", $oportunidades[$i]['FECHA']);
                      $FECHA =$info[0];
                      $HORA = $info[1];
                      echo '<tr>
                          <td>'.$oportunidades[$i]['ID'].'</td>
                          <td>'.$FECHA.'</td>
                          <td>'.$HORA.'</td>
                          <td>'.$oportunidades[$i]['VEHICULO'].'</td>
                          <td>'.$oportunidades[$i]['ORIGEN'].'</td>
                          <td>'.$oportunidades[$i]['DESTINO'].'</td>
                          <td>'.$oportunidades[$i]['DISTANCIA'].' km</td>
                          <td>'.$oportunidades[$i]['CANTIDAD_PASAJERO'].'</td>
                          <td>$'.number_format( $oportunidades[$i]['PRECIO'], 0,'','.').'</td>';
                          if($oportunidades[$i]['DESCUENTO'] == ""){
                            echo '<td>-</td>';
                          }else{
                            echo '<td>'.$oportunidades[$i]['DESCUENTO'].'%</td>';
                          }
                    echo '<td>'.$oportunidades[$i]['ESTADO'].'</td>
                      </tr>';
                    }
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
