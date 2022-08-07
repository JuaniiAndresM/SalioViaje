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

  $viajes_mtop = new procedimientosBD();
  $viajes = json_decode($viajes_mtop->tabla_viajes_mtop(),true);


?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Permisos MTOP</title>

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
    <meta property="og:title" content="SalióViaje | Permisos MTOP" />
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
      content="SalióViaje | Permisos MTOP"
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

    <script src="https://www.salioviaje.com.uy/Plugins/JQuery/jquery.min.js"></script>
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>

    <script src="https://www.salioviaje.com.uy/Javascript/panel.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
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
          <h2>Permisos MTOP</h2>
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
            <h2><i class="fa-solid fa-file-signature"></i> Permisos MTOP</h2>
          </div>
          <div class="filters">
            <div class="search">
              <i class="fas fa-search"></i>
              <input
                type="text"
                placeholder="Buscar"
                id="searchbar"
                onkeyup="buscarUsuarios(11)"
              />
            </div>

            <div class="checkboxs">

              <div class="checkbox">
                <input type="checkbox" name="" id="Aprobado" checked />
                <p>Aprobado</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="" id="Rechazado" checked />
                <p>Rechazado</p>
              </div>

            </div>
          </div>

          <!-- <div class="exportar-section">
              <button id="button-exportar" onclick="exportarTabla('xlsx')"><i class="fas fa-file-excel"></i> Exportar Tabla</button>
          </div> -->

          <div class="table-overflow">
            <table class="usuarios-table" id="search-table-permisosmtop">
              <thead>
                <tr>
                  <th>ID Viaje<i class="fas fa-angle-down"></i></th>
                  <th>ID Usuario <i class="fas fa-angle-down"></i></th>
                  <th>URL <i class="fas fa-angle-down"></i></th>
                  <th>Estado <i class="fas fa-angle-down"></i></th>
                </tr>
              </thead>
              <tbody id="tbody">
                <?php 
                if (isset($viajes)) {
                  for ($i=0; $i < count($viajes); $i++) { 
                    ?>
                    <tr>
                      <td><?php echo $viajes[$i]['ID_VIAJE']; ?></td>
                      <td><?php echo $viajes[$i]['ID_TRANSPORTISTA']; ?></td>
                      <td>
                          <a href="https://www.salioviaje.com.uy/" target="_blank">https://salioviaje.com.uy/</a>
                      </td>
                      <td>
                      <?php 
                        if($viajes[$i]['ESTADO_MTOP'] == 1){
                          ?>
                          <select class="select-estado-<?php echo $viajes[$i]['ID_VIAJE']; ?>" onchange="estadoMTOP(<?php echo $viajes[$i]['ID_VIAJE']; ?>)">
                            <option value="0" disabled selected>Seleccione un Estado</option> 
                            <option value="1">Aprobado</option>
                            <option value="2">Rechazado</option>
                          </select>
                          <?php 
                        }elseif ($viajes[$i]['ESTADO_MTOP'] == 2) {
                          ?>
                          <select class="select-estado-<?php echo $viajes[$i]['ID_VIAJE']; ?>" onchange="estadoMTOP(<?php echo $viajes[$i]['ID_VIAJE']; ?>)">
                            <option value="0" disabled>Seleccione un Estado</option> 
                            <option value="1">Aprobado</option>
                            <option value="2" selected>Rechazado</option>
                          </select>
                          <?php 
                        }else{
                          ?>
                          <select class="select-estado-<?php echo $viajes[$i]['ID_VIAJE']; ?>" onchange="estadoMTOP(<?php echo $viajes[$i]['ID_VIAJE']; ?>)">
                            <option value="0" disabled >Seleccione un Estado</option> 
                            <option value="1" selected>Aprobado</option>
                            <option value="2">Rechazado</option>
                          </select>
                          <?php 
                        }
                      ?>

                      </td>
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
                  <th>ID Viaje</th>
                  <th>ID Usuario</th>
                  <th>URL</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody id="tbody">
                <tr>
                    <td>001</td>
                    <td>001</td>
                    <td id="mtop-url-001">https://salioviaje.com.uy/</td>
                    <td id="estado-mtop-001">Aprobado</td>
                </tr>
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
