<?php 
require_once '../PHP/procedimientosBD.php';
$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');

  }else{
    if($_SESSION['tipo_usuario'] == "Pasajero" || $_SESSION['tipo_usuario'] == "Asesor"){
      header('Location: https://www.salioviaje.com.uy/');
    }else{
      $info_usuario = new procedimientosBD();
      
      if($_SESSION['tipo_usuario'] == "Administrador"){
        $empresas = $info_usuario->datos_empresas();
        //$empresas;
      }else{
        $empresas = $info_usuario->traer_empresas_usuario($_SESSION['datos_usuario']["ID"]);
        $empresas_choferes = json_decode($info_usuario->traer_empresas_choferes_por_tta_id($_SESSION['datos_usuario']["ID"]),true);
      }
    
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Empresas</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Empresas" />
    <meta property="og:title" content="SalióViaje | Empresas" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Empresas" />
    <meta
      property="twitter:title"
      content="SalióViaje | Empresas"
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
          <h2>Empresas</h2>
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
            <h2><i class="fas fa-building"></i> Empresas</h2>
          </div>
          <div class="filters">
            <div class="search">
              <i class="fas fa-search"></i>
              <input
                type="text"
                placeholder="Buscar"
                id="searchbar"
                onkeyup="buscarUsuarios(3)"
              />
            </div>

            <div class="checkboxs">

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

            </div>
          </div>
          <div class="table-overflow">
            <table class="usuarios-table" id="search-table-empresas">
              <thead>
                <tr>
                  <th>ID <i class="fas fa-angle-down"></i></th>
                  <th>RUT <i class="fas fa-angle-down"></i></th>
                  <th>Nombre Comercial <i class="fas fa-angle-down"></i></th>
                  <th>Razón Social <i class="fas fa-angle-down"></i></th>
                  <th>Dueño <i class="fas fa-angle-down"></i></th>
                  <th>Tipo <i class="fas fa-angle-down"></i></th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tbody">
              <?php 
                  if($empresas === null){
                    
                  }else{
                    if($_SESSION['tipo_usuario'] == "Administrador"){
                      $size = sizeof($empresas);
                      for($i = 0; $i< sizeof($empresas); $i++){
                        echo '<tbody id="tbody">
                            <tr class="'.$empresas[$i]['TIPO_USUARIO'].'">
                              <td>'.$empresas[$i]['ID'].'</td>
                              <td>'.$empresas[$i]['RUT'].'</td>
                              <td>'.$empresas[$i]['NOMBRE_EMPRESA'].'</td>
                              <td>'.$empresas[$i]['RAZON_SOCIAL'].'</td>
                              <td>'.$empresas[$i]['ID_OWNER'].'</td>
                              <td>'.$empresas[$i]['TIPO_USUARIO'].'</td>
                            </tr>
                        </tbody>';
                      }
                    } elseif ($_SESSION['tipo_usuario'] == "Transportista") {
                      $size = sizeof($empresas);
                      for($i = 0; $i< sizeof($empresas); $i++){
                        echo '<tbody id="tbody">
                            <tr class="'.$empresas[$i]['TIPO_USUARIO'].'">
                              <td>'.$empresas[$i]['ID'].'</td>
                              <td>'.$empresas[$i]['RUT'].'</td>
                              <td>'.$empresas[$i]['NOMBRE_COMERCIAL'].'</td>
                              <td>'.$empresas[$i]['RAZON_SOCIAL'].'</td>
                              <td>'.$empresas[$i]['ID_USUARIO'].'</td>
                              <td>'.$empresas[$i]['TIPO_USUARIO'].'</td>
                            </tr>
                        </tbody>';
                      }
                      for($i = 0; $i< sizeof($empresas_choferes); $i++){
                        echo '<tbody id="tbody">
                            <tr class="'.$empresas_choferes[$i]['TIPO_USUARIO'].'">
                              <td>'.$empresas_choferes[$i]['ID'].'</td>
                              <td>'.$empresas_choferes[$i]['RUT'].'</td>
                              <td>'.$empresas_choferes[$i]['NOMBRE_COMERCIAL'].'</td>
                              <td>'.$empresas_choferes[$i]['RAZON_SOCIAL'].'</td>
                              <td>'.$empresas_choferes[$i]['ID_USUARIO'].'</td>
                              <td>'.$empresas_choferes[$i]['TIPO_USUARIO'].'</td>
                            </tr>
                        </tbody>';
                      }
                    } else {
                      $size = sizeof($empresas);
                      for($i = 0; $i< sizeof($empresas); $i++){
                        echo '<tbody id="tbody">
                            <tr class="'.$empresas[$i]['TIPO_USUARIO'].'">
                              <td>'.$empresas[$i]['ID'].'</td>
                              <td>'.$empresas[$i]['RUT'].'</td>
                              <td>'.$empresas[$i]['NOMBRE_COMERCIAL'].'</td>
                              <td>'.$empresas[$i]['RAZON_SOCIAL'].'</td>
                              <td>'.$empresas[$i]['ID_USUARIO'].'</td>
                              <td>'.$empresas[$i]['TIPO_USUARIO'].'</td>
                            </tr>
                        </tbody>';
                      }
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
