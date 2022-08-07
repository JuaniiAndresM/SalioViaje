<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- ==================================================================== -->
    <title>Salió Viaje | Optimizar traslados | Gratis para el pasajero</title>
    <meta
      name="description"
      content="Solución gratuita para contratar tu traslado en camionetas. No te pierdas  nuestra sección de Opotunidades y Ofertas  con grandes descuentos"
    />
    <meta
      name="keywords"
      content="Salió Viaje | Optimizar  traslados | Gratis para el pasajero"
    />
    <meta name="robots" content="index,follow" />

    <!-- ==================================================================== -->

    <!-- // Meta Etiquetas -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    />

    <meta name="author" content="Daniel Schlebinger" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.salioviaje.com.uy" />
    <meta
      property="og:title"
      content="Salió Viaje | Plataforma que optimiza el traslado ocasional de personas"
    />
    <meta
      property="og:description"
      content="Plataforma que optimiza el traslado ocasional de personas."
    />
    <meta
      property="og:image"
      content="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg"
      type="image/x-icon"
      title="Logo | Salió Viaje"
    />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://www.salioviaje.com.uy" />
    <meta
      property="twitter:title"
      content="Salió Viaje | Plataforma que optimiza el traslado ocasional de personas"
    />
    <meta
      property="twitter:description"
      content="Plataforma que optimiza el traslado ocasional de personas."
    />
    <meta
      property="twitter:image"
      content="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg"
      type="image/x-icon"
      title="Logo | Salió Viaje"
    />

    <!-- // Fin de Meta Etiquetas -->

    <!-- Links -->
    <link
      rel="shortcut icon"
      href="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg"
      type="image/x-icon"
    />
    <link
      rel="stylesheet"
      href="https://www.salioviaje.com.uy/styles/styles.min.css"
    />

    <link rel="publisher" href="https://www.salioviaje.com.uy" />
    <!--  <link rel="image_src" href="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg" type="image/x-icon"  title="Logo | Salió Viaje" >-->
    <link rel="canonical" href="https://www.salioviaje.com.uy" />
    <!-- Scripts -->
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://www.salioviaje.com.uy/Plugins/JQuery/jquery.min.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/web.js"></script>
    <!--//<script src="https://www.salioviaje.com.uy/Javascript/viajar.js"></script>-->
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

    <?php
    session_start();
    if(!isset($_SESSION['usuario'])){
      echo '<div id="flotant-promo"></div>';
    }
    ?> 

    <a
      href="https://www.salioviaje.com.uy/FAQ"
      title="Frequently Asked Questions"
      target="_BLANK"
      id="faq-float"
    >
      <i class="fas fa-question"> </i>
    </a>

    <a
      href="https://wa.link/mxnwzm"
      title="WhatsApp | Salió Viaje"
      target="_BLANK"
      id="whatsapp-float"
    >
      <img
        src="https://www.salioviaje.com.uy/media/images/whatsapp.webp"
        title="WhatsApp | Salió Viaje"
        alt="Logo WhatsApp | Salió Viaje"
      />
    </a>
    <!-- <br>                 
    <br>
    <br>
    <br> -->

    <section class="sobre-nosotros" id="SobreNosotros">
      <h1 class="title">Te contamos algo sobre nosotros!</h1>
      <div class="nosotros-wrapper-grid">
        <div class="nosotros-left">
          <div class="nosotros-img-wrapper">
            <img
              class=""
              src="https://www.salioviaje.com.uy/media/images/001.webp"
              alt="Una moderna flota, integrada por los mejores transportistas"
              title="Una moderna flota, integrada por los mejores transportistas | Salió Viaje"
            />
          </div>
        </div>
        <div class="nosotros-right">
          <div class="nosotros-info">
            <h2>Mirá quienes somos, <span>y qué hace nuestro equipo</span></h2>
            <hr />
            <h3 class="info">
              Somos un Grupo Nacional que promueve la aplicación de la
              tecnología para facilitar los traslados terrestres. Nuestro equipo
              está a tu disposición para ofrecerte una experiencia altamente
              satisfactoria, con especial atención al medioambiente.
            </h3>

            <!-- <button class="button-nosotros">
                <i class="fas fa-info"></i> Más Información
              </button> -->
          </div>
        </div>
      </div>
    </section>

    <div id="footer"></div>
  </body>
</html>
