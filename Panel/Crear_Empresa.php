<?php 
$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');

  }else{
    if($_SESSION['tipo_usuario'] == "Pasajero"){
      header('Location: https://www.salioviaje.com.uy/');
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Crear Empresa</title>

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Crear_Empresa" />
    <meta property="og:title" content="SalióViaje | Crear Empresa" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Crear_Empresa" />
    <meta
      property="twitter:title"
      content="SalióViaje | Crear Empresa"
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
    <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/form.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/crearEmpresaDashboard.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
    <script type="text/javascript">
        Empresas();
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

    <header class="panel-header" id="header">
      <div class="header-left">
        <div class="header-menu">
          <button onclick="navbar()"><i class="fas fa-bars"></i></button>
        </div>
        <div class="header-title">
          <h2>Crear Empresa</h2>
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
        <div class="crear_empresa-wrapper">
            <input type="text" id="tipo_usuario" style="display: none;" value="<?php echo $_SESSION['tipo_usuario'] ?>">

            <h1>Salió<span>Viaje</span></h1>

            <div class="progress-bar">
                <span class="line"></span>
                <span class="progress"></span>

                <span class="circle1"></span>
                <span class="circle2"></span>
            </div>

            <div id="step_1">
                <h2 class="step_title"><i class="fas fa-building"></i> Crear Empresa</h2>

                <div class="inputs-wrapper-register">
                    <div class="column">
                    <div class="input">
                        <i class="fas fa-address-card" id="icon"></i>
                        <input type="number" id="rutt" maxlength="12" placeholder="RUT" />
                    </div>

                    <div class="input">
                        <i class="fas fa-signature" id="icon"></i>
                        <input type="text" id="nombre_comercial" placeholder="Nombre Comercial" />
                    </div>

                    <div class="input">
                        <i class="fas fa-building" id="icon"></i>
                        <input type="text" id="razon_social" placeholder="Razón Social" />
                    </div>
                    </div>
                    <div class="column">
                    <div class="input" id="contratista">
                        <i class="fas fa-building" id="icon"></i>
                        <select name="" id="empresas">
                        </select>
                    </div>
                    <div class="input" id="choferes_sub">
                        <i class="fas fa-user-friends" id="icon"></i>
                        <select name="" id="choferes_sub_select">
                        <option value="0" selected disabled hidden>Choferes Subcontratados</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                        </select>
                    </div>
                    <div class="input">
                        <i class="fas fa-user-lock" id="icon"></i>
                        <input type="number" id="numero_mtop" placeholder="N° MTOP" />
                    </div>
                    <div class="input">
                        <i class="fas fa-key" id="icon"></i>
                        <input
                        id="password_mtop"
                        type="password"
                        name="PassMTOP"
                        placeholder="Contraseña MTOP"
                        
                        />
                        <button onclick="passwd(4)" class="password-eye"><i id="passeye3" class="fas fa-eye-slash"></i></button>
                    </div>
                    </div>
                </div>

                <p id="mensaje-error" class="mensaje-error"></p>
                
            
                <button class="button-register" id="add-vehicle" onclick="valido_Empresa_sin_crearla('<?php echo $_SESSION['datos_usuario']['TIPO_USUARIO'] ?>')">
                    <i class="fas fa-car-side"></i> Agregar Vehículo
                </button>
                <button class="button-register" id="finalizar_empresa" onclick="crear_empresa_dash('<?php echo $_SESSION['datos_usuario']['TIPO_USUARIO'] ?>')">
                    <i class="fas fa-building"></i> Crear Empresa
                </button>
            </div>

            <div id="step_2">
            <h2 class="step_title"><i class="fas fa-bus"></i> Agregar Vehículos</h2>
            <div class="inputs-wrapper-register">
                <div class="column">
                <div class="input">
                    <i class="fas fa-font" id="icon"></i>
                    <input type="text" id="matricula" maxlength="7" placeholder="Matrícula"/>
                </div>

                <div class="input">
                    <i class="fas fa-car" id="icon"></i>
                    <input type="text" id="marca" placeholder="Marca" />
                </div>

                <div class="input">
                    <i class="fas fa-list" id="icon"></i>
                    <input type="text" id="modelo" placeholder="Modelo" />
                </div>

                <div class="input">
                    <i id="icon" class="fas fa-gas-pump"></i>
                    <select name="" id="combustible">
                    <option value="0" selected disabled hidden>Combustible</option>
                    <option value="Nafta">Nafta</option>
                    <option value="Gasoil">Gasoil</option>
                    <option value="Electico">Electrico</option>
                    <option value="Hibrido">Híbrido</option>
                    </select>
                </div>

                </div>
                <div class="column">

                <div class="input">
                    <i class="fas fa-users" id="icon"></i>
                    <input type="number" id="capacidad_pasajeros" placeholder="Capacidad Pasajeros" />
                </div>

                <div class="input">
                    <i class="fas fa-luggage-cart" id="icon"></i>
                    <input type="text" id="capacidad_equipaje" placeholder="Capacidad Equipaje" />
                </div>

                <div class="input">
                    <i id="icon" class="fas fa-dog"></i>
                    <select name="" id="pet_friendly">
                    <option value="0" selected disabled hidden>Pet Friendly</option>
                    <option value="1">No</option>
                    <option value="2">Si</option>
                    </select>
                </div>
                </div>
            </div>

            <p id="mensaje-error" class="mensaje-error"></p>

            <button class="button-register" id="btn-volver" onclick="volver()">
                <i class="fas fa-arrow-circle-left"></i> Volver
            </button>
            <button class="button-register" id="add-vehicle2" onclick="add_vehicle()">
                <i class="fas fa-car-side"></i> Agregar Vehículo
            </button>
            <button class="button-register" id="guardar-cambios" onclick="editar_vehiculo()">
                <i class="fas fa-car-side"></i> Guardar Cambios
            </button>
            </div>

            <div class="vehiculos-wrapper">
            <div class="vehiculos">
                <div id="no-vehicle"><p>No hay vehículos agregados.</p></div>
            </div>
            <button class="finalizar-button" id="finalizar_empresa_2" onclick="crear_empresa_dash('<?php echo $_SESSION['datos_usuario']['TIPO_USUARIO'] ?>')"><i class="fas fa-building"></i> Finalizar Empresa</button>

            </div>

            <div id="step_3">
            <div class="button-wrapper">
                <button onclick="new_company()" id="add_company_button"><i class="fas fa-plus"></i> Agregar Nueva Empresa</button>
                <button id="finalizar-registro-TTA" onclick="finalizar_empresa_total(<?php echo json_encode($_SESSION['datos_usuario']['ID']); ?>)"><i class="fas fa-check"></i> Finalizar</button>
            </div>
            </div>


        </div>
    </section>
  </body>
</html>
