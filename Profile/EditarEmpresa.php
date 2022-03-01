<?php 

require_once '../PHP/procedimientosBD.php';
  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');
  }else{

    $rut = $_GET['RUT'];

    $info_empresa = new procedimientosBD();

    $usuario = $info_empresa->traer_datos_empresa($rut);
    $vehiculos = $info_empresa->traer_datos_vehiculo($rut);

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

    <script src="/SalioViaje/Javascript/form.js"></script>
    <script src="/SalioViaje/Javascript/panel.js"></script>
    <script src="/SalioViaje/Javascript/settings.js"></script>
    <script src="/SalioViaje/Javascript/loader.js"></script>
    <script src="/SalioViaje/Javascript/profile.js"></script>
    <script src="/SalioViaje/Javascript/editarEmpresa.js"></script>



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
                <h2><?php echo $usuario['NOMBRE_COMERCIAL'];?></h2>
                <p><i class="fas fa-building"></i> Empresa</p>
              
            </div>
          </div>
        </div>

        <div class="profile-grid">
          <div class="user-informacion">
            <h3><i class="fas fa-address-card"></i> Información de la Empresa</h3>

            <div class="informacion-wrapper">

              <div class="info">
                <b><i class="fas fa-signature"></i> Nombre Comercial</b>
                <input type="text" placeholder="Nombre Comercial" id="NcEdicion"value="<?php echo $usuario['NOMBRE_COMERCIAL'];?>">
              </div>
              <div class="info">
                <b><i class="fas fa-building"></i> Razón Social</b>
                <input type="text" placeholder="Razón Social" id="RsEdicion"value="<?php echo $usuario['RAZON_SOCIAL'];?>">
              </div>
              <div class="info">
                <b><i class="fas fa-user-friends"></i> Choferes Asociados</b>
                <select name="" id="CaEdicion">
                    <?php 
                      if($usuario['CHOFERES_SUB'] == 1){
                        echo '
                          <option value="1" selected>Si</option>
                          <option value="0">No</option>
                        ';
                      }else{
                        echo '
                          <option value="0" selected>No</option>
                          <option value="1">Si</option>
                        ';
                        }
                    ?>
            
                </select>
              </div>
              <div class="info">
                <b><i class="fas fa-user-lock"></i> N° MTOP</b>
                <input type="text" placeholder="N° MTOP" id="NmEdicion"value="<?php echo $usuario['NRO_MTOP'];?>">
              </div>
              <div class="info">
                <b><i class="fas fa-key"></i> Contraseña MTOP</b>
                <input type="password"  id="password" placeholder="Contraseña MTOP" value="<?php echo $usuario['PASS_MTOP'];?>">
                
                <button onclick="passwd(1)" class="password-eye"><i id="passeye" class="fas fa-eye-slash"></i></button>
              </div>

            </div>
            <p id="mensaje-error" class="mensaje-error"></p>
            <div class="button-wrapper">
                <button class="button-guardar" onclick="editarEmpresa('<?php echo$_GET['RUT']?>')"><i class="fas fa-arrow-left"></i> Cancelar</button>
                <button class="button-guardar" onclick="guardarEdicionEmpresa('<?php echo$_GET['RUT']?>')"><i class="fas fa-save"></i> Guardar Cambios</button>
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
                    <button class="button-agregar" onclick="add_vehicle()"><i class="fas fa-plus"></i> Agregar Vehiculo</button>
                </div>

                <div class="vehiculos-wrapper">
                    <div class="vehiculos">
                    <?php 
                        if($vehiculos === null){
                          
                        }else{
                          $size = sizeof($vehiculos);
                          for($i = 0; $i< sizeof($vehiculos); $i++){
                            ?>
                                <script type="text/javascript">vehiculos_vista_previa(<?php  echo json_encode($vehiculos[$i]); ?>)</script>  
                            <?php 
                          }
                      }
                    ?>
                    </div>
                    <button class="save-button" id="finalizar_empresa_2" onclick="guardar_cambios_vehiculos_panel(<?php echo$_GET['RUT']?>)"><i class="fas fa-save"></i> Guardar Cambios</button>

                </div>
            </div>
          </div>
        </div>
        <div class="profile_grid2"></div>

        
      </div>
    </section>
  </body>
</html>
