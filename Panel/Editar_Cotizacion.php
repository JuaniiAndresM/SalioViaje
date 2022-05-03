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

  $cotizaciones = json_decode($cotizaciones->traer_viajes_cotizando_panel_admin(),true);

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
              filtros()
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
            <!-- <div class="search">
              <i class="fas fa-search"></i>
              <input
                type="text"
                placeholder="Buscar"
                id="searchbar"
                onkeyup="buscarUsuarios(3)"
              />
            </div> -->

            <!-- <div class="checkboxs">

              <div class="checkbox">
                <input type="checkbox" name="" id="tta" checked />
                <p>TTA</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="" id="cho" checked />
                <p>CHO</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="" id="agt" checked />
                <p>AGT</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="" id="anf" checked />
                <p>ANF</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="" id="htl" checked />
                <p>HTL</p>
              </div>

            </div> -->
          </div>
          <div class="table-overflow">
            <table class="usuarios-table">
              <thead>
                <tr>
                  <th>ID <i class="fas fa-angle-down"></i></th>
                  <th>Origen <i class="fas fa-angle-down"></i></th>
                  <th>Destino <i class="fas fa-angle-down"></i></th>
                  <th>Fecha <i class="fas fa-angle-down"></i></th>
                  <th>Estado <i class="fas fa-angle-down"></i></th>
                </tr>
              </thead>
              <tbody id="tbody">
                  <?php
                  if(isset($cotizaciones)){
                    for ($i=0; $i < count($cotizaciones); $i++) {
                      ?>
                      <tr>
                        <td><?php echo $cotizaciones[$i]['ID'] ?></td>
                        <td><?php 
                          
                          if ($cotizaciones[$i]['DIRECCION_ORIGEN'] != null && $cotizaciones[$i]['BARRIO_ORIGEN'] != null && $cotizaciones[$i]['LOCALIDAD_ORIGEN'] != null) {
                            echo $cotizaciones[$i]['DIRECCION_ORIGEN'].", ".$cotizaciones[$i]['BARRIO_ORIGEN'].", ".$cotizaciones[$i]['LOCALIDAD_ORIGEN']."."; 
                          } elseif ($cotizaciones[$i]['DIRECCION_ORIGEN'] == null && $cotizaciones[$i]['BARRIO_ORIGEN'] == null && $cotizaciones[$i]['LOCALIDAD_ORIGEN'] != null){
                            echo $cotizaciones[$i]['LOCALIDAD_ORIGEN']."."; 
                          } else {
                            echo $cotizaciones[$i]['BARRIO_ORIGEN'].", ".$cotizaciones[$i]['LOCALIDAD_ORIGEN'].".";
                          }
                        
                        ?></td>
                        <td><?php 
                          
                          if ($cotizaciones[$i]['DIRECCION_DESTINO'] != null && $cotizaciones[$i]['BARRIO_DESTINO'] != null && $cotizaciones[$i]['LOCALIDAD_DESTINO'] != null) {
                            echo $cotizaciones[$i]['DIRECCION_DESTINO'].", ".$cotizaciones[$i]['BARRIO_DESTINO'].", ".$cotizaciones[$i]['LOCALIDAD_DESTINO']."."; 
                          } elseif ($cotizaciones[$i]['DIRECCION_DESTINO'] == null && $cotizaciones[$i]['BARRIO_DESTINO'] == null && $cotizaciones[$i]['LOCALIDAD_DESTINO'] != null){
                            echo $cotizaciones[$i]['LOCALIDAD_DESTINO']."."; 
                          } elseif ($cotizaciones[$i]['DIRECCION_DESTINO'] != null && $cotizaciones[$i]['BARRIO_DESTINO'] == null && $cotizaciones[$i]['LOCALIDAD_DESTINO'] == null){
                            echo $cotizaciones[$i]['DIRECCION_DESTINO']."."; 
                          } else {
                            echo $cotizaciones[$i]['BARRIO_DESTINO'].", ".$cotizaciones[$i]['LOCALIDAD_DESTINO'].".";
                          }
                        
                        ?></td>
                        <td><?php echo $cotizaciones[$i]['FECHA_SALIDA'] ?></td>
                        <td>
                          <?php
                          if ($cotizaciones[$i]['ESTADO'] == "cotizando") {
                            ?>
                            <select class="select-estado" id="estado-cotizacion-<?php echo $cotizaciones[$i]['ID'] ?>" onchange="cambiar_estado_cotizacion_panel_admin(<?php echo $cotizaciones[$i]['ID'] ?>)">
                              <option value="0" disabled>Seleccione un Estado</option> 
                              <option value="cotizando" selected>Cotizando</option>
                              <option value="cotizado">Cotizado</option>
                              <option value="aceptado">Aceptado</option>
                              <option value="reconfirmado">Reconfirmado</option>
                            </select>
                            <?php
                          }else {
                            ?>
                            <select class="select-estado" id="estado-cotizacion-<?php echo $cotizaciones[$i]['ID'] ?>" onchange="cambiar_estado_cotizacion_panel_admin(<?php echo $cotizaciones[$i]['ID'] ?>)">
                              <option value="0" disabled>Seleccione un Estado</option> 
                              <option value="cotizando">Cotizando</option>
                              <option value="cotizado" selected>Cotizado</option>
                              <option value="aceptado">Aceptado</option>
                              <option value="reconfirmado">Reconfirmado</option>
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
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
