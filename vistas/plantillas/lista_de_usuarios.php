<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Lista de Usuarios</title>       
        <?php require_once 'frm_librerias_head.html';?>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container animated bounceInUp">
            <h2>Listado General de Usuarios</h2>
            <p>A continuación se detallan los diferentes usuarios que están registrados en el sistema:</p> <br>          
            <table id="tabla" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>  
                        <th style="text-align:center">Nombre</th>
                        <th style="text-align:center">Apellido</th>
                        <th style="text-align:center">Cedula</th>
                        <th style="text-align:center">Correo</th>
                        <th style="text-align:center">Rol</th>
                        <th style="text-align:center">Observaciones</th>
                        <th style="text-align:center">Estado</th>
                        <th style="text-align:center">Cambiar Estado</th>
                        <th style="text-align:center">Password</th>
                        <th style="text-align:center">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tam=count($params);

                    for ($i = 0; $i <$tam; $i++) {  ?>
                    <tr>
                        <td style="text-align:center"><?php echo $params[$i]['Nombre'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Apellido'];?></td>
                        <td style="text-align:center"><?php echo $params [$i]['Cedula'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Correo'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Descripcion'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                        <?php 
                        if ($params[$i]['Estado']==1){ ?>  
                            <td>Activo</td>
                        <?php  } else {?>  
                            <td>Inactivo</td>
                        <?php } ?>
                        <td><a href="index.php?ctl=cambiar_estado_usuario&id=
                           <?php echo $params[$i]['ID_Usuario']?>&estado=<?php echo $params[$i]['Estado']?>&rol=<?php echo $params[$i]['ID_Rol']?>">
                               Activar/ Desactivar</a></td>
                        <td><a href="index.php?ctl=reset_password&id=<?php echo $params[$i]['ID_Usuario']."&cedula=".$params[$i]['Cedula']?>"> 
                                Reset Password</a> </td>
                        <td><a href="index.php?ctl=gestion_usuarios&id=<?php echo $params[$i]['ID_Usuario']?>">
                           Editar Usuario</a></td>
                    </tr>     
                    <?php }  ?>
                </tbody>
            </table>
            <a href="index.php?ctl=gestion_usuarios&id=0" class="btn btn-default" role="button">Agregar un Nuevo Usuario</a>
        </div>
        
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>