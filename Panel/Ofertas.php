<?php 
require_once '../PHP/procedimientosBD.php';
$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
  session_start(); 

  $tipo = 0;

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');

  }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SalióViaje | Ofertas Dashboard</title>
    
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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Ofertas" />
    <meta property="og:title" content="SalióViaje | Ofertas" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Ofertas" />
    <meta
      property="twitter:title"
      content="SalióViaje | Ofertas"
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
          src="https://kit.fontawesome.com/1e193e3a23.js"
          crossorigin="anonymous"
        ></script>

        <script src="https://www.salioviaje.com.uy/Javascript/panel.js"></script>
        <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
        <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
        <script src="https://www.salioviaje.com.uy/Javascript/cotizaciones.js"></script>
        <script src="https://www.salioviaje.com.uy/t2voice/functionsJS.js"></script>
        <script src="https://www.salioviaje.com.uy/t2voice/send_data.js"></script>
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
              <h2>Ofertas y Promo</h2>
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
                <div class="panel-cards">
                    <a class="card" href="https://www.salioviaje.com.uy/Cargar_Oferta">
                        <div class="number">
                            <h2>+</h2>
                            <i class="fa-solid fa-file-circle-plus"></i>
                        </div>
                        <p>Cargar Oferta</p>
                    </a>
                    <a class="card button" href="">
                        <div class="number">
                            <h2>+</h2>
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>
                        <p>Nueva Promo</p>
                    </a>
                    <a class="card button" href="">
                        <div class="number">
                            <h2>-</h2>
                            <i class="fa-solid fa-sack-dollar"></i>
                        </div>
                        <p>Incentivos</p>
                    </a>
                    <a class="card button" href="Vouchers">
                        <div class="number">
                            <h2>-</h2>
                            <i class="fa-solid fa-ticket"></i>
                        </div>
                        <p>Vouchers</p>
                    </a>
                </div>
                
                <!-- <div class="panel-tables">
                    <div>
                        <div class="usuarios-recientes">
                            <div class="usuarios-info">
                                <h2><i class="fas fa-user-friends"></i> Usuarios Registrados</h2>
                                <div class="button-wrapper">
                                <a href="Usuarios"><i class="fas fa-list-ul"></i></a>
                                </div>
                            </div>
                            <div class="search">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarUsuarios(1)"/>
                            </div>
                            <div class="table-container">
                                <table class="usuarios-table" id="search-table">
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
                        </div>
                    </div>
                        
                    <div class="usuarios-propietarios">
                        <div class="usuarios-info">
                            <h2><i class="fas fa-building"></i> Empresas Registradas</h2>
                            <div class="button-wrapper">
                            <a href="Empresas"><i class="fas fa-list-ul"></i></a>
                            </div>
                        </div>
                        <div class="propietarios"></div>
                    </div>

                </div> -->

            </section>


      </body>
</html>