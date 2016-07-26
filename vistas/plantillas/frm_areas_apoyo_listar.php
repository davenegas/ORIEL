<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Areas de Apoyo</title>
        <?php require_once 'frm_librerias_head.html';?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container">
        <h2>Listado General de Areas de Apoyo</h2>
        <p>A continuación se detallan los diferentes tipos de areas de apoyo que están registrados en el sistema:</p>            
        <table id="tabla" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID Area</th>
              <th>Tipo de Area</th>
              <th>Nombre Area</th>
              <th>Observaciones</th>
              <th>Distrito</th>
              <th>Estado</th>
              <th>Cambiar Estado</th>
              <th>Mantenmiento</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tam=count($params);
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <td><?php echo $params[$i]['ID_Area_Apoyo'];?></td>
                <td><?php echo $params[$i]['Nombre_Tipo_Area'];?></td>
                <td><?php echo $params[$i]['Direccion'];?></td>
                <td><?php echo $params[$i]['Observaciones'];?></td>
                <td><?php echo $params[$i]['Nombre_Distrito'];?></td>
            <?php 
            if ($params[$i]['Estado']==1){
              ?>  
                <td>Activo</td>
               <?php 
            }else
            {?>  
                <td>Inactivo</td>
            <?php 
            }
            ?>
                
           <td><a href="index.php?ctl=cambiar_estado_area_apoyo&id=
               <?php echo $params[$i]['ID_Area_Apoyo']?>&estado=<?php echo $params[$i]['Estado']?>">
                   Activar/Desactivar</a></td>
           <td><a href="index.php?ctl=gestion_area_apoyo&id=
               <?php echo $params[$i]['ID_Area_Apoyo']?>&estado=<?php echo $params[$i]['Estado']?>&descripcion=<?php echo $params[$i]['Observaciones']?>">
                   Editar</a></td>
            </tr>     
                    
            <?php }
            ?>
            </tbody>
        </table>
        <a href="index.php?ctl=frm_area_apoyo_gestion&id=0" class="btn btn-default" role="button">Agregar Nueva Area de Apoyo</a>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>