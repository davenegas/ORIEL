<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Control de Video</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script language="javascript" src="vistas/js/valida_un_solo_click_en_formulario.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <script>
            var centesimas = 0;
            var segundos = <?php echo $diferenciasegundos; ?>;
            var limite_segundos = <?php echo $vector_puesto_monitoreo_unidad_video[0]['Tiempo_Personalizado_Revision'];?>;
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
            $(document).ready(function() {
                $(".fancybox-button").fancybox({
                    prevEffect		: 'none',
                    nextEffect		: 'none',
                    closeBtn		: false,
                    helpers		: {
                        title	: { type : 'inside' },
                        buttons	: {}
                    }
                });
            });
            
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
            
            //Funcion para ocultar ventana de mantenimiento de proveedor
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_1').style.display = "none";
            }
            
             //Valida informacion completa de formulario de proveedor
            function check_empty() {
                var str=document.getElementById('txt_retraso').value.trim();
                if (str =="") {
                    alert("Una justificación del retraso es requerida para continuar!!!");
                } else {
                        if (str.length >14) {
                        //alert (document.getElementById('txt_retraso').value + document.getElementById('id_bitacora_revision_actual').value);
                        document.getElementById('ventana').submit();
                        document.getElementById('ventana_oculta_1').style.display = "none";                        
                        //document.location.href="index.php?ctl=controles_de_video_listar";
                        }else{
                            alert("Debe detallar correctamente la justificación del retraso!!!");
                        }
                }
            }
            
             //Valida informacion completa de formulario de proveedor
            function no_justificar() {
               
                        document.getElementById('ventana_oculta_1').style.display = "none";                        
                        document.location.href="index.php?ctl=controles_de_video_listar";
                      
            }
            
             //Funcion para agregar un nuevo tipo de telefono- formulario en blanco
            function mostrar_justificar_atraso_en_revision(id_revis,id_puesto) {
                document.getElementById('id_bitacora_revision_actual').value=id_revis;
                document.getElementById('id_puesto_justificacion').value=id_puesto;
                
                //document.getElementById('txt_retraso').value=null;
                document.getElementById('ventana_oculta_1').style.display = "block";
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
                        //alert(segundos);
                        if (segundos<0){
                            //alert(segundos);
                            segundos=0;
                        }
                            segundos ++;
                            //segundos=segundos+10;
                            if (segundos < 10) { segundos = "0"+segundos }
                            Segundos.innerHTML = segundos;
                    }
                    if(segundos>limite_segundos){
                        document.getElementById("Segundos").style.color="red";
                    }else{
                        document.getElementById("Segundos").style.color="black";
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
                        if(segundos>limite_segundos){
                             document.getElementById("Segundos").style.color="red";
                        }else{
                             document.getElementById("Segundos").style.color="black";
                        }
                        }); 
            }

            function guarda_revision_de_video_actual(id_revis,fecha_ini,hora_ini,tiem,id_control_puesto,id_puesto,pos){
               //alert(segundos);
                if (segundos<6){
                     $.confirm({
                        title: 'Confirmación!',
                        content: 'Recuerde tomarse el tiempo necesario para revisar el video actual. Desea registrar esta revisión con este tiempo?',
                        confirm: function(){
                             if (enviado()==true){

                                var req_mantenimiento;
                                var res_conexion;
                                var rep_situacion="";

                                var mantenimiento=document.getElementsByName("optradiomantenimiento");
                                var conex=document.getElementsByName("optradioconexion");
                                // Recorremos todos los valores del radio button para encontrar el
                                // seleccionado
                                for(var i=0;i<mantenimiento.length;i++)
                                {
                                    if(mantenimiento[i].checked)
                                        req_mantenimiento=mantenimiento[i].value;
                                }

                                for(var i=0;i<conex.length;i++)
                                {
                                    if(conex[i].checked)
                                        res_conexion=conex[i].value;
                                }

                                rep_situacion=document.getElementById("txt_situacion").value;

                                $.post("index.php?ctl=guarda_revision_de_video_actual", {id_revis: id_revis,req_mantenimiento:req_mantenimiento,res_conexion:res_conexion,rep_situacion:rep_situacion,fecha_ini:fecha_ini,hora_ini:hora_ini,tiem:tiem,id_control_puesto:id_control_puesto,id_puesto:id_puesto,pos:pos},function(data){
                                            //alert(data);
                                            var srt = data;
                                            var n= srt.search("on_time");
                                           //alert(data);
                                            if(n>0){
                                                document.location.href="index.php?ctl=controles_de_video_listar";
                                            }else{
                                                n= srt.search("no_asignado");
                                                if(n>0){
                                                    document.location.href="index.php?ctl=controles_de_video_listar";
                                                }else{
                                                    n= srt.search("retraso");
                                                    if(n>0){
                                                         mostrar_justificar_atraso_en_revision(id_revis,id_puesto);
                                                    }else{
                                                        n= srt.search("revision_cerrada");
                                                        if(n>0){
                                                            document.location.href="index.php?ctl=controles_de_video_listar";
                                                        }else{
                                                            n= srt.search("justificado");
                                                            if(n>0){
                                                                 document.location.href="index.php?ctl=controles_de_video_listar";
                                                            }
                                                            
                                                        }
                                                    }
                                                    
                                                }
                                                
                                            }
                                });
                            } 

                        },
                        cancel: function(){

                        }
                    });
                    
                }else{
                    if (enviado()==true){

                                var req_mantenimiento;
                                var res_conexion;
                                var rep_situacion="";

                                var mantenimiento=document.getElementsByName("optradiomantenimiento");
                                var conex=document.getElementsByName("optradioconexion");
                                // Recorremos todos los valores del radio button para encontrar el
                                // seleccionado
                                for(var i=0;i<mantenimiento.length;i++)
                                {
                                    if(mantenimiento[i].checked)
                                        req_mantenimiento=mantenimiento[i].value;
                                }

                                for(var i=0;i<conex.length;i++)
                                {
                                    if(conex[i].checked)
                                        res_conexion=conex[i].value;
                                }

                                rep_situacion=document.getElementById("txt_situacion").value;

                                 $.post("index.php?ctl=guarda_revision_de_video_actual", {id_revis: id_revis,req_mantenimiento:req_mantenimiento,res_conexion:res_conexion,rep_situacion:rep_situacion,fecha_ini:fecha_ini,hora_ini:hora_ini,tiem:tiem,id_control_puesto:id_control_puesto,id_puesto:id_puesto,pos:pos},function(data){
                                            var srt = data;
                                            var n= srt.search("on_time");
                                           //alert(data);
                                            if(n>0){
                                                document.location.href="index.php?ctl=controles_de_video_listar";
                                            }else{
                                                n= srt.search("no_asignado");
                                                if(n>0){
                                                    document.location.href="index.php?ctl=controles_de_video_listar";
                                                }else{
                                                    n= srt.search("retraso");
                                                    if(n>0){
                                                         mostrar_justificar_atraso_en_revision(id_revis,id_puesto);
                                                    }else{
                                                        n= srt.search("revision_cerrada");
                                                        if(n>0){
                                                            document.location.href="index.php?ctl=controles_de_video_listar";
                                                        }else{
                                                            n= srt.search("justificado");
                                                            if(n>0){
                                                                 document.location.href="index.php?ctl=controles_de_video_listar";
                                                            }
                                                            
                                                        }
                                                    }
                                                    
                                                }
                                                
                                            }
                                });
                            } 
                }
            }
            
             function liberar_puesto_de_monitoreo(id_puesto){
                
           
                 $.confirm({
                    title: 'Confirmación!',
                    content: 'Desea liberar el puesto de monitoreo?',
                    confirm: function(){
                        $.post("index.php?ctl=liberar_puesto_de_monitoreo", {id_puesto: id_puesto},function(data){
                            var srt = data;
                            var n= srt.search("liberado");
                           
                            if(n>0){
                                $.alert({
                                    title: 'Información!',
                                    content: 'Puesto liberado correctamente!!!',
                                });
                                //location.reload();
                                document.location.href="index.php?ctl=puestos_de_monitoreo_listar";
                            }else{
                                //alert(data);
                                alert("No fue posible liberar este puesto de monitoreo!!!Contacte a su Supervisor.");
                            }
                        });  
                    
                    },
                    cancel: function(){
              
                    }
                });
           
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
        <div class="container animated fadeIn col-xs-10 quitar-float" style="text-align:center">
            <h2 style="text-align:center">Control de Video <?php echo $vector_puesto_de_monitoreo_actual[0]['Nombre'];?></h2>
            <h4 style="text-align:center">Unidad de Video Actual: <?php echo $vector_informacion_unidad_video[0]['Descripcion'];?> (<?php echo $vector_punto_bcr[0]['Codigo'];?>) </h4>
            <h4><a href="#" onclick="liberar_puesto_de_monitoreo('<?php echo $vector_revision_de_video_actual[0]['ID_Puesto_Monitoreo'];?>');">
            Liberar Puesto de Monitoreo</a></h4>
                <!--<p>A continuación se detallan los diferentes puestos de monitoreo registrados en el sistema:</p>-->            
               <table id="myTable" class="table table-hover" style="text-align:center">
                  <tbody>
                  <tr style="text-align:center" align="center">
                      <td colspan="2"><h4><b>Tiempo invertido(segundos):</b></h4></td>
                        <td style="text-align:center" align="center">                      
                            <!--<div id="contenedor">-->
                            <div hidden="hidden" class="reloj" id="Horas">00</div>
                            <div hidden="hidden" class="reloj" id="Minutos">:00</div>
                            <div class="reloj" id="Segundos"></div>
                            <div hidden="hidden" class="reloj" id="Centesimas">:00</div>
                            <input hidden="hidden" type="button" class="boton" id="inicio" value="Start &#9658;" onclick="inicio();">
                            <input hidden="hidden" type="button" class="boton" id="parar" value="Stop &#8718;" onclick="parar();" disabled>
                            <input hidden="hidden" type="button" class="boton" id="continuar" value="Resume &#8634;" onclick="inicio();" disabled>
                            <input hidden="hidden" type="button" class="boton" id="reinicio" value="Reset &#8635;" onclick="reinicio();" disabled>
                            <!--</div>-->                       
                        </td>
                        <td style="text-align:center" align="center"><h4><b>Tiempo Estimado para revisión (segundos):</b> <?php echo $vector_puesto_monitoreo_unidad_video[0]['Tiempo_Personalizado_Revision'];?> </h4></td>  
                  </tr>
                  
                  <tr style="text-align:center" align="center">
                    
                      <td><h4><b>Punto BCR Asociado: </b><?php echo $vector_punto_bcr[0]['Nombre'];?></h4></td>
                      <td><h4><b>Tipo Punto:</b><?php echo $vector_punto_bcr[0]['Tipo_Punto'];?></h4></td>  
                      <td><h4><b>Cantidad de Cámaras:</b><?php echo $vector_informacion_unidad_video[0]['Camaras_Habilitadas'];?></h4></td> 
                      <td><h4><a target="_blank" href="index.php?ctl=gestion_punto_bcr&id=
                                <?php echo $vector_punto_bcr[0]['ID_PuntoBCR']?>">Ir al Sitio</a></h4>
                      </td>
                  </tr>
                  
                  <tr style="text-align:center" align="center">
                    
                      <td><h4><b>Estado Conexión: </b>
                              <input type="radio" name="optradioconexion" checked="true" value="0">Positiva
                              <input type="radio" name="optradioconexion" value="1">Negativa
                              <input type="radio" name="optradioconexion" value="2">No Despliega
                          </h4>
                          
                      </td>
                      <td><h4><b>Mantenimiento:</b>
                              <input type="radio" name="optradiomantenimiento" value="1">Si
                              <input type="radio" name="optradiomantenimiento" checked="true" value="0">No</h4>
                      </td>
                      <td><h4><b>Reportar Situación a Z2:</b>
                              
                      </td>
                       <td>
                           <input type="text" name="txt_situacion" id="txt_situacion" class="form-control">
                           
                      </td>
                  </tr>
                  
                  </tbody> 
              </table>
            <div >
           <a  href="#" class="btn btn-default" role="button" onclick="guarda_revision_de_video_actual('<?php echo $vector_revision_de_video_actual[0]['ID_Bitacora_Revision_Video'];?>','<?php echo $vector_revision_de_video_actual[0]['Fecha_Inicia_Revision'];?>','<?php echo $vector_revision_de_video_actual[0]['Hora_Inicia_Revision'];?>','<?php echo $vector_puesto_monitoreo_unidad_video[0]['Tiempo_Personalizado_Revision'];?>','<?php echo $vector_revision_de_video_actual[0]['ID_Bitacora_Control_Puesto_Monitoreo'];?>','<?php echo $vector_revision_de_video_actual[0]['ID_Puesto_Monitoreo'];?>','<?php echo $vector_revision_de_video_actual[0]['Posicion'];?>');">Registrar Revisión</a>
            </div>
            
      
          <br> <br> <br>
          <div align="center">
              <img align="center" src="../../../Padron_Fotografico_Unidades_Video/<?php echo $vector_padron_fotografico[0]['Nombre_Ruta'];?>" alt="" width="1000px" class="img-responsive" alt="Cinque Terre"> 
          </div>
          <br> 
          <h4 style="float:right;"><b><?php echo $vector_informacion_unidad_video_siguiente[0]['Descripcion'];?> (<?php echo $vector_punto_bcr_siguiente[0]['Codigo'];?>)>></b></h4>
          <br><br><br>
            <table id="tabla" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>  
                        <th style="text-align:center">Categoría</th>
                        <th style="text-align:center">Nombre Imágen</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Imágen</th>
                      
                        <th style="text-align:center" hidden="hidden">Nombre Ruta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tam=count($vector_padron_fotografico);

                    for ($i = 0; $i <$tam; $i++) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $vector_padron_fotografico[$i]['Categoria_Nombre'];?></td>
                            <td style="text-align:center"><?php echo $vector_padron_fotografico[$i]['Nombre_Imagen'];?></td>
                            <td style="text-align:center"><?php echo $vector_padron_fotografico [$i]['Descripcion'];?></td>
                            <td style="text-align:center"><a class="fancybox-button" rel="fancybox-button" href="../../../Padron_Fotografico_Unidades_Video/<?php echo $vector_padron_fotografico[$i]['Nombre_Ruta'];?>" title="<?php echo $vector_padron_fotografico[$i]['Nombre_Imagen'].' ('.$vector_padron_fotografico[$i]['Descripcion'].')';?>">
                                <img src="../../../Padron_Fotografico_Unidades_Video/<?php echo $vector_padron_fotografico[$i]['Nombre_Ruta'];?>" alt="" width="200px"/></a></td>
                           
                            <td style="text-align:center" hidden="hidden"><?php echo $vector_padron_fotografico [$i]['Nombre_Ruta'];?></td>
                        </tr>     
                    <?php } ?>
                </tbody>
            </table>
                <!--<input align="right" type="button" class="boton" id="prue" value="Prueba" onclick="prueba();">-->
        </div>
        
            <!--agregar o editar-->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <!--Formulario para proveedor de enlaces de telecomunicaciones-->
                <form id="ventana" method="POST" name="form" action="index.php?ctl=guarda_justificacion_retraso_control_de_video">
                    <!--<img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">-->
                    <h2 align="center">Justificación por retraso durante la revisión de video:</h2>
                    <hr>
                    
                    <input hidden id="id_bitacora_revision_actual" name="id_bitacora_revision_actual" type="text">
                    <input hidden id="id_puesto_justificacion" name="id_puesto_justificacion" type="text">                    
                    
                    <label for="txt_retraso">Detalle</label>
                    <input class="form-control espacio-abajo" required minlength="15" id="txt_retraso" name="txt_retraso" placeholder="Justifique el Retraso (Minimo 15 caracteres)" type="text">
                    
                    <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                    <button><a href="javascript:%20no_justificar()" id="nojustifica">No Justificar</a></button>
                </form>
            </div>
        <!--Cierre agregar teléfono a Punto BCR-->
        </div>
            
            
                 <div id="ventana_oculta_6">
            <div id="popupventana2">
                <div id="ventana2">
                <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla4" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="text-align:center"></th>
                            <th style="text-align:center">Nombre</th>
                            <th style="text-align:center">Tipo</th>
                            <th style="text-align:center">Provincia</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tama=count($unidades_video_sin_puesto_monitoreo);
                        for ($i = 0; $i <$tama; $i++) { ?>  
                        <tr>
                            <td style="text-align:center"><?php echo $unidades_video_sin_puesto_monitoreo[$i]['Nombre'];?></td>
                            <td style="text-align:center"><?php echo $unidades_video_sin_puesto_monitoreo[$i]['Nombre_Provincia'];?></td>
                            <td style="text-align:center"><?php echo $unidades_video_sin_puesto_monitoreo[$i]['Descripcion'];?></td>
                            <td style="text-align:center"><?php echo $unidades_video_sin_puesto_monitoreo[$i]['Camaras_Habilitadas'];?></td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                </div>
            </div>
        <!--Cierre Asignar UE a Punto BRC-->
        </div> 
       <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>
