  <?php 
$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
  session_start();

  $tipo = 0;

  if(isset($_SESSION['usuario'])){
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
        
      case "Hotel":
        $tipo = 6;
        break;
        
      case "Pasajero":
        $tipo = 7;
        break;
        
      case "Asesor":
        $tipo = 8;
        break;
      
      default:
        $tipo = 0;
        break;
    }
  }

  

  ?>
  
  <button class="navbar-responsive-button" onclick="navbar()">
    <i class="fas fa-bars"></i>
  </button>
  <ul>
    <li>
      <a href="https://www.salioviaje.com.uy/" class="tool-tip" title-new="Volver al Inicio.">
        <span class="icon"><img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje" title="Home | SalióViaje" ></span>
      </a>
    </li>
    <?php 

    if($tipo != 0){
      echo '<li>
              <a href="https://www.salioviaje.com.uy/Dashboard">
                <span class="icon"><i class="fa-solid fa-table-columns"></i></span>
                <span class="title">Dashboard</span>
              </a>
            </li>';
    }

    if($tipo == 2 || $tipo == 3){
      echo '<li>
              <a href="https://www.salioviaje.com.uy/Agendar">
                <span class="icon"><i class="fa-solid fa-calendar-plus"></i></span>
                <span class="title">Agendar Viaje</span>
              </a>
            </li>';
    }
    if($tipo == 2){
      echo '<li>
              <a href="https://www.salioviaje.com.uy/Cotizaciones">
                <span class="icon"><i class="fa-solid fa-money-check-dollar"></i></span>
                <span class="title">Mis Cotizaciones</span>
              </a>
            </li>';
    }
    
    if($tipo == 1){
      echo '  <li>
                <a href="https://www.salioviaje.com.uy/Usuarios">
                  <span class="icon"><i class="fas fas fa-user-friends"></i></span>
                  <span class="title">Usuarios</span>
                </a>
              </li>';
    }

    if($tipo == 2){
      echo '  <li>
                <a href="https://www.salioviaje.com.uy/Choferes">
                  <span class="icon"><i class="fas fas fa-user-friends"></i></span>
                  <span class="title">Choferes</span>
                </a>
              </li>';
    }

    if($tipo == 1 || $tipo == 2 || $tipo == 3 || $tipo == 4 || $tipo == 5 || $tipo == 6){
      echo '<li>
              <a href="https://www.salioviaje.com.uy/Empresas">
                <span class="icon"><i class="fas fas fa-building"></i></span>
                <span class="title">Empresas</span>
              </a>
            </li>';

    }

    if($tipo == 1 || $tipo == 2 || $tipo == 3){
      echo '<li>
              <a href="https://www.salioviaje.com.uy/Vehiculos">
                <span class="icon"><i class="fas fa-bus"></i></span>
                <span class="title">Vehículos</span>
              </a>
            </li>';
    }

    if($tipo != 0){
      echo '  <li>
                <a href="https://www.salioviaje.com.uy/Viajes">
                  <span class="icon"><i class="fa-solid fa-calendar-days"></i></span>
                  <span class="title">Agenda</span>
                </a>
              </li>';
    }

    if($tipo == 1 || $tipo == 2 ){
      echo '  <li>
                <a href="https://www.salioviaje.com.uy/Facturacion">
                  <span class="icon"><i class="fa-solid fa-file-invoice-dollar"></i></span>
                  <span class="title">Facturación</span>
                </a>
              </li>';
    }

    if($tipo == 1){
      echo '<li>
              <a class href="https://www.salioviaje.com.uy/FAQ_Edit">
                <span class="icon"><i class="fas fa-question"></i></span>
                <span class="title">Editar FAQs</span>
              </a>
            </li>';
    }

    echo '<li>
        <a class href="https://www.salioviaje.com.uy/FAQ_Dashboard">
          <span class="icon"><i class="fa-solid fa-circle-question"></i></span>
          <span class="title">FAQ\'s</span>
        </a>
      </li>
      <li>';
    if($tipo != 3 && $tipo != 7 && $tipo != 8){
      echo '<li>
              <a class href="https://www.salioviaje.com.uy/Ofertas_Dashboard">
                <span class="icon"><i class="fa-solid fa-percent"></i></span>
                <span class="title">Ofertas y Promo</span>
              </a>
            </li>';
    }

    

    echo '<li>
            <a class href="https://www.salioviaje.com.uy/Profile/'. $_SESSION['datos_usuario']['ID'] .'">
              <span class="icon"><i class="fa-solid fa-id-card"></i></span>
              <span class="title">Mi Perfil</span>
            </a>
          </li>';
    
    if($tipo == 1){
      echo '<li>
              <a class href="https://www.salioviaje.com.uy/Central">
                <span class="icon"><i class="fas fa-hand-holding-dollar"></i></span>
                <span class="title">Cotizaciones</span>
              </a>
            </li>
            <li>
              <a class href="https://www.salioviaje.com.uy/Editar_Cotizacion">
                <span class="icon"><i class="fas fa-chart-line"></i></span>
                <span class="title">Editar Cotizaciones</span>
              </a>
            </li>
            <li>
              <a class href="https://www.salioviaje.com.uy/Permisos_MTOP">
                <span class="icon"><i class="fa-solid fa-file-signature"></i></span>
                <span class="title">Permisos MTOP</span>
              </a>
            </li>
            <li>
              <a class href="https://www.salioviaje.com.uy/Settings">
                <span class="icon"><i class="fa-solid fa-gears"></i></span>
                <span class="title">Configuración</span>
              </a>
            </li>';
    }

    

    ?>

    <!--  

    <li>
      <a href="Soporte.html">
        <span class="icon"><i class="fas fa-headset"></i></span>
        <span class="title">Soporte</span>
      </a>
    </li>
    
    -->

    <li>
      <a href="https://www.salioviaje.com.uy/">
        <span class="icon"><i class="fa fa-home"></i></span>
        <span class="title">Volver al Inicio</span>
      </a>
    </li>

  </ul>

</nav>

<script type="text/javascript">
  const currentLocation = location.href;
  const menuItem = $('#panel-navbar a');
  const menuLength = menuItem.length;

  let locationhrefItem = currentLocation.split('/');


  for(let i = 1; i < menuLength; i++){
    
    if(menuItem[i].href.includes(locationhrefItem[3])){
      menuItem[i].className = "active-page"
      document.querySelector('.active-page').closest('li').className = "hovered"
    }
  }

  ;
</script>
