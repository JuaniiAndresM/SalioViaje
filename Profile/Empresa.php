<?php 
require_once '../PHP/procedimientosBD.php';
  session_start(); 


  if(!isset($_SESSION['usuario'])){
    header('Location: /SalioViaje/Login');
  }else{
    $tipo = 0;

    if(isset($_SESSION['tipo_usuario'])){

      switch($_SESSION['tipo_usuario']){
        case "Pasajero":
          $tipo = 1;
          break;

        case "Chofer":
          $tipo = 2;
          break;

        case "Transportista":
          $tipo = 3;
          break;

      }
    }

    $rut = $_GET['RUT'];

    $info_empresa = new procedimientosBD();

    $usuario = $info_empresa->traer_datos_empresa($rut);
    $vehiculos = $info_empresa->traer_datos_vehiculo($rut);
    $choferes = $info_empresa->traer_choferes($rut);

    if(empty($usuario)){
      header('Location: Failed/');
    }
    
  }

  
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Empresa</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Profile" />
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
          <h2>Empresa</h2>
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
      <div class="profile-wrapper">

        <div class="user-info">
          <div class="user-left">
            <div class="user-icon">
              <img src="/SalioViaje/media/svg/Logo-SalioViaje.svg" alt="Logo SalióViaje">
            </div>
            <div class="user-desc">
              <h2><?php echo $usuario['NOMBRE_COMERCIAL'];?></h2>
              <p><i class="fas fa-building"></i> Empresa</p>
              
            </div>
          </div>
          <div class="user-right">
            <div class="button-wrapper">
            <?php 
                echo '<button class="button" onclick="editarEmpresa('.$usuario['RUT'].')"><i class="fas fa-edit"></i></button>';
            ?>
            </div>
          </div>
        </div>

        <div class="profile-grid">
            <div class="user-informacion">

                <h3><i class="fas fa-bus"></i> Vehiculos de la Empresa</h3>

                <div class="search">
                <i class="fas fa-search"></i>
                <input
                    type="text"
                    placeholder="Buscar"
                    id="searchbar"
                    onkeyup="buscarUsuarios()"
                />
                </div>
                <div class="table-overflow">
                            <table class="vehiculos-table" id="search-table">
                                <thead>
                                    <tr>
                                    <th>ID <i class="fas fa-angle-down"></i></th>
                                    <th>Matrícula <i class="fas fa-angle-down"></i></th>
                                    <th>Marca <i class="fas fa-angle-down"></i></th>
                                    <th>Modelo <i class="fas fa-angle-down"></i></th>
                                    <th>Combustible <i class="fas fa-angle-down"></i></th>
                                    <th>Capacidad <i class="fas fa-angle-down"></i></th>
                                    <th>Equipaje <i class="fas fa-angle-down"></i></th>
                                    <th>RUT E <i class="fas fa-angle-down"></i></th>
                                    <th>Pet Friendly <i class="fas fa-angle-down"></i></th>
                                    <th></th>
                                    </tr>
                                </thead>
                <?php 
                  if($vehiculos === null){
                    
                  }else{
                    $size = sizeof($vehiculos);
                    for($i = 0; $i< sizeof($vehiculos); $i++){
                      echo '
                                <tbody id="tbody">
                                    <td>'.$vehiculos[$i]['ID'].'</td>
                                    <td>'.$vehiculos[$i]['MATRICULA'].'</td>
                                    <td>'.$vehiculos[$i]['MARCA'].'</td>
                                    <td>'.$vehiculos[$i]['MODELO'].'</td>
                                    <td>'.$vehiculos[$i]['COMBUSTIBLE'].'</td>
                                    <td>'.$vehiculos[$i]['CAPACIDAD'].'</td>
                                    <td>'.$vehiculos[$i]['EQUIPAJE'].'</td>
                                    <td>'.$vehiculos[$i]['RUT_EM'].'</td>
                                    <td>'.$vehiculos[$i]['PET_FRIENDLY'].'</td>
                                </tbody>';
                    }
                  }
                ?>
                </table>
                </div>
            </div>

          <div class="viajes-wrapper">
                <h3><i class="fas fa-user-friends"></i> Choferes Asociados</h3>

                <div class="search">
                  <i class="fas fa-search"></i>
                  <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarusuarios()"/>
                </div>
                <div class="empresas">
                <?php 
                  if($choferes === null){
                    
                  }else{
                    $size = sizeof($choferes);
                    for($i = 0; $i< sizeof($choferes); $i++){
                      echo '
                      <div class="empresa">
                        <div class="empresa-left">
                          <div class="empresa-icon">
                              <i class="fas fa-user"></i>
                          </div>
                          <div class="empresa-info">
                              <h3>'.$choferes[$i]['NOMBRE'].'</h3>
                          </div>
                        </div>
                        <div class="empresa-button">
                          <button class="button" id="'.$choferes[$i]['ID'].'" onclick="ver_usuario('.$choferes[$i]['ID'].')"><i class="far fa-eye"></i></button>
                          <button class="button" id="'.$choferes[$i]['ID'].'" onclick="eliminar_usuario('.$choferes[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </div>';
                    }
                  }
                ?>
                </div>
          </div>
        </div>
        <div class="profile_grid2"></div>

        
      </div>
    </section>
  </body>
</html>
