<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- ==================================================================== -->
    <title>Salió Viaje | Experiencias en Uruguay | Hacer Paseos y Tours</title>
    <meta
      name="description"
      content="Disponemos de un extenso catálogo de buenos momentos,en bodegas, en hoteles, en restaurantes  y soluciones en turismo en todo el pais."
    />
    <meta
      name="keywords"
      content="Salió Viaje | Experiencias en Uruguay | Hacer Paseos y Tours"
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

  
 <section class="titulo-experiencias" id="Cotizaciones">
       <h1 class="title"><i class="fas fa-mountain"></i> Experiencias</h1>
      <hr />
      <h2 class="description">
      Sólo traslado o con todo incluido.
      </h2>

    
    </section>
    <!-- Sección -->
    <section class="sobre-nosotros-experiencias">
      <div class="nosotros-wrapper-grid">
        <div class="nosotros-left">
          <div class="nosotros-img-wrapper">
            <img
              class=""
              src="https://www.salioviaje.com.uy/media/images/Gruta del Palacio.webp"
              alt="Un paseo por la Gruta del Palacio "
              title="Gruta del Palacio | Salió Viaje"
            />
          </div>
        </div>
        <div class="nosotros-right">
          <div class="nosotros-info">
            <h2>Sobre nuestro paseo <span>por la Gruta del Palacio</span></h2>
            <hr />
            <h3 class="info">Para aventureros por la Gruta del Palacio</h3>

            <a
              class="button-nosotros"
              href="https://www.salioviaje.com.uy/Gruta_del_Palacio"
              title="Gruta del Palacio | Salió Viaje"
            >
              <i class="fas fa-info"></i> Más Información
            </a>
          </div>
        </div>
      </div>
    </section>
    <!--=====================================================================-->
    <!-- Termina Sección -->
    <div class="experiencias-separador">
      <hr>
    </div>
    <!-- Sección -->
    <section class="sobre-nosotros-experiencias">
      <div class="nosotros-wrapper-grid">
        <div class="nosotros-left">
          <div class="nosotros-img-wrapper">
            <img
              class=""
              src="https://www.salioviaje.com.uy/media/images/Complejo_Arequita.webp"
              alt="Un paseo por Complejo Arequita"
              title="Complejo Arequita | Salió Viaje"
            />
          </div>
        </div>
        <div class="nosotros-right">
          <div class="nosotros-info">
            <h2>Sobre nuestro paseo <span>por la Gruta de Arequita</span></h2>
            <hr />
            <h3 class="info">
              Para grandes paseanderos por la Gruta de Arequita
            </h3>

            <a
              class="button-nosotros"
              href="https://www.salioviaje.com.uy/Arequita"
              title="Complejo Arequita | Salió Viaje"
            >
              <i class="fas fa-info"></i> Más Información
            </a>
          </div>
        </div>
      </div>
    </section>
    <!--=====================================================================-->    
    <!-- Termina Sección -->
    <div class="experiencias-separador">
      <hr>
    </div>
    <!-- Sección -->
    <section class="sobre-nosotros-experiencias">
      <div class="nosotros-wrapper-grid">
        <div class="nosotros-left">
          <div class="nosotros-img-wrapper">
            <img
              class=""
              src="https://www.salioviaje.com.uy/media/images/Salto del Penitente.webp"
              alt="Salto del Penitente"
              title="Salto del Penitente, un paseo inolvidable | Salió Viaje"
            />
          </div>
        </div>
        <div class="nosotros-right">
          <div class="nosotros-info">
            <h2>Sobre nuestro paseo <span>por el Salto del Penitente</span></h2>
            <hr />
            <!--      <p class="info">
              Para valientes exploradores por el Salto del Penitente
            </p> -->
            <h3 class="info">
              Para valientes exploradores por el Salto del Penitente
            </h3>

            <a
              class="button-nosotros"
              href="https://www.salioviaje.com.uy/Penitente"
              title="Salto del Penitente, un paseo inolvidable | Salió Viaje"
            >
              <i class="fas fa-info"></i> Más Información
            </a>
          </div>
        </div>
      </div>
    </section>
        <!--=====================================================================-->
    <!-- Termina Sección -->
    <div class="experiencias-separador">
      <hr>
    </div>
    <!-- Sección -->
    <section class="sobre-nosotros-experiencias">
      <div class="nosotros-wrapper-grid">
        <div class="nosotros-left">
          <div class="nosotros-img-wrapper">
            <img
              class=""
              src="https://www.salioviaje.com.uy/media/images/Fiesta 1.webp" alt="Una fiesta" title="Disfrutar la fiesta sin preocupaciones" />  
          
          </div>
        </div>
        <div class="nosotros-right">
          <div class="nosotros-info">
            <h2>Sobre nuestro sevicio de <span>traslado para fiestas y eventos</span></h2>
            <hr />
            <h3 class="info">
              Para trasladarse con un servicio de alta calidad y puntualidad
            </h3>

            <a
              class="button-nosotros"
              href="https://www.salioviaje.com.uy/Eventos_Fiestas"
              title="Eventos_Fiestas | Salió Viaje"
            >
              <i class="fas fa-info"></i> Más Información
            </a>
          </div>
        </div>
      </div>
    </section>
    <!--=====================================================================-->  
    <!-- Termina Sección -->
    
    <!-- <button class=Botones caseros -->
    <div class="agendarViaje">
      <div id="step_1">
        <button
          class="button-agendar"
          id="button_volver"
          onclick="history.go(-1);"
        >
          <i class="fas fa-arrow-circle-left"></i> Volver
        </button>
        <button
          class="button-agendar"
          id="button_volver"
          onclick="location.href='https://www.salioviaje.com.uy/'"
          title="Home"
        >
          <i class="fas fa-arrow-circle-right"></i> Home
        </button>
        <br />
      </div>
      <!-- ==================================================================== -->
    </div>

    <div id="footer"></div>
  </body>
</html>
