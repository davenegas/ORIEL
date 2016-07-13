<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Detalle de Evento</title>
        <?php require_once 'frm_librerias_head.html';?>

    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container">
            <h1 align="center">Detalle de Evento</h1>
            <h3><u>General</u></h3>
        <!--<p>A continuación se detallan los diferentes eventos que están registrados en el sistema:</p>-->            
        <table class="table">
          <thead>
               
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Provincia</th>
                <th>Tipo Punto</th>
                <th>Punto BCR</th>
                <th>Tipo de Evento</th>
            </tr>
          </thead>
          <tbody>
        
            <?php 
            $tam=count($params);
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <td><?php echo $params[$i]['Fecha'];?></td>
                <td><?php echo $params[$i]['Hora'];?></td>
                <td><?php echo $params[$i]['Nombre_Provincia'];?></td>
                <td><?php echo $params[$i]['Tipo_Punto'];?></td>
                <td><?php echo $params[$i]['Nombre'];?></td>
                <td><?php echo $params[$i]['Evento'];?></td>
            </tr>
            <?php }
            ?>
            </tbody>
        </table><br>
        </div>
             
        <!--Detalles de Evento--> 

        <div class="container">
            <h3><u>Seguimientos asociados </u></h3>
        <table class="table">
            <thead>
                <tr>
                  <th>Fecha de Seguimiento</th>
                  <th>Hora de Seguimiento</th>
                  <th>Detalle del Seguimiento</th>
                </tr>
            </thead>
                <tbody>
                <?php 
                $tam=count($detalleEvento);
                for ($i = 0; $i <$tam; $i++) {
                ?>
                <tr>
                <td><?php echo $detalleEvento[$i]['Fecha'];?></td>
                <td><?php echo $detalleEvento[$i]['Hora'];?></td> 
                <td><?php echo $detalleEvento[$i]['Detalle'];?></td>
                <?php } ?>
                </tbody>
        </table>   
            <h3><u>Agregar nuevo seguimiento</u></h3>
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
                <div class="form-group">
                    <label for="DetalleSeguimiento">Detalle del Seguimiento</label>
                    <textarea type="text" required=”required” class="form-control" id="DetalleSeguimiento" name="DetalleSeguimiento" value=""></textarea>
                </div>
                <div class="form-group">
                    <label for="DetalleSeguimiento">Estado del Evento</label>
                    <select class="form-control" id="Rol" name="Rol" > 
                    <?php
                    $tam = count($seguimiento);

                    for($i=0; $i<$tam;$i++)
                    {
                        if($seguimiento[$i]['Seguimiento']==$params[0]['Seguimiento']){

                           ?> <option value="<?php echo $seguimiento[$i]['ID_Seguimiento']?>" selected="selected"><?php echo $seguimiento[$i]['Seguimiento']?></option><?php
                        }
                        else {?>
                            <option value="<?php echo $seguimiento[$i]['ID_Seguimiento']?>" ><?php echo $seguimiento[$i]['Seguimiento']?></option>   
                    <?php }}  ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Guardar Seguimiento</button>
                <td><a href="index.php?ctl=frm_eventos_listar" class="btn btn-default" role="button">Cancelar</a></td>
            </form>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>
