<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Detalle de Evento</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script language="javascript" src="vistas/js/valida_un_solo_click_en_formulario.js"></script>
        <script language="javascript">
            $(document).ready(function() {
                $(".botonExcel").click(function(event) {
                    $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
                    $("#FormularioExportacion").submit();
                });
            });
        
            function consultar_evento(id_evento){
                alert("index.php?ctl=frm_eventos_editar&id="+id_evento);
                $.get("index.php?ctl=frm_eventos_editar&id="+id_evento); 
            }  
            function eliminar_mezcla(id_referencia,id_evento){
                referencia=id_referencia;
                evento=id_evento;     
                $.confirm({
                    title: 'Confirmación!',
                    content: 'Desea eliminar esta mezcla del sistema?',
                    confirm: function(){
                       $.post("index.php?ctl=eliminar_mezcla_eventos_bitacora", {referencia: referencia,evento:evento},function(data){
                            if (data=="1"){
                                $.alert({
                                    title: 'Información!',
                                    content: 'No fue posible eliminar la mezcla del sistema!!!',
                                });
                             }else{
                                $.alert({
                                    title: 'Información!',
                                    content: 'Mezcla eliminada con éxito!!!',
                                });
                                location.reload();  
                             }
                        });  
                        //location.reload();  
                    },
                    cancel: function(){
                        //$.alert('Canceled!')
                    }
                });
            }  
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
               
        <div class="container animated fadeIn">
            <?php if ($vector_informacion_general_mezcla!=null){ ?>
                <h3 align="center">Mezcla de Eventos</h3>
                <h4><u>Información General de la Mezcla</u></h4>
                <!--<p>A continuación se detallan los diferentes eventos que están registrados en el sistema:</p>-->            
                <table class="table">
                    <thead> 
                        <tr style="text-align:center">
                            <th hidden="true">Referencia Mezcla</th>
                            <th>Creada por</th>
                            <th>Fecha de Creación</th>
                            <th>Hora de Creación</th>
                            <?php 
                            //Solamente los coordinadores ven esta opcion de agregar mezclas
                            if($_SESSION['modulos']['Módulo-Bitácora Digital-Eliminar Mezcla de Eventos']==1){ ?>
                                <th>Gestión</th>   
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tam=count($vector_informacion_general_mezcla);
                        for ($i = 0; $i <$tam; $i++) { ?>
                            <tr>
                                <?php
                                $fecha_evento = date_create($vector_informacion_general_mezcla[$i]['Fecha']);
                                $fecha_actual = date_create(date("d-m-Y"));
                                $dias_abierto= date_diff($fecha_evento, $fecha_actual);
                                ?>
                                <td hidden="true"><?php echo $vector_informacion_general_mezcla[$i]['Referencia_Mezcla'];?></td>
                                <td><?php echo $vector_informacion_general_mezcla[$i]['Nombre_Completo'];?></td>
                                <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
                                <td><?php echo $vector_informacion_general_mezcla[$i]['Hora'];?></td>
                                <?php 
                                //Solamente los coordinadores ven esta opcion de agregar mezclas
                                if($_SESSION['modulos']['Módulo-Bitácora Digital-Eliminar Mezcla de Eventos']==1){ ?>
                                    <td><a onclick="eliminar_mezcla('<?php echo $vector_informacion_general_mezcla[$i]['Referencia_Mezcla'];?>',<?php echo $params[0]['ID_Evento'];?>);">Eliminar</a></td>  
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            
                <!--<h4><u>Lista de Eventos Relacionados en la Mezcla </u>(Orden Cronológico)</h4>-->
                <!--<p>A continuación se detallan los diferentes eventos que están registrados en el sistema:</p>-->            
                <!--<table class="table">
                <tbody>
                    <tr>
                        <?php 
                        $tam=count($vector_listado_eventos_mezclados);
                        for ($i = 0; $i <$tam; $i++) { ?>
                            <td style="text-align:center"><a href="index.php?ctl=frm_eventos_editar&accion=consulta_mezclados&id=
                            <?php echo $vector_listado_eventos_mezclados[$i]['ID_Evento'];?>"><?php echo $vector_listado_eventos_mezclados[$i]['PuntoBCR_TipoEvento'];?></a></td>
                        <?php } ?>
                    </tr>
                </tbody>
                </table>-->
            <?php } ?>
            <h1 align="center">Detalle de Evento</h1>
            <hr/>
            <h3>General</h3>
           
            <!--<p>A continuación se detallan los diferentes eventos que están registrados en el sistema:</p>-->            
            <table class="table">
                <thead> 
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Lapso</th>
                        <th>Provincia</th>
                        <th>Tipo Punto</th>
                        <th>Punto BCR</th>
                        <th>Tipo de Evento</th>
                        <th>Estado Actual</th>
                        <th>Ingresado Por</th>
                        <th>Info del Sitio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($params2);
                    for ($i = 0; $i <$tam; $i++) { ?>
                        <tr>
                            <?php
                            $fecha_evento = date_create($params2[$i]['Fecha']);
                            $fecha_actual = date_create(date("d-m-Y"));
                            $dias_abierto= date_diff($fecha_evento, $fecha_actual);
                            ?>
                            <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
                            <td><?php echo $params2[$i]['Hora'];?></td>
                            <td align="center"><?php echo $dias_abierto->format('%a días');?></td>
                            <td><?php echo $params2[$i]['Nombre_Provincia'];?></td>
                            <td><?php echo $params2[$i]['Tipo_Punto'];?></td>
                            <?php if ($params2[$i]['ID_Evento']==$_GET['id']){ ?>
                                <td><u><b><?php echo $params2[$i]['Nombre'];?></b></u></td>
                            <?php }else { ?>
                                <!--<td><?php echo $params2[$i]['Nombre'];?></td>-->
                                <td><a href="index.php?ctl=frm_eventos_editar&accion=consulta_mezclados&id=
                                    <?php echo $params2[$i]['ID_Evento'];?>"><?php echo $params2[$i]['Nombre'];?></a></td>
                            <?php } ?>
                            <td><?php echo $params2[$i]['Evento'];?></td>
                            <td><?php echo $params2[$i]['Estado_Evento'];?></td>
                            <td><?php echo $params2[$i]['Nombre_Usuario']." ".$params2[$i]['Apellido'] ?></td>
                            <td><a href="index.php?ctl=gestion_punto_bcr&id=
                                <?php echo $params2[$i]['ID_PuntoBCR']?>">Detalles</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php if (((($_GET['accion']=="editar_abiertos") || ($params[0]['ID_EstadoEvento']==1))||((($_GET['accion']=="consulta_mezclados") && ($params[0]['ID_EstadoEvento']==1))||(($_GET['accion']=="consulta_mezclados") && ($params[0]['ID_EstadoEvento']==4))||(($_GET['accion']=="consulta_mezclados") && ($params[0]['ID_EstadoEvento']==2))))||(($_GET['accion']=="consulta_relacionados") && ($params[0]['ID_EstadoEvento']==4))||(($_GET['accion']=="consulta_relacionados") && ($params[0]['ID_EstadoEvento']==2))) { ?>    
                <hr/>
                <h3>Agregar nuevo seguimiento</h3>

                    <!--Agregar nuevo detalle o seguimiento del evento-->
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" onSubmit="return enviado()" method="POST" action="index.php?ctl=guardar_seguimiento_evento&id=<?php echo trim($ide);?>">
                     <?php if ($_SESSION['modulos']['Adjuntar archivos- Seguimientos Bitácora']==1){ ?>
                    <div class="col-xs-12 quitar-float espacio-abajo">
                        <label for="archivo_adjunto">Adjuntar Archivo: </label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                        <input type="file" name="archivo_adjunto" id="seleccionar_archivo" class="btn btn-default">
                    </div>   
                     <?php } ?>   
                    <div class="col-xs-6">
                        <label for="Fecha">Fecha Seguimiento</label>
                        <input type="date" required=”required” class="form-control" id="Fecha" name="Fecha" value="<?php echo date("Y-m-d");?>">
                    </div>

                    <?php date_default_timezone_set('America/Costa_Rica'); ?>
                    <div class="col-xs-6">
                        <label for="Hora">Hora Seguimiento</label>
                        <input type="time" required=”required” class="form-control" id="Hora" name="Hora" value="<?php echo date("H:i", time());?>">
                    </div> <br><br><br><br>
                    <div class="col-xs-6">
                        <label for="DetalleSeguimiento">Detalle del Seguimiento</label>
                        <textarea type="text" required=”required” class="form-control" id="DetalleSeguimiento" name="DetalleSeguimiento" value="" maxlength="500" minlength="5" placeholder="Máximo 500 caracteres por seguimiento"></textarea>
                    </div>

                    <div class="col-xs-6 espacio-abajo">
                        <label for="estado_del_evento">Estado del Evento</label>
                        <select class="form-control espacio-abajo" id="estado_del_evento" name="estado_del_evento" required=”required”> 
                        <?php
                        $tam = count($estadoEventos);

                        for($i=0; $i<$tam;$i++)
                        {
                            if ($_SESSION['modulos']['Cerrar eventos con prioridad Alta']==0){
                              if ($prioridad_evento!=1){ 
                                 if (($estadoEventos[$i]['Estado_Evento']!="Cerrado")&&($estadoEventos[$i]['Estado_Evento']!="Abierto por Error")){
                                     if ($estadoEventos[$i]['Estado_Evento']!=$estado_evento){
                                   ?> 
                                     <option value="<?php echo $estadoEventos[$i]['ID_EstadoEvento']?>" ><?php echo $estadoEventos[$i]['Estado_Evento']?></option>   
                                     <?php } else { ?> 
                                     <option selected="selected" value="<?php echo $estadoEventos[$i]['ID_EstadoEvento']?>" ><?php echo $estadoEventos[$i]['Estado_Evento']?></option>   

                                 <?php } }
                              }else{
                                   if (($estadoEventos[$i]['Estado_Evento']!="Solicitar Cierre")&&($estadoEventos[$i]['Estado_Evento']!="Abierto por Error")){
                                        if ($estadoEventos[$i]['Estado_Evento']==$estado_evento){
                                       ?>
                                         <option selected="selected" value="<?php echo $estadoEventos[$i]['ID_EstadoEvento']?>" ><?php echo $estadoEventos[$i]['Estado_Evento']?></option>   
                                        <?php }else{ ?>
                                         <option value="<?php echo $estadoEventos[$i]['ID_EstadoEvento']?>" ><?php echo $estadoEventos[$i]['Estado_Evento']?></option>   
                                       <?php
                                        }
                                    }
                              }
                            }else{

                                 if ($estado_evento=="Solicitar Cierre"){
                                     $estado_evento="Cerrado";
                                 }
                                 if ($estadoEventos[$i]['Estado_Evento']!="Solicitar Cierre"){
                                     if ($estadoEventos[$i]['Estado_Evento']==$estado_evento){
                                   ?>  
                                       <option value="<?php echo $estadoEventos[$i]['ID_EstadoEvento']?>" selected="selected" ><?php echo $estadoEventos[$i]['Estado_Evento']?></option>   
                                     <?php }else{?> 
                                       <option value="<?php echo $estadoEventos[$i]['ID_EstadoEvento']?>" ><?php echo $estadoEventos[$i]['Estado_Evento']?></option>   
                                   <?php
                                     }
                                 }

                              }
                        }
                                   ?> 
                        </select>
                    </div>

                    <button type="submit" class="btn btn-default">Guardar Seguimiento</button>
                    <!--<button type="submit" class="btn btn-default">Guardar Seguimiento</button>-->
                    <?php if ($_GET['accion']=="consulta_relacionados") {?>  
                    <td><a href="index.php?ctl=frm_eventos_agregar&id=<?php echo $params[0]['ID_PuntoBCR'];?>" class="btn btn-default" role="button">Volver</a></td>
                    <?php }else{?>  
                    <td><a href="index.php?ctl=frm_eventos_listar" class="btn btn-default" role="button">Cancelar</a></td>
                    <?php }?>
                </form>
            <?php } ?> 


            <!--Detalles de Evento--> 
                <hr/>
                <h3>Seguimientos asociados</h3>

            <table class="table">
                <thead>
                    <tr>
                        <th>Fecha de Seguimiento</th>
                        <th>Hora de Seguimiento</th>
                        <th>Detalle del Seguimiento</th>
                        <th>Ingresado Por</th>
                        <?php if ($vector_informacion_general_mezcla!=null){ ?>
                            <th>Corresponde A</th>
                        <?php } ?>
                        <th>Adjunto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($detalleEvento);
                    for ($i = 0; $i <$tam; $i++) { ?>
                        <tr>
                            <?php
                            $fecha_evento = date_create($detalleEvento[$i]['Fecha']);
                            $fecha_actual = date_create(date("d-m-Y"));
                            $dias_abierto= date_diff($fecha_evento, $fecha_actual); ?>
                            <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
                            <td><?php echo $detalleEvento[$i]['Hora'];?></td> 
                            <td><?php echo $detalleEvento[$i]['Detalle'];?></td>
                            <td><?php echo $detalleEvento[$i]['Nombre_Usuario']." ".$detalleEvento[$i]['Apellido'] ?></td>
                            <?php if ($vector_informacion_general_mezcla!=null){ ?>
                                <td><?php echo $detalleEvento[$i]['PuntoBCR_TipoEvento'];?></td>
                            <?php } ?>
                            <?php
                            //echo strlen($detalleEvento[$i]['Adjunto']);
                            if (strlen($detalleEvento[$i]['Adjunto'])==3){ ?>
                                <td><?php echo $detalleEvento[$i]['Adjunto'];?></td>
                            <?php }else { ?>
                                <td><a href="../../../Adjuntos_Bitacora/<?php echo $detalleEvento[$i]['Adjunto'];?>" download="<?php echo $detalleEvento[$i]['Adjunto'];?>"><img src="vistas/Imagenes/Descargar.png" class="img-rounded" alt="Cinque Terre" width="15" height="15"></a></td>
                                <!--<td><a href="../../../Adjuntos_Bitacora/<?php echo $detalleEvento[$i]['Adjunto'];?>" download="Adjunto_Seguimiento"><img src="vistas/Imagenes/Descargar.png" class="img-rounded" alt="Cinque Terre" width="15" height="15"></a></td>-->
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table> 
                
            <?php if ($_GET['accion']=="consulta_cerrados") { ?>  
                <td><a href="index.php?ctl=frm_eventos_lista_cerrados" class="btn btn-default" role="button">Volver</a></td>
            <?php } ?>  
                
            <?php if (($_GET['accion']=="consulta_relacionados") && ($params[0]['ID_EstadoEvento']!=1)&& ($params[0]['ID_EstadoEvento']!=2)&& ($params[0]['ID_EstadoEvento']!=4)){ ?>
                <td><a href="index.php?ctl=frm_eventos_agregar&id=<?php echo $params[0]['ID_PuntoBCR'];?>" class="btn btn-default" role="button">Volver</a></td>
            <?php } ?>  
                
            <?php if (($_GET['accion']=="consulta_mezclados") && ($params[0]['ID_EstadoEvento']!=1)&& ($params[0]['ID_EstadoEvento']!=2)&& ($params[0]['ID_EstadoEvento']!=4)){ ?>
                <td><a href="index.php?ctl=frm_eventos_listar" class="btn btn-default" role="button">Volver</a></td>
            <?php }?>  
       
        </div>
        
        <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>
