<?php
require_once '../PHP/procedimientosBD.php';

$cotizaciones = new procedimientosBD();

$cotizaciones = json_decode($cotizaciones->traer_viajes_cotizando_panel_admin(), true);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>SalióViaje - Cotizaciones</title>

    <!-- // Meta Etiquetas -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    />

    <meta name="author" content="TotumDev" />

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
    <meta property="og:url" content="https://www.salioviaje.com.uy/Servicios" />
    <meta property="og:title" content="SalióViaje - Servicios" />
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
    <meta property="twitter:url" content="https://www.salioviaje.com.uy/Servicios" />
    <meta
      property="twitter:title"
      content="SalióViaje - Servicios"
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
    <script
      src="https://kit.fontawesome.com/1e193e3a23.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://www.salioviaje.com.uy/Javascript/web.js"></script>
  </head>
  <body>
    <div id="header"></div>

    <div id="pre-loader">
      <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>

    <a href="https://www.salioviaje.com.uy/FAQ" target="_BLANK" id="faq-float">
      <i class="fas fa-question"></i>
    </a>
    <a href="https://wa.link/mmdp0q" target="_BLANK" id="whatsapp-float">
      <img src="https://www.salioviaje.com.uy/media/images/whatsapp.png" alt="">
    </a>

    <section class="Cotizaciones-section" id="Cotizaciones">
      <h2>
        Central de cotizaciones
      </h2>
      <hr />
      <p class="description">
        Estos viajes están esperando cotización.
      </p>

      <div class="Cotizaciones-wrapper">

        <div class="filter-wrapper">
          <div class="search">
            <i class="fas fa-search"></i>
            <input
              type="text"
              placeholder="Buscar"
              id="searchbar"
              onkeyup="buscarOportunidades()"
            />
          </div>

          <div class="button-filtrar">
            <button onclick="filtros(1)"><i class="fas fa-sort-amount-down"></i> Filtrar</button>
          </div>
        </div>

        <div id="filters">

          <div class="input" id="destino">
            <i class="fas fa-route" id="icon"></i>
            <input list="Destino" id="destino_2" placeholder="Destino">
            <datalist id="Destino">
              <option value="Canelones">
              <option value="Montevideo">
              <option value="Tacuarembó">
              <option value="Maldonado">
              <option value="Rivera">
            </datalist>
          </div>

          <div class="input" id="destino">
            <i class="fas fa-route" id="icon"></i>
            <input list="Destino" id="destino_2" placeholder="Destino">
            <datalist id="Destino">
              <option value="Canelones">
              <option value="Montevideo">
              <option value="Tacuarembó">
              <option value="Maldonado">
              <option value="Rivera">
            </datalist>
          </div>

          <div class="input" id="origen">
            <i class="far fa-calendar-alt" id="icon"></i>
            <input type="date" id="fecha_2" placeholder="Fecha y Hora" />
          </div>

        </div>


        <div class="list-empty-cotizacion">
          <p>Lo sentimos, de momento no hay cotizaciones disponibles.</p>
        </div>

        <div class="Cotizaciones-list">
          <?php
for ($i = 0; $i < count($cotizaciones); $i++) {
    //print_r(json_encode($cotizaciones[$i])."\n");
    ?>
                        <div class="Cotizaciones">

<div class="Cotizaciones-left">
  <div class="discount">
    <h3><?php echo $cotizaciones[$i]['ID']; ?></h3>
  </div>

  <div class="travel">
    <p><i class="fas fa-van-shuttle"></i><?php echo $cotizaciones[$i]['TIPO']; ?>.</p>
    <p><i class="fas fa-map-marker-alt"></i>Origen: <?php echo $cotizaciones[$i]['LOCALIDAD_ORIGEN']; ?>, <?php echo $cotizaciones[$i]['BARRIO_ORIGEN']; ?>.</p>
    <p><i class="fas fa-route"></i>Destino: <?php
     if ($cotizaciones[$i]['LOCALIDAD_DESTINO'] != null) {
      echo $cotizaciones[$i]['LOCALIDAD_DESTINO'].", ".$cotizaciones[$i]['BARRIO_DESTINO'];
     }else {
      echo $cotizaciones[$i]['BARRIO_DESTINO'];
     }
     
     ?>.</p>
  </div>

  <div class="travel">
    <p><i class="far fa-calendar-alt"></i><?php echo $cotizaciones[$i]['FECHA_SALIDA']; ?></p>
    <p><i class="far fa-clock"></i><?php echo $cotizaciones[$i]['HORA']; ?></p>
  </div>

  <div class="travel">
    <p><i class="fas fa-user-friends"></i><?php echo $cotizaciones[$i]['CANTIDAD_PASAJEROS']; ?></p>
    <p><i class="fas fa-dog"></i><?php 
    if ($cotizaciones[$i]['MASCOTAS'] == 2) {
      echo "sin mascotas"; 
    } else {
      echo "con mascotas"; 
    }
    
   
    ?></p>
  </div>

</div>

<div class="Cotizaciones-right">

  <div class="button-wrapper">
      <button class="comprar-button" type="submit"><i class="fas fa-chart-line"></i> Cotizar</button>
      <button onclick="location.href = '/Cotizacion/' + <?php echo $cotizaciones[$i]['ID']; ?>;"><i class="fas fa-info"></i> Detalles</button>
  </div>

</div>
</div>
              <?php
}
?>
        </div>
      </div>
    </section>

    <div id="footer"></div>
  </body>
</html>
