<?php 
require_once '../PHP/procedimientosBD.php';
$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
  session_start(); 

  $tipo = 0;

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');

  }else{
    switch($_SESSION['tipo_usuario']){
      case "Administrador":
        $tipo = 1;
        break;
  
      case "Transportista": 
        $tipo = 2;
        break;

      case "Chofer":
        $tipo = 3;
        break;

      case "Agente":  
        $tipo = 4;
        break;

      case "Anfitrión":
        $tipo = 5;
        break;

      case "Pasajero":  
        $tipo = 6;
        break;

      case "Asesor":
        $tipo = 7;
        break;

      case "Hotel":
        $tipo = 8;
        break;
      
      default:
        $tipo = 0;
        break;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SalióViaje | Dashboard</title>
    
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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Dashboard" />
    <meta property="og:title" content="SalióViaje | Dashboard" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Dashboard" />
    <meta
      property="twitter:title"
      content="SalióViaje | Dashboard"
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
        <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
        <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
        <script src="https://www.salioviaje.com.uy/Javascript/cotizaciones.js"></script>
        <script src="https://www.salioviaje.com.uy/Javascript/gurucuteco.js"></script>
        <script src="https://www.salioviaje.com.uy/t2voice/functionsJS.js"></script>
        <script src="https://www.salioviaje.com.uy/t2voice/send_data.js"></script>
        </script>
        <script type="text/javascript">
            window.onload = function(){
              tabla_usuarios_dashboard()
              tabla_empresas_dashboard() 
              tabla_oportunidades_dashboard()
              mostrar_cotizaciones_presentadas_dashboard_tta();
              mostrar_cotizaciones_recibidas_dashboard();
            }
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

        <div id="modal"></div>
        <div id="gurucuteco"></div>
        
        <header class="panel-header" id="header">
          <div class="header-left">
            <div class="header-menu">
              <button onclick="navbar()"><i class="fas fa-bars"></i></button>
            </div>
            <div class="header-title">
              <h2>Dashboard</h2>
            </div>
          </div>
          <div class="header-right">
            <div class="select">
              <i id="icon" class="fas fa-redo-alt"></i>
              <select id="select_actualizar">
                <option value="0" selected>Disabled</option>
                <option value="1">1s</option>
                <option value="2">5s</option>
                <option value="3">10s</option>
                <option value="4">15s</option>
              </select>
            </div>
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


        <?php 

        $bd = new procedimientosBD();

        if($tipo == 1){
          echo '  <section class="panel" id="panel">
                    <div class="panel-cards">
                      <div class="card">
                        <div class="number" id="cantidad-usuarios">

                        </div>
                        <p>Usuarios</p>
                      </div>
                      <div class="card">
                        <div class="number">
                          <h2>'.$bd->numero_vehiculos().'</h2>
                          <i class="fa-solid fa-van-shuttle"></i>
                        </div>
                        <p>Vehiculos</p>
                      </div>
                      <div class="card">
                        <div class="number">
                          <div class="double-line">
                            <h4><span>'.$bd->numero_reconfirmaciones_mes().'</span> del mes.</h4>
                            <h4><span>'.$bd->numero_reconfirmaciones_totales().'</span> Acumuladas.</h4>
                          </div>
                          <i class="fa-solid fa-check-double"></i>
                        </div>
                        <p>Reconfirmaciones</p>
                      </div>
                      <div class="card">
                        <div class="number">
                          <div class="double-line">
                            <h4><span>'.$bd->numero_solicitudes_de_cotizaciones_mes().'</span> del mes.</h4>
                            <h4><span>'.$bd->numero_solicitudes_de_cotizaciones_totales().'</span> Acumuladas.</h4>
                          </div>
                          <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <p>Solic. Cotizaciones</p>
                      </div>
                    </div>
                    <div class="panel-tables">

                    <div>
                      <div class="usuarios-recientes">
                        <div class="usuarios-info">
                          <h2><i class="fas fa-user-friends"></i> Usuarios Registrados</h2>
                          <div class="button-wrapper">
                            <a href="Usuarios"><i class="fas fa-list-ul"></i></a>
                          </div>
                        </div>
                        <div class="search">
                          <i class="fas fa-search"></i>
                          <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarUsuarios(1)"/>
                        </div>
                        <div class="table-container">
                          <table class="usuarios-table" id="search-table">
                            <!-- antes:
                              <tr>
                                <th>
                                  Nombre <i class="fas fa-angle-down"></i>
                                </th>
                                <th>Apellido <i class="fas fa-angle-down"></i></th>
                                <th>Tipo <i class="fas fa-angle-down"></i></th>
                                <th>Departamento <i class="fas fa-angle-down"></i></th>
                                <th>Teléfono <i class="fas fa-angle-down"></i></th>
                                <th></th>
                              </tr>
                            -->
                            <thead>
                              <tr>
                                <th>Tipo <i class="fas fa-angle-down"></i></th>
                                <th>
                                  Nombre <i class="fas fa-angle-down"></i>
                                </th>
                                <th>Apellido <i class="fas fa-angle-down"></i></th>
                                <th>Departamento <i class="fas fa-angle-down"></i></th>
                                <th>Teléfono <i class="fas fa-angle-down"></i></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="tbody-usuarios" class="act">
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>

                      
                      <div class="usuarios-propietarios">
                        <div class="usuarios-info">
                          <h2><i class="fas fa-building"></i> Empresas Registradas</h2>
                          <div class="button-wrapper">
                            <a href="Empresas"><i class="fas fa-list-ul"></i></a>
                          </div>
                        </div>
                        <div class="propietarios">

                        </div>
                        
                      </div>
                    </div>
                  </section>';
        }elseif($tipo == 2){ // Transportista
          echo '  <section class="panel" id="panel">
                    <div class="panel-cards">
                        <a class="card button" href="Agendar">
                          <div class="number">
                              <h2>+</h2>
                              <i class="fa-solid fa-road"></i>
                          </div>
                          <p>Agendar Viaje</p>
                        </a>
                        <a class="card button" href="https://www.salioviaje.com.uy/Viajar?scroll=Oportunidades">
                          <div class="number">
                              <h2>'.$bd->numero_oportunidades().'</h2>
                              <i class="fa-solid fa-tags"></i>
                          </div>
                          <p>Oportunidades Disponibles</p>
                        </a>
                        <a class="card button" href="https://www.salioviaje.com.uy/Viajar?scroll=Ofertas">
                          <div class="number">
                              <h2>-</h2>
                              <i class="fa-solid fa-percent"></i>
                          </div>
                          <p>Ofertas Disponibles</p>
                        </a>
                        <a class="card button" href="https://www.salioviaje.com.uy/Central">
                          <div class="number">
                              <h2>'.$bd->numero_solicitudes_de_cotizaciones_totales().'</h2>
                              <i class="fa-solid fa-hand-holding-dollar"></i>
                          </div>
                          <p>Viajes para Cotizar</p>
                        </a>
                      </div>
                      <div class="panel-tables">
                        <div>
                          <div class="usuarios-recientes">
                            <div class="usuarios-info">
                              <h2><i class="fas fa-bus"></i> Mis Viajes</h2>
                              <div class="button-wrapper">
                                <a href="Agendar" class="add"><i class="fas fa-plus"></i></a>
                                <a href="Viajes"><i class="fas fa-list-ul"></i></a>
                              </div>
                            </div>
                            <div class="search">
                              <i class="fas fa-search"></i>
                              <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarUsuarios(5)"/>
                            </div>
                            <div class="table-container">
                              <table class="usuarios-table" id="search-table-agenda">
                                <thead>
                                  <tr>
                                    <th>ID <i class="fas fa-angle-down"></i></th>
                                    <th>
                                      Origen <i class="fas fa-angle-down"></i>
                                    </th>
                                    <th>Destino <i class="fas fa-angle-down"></i></th>
                                    <th>Fecha <i class="fas fa-angle-down"></i></th>
                                    <th>Estado <i class="fas fa-angle-down"></i></th>
                                    <th>Modalidad <i class="fas fa-angle-down"></i></th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody id="tbody-viajes-dashboard">
                                </tbody>
                              </table>
                            </div>
                            <div class="empty-table" id="empty-viajes">
                              <p><i class="fas fa-info-circle"></i> No hay viajes pendientes.</p>
                            </div>
                          </div>

                          <div class="usuarios-recientes">
                            <div class="usuarios-info">
                              <h2><i class="fas fa-hand-holding-dollar"></i> Cotizaciones Presentadas</h2>
                              <div class="button-wrapper">
                                <a href="Cotizaciones"><i class="fas fa-list-ul"></i></a>
                              </div>
                            </div>
                            <div class="search">
                              <i class="fas fa-search"></i>
                              <input type="text" placeholder="Buscar" id="searchbar-2" onkeyup="buscarUsuarios(9,-2)"/>
                            </div>
                            <div class="table-container">
                              <table class="usuarios-table" id="cotz-pres" style="display: none;">
                                <thead>
                                  <tr>
                                    <th>ID <i class="fas fa-angle-down"></i></th>
                                    <th>
                                      Origen <i class="fas fa-angle-down"></i>
                                    </th>
                                    <th>Destino <i class="fas fa-angle-down"></i></th>
                                    <th>Fecha <i class="fas fa-angle-down"></i></th>
                                    <th>Viaje <i class="fas fa-angle-down"></i></th>
                                    <th>Estado <i class="fas fa-angle-down"></i></th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody id="tbody-cotizaciones-dashboard">

                                </tbody>
                              </table>
                            </div>
                            <div class="empty-table" id="empty-cotiz-pres">
                              <p><i class="fas fa-info-circle"></i> No hay cotizaciones presentadas.</p>
                            </div>
                          </div>

                          <div class="usuarios-recientes">
                            <div class="usuarios-info">
                              <h2><i class="fas fa-hand-holding-dollar"></i> Cotizaciones Recibidas</h2>
                            </div>
                            <div class="search">
                              <i class="fas fa-search"></i>
                              <input type="text" placeholder="Buscar" id="searchbar-3" onkeyup="buscarUsuarios(10,-3)"/>
                            </div>
                            <div class="table-container">
                              <table class="usuarios-table" id="cotz-reci" style="display: none;">
                                <thead>
                                  <tr>
                                    <th>ID Viaje<i class="fas fa-angle-down"></i></th>
                                    <th>ID Cotización<i class="fas fa-angle-down"></i></th>
                                    <th>Reputación <i class="fas fa-angle-down"></i></th>
                                    <th>Marca / Modelo <i class="fas fa-angle-down"></i></th>
                                    <th>Capacidad <i class="fas fa-angle-down"></i></th>
                                    <th>Seña <i class="fas fa-angle-down"></i></th>
                                    <th>Precio <i class="fas fa-angle-down"></i></th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody class="cotizaciones_recibidas" id="tbody-cotizaciones-dashboard">

                                </tbody>
                              </table>
                            </div>
                            <div class="full-table" id="full-cotiz-reci">
                              <p><i class="fas fa-info-circle"></i> Estas son todas las cotizaciones que tenemos para ti. En una hora pierden validez y se borrarán de aquí.</p>
                            </div>
                            <div class="empty-table" id="empty-cotiz-reci">
                              <p><i class="fas fa-info-circle"></i> No hay cotizaciones recibidas.</p>
                            </div>
                          </div>

                        </div>
                        

                        <div class="usuarios-propietarios">
                          <div class="usuarios-info">
                            <h2><i class="fas fa-building"></i> Mis Empresas</h2>
                            <div class="button-wrapper">
                              <a href="https://www.salioviaje.com.uy/Crear_Empresa" class="add"><i class="fas fa-plus"></i></a>
                              <a href="https://www.salioviaje.com.uy/Empresas"><i class="fas fa-list-ul"></i></a>
                            </div>
                          </div>
                          <div class="propietarios">
                
                          </div>
                        </div>
                      </div>
                    </section>';
        }elseif($tipo == 3){ // Chofer
          echo '  <section class="panel" id="panel">
          <div class="panel-cards">
              <a class="card button" href="Agendar">
                <div class="number">
                    <h2>+</h2>
                    <i class="fa-solid fa-road"></i>
                </div>
                <p>Agendar Viaje</p>
              </a>
              <a class="card button" href="https://www.salioviaje.com.uy/Viajar?scroll=Oportunidades">
                <div class="number">
                    <h2>'.$bd->numero_oportunidades().'</h2>
                    <i class="fa-solid fa-tags"></i>
                </div>
                <p>Oportunidades Disponibles</p>
              </a>
              <a class="card button" href="https://www.salioviaje.com.uy/Viajar?scroll=Ofertas">
                <div class="number">
                    <h2>-</h2>
                    <i class="fa-solid fa-percent"></i>
                </div>
                <p>Ofertas Disponibles</p>
              </a>
              <a class="card button" href="https://www.salioviaje.com.uy/Vouchers">
                <div class="number">
                    <h2>-</h2>
                    <i class="fa-solid fa-ticket"></i>
                </div>
                <p>Vouchers</p>
              </a>
            </div>
            <div class="panel-tables">

              <div>

                <div class="usuarios-recientes">
                  <div class="usuarios-info">
                    <h2><i class="fas fa-bus"></i> Mis Viajes</h2>
                    <div class="button-wrapper">
                      <a href="Agendar" class="add"><i class="fas fa-plus"></i></a>
                      <a href="Viajes"><i class="fas fa-list-ul"></i></a>
                    </div>
                  </div>
                  <div class="search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarUsuarios(5)"/>
                  </div>
                  <div class="table-container">
                    <table class="usuarios-table" id="search-table-agenda">
                      <thead>
                        <tr>
                          <th>ID <i class="fas fa-angle-down"></i></th>
                          <th>
                            Origen <i class="fas fa-angle-down"></i>
                          </th>
                          <th>Destino <i class="fas fa-angle-down"></i></th>
                          <th>Fecha <i class="fas fa-angle-down"></i></th>
                          <th>Estado <i class="fas fa-angle-down"></i></th>
                          <th>Modalidad <i class="fas fa-angle-down"></i></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="tbody-viajes-dashboard">
                      </tbody>
                    </table>
                  </div>
                  <div class="empty-table" id="empty-viajes">
                    <p><i class="fas fa-info-circle"></i> No hay viajes pendientes.</p>
                  </div>
                </div>
              </div>

              <div class="usuarios-propietarios">
                <div class="usuarios-info">
                  <h2><i class="fas fa-building"></i> Mis Empresas</h2>
                  <div class="button-wrapper">
                    <a href="https://www.salioviaje.com.uy/Crear_Empresa" class="add"><i class="fas fa-plus"></i></a>
                    <a href="https://www.salioviaje.com.uy/Empresas"><i class="fas fa-list-ul"></i></a>
                  </div>
                </div>
                <div class="propietarios">
      
                </div>
              </div>
            </div>
          </section>';
        }
        elseif($tipo == 4 || $tipo == 5){ // Agente & Anfitrión
          echo '  <section class="panel" id="panel">
                    <div class="panel-cards">
                      <a class="card button" href="https://www.salioviaje.com.uy/Viajar/?opcion=5#Cotizacion">
                        <div class="number">
                            <h2>+</h2>
                            <i class="fa-solid fa-road"></i>
                        </div>
                        <p>Solicitar Cotización</p>
                      </a>
                      <a class="card button" href="https://www.salioviaje.com.uy/Viajar?scroll=Oportunidades">
                        <div class="number">
                            <h2>'.$bd->numero_oportunidades().'</h2>
                            <i class="fa-solid fa-tags"></i>
                        </div>
                        <p>Oportunidades Disponibles</p>
                      </a>
                      <a class="card button" href="https://www.salioviaje.com.uy/Viajar?scroll=Ofertas">
                        <div class="number">
                            <h2>-</h2>
                            <i class="fa-solid fa-percent"></i>
                        </div>
                        <p>Ofertas Disponibles</p>
                      </a>
                      <a class="card button" href="https://www.salioviaje.com.uy/Central">
                        <div class="number">
                            <h2>'.$bd->numero_solicitudes_de_cotizaciones_totales().'</h2>
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <p>Viajes para Cotizar</p>
                      </a>
                    </div>
                      <div class="panel-tables">
                        <div>
                          <div class="usuarios-recientes">
                            <div class="usuarios-info">
                              <h2><i class="fas fa-bus"></i> Mis Viajes</h2>
                              <div class="button-wrapper">
                                <a href="Agendar" class="add"><i class="fas fa-plus"></i></a>
                                <a href="Viajes"><i class="fas fa-list-ul"></i></a>
                              </div>
                            </div>
                            <div class="search">
                              <i class="fas fa-search"></i>
                              <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarUsuarios(5)"/>
                            </div>
                            <div class="table-container">
                              <table class="usuarios-table" id="search-table-agenda">
                                <thead>
                                  <tr>
                                    <th>ID <i class="fas fa-angle-down"></i></th>
                                    <th>
                                      Origen <i class="fas fa-angle-down"></i>
                                    </th>
                                    <th>Destino <i class="fas fa-angle-down"></i></th>
                                    <th>Fecha <i class="fas fa-angle-down"></i></th>
                                    <th>Estado <i class="fas fa-angle-down"></i></th>
                                    <th>Modalidad <i class="fas fa-angle-down"></i></th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody id="tbody-viajes-dashboard">
                                </tbody>
                              </table>
                            </div>
                            <div class="empty-table" id="empty-viajes">
                              <p><i class="fas fa-info-circle"></i> No hay viajes pendientes.</p>
                            </div>
                          </div>
                          <div class="usuarios-recientes">
                            <div class="usuarios-info">
                              <h2><i class="fas fa-hand-holding-dollar"></i> Cotizaciones Recibidas</h2>
                            </div>
                            <div class="search">
                              <i class="fas fa-search"></i>
                              <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarUsuarios(10)"/>
                            </div>
                            <div class="table-container">
                              <table class="usuarios-table" id="cotz-reci" style="display: none;">
                                <thead>
                                  <tr>
                                    <th>ID Viaje<i class="fas fa-angle-down"></i></th>
                                    <th>ID Cotización<i class="fas fa-angle-down"></i></th>
                                    <th>Reputación <i class="fas fa-angle-down"></i></th>
                                    <th>Marca / Modelo <i class="fas fa-angle-down"></i></th>
                                    <th>Capacidad <i class="fas fa-angle-down"></i></th>
                                    <th>Seña <i class="fas fa-angle-down"></i></th>
                                    <th>Precio <i class="fas fa-angle-down"></i></th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody class="cotizaciones_recibidas" id="tbody-viajes-dashboard">
                                </tbody>
                              </table>
                            </div>
                            <div class="full-table" id="full-cotiz-reci">
                              <p><i class="fas fa-info-circle"></i> Estas son todas las cotizaciones que tenemos para ti. En una hora pierden validez y se borrarán de aquí.</p>
                            </div>
                            <div class="empty-table" id="empty-cotiz-reci">
                              <p><i class="fas fa-info-circle"></i> No hay cotizaciones recibidas.</p>
                            </div>
                          </div>

                        </div>
                        <div class="usuarios-propietarios">
                          <div class="usuarios-info">
                            <h2><i class="fas fa-building"></i> Mis Empresas</h2>
                            <div class="button-wrapper">
                              <a href="https://www.salioviaje.com.uy/Crear_Empresa" class="add"><i class="fas fa-plus"></i></a>
                              <a href="https://www.salioviaje.com.uy/Empresas"><i class="fas fa-list-ul"></i></a>
                            </div>
                          </div>
                          <div class="propietarios">
                
                          </div>
                        </div>
                      </div>
                    </section>';
        }elseif($tipo == 8){ // Hotel
          echo '  <section class="panel" id="panel">
                    <div class="panel-cards">
                      <a class="card button" href="https://www.salioviaje.com.uy/Viajar/?opcion=5#Cotizacion">
                        <div class="number">
                            <h2>+</h2>
                            <i class="fa-solid fa-road"></i>
                        </div>
                        <p>Solicitar Cotización</p>
                      </a>
                      <a class="card button" href="https://www.salioviaje.com.uy/Viajar?scroll=Oportunidades">
                        <div class="number">
                            <h2>'.$bd->numero_oportunidades().'</h2>
                            <i class="fa-solid fa-tags"></i>
                        </div>
                        <p>Oportunidades Disponibles</p>
                      </a>
                      <a class="card button" href="https://www.salioviaje.com.uy/Viajar?scroll=Ofertas">
                        <div class="number">
                            <h2>-</h2>
                            <i class="fa-solid fa-percent"></i>
                        </div>
                        <p>Ofertas Disponibles</p>
                      </a>
                      <a class="card button" href="https://www.salioviaje.com.uy/Central">
                        <div class="number">
                            <h2>'.$bd->numero_solicitudes_de_cotizaciones_totales().'</h2>
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <p>Viajes para Cotizar</p>
                      </a>
                    </div>
                      <div class="panel-tables">
                        <div>

                          <div class="usuarios-recientes">
                            <div class="usuarios-info">
                              <h2><i class="fas fa-hand-holding-dollar"></i> Cotizaciones Recibidas</h2>
                            </div>
                            <div class="search">
                              <i class="fas fa-search"></i>
                              <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarUsuarios(10)"/>
                            </div>
                            <div class="table-container">
                              <table class="usuarios-table" id="cotz-reci" style="display: none;">
                                <thead>
                                  <tr>
                                    <th>ID Viaje<i class="fas fa-angle-down"></i></th>
                                    <th>ID Cotización<i class="fas fa-angle-down"></i></th>
                                    <th>Reputación <i class="fas fa-angle-down"></i></th>
                                    <th>Marca / Modelo <i class="fas fa-angle-down"></i></th>
                                    <th>Capacidad <i class="fas fa-angle-down"></i></th>
                                    <th>Seña <i class="fas fa-angle-down"></i></th>
                                    <th>Precio <i class="fas fa-angle-down"></i></th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody class="cotizaciones_recibidas" id="tbody-viajes-dashboard">
                                </tbody>
                              </table>
                            </div>
                            <div class="full-table" id="full-cotiz-reci">
                              <p><i class="fas fa-info-circle"></i> Estas son todas las cotizaciones que tenemos para ti. En una hora pierden validez y se borrarán de aquí.</p>
                            </div>
                            <div class="empty-table" id="empty-cotiz-reci">
                              <p><i class="fas fa-info-circle"></i> No hay cotizaciones recibidas.</p>
                            </div>
                          </div>

                        </div>

                        <div class="usuarios-propietarios">
                          <div class="usuarios-info">
                            <h2><i class="fas fa-building"></i> Mis Hoteles</h2>
                            <div class="button-wrapper">
                              <a href="https://www.salioviaje.com.uy/Empresas"><i class="fas fa-list-ul"></i></a>
                            </div>
                          </div>
                          <div class="propietarios">
                
                          </div>
                        </div>
                      </div>
                    </section>';
        }elseif($tipo == 6 || $tipo == 7){ // Pasajero & Asesor
          echo '  <section class="panel" id="panel">
                    <div class="panel-cards">
                      <a class="card button" href="https://www.salioviaje.com.uy/Viajar/?opcion=5#Cotizacion">
                        <div class="number">
                            <h2>+</h2>
                            <i class="fa-solid fa-road"></i>
                        </div>
                        <p>Solicitar Cotización</p>
                      </a>
                      <a class="card button" href="https://www.salioviaje.com.uy/Viajar?scroll=Oportunidades">
                        <div class="number">
                            <h2>'.$bd->numero_oportunidades().'</h2>
                            <i class="fa-solid fa-tags"></i>
                        </div>
                        <p>Oportunidades Disponibles</p>
                      </a>
                      <a class="card button" href="https://www.salioviaje.com.uy/Viajar?scroll=Ofertas">
                        <div class="number">
                            <h2>-</h2>
                            <i class="fa-solid fa-percent"></i>
                        </div>
                        <p>Ofertas Disponibles</p>
                      </a>
                      <a class="card button" href="https://www.salioviaje.com.uy/Vouchers">
                        <div class="number">
                            <h2>-</h2>
                            <i class="fa-solid fa-ticket"></i>
                        </div>
                        <p>Vouchers</p>
                      </a>
                    </div>
                    <div class="panel-tables-2">
                      <div class="usuarios-recientes">
                        <div class="usuarios-info">
                          <h2><i class="fas fa-bus"></i> Mis Viajes</h2>
                          <div class="button-wrapper">
                            <a href="https://www.salioviaje.com.uy/Viajar/?opcion=5" class="add"><i class="fas fa-plus"></i></a>
                            <a href="Viajes"><i class="fas fa-list-ul"></i></a>
                          </div>
                        </div>
                        <div class="search">
                          <i class="fas fa-search"></i>
                          <input type="text" placeholder="Buscar" id="searchbar" onkeyup="buscarUsuarios(5)"/>
                        </div>
                        <div class="table-container">
                          <table class="viajes-table" id="search-table-agenda">
                            <thead>
                              <tr>
                                <th>ID <i class="fas fa-angle-down"></i></th>
                                <th>
                                  Origen <i class="fas fa-angle-down"></i>
                                </th>
                                <th>Destino <i class="fas fa-angle-down"></i></th>
                                <th>Fecha <i class="fas fa-angle-down"></i></th>
                                <th>Hora <i class="fas fa-angle-down"></i></th>
                                <th>Cantidad Pasajeros <i class="fas fa-angle-down"></i></th>
                                <th>Modalidad <i class="fas fa-angle-down"></i></th>
                                <th>Estado <i class="fas fa-angle-down"></i></th>
                                <th>Precio <i class="fas fa-angle-down"></i></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="tbody-viajes-dashboard"></tbody>
                          </table>
                        </div>
                        <div class="empty-table" id="empty-viajes">
                            <p><i class="fas fa-info-circle"></i> No hay viajes pendientes.</p>
                        </div>
                      </div>

                      <div class="usuarios-recientes">
                        <div class="usuarios-info">
                          <h2><i class="fas fa-hand-holding-dollar"></i> Cotizaciones Recibidas</h2>
                        </div>
                        <div class="search">
                          <i class="fas fa-search"></i>
                          <input type="text" placeholder="Buscar" id="searchbar-2" onkeyup="buscarUsuarios(10,-2)"/>
                        </div>
                        <div class="table-container">
                          <table class="usuarios-table" id="cotz-reci" style="display: none;">
                            <thead>
                              <tr>
                                <th>ID Viaje<i class="fas fa-angle-down"></i></th>
                                <th>ID Cotización<i class="fas fa-angle-down"></i></th>
                                <th>Reputación <i class="fas fa-angle-down"></i></th>
                                <th>Marca / Modelo <i class="fas fa-angle-down"></i></th>
                                <th>Capacidad <i class="fas fa-angle-down"></i></th>
                                <th>Seña <i class="fas fa-angle-down"></i></th>
                                <th>Precio <i class="fas fa-angle-down"></i></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody class="cotizaciones_recibidas" id="tbody-viajes-dashboard">

                            </tbody>
                          </table>
                        </div>
                        <div class="full-table" id="full-cotiz-reci">
                          <p>Estas son todas las cotizaciones que tenemos para ti. En una hora pierden validez y se borrarán de aquí. <button class="gurucuteco-button" onclick="openGurucuteco(8)"><i class="fa-solid fa-circle-question"></i></button></p>
                        </div>
                        <div class="empty-table" id="empty-cotiz-reci">
                            <p><i class="fas fa-info-circle"></i> No hay cotizaciones recibidas.</p>
                        </div>
                      </div>
                    </div>
                  </section>'; 
        }
        ?>


      </body>
</html>