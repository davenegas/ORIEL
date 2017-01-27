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
        <table id="tabla" class="display" cellspacing="0">
          <thead>
            <tr>
              <th style="text-align:center">ID Empresa</th>
              <th style="text-align:center">Empresa</th>
              <th style="text-align:center">Cedula Juridica</th>
              <th style="text-align:center">Teléfono Empresa</th>
              <!--<th style="text-align:center">Dirección</th>-->
              <th style="text-align:center">Tipo Empresa</th>
              <th style="text-align:center">Fecha Inicio</th>
              <th style="text-align:center">Fecha Final</th>
              <th style="text-align:center">Observaciones</th>
              <th style="text-align:center">Estado</th>
              <th style="text-align:center">Cambiar Estado</th>
              <th style="text-align:center">Mantenmiento</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tam=count($params);  
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <td style="text-align:center"><?php echo $params[$i]['ID_Empresa'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Empresa'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Cedula_Juridica'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Telefono_Empresa'];?></td>
                <!--<td style="text-align:center"><?php echo $params[$i]['Direccion'];?></td>-->
                <td style="text-align:center"><?php echo $params[$i]['Tipo_Empresa'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Fecha_Inicio'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Fecha_Final'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
            <?php 
            if ($params[$i]['Estado']==1){
              ?>  
                <td style="text-align:center">Activo</td>
               <?php 
            }else
            {?>  
                <td style="text-align:center">Inactivo</td>
            <?php 
            }
            ?>
                
            <td style="text-align:center"><a href="index.php?ctl=empresa_cambiar_estado&id=<?php echo $params[$i]['ID_Empresa']?>
                    &estado=<?php echo $params[$i]['Estado']?>
                    &observaciones=<?php echo $params[$i]['Observaciones']?>
                    &empresa=<?php echo $params[$i]['Empresa']?>">
                Activar/Desactivar</a></td>
            <td style="text-align:center"><a href="index.php?ctl=empresa_gestion&id=<?php echo $params[$i]['ID_Empresa']?>">
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