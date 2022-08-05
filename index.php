<?php 
$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
session_start();

require_once 'PHP/procedimientosBD.php';
$regiones_mtop = new procedimientosBD();
$barrios = json_decode($regiones_mtop->traer_barrios(), true);
?>

<!DOCTYPE html>
<html lang="es">
<head> 
   <!-- ==================================================================== -->
    <title>Salió Viaje | Plataforma que optimiza el traslado ocasional</title>
    <meta name="description" content="Solucionamos tus necesidades de traslado. Te ofrecemos opciones para que elijas la mejor. Aprovecha nuestras Ofertas y Promociones"/>
    <meta name="keywords" content="Salió Viaje | Plataforma que optimiza el traslado ocasional"/>
    <meta name="robots" content="index,follow"/>

    
    
    <!-- ==================================================================== -->   
    
    <!-- // Meta Etiquetas -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <meta name="author" content="Daniel Schlebinger" />

    <meta name="theme-color" content="#3844bc"/>
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.salioviaje.com.uy" />
    <meta property="og:title" content="Salió Viaje | Plataforma que optimiza el traslado ocasional de personas" />
    <meta property="og:description" content="Plataforma que optimiza el traslado ocasional de personas."/>
    <meta property="og:image" content="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg" title="Logo | Salió Viaje" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://www.salioviaje.com.uy" />
    <meta property="twitter:title" content="Salió Viaje | Plataforma que optimiza el traslado ocasional de personas"/>
    <meta property="twitter:description" content="Plataforma que optimiza el traslado ocasional de personas."/>
    <meta property="twitter:image" content="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg"  title="Logo | Salió Viaje" />


    <!-- Links -->
    <link rel="shortcut icon" href="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://www.salioviaje.com.uy/styles/styles.min.css" media="all">
    <link rel="publisher" href="https://www.salioviaje.com.uy" />
    <link rel="canonical" href="https://www.salioviaje.com.uy"/>
    <!-- Scripts -->
    <script defer src="https://kit.fontawesome.com/1e193e3a23.js" crossorigin="anonymous"></script>    
    <script defer src="https://www.salioviaje.com.uy/Plugins/JQuery/jquery.min.js"></script>
    <script defer src="Javascript/web.js"></script>
    <script defer src="Javascript/viajar.js"></script>
    <script rel="preconnect" src="https://www.salioviaje.com.uy/Plugins/OneSignal/OneSignalSDK.js" async></script>
    <script>
      var OneSignal = window.OneSignal || [];
      OneSignal.push(function () {
        OneSignal.init({
          appId: "e851ce3f-65f4-4745-976e-781b3c36d150",
        });
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

      <div id="header">
          <header>
            <div class="header-wrapper">
                <div class="header-logo">
                    <a href="https://www.salioviaje.com.uy/" title="Home | Salió Viaje">
                        <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="Logo SalióViaje" title="Home | Salió Viaje" width="60" height="60"/></a>
                </div>
                <div class="header-right">
                    <div class="header-links">
                        <div class="links">
                            <a href="https://www.salioviaje.com.uy/" title="Home">Home</a>
                            <a href="https://www.salioviaje.com.uy/Central" title="Central De Cotizaciones">Central</a>
                            <a href="https://www.salioviaje.com.uy/Nosotros" title="Nosotros">Nosotros</a>


                            <a href="https://www.salioviaje.com.uy/Viajar" title="Oportunidades, Ofertas y Promociones">Oportunidades</a>
                            <a href="https://www.salioviaje.com.uy/Ofertas" title="Ofertas">Ofertas</a>
                            <a href="https://www.salioviaje.com.uy/Promociones" title="Promociones">Promociones</a>
                            <a href="https://www.salioviaje.com.uy/Experiencias" title="Experiencias y Promociones">Experiencias</a>
                            <a href="https://www.salioviaje.com.uy/FAQs" title="Frequently Asked Questions">FAQs</a>
                            <?php   
                            if(isset($_SESSION['tipo_usuario'])){
                                echo '<a href="https://www.salioviaje.com.uy/Dashboard" title="Panel de control" >Panel</a>';
                            }
                            ?>
                        </div>

                        <?php                
                        if(isset($_SESSION['usuario'])){
                            echo '  <div class="session">
                                        <div class="close-session">
                                            <button onclick="cerrarsesion()"><i class="fas fa-sign-out-alt"></i></button>
                                        </div>
                                        <button class="user" onclick="dashboard()">
                                            <h3 id="user-name">'.$_SESSION['usuario'].'</h3>
                                            <p id="rol"><i class="fas fa-bus"></i> '.$_SESSION['tipo_usuario'].'</p>
                                        </button>
                    
                                    </div>';
                        }else{
                            echo '  <div class="links-session">
                                        <a class="login_button" id="button" href="https://www.salioviaje.com.uy/Login" title="Login"><i class="fas fa-user"></i> Iniciar Sesión</a>
                                    </div>';
                        }
                        ?>
                    
                    
                    </div>

                    <div class="burger-mobile" onclick="myFunction(this)">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>

                    <div id="links-mobile" style="transform: translateY(-120%);">

                        <div class="links-wrapper">

                            <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="Logo | SalióViaje" title="Home | SalióViaje"width="60" height="60"/>

                            <?php

                            if(isset($_SESSION['usuario'])){
                                echo '  <div class="usuario">
                                            <h3>'.$_SESSION["usuario"].'</h3>
                                            <p><i class="fas fa-bus"></i> '.$_SESSION['tipo_usuario'].'</p>
                                        </div>';
                            }
                            if(isset($_SESSION['usuario'])){
                                echo '  <button onclick="cerrarsesion()"><i class="fas fa-sign-in-alt"></i> Cerrar Sesión</button>';
                            }else{
                                echo '<a href="https://www.salioviaje.com.uy/Login" title="Login"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>';
                            }

                            echo '  <a href="https://www.salioviaje.com.uy/" title="Home"><i class="fas fa-home"></i> Home</a>
                                    <a href="https://www.salioviaje.com.uy/Central" title="Central De Cotizaciones"><i class="fas fa-list-ul"></i> Central</a>
                                    <a href="https://www.salioviaje.com.uy/Nosotros" title="Nosotros"><i class="fas fa-info"></i> Sobre Nosotros</a>
                                    <a href="https://www.salioviaje.com.uy/Viajar" title="Oportunidades, Ofertas y Promociones"><i class="fas fa-book"></i> Oportunidades</a>
                                    <a href="https://www.salioviaje.com.uy/Ofertas" title="Ofertas"><i class="fa-solid fa-percent"></i> Ofertas</a>
                                    <a href="https://www.salioviaje.com.uy/Promociones" title="Promociones"><i class="fa-solid fa-bullhorn"></i> Promociones</a>
                                    <a href="https://www.salioviaje.com.uy/Experiencias" title="Experiencias y Promociones"><i class="fas fa-star"></i>     Experiencias</a>                          
                                    <a href="https://www.salioviaje.com.uy/FAQ" title="Frequently Asked Questions"><i class="fas fa-question"></i> FAQ</a>';
                                    if(isset($_SESSION['tipo_usuario'])){
                                        echo '<a href="https://www.salioviaje.com.uy/Dashboard"><i class="fas fa-users-cog"></i> Panel</a>';
                                    }
                            ?>

                        </div>

                    </div>

                </div>

            </div>
        </header>

        <script>
          function myFunction(x) {
              x.classList.toggle("change");

              if (document.getElementById("links-mobile").style.transform == "translateY(0%)") {
                  document.getElementById("links-mobile").style.transform = "translateY(-120%)";
              } else {
                  document.getElementById("links-mobile").style.transform = "translateY(-0%)";
              }
          }
        </script>
      </div>   
    <div id="modal"></div>

    <a href="https://www.salioviaje.com.uy/FAQ" title="Frequently Asked Questions"  target="_BLANK" id="faq-float" >
      <i class="fas fa-question" ></i>
    </a>
    
    <a href="https://wa.link/mxnwzm" title="WhatsApp | Salió Viaje"  target="_BLANK" id="whatsapp-float">
      <img src="https://www.salioviaje.com.uy/media/images/whatsapp.webp" title="WhatsApp | Salió Viaje" alt="Logo WhatsApp | Salió Viaje" /> 
    </a>
  
    <?php
    if(!isset($_SESSION['usuario'])){
      echo '<div id="flotant-promo"></div>';
    }
    ?>    

    <section class="landing">
      <div class="landing-wrapper-grid">
        <div class="landing-left">
          <div class="landing-info">
            <h1>Salió<span>Viaje</span></h1>
            <p>Plataforma que optimiza el traslado ocasional de personas.</p>
            <a
              href="https://www.salioviaje.com.uy/Viajar"  title="Oportunidades, Ofertas y Promociones"
              class="button-landing"
            >
              <i class="fas fa-bus"></i> ¡Quiero viajar barato!
            </a>
            <button
              onclick="abrirFormularioCotizacion()" title="Consigue excelentes precios con un solo formulario"
              class="button-landing"
            >
              <i class="fas fa-hand-holding-usd"></i> Solicitar Cotización
            </button>

          </div>
        </div>
        <div class="landing-right">
          <div class="landing-img-wrapper">
            <a href="https://www.salioviaje.com.uy/Reservas_Promo_Buenos_Aires">  
              <img class="" src="media/images/Van2_3.webp" alt="Promo lanzamiento Buenos Aires" title="Promo lanzamiento Buenos Aires | Salió Viaje" />
            </a>
          </div>
        </div>
      </div>
    </section>

    <div class="separador_wrapper">
      <div class="separador_2">
        <span class="triangle"></span>
      </div>
    </div>

    <section class="servicios" id="Servicios">
      <h2><i class="fa-solid fa-book-atlas"></i> Nuestros <span>Servicios</span></h2>
      <hr id="hr" />
      <div class="servicios-wrapper">
        <div class="card">
          <div class="card-top">
            <div class="card-icon">
              <i class="fas fa-glass-cheers"></i>
            </div>
            <div class="card-info">
              <h3>Salió Fiesta</h3>
              <hr />
              <p class="info_1">
                Solucionamos tus traslados a fiestas, reuniones y eventos.
              </p>
            </div>
          </div>
          <div class="click-here" id="fiestas">
            <p><i class="fa-solid fa-arrow-pointer"></i> Click Aquí</p>
          </div>
          <div class="card-bottom">
            <p class="info_2">
              Te llegarán a tu email, varias opciones de precio, reputación y
              vehículos para que puedas elegir.
            </p>
            <p class="info_3">
              Envíanos un SMS o llamá al <br />
              <a class="tel" href="tel:+59899401414" title="Teléfono | Salió Viaje">099 401 414</a>.
            </p>

            <div class="button-whatsapp">
              <a class="whatsapp" target="_BLANK" href="https://wa.link/5uasp3" title="WhatsApp | Salió Viaje">
                <img
                  src="https://www.salioviaje.com.uy/media/images/whatsapp.webp" title="WhatsApp | Salió Viaje" alt="Logo WhatsApp | Salió Viaje"
                
                />
              </a>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-top">
            <div class="card-icon">
              <i class="fas fa-plane-departure"></i>
            </div>
            <div class="card-info">
              <h3>Salió Aeropuerto</h3>
              <hr />
              <p class="info_1">
                Tenemos un programa especial de tranfers a aeropuertos y
                puertos. Un servicio profesional y serio.
              </p>
            </div>
          </div>
          <div class="click-here" id="aeropuerto">
            <p><i class="fa-solid fa-arrow-pointer"></i> Click Aquí</p>
          </div>
          <div class="card-bottom">
            <p class="info_2">
              Te llegarán a tu email, varias opciones de precio, reputación y
              vehículos para que puedas elegir.
            </p>
            <p class="info_3">
              Envíanos un SMS o llamá al <br />
              <a class="tel" href="tel:+59899401414" title="Teléfono | Salió Viaje">099 401 414</a>.
            </p>

            <div class="button-whatsapp">
              <a class="whatsapp" target="_BLANK" href="https://wa.link/gj2v7z" title="WhatsApp | Salió Viaje">
                <img
                  src="https://www.salioviaje.com.uy/media/images/whatsapp.webp" title="WhatsApp | Salió Viaje" alt="Logo WhatsApp | Salió Viaje"
                
                />
              </a>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-top">
            <div class="card-icon">
              <i class="fas fa-tree"></i>
            </div>
            <div class="card-info">
              <h3>Salió Paseo</h3>
              <hr />
              <p class="info_1">
                Salió Viaje te ofrece tours y servicios por hora.
              </p>
            </div>
          </div>
          <div class="click-here" id="paseo">
            <p><i class="fa-solid fa-arrow-pointer"></i> Click Aquí</p>
          </div>
          <div class="card-bottom">
            <p class="info_2">
              Te llegarán a tu email, varias opciones de precio, reputación y
              vehículos para que puedas elegir.
            </p>
            <p class="info_3">
              Envíanos un SMS o llamá al <br />
              <a class="tel" href="tel:+59899401414" title="Teléfono | Salió Viaje">099 401 414</a>.
            </p>

            <div class="button-whatsapp">
              <a class="whatsapp" target="_BLANK" href="https://wa.link/37ske4" title="WhatsApp | Salió Viaje">
                <img
                  src="https://www.salioviaje.com.uy/media/images/whatsapp.webp" title="WhatsApp | Salió Viaje" alt="Logo WhatsApp | Salió Viaje"
                
                />
              </a>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-top">
            <div class="card-icon">
              <i class="fas fa-compass"></i>
            </div>
            <div class="card-info">
              <h3>Salió Viaje</h3>
              <hr />
              <p class="info_1">Te llevamos donde necesites al mejor precio.</p>
            </div>
          </div>
          <div class="click-here" id="picada">
            <p><i class="fa-solid fa-arrow-pointer"></i> Click Aquí</p>
          </div>
          <div class="card-bottom">
            <p class="info_2">
              Te llegarán a tu email, varias opciones de precio, reputación y
              vehículos para que puedas elegir.
            </p>
            <p class="info_3">
              Envíanos un SMS o llamá al <br />
              <a class="tel" href="tel:+59899401414" title="Teléfono | Salió Viaje">099 401 414</a>.
            </p>

            <div class="button-whatsapp">
              <a class="whatsapp" target="_BLANK" href="https://wa.link/oxc8le" title="WhatsApp | Salió Viaje">
                <img
                  src="https://www.salioviaje.com.uy/media/images/whatsapp.webp" title="WhatsApp | Salió Viaje" alt="Logo WhatsApp | Salió Viaje"
                
                />
              </a>
            </div>
          </div>
        </div>
      </div>
         <!-- ==================================================================== -->
    </section>

    <div class="separador_1">
      <span class="triangle"></span>
    </div>

    <section class="oportunidades" id="Oportunidades">
      <h2><i class="fa-solid fa-tags icon"></i> Oportunidades (<span id="contador-oportunidades"></span>)</h2>
      <hr />
      <p class="description">
        Conseguí las mejores oportunidades con nosotros.
      </p>

      <div class="oportunidades-wrapper">
        <div class="filter-wrapper">
          <div class="search"></div>

          <div class="button-filtrar">
            <button onclick="filtros(1)">
              <i class="fas fa-sort-amount-down"></i> Filtrar
            </button>
          </div>
        </div>

        <div id="filters">
          <div class="input" id="destino">
            <i class="fas fa-location-dot icon"></i>
            <input
              list="Localidad"
              id="origen_oportunidad"
              placeholder="Origen"
              onkeyup="filtrar_divs('Oportunidad')"
            />
            <datalist id="Localidad">
              <option value="ARTIGAS"></option>
              <option value="CANELONES"></option>
              <option value="CERRO LARGO"></option>
              <option value="SAN JOSE"></option>
              <option value="FLORIDA"></option>
              <option value="SORIANO"></option>
              <option value="RIO NEGRO"></option>
              <option value="TACUAREMBÓ"></option>
              <option value="RIVERA"></option>
              <option value="MONTEVIDEO"></option>
              <option value="ROCHA"></option>
              <option value="SALTO"></option>
              <option value="RIVERA"></option>
              <option value="PAYSANDU"></option>
              <option value="TREINTA Y TRES"></option>
              <option value="FLORES"></option>
              <option value="COLONIA"></option>
              <option value="MALDONADO"></option>
              <option value="LAVALLEJA"></option>
            </datalist>
          </div>

          <div class="input" id="destino">
            <i class="fas fa-route icon"></i>
            <input
              list="Localidad"
              id="destino_oportunidad"
              placeholder="Destino"
              onkeyup="filtrar_divs('Oportunidad')"
            />
          </div>

          <div class="input" id="origen">
            <i class="far fa-calendar-alt icon"></i>
            <input
              type="date"
              id="fecha_oportunidad"
              onchange="filtrar_divs('Oportunidad')"
            />
          </div>

          <button onclick="eliminar_filtros('Oportunidad')">
            <i class="fas fa-arrows-rotate"></i>
          </button>
        </div>

        <div class="list-empty">
          <p>Lo sentimos, de momento no hay oportunidades disponibles.</p>
        </div>

        <div class="container-list" id="oportunidades-tabla"></div>
      </div>
    </section>

    <div class="separador_wrapper">
      <div class="separador_2">
        <span class="triangle"></span>
      </div>
    </div>
   <!-- ==================================================================== -->
    <section class="viajar-wrapper-index">
      <div class="salioviaje" id="Cotizacion">
          <h2>
          <i class="fa-solid fa-hand-holding-dollar icon"></i> Solicitar una Cotización
          </h2>
          <hr />
          <p class="description">
            Es gratis y sin compromiso. ¡No te lo pierdas!
          </p>
    <!-- ==================================================================== -->     
          <input type="hidden" class="session-output" value='<?php if(isset($_SESSION['usuario'])){ echo 0; }else{ echo 1; }; ?>' >  
          <input type="hidden" class="session-input" value="<?php echo $_GET['opcion']; ?>">  
          
    <!-- ==================================================================== -->      
          <button id="agendar" class="button-agendar" onclick="desplegar(this, <?php if (!isset($_SESSION['usuario'])) {echo 1;} else {echo 2;}?>)">
            <i class="fas fa-clipboard-list"></i> Formulario
          </button>
          <div class="salioviaje-desplegable">
            <div class="formulario-viaje"> 
      
              <div class="user-info">
                <div class="user-icon">
                  <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje" title="Logo-SalioViaje | Salió Viaje">
                </div>
                <div class="info">
                  <?php 
                    if(isset($_SESSION['usuario'])){
                      echo  '<h3>'.$_SESSION['usuario'].'</h3>
                             <p><i class="fas fa-user"></i>'.$_SESSION['tipo_usuario'].'</p>';
                    }
                  ?>
                </div>
              </div>
      
              <div class="progress-bar">
                <span class="line"></span>
                <span class="progress"></span>
      
                <span class="circle1"></span>
                <span class="circle2"></span>
                <span class="circle3"></span>
              </div>
      
              <div class="step_1">
      
                <div class="input">
                  <i class="fas fa-suitcase-rolling icon"></i>
                  <select  id="select_users" onchange="select_usuario(1)">
                    <option value="0" selected disabled hidden >Tipo de Viaje</option>
                    <option value="1">Traslado</option>
                    <option value="2">Tour o Servicio por Horas.</option>
                    <option value="3">Transfer (Aeropuerto / Puerto)</option>
                    <option value="4">Fiestas o Eventos</option>
                  </select>
                </div>
      
                <p class="info"><i class="fas fa-info-circle"></i> Seleccione un tipo de viaje a realizar.</p>
      
              </div>
      
              <div class="step_2_traslado">

              <h3 class="title"><i class="fas fa-bus"></i> Traslado</h3>

              <div class="formulario-grid">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Salida <span class="obligatorio">*</span></p> 
                    <input type="date" id="fecha_salida"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_traslado_origen" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_traslado_origen" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
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

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_traslado_origen" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                      <option value="ARTIGAS">
                      <option value="CANELONES">
                      <option value="CERRO LARGO">
                      <option value="SAN JOSE">
                      <option value="FLORIDA">
                      <option value="SORIANO">
                      <option value="RIO NEGRO">
                      <option value="TACUAREMBÓ">
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

                  </div>
                  

                  

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_traslado"></textarea>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-route"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_traslado_destino"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_traslado_destino">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad</p>
                      <input list="Localidad" id="localidad_traslado_destino">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp; Mascotas <span class="obligatorio">*</span></p>
                  <select name="mascota" id="mascotas_traslado">
                  <option value="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                </div>

              </div>

              <p class="mensaje-error">Debe completar todos los campos.</p>

            </div>
      
              <div class="step_2_tour">

              <h3 class="title"><i class="fas fa-city"></i> Tour o Servicio por Horas.</h3>

              <div class="formulario-grid">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Salida<span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_salida_tour"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_salida_tour" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_barrios" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_tour" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>


                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_tour"/>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_tour"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-city"></i> Ciudad <span class="obligatorio">*</span></p>

                    <input list="Destino" id="destino_tour">
                    <datalist id="Destino">
                      <option value="Canelones">
                      <option value="Montevideo">
                      <option value="Tacuarembó">
                      <option value="Maldonado">
                      <option value="Rivera">
                    </datalist>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-clock"></i> Duración (Horas) <span class="obligatorio">*</span></p>
                    <input type="number" id="duracion_tour"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp; Mascotas <span class="obligatorio">*</span></p>
                  <select name="mascota" id="mascota_tour">
                   <option value="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_tour"></textarea>
                  </div>

                </div>

              </div>

              <p class="mensaje-error">Debe completar todos los campos.</p>

            </div>
      
              <div class="step_2_transfer">

              <h3 class="title"><i class="fas fa-plane-departure"></i> Transfer (Aeropuerto / Puerto)</h3>

              <div class="input">
                <i class="fas fa-plane icon"></i>
                <select id="select_transfer" onchange="select_transfer()">
                  <option value="0" selected disabled hidden >Seleccione una Tipo de Transfer</option>
                  <option value="1">Transfer de Arribos</option>
                  <option value="2">Transfer de Partidas</option>
                </select>
              </div>

              <p class="info"><i class="fas fa-info-circle"></i> Seleccione un tipo de transfer a realizar.</p>


              <div class="formulario-grid" id="transfer_in">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Arribo <span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_regreso_transfer_in"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-plane-arrival"></i> Origen (Puerto o Aeropuerto) <span class="obligatorio">*</span></p>
                    <input list="Aeropuertos" id="aeropuerto_transfer_in">
                      <datalist id="Aeropuertos">
                        <option value="Aeropuerto Internacional de Carrasco Gral. Cesáreo L. Berisso">
                        <option value="Aeropuerto Internacional C/C Carlos A. Curbelo de Laguna del Sauce">
                        <option value="Puerto de Montevideo">
                        <option value="Puerto de Colonia">
                      </datalist>
                  </div>


                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_transfer_in"/>
                  </div>

                  <div class="input">
                    <p><i class="fa fa-ticket"></i> N° de Vuelo / Barco <span class="obligatorio">*</span></p>
                    <input type="text" id="nro_vuelo_barco_in"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp; Mascotas <span class="obligatorio">*</span></p>
                  <select name="mascota" id="mascotas_transfer_in">
                  <option value="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-suitcase-rolling"></i> Equipaje (Cant. Maletas) <span class="obligatorio">*</span></p>
                    <input type="number" id="equipaje_transfer_in"/>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_transfer_in"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-route"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_transfer_in" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_transfer_in" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_transfer_in" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_transfer_in"></textarea>
                  </div>

                </div>

              </div>

              <div class="formulario-grid" id="transfer_out">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Partida <span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_salida_transfer_out"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_transfer_out" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_transfer_out" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_transfer_out" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_transfer_out"/>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora que pasan a buscar <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_transfer_out"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-plane-departure"></i> Destino (Puerto o Aeropuerto) <span class="obligatorio">*</span></p>
                    <input list="Aeropuertos" id="aeropuerto_transfer_out">
                  </div>

                  <div class="input">
                    <p><i class="fas fa-suitcase-rolling"></i> Equipaje (Cant. Maletas) <span class="obligatorio">*</span></p>
                    <input type="number" id="equipaje_transfer_out"/>
                  </div>

                  <div class="input">
                    <p><i class="fa fa-ticket"></i> N° de Vuelo / Barco <span class="obligatorio">*</span></p>
                    <input type="text" id="nro_vuelo_barco_out"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp; Mascotas <span class="obligatorio">*</span></p>
                    <select name="mascota" id="mascotas_transfer_out">
                    <option value="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_transfer_out"></textarea>
                  </div>

                </div>

              </div>

              <p class="mensaje-error">Debe completar todos los campos.</p>

            </div>
      
              <div class="step_2_fiestas">

              <h3 class="title"><i class="fas fa-glass-cheers"></i> Fiestas o Eventos</h3>

              <div class="input">
                <i class="fas fa-exchange-alt icon"></i>
                <select  id="select_fiesta" onchange="select_fiesta()">
                  <option value="0" selected disabled hidden >Seleccione un Tramo</option>
                  <option value="1">Solo Ida</option>
                  <option value="2">Solo Vuelta</option>
                  <option value="3">Ida y Vuelta</option>
                </select>
              </div>

              <p class="info"><i class="fas fa-info-circle"></i> Seleccione un tipo de tramo a realizar.</p>

              <div class="formulario-grid" id="fiesta_ida">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Salida <span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_salida_fiestas_ida"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_fiestas_ida" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_fiestas_ida" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_fiestas_ida" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_fiesta_ida"/>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_fiesta_ida"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-route"></i> Destino o Punto de Interés <span class="obligatorio">*</span></p>
                    <input type="text" id="destino_fiesta_ida">
                  </div>

                  <div class="input">
                    <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                    <input list="Barrio" id="fiestasida_origen_barrios">
                    <datalist id="Barrio">
                      <option value="Barrio 1">
                      <option value="Barrio 2">
                      <option value="Barrio 3">
                      <option value="Barrio 4">
                      <option value="Barrio 5">
                    </datalist>
                  </div>

                  <div class="input">
                    <p><i class="fa-solid fa-globe"></i> Localidad</p>
                    <input list="Localidad" id="fiestasida_origen_localidad">
                    <datalist id="Localidad">
                      <option value="Localidad 1">
                      <option value="Localidad 2">
                      <option value="Localidad 3">
                      <option value="Localidad 4">
                      <option value="Localidad 5">
                    </datalist>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_fiesta_ida"></textarea>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp; Mascotas <span class="obligatorio">*</span></p>
                    <select name="mascota" id="mascotas_fiestas_ida">
                    <option value="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                </div>

              </div>

              <div class="formulario-grid" id="fiesta_vuelta">
                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Regreso <span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_regreso_fiestas_vuelta"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-map-marker-alt"></i> Origen o Punto de Interés <span class="obligatorio">*</span></p>
                    <input type="text" id="origen_fiestas_vuelta">
                  </div>

                  <div class="input">
                    <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                    <input list="Barrio" id="fiestasvuelta_origen_barrios">
                    <datalist id="Barrio">
                      <option value="Barrio 1">
                      <option value="Barrio 2">
                      <option value="Barrio 3">
                      <option value="Barrio 4">
                      <option value="Barrio 5">
                    </datalist>
                  </div>

                  <div class="input">
                    <p><i class="fa-solid fa-globe"></i> Localidad</p>
                    <input list="Localidad" id="fiestasvuelta_origen_localidad">
                    <datalist id="Localidad">
                      <option value="Localidad 1">
                      <option value="Localidad 2">
                      <option value="Localidad 3">
                      <option value="Localidad 4">
                      <option value="Localidad 5">
                    </datalist>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_fiesta_vuelta"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp; Mascotas <span class="obligatorio">*</span></p>
                    <select name="mascota" id="mascotas_fiestas_vuelta">
                    <option value="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea class="Observaciones" id="observaciones_fiesta_vuelta"></textarea>
                  </div>

                </div>

                <div class="column">

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_fiesta_vuelta"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_fiesta_vuelta" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_fiesta_vuelta" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_fiesta_vuelta" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>
                  </div>

                </div>

              </div>

              <div class="formulario-grid" id="fiesta_idavuelta">
                <div class="column">

                  <h3><i class="fas fa-arrow-circle-up"></i> Ida</h3>

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Salida <span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_salida_fiestas_idavuelta"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_ida_origen_fiestas_idavuelta" onchange="rellenar('Direccion_Origen')" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_ida_origen_fiestas_idavuelta" onchange="rellenar('Barrio_Origen')" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_ida_origen_fiestas_idavuelta" onchange="rellenar('Localidad_Origen')" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-route"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_ida_destino_fiestas_idavuelta" onchange="rellenar('Direccion_Destino')"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_ida_destino_fiestas_idavuelta" onchange="rellenar('Barrio_Destino')">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad</p>
                      <input list="Localidad" id="localidad_ida_destino_fiestas_idavuelta" onchange="rellenar('Localidad_Destino')">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>
                    
                  </div>

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_ida_fiestas_idavuelta" onchange="rellenar('Cantidad_Pasajeros')"/>
                  </div>

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_ida_fiestas_idavuelta" onchange="verificar_largo_fiesta()"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-comment-dots"></i> Observaciones</p>
                    <textarea  id="observaciones_fiesta_idavuelta"></textarea>
                  </div>

                </div>

                <div class="column">

                  <h3><i class="fas fa-arrow-circle-down"></i> Vuelta</h3>

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Fecha de Regreso <span class="obligatorio">*</span></p>
                    <input type="date" id="fecha_regreso_fiestas_idavuelta"/>
                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-map"></i> Origen</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_vuelta_origen_fiestas_idavuelta"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio</p>
                      <input list="Barrio" id="barrio_vuelta_origen_fiestas_idavuelta">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad</p>
                      <input list="Localidad" id="localidad_vuelta_origen_fiestas_idavuelta">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>

                  </div>

                  <div class="sub-section">

                    <h3><i class="fas fa-route"></i> Destino</h3>
                    <hr>

                    <div class="input">
                      <p><i class="fa fa-location-dot"></i> Dirección o Punto de Interes <span class="obligatorio">*</span></p>
                      <input type="text" id="direccion_vuelta_destino_fiestas_idavuelta" value="<?php echo $_SESSION['datos_usuario']['DIRECCION']; ?>"/>
                    </div>

                    <div class="input">
                      <p><i class="fa fa-map-location-dot"></i> Barrio <span class="obligatorio">*</span></p>
                      <input list="Barrio" id="barrio_vuelta_destino_fiestas_idavuelta" value="<?php echo $_SESSION['datos_usuario']['BARRIO']; ?>">
                      <datalist id="Barrio">
                        <option value="Barrio 1">
                        <option value="Barrio 2">
                        <option value="Barrio 3">
                        <option value="Barrio 4">
                        <option value="Barrio 5">
                      </datalist>
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_vuelta_destino_fiestas_idavuelta" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">
                      <datalist id="Localidad">
                        <option value="Localidad 1">
                        <option value="Localidad 2">
                        <option value="Localidad 3">
                        <option value="Localidad 4">
                        <option value="Localidad 5">
                      </datalist>
                    </div>
                    
                  </div>

                  <div class="input">
                    <p><i class="fas fa-user-friends"></i> Cantidad de Pasajeros <span class="obligatorio">*</span></p>
                    <input type="number" id="cant_pasajeros_vuelta_fiestas_idavuelta"/>
                  </div>

                  <div class="input">
                    <p><i class="far fa-calendar-alt"></i> Hora <span class="obligatorio">*</span></p>
                    <input type="time" id="hora_vuelta_fiestas_idavuelta" onchange="verificar_largo_fiesta()"/>
                  </div>

                  <div class="input">
                    <p><i class="fas fa-solid fa-dog"></i>&nbsp; Mascotas <span class="obligatorio">*</span></p>
                    <select name="mascota" id="mascotas_fiestas_idavuelta">
                    <option value="1">Con mascota</option>
                   <option value="2" selected>Sin mascota</option>
                  </select>
                  </div>

                </div>

              </div>

              <p class="mensaje-error">Debe completar todos los camposs.</p>

            </div>
      
              <div class="step_3" id="Paradas">
      
                <div class="loader_step3">
                  <i class="fas fa-spinner" id="spinner"></i>
                </div>
      
                <div class="paradas-wrapper" id="paradas_ida">
                  <div class="input">
                    <p><i class="fas fa-stopwatch"></i> Paradas - <i class="fas fa-arrow-circle-up"></i> (Ida)</p>
                    <input id="paradas_1" onchange="paradas(1)">
                  </div>
                  <div class="tags" id="tags_paradas_1">
                  </div>
                </div>
      
                <div class="paradas-wrapper" id="paradas_vuelta">
                  <div class="input">
                    <p><i class="fas fa-stopwatch"></i> Paradas - <i class="fas fa-arrow-circle-down"></i> (Vuelta)</p>
                    <input id="paradas_2" onchange="paradas(2)">
                  </div>
                  <div class="tags" id="tags_paradas_2">
                  </div>
                </div>
      
                <button class="button-viajar" onclick="volver()"><i class="fas fa-arrow-circle-left"></i> Volver</button>
                <button class="button-viajar" onclick="finalizar(1)">Enviar Solicitud <i class="fas fa-paper-plane"></i></button>
      
              </div>
      
              <div class="step_4">
      
                <div class="send-wrapper">
      
                  <div class="sending-icon">
                    <i class="fas fa-spinner"></i>
                  </div>
                </div>
      
              </div>
      
              <div class="step_5">
      
                <div class="send-wrapper">
      
                  <div class="send-icon">
                    <i class="fas fa-check-circle"></i>
                  </div>
      
                  <div class="send-info">
                    <h2>¡Solicitud Enviada!</h2>
                    <p>En breve te llegaran cotizaciones a tu correo electrónico.</p>
                    <button class="button-viajar" onclick="nueva_cotizacion()"><i class="fas fa-plus-circle"></i> Nueva Cotización</button>
                  </div>
      
                </div>

                </div>
         
               </div>

            </div>
        </div>
    </section>
    <script>
      window.addEventListener('load',() => {
        if(document.querySelector(`.session-output`).value == 0) desplegar(document.getElementById("agendar"), document.querySelector(`.session-output`).value);
      });
    </script>
    <div id="footer"></div>
  </body>
</html>
