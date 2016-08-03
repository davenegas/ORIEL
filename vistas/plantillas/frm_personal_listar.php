<?php
ob_start();
?>
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Personal</title>
        <?php require_once 'frm_librerias_head.html';?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container">
        <h2>Listado General de Personal</h2>
        <p>A continuación se detallan las personas relacionadas el BCR:</p>    
        <table id="tabla" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID Persona</th>
              <th>Apellido y Nombre</th>
              <th>Cedula</th>
              <!--<th>Direccion</th>-->
              <th>Departamento</th>
              <th>Empresa</th>
              <th>Tipo Telefono</th>
              <th>Numero Telefono</th>
              <th>Observaciones</th>
              <th>Estado</th>              
              <th>Cambiar Estado</th>
              <th>Mantenmiento</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tam=count($personas);
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <td><?php echo $personas[$i]['ID_Persona'];?></td>
                <td><?php echo $personas[$i]['Apellido_Nombre'];?></td>
                <td><?php echo $personas[$i]['Cedula'];?></td>
                <!--<td>//<?php echo $personas[$i]['Direccion'];?></td>-->
                <td><?php echo $personas[$i]['Departamento'];?></td>
                <td><?php echo $personas[$i]['Empresa'];?></td>
                <td><?php echo $personas[$i]['Tipo_Telefono'];?></td>
                <td><?php echo $personas[$i]['Numero'];?></td>
                <td><?php echo $personas[$i]['Observaciones'];?></td>
            <?php 
            if ($personas[$i]['Estado']==1){
              ?>  
                <td>Activo</td>
               <?php 
            }else
            {?>  
                <td>Inactivo</td>
            <?php 
            }
            ?>
                
           <td><a href="index.php?ctl=cambiar_estado_persona&id=
               <?php echo $personas[$i]['ID_Persona']?>&estado=<?php echo $personas[$i]['Estado']?>">
                   Activar/Desactivar</a></td>
           <td><a href="index.php?ctl=gestion_persona&id=
               <?php echo $personas[$i]['ID_Persona']?>&estado=<?php echo $personas[$i]['Estado']?>&descripcion=<?php echo $personas[$i]['Observaciones']?>">
                   Editar</a></td>
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

<?php
// Recuperación en una variable del código HTML generado
$html = ob_get_contents();
 
// Envío al cliente del código HTML
ob_end_flush();
?>