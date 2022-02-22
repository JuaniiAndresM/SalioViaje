<?php 

  session_start(); 

  if(isset($_SESSION['usuario'])){
    if($_SESSION['tipo_usuario'] == "Administrador"){
      header('Location: https://www.salioviaje.com.uy/Dashboard');
    }else{
      header('Location: https://www.salioviaje.com.uy/');
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
<head> 
    <title>SalióViaje | Login</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Login" />
    <meta property="og:title" content="SalióViaje | Login" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Login" />
    <meta
      property="twitter:title"
      content="SalióViaje | Login"
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
    <link rel="shortcut icon" href="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://www.salioviaje.com.uy/styles/styles.css">

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/1e193e3a23.js" crossorigin="anonymous"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://www.salioviaje.com.uy/Javascript/web.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/form.js"></script>



</head>
<body>
    <div id="header"></div>

    <a href="https://www.salioviaje.com.uy/FAQ" target="_BLANK" id="faq-float">
      <i class="fas fa-question"></i>
    </a>
    <a href="https://wa.link/mmdp0q" target="_BLANK" id="whatsapp-float">
      <img src="https://www.salioviaje.com.uy/media/images/whatsapp.png" alt="">
    </a>

    <div id="pre-loader">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
      </div>

    <section class="login">
        <div class="login-wrapper">
            <h1>Salió<span>Viaje</span></h1>

            <div id="login">
                <div class="inputs-wrapper">
                    <div class="input">
                        <i class="fas fa-user" id="icon"></i>
                        <input type="number" id="usuario" name="usuario" maxlength="12" placeholder="C.I o RUT">
                    </div>
                    <div class="input">
                        <i class="fas fa-key" id="icon"></i>
                        <input type="password" id="passwd" name="pin" placeholder="PIN" maxlength="4" pattern="[0-9]{4}">
                        <button onclick="passwd(1)" class="password-eye"><i id="passeye" class="fas fa-eye-slash"></i></button>
                    </div>
                </div>

                <p id="mensaje-error" class="mensaje-error"></p>
                
                <button class="button-login" onclick="login()"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>

                <div class="login-bottom">
                    <p><a href="/SalioViaje/Form/CambiarContraseña.html">¿Olvidaste tu contraseña?</a></p>
                    <p>¿Aún no tienes una cuenta? <a href="/SalioViaje/Register">Registrate</a>.</p>
                </div>
            </div>

            

        </div>
    </section>

    <div id="footer"></div>
</body>
</html>