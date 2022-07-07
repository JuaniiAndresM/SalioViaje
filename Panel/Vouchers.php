<?php 
require_once '../PHP/procedimientosBD.php';

$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
session_start(); 

if(!isset($_SESSION['usuario'])){
header('Location: https://www.salioviaje.com.uy/Login');
}

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Vouchers</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Vouchers" />
    <meta property="og:title" content="SalióViaje | Vouchers" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Vouchers" />
    <meta
      property="twitter:title"
      content="SalióViaje | Vouchers"
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
    <script src="https://www.salioviaje.com.uy/Javascript/filtros.js"></script>
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
          <h2>Vouchers</h2>
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
            <h2><i class="fa-solid fa-ticket"></i> <?php if($_SESSION['tipo_usuario'] == "Administrador"){ echo 'Vouchers'; }else{ echo 'Mis Vouchers';} ?></h2>
          </div>
          <div class="empty-table">
            <p><i class="fa-solid fa-circle-info"></i> Lo sentimos, de momento no hay vouchers disponibles.</p>
          </div>
          <div class="vouchers-list">

            <div class="voucher active">
                <div class="col-l">
                    <div class="qr">
                        <h3><i class="fa-solid fa-qrcode"></i></h3>
                    </div>
                    <div class="information">
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
                <div class="col-r">
                    <div class="button-wrapper">
                        <button><i class="fa-solid fa-expand"></i> Ampliar</button>
                    </div>
                </div>
            </div>

            <div class="voucher timedout">
                <div class="col-l">
                    <div class="qr">
                        <h3><i class="fa-solid fa-qrcode"></i></h3>
                    </div>
                    <div class="information">
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
                <div class="col-r">
                    <div class="button-wrapper">
                        <button><i class="fa-solid fa-expand"></i> Ampliar</button>
                    </div>
                </div>
            </div>

            <div class="voucher inactive">
                <div class="col-l">
                    <div class="qr">
                        <h3><i class="fa-solid fa-qrcode"></i></h3>
                    </div>
                    <div class="information">
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
                <div class="col-r">
                    <div class="button-wrapper">
                        <button><i class="fa-solid fa-expand"></i> Ampliar</button>
                    </div>
                </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </body>
</html>
