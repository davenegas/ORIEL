<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Detalle de Evento</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script language="javascript" src="vistas/js/valida_un_solo_click_en_formulario.js"></script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container animated fadeIn">
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
            </tr>
          </thead>
          <tbody>
        
            <?php 
            $tam=count($params);
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <?php
                $fecha_evento = date_create($params[$i]['Fecha']);
                $fecha_actual = date_create(date("d-m-Y"));
                $dias_abierto= date_diff($fecha_evento, $fecha_actual);
                ?>
                <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
                <td><?php echo $params[$i]['Hora'];?></td>
                <td align="center"><?php echo $dias_abierto->format('%a días');?></td>
                <td><?php echo $params[$i]['Nombre_Provincia'];?></td>
                <td><?php echo $params[$i]['Tipo_Punto'];?></td>
                <td><?php echo $params[$i]['Nombre'];?></td>
                <td><?php echo $params[$i]['Evento'];?></td>
                <td><?php echo $params[$i]['Estado_Evento'];?></td>
                <td><?php echo $params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido'] ?></td>
            </tr>
            <?php }
            ?>
            </tbody>
        </table>
            
            
            
        <?php if ((($_GET['accion']=="editar_abiertos") || ($params[0]['ID_EstadoEvento']==1))||(($_GET['accion']=="consulta_relacionados") && ($params[0]['ID_EstadoEvento']==4))||(($_GET['accion']=="consulta_relacionados") && ($params[0]['ID_EstadoEvento']==2))) { ?>    
            <hr/>
            <h3>Agregar nuevo seguimiento</h3>
                
                <!--Agregar nuevo detalle o seguimiento del evento-->
                <form class="form-horizontal" role="form" enctype="multipart/form-data" onSubmit="return enviado()" method="POST" action="index.php?ctl=guardar_seguimiento_evento&id=<?php echo trim($ide);?>">
                 <?php if ($_SESSION['rol']!=2){ ?>
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
                        if ($_SESSION['rol']==2){
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
                  <th>Adjunto</th>
                </tr>
            </thead>
                <tbody>
                <?php 
                $tam=count($detalleEvento);
                for ($i = 0; $i <$tam; $i++) {
                ?>
                <tr>
                <?php
                $fecha_evento = date_create($detalleEvento[$i]['Fecha']);
                $fecha_actual = date_create(date("d-m-Y"));
                $dias_abierto= date_diff($fecha_evento, $fecha_actual);
                ?>
                <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
                <td><?php echo $detalleEvento[$i]['Hora'];?></td> 
                <td><?php echo $detalleEvento[$i]['Detalle'];?></td>
                <td><?php echo $detalleEvento[$i]['Nombre_Usuario']." ".$detalleEvento[$i]['Apellido'] ?></td>
                <?php
                //echo strlen($detalleEvento[$i]['Adjunto']);
                if (strlen($detalleEvento[$i]['Adjunto'])==3){

                ?>
                <td><?php echo $detalleEvento[$i]['Adjunto'];?></td>
                <?php }else{ ?>
                
                <td><a href="../../../Adjuntos_Bitacora/<?php echo $detalleEvento[$i]['Adjunto'];?>" download="<?php echo $detalleEvento[$i]['Adjunto'];?>"><img src="vistas/Imagenes/Descargar.png" class="img-rounded" alt="Cinque Terre" width="15" height="15"></a></td>
                <!--<td><a href="../../../Adjuntos_Bitacora/<?php echo $detalleEvento[$i]['Adjunto'];?>" download="Adjunto_Seguimiento"><img src="vistas/Imagenes/Descargar.png" class="img-rounded" alt="Cinque Terre" width="15" height="15"></a></td>-->
                <?php } ?>
                <?php } ?>
                </tbody>
        </table>  
         <?php if ($_GET['accion']=="consulta_cerrados") {  
        ?>  
        <td><a href="index.php?ctl=frm_eventos_lista_cerrados" class="btn btn-default" role="button">Volver</a></td>
        <?php }?>  
        <?php if (($_GET['accion']=="consulta_relacionados") && ($params[0]['ID_EstadoEvento']!=1)&& ($params[0]['ID_EstadoEvento']!=2)&& ($params[0]['ID_EstadoEvento']!=4)){ ?>
        <td><a href="index.php?ctl=frm_eventos_agregar&id=<?php echo $params[0]['ID_PuntoBCR'];?>" class="btn btn-default" role="button">Volver</a></td>
        <?php }?>  
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>
