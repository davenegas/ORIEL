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
        <div class="container">
        <h2>Horarios de los Operadores</h2>
            <form class="form-horizontal" role="form" method="POST" name="form" action="index.php?ctl=guardar_horariop">
            <hr>
            <input hidden="" id="ID_Horariop" name="ID_Horariop" type="text" value="<?php echo $vector[0]['ID_Horariop'];?>">
            
            <label for="nombre">Ingrese Horario</label>                    
            <input type="text" class="form-control espacio-abajo" id="horario" name="horario" placeholder="Horario de trabajo" value="<?php echo $vector[0]['horario'];?>">
            
            <label for="observaciones">Observaciones</label>
            <input type="text" class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones" value="<?php echo $vector[0]['Observaciones'];?>">
            <div class="form-grup">
            <label for="Estado">Estado</label>
                <?php 
                    if($_GET['Estado']=="0"){
                ?>      <select name="Estado" id="Estado" class="form-grup">
                            <option value="0">Desactivado</option>
                            <option value="1">Activo</option>
                        </select>
                <?php  
                    }else {
                ?>
                        <select name="Estado" id="Estado" class="form-grup">
                            <option value="1">Activo</option>
                            <option value="0">Desactivado</option>
                        </select>
                <?php
                            }
                ?>
            </div>
            <br>
            <button type="submit">Guardar Cambios</button>
            </form>
        </div>
         <?php require 'vistas/plantillas/pie_de_pagina.php' ?> 
    </body>
</html>