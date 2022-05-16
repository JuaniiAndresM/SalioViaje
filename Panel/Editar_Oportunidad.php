<?php 

$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
  session_start(); 

  if(!isset($_SESSION['usuario'])){
    header('Location: https://www.salioviaje.com.uy/Login');

  }else{
    if($_SESSION['tipo_usuario'] == "Pasajero"){
      header('Location: https://www.salioviaje.com.uy/');
    }
  }

  $id_oportunidad = $_GET['ID'];

  require_once '../PHP/procedimientosBD.php';
  $regiones_mtop = new procedimientosBD();
  $regiones_mtop = json_decode($regiones_mtop->traer_regiones_mtop(), true);

  $oportunidad = new procedimientosBD();
  $oportunidad = $oportunidad->traer_oportunidades_por_id($id_oportunidad);
  /*
  [{"ID":33,"DESCUENTO":60,"ORIGEN":"PEDRO ARAMENDIA","DESTINO":"MERCEDES","FECHA":"27-05-2022 03:12","NOMBRE":"TRANSPORTISTA","APELLIDO":"SEIS","MARCA":"MB","MODELO":"SPRINTER","CAPACIDAD_VEHICULO":16,"ESTADO":"En venta","MATRICULA":"GHD0001","DISTANCIA":321,"PRECIO":10914,"ID_TRANSPORTISTA":496,"TIPO_USUARIO":"TTA"}] 
  */
  
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje | Editar Oportunidad #<?php echo $_GET['ID'] ?></title>

    <!-- // Meta Etiquetas -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    />

    <meta name="author" content="Daniel Schlebinger" />
    <meta name="robots" content="noindex,nofollow"/>
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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Editar_Oportunidad/<?php echo $_GET['ID'] ?>" />
    <meta property="og:title" content="SalióViaje | Editar Oportunidad" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Editar_Oportunidad/<?php echo $_GET['ID'] ?>" />
    <meta
      property="twitter:title"
      content="SalióViaje | Editar Oportunidad"
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

    <script src="https://www.salioviaje.com.uy/Javascript/panel.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/settings.js"></script>
    <script src="https://www.salioviaje.com.uy/Javascript/loader.js"></script>
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
          <h2>Editar Oportunidad #<?php echo $_GET['ID'] ?></h2>
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

        <div class="agendarViaje">
          
          <div id="step_2">

            <div class="inputs-wrapper-agendar-editar">

              <div class="column">
                <h2 class="step_title"><i class="fas fa-edit"></i> Editar Oportunidad</h2>

                <div class="input" id="descuento2">
                  <i class="fas fa-tags" id="icon"></i>
                  <select name="" id="desc_oport2" placeholder="Descuento de la Oportunidad">
                    <option value="0" disabled selected hidden>Seleccione un Descuento</option>
                    <option value="50">50%</option>
                    <option value="60">60%</option>
                    <option value="70">70%</option>
                    <option value="80">80%</option>
                    <option value="90">90%</option>
                  </select>
                </div>

                <div class="input" id="origen">
                  <i class="far fa-calendar-alt" id="icon"></i>
                  <input type="datetime-local" id="fecha_2" placeholder="Fecha y Hora" onchange="calcular_hora_invertido()" />
                </div>

                <div class="input" id="origen">
                  <i class="fas fa-map-marker-alt" id="icon"></i>
                  <input list="RegionesMTOP" id="origen_2" placeholder="Origen" onchange="select_origen_destino(3)"> 

                  <datalist id="RegionesMTOP">
                        <?php
                          if (isset($regiones_mtop)) {
                            for ($i=0; $i < count($regiones_mtop); $i++) { 
                            ?>
                            <option value="<?php echo $regiones_mtop[$i]['REGION'] ?>">
                            <?php
                            }
                          }
                        ?>
                  </datalist>
                  
                </div>

                <div class="input" id="destino">
                  <i class="fas fa-route" id="icon"></i>
                  <input list="RegionesMTOP" id="destino_2" placeholder="Destino" onchange="select_origen_destino(4)">
                </div>

                <div class="input" id="precioref">
                  <i class="fas fa-dollar-sign" id="icon"></i>
                  <input type="number" id="precioref_2" placeholder="Precio de Referencia" />
                </div>

              </div>
            </div>
            <p id="mensaje-error1" class="mensaje-error"></p>

            <button class="button-agendar" onclick="editar_oportunidad(<?php echo $_GET['ID'] ?>)">
              <i class="fas fa-edit"></i> Editar
            </button>
          </div>


        </div>
    </section>
    <script>
      <?php 
        $timestamp = strtotime($oportunidad[0]['FECHA']);
        $newDate = date("Y-m-d H:i", $timestamp);
        $oportunidad[0]['FECHA'] = $newDate;
        $oportunidad[0]['FECHA'] = str_replace(" ", "T",$oportunidad[0]['FECHA']);
      ?>
      $("#desc_oport2").val(<?php echo $oportunidad[0]['DESCUENTO']; ?>);
      $("#fecha_2").val("<?php echo $oportunidad[0]['FECHA']; ?>");
      $("#origen_2").val("<?php echo $oportunidad[0]['ORIGEN']; ?>");
      $("#destino_2").val("<?php echo $oportunidad[0]['DESTINO']; ?>");
      $("#precioref_2").val(<?php echo $oportunidad[0]['PRECIO']; ?>);
    </script>
  </body>
</html>
