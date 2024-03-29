<?php 
  $ttl = (60 * 60 * 24); # 1 día
  session_set_cookie_params($ttl);
  session_start();

  // if(!isset($_SESSION['usuario'])){
  //     header('Location: https://www.salioviaje.com.uy/Login');
  // }else{
  //   if($_SESSION['tipo_usuario'] == "Chofer"){
  //     header('Location: https://www.salioviaje.com.uy/');
  //   }
  // }

  require_once "../PHP/procedimientosBD.php";

  $datos = new procedimientosBD();
  $array_oportuidad = $datos->traer_oportunidades_por_id($_GET['ID']);


  $descuento = $array_oportuidad[0]['DESCUENTO']/100;
  $PRECIO_CON_DESCUENTO_APLICADO =  round($array_oportuidad[0]['PRECIO'] - $array_oportuidad[0]['PRECIO'] * $descuento);

  $fecha = explode(' ', $array_oportuidad[0]['FECHA']);


  if ($array_oportuidad[0]['TIPO_USUARIO'] == 'TTA') { $array_oportuidad[0]['TIPO_USUARIO'] = "Transportista"; }
  else if ($array_oportuidad[0]['TIPO_USUARIO'] == 'CHO') { $array_oportuidad[0]['TIPO_USUARIO'] = "Chofer"; }
  else if ($array_oportuidad[0]['TIPO_USUARIO'] == 'AGT') { $array_oportuidad[0]['TIPO_USUARIO'] = "Agente"; }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Oportunidad #<?php echo $_GET['ID']; ?></title>

    <!-- // Meta Etiquetas -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Viajar" />
    <meta property="og:title" content="SalióViaje | Viajar" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Viajar" />
    <meta
      property="twitter:title"
      content="SalióViaje | Viajar"
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
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://www.salioviaje.com.uy/Plugins/JQuery/jquery.min.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/web.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/viajar.js"></script>
    <script src="https://www.salioviaje.com.uy/t2voice/send_data.js"></script>
    <script src="https://www.salioviaje.com.uy/t2voice/functionsJS.js"></script>
  </head>
  <body>
    <div id="header"></div>

    <div id="pre-loader">
      <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>

    <div id="modal"></div>


    <a href="https://www.salioviaje.com.uy/FAQ" target="_BLANK" id="faq-float">
      <i class="fas fa-question"></i>
    </a>
    <a href="https://wa.link/mxnwzm" target="_BLANK" id="whatsapp-float">
      <img src="https://www.salioviaje.com.uy/media/images/whatsapp.png" alt="">
    </a>

    <section class="oportunidad-detalles-wrapper">
        <div class="oportunidad">
          <div class="oportunidad-header">
            <div class="driver-info">
              <div class="driver-icon">
                <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje">
              </div>
            </div>
            <div class="oportunidad-buttons">
              <div class="price_wrapper">
                <div class="discount">
                  <h3><?php echo $array_oportuidad[0]['DESCUENTO']; ?>% OFF <i class="fas fa-tags"></i></h3>
                </div>
                <div class="price">
                  <p class="desc">$ <?php echo number_format($array_oportuidad[0]['PRECIO']); ?></p>
                  <p>$ <?php echo number_format($PRECIO_CON_DESCUENTO_APLICADO); ?></p>
                </div>
              </div>
              <?php 
                if ($_SESSION['datos_usuario']['TIPO_USUARIO'] != "CHO") {
                  if (isset($_SESSION["usuario"])) {
                    echo '<button class="comprar-button" id="comprar_oportunidad" onclick="comprar_oportunidad('.$array_oportuidad[0]['ID'].',1)"><i class="fas fa-comments-dollar"></i> Comprar</button>'; 
                  }else{
                    echo '<button class="comprar-button" id="comprar_oportunidad" onclick="location.href=\'https://www.salioviaje.com.uy/Login\'"><i class="fas fa-comments-dollar"></i> Comprar</button>'; 
                  }
                }
               ?>
            </div>
          </div>
          <div class="oportunidad-content">

            <div class="oportunidad-info">

              <p><i class="fas fa-address-card"></i> <b>N° de Viaje: </b><?php echo $array_oportuidad[0]['ID']; ?></p>
              <p><i class="fas fa-location-dot"></i> <b>Origen: </b><?php echo $array_oportuidad[0]['ORIGEN']; ?></p>
              <p><i class="fas fa-route"></i> <b>Destino: </b><?php echo $array_oportuidad[0]['DESTINO']; ?></p>
              <p><i class="far fa-calendar-alt"></i> <b>Fecha: </b><?php echo $fecha[0]; ?></p>
              <p><i class="far fa-clock"></i> <b>Hora: </b><?php echo $fecha[1]; ?></p>
              <p><i class="fas fa-user-friends"></i> <b>Capacidad: </b><?php echo $array_oportuidad[0]['CAPACIDAD_VEHICULO']; ?></p>

            </div>
          </div>
        </div>
    </section>

    <div id="footer"></div>
  </body>
</html>
