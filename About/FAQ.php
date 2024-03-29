<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- ==================================================================== -->
    <title>Salió Viaje | FAQ's | Frecuently Asked Questions (Tutorial)</title>
    <meta
      name="description"
      content="Respondemos preguntas frecuentes, y damos instrucciones para completar fromularios y registros, además cómo registrase y solicitar un viaje."
    />
    <meta
      name="keywords"
      content="Salió Viaje | FAQ's | Frecuently Asked Questions (Tutorial)"
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

    <script src="/Javascript/web.js"></script>
    <script src="/Javascript/faq.js"></script>
    <script type="text/javascript">
      window.onload = function () {
        traer_preguntas_seccion_faq();
      };
    </script>
  </head>
  <body>
    <div id="header"></div>

    <?php
    session_start();
    if(!isset($_SESSION['usuario'])){
      echo '<div id="flotant-promo"></div>';
    }
    ?> 

    <div id="pre-loader">
      <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>

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

    <section class="faq">
      <h1>
        <i class="fa-solid fa-person-circle-question" id="icon"></i> Preguntas Frecuentes (FAQs)
      </h1>
      <h2>
        Si nos falta su respuesta, no dude en consultarnos, en menos de 24hs
        tendrá respuesta
      </h2>
      <div class="accordion-container">
        <div class="accordion"></div>
      </div>
    </section>

    <div id="footer"></div>
  </body>
</html>
