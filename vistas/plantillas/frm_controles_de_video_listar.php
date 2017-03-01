<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Control de Video</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <script>
            var centesimas = 0;
            var segundos = <?php echo $diferenciasegundos; ?>;
            var minutos = 0;
            var horas = 0;
            function inicio () {
                    control = setInterval(cronometro,10);
                    document.getElementById("inicio").disabled = true;
                    document.getElementById("parar").disabled = false;
                    document.getElementById("continuar").disabled = true;
                    document.getElementById("reinicio").disabled = false;
            }
            function parar () {
                    clearInterval(control);
                    document.getElementById("parar").disabled = true;
                    document.getElementById("continuar").disabled = false;
            }
            function reinicio () {
                    clearInterval(control);
                    centesimas = 0;
                    segundos = 0;
                    minutos = 0;
                    horas = 0;
                    Centesimas.innerHTML = ":00";
                    Segundos.innerHTML = ":00";
                    Minutos.innerHTML = ":00";
                    Horas.innerHTML = "00";
                    document.getElementById("inicio").disabled = false;
                    document.getElementById("parar").disabled = true;
                    document.getElementById("continuar").disabled = true;
                    document.getElementById("reinicio").disabled = true;
            }
            function cronometro () {
                    if (centesimas < 99) {
                            centesimas++;
                            if (centesimas < 10) { centesimas = "0"+centesimas }
                            Centesimas.innerHTML = ":"+centesimas;
                    }
                    if (centesimas == 99) {
                            centesimas = -1;
                    }
                    if (centesimas == 0) {
                            segundos ++;
                            //segundos=segundos+10;
                            if (segundos < 10) { segundos = "0"+segundos }
                            Segundos.innerHTML = segundos;
                    }
                    //if (segundos == 59) {
                    //	segundos = -1;
                    //}
            //	if ( (centesimas == 0)&&(segundos == 0) ) {
            //		minutos++;
            //		if (minutos < 10) { minutos = "0"+minutos }
            //		Minutos.innerHTML = ":"+minutos;
            //	}
            //	if (minutos == 59) {
            //		minutos = -1;
            //	}
            //	if ( (centesimas == 0)&&(segundos == 0)&&(minutos == 0) ) {
            //		horas ++;
            //		if (horas < 10) { horas = "0"+horas }
            //		Horas.innerHTML = horas;
            //	}
            }
        </script>
        <script>
            $(document).ready(function () {
                   //alert("Hola"); 
                   inicio();
                   //alert(<?php echo $diferenciasegundos; ?>);
                });
                
            function actualiza_segundero_en_pantalla(){
                   var fecha_inicio= '<?php echo $fechaInicialRevision;?>';
                   $.post("index.php?ctl=actualiza_segundero_revision_video",{fecha_inicio: fecha_inicio},function(data){
                        var a=data.replace(/\D/g,''); 
                        segundos=parseInt(a);
                        }); 
            }

            function prueba(){
//                alert(Segundos.innerHTML);
            }
        </script>
        <style>
            
            *{
                margin: 0;
                padding: 0;
            }
            #contenedor{
                    margin: 10px auto;
                    width: 540px;
                    height: 115px;
            }
            .reloj{
                    float: left;
                    font-size: 20px;
                    font-family: Courier,sans-serif;
                    color: #363431;
            }
            .boton{
                    outline: none;
                    border: 1px solid #363431;
                    color: white;
                    width: 128px;
                    height: 30px;
                    text-shadow: 0px -1px 1px black;
                    font-size: 20px;
                    border-radius: 5px;
                    font-family: Helvetica;
                    cursor: pointer;
                    background-image: linear-gradient(#3aad02,#2c6f05);
            }
            .boton:active{
                    background-image: linear-gradient(#2c6f05,#3aad02);
            }
            .boton:hover{
                    box-shadow: 0px 0px 14px #3aad02;
            }
        </style>
    </head>
    <!--<body onfocus='javascript:location.reload()'>-->
    <body onfocus="actualiza_segundero_en_pantalla();">
    <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn col-xs-10 quitar-float">
            <h2 style="text-align:center">Control de Video <?php echo $vector_puesto_de_monitoreo_actual[0]['Nombre'];?></h2>
            <h4 style="text-align:center">Unidad de Video Actual: <?php echo $vector_informacion_unidad_video[0]['Descripcion'];?> (<?php echo $vector_punto_bcr[0]['Codigo'];?>) </h4>
                <!--<p>A continuación se detallan los diferentes puestos de monitoreo registrados en el sistema:</p>-->            
               <table id="myTable" class="table table-hover">
                  <tbody>
                  <tr>
                      <td><h4>Tiempo invertido(segundos):</h4></td>
                        <td>                      
                            <div id="contenedor">
                            <div hidden="hidden" class="reloj" id="Horas">00</div>
                            <div hidden="hidden" class="reloj" id="Minutos">:00</div>
                            <div class="reloj" id="Segundos"></div>
                            <div hidden="hidden" class="reloj" id="Centesimas">:00</div>
                            <input hidden="hidden" type="button" class="boton" id="inicio" value="Start &#9658;" onclick="inicio();">
                            <input hidden="hidden" type="button" class="boton" id="parar" value="Stop &#8718;" onclick="parar();" disabled>
                            <input hidden="hidden" type="button" class="boton" id="continuar" value="Resume &#8634;" onclick="inicio();" disabled>
                            <input hidden="hidden" type="button" class="boton" id="reinicio" value="Reset &#8635;" onclick="reinicio();" disabled>
                            </div>                       
                        </td>
                        <td><h4>Tiempo Estimado para revisión (segundos): <?php echo $vector_puesto_monitoreo_unidad_video[0]['Tiempo_Personalizado_Revision'];?> </h4></td>  
                  </tr>

                  </tbody> 
              </table>
                <!--<input align="right" type="button" class="boton" id="prue" value="Prueba" onclick="prueba();">-->
        </div>
       <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>
