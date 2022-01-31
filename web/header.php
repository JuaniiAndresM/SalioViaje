<header>
    <div class="header-wrapper">
        <div class="header-logo">
            <a href="/SalioViaje/">
                <img src="/SalioViaje/media/svg/Logo-SalioViaje.svg" alt="Logo SalióViaje">
            </a>
        </div>
        <div class="header-links">
            <div class="links">
                <a href="/SalioViaje/">Home</a>
                <a href="/SalioViaje/#Servicios">Servicios</a>
                <a href="/SalioViaje/#SobreNosotros">Sobre Nosotros</a>
                <a href="/SalioViaje/#Oportunidades">Oportunidades</a>
            </div>
            
            <?php

            session_start();

            if(isset($_SESSION['usuario'])){
                echo '  <div class="session">

                            <div class="close-session">
                                <button onclick="cerrarsesion()"><i class="fas fa-sign-out-alt"></i></button>
                            </div>
                            <button class="user">
                                <h3 id="user-name">'.$_SESSION['usuario'].'</h3>
                                <p id="rol"><i class="fas fa-bus"></i> Transportista</p>
                            </button>
                            
                        </div>';
            }else{
                echo '  <div class="links-session">
                            <a class="login_button" id="button" href="/SalioViaje/Form/Login.html"><i class="fas fa-user"></i> Iniciar Sesión</a>
                        </div>';
            }
            ?>
            
            
        </div>
    </div>
</header>
