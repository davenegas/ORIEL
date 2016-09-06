<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Eventos Cerrados</title>
        <?php require_once 'frm_librerias_head.html'; ?>     
        <script>
        
        function recuperar_evento(id_e,id_pbcr,id_tevento){
            
            prueba=id_e;
            prueba2=id_pbcr;
            prueba3=id_tevento;
            
            $.confirm({
            title: 'Confirmación!',
            content: 'Desea recuperar este evento?',
            confirm: function(){
                //alert (prueba+" "+ prueba2 + " " + prueba3 );
                $.post("index.php?ctl=frm_eventos_recuperar", { id_evento: prueba,id_puntobcr:prueba2,id_tipo_evento:prueba3 },function(data){
                    
                     if (data=="1"){
                         $.alert({
                            title: 'Información!',
                            content: 'Ya existe este evento abierto para este punto BCR. Proceda a cerrarlo o agregue un seguimiento!!!',
                            
                        });
                     }else{
                          $.alert({
                            title: 'Información!',
                            content: 'Evento recuperado con éxito!!!',
                            
                        });
                         location.reload();  
                     }
                    
                });  
               
                //location.reload();  
            },
            cancel: function(){
                //$.alert('Canceled!')
            }
            });
            
        }
        
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn">
        <h2>Listado de Eventos Cerrados</h2>
        <a href="index.php?ctl=frm_eventos_listar" class="btn btn-default espacio-abajo" role="button">Volver a Eventos Abiertos</a>
        <table id="tabla" class="display">
          <thead>
               
            <tr>
              <th hidden="true">ID_Evento</th>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Provincia</th>
              <th>Tipo Punto</th>
              <th>Punto BCR</th>
              <th>Codigo</th>
              <th>Tipo de Evento</th>
              <th>Estado del Evento</th>
              <th>Ingresado Por</th>
              <?php
              if ($_SESSION['rol']!=2){
              ?>  
               <th>Gestión</th>
               <?php }
               ?>  
              <th>Consulta</th>
              <!--<th hidden="true">Seguimientos</th>-->          
            </tr>
          </thead>
          <tbody>
        
            <?php 

            $tam=count($params);

            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
            <?php
            $fecha_evento = date_create($params[$i]['Fecha']);
            $fecha_actual = date_create(date("d-m-Y"));
            $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            ?>
                <td hidden="true"><?php echo $params[$i]['ID_Evento'];?></td>
            <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
            <td><?php echo $params[$i]['Hora'];?></td>
            <!--<td align="center"><?php echo $dias_abierto->format('%a');?></td>-->
            <td><?php echo $params[$i]['Nombre_Provincia'];?></td>
            <td><?php echo $params[$i]['Tipo_Punto'];?></td>
            <td><?php echo $params[$i]['Nombre'];?></td>
            <td><?php echo $params[$i]['Codigo'];?></td>
            <td><?php echo $params[$i]['Evento'];?></td>
            <td><?php echo $params[$i]['Estado_Evento'];?></td>
            <td><?php echo $params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido'] ?></td>
            <?php
            if ($_SESSION['rol']!=2){
            ?>  
            <td align="center"><a onclick="recuperar_evento(<?php echo $params[$i]['ID_Evento'];?>,<?php echo $params[$i]['ID_PuntoBCR'];?>,<?php echo $params[$i]['ID_Tipo_Evento'];?>);">Recuperar Evento</a></td>
            
            <?php }
            ?>
            <td align="center"><a href="index.php?ctl=frm_eventos_editar&accion=consulta_cerrados&id=
               <?php echo $params[$i]['ID_Evento']?>">Ver detalle</a></td>
<!--            <td hidden="true">
                <table>
            <thead>
                <tr>
                  <th>Fecha de Seguimiento</th>
                  <th>Detalle del Seguimiento</th>
               </tr>
            </thead>
                <tbody>
                <?php 
                $tama=count($todos_los_seguimientos_juntos);
                for ($j = 0; $j <$tama; $j++) {
                ?>
                <tr>
                <?php
                $fecha_evento = date_create($todos_los_seguimientos_juntos[$j]['Fecha']);
                $fecha_actual = date_create(date("d-m-Y"));
                $dias_abierto= date_diff($fecha_evento, $fecha_actual);
                if ($params[$i]['ID_Evento']==$todos_los_seguimientos_juntos[$j]['ID_Evento']){
                ?>
                
                <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
                <td><?php echo $todos_los_seguimientos_juntos[$j]['Detalle'];?></td>
                               
                <?php }} ?>
                </tbody>
            </table>  
            </td>-->
            </tr>
            <?php }
            ?>
            
            </tbody>
        </table>
        
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>