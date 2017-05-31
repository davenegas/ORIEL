<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Áreas de Apoyo</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script>
            $(document).ready(function () {
                if ( $.fn.dataTable.isDataTable('#tabla') ) {
                    table = $('#tabla').DataTable();
                }
                table.destroy();
                table = $('#tabla').DataTable( {
                    "lengthMenu": [[10, 25, 50,100,-1], [10, 25, 50,100,"All"]]
                });        
            });
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container">
            <h2>Listado General de Áreas de Apoyo</h2>

            <p>A continuación se detallan los diferentes tipos de áreas de apoyo que están registrados en el sistema:</p>            
            <table id="tabla" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <!--<th style="text-align:center">ID Area</th>-->
                        <th style="text-align:center">Tipo de Área</th>
                        <th style="text-align:center">Nombre Área</th>
                        <th style="text-align:center">Observaciones</th>
                        <th style="text-align:center">Dirección</th>
                        <th style="text-align:center">Número</th>
                        <?php if($_SESSION['modulos']['Editar- Áreas Apoyo']==1){ ?>
                            <th style="text-align:center">Estado</th>
                            <th style="text-align:center">Cambiar Estado</th>
                            <th style="text-align:center">Mantenimiento</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($params);
                    for ($i = 0; $i <$tam; $i++) { ?>
                        <tr>
                            <!--<td style="text-align:center"><?php echo $params[$i]['ID_Area_Apoyo'];?></td>-->
                            <td style="text-align:center"><?php echo $params[$i]['Nombre_Tipo_Area'];?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Nombre_Area'];?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Direccion'];?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Numero'];?></td>
                            <?php if($_SESSION['modulos']['Editar- Áreas Apoyo']==1){
                                if ($params[$i]['Estado']==1){ ?>  
                                    <td>Activo</td>
                                <?php }else {?>  
                                    <td>Inactivo</td>
                                <?php  } ?>
                                <td style="text-align:center"><a href="index.php?ctl=area_apoyo_cambiar_estado&id=
                                    <?php echo $params[$i]['ID_Area_Apoyo']?>&estado=<?php echo $params[$i]['Estado']?>">
                                        Activar/Desactivar</a></td>
                                <td style="text-align:center"><a href="index.php?ctl=area_apoyo_gestion&id=
                                    <?php echo $params[$i]['ID_Area_Apoyo']?>">
                                        Editar</a></td>
                                <?php } ?>
                         </tr>     
                    <?php } ?>
                </tbody>
            </table>
            <a href="index.php?ctl=area_apoyo_gestion&id=0" class="btn btn-default" role="button">Agregar Nueva Area de Apoyo</a>
        </div>
        
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>