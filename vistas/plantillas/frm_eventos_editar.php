<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Detalle de Evento</title>
        <?php require_once 'frm_librerias_head.html';?>

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
                 <td><?php echo $params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido'] ?></td>
            </tr>
            <?php }
            ?>
            </tbody>
        </table>
        
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
                <?php } ?>
                </tbody>
        </table>   
            <hr/>
            <h3>Agregar nuevo seguimiento</h3>
            
                <!--Agregar nuevo detalle o seguimiento del evento-->
            <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=guardar_seguimiento_evento&id=<?php echo trim($ide);?>">
                <div class="col-xs-6">
                    <label for="Fecha">Fecha Seguimiento</label>
                    <input type="date" required=”required” class="form-control" id="Fecha" name="Fecha" value="<?php echo date("Y-m-d");?>">
                </div>
                
                <?php date_default_timezone_set('America/Costa_Rica'); ?>
                <div class="col-xs-6">
                    <label for="Hora">Hora Seguimiento</label>
                    <input type="time" required=”required” class="form-control" id="Hora" name="Hora" value="<?php echo date("H:i:s", time());?>">
                </div> <br><br><br><br>
                <div class="col-xs-6">
                    <label for="DetalleSeguimiento">Detalle del Seguimiento</label>
                    <textarea type="text" required=”required” class="form-control" id="DetalleSeguimiento" name="DetalleSeguimiento" value=""></textarea>
                </div>
                
                <div class="col-xs-6">
                    <label for="estado_del_evento">Estado del Evento</label>
                    <select class="form-control" id="estado_del_evento" name="estado_del_evento" required=”required”> 
                    <?php
                    $tam = count($estadoEventos);
                    for($i=0; $i<$tam;$i++)
                    {
                        if ($_SESSION['rol']==2){
                          if ($prioridad_evento!=1){ 
                             if (($estadoEventos[$i]['Estado_Evento']!="Cerrado")&&($estadoEventos[$i]['Estado_Evento']!="Abierto por Error")){
                            ?> 
                             <option value="<?php echo $estadoEventos[$i]['ID_EstadoEvento']?>" ><?php echo $estadoEventos[$i]['Estado_Evento']?></option>   
                               <?php
                             }
                          }else{
                               if (($estadoEventos[$i]['Estado_Evento']!="Solicitar Cierre")&&($estadoEventos[$i]['Estado_Evento']!="Abierto por Error")){
                                    ?>
                                   <option value="<?php echo $estadoEventos[$i]['ID_EstadoEvento']?>" ><?php echo $estadoEventos[$i]['Estado_Evento']?></option>   
                              <?php
                                }
                          
                          }
                        }else{
                             if ($estadoEventos[$i]['Estado_Evento']!="Solicitar Cierre"){
                               ?>    
                               <option value="<?php echo $estadoEventos[$i]['ID_EstadoEvento']?>" ><?php echo $estadoEventos[$i]['Estado_Evento']?></option>   
                               
                               <?php
                             }
                          }
                    }
                               ?> 
                    </select>
                </div>
                <br><br><br><br><br>
                <button type="submit" class="btn btn-default">Guardar Seguimiento</button>
                <td><a href="index.php?ctl=frm_eventos_listar" class="btn btn-default" role="button">Cancelar</a></td>
            </form>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>
