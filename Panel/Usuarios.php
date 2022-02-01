<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje - Usuarios</title>

    <!-- // Verifico sesion -->

    <?php 
          session_start(); 
          if(!isset($_SESSION['usuario'])){
            header('Location: https://www.salioviaje.com.uy/Login');
          }
         ?>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Usuarios" />
    <meta property="og:title" content="SalióViaje - Usuarios" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Usuarios" />
    <meta
      property="twitter:title"
      content="SalióViaje - Usuarios"
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
    <script type="text/javascript">
            window.onload = function(){
              let seccion = "usuarios"
              traerUsuarios(seccion)
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
          <h2>Usuarios</h2>
        </div>
      </div>
      <div class="header-right">
        <div class="header-user">
          <div class="icon"><i class="fab fa-apple"></i></div>
          <div class="user">
            <h2>John Doe</h2>
            <p><i class="fas fa-user-tie"></i> Administrador</p>
          </div>
          <button><i class="fas fa-sign-out-alt"></i></button>
        </div>
      </div>
    </header>

    <nav class="nav-hidden active" id="panel-navbar"></nav>

    <section class="panel" id="panel">
      <div class="section-usuarios">
        <div class="usuarios-recientes">
          <div class="usuarios-info">
            <h2><i class="fas fa-user-friends"></i> Usuarios</h2>
          </div>
          <div class="filters">
            <div class="search">
              <i class="fas fa-search"></i>
              <input
                type="text"
                placeholder="Buscar"
                id="searchbar"
                onkeyup="buscarUsuarios()"
              />
            </div>

            <div class="checkboxs">
              <div class="checkbox">
                <input type="checkbox" name="" id="" checked />
                <p>PAX</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="" id="" checked />
                <p>TTA</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="" id="" checked />
                <p>CHO</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="" id="" checked />
                <p>ANF</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="" id="" checked />
                <p>HTL</p>
              </div>
            </div>
          </div>
          <div class="table-overflow">
            <table class="usuarios-table" id="search-table">
              <thead>
                <tr>
                  <th id="ID">ID <i class="fas fa-angle-down"></i></th>
                  <th>Tipo <i class="fas fa-angle-down"></i></th>
                  <th>CI <i class="fas fa-angle-down"></i></th>
                  <th>Email <i class="fas fa-angle-down"></i></th>
                  <th>Nombre <i class="fas fa-angle-down"></i></th>
                  <th>Apellido <i class="fas fa-angle-down"></i></th>
                  <th>Dirección <i class="fas fa-angle-down"></i></th>
                  <th>Barrio <i class="fas fa-angle-down"></i></th>
                  <th>Departamento <i class="fas fa-angle-down"></i></th>
                  <th>Teléfono <i class="fas fa-angle-down"></i></th>
                  <th>Agencia <i class="fas fa-angle-down"></i></th>
                  <th>Nombre Hotel <i class="fas fa-angle-down"></i></th>
                  <th>Dirección Hotel <i class="fas fa-angle-down"></i></th>
                  <th>Supervisor <i class="fas fa-angle-down"></i></th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tbody"></tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
