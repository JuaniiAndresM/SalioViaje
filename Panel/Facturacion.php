<?php 
require_once '../PHP/procedimientosBD.php';

$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');
  }elseif($_SESSION['datos_usuario']['TIPO_USUARIO'] == "PAX" || $_SESSION['datos_usuario']['TIPO_USUARIO'] == "HTL") {
    header('Location: https://www.salioviaje.com.uy/Login');
  }

$bd = new procedimientosBD();
if($_SESSION['datos_usuario']['TIPO_USUARIO'] == "ADM"){
  $viajes = $bd->traer_oportunidades_por_id_tta_seccion_facturacion_admin();
}else{
  $viajes = $bd->traer_oportunidades_por_id_tta_seccion_facturacion($_SESSION['datos_usuario']['ID']);
}
$viajes = json_decode($viajes, true);
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Facturación</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Facturacion" />
    <meta property="og:title" content="SalióViaje | Facturación" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Facturacion" />
    <meta
      property="twitter:title"
      content="SalióViaje | Facturación"
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
    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>

    <script src="https://www.salioviaje.com.uy/Javascript/panel.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
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
          <h2>Facturación</h2>
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
            <h2><i class="fas fa-wallet"></i> Facturación</h2>
          </div>
          <div class="filters">
            <div class="search">
              <i class="fas fa-search"></i>
              <input
                type="text"
                placeholder="Buscar"
                id="searchbar"
                onkeyup="buscarUsuarios(8)"
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
          <div class="exportar-section">
              <button id="button-exportar" onclick="exportarTabla('xlsx')"><i class="fas fa-file-excel"></i> Exportar Tabla</button>
          </div>
          <div class="table-overflow">
            <table class="usuarios-table" id="search-facturacion-table">
              <thead>
                <tr>
                  <th>ID Viaje<i class="fas fa-angle-down"></i></th>
                  <th>Fecha <i class="fas fa-angle-down"></i></th>
                  <th>Modalidad <i class="fas fa-angle-down"></i></th>
                  <th>Destino <i class="fas fa-angle-down"></i></th>
                  <th>Precio <i class="fas fa-angle-down"></i></th>
                  <th>Comisión SV <i class="fas fa-angle-down"></i></th>
                  <th>N° Factura <i class="fas fa-angle-down"></i></th>
                  <th>MTOP <i class="fas fa-angle-down"></i></th>
                </tr>
              </thead>
              <tbody id="tbody-facturacion">
                <?php
                  for ($i=0; $i < count($viajes); $i++) { 

                    
                    if ($viajes[$i]['PRECIO'] < 2150) {
                      $comision = $viajes[$i]['PRECIO'] * 0.07; // Regla de tres
                      $comision = round($comision, 0);
                    }else {
                      $comision = 150;
                    }

                    $PRECIO_CON_DESCUENTO_APLICADO = round($viajes[$i]['PRECIO'] - $viajes[$i]['PRECIO'] * ($viajes[$i]['DESCUENTO'] / 100));
                    
                    ?>
                    <tr>
                      <td><?php echo $viajes[$i]['ID']; ?></td>
                      <td><?php echo $viajes[$i]['FECHA']; ?></td>
                      <td><?php echo $viajes[$i]['MODALIDAD']; ?></td>
                      <td><?php echo $viajes[$i]['DESTINO']; ?></td>
                      <td>$<?php echo $PRECIO_CON_DESCUENTO_APLICADO; ?></td>
                      <td>$<?php echo $comision; ?></td>
                      <td>000000</td>
                      <td>-</td>
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

    <script>

      function exportarTabla(type){
        var data = document.getElementById('search-facturacion-table');
        var file = XLSX.utils.table_to_book(data, {sheet: "Facturación"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64'});

        XLSX.writeFile(file, 'Tabla-Facturación.' + type);
      }

    </script>
  </body>
</html>
