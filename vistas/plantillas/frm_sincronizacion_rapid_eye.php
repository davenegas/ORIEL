<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Sincronización Base de Datos Rapid Eye/Unidades de Video</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script language="javascript" src="vistas/js/valida_un_solo_click_en_formulario.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <script>
            //Funcion para ocultar ventana de Gerentes
            function ocultar_elemento1(){
                document.getElementById('ventana_oculta_1').style.display = "none";
            }
            //Funcion chequeo editar
            function check_empty() {
                if (document.getElementById('nombre').value =="") {
                    alert("Digita el nombre!");
                } else {
                    document.getElementById('ventana').submit();
                    document.getElementById('ventana_oculta_1').style.display = "none";
                }
            }
            //Funcion para editar informacion de Gerente
            function editar_gerente(id_gz,nomb,zona,obser){
                document.getElementById('ID_Gerente_Zona').value=id_gz;
                document.getElementById('nombre').value=nomb;
                document.getElementById('zona_gerencia').value=zona;
                document.getElementById('observaciones').value=obser; 
                document.getElementById('ventana_oculta_1').style.display = "block";
            }
            //Funcion para agregar un nuevo Gerente 
            function ocultar_elemento2(){
                //document.getElementById('ventana_oculta_2').style.display = "none";
                document.getElementById('ventana_oculta_4').style.display = "none";
            }
            //Funcion chequeo guardar 
            function check_empty_G() {
                if (document.getElementById('nombre2').value =="") {
                    alert("Digita el nombre!");
                } else {
                    //alert("Form Submitted Successfully...");
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana2').submit();
                    document.getElementById('ventana_oculta_2').style.display = "none";
                }
            }
            function actualizar_serie(nom,serie) {
             
                document.getElementById('nombre_grabador').value=nom;
                document.getElementById('serie_grabador').value=serie;
                document.getElementById('label_nombre_grabador').innerHTML="Trabajando actualmente con: "+nom+", número de serie: "+serie;
                document.getElementById('ventana_oculta_4').style.display = "block";
            }
            
            function actualizar_unidad_de_video(id_uni){
                $.confirm({
                    title: 'Confirmación!',
                    content: 'Desea actualizar esta unidad de video con los datos de Rapid Eye?',
                    confirm: function(){
                        nom=document.getElementById('nombre_grabador').value;
                        serie=document.getElementById('serie_grabador').value;
                        id=id_uni;
                        $.post("index.php?ctl=actualizar_serie_y_descripcion_en_unidad_de_video", { id_uni: id,nom:nom,serie:serie },function(data){
                            $.alert({
                                title: 'Información!',
                                content: 'Unidad de video actualizada correctamente!!! Volviendo a la página principal actualizada... Espere!!!',
                            });
                            setTimeout("location.reload();",2000);
                              
                            
                        });  
                    },
                    cancel: function(){
                    }
                });
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Actualizar Base de Datos en Servidor de ORIEL</h2>
            
            <h3>Seleccionar Archivo:</h3>
            <form class="form-horizontal" role="form" enctype="multipart/form-data" onSubmit="return enviado()" method="POST" action="index.php?ctl=subir_bd_rapid_al_servidor">
                <div class="col-xs-12 quitar-float espacio-abajo">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                    <input type="file" name="seleccionar_archivo" id="seleccionar_archivo" class="btn btn-default">
                </div>   
               
                <button type="submit" class="btn btn-default">Enviar Información</button>
            </form>
            
            <?php if ($params==null){ ?>
                <h2 align="center">Por favor cargue la bd RemCentral4.mdb al servidor. No se encuentra!!!</h2>
            <?php }else{ ?>
            
            <h2 align="center">Comparativa General entre Rapid Eye BD/Oriel BD</h2>
            <?php echo $estructura_base_de_datos;?>
            <h2>Números de Serie en Rapid Eye no encontrados en ORIEL</h2>
            <p>A continuación se detallan los números de serie que están registrados en Rapid Eye, pero no en la BD de Oriel. Es posible que haya que eliminar algún sitio fuera de uso de la bd de Rapid Eye o que haya que actualizar un número de serie en la lista de unidades de video de Oriel.</p>            
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align:center">Nombre del Sitio</th>
                        <th style="text-align:center">Número de Serie</th>
                        <th style="text-align:center">Actualizar esta Serie en Oriel</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($vector_series_rapid_no_en_oriel);  
                    for ($i = 0; $i <$tam; $i++) {  ?>
                        <tr align="center">
                            <td><?php echo $vector_series_rapid_no_en_oriel[$i][0];?></td>
                            <td><?php echo $vector_series_rapid_no_en_oriel[$i][1];?></td>
                            <td><a id="popup" onclick="actualizar_serie('<?php echo $vector_series_rapid_no_en_oriel[$i][0];?>','<?php echo $vector_series_rapid_no_en_oriel[$i][1];?>')" class="btn btn-default" role="button">Actualizar Oriel</a></td>
                        </tr>     
                    <?php } ?>
                </tbody>
           </table>
            
           <h2>Nombres de Sitios en Rapid Eye no encontrados en ORIEL (descripción de la unidad de video)</h2>
            <p>A continuación se detallan los nombres de sitios que están registrados en Rapid Eye, pero no en la BD de Oriel (descripción de la unidad de video). Es posible que haya que actualizar nombres y números de serie en la lista de unidades de video de Oriel.</p>            
            <table id="tabla2" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align:center">Nombre del Sitio</th>
                        <th style="text-align:center">Número de Serie</th>
                        <th style="text-align:center">Actualizar este Nombre en Oriel</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($vector_nombres_rapid_no_en_oriel);  
                    for ($i = 0; $i <$tam; $i++) {  ?>
                        <tr align="center">
                            <td><?php echo $vector_nombres_rapid_no_en_oriel[$i][0];?></td>
                            <td><?php echo $vector_nombres_rapid_no_en_oriel[$i][1];?></td>
                            <td><a id="popup" onclick="actualizar_serie('<?php echo $vector_nombres_rapid_no_en_oriel[$i][0];?>','<?php echo $vector_nombres_rapid_no_en_oriel[$i][1];?>')" class="btn btn-default" role="button">Actualizar Oriel</a></td>
                        </tr>     
                    <?php } ?>
                </tbody>
           </table>
            
            <h2>Unidades de video (Oriel) con al menos un campo diferente (número de serie o descripción) de lo encontrado en Rapid Eye</h2>
            <p>A continuación se detallan las unidades de video (Oriel) que tengan al menos una inconsistencia con respecto a Rapid Eye:</p>            
            <table id="tabla4" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align:center">Nombre del Sitio</th>
                        <th style="text-align:center">Número de Serie</th>
                        <th style="text-align:center">Actualizar este Nombre en Oriel</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($vector_inconsistencia_en_registros);  
                    for ($i = 0; $i <$tam; $i++) {  ?>
                        <tr align="center">
                            <td><?php echo $vector_inconsistencia_en_registros[$i][0];?></td>
                            <td><?php echo $vector_inconsistencia_en_registros[$i][1];?></td>
                            <td><a id="popup" onclick="actualizar_serie('<?php echo $vector_inconsistencia_en_registros[$i][0];?>','<?php echo $vector_inconsistencia_en_registros[$i][1];?>')" class="btn btn-default" role="button">Actualizar Oriel</a></td>
                        </tr>     
                    <?php } ?>
                </tbody>
           </table>
            
            
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        <!--editar-->
       
        <div id="ventana_oculta_4">
            <div id="popupventana2">
                <div id="ventana2">
                    <h2 align="center">Actualizar Unidad de Video en Oriel</h2>
                    <p id="label_nombre_grabador" align="center"></p><br>
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento2()"> 
                    <input hidden="true "id="nombre_grabador" name="nombre_grabador" readonly="true" type="text" value="">
                    <input hidden="true" id="serie_grabador" name="serie_grabador" readonly="true" type="text" value="">
                    
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla3" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th hidden="" style="text-align:center">ID Unidad Video</th>
                                <th style="text-align:center">Descripción</th>
                                <th style="text-align:center"># Serie</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($vector_unidades_de_video);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td hidden="" style="text-align:center"><?php echo $vector_unidades_de_video[$i]['ID_Unidad_Video'];?></td>
                                    <td style="text-align:center"><?php echo $vector_unidades_de_video[$i]['Descripcion'];?></td>
                                    <td style="text-align:center"><?php echo $vector_unidades_de_video[$i]['Serie'];?></td>
                                    <td style="text-align:center"><a class="btn" role="button" onclick="actualizar_unidad_de_video('<?php echo $vector_unidades_de_video[$i]['ID_Unidad_Video'];?>');">
                                        Actualizar esta unidad de video</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--Cierre Asignar UE a Punto BRC-->
        </div>
        <?php } ?>
    </body>
</html>

