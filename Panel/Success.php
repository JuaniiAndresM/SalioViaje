<?php
$type = $_GET['type'];
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Success</title>

    <!-- // Meta Etiquetas -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    />
    <meta name="robots" content="noindex,nofollow" />
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
    <meta property="og:url" content="https://www.salioviaje.com.uy/" />
    <meta
      property="og:title"
      content="SalióViaje | Plataforma que optimiza el traslado ocasional de personas."
    />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/" />
    <meta
      property="twitter:title"
      content="SalióViaje - Plataforma que optimiza el traslado ocasional de personas."
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
    <link
      rel="stylesheet"
      href="https://www.salioviaje.com.uy/styles/styles.min.css"
    />

    <!-- Scripts -->
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://www.salioviaje.com.uy/Plugins/JQuery/jquery.min.js"></script>

    <script src="https://www.salioviaje.com.uy/Javascript/web.js"></script>
  </head>
  <body>
    <div id="header"></div>

    <a href="https://www.salioviaje.com.uy/FAQ" target="_BLANK" id="faq-float">
      <i class="fas fa-question"></i>
    </a>
    <a href="https://wa.link/mxnwzm" target="_BLANK" id="whatsapp-float">
      <img
        src="https://www.salioviaje.com.uy/media/images/whatsapp.png"
        alt=""
      />
    </a>

    <div id="pre-loader">
      <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>

    <section class="success">
      <div class="success-wrapper">
        <div class="success-icon">
          <i class="fas fa-check-circle"></i>
        </div>
        <h3>¡Felicitaciones!</h3>

        <?php
        if($type == 'Agenda'){
          echo '<p class="msg-success">Su viaje ha sido agendado correctamente.</p>';
        }else if($type == 'Cotizacion'){
          echo '<p class="msg-success">Su viaje ha sido cotizado correctamente.</p>';
        }else{
          echo '<p class="msg-success">Todo funcionó correctamente.</p>';
        }
        
        ?>

        
        <div class="success-buttons">
          <a href="https://www.salioviaje.com.uy/Dashboard"
            ><i class="fas fa-home"></i> Volver al Panel</a
          >
        </div>
      </div>
    </section>

    <div id="footer"></div>
  </body>
</html>
