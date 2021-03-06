<?php
$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
session_start();
?>

 
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
