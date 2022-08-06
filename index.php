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
    <style>
      @import url(https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500;600;700;900&display=swap);@-webkit-keyframes lds-ellipsis1{0%{-webkit-transform:scale(0);transform:scale(0)}to{-webkit-transform:scale(1);transform:scale(1)}}@keyframes lds-ellipsis1{0%{-webkit-transform:scale(0);transform:scale(0)}to{-webkit-transform:scale(1);transform:scale(1)}}@-webkit-keyframes lds-ellipsis3{0%{-webkit-transform:scale(1);transform:scale(1)}to{-webkit-transform:scale(0);transform:scale(0)}}@keyframes lds-ellipsis3{0%{-webkit-transform:scale(1);transform:scale(1)}to{-webkit-transform:scale(0);transform:scale(0)}}@-webkit-keyframes lds-ellipsis2{0%{-webkit-transform:translate(0,0);transform:translate(0,0)}to{-webkit-transform:translate(24px,0);transform:translate(24px,0)}}@keyframes lds-ellipsis2{0%{-webkit-transform:translate(0,0);transform:translate(0,0)}to{-webkit-transform:translate(24px,0);transform:translate(24px,0)}}@-webkit-keyframes spinner{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}to{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes spinner{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}to{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}.landing{width:100%;max-height:700px;background-color:#fff;margin-top:80px;display:-ms-grid;display:grid}.landing .landing-wrapper-grid{display:-ms-grid;display:grid;-ms-grid-columns:30% 1fr;grid-template-columns:30% 1fr;width:100%;gap:20px;margin:0 auto;padding:0 20px}.landing .landing-wrapper-grid .landing-left{-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;text-align:left}.landing .landing-wrapper-grid .landing-left .landing-info{text-align:left}.landing .landing-wrapper-grid .landing-left .landing-info h1{font-size:4.6em;font-weight:700;color:#333;margin-bottom:10px}.landing .landing-wrapper-grid .landing-left .landing-info h1 span,.servicios .servicios-wrapper .card:hover .card-top .card-icon i,.servicios .servicios-wrapper .card:hover .card-top .card-info h3,.servicios h2 span{color:#3844bc}.landing .landing-wrapper-grid .landing-left .landing-info p{color:#3844bc;font-size:1.6em;max-width:400px;width:100%;margin-bottom:20px}.landing .landing-wrapper-grid .landing-left .landing-info .button-landing{background:-webkit-gradient(linear,left top,right top,from(#3844bc),to(#2b3179));background:linear-gradient(to right,#3844bc,#2b3179);color:#fff;border:0;-webkit-transition:.5s;transition:.5s;cursor:pointer;border-radius:0 2em 2em 2em;text-decoration:none;margin-top:20px;padding:0;width:270px;height:50px;font-size:1.2em}.landing .landing-wrapper-grid .landing-left .landing-info .button-landing i,header .header-wrapper .header-right .header-links .links-session .login_button i{margin-right:5px}.landing .landing-wrapper-grid .landing-left .landing-info .button-landing:hover{-webkit-transform:scale(1.1);transform:scale(1.1)}.landing .landing-wrapper-grid .landing-left,.landing .landing-wrapper-grid .landing-left .landing-info .button-landing,.landing .landing-wrapper-grid .landing-right,.servicios .servicios-wrapper{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.landing .landing-wrapper-grid .landing-right .landing-img-wrapper{height:100%;border-radius:6em 6em 0 6em;overflow:hidden;background-color:#2b3179}.landing .landing-wrapper-grid .landing-right .landing-img-wrapper img{width:100%;height:100%;-o-object-fit:cover;object-fit:cover;-o-object-position:right;object-position:right}.servicios{width:100%;margin:0 auto;padding:10px}.servicios h2{color:#333;font-size:2em;text-align:center}.servicios #hr{margin:10px auto}.servicios hr{width:100px;margin:10px 0}.servicios .servicios-wrapper{width:100%;-webkit-box-pack:space-evenly;-ms-flex-pack:space-evenly;justify-content:space-evenly;-ms-flex-wrap:wrap;flex-wrap:wrap;margin:20px 0}.oportunidades .oportunidades-wrapper,.servicios .servicios-wrapper .card{width:100%;-webkit-box-shadow:10px 0 20px 0 rgba(0,0,0,.3);box-shadow:10px 0 20px 0 rgba(0,0,0,.3)}.servicios .servicios-wrapper .card,.servicios .servicios-wrapper .card .click-here{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-transition:.3s;transition:.3s}.servicios .servicios-wrapper .card{max-width:280px;min-height:500px;background:linear-gradient(45deg,#3844bc,#2b3179);border-radius:3em 3em 0 3em;margin:10px;padding:20px;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.servicios .servicios-wrapper .card .card-top .card-icon i{color:#fff;font-size:3em;margin-bottom:10px;overflow:hidden}.servicios .servicios-wrapper .card .card-top .card-info h3{color:#fff;font-size:1.6em}.servicios .servicios-wrapper .card .card-top .card-info hr{border:1px solid #fff}.servicios .servicios-wrapper .card .card-top .card-info .info_1{color:#fff;margin:20px 0;font-size:1em;height:70px}.servicios .servicios-wrapper .card .click-here{width:150px;height:40px;border-radius:1em 0 1em 1em;margin:0 auto;background-color:#3844bc;cursor:pointer;text-align:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;border:1px solid #fff}.servicios .servicios-wrapper .card .click-here p{color:#fff}.servicios .servicios-wrapper .card .click-here p i,header .header-wrapper .header-right #links-mobile .links-wrapper a i{margin-right:10px}.servicios .servicios-wrapper .card .click-here:hover{background-color:#6d76db;border:1px solid #6d76db}.servicios .servicios-wrapper .card .card-bottom .info_2,.servicios .servicios-wrapper .card .card-bottom .info_3{color:#fff;font-size:.8em;margin:10px 0}.servicios .servicios-wrapper .card .card-bottom .info_3 a{color:#fff;text-decoration:none;font-size:1.2em;-webkit-transition:.2s;transition:.2s}.servicios .servicios-wrapper .card .card-bottom .info_3 .tel:hover{color:#6d76db;font-size:1.3em}.servicios .servicios-wrapper .card .card-bottom .button-whatsapp,.servicios .servicios-wrapper .card .card-bottom .button-whatsapp .whatsapp{width:100%;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:end;-ms-flex-pack:end;justify-content:flex-end;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.servicios .servicios-wrapper .card .card-bottom .button-whatsapp .whatsapp{width:50px;height:50px;border-radius:50%;background:#50c450;padding:10px;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}#whatsapp-float img,.servicios .servicios-wrapper .card .card-bottom .button-whatsapp .whatsapp img,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .user-info .user-icon img{width:100%;height:100%;-o-object-fit:cover;object-fit:cover}.servicios .servicios-wrapper .card:hover{background:#fff;-webkit-transform:scale(1.01);transform:scale(1.01)}.servicios .servicios-wrapper .card:hover .card-top .card-info hr,.servicios hr{border:1px solid #3844bc}.servicios .servicios-wrapper .card:hover .card-top .card-info .info_1,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid h3,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid h3,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid h3,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid h3{color:#2b3179}.servicios .servicios-wrapper .card:hover .click-here{display:-webkit-box;display:-ms-flexbox;display:flex}#flotant-promo .promo-content .promo-body h4,.servicios .servicios-wrapper .card:hover .card-bottom .info_2,.servicios .servicios-wrapper .card:hover .card-bottom .info_3{color:#3844bc}.servicios .servicios-wrapper .card:hover .card-bottom .info_2 a,.servicios .servicios-wrapper .card:hover .card-bottom .info_3 a{color:#444}.oportunidades{margin:20px auto;padding:0 20px;max-width:1300px;width:100%;text-align:center}.oportunidades h2,.viajar-wrapper-index .salioviaje h2{color:#3844bc;font-size:2em}.oportunidades hr,.viajar-wrapper-index .salioviaje hr{width:100px;border:1px solid #3844bc;margin:10px auto}.oportunidades .oportunidades-wrapper{max-width:1300px;padding:20px 30px;margin-top:30px;border-radius:3em 0 3em 3em;background-color:#fff}.oportunidades #filters,.oportunidades .filter-wrapper{width:100%;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.oportunidades .filter-wrapper .search{position:relative;width:200px;height:40px}.oportunidades .filter-wrapper .button-filtrar button{background-color:transparent;border:0;outline:0;cursor:pointer;color:#888;width:100px;-webkit-transition:.3s;transition:.3s}.oportunidades .filter-wrapper .button-filtrar button:hover{color:#555}.oportunidades #filters{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-ms-flex-wrap:wrap;flex-wrap:wrap}.oportunidades #filters .input{position:relative;width:180px;margin:10px}.oportunidades #filters .input input{width:100%;height:40px;background-color:transparent;border:0;border-bottom:1px solid #aaa;outline:0;padding-left:25px;color:#555;font-size:.85em}.oportunidades #filters .input input::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_1 .input select::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input input::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input select::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input input::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input select::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input textarea::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input input::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input select::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input input::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input select::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input textarea::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input input::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input select::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input input::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input select::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input textarea::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input input::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input select::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input input::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input select::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input textarea::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .input input::-webkit-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .paradas-wrapper .input input::-webkit-input-placeholder{color:#888}.oportunidades #filters .input input:-ms-input-placeholder,.oportunidades #filters .input input::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_1 .input select:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_1 .input select::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input input:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input input::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input select:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input select::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input input:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input input::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input select:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input select::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input textarea:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input textarea::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input input:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input input::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input select:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input select::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input input:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input input::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input select:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input select::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input textarea:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input textarea::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input input:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input input::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input select:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input select::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input input:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input input::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input select:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input select::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input textarea:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input textarea::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input input:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input input::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input select:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input select::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input input:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input input::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input select:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input select::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input textarea:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input textarea::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .input input:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .input input::-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .paradas-wrapper .input input:-ms-input-placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .paradas-wrapper .input input::-ms-input-placeholder{color:#888}.oportunidades #filters .input input::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_1 .input select::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input input::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input select::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input input::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input select::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input textarea::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input input::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input select::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input input::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input select::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input textarea::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input input::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input select::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input input::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input select::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input textarea::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input input::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input select::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input input::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input select::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input textarea::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .input input::placeholder,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .paradas-wrapper .input input::placeholder{color:#888}.oportunidades #filters button,.oportunidades .list-empty{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.oportunidades #filters button{width:40px;height:40px;border-radius:50%;background-color:#3844bc;border:0;cursor:pointer;-webkit-transition:.2s;transition:.2s}.oportunidades #filters button i{color:#fff;font-size:15px}.oportunidades #filters button:hover{-webkit-transform:scale(1.05);transform:scale(1.05)}.oportunidades .list-empty{width:100%;min-height:200px;margin-top:-25px}.oportunidades .list-empty p{color:#3844bc;margin:auto}.oportunidades .container-list{width:100%;display:none;margin-top:10px;max-height:350px;overflow:hidden;overflow-y:auto}.separador_wrapper,header .header-wrapper{width:100%;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.separador_wrapper{overflow:hidden;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:end;-ms-flex-pack:end;justify-content:flex-end}.separador_1,.separador_2{width:50%;min-width:300px;height:20px;margin:20px 0;background:linear-gradient(45deg,#3844bc,#2b3179);position:relative;overflow:hidden}.separador_1 .triangle,.separador_2 .triangle{top:0;right:0;position:absolute;width:0;height:0;border-style:solid;border-width:0 40px 40px 0;border-color:transparent #fff transparent transparent}.separador_2 .triangle{left:0;-webkit-transform:rotate(180deg);transform:rotate(180deg)}@media screen and (max-width:1100px){.landing .landing-wrapper-grid .landing-right .landing-img-wrapper img{width:100%;height:100%;-o-object-fit:cover;object-fit:cover;-o-object-position:right;object-position:right}.landing{max-height:600px;overflow:hidden;margin-bottom:20px}.landing .landing-wrapper-grid{-ms-grid-columns:1fr;grid-template-columns:1fr}.landing .landing-wrapper-grid .landing-left{width:calc(100% - 20px);margin:0 auto}.landing .landing-wrapper-grid .landing-left .landing-info{width:100%;text-align:center}.landing .landing-wrapper-grid .landing-left .landing-info h1{font-size:3.4em}.landing .landing-wrapper-grid .landing-left .landing-info p{font-size:1em;margin:20px auto;max-width:400px}.landing .landing-wrapper-grid .landing-left .landing-info .button-landing{margin:5px auto}.landing .landing-wrapper-grid .landing-right .landing-img-wrapper{max-width:400px;width:calc(100% - 20px);border-radius:3em 3em 0 3em}}@media screen and (max-width:842px){.oportunidades .oportunidades-wrapper .container-list{max-height:600px}}header{width:100%;height:80px;position:fixed;z-index:50;background-color:#fff;top:0;left:0}header .header-wrapper{max-width:1300px;height:100%;margin:0 auto;padding:10px;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between}header .header-wrapper .header-logo{width:60px;height:60px}header .header-wrapper,header .header-wrapper .header-right{display:-webkit-box;display:-ms-flexbox;display:flex}header .header-wrapper .header-right #links-mobile .links-wrapper,header .header-wrapper .header-right #links-mobile .links-wrapper a,header .header-wrapper .header-right .header-links{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:space-evenly;-ms-flex-pack:space-evenly;justify-content:space-evenly;-webkit-box-align:center;-ms-flex-align:center;align-items:center}header .header-wrapper .header-right .header-links .links{margin-right:2em}header .header-wrapper .header-right .header-links .links a{margin-left:2em;text-decoration:none;color:#3844bc;font-size:.9em}footer .totum p a:hover,header .header-wrapper .header-right .header-links .links a:hover{color:#6d76db}header .header-wrapper .header-right .header-links .links-session{-webkit-transition:.3s;transition:.3s}header .header-wrapper .header-right .header-links .links-session .login_button{background:#3844bc;color:#fff;padding:15px 20px;border:0;border-radius:2em 0 2em 2em;margin-top:10px;-webkit-transition:.5s;transition:.5s;cursor:pointer;text-decoration:none}.viajar-wrapper-index .salioviaje .button-agendar:hover,footer .footer-wrapper .column_2 .item-wrapper .item:hover,header .header-wrapper .header-right .header-links .links-session:hover{-webkit-transform:scale(1.1);transform:scale(1.1)}header .header-wrapper .header-right .burger-mobile{position:relative;z-index:50;display:none;cursor:pointer;margin:0 20px}header .header-wrapper .header-right .burger-mobile .bar1,header .header-wrapper .header-right .burger-mobile .bar2,header .header-wrapper .header-right .burger-mobile .bar3{width:35px;height:5px;background-color:#3844bc;margin:6px 0;-webkit-transition:.4s;transition:.4s}header .header-wrapper .header-right #links-mobile{display:none;-webkit-transform:translateY(-160%);transform:translateY(-160%);position:absolute;z-index:5;top:0;left:0;width:100%;height:100vh;background-color:rgba(255,255,255,.95);-webkit-transition:ease-in .6s;transition:ease-in .6s}header .header-wrapper .header-right #links-mobile .links-wrapper{width:100%;height:100vh;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;overflow-y:auto;padding:20px 0}header .header-wrapper .header-right #links-mobile .links-wrapper img{max-width:60px;width:100%;margin:10px}header .header-wrapper .header-right #links-mobile .links-wrapper a{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;width:80%;margin:0 20px;text-align:center;background:0 0;color:#3844bc;font-size:13px;text-decoration:none;border:0;border-bottom:1px solid #3844bc6b;padding:15px}header .header-wrapper .header-right #links-mobile .links-wrapper a:hover{background-color:rgba(0,0,0,.2)}header .header-wrapper .header-right #links-mobile .links-wrapper::-webkit-scrollbar{width:5px}@media screen and (max-width:1200px){header .header-wrapper .header-right .header-links .links{display:none}header .header-wrapper .header-right .burger-mobile{display:block}header .header-wrapper .header-right #links-mobile{display:-webkit-box;display:-ms-flexbox;display:flex}}@media screen and (max-width:600px){header .header-wrapper .header-right .header-links .links-session{display:none}}footer{width:100%;min-height:250px;border-radius:14em 0 0 0;background:linear-gradient(45deg,#3844bc,#2b3179)}footer .footer-wrapper{padding:50px 30px;display:-ms-grid;display:grid;-ms-grid-columns:(1fr)[3];grid-template-columns:repeat(3,1fr);width:100%}footer .footer-wrapper .column_1,footer .footer-wrapper .column_2,footer .footer-wrapper .column_3{margin:auto;text-align:center}footer .footer-wrapper .column_1 .logo{max-width:120px;width:100%;margin:0 auto}footer .footer-wrapper .column_1 .logo img{width:100%;height:100%}footer .footer-wrapper .column_1 p,footer .footer-wrapper .column_2 p{color:#fff;margin-top:10px;font-size:.9em}footer .footer-wrapper .column_2{max-width:320px;width:100%}footer .footer-wrapper .column_2 h3,footer .footer-wrapper .column_3 h3{color:#fff;font-weight:600;font-size:1.6em}footer .footer-wrapper .column_2 hr{width:200px;margin:10px auto}footer .footer-wrapper .column_2 .item-wrapper,footer .footer-wrapper .column_2 .item-wrapper .item{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center}footer .footer-wrapper .column_2 .item-wrapper{-ms-flex-wrap:wrap;flex-wrap:wrap}footer .footer-wrapper .column_2 .item-wrapper .item{width:50px;height:50px;border-radius:50%;background-color:#fff;text-decoration:none;margin:10px;-webkit-transition:.3s;transition:.3s}footer .footer-wrapper .column_2 .item-wrapper .item i{color:#3844bc;font-size:1.2em}footer .footer-wrapper .column_3 .input{position:relative}footer .footer-wrapper .column_3 .input input{border:0;border-bottom:1px solid #fff;background-color:transparent;color:#fff;width:100%;height:40px;outline:0;padding-left:25px;margin-top:10px}footer .footer-wrapper .column_3 .input input::-webkit-input-placeholder{color:#fff}footer .footer-wrapper .column_3 .input input:-ms-input-placeholder,footer .footer-wrapper .column_3 .input input::-ms-input-placeholder{color:#fff}footer .footer-wrapper .column_3 .input input::placeholder{color:#fff}footer .footer-wrapper .column_3 .input input:-webkit-autofill{-webkit-text-fill-color:#fff;-webkit-box-shadow:0 0 0 1000px transparent inset;-webkit-transition:background-color 5000s ease-in-out 0s;transition:background-color 5000s ease-in-out 0s}footer .footer-wrapper .column_3 .input i{position:absolute;top:20px;left:0;color:#fff}footer .footer-wrapper .column_3 .suscribirse-mail,footer .footer-wrapper .column_3 .suscrito-mail{background:-webkit-gradient(linear,left top,right top,from(#3844bc),to(#2b3179));background:linear-gradient(to right,#3844bc,#2b3179);padding:15px 20px;border:0;border-radius:2em;margin-top:10px;-webkit-transition:.5s;transition:.5s;width:160px;cursor:pointer}footer .footer-wrapper .column_3 .suscribirse-mail{background:#fff;color:#3844bc}.viajar-wrapper-index .salioviaje .button-agendar i,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .sub-section h3 i,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .title i,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .sub-section h3 i,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .title i,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .sub-section h3 i,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .title i,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .sub-section h3 i,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .title i,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .button-viajar i,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_5 .button-viajar i,footer .footer-wrapper .column_3 .suscribirse-mail i,footer .footer-wrapper .column_3 .suscrito-mail i{margin-right:5px}footer .footer-wrapper .column_3 .suscribirse-mail:hover{-webkit-transform:scale(1.1);transform:scale(1.1);background-color:#3844bc;color:#fff}footer .footer-wrapper .column_3 .suscrito-mail{display:none;background:#85e992;color:#fff}#pre-loader,footer .totum{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center}footer .totum{width:100%;min-height:30px;background-color:#2b3179}footer .totum p{color:#fff;font-weight:300;text-align:center;margin:5px 0}footer .totum p a{text-decoration:none;color:#858ee9}@media screen and (max-width:1100px){footer .footer-wrapper{-ms-grid-columns:1fr;grid-template-columns:1fr}footer .footer-wrapper .column_1,footer .footer-wrapper .column_2,footer .footer-wrapper .column_3{max-width:400px;width:100%;margin:20px auto}}#pre-loader{position:fixed;top:0;left:0;z-index:60;width:100vw;height:100vh;background-color:#3844bc;-webkit-clip-path:circle(150% at 100% 0);clip-path:circle(150% at 100% 0);-webkit-transition:-webkit-clip-path .5s ease-in-out;transition:clip-path .5s ease-in-out;transition:clip-path .5s ease-in-out,-webkit-clip-path .5s ease-in-out}#pre-loader .lds-ellipsis{display:inline-block;position:relative;width:80px;height:80px}#pre-loader .lds-ellipsis div{position:absolute;top:33px;width:13px;height:13px;border-radius:50%;background:#fff;-webkit-animation-timing-function:cubic-bezier(0,1,1,0);animation-timing-function:cubic-bezier(0,1,1,0)}#pre-loader .lds-ellipsis div:nth-child(1){left:8px;-webkit-animation:lds-ellipsis1 .6s infinite;animation:lds-ellipsis1 .6s infinite}#pre-loader .lds-ellipsis div:nth-child(2),#pre-loader .lds-ellipsis div:nth-child(3){left:8px;-webkit-animation:lds-ellipsis2 .6s infinite;animation:lds-ellipsis2 .6s infinite}#pre-loader .lds-ellipsis div:nth-child(3){left:32px}#pre-loader .lds-ellipsis div:nth-child(4){left:56px;-webkit-animation:lds-ellipsis3 .6s infinite;animation:lds-ellipsis3 .6s infinite}#pre-loader.load{-webkit-clip-path:circle(0 at 100% 0);clip-path:circle(0 at 100% 0)}.viajar-wrapper-index{margin-top:0}.viajar-wrapper-index .title{text-align:center;margin:10px 20px;color:#2b3179;font-size:2.6em}.viajar-wrapper-index .salioviaje{margin:20px auto 40px;padding:0 20px;max-width:1300px;width:100%;text-align:center}.viajar-wrapper-index .salioviaje h2 .icon{color:#333}.viajar-wrapper-index .salioviaje h3{color:#555;font-size:16px;font-weight:500}.viajar-wrapper-index .salioviaje .button-agendar{position:relative;z-index:10;background:-webkit-gradient(linear,left top,right top,from(#3844bc),to(#2b3179));background:linear-gradient(to right,#3844bc,#2b3179);color:#fff;padding:15px 20px;border:0;border-radius:2em;margin-top:10px;-webkit-transition:.5s;transition:.5s;cursor:pointer}.viajar-wrapper-index .salioviaje .salioviaje-desplegable{padding:0 18px;max-height:0;-webkit-transition:.6s ease-in-out;transition:.6s ease-in-out;opacity:0;position:relative;z-index:5;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje{margin-top:15px;width:100%}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .progress-bar,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .user-info{max-width:600px;width:100%;margin:20px auto 0;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .user-info .user-icon{width:80px;height:80px;border-radius:50%;background-color:#3844bc;padding:10px;margin-right:10px}.viajar-wrapper-index .salioviaje .salioviaje-desplegable,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .user-info .info{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .user-info .info{-webkit-box-align:start;-ms-flex-align:start;align-items:flex-start}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .progress-bar{position:relative;width:90%;height:15px;text-align:center}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .progress-bar .line{position:relative;width:100%;height:5px;border-radius:2em;background-color:#aaa}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .progress-bar .progress{position:absolute;left:0;width:0%;height:5px;border-radius:2em;background:-webkit-gradient(linear,left top,right top,from(#3844bc),to(#2b3179));background:linear-gradient(to right,#3844bc,#2b3179);-webkit-transition:.8s;transition:.8s}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .progress-bar .circle1{width:15px;height:15px;border-radius:50%;position:absolute;left:0}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .progress-bar .circle2,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .progress-bar .circle3{width:15px;height:15px;border-radius:50%;background-color:#aaa;position:absolute;left:0}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .progress-bar .circle1{background-color:#3844bc}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .progress-bar .circle2{left:calc(50% - 10px)}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .progress-bar .circle3{left:calc(100% - 10px)}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .title,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .title,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .title,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .title{font-size:1.5em;margin:20px 0;color:#3844bc;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_1 .info,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .info,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .info{color:#3844bc;margin:20px 0 0}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_1 .input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .input{position:relative;width:300px;margin:30px auto}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_1 .input select,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input select,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input select,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input select,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input select,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .input input{width:100%;height:40px;background-color:transparent;border:0;border-bottom:1px solid #aaa;outline:0;padding-left:25px;color:#555;font-size:.85em;resize:vertical}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input textarea,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input textarea,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input textarea,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input textarea{width:100%;height:40px;background-color:transparent;border:0;border-bottom:1px solid #aaa;outline:0;color:#555;font-size:.85em;resize:vertical}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input textarea,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .input textarea,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input textarea,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .input textarea{padding:10px 0}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_1 .input .icon,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .input .icon,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .input .icon{position:absolute;top:10px;left:0;color:#555}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .paradas-wrapper{max-width:750px;width:100%;margin:10px auto;display:-ms-grid;display:grid;-ms-grid-columns:1fr 1fr;grid-template-columns:1fr 1fr;gap:20px}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .paradas-wrapper{display:block;margin:20px auto}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .sub-section,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .sub-section,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .sub-section,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .sub-section{border:1px solid #3844bc;border-radius:10px;padding:20px;margin:10px 0}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .sub-section h3,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .sub-section h3,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .sub-section h3,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .sub-section h3{font-size:20px;color:#3844bc;font-weight:400}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .sub-section hr,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .sub-section hr,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .sub-section hr,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .sub-section hr{border:0;border-bottom:1px solid #aaa}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .paradas-wrapper .input{position:relative;width:300px;margin:30px auto}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input p,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input p,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input p,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input p,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .paradas-wrapper .input p{margin:0;text-align:left;color:#3844bc}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input p .obligatorio,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input p .obligatorio,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input p .obligatorio,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input p .obligatorio{color:#ff5353;font-size:20px}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid .input select,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid .input select,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid .input select,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input input,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid .input select,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .paradas-wrapper .input input{width:100%;height:40px;background-color:transparent;border:0;border-bottom:1px solid #aaa;outline:0;color:#555;font-size:.85em;padding:0;margin:0}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .tags{width:calc(100% - 40px);background-color:#eee;border-radius:10px;margin:0 auto;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-ms-flex-wrap:wrap;flex-wrap:wrap}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_4 .send-wrapper,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_5 .send-wrapper{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;width:100%;text-align:center;margin-top:60px}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_5 .send-wrapper .send-icon i{color:#70ff7c;font-size:3em}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_4 .send-wrapper .sending-icon{-webkit-animation:spinner 1s infinite forwards linear;animation:spinner 1s infinite forwards linear}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_4 .send-wrapper .sending-icon i{font-size:3em;color:#3844bc}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_5 .send-wrapper .send-info h2{font-size:1.2em;color:#3844bc}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_5 .send-wrapper .send-info p{color:#555;font-size:.9em;margin-top:10px}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .button-viajar,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_5 .button-viajar{background:-webkit-gradient(linear,left top,right top,from(#3844bc),to(#2b3179));background:linear-gradient(to right,#3844bc,#2b3179);color:#fff;padding:15px 20px;border:0;border-radius:2em;-webkit-transition:.5s;transition:.5s;cursor:pointer;margin:0 5px}#faq-float:hover,#whatsapp-float:hover,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .button-viajar:hover,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_5 .button-viajar:hover{-webkit-transform:scale(1.1);transform:scale(1.1)}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .mensaje-error,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .mensaje-error,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .mensaje-error,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .mensaje-error{color:#ff635a;margin-bottom:20px}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .loader_step3{width:100%;height:200px;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_3 .loader_step3 #spinner{font-size:2em;color:#555;-webkit-animation:spinner 2s infinite linear forwards;animation:spinner 2s infinite linear forwards}.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_5 .send-wrapper .send-info button{margin-top:20px}@media screen and (max-width:680px){.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_fiestas .formulario-grid,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_tour .formulario-grid,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_transfer .formulario-grid,.viajar-wrapper-index .salioviaje .salioviaje-desplegable .formulario-viaje .step_2_traslado .formulario-grid{-ms-grid-columns:1fr;grid-template-columns:1fr;gap:0}}@media screen and (max-width:630px){.viajar-wrapper-index .salioviaje p{font-size:14px}}#whatsapp-float{position:fixed;z-index:20;bottom:20px;right:20px;width:60px;height:60px;border-radius:50%;background:#50c450;padding:13px;-webkit-transition:.3s;transition:.3s;text-decoration:none}#faq-float,#flotant-promo .promo-content .promo-icon{border-radius:50%;display:-webkit-box;display:-ms-flexbox;display:flex}#faq-float{position:fixed;z-index:20;bottom:100px;right:20px;width:60px;height:60px;background:#3844bc;padding:13px;-webkit-transition:.3s;transition:.3s;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;text-decoration:none;border:5px solid #6d76db}#faq-float i{font-size:2em;color:#fff;margin:0}#flotant-promo,#modal{position:fixed;left:0;z-index:50}#modal{width:100%;height:100vh;top:0;background-color:rgba(0,0,0,.2);display:none;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}#flotant-promo{top:80px;width:300px;min-height:80px;background-color:#fff;-webkit-box-shadow:5px 3px 10px 0 rgba(0,0,0,.5);box-shadow:5px 3px 10px 0 rgba(0,0,0,.5);opacity:0;-webkit-transform:translateX(-150%);transform:translateX(-150%);display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start;-webkit-transition:1s ease all;transition:1s ease all}#flotant-promo .close{position:absolute;left:7px;top:7px;width:20px;height:20px;background:0 0;border:0;color:#555;cursor:pointer;-webkit-transition:.2s;transition:.2s;z-index:2}#flotant-promo,#flotant-promo .promo-content{-webkit-box-align:center;-ms-flex-align:center;align-items:center;border-radius:0 4em 4em 0}#flotant-promo .promo-content{height:100%;text-decoration:none}#flotant-promo .promo-content .promo-icon{width:70px;height:70px;background-color:#3844bc;margin:0 10px}#flotant-promo .promo-content .promo-icon .icon{margin:auto;font-size:2em;color:#fff}#flotant-promo .promo-content,#flotant-promo .promo-content .promo-body{width:100%;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}#flotant-promo .promo-content .promo-body{max-width:210px;padding:10px 10px 10px 30px;-webkit-box-align:start;-ms-flex-align:start;align-items:flex-start;text-align:left;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}#flotant-promo .promo-content .promo-body p{color:#555;font-size:.8em}*{margin:0;padding:0;-webkit-box-sizing:border-box;box-sizing:border-box;font-family:"Montserrat","sans-serif"}::-webkit-scrollbar{width:10px;height:10px}::-webkit-scrollbar-track{background:#fff}::-webkit-scrollbar-thumb{background:#3844bc;border-radius:1em}::-webkit-scrollbar-thumb:hover{background:#2b3179}html{scroll-behavior:smooth}input::-webkit-inner-spin-button,input::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}input[type=number]{-moz-appearance:textfield}body{background-color:#fff}
    </style>

    <!-- <link rel="stylesheet" href="https://www.salioviaje.com.uy/styles/styles.min.css" media='all'> -->
    <link rel="shortcut icon" href="https://www.salioviaje.com.uy/media/svg/Favicon-SalioViaje.svg" type="image/x-icon">
    <link rel="publisher" href="https://www.salioviaje.com.uy" />
    <link rel="canonical" href="https://www.salioviaje.com.uy"/>
    <!-- Scripts -->

    <script defer src="https://www.salioviaje.com.uy/Plugins/JQuery/jquery.min.js"></script>
    <script defer src="Javascript/web.min.js"></script>
    <script defer src="Javascript/viajar.min.js"></script>
    <script rel="preconnect" src="https://www.salioviaje.com.uy/Plugins/OneSignal/OneSignalSDK.js" async></script>
    <script defer src="https://kit.fontawesome.com/1e193e3a23.js" crossorigin="anonymous"></script>    
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
                        <img loading="lazy" src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="Logo SalióViaje" title="Home | Salió Viaje" width="60" height="60"/></a>
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

                            <img loading="lazy" src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="Logo | SalióViaje" title="Home | SalióViaje"width="60" height="60"/>

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
              <img class="" srcset="media/images/Van2_3_Small.webp 700w, media/images/Van2_3.webp 1000w" src="media/images/Van2_3_Small.webp" alt="Promo lanzamiento Buenos Aires" title="Promo lanzamiento Buenos Aires | Salió Viaje"
              />
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
                <img loading="lazy"
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
                <img loading="lazy"
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
                <img loading="lazy"
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
                <img loading="lazy"
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
                  <img loading="lazy" src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje-White.svg" alt="Logo SalióViaje" title="Logo-SalioViaje | Salió Viaje">
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
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad</p>
                      <input list="Localidad" id="localidad_traslado_destino">
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
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_tour" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">

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
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_transfer_in" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">

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
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_transfer_out" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">

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
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_fiestas_ida" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">

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
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_fiesta_vuelta" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">

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
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_ida_origen_fiestas_idavuelta" onchange="rellenar('Localidad_Origen')" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">

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
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad</p>
                      <input list="Localidad" id="localidad_ida_destino_fiestas_idavuelta" onchange="rellenar('Localidad_Destino')">

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
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad</p>
                      <input list="Localidad" id="localidad_vuelta_origen_fiestas_idavuelta">

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
                    </div>

                    <div class="input">
                      <p><i class="fa-solid fa-globe"></i> Localidad <span class="obligatorio">*</span></p>
                      <input list="Localidad" id="localidad_vuelta_destino_fiestas_idavuelta" value="<?php echo $_SESSION['datos_usuario']['DEPARTAMENTO']; ?>">

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
