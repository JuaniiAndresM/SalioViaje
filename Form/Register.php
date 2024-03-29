<?php
require_once '../PHP/procedimientosBD.php';

$regiones_mtop = new procedimientosBD();

$barrios = json_decode($regiones_mtop->traer_barrios(), true);
// $regiones_mtop = json_decode($regiones_mtop->traer_regiones_mtop(), true);

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Register</title>

    <!-- // Meta Etiquetas -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    />

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Register" />
    <meta property="og:title" content="SalióViaje | Register" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Register" />
    <meta
      property="twitter:title"
      content="SalióViaje | Register"
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
    <script src="https://www.salioviaje.com.uy/Plugins/JQuery/jquery.min.js"></script>
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>

    <script src="https://www.salioviaje.com.uy/Javascript/web.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/gurucuteco.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/form.js"></script>
    <script type="text/javascript">  
      Empresas(); 
      Hoteles_select();
    </script>
  </head>
  <body>
    <div id="header"></div>

    <div id="gurucuteco"></div>

    <a href="https://www.salioviaje.com.uy/FAQ" target="_BLANK" id="faq-float">
      <i class="fas fa-question"></i>
    </a>
    <a href="https://wa.link/mxnwzm" target="_BLANK" id="whatsapp-float">
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

    <section class="register">
      <div class="register-wrapper">
        <h1>Salió<span>Viaje</span></h1>

        <div class="progress-bar">
          <span class="line"></span>
          <span class="progress"></span>

          <span class="circle1"></span>
          <span class="circle2"></span>
          <span class="circle3"></span>
        </div>

        <div class="progress-bar2">
          <span class="line"></span>
          <span class="progress2"></span>

          <span class="circle1"></span>
          <span class="circle2"></span>
        </div>

        <div id="step_1">
          <div class="input">
            <i class="fas fa-user-check" id="icon"></i>
            <select name="" id="select_users" onchange="select_usuario()">
              <option value="0" selected disabled hidden >Tipo de Usuario</option>
              <option value="1">Pasajero</option>
              <option value="2">Transportista</option>
              <option value="3">Chofer</option>
              <option value="4">Anfitrión</option>
              <option value="5">Hotel</option>
              <option value="6">Asesor</option>
              <option value="7">Agente</option>
            </select>
            <button class="gurucuteco-button" onclick="openGurucuteco(1)"><i class="fa-solid fa-circle-question"></i></button>
          </div>

          <button class="button-register" id="button_next_step" onclick="next()">
            <i class="fas fa-arrow-circle-right"></i> Siguiente
          </button>

          <div class="register-bottom">
            <p>
              ¿Ya tienes una cuenta?
              <a href="https://www.salioviaje.com.uy/Login">Inicia Sesión</a>.
            </p>
          </div>
        </div>

        <div id="step_2">
          <h2 class="step_title"><i class="fas fa-user-cog"></i> Información Personal</h2>
          <div class="inputs-wrapper-register">
            <div class="column">
              <div class="input" id="ci">
                <i class="fas fa-user" id="icon"></i>
                <input type="number" id="CI" maxlength="8" placeholder="C.I" />
                <span class="obligatorio">*</span>
              </div>

              <div class="input">
                <i class="fas fa-envelope" id="icon"></i>
                <input type="email" id="correo" placeholder="Correo Electronico" />
                <span class="obligatorio">*</span>
              </div>

              <div class="input">
                <i class="fas fa-signature" id="icon"></i>
                <input type="text" id="nombre" placeholder="Nombre" />
                <span class="obligatorio">*</span>
              </div>

              <div class="input">
                <i class="fas fa-signature" id="icon"></i>
                <input type="text" id="apellido" placeholder="Apellido" />
                <span class="obligatorio">*</span>
              </div>

              <div class="input" id="direccion-input">
                <i class="fas fa-map-marker-alt" id="icon"></i>
                <input type="text" id="direccion" placeholder="Dirección" />
              </div>
            </div>
            <div class="column">

              <!-- <div class="input" id="barrio-input">
                <i class="fas fa-map-marked-alt" id="icon"></i>
                <input type="text" id="barrio" placeholder="Barrio" />
              </div> -->

              <div class="input">
                <i class="fas fa-map-marked-alt" id="icon"></i>
                <input list="Barrio" id="barrio" placeholder="Barrio">
                <datalist id="Barrio">
                  <?php
                    if (isset($barrios)) {
                      for ($i=0; $i < count($barrios); $i++) { 
                       ?>
                       <option value="<?php echo $barrios[$i] ?>">
                       <?php
                      }
                    }
                  ?>
                </datalist>
              </div>

              <!-- <div class="input" id="departamento-input">
                <i class="fas fa-map" id="icon"></i>
                <input type="text" id="departamento" placeholder="Departamento" />
              </div> -->

              <div class="input">
                <i class="fas fa-map" id="icon"></i>
                <input list="Departamento" id="departamento" placeholder="Departamento">
                <datalist id="Departamento">
                   <option value="ARTIGAS">
                   <option value="CANELONES">
                   <option value="CERRO LARGO">
                   <option value="SAN JOSE">
                   <option value="FLORIDA">
                   <option value="SORIANO">
                   <option value="RIO NEGRO">
                   <option value="TACUAREMBO">
                   <option value="RIVERA">
                   <option value="MONTEVIDEO">
                   <option value="ROCHA">
                   <option value="SALTO">
                   <option value="RIVERA">
                   <option value="PAYSANDU">
                   <option value="TREINTA Y TRES">
                   <option value="FLORES"> 
                   <option value="COLONIA">
                   <option value="MALDONADO"> 
                   <option value="LAVALLEJA">
                </datalist>
              </div>

              <div class="input" id="telefono-input">
                <i class="fas fa-phone" id="icon"></i>
                <input type="number" id="numero_telefono" placeholder="Teléfono" />
                <span class="obligatorio">*</span>
              </div>

              <div class="input">
                <i class="fas fa-key" id="icon"></i>
                <input
                  type="password"
                  id="password"
                  name="pin"
                  placeholder="PIN"
                  maxlength="4"
                  pattern="[0-9]{4}"
                />
                <button onclick="passwd(2)" class="password-eye"><i id="passeye" class="fas fa-eye-slash"></i></button>
              </div>

              <div class="input">
                <i class="fas fa-key" id="icon"></i>
                <input
                  type="password"
                  id="re-password"
                  name="pin"
                  placeholder="Confirmar PIN"
                  maxlength="4"
                  pattern="[0-9]{4}"
                />
                <button onclick="passwd(3)" class="password-eye"><i id="passeye2" class="fas fa-eye-slash"></i></button>
              </div>
            </div>
          </div>

          <p id="mensaje-error" class="mensaje-error"></p>

          <button class="button-register" id="button_volver" onclick="volver()">
            <i class="fas fa-arrow-circle-left"></i> Volver
          </button>
          <button class="button-register" id="pax-register">
            <i class="fas fa-sign-in-alt"></i> Registrarse
          </button>
          <button class="button-register" id="step-next">
            <i class="fas fa-arrow-circle-right"></i> Siguiente
          </button>
        </div>

        <div id="step_hotel">
          <h2 class="step_title"><i class="fas fa-h-square"></i> ¿El Hotel ya Existe?</h2>
          <div class="inputs-wrapper-register-hotel">

            <div class="input" id="existehotel">
              <i class="fas fa-hotel" id="icon"></i>
              <select id="existe-hotel">
                <option value="0" disabled selected hidden>Seleccion una opción</option>
                <option value="1">Si</option>
                <option value="2">No</option>
              </select>
              <span class="obligatorio">*</span>

            </div>

          </div>

          <p id="mensaje-error" class="mensaje-error"></p>

          <button class="button-register" id="company_volver_hotel" onclick="volver()">
            <i class="fas fa-arrow-circle-left"></i> Volver
          </button>
          <button class="button-register" onclick="next()" id="finalizar_hotel">
            <i class="fas fa-arrow-circle-right"></i> Siguiente
          </button>
        </div>

        <div id="step_hotel_no">
          <h2 class="step_title"><i class="fas fa-h-square"></i> Crear Hotel</h2>
          <div class="inputs-wrapper-register">
            <div class="column">

              <div class="input" id="ruthotel">
                <i class="fas fa-id-card-clip" id="icon"></i>
                <input type="number" id="rut-hotel" placeholder="RUT" />
                <span class="obligatorio">*</span>
              </div>

              <div class="input" id="nombrehotel">
                <i class="fas fa-building" id="icon"></i>
                <input type="text" id="nombre-hotel" placeholder="Nombre del Hotel" />
                <span class="obligatorio">*</span>
              </div>

            </div>
            <div class="column">
              <div class="input" id="razonhotel">
                <i class="fas fa-building" id="icon"></i>
                <input type="text" id="razon-hotel" placeholder="Razón Social" />
                <span class="obligatorio">*</span>
              </div>
              
              <div class="input" id="direccionhotel">
                <i class="fas fa-map-marked-alt" id="icon"></i>
                <input type="text" id="direccion-hotel" placeholder="Dirección del Hotel" />
                <span class="obligatorio">*</span>
              </div>
            </div>
          </div>

          <p id="mensaje-error" class="mensaje-error"></p>

          <button class="button-register" id="company_volver_hotel" onclick="volver()">
            <i class="fas fa-arrow-circle-left"></i> Volver
          </button>
          <button class="button-register" onclick="register_form($('#select_users').val())" id="finalizar_hotel">
            <i class="fas fa-building"></i> Crear Hotel
          </button>
        </div>
        
        <div id="step_hotel_si">
          <h2 class="step_title"><i class="fas fa-h-square"></i> Elige un Hotel Existente</h2>
          <div class="inputs-wrapper-register-hotel">

            <div class="input" id="listhotel">
              <i class="fas fa-hotel" id="icon"></i>
              <select id="list-hotel">
                <option value="0" disabled selected hidden>Seleccion un Hotel</option>
                <option value="1">Hotel 1</option>
                <option value="2">Hotel 2</option>
              </select>
              <span class="obligatorio">*</span>

            </div>

          </div>

          <p id="mensaje-error" class="mensaje-error"></p>

          <button class="button-register" id="company_volver_hotel" onclick="volver()">
            <i class="fas fa-arrow-circle-left"></i> Volver
          </button>
          <button class="button-register" onclick="next()" id="finalizar_hotel">
            <i class="fas fa-check"></i> Finalizar
          </button>
        </div>

        <div id="step_3">
          <h2 class="step_title"><i class="fas fa-building"></i> Crear Empresa</h2>
          <div class="inputs-wrapper-register">
            <div class="column">
              <div class="input">
                <i class="fas fa-address-card" id="icon"></i>
                <input type="number" id="rutt" maxlength="12" placeholder="RUT" />
                <span class="obligatorio">*</span>
              </div>

              <div class="input">
                <i class="fas fa-signature" id="icon"></i>
                <input type="text" id="nombre_comercial" placeholder="Nombre Comercial" />
                <span class="obligatorio">*</span>
              </div>

              <div class="input">
                <i class="fas fa-building" id="icon"></i>
                <input type="text" id="razon_social" placeholder="Razón Social" />
                <span class="obligatorio">*</span>
              </div>
            </div>
            <div class="column">
              <div class="input" id="contratista">
                <i class="fas fa-building" id="icon"></i>
                <select name="" id="empresas">
                </select>
                <span class="obligatorio">*</span>
              </div>
              <div class="input" id="choferes_sub">
                <i class="fas fa-user-friends" id="icon"></i>
                <select name="" id="choferes_sub_select">
                  <option value="0" selected disabled hidden>Choferes Subcontratados</option>
                  <option value="1">Si</option>
                  <option value="2">No</option>
                </select>
                <span class="obligatorio">*</span>
              </div>
              <div class="input" id="nro_mtop_rgt">
                <i class="fas fa-user-lock" id="icon"></i>
                <input type="number" id="numero_mtop" placeholder="N° MTOP" />
              </div>
              <div class="input" id="pass_mtop_rgt">
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

          <button class="button-register" id="company_volver" onclick="volver()">
            <i class="fas fa-arrow-circle-left"></i> Volver
          </button>
          <button class="button-register" id="company_volver2" onclick="volver_finalizar()">
            <i class="fas fa-arrow-circle-left"></i> Volver
          </button>
          <button class="button-register" id="add-vehicle">
            <i class="fas fa-car-side"></i> Agregar Vehículo
          </button>
          <button class="button-register" id="finalizar_empresa" onclick="crear_empresa(1)">
            <i class="fas fa-building"></i> Crear Empresa
          </button>
        </div>

        <div id="step_4">
          <h2 class="step_title"><i class="fas fa-bus"></i> Agregar Vehículos</h2>
          <div class="inputs-wrapper-register">
            <div class="column">
              <div class="input">
                <i class="fas fa-font" id="icon"></i>
                <input type="text" id="matricula" maxlength="7" placeholder="Matrícula"/>
                <span class="obligatorio">*</span>
              </div>

              <div class="input">
                <i class="fas fa-car" id="icon"></i>
                <input type="text" id="marca" placeholder="Marca" />
                <span class="obligatorio">*</span>
              </div>

              <div class="input">
                <i class="fas fa-list" id="icon"></i>
                <input type="text" id="modelo" placeholder="Modelo" />
                <span class="obligatorio">*</span>
              </div>

              <div class="input">
                <i id="icon" class="fas fa-gas-pump"></i>
                <select name="" id="combustible">
                  <option value="0" selected disabled hidden>Combustible</option>
                  <option value="Nafta">Nafta</option>
                  <option value="Gasoil">Gasoil</option>
                  <option value="Electrico">Electrico</option>
                  <option value="Hibrido">Híbrido</option>
                </select>
                <span class="obligatorio">*</span>
              </div>

            </div>
            <div class="column">

              <div class="input">
                <i class="fas fa-users" id="icon"></i>
                <input type="number" id="capacidad_pasajeros" placeholder="Capacidad Pasajeros" />
                <span class="obligatorio">*</span>
              </div>

              <div class="input">
                <i class="fas fa-luggage-cart" id="icon"></i>
                <input type="text" id="capacidad_equipaje" placeholder="Capacidad Equipaje" />
                <span class="obligatorio">*</span>
              </div>

              <div class="input">
                <i id="icon" class="fas fa-dog"></i>
                <select name="" id="pet_friendly">
                  <option value="0" selected disabled hidden>Pet Friendly</option>
                  <option value="1">No</option>
                  <option value="2">Si</option>
                </select>
                <span class="obligatorio">*</span>
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
           <button class="finalizar-button" id="finalizar_empresa_2"><i class="fas fa-building"></i> Finalizar Empresa</button>

        </div>

        <div id="step_5">
          <div class="button-wrapper">
            <button onclick="new_company()" id="add_company_button"><i class="fas fa-plus"></i> Agregar Nueva Empresa</button>
            <button id="finalizar-registro-TTA"><i class="fas fa-check"></i> Finalizar</button>
          </div>
        </div>


      </div>
    </section>

    <div id="footer"></div>
  </body>
</html>
