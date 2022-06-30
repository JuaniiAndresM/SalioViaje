<?php 

/*
$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
session_start();


if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');
}else{
  if($_SESSION['tipo_usuario'] == "Chofer"){
    header('Location: https://www.salioviaje.com.uy/');
  }
}
*/

$GET = explode("_", $_GET['ID']);

$ID = $GET[1];
echo $ID;
$ID = substr($ID, 0, -1);

require_once "../PHP/procedimientosBD.php";

$datos = new procedimientosBD();
$expired = 0;

/*
if($array_oportuidad[0]['ID_TRANSPORTISTA'] != $_SESSION['datos_usuario']['ID']){
  header('Location: https://www.salioviaje.com.uy/');
}
*/

if($array_oportuidad[0]['ESTADO'] != "Comprada"){
  $expired = 1;
}

?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Cotizacion #<?php echo $ID; ?></title>

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
    <meta
      property="twitter:url"
      content="https://www.salioviaje.com.uy/Viajar"
    />
    <meta property="twitter:title" content="SalióViaje | Viajar" />
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
    <script src="https://www.salioviaje.com.uy/t2voice/send_data.js"></script>
    <script src="https://www.salioviaje.com.uy/t2voice/functionsJS.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/solicitudCotizacion.js"></script>
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

    <input id="id_get" type="hidden" value="<?php echo $_GET['ID']; ?>">
    <input id="session_get" type="hidden" value="<?php if(isset($_SESSION['usuario'])){ echo 1; }else{ echo 0;} ?>">
    <input id="expired_get" type="hidden" value="<?php echo $expired; ?>">

    <section class="solicitud">
      <div class="solicitud-wrapper">
        <div class="solicitud-icon">
          <i id="icon"></i>
        </div>

        <div class="solicitud-info">
          <h2 id="info_1"></h2>
          <h3 id="info_2"></h3>
          <p id="info_3"></p>
        </div>

      </div>
    </section>

    <div id="footer"></div>
  </body>
</html>
