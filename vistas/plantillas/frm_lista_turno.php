<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Turnos Operadores</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>     
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
        <h2>Turnos Laborales</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th style="text-align:center" >ID_Turno</th>
                    <th style="text-align:center" >Turno</th>
                    <th style="text-align:center" >Observaciones</th>
                    <th style="text-align:center" >Estado</th>
                    <th style="text-align:center" >Mantenimiento</th>
                 </tr>
             </thead>
            <tbody>
                <?php
                $tam= count($vector);
                for($i=0;$i<$tam;$i++){
                ?>
                <tr>
                    <th style="text-align:center"><?php echo $vector[$i]['ID_Turno'] ?></td>
                    <th style="text-align:center"><?php echo $vector[$i]['Turno'] ?></td>
                    <th style="text-align:center"><?php echo $vector[$i]['Observaciones']?></td>
                    <th style="text-align:center"><?php echo $vector[$i]['Estado']?></td>
                    <th style="text-align:center"><a href="index.php?ctl=obtiene_todos_los_turnos&id=<?php echo $vector[$i]['ID_Turno'];?>
                         &Turno=<?php echo $vector[$i]['Turno'];?>
                         &obser=<?php echo $vector[$i]['Observaciones'];?>
                         &estado=<?php echo $vector[$i]['Estado'];?>">Editar</a></td>
                    
                <?php } ?>
            </tbody>
        </table>
           <button><a href="index.php?ctl=obtiene_todos_los_turnos&id=0&estado=1" class="btn">Agregar Turno</a></button>
        </div>
           <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
      </body>
</html>