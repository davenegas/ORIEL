<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Tipos de Eventos</title>
        <?php require_once 'frm_librerias_head.html';?>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
        <h2>Listado General de Tipos de Eventos</h2>
        <p>A continuación se detallan los diferentes tipos de eventos que están registrados en el sistema:</p>            
        <table id="tabla" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="text-align:center">ID</th>
                    <th style="text-align:center">Evento</th>
                    <th style="text-align:center">Observaciones</th>
                    <th style="text-align:center">Prioridad</th>
                    <th style="text-align:center">Gestión Estado</th>
                    <th style="text-align:center">Cambiar Estado</th>
                    <th style="text-align:center">Mantenimiento</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $tam=count($params);
                for ($i = 0; $i <$tam; $i++) {  ?>
                    <tr>
                        <td style="text-align:center"><?php echo $params[$i]['ID_Tipo_Evento'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Evento'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                        <!--Cambia el numero de prioridad por el nombre-->
                        <?php   if ($params[$i]['Prioridad']==1){    ?>  
                            <td style="text-align:center">1- Baja</td>
                        <?php } else    {?>  
                            <td style="text-align:center">2- Alta</td>
                        <?php } ?>
                        <!--Cambia el numero de estado por el nombre-->     
                        <?php   if ($params[$i]['Estado']==1){    ?>  
                            <td style="text-align:center">Activo</td>
                        <?php } else    {?>  
                            <td style="text-align:center">Inactivo</td>
                        <?php } ?>
                            
                        <td style="text-align:center"><a href="index.php?ctl=tipo_eventos_cambiar_estado&id=<?php echo $params[$i]['ID_Tipo_Evento']?>
                               &evento=<?php echo $params[$i]['Evento']?>
                               &estado=<?php echo $params[$i]['Estado']?>
                               &observaciones=<?php echo $params[$i]['Observaciones']?>
                               &prioridad=<?php echo $params[$i]['Prioridad']?>">
                                Activar/Desactivar</a></td>
                        <td style="text-align:center"><a href="index.php?ctl=tipo_eventos_gestion&id=<?php echo $params[$i]['ID_Tipo_Evento']?>
                               &evento=<?php echo $params[$i]['Evento']?>
                               &estado=<?php echo $params[$i]['Estado']?>
                               &observaciones=<?php echo $params[$i]['Observaciones']?>
                               &prioridad=<?php echo $params[$i]['Prioridad']?>">
                                Editar</a></td>
                    </tr>     
                <?php } ?>
            </tbody>
        </table>
        <a href="index.php?ctl=tipo_eventos_gestion&id=0" class="btn btn-default" role="button">Agregar un Nuevo Tipo Evento</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>