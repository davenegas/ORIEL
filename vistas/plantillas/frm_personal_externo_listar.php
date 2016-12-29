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
<<<<<<< HEAD
        <div class="container">
        <h2>Listado General de Personal</h2>
=======
        <div class="container-fluid text-center">
        <div class="row content">
        <!--Se mantienen este div para dejar espacio a la izquierda de la tabla-->    
        <div class="col-sm-1 sidenav">
        </div>
        <!--DIV central contiene la tabla con el personal externo--> 
        <?php if(isset($vencidos)){?>
            <div class="col-sm-8 container">
        <?php } else { ?>
            <div class="col-sm-10 container">    
        <?php } ?>
        <h2>Listado General de Personal externo</h2>
>>>>>>> origin/master
        <p>A continuación se detallan las personas relacionadas el BCR:</p>    
        <table id="tabla" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
<<<<<<< HEAD
                <!--<th style="text-align:center">ID Persona</th>-->
=======
                <th hidden style="text-align:center">ID Persona</th>
>>>>>>> origin/master
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
<<<<<<< HEAD
                <!--<td style="text-align:center"><?php echo $personas[$i]['ID_Persona'];?></td>-->
                <td style="text-align:center"><?php echo $personas[$i]['Idenficacion'];?></td>
                <td style="text-align:center"><?php echo $personas[$i]['Empresa'];?></td>
                <td style="text-align:center"><?php echo $personas[$i]['Numero'];?></td>
                <td style="text-align:center"><?php echo $personas[$i]['Estado_Persona'];?></td>
                <td style="text-align:center"><a href="index.php?ctl=personal_externo_gestion&id=<?php echo $personas[$i]['ID_Persona']?>">
=======
                <td hidden style="text-align:center"><?php echo $params[$i]['ID_Persona_Externa'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Identificacion'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Nombre'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Apellido'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Empresa'];?></td>
                <!--Verifica si la persona esta validada o esta pendiente-->
                <?php   if ($params[$i]['Validado']==1){    ?>  
                <td style="text-align:center">Validado</td>
                <?php }  else{   ?>  
                    <td style="text-align:center" class="rojo">Pendiente</td>
                <?php } ?>  
                <td style="text-align:center"><?php echo $params[$i]['Nombre_Estado'];?></td>
                <td style="text-align:center"><a href="index.php?ctl=personal_externo_gestion&id=<?php echo $params[$i]['ID_Persona_Externa']?>">
>>>>>>> origin/master
                       Detalle</a></td>
            </tr>           
            <?php }
            ?>
            </tbody>
        </table>
        <a href="index.php?ctl=personal_externo_gestion&id=0" class="btn btn-default" role="button">Agregar Nueva Persona</a>
        </div>
            
        <div class="col-sm-3 sidenav">
            <?php if(isset($vencidos)){?>
            <div class="well">
                <p>Estado de permisos de portación</p>
            </div>
            <div class="well" align="left">
                <?php 
                $tam=count($vencidos);
                for ($i = 0; $i <$tam; $i++) {?>
                <p><?php echo "-".$vencidos[$i]['Mensaje'];?></p>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>