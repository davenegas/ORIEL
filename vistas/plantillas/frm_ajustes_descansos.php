<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista Descansos</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_trazabilidad.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>     
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
      <div class="container">
        
            <form class="form_horizontal" role="form" method="POST" name="form" action="index.php?ctl=guardar_descansos">
               <h3>Ajustes de Descanso</h3>    
               <hr>
               <input hidden="" id="ID_Ajus_Descanso" name="ID_Ajus_Descanso" type="text" Value="<?php echo $vector[0]['ID_Ajus_Descanso'];?>">    
              
               <label for="Duracion_Descanso">Duracion de descansos</label>
               <input class="form-control espacio-abajo"  id="Duracion_Descanso" name="Duracion" placeholder="Formato de Ingreso 00:00:00 h-m-s" type="text" value="<?php echo $vector[0]['Duracion'];?>"
               
               <label for="Observaciones">Observaciones</label>
               <input class="form-control espacio-abajo"  id="Observaciones" name="Observaciones" placeholder="Observaciones" type="text" value="<?php echo $vector[0]['Observaciones'];?>">
               <div class="form-grup">
               <label for="Estado">Estado</label>
                    <?php 
                        if($_GET['estado']=="0"){
                    ?>      <select name="Estado" id="Estado" class="form-grup">
                                <option value="0">Invalido</option>
                                <option value="1">Valido</option>
                            </select>
                    <?php  
                        }else {
                    ?>
                            <select name="Estado" id="Estado" class="form-grup">
                                <option value="1">Valido</option>
                                <option value="0">Invalido</option>
                            </select>
                    <?php
                        }
                    ?>
                </div>
               <br>
               <button type="submit">Guardar</button>
            </form>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>    
    </body>
</html>