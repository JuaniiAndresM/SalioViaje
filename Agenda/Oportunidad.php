<?php 

  session_start(); 

  if(!isset($_SESSION['usuario'])){
      header('Location: /SalioViaje/Login');
  }else{
    if($_SESSION['tipo_usuario'] == "Chofer"){
      header('Location: /SalioViaje/');
    }
  }

  require_once "../PHP/procedimientosBD.php";

  $datos = new procedimientosBD();
  $datos = json_decode($datos->traer_oportunidades_por_id($_GET['ID']),true);

  $descuento = $datos['DESCUENTO']/100;
  $PRECIO_CON_DESCUENTO_APLICADO =  round($datos['PRECIO'] - $datos['PRECIO'] * $descuento);

  $fecha = explode(' ', $datos['FECHA']);
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
      href="/SalioViaje/media/svg/Favicon-SalioViaje.svg"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="/SalioViaje/styles/styles.css" />

    <!-- Scripts -->
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/SalioViaje/Javascript/web.js"></script>
    <script src="/SalioViaje/Javascript/viajar.js"></script>
    <script src="/SalioViaje/t2voice/send_data.js"></script>
    <script src="/SalioViaje/t2voice/functionsJS.js"></script>
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




    <a href="https://www.salioviaje.com.uy/FAQ" target="_BLANK" id="faq-float">
      <i class="fas fa-question"></i>
    </a>
    <a href="https://wa.link/mmdp0q" target="_BLANK" id="whatsapp-float">
      <img src="/SalioViaje/media/images/whatsapp.png" alt="">
    </a>

    <section class="oportunidad-detalles-wrapper">
        <div class="oportunidad">
          <div class="oportunidad-header">
            <div class="driver-info">
              <div class="driver-icon">
                <img src="/SalioViaje/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje">
              </div>
              <div class="driver-desc">
                <h3><?php echo $datos['NOMBRE'].' '.$datos['APELLIDO']; ?></h3>
                <p><i class="fas fa-bus"></i> Transportista</p>
                <!-- <p class="calificacion">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half"></i>
                  (4.35) - <i class="far fa-compass"></i> 820 Viajes
                </p> -->
              </div>
            </div>
            <div class="oportunidad-buttons">
                <button class="comprar-button" id="comprar_oportunidad" onclick="comprar_oportunidad(<?php echo $datos['ID']; ?>)"><i class="fas fa-comments-dollar"></i> Comprar</button>
            </div>
          </div>
          <div class="oportunidad-content">

            <div class="oportunidad-info">

              <div class="info">
                <b><i class="far fa-address-card"></i> N° Viaje</b>
                <p>#<?php echo $datos['ID']; ?></p>
              </div>

              <div class="info">
                <b><i class="fas fa-map-marker-alt"></i> Origen</b>
                <p><?php echo $datos['ORIGEN']; ?></p>
              </div>

              <div class="info">
                <b><i class="fas fa-route"></i> Destino</b>
                <p><?php echo $datos['DESTINO']; ?></p>
              </div>

              <div class="info">
                <b><i class="far fa-calendar-alt"></i> Fecha</b>
                <p><?php echo $fecha[0]; ?></p>
              </div>

              <div class="info">
                <b><i class="far fa-clock"></i> Hora</b>
                <p><?php echo $fecha[1]; ?></p>
              </div>

              <div class="info">
                <b><i class="fas fa-user-friends"></i> Capacidad</b>
                <p><?php echo $datos['CANTIDAD_PASAJEROS']; ?></p>
              </div>

            </div>
            <div class="price_wrapper">
              <div class="discount">
                <h3><?php echo $datos['DESCUENTO']; ?>% <i class="fas fa-tags"></i></h3>
              </div>
              <div class="price">
                <p class="desc">$ <?php echo $datos['PRECIO']; ?></p>
                <p>$ <?php echo $PRECIO_CON_DESCUENTO_APLICADO; ?></p>
              </div>
            </div>

          </div>
        </div>
    </section>

    <div id="footer"></div>
  </body>
</html>
