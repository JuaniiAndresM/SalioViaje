<?php 

  session_start(); 

  $tipo = 0;

  if(!isset($_SESSION['usuario'])){
    header('Location: /SalioViaje/Login');

  }else{
    if($_SESSION['tipo_usuario'] != "Pasajero" ){
      switch($_SESSION['tipo_usuario']){
        case "Administrador":
          $tipo = 1;
          break;
    
        case "Transportista": case "Chofer":
          $tipo = 2;
          break;
        
        default:
          $tipo = 0;
          break;
      }
    }else{
      header('Location: /SalioViaje/');
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SalióViaje | Dashboard</title>
    
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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Dashboard" />
    <meta property="og:title" content="SalióViaje | Dashboard" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Dashboard" />
    <meta
      property="twitter:title"
      content="SalióViaje | Dashboard"
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
        <script type="text/javascript">
            window.onload = function(){
              tabla_usuarios_dashboard()
              tabla_empresas_dashboard()
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
              <h2>Dashboard</h2>
            </div>
          </div>
          <div class="header-right">
            <div class="select">
              <i id="icon" class="fas fa-redo-alt"></i>
              <select id="select_actualizar">
                <option value="0" selected>Disabled</option>
                <option value="1">1s</option>
                <option value="2">5s</option>
                <option value="3">10s</option>
                <option value="4">15s</option>
              </select>
            </div>
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


        <?php 

        if($tipo == 1){
          echo '  <section class="panel" id="panel">
                    <div class="panel-cards">
                      <div class="card">
                        <div class="number" id="cantidad-usuarios">

                        </div>
                        <p>Usuarios</p>
                      </div>
                      <div class="card">
                        <div class="number">
                          <h2>-</h2>
                          <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <p>Oportunidades Activas</p>
                      </div>
                      <div class="card">
                        <div class="number">
                          <h2 id="visitas_hoy"></h2>
                          <i class="fas fa-eye"></i>
                        </div>
                        <p>Visitas Hoy</p>
                      </div>
                      <div class="card">
                        <div class="number">
                          <h2>-</h2>
                          <i class="fas fa-leaf"></i>
                        </div>
                        <p>CO<sub>2</sub> Ahorrados</p>
                      </div>
                    </div>
                    <div class="panel-tables">
                      <div class="usuarios-recientes">
                        <div class="usuarios-info">
                          <h2><i class="fas fa-user-friends"></i> Usuarios Registrados</h2>
                          <div class="button-wrapper">
                            <a href="Usuarios.html"><i class="fas fa-list-ul"></i></a>
                          </div>
                        </div>
                        <div class="search">
                          <i class="fas fa-search"></i>
                          <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarUsuarios(1)"/>
                        </div>
                        <table class="usuarios-table" id="search-table">
                          <!-- antes:
                            <tr>
                              <th>
                                Nombre <i class="fas fa-angle-down"></i>
                              </th>
                              <th>Apellido <i class="fas fa-angle-down"></i></th>
                              <th>Tipo <i class="fas fa-angle-down"></i></th>
                              <th>Departamento <i class="fas fa-angle-down"></i></th>
                              <th>Teléfono <i class="fas fa-angle-down"></i></th>
                              <th></th>
                            </tr>
                          -->
                          <thead>
                            <tr>
                              <th>Tipo <i class="fas fa-angle-down"></i></th>
                              <th>
                                Nombre <i class="fas fa-angle-down"></i>
                              </th>
                              <th>Apellido <i class="fas fa-angle-down"></i></th>
                              <th>Departamento <i class="fas fa-angle-down"></i></th>
                              <th>Teléfono <i class="fas fa-angle-down"></i></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody id="tbody-usuarios" class="act">
                          </tbody>
                        </table>
                      </div>
                      <div class="usuarios-propietarios">
                        <div class="usuarios-info">
                          <h2><i class="fas fa-building"></i> Empresas Registradas</h2>
                          <div class="button-wrapper">
                            <a href="Empresas.html"><i class="fas fa-list-ul"></i></a>
                          </div>
                        </div>
                        <div class="search">
                          <i class="fas fa-search"></i>
                          <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarusuarios()"/>
                        </div>
                        <div class="propietarios">

                        </div>
                        
                      </div>
                    </div>
                  </section>';
        }elseif($tipo == 2){
          echo '  <section class="panel" id="panel">
                    <div class="panel-cards">
                        <a href="Agendar" class="card" id="plus">
                          <div class="number">
                            <i class="fas fa-plus"></i>
                          </div>
                          <p>Nuevo Viaje</p>
                        </a>
                        <div class="card">
                          <div class="number">
                            <h2>4</h2>
                            <i class="fas fa-busfas fa-bus"></i>
                          </div>
                          <p>Viajes</p>
                        </div>
                        <div class="card">
                          <div class="number">
                            <h2>2</h2>
                            <i class="fas fa-search-dollar"></i>
                          </div>
                          <p>Oportunidades</p>
                        </div>
                        <div class="card">
                          <div class="number">
                            <h2>1</h2>
                            <i class="fas fa-tags"></i>
                          </div>
                          <p>Ofertas</p>
                        </div>
                      </div>
                      <div class="panel-tables">
                        <div class="usuarios-recientes">
                          <div class="usuarios-info">
                            <h2><i class="fas fa-bus"></i> Tus Viajes</h2>
                            <div class="button-wrapper">
                              <a href="Agendar" class="add"><i class="fas fa-plus"></i></a>
                              <a href="Viajes.html"><i class="fas fa-list-ul"></i></a>
                            </div>
                          </div>
                          <div class="search">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarUsuarios(1)"/>
                          </div>
                          <table class="usuarios-table" id="search-table">
                            <thead>
                              <tr>
                                <th>ID <i class="fas fa-angle-down"></i></th>
                                <th>
                                  Origen <i class="fas fa-angle-down"></i>
                                </th>
                                <th>Destino <i class="fas fa-angle-down"></i></th>
                                <th>Fecha <i class="fas fa-angle-down"></i></th>
                                <th>Estado <i class="fas fa-angle-down"></i></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="tbody"></tbody>
                          </table>
                        </div>
                        <div class="usuarios-propietarios">
                          <div class="usuarios-info">
                            <h2><i class="fas fa-building"></i> Tus Empresas</h2>
                            <div class="button-wrapper">
                              <a href="Empresas.html" class="add"><i class="fas fa-plus"></i></a>
                              <a href="Empresas.html"><i class="fas fa-list-ul"></i></a>
                            </div>
                          </div>
                          <div class="search">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarusuarios()"/>
                          </div>
                          <div class="propietarios">
                
                          </div>
                          
                        </div>
                      </div>
                    </section>';
        }
        ?>


      </body>
</html>