<?php 

  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: /SalioViaje/Form/Login.php');

  }else{
    if($_SESSION['tipo_usuario'] != "Administrador"){
      header('Location: /SalioViaje/');
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje - Dashboard</title>

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
    <meta property="og:url" content="https://www.salioviaje.com/" />
    <meta property="og:title" content="SalióViaje - Register" />
    <meta
      property="og:description"
      content="Plataforma que optimiza el traslado ocasional de personas."
    />
    <meta
      property="og:image"
      content="https://www.website.com/media/MetaImage.png"
    />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://www.salioviaje.com/" />
    <meta property="twitter:title" content="SalióViaje - Register" />
    <meta
      property="twitter:description"
      content="Plataforma que optimiza el traslado ocasional de personas."
    />
    <meta
      property="twitter:image"
      content="https://www.website.com/media/MetaImage.png"
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
          <h2>Soporte</h2>
        </div>
      </div>
      <div class="header-right">
        <div class="header-user">
          <div class="icon"><i class="fab fa-apple"></i></div>
          <div class="user">
            <h2><?php echo $_SESSION['usuario']; ?></h2> 
            <p><i class="fas fa-user-tie"></i><?php echo $_SESSION['tipo_usuario'] ?></p>
          </div>
          <button><i class="fas fa-sign-out-alt"></i></button>
        </div>
      </div>
    </header>

    <nav class="nav-hidden active" id="panel-navbar"></nav>

    <section class="panel" id="panel">
      <div class="section-botones"></div>
    </section>
  </body>
</html>