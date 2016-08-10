<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Empresas</title>
        <?php require_once 'frm_librerias_head.html';?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container">
        <h2>Listado General de Empresas</h2>
        <p>A continuación se detallan las diferentes empresas que están registrados en el sistema:</p>            
        <table id="tabla" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID Empresa</th>
              <th>Empresa</th>
              <th>Observaciones</th>
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
                <td><?php echo $params[$i]['ID_Empresa'];?></td>
                <td><?php echo $params[$i]['Empresa'];?></td>
                <td><?php echo $params[$i]['Observaciones'];?></td>
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
                
           <td><a href="index.php?ctl=empresa_cambiar_estado&id=<?php echo $params[$i]['ID_Empresa']?>
                    &estado=<?php echo $params[$i]['Estado']?>
                    &observaciones=<?php echo $params[$i]['Observaciones']?>
                    &empresa=<?php echo $params[$i]['Empresa']?>">
                Activar/Desactivar</a></td>
           <td><a href="index.php?ctl=empresa_gestion&id=<?php echo $params[$i]['ID_Empresa']?>
                    &estado=<?php echo $params[$i]['Estado']?>
                    &observaciones=<?php echo $params[$i]['Observaciones']?>
                    &empresa=<?php echo $params[$i]['Empresa']?>">
                Editar</a></td>
            </tr>     
                    
            <?php }
            ?>
            </tbody>
        </table>
        <a href="index.php?ctl=empresa_gestion&id=0" class="btn btn-default" role="button">Agregar Nueva Empresa</a>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>