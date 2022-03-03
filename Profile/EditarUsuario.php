<?php 

  require_once '../PHP/procedimientosBD.php';

  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');
  }else{

    $id = $_GET['ID'];
    
    $tipo = 0;

    $info_usuario = new procedimientosBD();
      

    $usuario = $info_usuario->info_usuario_profile($id);

    $tipo_usuario = $usuario[0]["TIPO_USUARIO"];

    switch($tipo_usuario){
      case "PAX":
        $tipo_usuario = "Pasajero";
        $tipo = 1;
        break;

      case "CHO":
        $tipo_usuario = "Chofer";
        $tipo = 2;
        break;

      case "TTA":
        $tipo_usuario = "Transportista";
        $tipo = 3;
        break;

      case "ASE":
        $tipo_usuario = "Asesor";
        $tipo = 4;
        break;

      case "ANF":
        $tipo_usuario = "Anfitrión";
        $tipo = 5;
        break;

      case "AGT":
        $tipo_usuario = "Agente";
        $tipo = 6;
        break;

      case "HTL":
        $tipo_usuario = "Hotel";
        $tipo = 7;
        break;

      case "ADM":
        $tipo_usuario = "Administrador";
        $tipo = 8;
        break;
    }

    if(empty($usuario)){
      header('Location: Failed/');
    }

    if($_SESSION['tipo_usuario'] != "Administrador"){
      if($_SESSION['datos_usuario']['CI'] != $usuario[0]['CI']){
        header('Location: /SalioViaje/Dashboard');
      }
    }

    

  }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Editar Perfil</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Profile" />
    <meta property="og:title" content="SalióViaje | Empresas" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Empresas" />
    <meta
      property="twitter:title"
      content="SalióViaje | Empresas"
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>

    <script src="https://www.salioviaje.com.uy/Javascript/panel.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/form.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/profile.js"></script>
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
          <h2>Editar Perfil</h2>
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
      <div class="profile-wrapper">

        <div class="user-info">
          <div class="user-left">
            <div class="user-icon">
              <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="Logo SalióViaje">
            </div>
            <div class="user-desc">
              <h2><?php echo $usuario[0]['NOMBRE'] ." ". $usuario[0]['APELLIDO']; ?></h2>
              <p><i class="fas fa-bus"></i> <?php echo $tipo_usuario; ?></p>
              
            </div>
          </div>
        </div>

        <div class="profile-grid">
          <div class="user-informacion">
            <h3><i class="fas fa-address-card"></i> Información Personal</h3>

            <div class="informacion-wrapper">

              <div class="info">
                <b><i class="fas fa-signature"></i> Nombre</b>
                <input type="text" placeholder="Nombre" id="NombreEdicion" value="<?php echo $usuario[0]['NOMBRE']?>">
              </div>
              <div class="info">
                <b><i class="fas fa-signature"></i> Apellido</b>
                <input type="text" placeholder="Apellido" id="ApellidoEdicion" value="<?php echo $usuario[0]['APELLIDO']?>">
              </div>
              <div class="info">
                <b><i class="far fa-envelope"></i> Correo Electrónico</b>
                <input type="email" placeholder="Correo Electrónico" id="CorreoEdicion" value="<?php echo $usuario[0]['EMAIL']?>">
              </div>
              <div class="info">
                <b><i class="fas fa-map"></i> Departamento</b>
                <input type="text" placeholder="Departamento" id="DepartamentoEdicion" value="<?php echo $usuario[0]['DEPARTAMENTO']?>">
              </div>
              <div class="info">
                <b><i class="fas fa-map-marked-alt"></i> Barrio</b>
                <input type="text" placeholder="Barrio" id="BarrioEdicion" value="<?php echo $usuario[0]['BARRIO']?>">
              </div>
              <div class="info">
                <b><i class="fas fa-map-marker-alt"></i> Dirección</b>
                <input type="text" placeholder="Dirección" id="DireccionEdicion" value="<?php echo $usuario[0]['DIRECCION']?>">
              </div>
              <div class="info">
                <b><i class="fas fa-phone"></i> Teléfono</b>
                <input type="number" placeholder="Teléfono" id="TelEdicion" value="<?php echo $usuario[0]['TELEFONO']?>">
              </div>

            </div>
            <p id="mensaje-error" class="mensaje-error"></p>
            <div class="button-wrapper">
                <button class="button-guardar" onclick="editarUsuario('<?php echo$_GET['ID']?>')"><i class="fas fa-arrow-left"></i> Cancelar</button>
                <button class="button-guardar" onclick="guardarEdicionUsuario('<?php echo$_GET['ID']?>','<?php echo$usuario[0]['CI']?>')"><i class="fas fa-save"></i> Guardar Cambios</button>
            </div>
          </div>
          <?php 

              if($_SESSION['usuario'] == $usuario[0]['NOMBRE'] ." ". $usuario[0]['APELLIDO']){
                echo '<div class="viajes-wrapper">
                  <h3><i class="fas fa-key"></i> Cambiar PIN</h3>

                  <div class="password-change">

                    <div class="input">
                      <i class="fas fa-lock" id="icon"></i>
                      <input
                        type="password"
                        id="password1"
                        name="pin"
                        placeholder="PIN Anterior"
                        maxlength="4"
                        pattern="[0-9]{4}"
                      />
                      <button onclick="passwd(1)" class="password-eye"><i id="passeye" class="fas fa-eye-slash"></i></button>
                    </div>

                    <div class="input">
                      <i class="fas fa-key" id="icon"></i>
                      <input
                        type="password"
                        id="password"
                        name="pin"
                        placeholder="Nuevo PIN"
                        maxlength="4"
                        pattern="[0-9]{4}"
                      />
                      <button onclick="passwd(2)" class="password-eye"><i id="passeye2" class="fas fa-eye-slash"></i></button>
                    </div>

                    <div class="input">
                      <i class="fas fa-key" id="icon"></i>
                      <input
                        type="password"
                        id="re-password"
                        name="pin"
                        placeholder="Confirmar Nuevo PIN"
                        maxlength="4"
                        pattern="[0-9]{4}"
                      />
                      <button onclick="passwd(3)" class="password-eye"><i id="passeye3" class="fas fa-eye-slash"></i></button>
                    </div>

                    <p id="mensaje-error-PIN" class="mensaje-error"></p>
                    <div class="button-wrapper">
                      <button class="button-pin" onclick="cambiarPin('.$_GET['ID'].','.$usuario[0]['CI'].')"><i class="fas fa-save"></i> Cambiar PIN</button>
                    </div>
                    

                  </div>
                </div>';
            }else{
              echo '<div class="viajes-wrapper">
              <h3><i class="fas fa-key"></i> Cambiar PIN</h3>

              <div class="password-change">

                <div class="input">
                  <i class="fas fa-key" id="icon"></i>
                  <input
                    type="password"
                    id="password"
                    name="pin"
                    placeholder="Nuevo PIN"
                    maxlength="4"
                    pattern="[0-9]{4}"
                  />
                  <button onclick="passwd(2)" class="password-eye"><i id="passeye2" class="fas fa-eye-slash"></i></button>
                </div>

                <div class="input">
                  <i class="fas fa-key" id="icon"></i>
                  <input
                    type="password"
                    id="re-password"
                    name="pin"
                    placeholder="Confirmar Nuevo PIN"
                    maxlength="4"
                    pattern="[0-9]{4}"
                  />
                  <button onclick="passwd(3)" class="password-eye"><i id="passeye3" class="fas fa-eye-slash"></i></button>
                </div>

                <p id="mensaje-error-PIN" class="mensaje-error"></p>
                <div class="button-wrapper">
                  <button class="button-pin" onclick="cambiarPinAdmin('.$_GET['ID'].','.$usuario[0]['CI'].')"><i class="fas fa-save"></i> Cambiar PIN</button>
                </div>
                

              </div>
            </div>';
            }
          ?>
        </div>
        <div class="profile_grid2"></div>

        
      </div>
    </section>
  </body>
</html>
