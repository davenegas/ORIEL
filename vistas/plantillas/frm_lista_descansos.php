<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista Descansos</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?> 
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
<script>
    function alerta(){
        alert('Ya no puede ingresar mas Descansos')
    }
</script>   
    </head>
    <body>
    <div class="container">
    <?php require_once 'encabezado.php';?>
        <h3>Lista Descansos Operadores</h3>
        <br>
        <table class="table">
            <thead>
                <tr>
                     <th style="text-align:center" >ID_Descanso</th>
                     <th style="text-align:center" >Duracion Descanso</th>
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
                     <th style="text-align:center" ><?php echo $vector[$i]['ID_Ajus_Descanso'] ?></td>
                     <th style="text-align:center" ><?php echo $vector[$i]['Duracion_Descanso']?></td>
                     <th style="text-align:center" ><?php echo $vector[$i]['Observaciones']?></td>
                     <th style="text-align:center" ><?php echo $vector[$i]['Estado']?></td>
                         
                     <th style="text-align:center" ><a href="index.php?ctl=obtiene_todos_los_descansos&id=<?php echo $vector[$i]['ID_Ajus_Descanso'];?>                         
                           &Duracion_Descanso=<?php echo $vector[$i]['Duracion_Descanso'];?>
                           &Observaciones=<?php echo $vector[$i]['Observaciones'];?>
                           &estado=<?php echo $vector[$i]['Estado'];?>">Editar</a></td>
                    
                <?php } ?>
            </tbody>
        </table>
        <?php
            if($tam<10){
                ?>
                  <button id="boton"><a href="index.php?ctl=obtiene_todos_los_descansos&id=0&estado=1" class="btn">Nuevo</a></button>
                <?php  
            }else{
                ?>
                  <button id="boton"><a onclick="alerta()" class="btn">Nuevo</a></button>
        <?php    }
        ?>
       <?php require 'vistas/plantillas/pie_de_pagina.php' ?>    
    </div>
      </body>
</html>
