<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje - Dashboard</title>

    <!-- // Verifico sesion -->

    <?php 
          session_start(); 
          if(!isset($_SESSION['usuario'])){
            header('Location: https://www.salioviaje.com.uy/Login');
          }
         ?>

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
    <meta property="og:url" content="https://www.salioviaje.com/" />
    <meta property="og:title" content="SalióViaje - Register" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com/" />
    <meta property="twitter:title" content="SalióViaje - Register" />
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
    <link rel="stylesheet" href="https://www.salioviaje.com.uy/styles/styles.css" />

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <label for="">Usuario</label>
        <div class="input">
          <i class="fas fa-user"></i>
          <input type="text" placeholder="Nuevo Usuario" value="johndoe_" />
        </div>
        <label for="">Nombre</label>
        <div class="input">
          <i class="fas fa-signature"></i>
          <input type="text" placeholder="Nuevo Nombre" value="Jhon Doe" />
        </div>
        <label for="">Teléfono</label>
        <div class="input">
          <i class="fas fa-phone"></i>
          <input type="number" placeholder="Nuevo Teléfono" value="098234717" />
        </div>
        <label for="">Correo Electrónico</label>
        <div class="input">
          <i class="fas fa-envelope"></i>
          <input
            type="text"
            placeholder="Nuevo Correo Electrónico"
            value="thewolfmodzyt@gmail.com"
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
                  <h3>John Doe</h3>
                  <p><i class="fas fa-home"></i> Inmobiliaria</p>
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
          <div class="icon"><i class="fab fa-apple"></i></div>
          <div class="user">
            <h2>John Doe</h2>
            <p><i class="fas fa-user-tie"></i> Administrador</p>
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
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam ad
            praesentium modi cupiditate in vitae? Non ducimus neque tenetur
            molestias.
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
        <button onclick="settings(3)" class="settings-button">
          <i class="fas fa-users-cog"></i>
          <p>Administrar Usuarios</p>
        </button>
        <button onclick="settings(4)" class="settings-button">
          <i class="fas fa-globe-americas"></i>
          <p>Cambiar Idioma</p>
        </button>
        <button onclick="settings(5)" class="settings-button">
          <i class="fas fa-wrench"></i>
          <p>Configuración Panel</p>
        </button>
      </div>
    </section>
  </body>
</html>
