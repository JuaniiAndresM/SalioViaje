<?php 
$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');

  }else{
    if($_SESSION['tipo_usuario'] != "Administrador"){
      header('Location: https://www.salioviaje.com.uy/');
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Editar FAQs</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/FAQ_Edit" />
    <meta property="og:title" content="SalióViaje | Editar FAQs" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/FAQ_Edit" />
    <meta
      property="twitter:title"
      content="SalióViaje | Editar FAQs"
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
    <link rel="stylesheet" href="https://www.salioviaje.com.uy/styles/styles.min.css" />

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>

    <script src="https://www.salioviaje.com.uy/Javascript/panel.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/faq.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
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

    <header class="panel-header" id="header">
      <div class="header-left">
        <div class="header-menu">
          <button onclick="navbar()"><i class="fas fa-bars"></i></button>
        </div>
        <div class="header-title">
          <h2>Editar FAQs</h2>
        </div>
      </div>
      <div class="header-right">
        <div class="header-user">
          <div class="icon"><img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje"></div>
          <div class="user">
          <h2><?php echo $_SESSION['usuario']; ?></h2> 
          <p><i class="fas fa-user-tie"></i> <?php echo $_SESSION['tipo_usuario'] ?></p>
          </div>
          <button id="cerrar_session_dashboard"><i class="fas fa-sign-out-alt"></i></button>
        </div>
      </div>
    </header>

    <nav class="nav-hidden active" id="panel-navbar"></nav>

    <section class="panel" id="panel">
      <div class="edit-faq">

        <div class="faq-grid">

          <div class="create-faq">
            <h2><i class="fas fa-question"></i> Editar FAQs</h2>

            <div class="input">
              <i class="fas fa-question" id="icon"></i>
              <input type="text" id="pregunta" placeholder="Pregunta">
            </div>

            <div class="input">
              <i class="fas fa-signature" id="icon2"></i>

              <!-- <textarea name="" id="respuesta" placeholder="Respuesta"></textarea> -->

              <div id="editor"></div>
            </div>

            <p id="mensaje-error">Debe completar todos los campos.</p>
            
            <div class="button-wrapper">
              <button id="crear-pregunta" onclick="crear_pregunta()"><i class="fas fa-plus"></i> Crear Pregunta</button>
              <button id="guardar-pregunta" onclick="editar_pregunta()"><i class="fas fa-save"></i> Guardar Pregunta</button>
              <button id="eliminar-pregunta" onclick="borrar_pregunta()"><i class="fas fa-trash-alt"></i> Eliminar Pregunta</button>
            </div>
          </div>

          <div class="lista-faq">
            <h2><i class="fas fa-list-ol"></i> Lista de FAQs</h2>

            <div class="faq-list">

              <div class="faq-question">
                <h3>¿Pregunta N° 1?</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus, odio.</p>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>
    <script>
      let editor;

      ClassicEditor.create( document.querySelector( '#editor' ) ).then( newEditor => {
        editor = newEditor;
      } ).catch( error => {

          console.error( error );

      } );
      
    </script>
  </body>
</html>
