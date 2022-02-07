<?php 

  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: /SalioViaje/Login');
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
          <h2>Editar Perfil</h2>
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
              <h2><?php echo $_SESSION['usuario']; ?></h2>
              <p><i class="fas fa-bus"></i> <?php echo $_SESSION['tipo_usuario']; ?></p>
              
            </div>
          </div>
        </div>

        <div class="profile-grid">
          <div class="user-informacion">
            <h3><i class="fas fa-address-card"></i> Información Personal</h3>

            <div class="informacion-wrapper">

              <div class="info">
                <b><i class="far fa-address-card"></i> C.I</b>
                <input type="number" placeholder="C.I" value="54879239">
              </div>
              <div class="info">
                <b><i class="fas fa-signature"></i> Nombre</b>
                <input type="text" placeholder="Nombre" value="Juan">
              </div>
              <div class="info">
                <b><i class="fas fa-signature"></i> Apellido</b>
                <input type="text" placeholder="Apellido" value="Morena">
              </div>
              <div class="info">
                <b><i class="far fa-envelope"></i> Correo Electrónico</b>
                <input type="email" placeholder="Correo Electrónico" value="thewolfmodzyt@gmail.com">
              </div>
              <div class="info">
                <b><i class="fas fa-map"></i> Departamento</b>
                <input type="text" placeholder="Departamento" value="Canelones">
              </div>
              <div class="info">
                <b><i class="fas fa-map-marked-alt"></i> Barrio</b>
                <input type="text" placeholder="Barrio" value="El Pinar">
              </div>
              <div class="info">
                <b><i class="fas fa-map-marker-alt"></i> Dirección</b>
                <input type="text" placeholder="BaDirecciónrrio" value="Rondeau">
              </div>
              <div class="info">
                <b><i class="fas fa-phone"></i> Teléfono</b>
                <input type="number" placeholder="Teléfono" value="098234717">
              </div>
              
            </div>
            <div class="button-wrapper">
                <button class="button-guardar"><i class="fas fa-save"></i> Guardar Cambios</button>
            </div>
          </div>

          <div class="viajes-wrapper">
            <h3><i class="fas fa-key"></i> Cambiar PIN</h3>

            <div class="password-change">

              <div class="input">
                <i class="fas fa-lock" id="icon"></i>
                <input
                  type="password"
                  id="password"
                  name="pin"
                  placeholder="PIN Anterior"
                  maxlength="4"
                  pattern="[0-9]{4}"
                />
                <button onclick="passwd(1)" class="password-eye"><i id="passeye" class="fas fa-eye-slash"></i></button>
              </div>

              <div class="input">
                <i class="fas fa-key" id="icon"></i>
                <input
                  type="password"
                  id="password"
                  name="pin"
                  placeholder="Nuevo PIN"
                  maxlength="4"
                  pattern="[0-9]{4}"
                />
                <button onclick="passwd(2)" class="password-eye"><i id="passeye" class="fas fa-eye-slash"></i></button>
              </div>

              <div class="input">
                <i class="fas fa-key" id="icon"></i>
                <input
                  type="password"
                  id="password"
                  name="pin"
                  placeholder="Confirmar Nuevo PIN"
                  maxlength="4"
                  pattern="[0-9]{4}"
                />
                <button onclick="passwd(3)" class="password-eye"><i id="passeye" class="fas fa-eye-slash"></i></button>
              </div>


              <div class="button-wrapper">
                <button class="button-pin"><i class="fas fa-save"></i> Cambiar PIN</button>
              </div>
              

            </div>
          </div>
        </div>
        <div class="profile_grid2"></div>

        
      </div>
    </section>
  </body>
</html>
