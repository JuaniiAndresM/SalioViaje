  <?php 

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
      <a href="/SalioViaje/" class="tool-tip" title-new="Volver al Inicio.">
        <span class="icon"><img src="/SalioViaje/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje"></span>
        <span class="title">SalióViaje</span>
      </a>
    </li>
    <?php 

    if($tipo != 0){
      echo '<li>
              <a href="/Dashboard">
                <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                <span class="title">Dashboard</span>
              </a>
            </li>';
    }

    if($tipo == 2 || $tipo == 3){
      echo '<li>
              <a href="https://www.salioviaje.com.uy/Agendar">
                <span class="icon"><i class="fas fa-plus"></i></span>
                <span class="title">Agendar Viaje</span>
              </a>
            </li>';
    }
    
    if($tipo == 1){
      echo '  <li>
                <a href="/Usuarios">
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
                  <span class="icon"><i class="fas fa-book"></i></span>
                  <span class="title">Agenda</span>
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
    }else{
      echo '<li>
              <a class href="https://www.salioviaje.com.uy/FAQ">
                <span class="icon"><i class="fas fa-question"></i></span>
                <span class="title">FAQs</span>
              </a>
            </li>';
    }

    

    echo '<li>
            <a class href="https://www.salioviaje.com.uy/Profile/'. $_SESSION['datos_usuario']['ID'] .'">
              <span class="icon"><i class="fas fa-address-card"></i></span>
              <span class="title">Mi Perfil</span>
            </a>
          </li>';

    

    ?>
    
    <li>
      <a href="https://www.salioviaje.com.uy/Settings">
        <span class="icon"><i class="fas fa-cog"></i></span>
        <span class="title">Configuración</span>
      </a>
    </li>

    <!--  

    <li>
      <a href="Soporte.html">
        <span class="icon"><i class="fas fa-headset"></i></span>
        <span class="title">Soporte</span>
      </a>
    </li>
    
    -->

    <li>
      <a href="/SalioViaje/">
        <span class="icon"><i class="fa fa-home"></i></span>
        <span class="title">Volver al Inicio</span>
      </a>
    </li>

  </ul>

</nav>
