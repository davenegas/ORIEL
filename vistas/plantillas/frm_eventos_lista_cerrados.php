<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Eventos Cerrados</title>
        <?php require_once 'frm_librerias_head.html'; ?>     
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn">
        <h2>Listado de Eventos Cerrados</h2>
        <table id="tabla" class="display">
          <thead>
               
            <tr>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Lapso</th>
              <th>Provincia</th>
              <th>Tipo Punto</th>
              <th>Punto BCR</th>
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
            <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
            <td><?php echo $params[$i]['Hora'];?></td>
            <td align="center"><?php echo $dias_abierto->format('%a');?></td>
            <td><?php echo $params[$i]['Nombre_Provincia'];?></td>
            <td><?php echo $params[$i]['Tipo_Punto'];?></td>
            <td><?php echo $params[$i]['Nombre'];?></td>
            <td><?php echo $params[$i]['Evento'];?></td>
            <td><?php echo $params[$i]['Estado_Evento'];?></td>
            <td><?php echo $params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido'] ?></td>
            <?php
            if ($_SESSION['rol']!=2){
            ?>  
            <td align="center"><a href="index.php?ctl=frm_eventos_recuperar&id_evento=
               <?php echo $params[$i]['ID_Evento']?>&id_puntobcr=
               <?php echo $params[$i]['ID_PuntoBCR']?>&id_tipo_evento=
               <?php echo $params[$i]['ID_Tipo_Evento']?>">Recuperar Evento</a></td>
            
            <?php }
            ?>
            <td align="center"><a href="index.php?ctl=frm_eventos_editar&accion=consulta_cerrados&id=
               <?php echo $params[$i]['ID_Evento']?>">Ver detalle</a></td>
            
            </tr>
            <?php }
            ?>
            
            </tbody>
        </table>
        <a href="index.php?ctl=frm_eventos_listar" class="btn btn-default" role="button">Volver a Eventos Abiertos</a>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>