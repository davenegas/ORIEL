<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Eventos</title>
        <?php require_once 'frm_librerias_head.html'; ?>          
        <script language="javascript" src="vistas/js/refresca_pagina_automaticamente.js"></script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn">
        <h2>Listado de Eventos</h2>
        <!--<p>A continuación se detallan los diferentes roles que están registrados en el sistema:</p>-->            
        <a href="index.php?ctl=frm_eventos_agregar&id=0" class="btn btn-default espacio-abajo" role="button">Agregar Nuevo Evento de Bitácora</a>
        <a href="index.php?ctl=frm_eventos_lista_cerrados" class="btn btn-default espacio-abajo" role="button">Eventos Cerrados</a> 
        <table id="tabla" class="display">
          <thead>
            <tr>
              <th hidden="true">ID_Evento</th>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Lapso</th>
              <th>Provincia</th>
              <th>Tipo Punto</th>
              <th>Punto BCR</th>
              <th>Codigo</th>
              <th>Tipo de Evento</th>
              <th>Estado del Evento</th>
              <th>Último Seguimiento</th>
              <th>Editar Evento</th>
              <th hidden="true">Seguimientos</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tam=count($params);
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr data-toggle="tooltip" title="<?php echo $detalle_y_ultimo_usuario[$i]['Detalle'];?>">
            <?php
            $fecha_evento = date_create($params[$i]['Fecha']);
            $fecha_actual = date_create(date("d-m-Y"));
            $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            ?>
                <td hidden="true"><?php echo $params[$i]['ID_Evento'];?></td>
            <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
            <td><?php echo $params[$i]['Hora'];?></td>
            <td align="center"><?php echo $dias_abierto->format('%a');?></td>
            <td><?php echo $params[$i]['Nombre_Provincia'];?></td>
            <td><?php echo $params[$i]['Tipo_Punto'];?></td>
            <td><?php echo $params[$i]['Nombre'];?></td>
            <td><?php echo $params[$i]['Codigo'];?></td>
            <td><?php echo $params[$i]['Evento'];?></td>
            <td><?php echo $params[$i]['Estado_Evento'];?></td>
            <!--<td><?php echo $params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido'] ?></td>-->
            <td><?php echo $detalle_y_ultimo_usuario[$i]['Usuario'] ?></td>
            <td align="center"><a href="index.php?ctl=frm_eventos_editar&accion=editar_abiertos&id=
               <?php echo $params[$i]['ID_Evento']?>">Gestionar Seguimiento</a></td>
            <td hidden="true">
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
            </td>
            </tr>
            
            <?php }
            ?>
            </tbody>
            
        </table>
        
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>