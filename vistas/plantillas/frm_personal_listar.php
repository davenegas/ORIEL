<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Personal</title>
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
              <!--<th>ID Persona</th>-->
              <th style="text-align:center">Apellido y Nombre</th>
              <th style="text-align:center">Cedula</th>
              <!--<th>Direccion</th>-->
              <th style="text-align:center">Departamento</th>
              <th style="text-align:center">Empresa</th>
              <!--<th>Tipo Telefono</th>-->
              <th style="text-align:center">Telefonos</th>
              <!--<th>Observaciones</th>-->
              <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                <th style="text-align:center">Estado</th>              
                <th style="text-align:center">Cambiar Estado</th>
              <?php }?>
              <th style="text-align:center">Mantenmiento</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tam=count($personas);
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <!--<td><?php echo $personas[$i]['ID_Persona'];?></td>-->
                <td style="text-align:center"><?php echo $personas[$i]['Apellido_Nombre'];?></td>
                <td style="text-align:center"><?php echo $personas[$i]['Cedula'];?></td>
                <!--<td>//<?php echo $personas[$i]['Direccion'];?></td>-->
                <td style="text-align:center"><?php echo $personas[$i]['Departamento'];?></td>
                <td style="text-align:center"><?php echo $personas[$i]['Empresa'];?></td>
                <!--<td><?php echo $personas[$i]['Tipo_Telefono'];?></td>-->
                <td style="text-align:center"><?php echo $personas[$i]['Numero'];?></td>
                <!--<td><?php echo $personas[$i]['Observaciones'];?></td>-->
                <?php if($_SESSION['modulos']['Editar- Personal']==1){
                if ($personas[$i]['Estado']==1){
                  ?>  
                    <td style="text-align:center">Activo</td>
                   <?php 
                }else
                {?>  
                    <td style="text-align:center">Inactivo</td>
                <?php 
                }
                ?>

               <td style="text-align:center"><a href="index.php?ctl=personal_cambiar_estado&id=
                   <?php echo $personas[$i]['ID_Persona']?>&estado=<?php echo $personas[$i]['Estado']?>">
                Activar/Desactivar</a></td> <?php }?>
               <td style="text-align:center"><a href="index.php?ctl=personal_gestion&id=
                   <?php echo $personas[$i]['ID_Persona']?>&estado=<?php echo $personas[$i]['Estado']?>&descripcion=<?php echo $personas[$i]['Observaciones']?>">
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