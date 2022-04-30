<?php 
  
  session_start(); 
  /*
  if(!isset($_SESSION['usuario'])){
      header('Location: https://www.salioviaje.com.uy/Login');
  }else{
    
    if($_SESSION['tipo_usuario'] == "Chofer"){
      header('Location: https://www.salioviaje.com.uy/');
    }
    
  }
  */
  require_once "../PHP/procedimientosBD.php";


  $datos = new procedimientosBD();
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Cotizacion #<?php echo $_GET['ID']; ?></title>

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




    <a href="https://www.salioviaje.com.uy/FAQ" target="_BLANK" id="faq-float">
      <i class="fas fa-question"></i>
    </a>
    <a href="https://wa.link/mmdp0q" target="_BLANK" id="whatsapp-float">
      <img src="https://www.salioviaje.com.uy/media/images/whatsapp.png" alt="">
    </a>

    <section class="cotizacion-detalles-wrapper">
        <div class="cotizacion">
          <div class="cotizacion-header">
            <div class="driver-info">
              <div class="driver-icon">
                <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje">
              </div>
            </div>
            <div class="cotizacion-buttons">
              <?php 
                
                if (isset($_SESSION["usuario"])) {
                    if ($_SESSION['datos_usuario']['TIPO_USUARIO'] == "TTA" || $_SESSION['datos_usuario']['TIPO_USUARIO'] == "ADM") {
                        echo '<button class="cotizar-button"><i class="fas fa-chart-line"></i> Cotizar</button>';                     
                    } 
                }

               ?>
            </div>
          </div>
          <div class="cotizacion-content">

            <div class="cotizacion-info">

              <div class="info">
                <b><i class="far fa-address-card"></i> ID</b>
                <p>#1</p>
              </div>

              <div class="info">
                <b><i class="fas fa-map-marker-alt"></i> Origen</b>
                <p>Canelones, Ciudad de la Costa.</p>
              </div>

              <div class="info">
                <b><i class="fas fa-route"></i> Destino</b>
                <p>Maldonado, Punta del Este.</p>
              </div>

              <div class="info">
                <b><i class="far fa-calendar-alt"></i> Fecha</b>
                <p>24/05/22</p>
              </div>

              <div class="info">
                <b><i class="far fa-clock"></i> Hora</b>
                <p>18:03</p>
              </div>

              <div class="info">
                <b><i class="fas fa-user-friends"></i> Pasajeros</b>
                <p>20</p>
              </div>

              <div class="info">
                <b><i class="fas fa-dog"></i> Mascotas</b>
                <p>Si</p>
              </div>

            </div>
          </div>
        </div>
    </section>

    <div id="footer"></div>
  </body>
</html>
