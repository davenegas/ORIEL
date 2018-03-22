<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Reporte de Eventos</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>    
        <script>
            $(document).ready(function(){
                $("#tipo_punto").change(function () {
                     $("#tipo_punto option:selected").each(function () {
                        id_tipo_punto_bcr = $(this).val();
                        id_provincia=document.getElementById('nombre_provincia').value;
                        $.post("index.php?ctl=actualiza_en_vivo_punto_bcr", { id_tipo_punto_bcr: id_tipo_punto_bcr,id_provincia:id_provincia }, function(data){
                            $("#punto_bcr").html(data);
                        });            
                    });
                });
                $("#nombre_provincia").change(function () {
                    $("#nombre_provincia option:selected").each(function () {
                        id_provincia = $(this).val();
                        id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
                        $.post("index.php?ctl=actualiza_en_vivo_punto_bcr", { id_tipo_punto_bcr: id_tipo_punto_bcr,id_provincia:id_provincia }, function(data){
                            $("#punto_bcr").html(data); 
                        });            
                    });
                });
            });
            
            //Funcion para ocultar ventana de mantenimiento de notas de coordinacion
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_3').style.display = "none";
            }
            
            //Funcion para editar notas de supervisión
            function mostrar_resumen_de_seguimientos(prueb){
                id_e=prueb;
                $.post("index.php?ctl=dibuja_tabla_seguimiento_evento", { id_e: id_e}, function(data){
                    $("#tabla_seguimiento_prueba").html(data); 
                    //console.log(data);
                });
                document.getElementById('ventana_oculta_3').style.display = "block";
            }

            function hacer_click(){
//                $('#cuerpo').html('<center><img align="center" src="vistas/Imagenes/loading.gif"/></center>');
//                $('#cuerpo').html('<center><img align="center" src="vistas/Imagenes/loading.gif"/></center>');

                fecha_inicial=document.getElementById('fecha_inicial').value;
                fecha_final=document.getElementById('fecha_final').value;
                id_punto_bcr=document.getElementById('punto_bcr').value;
                tipo_evento = document.getElementById('tipo_evento').value;
                provincia = document.getElementById('nombre_provincia').value;
                tipo_punto = document.getElementById('tipo_punto').value;

                $.post("index.php?ctl=actualiza_en_vivo_reporte_eventos", {fecha_inicial: fecha_inicial,fecha_final:fecha_final,
                    id_punto_bcr:id_punto_bcr, tipo_evento:tipo_evento, provincia:provincia, tipo_punto:tipo_punto}, function(data){
                        $("#eventos_seguimiento").html(data);
                        generar_reporte();
                });  
                
            }
            
            function generar_reporte(){
                var tmpElemento = document.createElement('a');
                // obtenemos la información desde el div que lo contiene en el html
                // Obtenemos la información de la tabla
                var data_type = 'data:application/vnd.ms-excel;';
                var tabla_div = document.getElementById('eventos_seguimiento');
                var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
                var tabla_html = tabla_html.replace(/á/g, '&aacute;');
                var tabla_html = tabla_html.replace(/é/g, '&eacute;');
                var tabla_html = tabla_html.replace(/í/g, '&iacute;');
                var tabla_html = tabla_html.replace(/ó/g, '&oacute;');
                var tabla_html = tabla_html.replace(/ú/g, '&uacute;');
                var tabla_html = tabla_html.replace(/Á/g, '&Aacute;');
                var tabla_html = tabla_html.replace(/É/g, '&Eacute;');
                var tabla_html = tabla_html.replace(/Í/g, '&Iacute;');
                var tabla_html = tabla_html.replace(/Ó/g, '&Oacute;');
                var tabla_html = tabla_html.replace(/Ú/g, '&Uacute;');
                var tabla_html = tabla_html.replace(/ñ/g, '&ntilde;');
                var tabla_html = tabla_html.replace(/Ñ/g, '&Ntilde;');
                tmpElemento.href = data_type + ', ' + tabla_html;
                //Asignamos el nombre a nuestro EXCEL
                var f = new Date( )

                tmpElemento.download = 'Eventos-Reporte Actualizado '+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'.xls';
                // Simulamos el click al elemento creado para descargarlo
                tmpElemento.click(); 
            }
            
            function buscar_informacion(){
                $('#cuerpo').html('<center><img align="center" src="vistas/Imagenes/loading.gif"/></center>');
                $('#cuerpo').html('<center><img align="center" src="vistas/Imagenes/loading.gif"/></center>');

                fecha_inicial=document.getElementById('fecha_inicial').value;
                fecha_final=document.getElementById('fecha_final').value;
                id_punto_bcr=document.getElementById('punto_bcr').value;
                tipo_evento = document.getElementById('tipo_evento').value;
                provincia = document.getElementById('nombre_provincia').value;
                tipo_punto = document.getElementById('tipo_punto').value;
                evento_cierre = document.getElementById('evento_cierre').value;
                Todos="Todos";

                $.post("index.php?ctl=actualiza_en_vivo_reporte_cerrados", {fecha_inicial: fecha_inicial,fecha_final:fecha_final,
                    id_punto_bcr:id_punto_bcr, tipo_evento:tipo_evento, provincia:provincia, tipo_punto:tipo_punto, Todos: Todos,evento_cierre:evento_cierre}, function(data){
                        //console.log(data);
                        $("#titulo").html("Eventos de acuerdo a parámetros:");  
                        $("#tabla").html(data);   
                        $("#tabla").dataTable().fnDestroy();
                        $("#tabla").DataTable().draw();
                });    
            }
            //Funcion para editar notas de supervisión
            function mostrar_resumen_de_seguimientos(prueb) {
                //var mydiv= document.getElementById('tabla_seguimientos');
                //mydiv.appendChild(document.getElementById("tbl"+prueb));
                id_e=prueb;
                $.post("index.php?ctl=dibuja_tabla_seguimiento_evento", { id_e: id_e}, function(data){
                    $("#tabla_seguimiento_prueba").html(data); 
                    //console.log(data);
                });
                //document.getElementById('ventana_oculta_1').style.display = "block";
                document.getElementById('ventana_oculta_3').style.display = "block";
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn quitar-float">
            <h2>Generar Reporte de Eventos Cerrados del Sistema</h2> 
            <h4 class="espacio-arriba">Escoger parámetros del filtro:</h4>
            <div class="row">
                <div class="col-xs-2">
                    <label for="fecha_inicial">Fecha Inicial:</label>
                    <input type="date" required class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo date("Y-m-d");?>">
                </div> 
                <div class="col-xs-2">
                    <label for="fecha_final">Fecha Final:</label>
                    <input type="date" required class="form-control" id="fecha_final" name="fecha_final" value="<?php echo date("Y-m-d");?>">
                </div> 
                <div class="col-xs-2">
                    <label for="nombre_provincia">Provincia</label>
                    <select class="form-control" required id="nombre_provincia" name="nombre_provincia" >
                        <option value="0">Todas</option>
                        <?php
                        $tam_provincias = count($lista_provincias);
                        for($i=0; $i<$tam_provincias;$i++) {
                            if($lista_provincias[$i]['ID_Provincia']==$cantones[$distritos[$params[0]['ID_Distrito']]['ID_Canton']]['ID_Provincia']){ ?> 
                                <option value="<?php echo $lista_provincias[$i]['ID_Provincia']?>" selected="selected"><?php echo $lista_provincias[$i]['Nombre_Provincia']?></option>
                            <?php } else { ?>
                                <option value="<?php echo $lista_provincias[$i]['ID_Provincia']?>"><?php echo $lista_provincias[$i]['Nombre_Provincia']?></option>  
                            <?php } 
                        } ?>  
                    </select>
                </div>
                <div class="col-xs-2">
                    <label for="tipo_punto">Tipo Punto</label>
                    <select class="form-control" required id="tipo_punto" name="tipo_punto" >
                        <option value="0">Todos</option>
                        <?php
                        $tam_tipo_punto_bcr = count($lista_tipos_de_puntos_bcr);
                        for($i=0; $i<$tam_tipo_punto_bcr;$i++){
                            if($lista_tipos_de_puntos_bcr[$i]['ID_Tipo_Punto']==$params[0]['ID_Tipo_Punto']){ ?> 
                                <option value="<?php echo $lista_tipos_de_puntos_bcr[$i]['ID_Tipo_Punto']?>" selected="selected"><?php echo $lista_tipos_de_puntos_bcr[$i]['Tipo_Punto']?></option>
                            <?php }else { ?>
                                <option value="<?php echo $lista_tipos_de_puntos_bcr[$i]['ID_Tipo_Punto']?>"><?php echo $lista_tipos_de_puntos_bcr[$i]['Tipo_Punto']?></option> 
                            <?php }
                        } ?>  
                    </select>
                </div>
                <div class="col-xs-2">
                    <label for="punto_bcr">Punto BCR</label>
                    <select class="form-control" required id="punto_bcr" name="punto_bcr" >
                        <option value="0">Todos</option>
                        <?php  if($params[0]['ID_PuntoBCR']!=0){ ?>
                            <option value="<?php echo $params[0]['ID_PuntoBCR']?>"><?php echo $params[0]['Nombre']?></option>
                        <?php } ?>

                        <?php
                        $tam_puntos_bcr=count($lista_puntos_bcr_oficinas_sj);
                        for($i=0; $i<$tam_puntos_bcr;$i++){?>
                            <option value="<?php echo $lista_puntos_bcr_oficinas_sj[$i]['ID_PuntoBCR']?>"><?php echo $lista_puntos_bcr_oficinas_sj[$i]['Nombre']?></option>                           
                        <?php  } ?> 
                    </select>
                </div>
                <div class="col-xs-2">
                    <label for="tipo_evento">Tipo Evento</label>
                    <select class="form-control" required id="tipo_evento" name="tipo_evento" >
                        <option value="0">Todos</option>                        
                        <?php 
                        if(isset($tipo_evento)){
                            $tam=count($tipo_evento);
                            for($i=0; $i<$tam;$i++){ ?>
                                <option value="<?php echo $tipo_evento[$i]['ID_Tipo_Evento']?>"><?php echo $tipo_evento[$i]['Evento']?></option>                           
                            <?php }  
                        } ?>
                    </select>
                </div>
            </div>
            <div class="row espacio-abajo">
                <div class="col-xs-2">
                    <label for="evento_cierre">Evento Cierre</label>
                    <select class="form-control" required id="evento_cierre" name="evento_cierre" >
                        <option value="0">Cualquiera</option>                        
                        <?php 
                        if(isset($evento_cierre)){
                            $tam=count($evento_cierre);
                            for($i=0; $i<$tam;$i++){ ?>
                                <option value="<?php echo $evento_cierre[$i]['ID_Tipo_Evento_Cierre']?>"><?php echo $evento_cierre[$i]['Evento'].'- '.$evento_cierre[$i]['Descripcion'] ?></option>                           
                            <?php }  
                        } ?>
                    </select>
                </div>
                <a class="btn btn-default espacio-arriba" role="button" id="prueba" name="prueba" onclick="buscar_informacion()">Generar Reporte</a>
                <a class="btn btn-default espacio-arriba" role="button" id="prueba" name="prueba" onclick="hacer_click()">Exportar Reporte</a>
                <a href="index.php?ctl=principal" class="btn btn-default espacio-arriba" role="button">Cancelar</a>
            </div>
            <div class="container animated fadeIn">
                <h2 id="titulo">Listado de Eventos Cerrados del día de hoy:</h2>
                <table id="tabla" class="display2">
                    <thead>   
                        <tr>
                            <th hidden>ID</th>
                            <th style="text-align:center">Fecha</th>
                            <th style="text-align:center">Hora</th>
                            <th style="text-align:center">Provincia</th>
                            <th style="text-align:center">Tipo Punto</th>
                            <th style="text-align:center">Punto BCR</th>
                            <th style="text-align:center">Código Punto BCR</th>
                            <th style="text-align:center">Tipo de Evento</th>
                            <th style="text-align:center">Estado actual</th>
                            <th style="text-align:center">Detalle Seguimiento</th>
                            <th hidden>Seguimiento</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpo">
                    
                    </tbody>
                </table>
            </div>

        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        <!--Tabla para exportar a excel-->
        <div>
            <table hidden id="eventos_seguimiento" class="display" cellspacing="0" width="100%" border='2px'>
                <thead>   
                    <tr>
                        <th style="text-align:center">Número de evento</th>
                        <th style="text-align:center">Fecha y Hora</th>
                        <th style="text-align:center">Provincia</th>
                        <th style="text-align:center">Tipo Punto</th>
                        <th style="text-align:center">Punto BCR</th>
                        <th style="text-align:center">Tipo de Evento</th>
                        <th style="text-align:center">Fecha y Hora Seguimiento</th>
                        <th style="text-align:center">Detalle Seguimiento</th>
                    </tr>
                </thead>
                <tbody id="cuerpo">
                </tbody>
            </table>
        </div>
        
        <!--Ver seguimiento evento- Ventana oculta-->
        <div id="ventana_oculta_3"> 
            <div id="popupventana2" class="animated zoomIn">
                <!--Formulario para direccionamiento de las ip-->
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2 align="center">Seguimiento de evento seleccionado</h2>
                    <br>
                    <table id='tabla_seguimiento_prueba' class="table ">
                    </table>
                </div>
            </div>      
        </div>
    </body>
</html>