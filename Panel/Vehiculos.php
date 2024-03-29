<?php

require_once '../PHP/procedimientosBD.php';

$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: https://www.salioviaje.com.uy/Login');

} else {
    if ($_SESSION['tipo_usuario'] != "Administrador" && $_SESSION['tipo_usuario'] != "Transportista" && $_SESSION['tipo_usuario'] != "Chofer") {
        header('Location: https://www.salioviaje.com.uy/');
    } else {
        $info_usuario = new procedimientosBD();
        if ($_SESSION['tipo_usuario'] == "Administrador") {
            $vehiculos = $info_usuario->datos_vehiculos();
        } else {
            $usuario = $info_usuario->info_usuario_profile($_SESSION['datos_usuario']['ID']);
            $empresas = $info_usuario->traer_empresas_usuario($usuario[0]["ID"]);
            if($empresas != null){
              $size_e = sizeof($empresas);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Vehículos</title>

    <!-- // Meta Etiquetas -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="robots" content="noindex,nofollow"/>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    />

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Vehiculos" />
    <meta property="og:title" content="SalióViaje | Vehículos" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Vehiculos" />
    <meta
      property="twitter:title"
      content="SalióViaje | Vehículos"
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
          <h2>Vehículos</h2>
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
            <h2><i class="fas fa-bus"></i> Vehículos</h2>
          </div>
          <div class="filters">
            <div class="search">
              <i class="fas fa-search"></i>
              <input
                type="text"
                placeholder="Buscar"
                id="searchbar"
                onkeyup="buscarUsuarios(7)"
              />
            </div>
          </div>
          <div class="table-overflow">
            <table class="usuarios-table" id="search-table-vehiculos">
              <thead>
                <tr>
                  <th>ID <i class="fas fa-angle-down"></i></th>
                  <th>Matrícula <i class="fas fa-angle-down"></i></th>
                  <th>Marca <i class="fas fa-angle-down"></i></th>
                  <th>Modelo <i class="fas fa-angle-down"></i></th>
                  <th>Combustible <i class="fas fa-angle-down"></i></th>
                  <th>Capacidad <i class="fas fa-angle-down"></i></th>
                  <th>Equipaje <i class="fas fa-angle-down"></i></th>
                  <th>RUT Empresa <i class="fas fa-angle-down"></i></th>
                  <th>RUT Empresa Contratista <i class="fas fa-angle-down"></i></th>
                  <th>Pet Friendly <i class="fas fa-angle-down"></i></th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tbody">
              <?php
if ($_SESSION['tipo_usuario'] != "Administrador" && $_SESSION['tipo_usuario'] != "Transportista") {

    $vehiculos = json_decode($info_usuario->traer_datos_vehiculo($_SESSION['datos_usuario']['ID']), true);
    if($vehiculos != null){
      $size = sizeof($vehiculos);
    }
    

    for ($a = 0; $a < $size; $a++) {
        if ($size != 0) {

            if ($vehiculos[$a]['PET_FRIENDLY'] == 1) {
                $pet_friendly = "No";
            } else if ($vehiculos[$a]['PET_FRIENDLY'] == 2) {
                $pet_friendly = "Si";
            }

            echo '<tr>
                      <td>' . $vehiculos[$a]['ID'] . '</td>
                      <td>' . $vehiculos[$a]['MATRICULA'] . '</td>
                      <td>' . $vehiculos[$a]['MARCA'] . '</td>
                      <td>' . $vehiculos[$a]['MODELO'] . '</td>
                      <td>' . $vehiculos[$a]['COMBUSTIBLE'] . '</td>
                      <td>' . $vehiculos[$a]['CAPACIDAD'] . '</td>
                      <td>' . $vehiculos[$a]['EQUIPAJE'] . '</td>
                      <td>' . $vehiculos[$a]['RUT_EM'] . '</td>
                      <td>' . $vehiculos[$a]['RUT_EC'] . '</td>
                      <td>' . $pet_friendly . '</td>
                    </tr>';

        }
    }
} else if ($_SESSION['tipo_usuario'] == "Transportista") {

  $vehiculos = json_decode($info_usuario->traer_datos_vehiculo($_SESSION['datos_usuario']['ID']), true);
  $vehiculos_chofer = json_decode($info_usuario->traer_vehiculos_empresas_choferes_por_tta_id($_SESSION['datos_usuario']['ID']), true);

  if($vehiculos != null){
    $size = sizeof($vehiculos);
    $size_vehiculos_choferes = sizeof($vehiculos_chofer);
  }
  

  for ($a = 0; $a < $size; $a++) {
      if ($size != 0) {

          if ($vehiculos[$a]['PET_FRIENDLY'] == 1) {
              $pet_friendly = "No";
          } else if ($vehiculos[$a]['PET_FRIENDLY'] == 2) {
              $pet_friendly = "Si";
          }

          echo '<tr>
                    <td>' . $vehiculos[$a]['ID'] . '</td>
                    <td>' . $vehiculos[$a]['MATRICULA'] . '</td>
                    <td>' . $vehiculos[$a]['MARCA'] . '</td>
                    <td>' . $vehiculos[$a]['MODELO'] . '</td>
                    <td>' . $vehiculos[$a]['COMBUSTIBLE'] . '</td>
                    <td>' . $vehiculos[$a]['CAPACIDAD'] . '</td>
                    <td>' . $vehiculos[$a]['EQUIPAJE'] . '</td>
                    <td>' . $vehiculos[$a]['RUT_EM'] . '</td>
                    <td>-</td>
                    <td>' . $pet_friendly . '</td>
                    <td>
                      <div class="button-wrapper">
                        <button class="button tooltip left" data-tooltip="Preferencias" onclick="preferenciasVehiculos('.$vehiculos[$a]['ID'].',1,\''.$vehiculos[$a]['MATRICULA'].'\')"><i class="fa-solid fa-gear"></i></button>
                      </div>
                    </td>
                  </tr>';

      }
  }
  for ($a = 0; $a < $size_vehiculos_choferes; $a++) {
    if ($size_vehiculos_choferes != 0) {

        if ($vehiculos_chofer[$a]['PET_FRIENDLY'] == 1) {
            $pet_friendly = "No";
        } else if ($vehiculos_chofer[$a]['PET_FRIENDLY'] == 2) {
            $pet_friendly = "Si";
        }

        echo '<tr>
                  <td>' . $vehiculos_chofer[$a]['ID'] . '</td>
                  <td>' . $vehiculos_chofer[$a]['MATRICULA'] . '</td>
                  <td>' . $vehiculos_chofer[$a]['MARCA'] . '</td>
                  <td>' . $vehiculos_chofer[$a]['MODELO'] . '</td>
                  <td>' . $vehiculos_chofer[$a]['COMBUSTIBLE'] . '</td>
                  <td>' . $vehiculos_chofer[$a]['CAPACIDAD'] . '</td>
                  <td>' . $vehiculos_chofer[$a]['EQUIPAJE'] . '</td>
                  <td>' . $vehiculos_chofer[$a]['RUT_EM'] . '</td>
                  <td>' . $vehiculos_chofer[$a]['RUT_EC'] . '</td>
                  <td>' . $pet_friendly . '</td>
                  <td>
                    <div class="button-wrapper">
                      <button class="button tooltip left" data-tooltip="Preferencias" onclick="preferenciasVehiculos('.$vehiculos_chofer[$a]['ID'].',1,\''.$vehiculos_chofer[$a]['MATRICULA'].'\')"><i class="fa-solid fa-gear"></i></button>
                    </div>
                  </td>
                </tr>';

    }
}

} else {
    if ($vehiculos === null) {

    } else {
        $size = sizeof($vehiculos);
        for ($i = 0; $i < sizeof($vehiculos); $i++) {
            if ($vehiculos[$i]['PET_FRIENDLY'] == 1) {
                $pet_friendly = "No";
            } else if ($vehiculos[$i]['PET_FRIENDLY'] == 2) {
                $pet_friendly = "Si";
            }

            echo '<tr>
                        <td>' . $vehiculos[$i]['ID'] . '</td>
                        <td>' . $vehiculos[$i]['MATRICULA'] . '</td>
                        <td>' . $vehiculos[$i]['MARCA'] . '</td>
                        <td>' . $vehiculos[$i]['MODELO'] . '</td>
                        <td>' . $vehiculos[$i]['COMBUSTIBLE'] . '</td>
                        <td>' . $vehiculos[$i]['CAPACIDAD'] . '</td>
                        <td>' . $vehiculos[$i]['EQUIPAJE'] . '</td>
                        <td>' . $vehiculos[$i]['RUT_EM'] . '</td>
                        <td>' . $vehiculos[$i]['RUT_EC'] . '</td>
                        <td>' . $pet_friendly . '</td>
                    </tr>';
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
