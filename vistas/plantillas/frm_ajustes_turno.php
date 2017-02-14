<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Turnos</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_trazabilidad.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>     
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <form class="form-horizontal" role="form" method="POST" name="form" action="index.php?ctl=guardar_turno">
                <h3>Turno Operadores</h3>
                <hr>
                <input hidden="" id="ID_Turno" name="ID_Turno" type="text" value="<?php echo $vector[0]['ID_Turno'];?>">

                <label for="nombre">Ingrese el Turno</label>
                <input class="form-control espacio-abajo" required id="nombre" name="nombre" placeholder="Digite el Turno" type="text" value="<?php echo $vector[0]['nombre'];?>">

                <label for="observaciones">Observaciones</label>
                <input type="text" class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones" value="<?php echo $vector[0]['Observaciones'];?>">

                <div class="form-grup">
                       <label for="Estado">Estado</label>
                       <?php 
                            if($_GET['estado']=="0"){
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
<!--                       <select id="estado" class="form-control">
                           <option value="1">Valido</option>
                           <option value="0">Invalido</option>
                       </select>-->
                </div>
                <br>
               <button type="submit">Guardar Cambios</button>
            </form>
        </div>
           <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>