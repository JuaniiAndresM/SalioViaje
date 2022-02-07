<?php 

  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');
  }else{

  }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Editar Perfil</title>

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
          <h2>Editar Perfil</h2>
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
      <div class="profile-wrapper">

        <div class="user-info">
          <div class="user-left">
            <div class="user-icon">
              <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="Logo SalióViaje">
            </div>
            <div class="user-desc">
              <h2><?php echo $_SESSION['usuario']; ?></h2>
              <p><i class="fas fa-bus"></i> <?php echo $_SESSION['tipo_usuario']; ?></p>

              <?php 

              if($tipo == 2 || $tipo == 3){
                echo '<p class="calificacion">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                      </p>';
              }
              ?>
              
            </div>
          </div>
          <div class="user-right">
            <div class="button-wrapper">
            <?php 
                echo '<button class="button"><i class="fas fa-edit"></i></button>';
                echo '<button class="button"><i class="fas fa-star"></i></button>';
            ?>
            </div>
          </div>
        </div>

        <div class="profile-grid">
          <div class="user-informacion">
            <h3><i class="fas fa-address-card"></i> Información Personal</h3>

            <div class="informacion-wrapper">

              <div class="info">
                <b><i class="far fa-address-card"></i> C.I</b>
                
                <p>5487923-9</p>
              </div>
              <div class="info">
                <b><i class="far fa-envelope"></i> Correo Electrónico</b>
                <p>thewolfmodzyt@gmail.com</p>
              </div>
              <div class="info">
                <b><i class="fas fa-thumbtack"></i> Dirección</b>
                <p>Canelones, El Pinar, Rondeau.</p>
              </div>
              <div class="info">
                <b><i class="fas fa-phone"></i> Teléfono</b>
                <p>098234717</p>
              </div>
              <div class="info">
                <b><i class="fas fa-bus"></i> Tipo de Usuario</b>
                <p>TTA</p>
              </div>
            </div>
          </div>

          <div class="viajes-wrapper">

            <?php

              if($tipo == 1){
                echo '<h3><i class="fas fa-history"></i> Historial de Viajes</h3>
                <div class="search">
                  <i class="fas fa-search"></i>
                  <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarusuarios()"/>
                </div>
                <div class="table-wrapper">
                  <table class="table-viajes">
                    <thead>
                      <tr>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Fecha</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Montevideo</td>
                        <td>Canelones</td>
                        <td>17/02/2022</td>
                        <td>
                          <div class="button-wrapper">
                            <button class="button"><i class="far fa-eye"></i></button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>P. Del Este</td>
                        <td>Carrasco</td>
                        <td>22/03/2022</td>
                        <td>
                          <div class="button-wrapper">
                            <button class="button"><i class="far fa-eye"></i></button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>';
              }else if($tipo == 2 || $tipo == 3){
                echo '<h3><i class="fas fa-building"></i> Tus Empresas</h3>
                      <div class="search">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarusuarios()"/>
                      </div>
                      <div class="empresas">

                        <div class="empresa">
                          <div class="empresa-left">
                            <div class="empresa-icon">
                              <i class="fas fa-building"></i>
                            </div>
                            <div class="empresa-info">
                              <h3>Nombre de la Empresa</h3>
                              <p><i class="fas fa-bus"></i> 2 Vehiculos</p>
                            </div>
                          </div>
                          <div class="empresa-button">
                            <button class="button"><i class="far fa-eye"></i></button>
                            <button class="button"><i class="fas fa-edit"></i></button>
                            <button class="button"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </div>
            
                      </div>';
              }

            ?>
          </div>
        </div>
        <div class="profile_grid2"></div>

        
      </div>
    </section>
  </body>
</html>
