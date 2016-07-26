<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Puntos BCR</title>
        <?php require_once 'frm_librerias_head.html';?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container">
        <h2>Listado General de Puntos BCR</h2>
        <p>A continuación se detallan los Puntos BCR que están registrados en el sistema:</p>   
        </div>  
        <table id="tabla" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID Punto</th>
              <th>Nombre</th>
              <th>Direccion</th>
              <th>Codigo</th>
              <th>Cuenta SIS</th>
              <th>Tipo de Punto</th>
              <th>Empresa valores</th>
              <th>Horario</th>
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
                <td><?php echo $params[$i]['ID_PuntoBCR'];?></td>
                <td><?php echo $params[$i]['Nombre'];?></td>
                <td><?php echo $params[$i]['Direccion'];?></td>
                <td><?php echo $params[$i]['Codigo'];?></td>
                <td><?php echo $params[$i]['Cuenta_SIS'];?></td>
                <td><?php echo $params[$i]['Tipo_Punto'];?></td>
                <td><?php echo $params[$i]['Empresa'];?></td>
                <td><?php echo $params[$i]['Dia_Laboral']." - ".$params[$i]['Hora_Laboral'];?></td>
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
                
           <td><a href="index.php?ctl=cambiar_estado_punto_bcr&id=
               <?php echo $params[$i]['ID_PuntoBCR']?>&estado=<?php echo $params[$i]['Estado']?>">
                   Activar/Desactivar</a></td>
           <td><a href="index.php?ctl=gestion_punto_bcr&id=
               <?php echo $params[$i]['ID_PuntoBCR']?>&estado=<?php echo $params[$i]['Estado']?>&descripcion=<?php echo $params[$i]['Observaciones']?>">
                   Editar Modulo</a></td>
            </tr>     
                    
            <?php }
            ?>
            </tbody>
        </table>
        <a href="index.php?ctl=frm_punto_bcr_gestion&id=0" class="btn btn-default" role="button">Agregar Nueva Area de Apoyo</a>
<!--        </div>-->
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>