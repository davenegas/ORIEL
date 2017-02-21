
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Lista de Asistencia Usuario</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <script src="Vista/js/jquery-2.1.1.min.js"></script>        
        <script src="../../../bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    </head>
    
    <body>
         <?php require_once 'encabezado.php';?>
        <h3>Reportes Asistencia de Personal</h3>
        <br>
        <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th style="text-align:center">ID_Usuario</th>
                    <th style="text-align:center">Cedula  </th>
                    <th style="text-align:center">Nombre  </th>
                    <th style="text-align:center">Fecha  </th>
                    <th style="text-align:center">Hora de Entrada  </th> 
                    <th style="text-align:center">Justificar Entrada </th>       
                    <th style="text-align:center">Hora de Salida </th>
                    <th style="text-align:center">Justificar Salida </th>  
                    <th style="text-align:center">Salida al Descanso </th>
                    <th style="text-align:center">Entrada del Descanso </th>
                    <th style="text-align:center">Justificar Descanso </th>
                    <th style="text-align:center">Total </th>
                    <th style="text-align:center">Duracion </th>               
                 </tr>
             </thead>
            <tbody>
                <?php
                $tam_usuario= count($usuarios); 
                for($i=0;$i<$tam_usuario;$i++){
 
               ?>
                <tr> 
                     <th style="text-align:center"><?php echo $usuarios[$i]['ID_Usuario'] ?></td> 
                     <td><?php echo $usuarios[$i]['Cedula'] ?></td> 
                     <td><?php echo $usuarios[$i]['Nombre']." ".$usuarios[$i]['Apellido'] ?></td>
                     <?php $tam_marcas=count($marcas);
                     for($i_marcas=0;$i_marcas<$tam_marcas;$i_marcas++){ ?>
                        <th style="text-align:center"><?php echo $marcas[$i]['Fecha'] ?></td>
                        <td><?php echo $marcas[$i]['Hora_Entrada_Turno'] ?></td>
                        <td><?php echo $marcas[$i]['Justificar_Entrada'] ?></td>
                        <td><?php echo $marcas[$i]['Hora_Salida_Turno']?></td>
                        <td><?php echo $marcas[$i]['Justificar_Salida']?></td>
                     
                     <?php } ?>
                     <?php $tam_marcas_descanso=count($marcas_descanso); 
                     for($i_marcas_descanso=0;$i_marcas_descanso<$tam_marcas_descanso;$i_marcas_descanso++){?>
                     
                        <td><?php echo $marcas_descanso[$i]['Hora_Descanso_Salida'] ?></td>
                        <td><?php echo $marcas_descanso[$i]['Hora_Descanso_Entrada'] ?></td>
                        <td><?php echo $marcas_descanso[$i]['Justificar_Descanso'] ?></td>
                        <th style="text-align:center"><?php echo $marcas_descanso[$i]['Total_Descanso'] ?></td> 
                        <th style="text-align:center"><?php echo $marcas_descanso[$i]['Duracion_Descanso'] ?></td> 
                     <?php } ?>
                </tr>     
                <?php } ?>
            </tbody>
        </table>  
        </div>
         <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
      </body>
</html>
