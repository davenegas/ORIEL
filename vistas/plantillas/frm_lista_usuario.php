<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Asistencia Operador</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>     
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
        <h1>Lista Asistencia Operadores</h1>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th style="text-align:center">ID</th>
                    <th style="text-align:center">Cedula</th>
                    <th style="text-align:center">Nombre Operador</th>
                    <th style="text-align:center">Observaciones</th>
                    <th style="text-align:center">Turno</th>
                    <th style="text-align:center">Horario</th>
                    <th style="text-align:center">Estado</th>
                    <th style="text-align:center">Mantenimiento</th>   
                </tr>
            </thead>
            <tbody>
                <?php
                $tam= count($vector);
                for($i=0;$i<$tam;$i++){
                ?>
                <tr>
                    <th style="text-align:center"><?php echo $vector[$i]['ID_Usuario'] ?></td> 
                    <th style="text-align:center"><?php echo $vector[$i]['Cedula'] ?></td>
                    <th><?php echo $vector[$i]['Nombre']." ".$vector[$i]['Apellido'] ?></td>
                    <th style="text-align:center"><?php echo $vector[$i]['Observaciones']?></td>
                    <th style="text-align:center"><?php echo $vector[$i]['Turno'] ?></td>
                    <th style="text-align:center"><?php echo $vector[$i]['Horario'] ?></td>
                    <th style="text-align:center"><?php echo $vector[$i]['Estado'] ?></td>
                    
                <th style="text-align:center"><a href="index.php?ctl=obtiene_todos_los_usuariosp&id=<?php echo $vector[$i]['ID_Usuario']?>
                &Cedula=<?php echo $vector[$i]['Cedula']?>&Nombre=<?php echo $vector[$i]['Nombre']?>
                &Apellido=<?php echo $vector[$i]['Apellido']?>&Observaciones=<?php echo $vector[$i]['Observaciones']?>
                &ID_Turno=<?php echo $vector[$i]['Turno']?>&ID_Horariop=<?php echo $vector[$i]['Horario']?>
                &Estado=<?php echo $vector[$i]['Estado']?>">Editar</a></td>
                </tr> 
                
                <?php } ?>
            </tbody>
        </table>
        <button><a href="index.php?ctl=obtiene_todos_los_usuariosp&id=0&Estado=1" class="btn">Agregar</a></button>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
         </div>
      </body>
</html>
