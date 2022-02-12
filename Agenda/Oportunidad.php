<?php 

  session_start(); 

  if(!isset($_SESSION['usuario'])){
      header('Location: https://www.salioviaje.com.uy/Login');
  }else{
    if($_SESSION['tipo_usuario'] == "Chofer"){
      header('Location: https://www.salioviaje.com.uy/');
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Oportunidad #021</title>

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
      href="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="https://www.salioviaje.com.uy/styles/styles.css" />

    <!-- Scripts -->
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://www.salioviaje.com.uy/Javascript/web.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/viajar.js"></script>
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
      <img src="https://www.salioviaje.com.uymedia/images/whatsapp.png" alt="">
    </a>

    <section class="oportunidad-detalles-wrapper">
        <div class="oportunidad">
          <div class="oportunidad-header">
            <div class="driver-info">
              <div class="driver-icon">
                <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje">
              </div>
              <div class="driver-desc">
                <h3>Nombre del Transportista</h3>
                <p><i class="fas fa-bus"></i> Transportista</p>
                <p class="calificacion">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half"></i>
                  (4.35) - <i class="far fa-compass"></i> 820 Viajes
                </p>
              </div>
            </div>
            <div class="oportunidad-buttons">
              <button class="comprar-button"><i class="fas fa-comments-dollar"></i> Comprar</button>
            </div>
          </div>
          <div class="oportunidad-content">

            <div class="oportunidad-info">

              <div class="info">
                <b><i class="far fa-address-card"></i> N° Viaje</b>
                <p>#021</p>
              </div>

              <div class="info">
                <b><i class="fas fa-map-marker-alt"></i> Origen</b>
                <p>Montevideo</p>
              </div>

              <div class="info">
                <b><i class="fas fa-route"></i> Destino</b>
                <p>Canelones</p>
              </div>

              <div class="info">
                <b><i class="far fa-calendar-alt"></i> Fecha</b>
                <p>17/02/2022</p>
              </div>

              <div class="info">
                <b><i class="far fa-clock"></i> Hora</b>
                <p>18:30</p>
              </div>

              <div class="info">
                <b><i class="fas fa-user-friends"></i> Capacidad</b>
                <p>12</p>
              </div>

            </div>
            <div class="price_wrapper">
              <div class="discount">
                <h3>50% <i class="fas fa-tags"></i></h3>
              </div>
              <div class="price">
                <p class="desc">$ 8180</p>
                <p>$ 4090</p>
              </div>
            </div>

          </div>
        </div>
    </section>

    <div id="footer"></div>
  </body>
</html>
