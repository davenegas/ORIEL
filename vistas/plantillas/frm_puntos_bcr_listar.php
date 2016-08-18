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

        <table id="tabla" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID Punto</th>
              <th>Nombre</th>
              <th>Unidad Ejecutora</th>
              <th>Codigo</th>
              <th>Cuenta SIS</th>
              <th>Tipo de Punto</th>
              <th>Observaciones</th>
              <th>Estado</th>
              <th>Cambiar Estado</th>
              <th>Mantenmiento</th>
              <th>Registrar</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tam=count($params);
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <td style="text-align:center"><?php echo $params[$i]['ID_PuntoBCR'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Nombre'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Departamento'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Codigo'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Cuenta_SIS'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Tipo_Punto'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                <?php 
                if ($params[$i]['Estado']==1){  ?>  
                    <td style="text-align:center">Activo</td>
                    <?php 
                }   else   {?>  
                    <td style="text-align:center">Inactivo</td>
                    <?php 
                }?>

                <td style="text-align:center"><a href="index.php?ctl=cambiar_estado_punto_bcr&id=
                    <?php echo $params[$i]['ID_PuntoBCR']?>&estado=<?php echo $params[$i]['Estado']?>">
                    Activar/Desactivar</a></td>
                <td style="text-align:center"><a href="index.php?ctl=gestion_punto_bcr&id=
                    <?php echo $params[$i]['ID_PuntoBCR']?>&estado=<?php echo $params[$i]['Estado']?>
                    &descripcion=<?php echo $params[$i]['Observaciones']?>">
                    Gestion</a></td>
                <td style="text-align:center"><a href="index.php?ctl=frm_eventos_agregar&id=<?php echo $params[$i]['ID_PuntoBCR']?>">
                    Ingresar Evento</a></td>
            </tr>     

            <?php }
            ?>
            </tbody>
        </table>
        
        <a href="index.php?ctl=punto_bcr_agregar&id=0" class="btn btn-default" role="button">Agregar Nuevo Punto BCR</a>
        </div> 
        
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        
    </body>
</html>