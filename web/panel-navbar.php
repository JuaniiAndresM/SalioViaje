  <?php 

  session_start();

  $tipo = 0;

  if(isset($_SESSION['usuario'])){
    switch($_SESSION['tipo_usuario']){
      case "Administrador":
        $tipo = 1;
        break;
  
      case "Transportista": case "Chofer":
        $tipo = 2;
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
      <a href="/SalioViaje/">
        <span class="icon"><img src="/SalioViaje/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje"></span>
        <span class="title">SalióViaje</span>
      </a>
    </li>
    <?php 

    if($tipo != 0){
      echo '<li>
              <a href="/SalioViaje/Dashboard">
                <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                <span class="title">Dashboard</span>
              </a>
            </li>';
    }
    
    
    if($tipo == 1){
      echo '  <li>
                <a href="/SalioViaje/Usuarios">
                  <span class="icon"><i class="fas fas fa-user-friends"></i></span>
                  <span class="title">Usuarios</span>
                </a>
              </li>

              <li>
                <a href="/SalioViaje/Empresas">
                  <span class="icon"><i class="fas fas fa-building"></i></span>
                  <span class="title">Empresas</span>
                </a>
              </li>

              <li>
                <a href="/SalioViaje/Vehiculos">
                  <span class="icon"><i class="fas fa-bus"></i></span>
                  <span class="title">Vehículos</span>
                </a>
              </li>

              <li>
                <a class href="/SalioViaje/">
                  <span class="icon"><i class="fas fa-undo"></i></span>
                  <span class="title">Página Principal</span>
                </a>
              </li>';
    }elseif($tipo == 2){
      echo '  <li>
                <a href="/SalioViaje/Agendar">
                  <span class="icon"><i class="fas fa-plus"></i></span>
                  <span class="title">Agendar Viaje</span>
                </a>
              </li>
              <li>
                <a href="/SalioViaje/Viajes">
                  <span class="icon"><i class="fas fa-book"></i></span>
                  <span class="title">Agenda</span>
                </a>
              </li>';
    }
    ?>
    
    <li>
      <a href="Settings">
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
  </ul>

</nav>
