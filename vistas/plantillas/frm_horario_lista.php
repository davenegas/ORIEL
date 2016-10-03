<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista Horarios BCR</title>
        <?php require_once 'frm_librerias_head.html'; ?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class='container'>
            <h2>Listado General de Horarios</h2>
            <p>A continuación se detallan los diferentes horario registrados en el sistema</p>
            <table id="tabla" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID Horario</th>
                        <th>Dias Laborados</th>
                        <th>Horas Laboradas</th>
                        <th>Observaciones</th>
                        <th>Estado</th>
                        <th>Cambiar Estado</th>
                        <th>Mantenimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam = count($horarios);
                    for($i=0;$i<$tam;$i++){
                    ?>
                        <tr>
                            <td><?php echo $horarios[$i]['ID_Horario']?></td>
                            <td><?php echo $horarios[$i]['Dia_Laboral']?></td>
                            <td><?php echo $horarios[$i]['Hora_Laboral']?></td>
                            <td><?php echo $horarios[$i]['Observaciones']?></td>
                            <td><?php echo $horarios[$i]['Estado']?></td> 
                            <td><a href="">Cambiar estado</a></td>
                            <td><a href="index.php?ctl=horario_gestion&ide=<?php echo $horarios[$i]['ID_Horario']?>">Editar</a></td>
                        </tr>
                    <?php }?>
                </tbody>
            </table> 
            <a href="index.php?ctl=horario_gestion&ide=0" class="btn btn-default" role="button">Agregar Nuevo Horario</a>
        </section>
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>