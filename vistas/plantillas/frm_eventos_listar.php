<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Eventos</title>
        <?php require_once 'frm_librerias_head.html'; ?>     
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
        <h2>Listado de Eventos</h2>
        <!--<p>A continuación se detallan los diferentes roles que están registrados en el sistema:</p>-->            
        <table id="tabla" class="display">
          <thead>
               
            <tr>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Lapso</th>
              <th>Provincia</th>
              <th>Tipo Punto</th>
              <th>Punto BCR</th>
              <th>Tipo de Evento</th>
              <th>Estado del Evento</th>
              <th>Editar Evento</th>
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
            <td align="center"><?php echo $dias_abierto->format('%a');?></td>
            <td><?php echo $params[$i]['Nombre_Provincia'];?></td>
            <td><?php echo $params[$i]['Tipo_Punto'];?></td>
            <td><?php echo $params[$i]['Nombre'];?></td>
            <td><?php echo $params[$i]['Evento'];?></td>
            <td><?php echo $params[$i]['Estado_Evento'];?></td>
            
            <td><a href="index.php?ctl=frm_eventos_editar&id=
               <?php echo $params[$i]['ID_Evento']?>">Agregar Seguimiento</a></td>
            </tr>
            <?php }
            ?>
            </tbody>
        </table>
        <a href="index.php?ctl=frm_eventos_agregar&id=0" class="btn btn-default" role="button">Agregar Nuevo Evento de Bitácora</a>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>