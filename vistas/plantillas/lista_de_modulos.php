<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Módulos</title>
        <?php require_once 'frm_librerias_head.html';?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container animated bounceInUp">
        <h2>Listado General de Módulos</h2>
        <p>A continuación se detallan los diferentes módulos que están registrados en el sistema:</p>            
        <table id="tabla" class="display" cellspacing="0" width="100%">
          <thead>
               
            <tr>
              <th>Descripcion</th>
              <th>Estado</th>
              <th>Gestión Estado</th>
              <th>Mantenmiento</th>
            </tr>
          </thead>
          <tbody>
        
            <?php 

            $tam=count($params);

            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
            <td><?php echo $params[$i]['Descripcion'];?></td>
            
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
                
           <td><a href="index.php?ctl=cambiar_estado_modulo&id=
               <?php echo $params[$i]['ID_Modulo']?>&estado=<?php echo $params[$i]['Estado']?>">
                   Activar/Desactivar</a></td>
           <td><a href="index.php?ctl=gestion_modulos&id=
               <?php echo $params[$i]['ID_Modulo']?>&estado=<?php echo $params[$i]['Estado']?>&descripcion=<?php echo $params[$i]['Descripcion']?>">
                   Editar Modulo</a></td>
            </tr>     
                    
            <?php }
            ?>
                       </tbody>
        </table>
        <a href="index.php?ctl=gestion_modulos&id=0" class="btn btn-default" role="button">Agregar un Nuevo Módulo</a>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>