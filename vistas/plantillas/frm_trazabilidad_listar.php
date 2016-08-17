<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Traza del Sistema</title>
        <?php require_once 'frm_librerias_head.html'; ?>     
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn">
        <h2>Listado de Trazabilidad del Sistema</h2>
        <!--<p>A continuación se detallan los diferentes roles que están registrados en el sistema:</p>-->  
        <section class="full-height">
        <table id="tabla" class="display2">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Hora</th>
              <th>ID_Traza</th>
              <th>Antiguedad Dias</th>
              <th>Usuario</th>
              <th>Tabla Afectada</th>
              <th>Dato Actualizado</th>
              <th>Dato Anterior</th>
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
            <td><?php echo $params[$i]['ID_Traza'];?></td>
            <td align="center"><?php echo $dias_abierto->format('%a');?></td>
            <td><?php echo $params[$i]['Nombre']." ".$params[$i]['Apellido'] ?></td>
            <td><?php echo $params[$i]['Tabla_Afectada'];?></td>
            <td><?php echo $params[$i]['Dato_Actualizado'];?></td>
            <td><?php echo $params[$i]['Dato_Anterior'];?></td>
            </tr>
            <?php }
            ?>
            </tbody>
        </table>
        </section>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>