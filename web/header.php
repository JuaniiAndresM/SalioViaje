<?php
    session_start();
?>


<header>
    <div class="header-wrapper">
        <div class="header-logo">
            <a href="https://www.salioviaje.com.uy/">
                <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="Logo SalióViaje">
            </a>
        </div>
        <div class="header-right">
            <div class="header-links">
                <div class="links">
                    <a href="https://www.salioviaje.com.uy/">Home</a>
                    <a href="https://www.salioviaje.com.uy/Servicios">Servicios</a>
                    <a href="https://www.salioviaje.com.uy/Nosotros">Sobre Nosotros</a>
                    <a href="https://www.salioviaje.com.uy/Oportunidades">Oportunidades</a>
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
                                <a class="login_button" id="button" href="https://www.salioviaje.com.uy/Login"><i class="fas fa-user"></i> Iniciar Sesión</a>
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

                    <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="">

                    <?php

                    if(isset($_SESSION['usuario'])){
                        echo '  <div class="usuario">
                                    <h3>'.$_SESSION["usuario"].'</h3>
                                    <p><i class="fas fa-bus"></i> '.$_SESSION['tipo_usuario'].'</p>
                                </div>';
                    }

                    echo '  <a href="https://www.salioviaje.com.uy/"><i class="fas fa-home"></i> Home</a>
                            <a href="https://www.salioviaje.com.uy/Servicios"><i class="fas fa-list-ul"></i> Servicios</a>
                            <a href="https://www.salioviaje.com.uy/Nosotros"><i class="fas fa-info"></i> Sobre Nosotros</a>
                            <a href="https://www.salioviaje.com.uy/Oportunidades"><i class="fas fa-book"></i> Oportunidades</a>';


                    if(isset($_SESSION['usuario'])){
                        echo '  <button onclick="cerrarsesion()"><i class="fas fa-sign-in-alt"></i> Cerrar Sesión</button>';
                    }else{
                        echo '<a href="https://www.salioviaje.com.uy/Login"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>';
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
