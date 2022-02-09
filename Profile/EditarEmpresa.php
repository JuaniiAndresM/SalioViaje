<?php 

  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');
  }else{

  }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Editar Empresa</title>

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
          <h2>Editar Empresa</h2>
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
                <h2>Nombre de la Empresa</h2>
                <p><i class="fas fa-building"></i> Empresa</p>
              
            </div>
          </div>
        </div>

        <div class="profile-grid">
          <div class="user-informacion">
            <h3><i class="fas fa-address-card"></i> Información de la Empresa</h3>

            <div class="informacion-wrapper">

              <div class="info">
                <b><i class="far fa-address-card"></i> RUT</b>
                <input type="number" placeholder="RUT" value="123456123456">
              </div>
              <div class="info">
                <b><i class="fas fa-signature"></i> Nombre Comercial</b>
                <input type="text" placeholder="Nombre Comercial" value="Nombre de la Empresa">
              </div>
              <div class="info">
                <b><i class="fas fa-building"></i> Razón Social</b>
                <input type="text" placeholder="Razón Social" value="S.A">
              </div>
              <div class="info">
                <b><i class="fas fa-user-friends"></i> Choferes Asociados</b>
                <select name="" id="">
                    <option value="0" selected disabled hidden>Choferes Asociados</option>
                    <option value="1">Si</option>
                    <option value="1">No</option>
                </select>
              </div>
              <div class="info">
                <b><i class="fas fa-user-lock"></i> N° MTOP</b>
                <input type="text" placeholder="N° MTOP" value="">
              </div>
              <div class="info">
                <b><i class="fas fa-key"></i> Contraseña MTOP</b>
                <input type="password" id="password" placeholder="Contraseña MTOP" value="1234">
                <button onclick="passwd(1)" class="password-eye"><i id="passeye" class="fas fa-eye-slash"></i></button>
              </div>

            </div>
            <div class="button-wrapper">
                <button class="button-guardar"><i class="fas fa-arrow-left"></i> Cancelar</button>
                <button class="button-guardar"><i class="fas fa-save"></i> Guardar Cambios</button>
            </div>
          </div>

          <div class="viajes-wrapper">
            <h3><i class="fas fa-bus"></i> Agregar Vehiculos</h3>

            <div class="agregar-vehicle">
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

                <div class="button-wrapper">
                    <button class="button-agregar"><i class="fas fa-plus"></i> Agregar Vehiculo</button>
                </div>

                <div class="vehiculos-wrapper">
                    <div class="vehiculos">
                        <div class="vehiculo">
                            <div class="vehiculo-left">
                                <div class="vehiculo-icon">
                                    <i class="fas fa-car"></i>
                                </div>
                                <div class="vehiculo-info">
                                    <h3 class="matricula">STU6743</h3>
                                    <p><i class="fas fa-users"></i>12</p>
                                </div>
                            </div>

                            <div class="edit-button">
                                <button class="editar_vehiculo" onclick="formulario_editar_vehiculo('STU6743')"><i class="fas fa-pencil-alt"></i></button>
                                <button class="eliminar_vehiculo" onclick="eliminar_vehiculo('STU6743')"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <button class="save-button" id="finalizar_empresa_2"><i class="fas fa-save"></i> Guardar Cambios</button>

                </div>
            </div>
          </div>
        </div>
        <div class="profile_grid2"></div>

        
      </div>
    </section>
  </body>
</html>
