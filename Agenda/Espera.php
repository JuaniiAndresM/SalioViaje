<?php 

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
    <link rel="stylesheet" href="https://www.salioviaje.com.uy/styles/styles.min.css" />

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

    <script src="https://www.salioviaje.com.uy/Javascript/espera.js"></script>
    

    <script type="text/javascript">
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });
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

    <section class="espera-wrapper">
      <div class="espera">
        <div id="step_1">
          <div class="loader">
            <i class="fas fa-spinner"></i>
          </div>
          <h2>Enviando...</h2>
        </div>

        <div id="step_2">
          <div class="loader">
            <i class="fas fa-spinner"></i>
          </div>
          <input id="id_oportunidad" type="hidden" name="" value="<?php echo $_GET['ID']; ?>">
          <h2><i class="far fa-address-card"></i> Viaje N° <?php echo $_GET['ID']; ?></h2>
          <h3>
            Estamos procesando su solicitud, este proceso puede tardar unos
            minutos.
          </h3>
          <p>
            También puedes seguir este proceso por medio de tu correo electrónico. 
          </p>
          <p>
            Si gusta, mientras espera puede seguir viendo nuestras oportunidades
            en nuestra web.
          </p>
        </div>

        <div id="step_3">
          <div class="aprobado">
            <i class="fas fa-check"></i>
          </div>
          <h2>Petición Aprobada</h2>
          <h3><i class="far fa-address-card"></i> Viaje N° <?php echo $_GET['ID']; ?></h3>
          <p>
            Contáctate con el transporista para coordinar el pago del
            viaje.
          </p>
          <div class="info">
            <p id="espera-nombre"><b>Nombre:</b> Juan Morena</p>
            <p id="espera-telefono"><b>Teléfono:</b> <a href="tel:098234717">098234717</a></p>
          </div>
        </div>

        <div id="step_4">
          <div class="no-aprobado">
            <i class="fas fa-times"></i>
          </div>
          <h2>Petición Rechazada</h2>
          <h3><i class="far fa-address-card"></i> Viaje N° <?php echo $_GET['ID']; ?></h3>
          <p>
            Lamentamos informarte que tu petición fue rechazada, en breve nos
            comunicaremos para comentarte los motivos.
          </p>
        </div>

        <div class="progress">
          <div class="progress-labels">
            <p class="label">
              <i class="fas fa-paper-plane"></i><br />
              Petición <br />
              Enviada
            </p>
            <p class="label">
              <i class="far fa-clock"></i><br />
              Pendiente Aprobación
            </p>
            <p class="label" id="aprobado-progress">
              <i class="fas fa-check"></i><br />
              Petición <br />
              Aprobada
            </p>
          </div>
          <div class="progress-bar">
            <span class="line"></span>
            <span class="progress-line"></span>

            <span class="circle1"></span>
            <span class="circle2"></span>
            <span class="circle3"></span>
            <span class="circle4"></span>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
