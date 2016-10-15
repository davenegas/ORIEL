<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Personal Externo</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script>
          $(document).ready(function () {
            // Una vez se cargue al completo la página desaparecerá el div "cargando"
            $('#cargando').hide();
          });
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div id="cargando">
            <center><img align="center" src="vistas/Imagenes/Espere.gif"/></center>
        </div>
        <div class="container">
        <h2>Listado General de Personal</h2>
        <p>A continuación se detallan las personas relacionadas el BCR:</p>    
        <table id="tabla" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
                <!--<th style="text-align:center">ID Persona</th>-->
                <th style="text-align:center">Identificación</th>
                <th style="text-align:center">Apellido y Nombre</th>
                <th style="text-align:center">Empresa</th>
                <th style="text-align:center">Telefonos</th>
                <th style="text-align:center">Estado</th>
                <th style="text-align:center">Detalle</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tam=count($personas);
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <!--<td style="text-align:center"><?php echo $personas[$i]['ID_Persona'];?></td>-->
                <td style="text-align:center"><?php echo $personas[$i]['Idenficacion'];?></td>
                <td style="text-align:center"><?php echo $personas[$i]['Empresa'];?></td>
                <td style="text-align:center"><?php echo $personas[$i]['Numero'];?></td>
                <td style="text-align:center"><?php echo $personas[$i]['Estado_Persona'];?></td>
                <td style="text-align:center"><a href="index.php?ctl=personal_externo_gestion&id=<?php echo $personas[$i]['ID_Persona']?>">
                       Detalle</a></td>
            </tr>           
            <?php }
            ?>
            </tbody>
        </table>
        <a href="index.php?ctl=frm_personal_gestion&id=0" class="btn btn-default" role="button">Agregar Nueva Persona</a>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>