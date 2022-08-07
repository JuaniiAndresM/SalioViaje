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

  require_once '../PHP/procedimientosBD.php';
  $filtros = new procedimientosBD();

  $checkFiltros = json_decode($filtros->get_filtros_activos_admin(), true);
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Settings</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uySettings" />
    <meta property="og:title" content="SalióViaje | Settings" />
    <meta
      property="og:description"
      content="Plataforma que optimiza el traslado ocasional de personas."
    />
    <meta
      property="og:image"
      content="https://www.website.com/media/MetaImage.png"
    />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://www.salioviaje.com.uySettings" />
    <meta property="twitter:title" content="SalióViaje | Settings" />
    <meta
      property="twitter:description"
      content="Plataforma que optimiza el traslado ocasional de personas."
    />
    <meta
      property="twitter:image"
      content="https://www.website.com/media/MetaImage.png"
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
    <script src="https://www.salioviaje.com.uy/Plugins/JQuery/jquery.min.js"></script>
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>

    <script src="https://www.salioviaje.com.uy/Javascript/panel.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
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

    <div id="settings-menu">
      <button id="close" onclick="close_settings()">
        <i class="fas fa-times"></i>
      </button>

      <div id="editar-info">
        <h2><i class="fas fa-user-edit"></i> Editar Información</h2>
        <label for="">C.I</label>
        <div class="input">
          <i class="fas fa-user"></i>
          <input type="number" placeholder="Nueva Cedula" value="22222222" maxlength="8" />
        </div>
        <label for="">Nombre</label>
        <div class="input">
          <i class="fas fa-signature"></i>
          <input type="text" placeholder="Nuevo Nombre" value="Jhon" />
        </div>
        <label for="">Apellido</label>
        <div class="input">
          <i class="fas fa-signature"></i>
          <input type="text" placeholder="Nuevo Apellido" value="Doe" />
        </div>
        <label for="">Teléfono</label>
        <div class="input">
          <i class="fas fa-phone"></i>
          <input type="number" placeholder="Nuevo Teléfono" value="099999999" />
        </div>
        <label for="">Correo Electrónico</label>
        <div class="input">
          <i class="fas fa-envelope"></i>
          <input
            type="text"
            placeholder="Nuevo Correo Electrónico"
            value="johndoe@gmail.com"
          />
        </div>
        <button><i class="fas fa-save"></i> Guardar</button>
      </div>

      <div id="editar-contra">
        <h2><i class="fas fa-key"></i> Cambiar Contraseña</h2>
        <label for="">Contraseña Anterior</label>
        <div class="input">
          <input
            type="password"
            id="passwd1"
            placeholder="Contraseña Anterior"
          />
          <button onclick="passwd(1)" id="passeye1" class="hidden">
            <i class="fas fa-eye-slash"></i>
          </button>
        </div>
        <label for="">Nueva Contraseña</label>
        <div class="input">
          <input type="password" id="passwd2" placeholder="Nueva Contraseña" />
          <button onclick="passwd(2)" id="passeye2" class="hidden">
            <i class="fas fa-eye-slash"></i>
          </button>
        </div>
        <label for="">Confirme la Nueva Contraseña</label>
        <div class="input">
          <input
            type="password"
            id="passwd3"
            placeholder="Confirme la Nueva Contraseña"
          />
          <button onclick="passwd(3)" id="passeye3" class="hidden">
            <i class="fas fa-eye-slash"></i>
          </button>
        </div>
        <button><i class="fas fa-save"></i> Cambiar</button>
      </div>

      <div id="administrar-usuarios">
        <h2><i class="fas fa-users-cog"></i> Administrar Usuarios</h2>
        <div class="administrar-usuarios-grid">
          <div class="add-user">
            <h2><i class="fas fa-user-edit"></i> Crear Nuevo Usuario</h2>
            <label for="">Usuario</label>
            <div class="input">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Usuario"/>
            </div>
            <label for="">Nombre</label>
            <div class="input">
              <i class="fas fa-signature"></i>
              <input type="text" placeholder="Nombre"/>
            </div>
            <label for="">Teléfono</label>
            <div class="input">
              <i class="fas fa-phone"></i>
              <input
                type="number"
                placeholder="Teléfono"
              />
            </div>
            <label for="">Correo Electrónico</label>
            <div class="input">
              <i class="fas fa-envelope"></i>
              <input
                type="text"
                placeholder="Correo Electrónico"
              />
            </div>
            <label for="">Contraseña</label>
            <div class="input">
              <i class="fas fa-user-lock"></i>
              <input
                type="password"
                placeholder="Contraseña"
              />
            </div>
            <label for="">Confirmar Contraseña</label>
            <div class="input">
              <i class="fas fa-lock"></i>
              <input
                type="password"
                placeholder="Confirmar Contraseña"
              />
            </div>
            <button><i class="fas fa-save"></i> Guardar</button>
          </div>
          
          <div class="users-list">
            <div class="usuario">
              <div class="user-left">
                <div class="user-img">
                  <i class="fas fa-hammer"></i>
                </div>
                <div class="user-info">
                  <h3>John Doe</h3>
                  <p><i class="fas fa-lock"></i> Administrador Web</p>
                </div>
              </div>
              <div class="user-buttons">
                <button><i class="fas fa-pencil-alt"></i></button>
                <button><i class="fas fa-trash-alt"></i></button>
              </div>
            </div>

            <div class="usuario">
              <div class="user-left">
                <div class="user-img">
                  <i class="fas fa-user"></i>
                </div>
                <div class="user-info">
                  <h3>Jhon Doee</h3> 
                  <p><i class="fas fa-user-tie"></i> Administrador</p>
                </div>
              </div>
              <div class="user-buttons">
                <button><i class="fas fa-pencil-alt"></i></button>
                <button><i class="fas fa-trash-alt"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="editar-idioma">
        <h2><i class="fas fa-globe-americas"></i> Cambiar Idioma</h2>
        <div class="input">
          <i class="fas fa-globe"></i>
          <select name="" id="">
            <option value="0">Selecciona un Idioma</option>
            <option value="0" selected>Español</option>
            <option value="0">English</option>
            <option value="0">Portuguese</option>
          </select>
        </div>
        <button><i class="fas fa-save"></i> Cambiar</button>
      </div>

      <div id="configuracion-filtrado">
        <h2><i class="fa-solid fa-arrow-down-short-wide"></i> Configuración Filtrado</h2>
        <div class="input check">
          <?php 
          if($checkFiltros['NOCTURNO'] == 1){
            ?>
            <input type="checkbox" name="" class="checkbox-filtros" id="nocturno" checked>
            <?php 
          }else {
            ?>
            <input type="checkbox" name="" class="checkbox-filtros" id="nocturno">
            <?php 
          }
          ?>
          <p>Nocturno</p>
        </div>
        <div class="input check">
        <?php 
          if($checkFiltros['FIESTAS'] == 1){
            ?>
            <input type="checkbox" name="" class="checkbox-filtros" id="fiestas" checked>
            <?php 
          }else {
            ?>
            <input type="checkbox" name="" class="checkbox-filtros" id="fiestas" >
            <?php 
          }
          ?>
          <p>Fiestas</p>
        </div>
        <div class="input check">
        <?php 
          if($checkFiltros['DIA_LIBRE'] == 1){
            ?>
            <input type="checkbox" name="" class="checkbox-filtros" id="dia_libre" checked>
            <?php 
          }else {
            ?>
            <input type="checkbox" name="" class="checkbox-filtros" id="dia_libre" >
            <?php 
          }
          ?>
          <p>Día Libre</p>
        </div>
        <div class="input check">
        <?php 
          if($checkFiltros['PRECIO'] == 1){
            ?>
            <input type="checkbox" name="" class="checkbox-filtros" id="precio" checked>
            <?php 
          }else {
            ?>
            <input type="checkbox" name="" class="checkbox-filtros" id="precio" >
            <?php 
          }
          ?>
          <p>Precio del Coche</p>
        </div>
        <div class="input check">
        <?php 
          if($checkFiltros['MOROSO'] == 1){
            ?>
            <input type="checkbox" name="" class="checkbox-filtros" id="moroso" checked>
            <?php 
          }else {
            ?>
            <input type="checkbox" name="" class="checkbox-filtros" id="moroso" >
            <?php 
          }
          ?>
          <p>Moroso</p>
        </div>
        <div class="input check">
        <?php 
          if($checkFiltros['CAPACIDAD'] == 1){
            ?>
          <input type="checkbox" name="" class="checkbox-filtros" id="capacidad" checked>
            <?php 
          }else {
            ?>
          <input type="checkbox" name="" class="checkbox-filtros" id="capacidad" >
            <?php 
          }
          ?>
          <p>Capacidad</p>
        </div>
        <div class="input check">
        <?php 
          if($checkFiltros['PET_FRIENDLY'] == 1){
            ?>
          <input type="checkbox" name="" class="checkbox-filtros" id="pet_friendly" checked>
            <?php 
          }else {
            ?>
          <input type="checkbox" name="" class="checkbox-filtros" id="pet_friendly" >
            <?php 
          }
          ?>
          <p>Pet Friendly</p>
        </div>
        <div class="input check">
        <?php 
          if($checkFiltros['OCUPADO'] == 1){
            ?>
          <input type="checkbox" name="" class="checkbox-filtros" id="ocupado" checked>
            <?php 
          }else {
            ?>
          <input type="checkbox" name="" class="checkbox-filtros" id="ocupado" >
            <?php 
          }
          ?>
          <p>Ocupado</p>
        </div>
        <div class="input check">
        <?php 
          if($checkFiltros['PATA'] == 1){
            ?>
          <input type="checkbox" name="" class="checkbox-filtros" id="pata" checked>
            <?php 
          }else {
            ?>
          <input type="checkbox" name="" class="checkbox-filtros" id="pata" >
            <?php 
          }
          ?>
          <p>Pata del Viaje</p>
        </div>
        <!-- <button><i class="fas fa-save"></i> Guardar</button> -->
      </div>
    </div>

    <header class="panel-header" id="header">
      <div class="header-left">
        <div class="header-menu">
          <button onclick="navbar()"><i class="fas fa-bars"></i></button>
        </div>
        <div class="header-title">
          <h2>Configuración</h2>
        </div>
      </div>
      <div class="header-right">
        <div class="header-user">
          <div class="icon"><img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje"></div>
          <div class="user">
            <h2><?php echo $_SESSION['usuario'] ?></h2>
            <p><i class="fas fa-user-tie"></i> <?php echo $_SESSION['tipo_usuario'] ?></p>
          </div>
          <button><i class="fas fa-sign-out-alt"></i></button>
        </div>
      </div>
    </header>

    <nav class="nav-hidden active" id="panel-navbar"></nav>

    <section class="panel" id="panel">
      <div class="panel-settings-header">
        <div class="settings-icon">
          <i class="fas fa-cog"></i>
        </div>
        <div class="settings-info">
          <h2>Configuración</h2>
          <p>
            Utilice este panel tanto para realizar cambios en su usuario, como en el sitio web.
          </p>
        </div>
      </div>

      <div class="panel-settings">
        <button onclick="settings(1)" class="settings-button">
          <i class="fas fa-user-edit"></i>
          <p>Editar Información</p>
        </button>
        <button onclick="settings(2)" class="settings-button">
          <i class="fas fa-key"></i>
          <p>Cambiar Contraseña</p>
        </button>
        <!-- <button onclick="settings(3)" class="settings-button">
          <i class="fas fa-users-cog"></i>
          <p>Administrar Usuarios</p>
        </button>
        <button onclick="settings(4)" class="settings-button">
          <i class="fas fa-globe-americas"></i>
          <p>Cambiar Idioma</p>
        </button> -->
        <button onclick="settings(5)" class="settings-button">
          <i class="fa-solid fa-arrow-down-short-wide"></i>
          <p>Configuración Filtrado</p>
        </button>
      </div>
    </section>
  </body>
  <script>
    $(".checkbox-filtros").on("change", function() {
      
      let filtros = {
        "NOCTURNO" : $("#nocturno").prop('checked') == true ? 1 : 0,
        "FIESTAS" : $("#fiestas").prop('checked') == true ? 1 : 0,
        "DIA_LIBRE" : $("#dia_libre").prop('checked') == true ? 1 : 0,
        "PRECIO" : $("#precio").prop('checked') == true ? 1 : 0,
        "MOROSO" : $("#moroso").prop('checked') == true ? 1 : 0,
        "CAPACIDAD" : $("#capacidad").prop('checked') == true ? 1 : 0,
        "PET_FRIENDLY" : $("#pet_friendly").prop('checked') == true ? 1 : 0,
        "OCUPADO" : $("#ocupado").prop('checked') == true ? 1 : 0,
        "PATA" : $("#pata").prop('checked') == true ? 1 : 0
      }

      $.ajax({
        type: "POST",
        url: "../PHP/procedimientosForm.php",
        data: {"filtros": JSON.stringify(filtros), "tipo": "filtros-admin"},
        success: function (response) {
          console.log(response)
        }
      });
    })
  </script>
</html>
