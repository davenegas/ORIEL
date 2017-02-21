<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Horarios Operadores</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>     
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <h2>Horarios Operadores</h2>
        <br>
        <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th style="text-align:center">ID_Horario</th>
                    <th style="text-align:center">Horario</th>
                    <th style="text-align:center">Observaciones</th>
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
                    <th style="text-align:center"><?php echo $vector[$i]['ID_Horariop'] ?></td>
                    <th style="text-align:center"><?php echo $vector[$i]['Horario'] ?></td>
                    <th style="text-align:center"><?php echo $vector[$i]['Observaciones']?></td>
                    <th style="text-align:center"><?php echo $vector[$i]['Estado']?></td>
                    <th style="text-align:center"><a href="index.php?ctl=obtiene_todos_los_horarios&id=<?php echo $vector[$i]['ID_Horariop'];?>
                           &Horario=<?php echo $vector[$i]['Horario'];?>
                           &Obser=<?php echo $vector[$i]['Observaciones'];?>
                           &Estado=<?php echo $vector[$i]['Estado'];?>">Editar</a></td>
                    
                </tr>  
              <?php } ?>
            </tbody>
        </table>
           <button><a href="index.php?ctl=obtiene_todos_los_horarios&id=0&Estado=1" class="btn">Agregar Horario</a></button>
       </div>
       <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
       </body>

</html>
