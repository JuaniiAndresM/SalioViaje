<?php 
require_once '../PHP/procedimientosBD.php';
$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');
  }else{
      if(!$_SESSION['tipo_usuario'] == 'Administrador'){
        header('Location: https://www.salioviaje.com.uy/Login');
      }
  }

  $cotizaciones = new procedimientosBD();

  $usuarios = $cotizaciones->datos_usuarios();
  $cotizaciones = json_decode($cotizaciones->traer_historial_cotizaciones(),true);


?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Editar Cotizaciones</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Editar_Cotizacion" />
    <meta property="og:title" content="SalióViaje | Editar Cotizaciones" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Editar_Cotizacion" />
    <meta
      property="twitter:title"
      content="SalióViaje | Editar Cotizaciones"
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
    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>

    <script src="https://www.salioviaje.com.uy/Javascript/panel.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/cotizaciones.js"></script>

    <script type="text/javascript">
            window.onload = function(){
              filtros();
            }
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
          <h2>Editar Cotizaciones</h2>
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
            <h2><i class="fas fa-chart-line"></i> Cotizaciones</h2>
          </div>
          <div class="filters">
            <div class="search">
              <i class="fas fa-search"></i>
              <input
                type="text"
                placeholder="Buscar"
                id="searchbar"
                onkeyup="buscarUsuarios(4)"
              />
            </div>

            <div class="checkboxs">

              <div class="checkbox">
                <input type="checkbox" name="" id="Cotizando" checked />
                <p>Cotizando</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="" id="Cotizado" checked />
                <p>Cotizado</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="" id="Aceptado" checked />
                <p>Aceptado</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="" id="Reconfirmado" checked />
                <p>Reconfirmado</p>
              </div>

            </div>
          </div>
          <div class="exportar-section">
              <button id="button-exportar" onclick="exportarTabla('xlsx')"><i class="fas fa-file-excel"></i> Exportar Tabla</button>
          </div>
          <div class="table-overflow-cotizaciones">
            <table class="usuarios-table" id="search-table-cotizaciones">
              <thead>
                <tr>
                  <th>ID Viaje <i class="fas fa-angle-down"></i></th>
                  <th>Fecha Viaje <i class="fas fa-angle-down"></i></th>
                  <th>ID Cotización <i class="fas fa-angle-down"></i></th>
                  <th>ID TTA <i class="fas fa-angle-down"></i></th>
                  <th>ID Solicitante <i class="fas fa-angle-down"></i></th>
                  <th>Estado Viaje <i class="fas fa-angle-down"></i></th>
                  <th>Estado Cotizacion <i class="fas fa-angle-down"></i></th>
                </tr>
              </thead>
              <tbody id="tbody">
              <?php
                  if(isset($cotizaciones)){
                    for ($i=0; $i < count($cotizaciones); $i++) {
                      if ($cotizaciones[$i]['visibilidad'] == 1 && $cotizaciones[$i]['COMPRADA'] == 0) {
                        $estado_cotizacion = "En Venta";
                      } elseif ($cotizaciones[$i]['visibilidad'] == 1 && $cotizaciones[$i]['COMPRADA'] == 1) {
                        $estado_cotizacion = "Elegida";
                      } elseif ($cotizaciones[$i]['visibilidad'] == 0 && $cotizaciones[$i]['COMPRADA'] == 0) {
                        $estado_cotizacion = "Rechazada";
                      } else {
                        $estado_cotizacion = "Ganadora";
                      }
                      //echo '<tr class="'.$cotizaciones[$i]['ESTADO'].'">';

                      switch ($cotizaciones[$i]['ESTADO']) {
                        case 1:
                          $estado = "Cotizando";
                          break;
                        case 2:
                          $estado = "Cotizado";
                          break;
                        case 3:
                          $estado = "Aceptado";
                          break;
                        case 3:
                          $estado = "Vencido";
                          break;

                        default:
                        $estado = "Reconfirmado";
                          break;
                      }

                      ?>
                      <tr>
                        <td><?php echo $cotizaciones[$i]['ID_VIAJE']; ?></td>
                        <td><?php echo $cotizaciones[$i]['FECHA_SALIDA']; ?></td>
                        <td><?php echo $cotizaciones[$i]['ID_COTIZACION']; ?></td>
                        <td><?php echo $cotizaciones[$i]['ID_TTA']; ?></td>
                        <td><?php echo $cotizaciones[$i]['ID_SOLICITANTE']; ?></td>
                        <td><?php echo $estado; ?></td>
                        <td><?php echo $estado_cotizacion; ?></td>
                      </tr>
                      <?php
                    }
                  }
                  ?>
              </tbody>
            </table>


            <table class="usuarios-table" id="search-table-excel" style="display: none">
              <thead>
                <tr>
                  <th>ID Viaje <i class="fas fa-angle-down"></i></th>
                  <th>Fecha Viaje <i class="fas fa-angle-down"></i></th>
                  <th>ID Cotización <i class="fas fa-angle-down"></i></th>
                  <th>ID TTA <i class="fas fa-angle-down"></i></th>
                  <th>ID Solicitante <i class="fas fa-angle-down"></i></th>
                  <th>Estado Viaje </th>
                  <th>Estado Cotizacion </th>
                </tr>
              </thead>
              <tbody id="tbody">
                  <?php
                  if(isset($cotizaciones)){
                    for ($i=0; $i < count($cotizaciones); $i++) {
                      if ($cotizaciones[$i]['visibilidad'] == 1 && $cotizaciones[$i]['COMPRADA'] == 0) {
                        $estado_cotizacion = "En Venta";
                      } elseif ($cotizaciones[$i]['visibilidad'] == 1 && $cotizaciones[$i]['COMPRADA'] == 1) {
                        $estado_cotizacion = "Elegida";
                      } elseif ($cotizaciones[$i]['visibilidad'] == 0 && $cotizaciones[$i]['COMPRADA'] == 0) {
                        $estado_cotizacion = "Rechazada";
                      } else {
                        $estado_cotizacion = "Ganadora";
                      }
                      //echo '<tr class="'.$cotizaciones[$i]['ESTADO'].'">';
                      ?>
                      <tr>
                        <td><?php echo $cotizaciones[$i]['ID_VIAJE']; ?></td>
                        <td><?php echo $cotizaciones[$i]['FECHA_SALIDA']; ?></td>
                        <td><?php echo $cotizaciones[$i]['ID_COTIZACION']; ?></td>
                        <td><?php echo $cotizaciones[$i]['ID_TTA']; ?></td>
                        <td><?php echo $cotizaciones[$i]['ID_SOLICITANTE']; ?></td>
                        <td><?php echo $cotizaciones[$i]['ESTADO']; ?></td>
                        <td><?php echo $estado_cotizacion; ?></td>
                      </tr>
                      <?php
                    }
                  }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <script>

      function exportarTabla(type){
        var data = document.getElementById('search-table-excel');
        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64'});

        XLSX.writeFile(file, 'file.' + type);
      }

    </script>
  </body>
</html>
