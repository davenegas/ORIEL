<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Traza del Sistema</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_trazabilidad.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>     
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn">
        <h2>Generar Reporte de Trazabilidad del Sistema</h2>    
        <h4>Escoger parámetros del filtro:</h4>
        <hr/> 
        <div class="col-xs-3">
              <label for="fecha_inicial">Fecha Inicial:</label>
              <input type="date" required=”required” class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo date("Y-m-d");?>">
        </div> 
         <div class="col-xs-3">
              <label for="fecha_final">Fecha Final:</label>
              <input type="date" required=”required” class="form-control" id="fecha_final" name="fecha_final" value="<?php echo date("Y-m-d");?>">
        </div> 
        
         <div class="col-xs-3">
                <label for="lista_usuarios">Usuario:</label>
                <select class="form-control" required=”required” id="lista_usuarios" name="lista_usuarios" > 
                    <option value="0" selected="true">Todos los Usuarios</option>
                <?php
                    $tam_lista_usuarios = count($lista_de_usuarios);

                    for($i=0; $i<$tam_lista_usuarios;$i++)
                    {                      
                           ?> 
                    <option value="<?php echo  $lista_de_usuarios[$i]['ID_Usuario']?>"><?php echo  $lista_de_usuarios[$i]['Nombre_Completo']?></option>
                    <?php

                    } ?>  
                </select>
            </div>
        
        <div class="col-xs-3">
                <label for="tabla_afectada">Tabla Afectada:</label>
                <select class="form-control" required=”required” id="tabla_afectada" name="tabla_afectada" > 
                     <option value="todas" selected="true">Todas las Tablas</option>
                <?php
                    $tam_tabla_afectadas = count($lista_tablas_afectadas);

                    for($i=0; $i<$tam_tabla_afectadas;$i++)
                    {                      
                           ?> 
                    <option value="<?php echo $lista_tablas_afectadas[$i]['Tabla_Afectada']?>"><?php echo $lista_tablas_afectadas[$i]['Tabla_Afectada']?></option>
                    <?php

                    } ?>  
                </select>
                
        </div>
        
        <hr/> <hr/> <hr/> <hr/> 
                <!--<button value="esto es un boton" onclick="mi_funcion()"/>-->
                <a class="btn btn-default" role="button" id="prueba" name="prueba" onclick="hacer_click()">Generar Reporte</a>
                <a href="index.php?ctl=principal" class="btn btn-default" role="button">Cancelar</a>
          
        <h2>Listado de Trazabilidad del Sistema</h2>
        
        <!--<p>A continuación se detallan los diferentes roles que están registrados en el sistema:</p>-->  
        <section class="full-height">
        <table id="tabla" class="display2">
          <thead>
            <tr>
              <th>ID_Traza</th>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Antiguedad Dias</th>
              <th>Usuario</th>
              <th>Tabla Afectada</th>
              <th>Dato Actualizado</th>
              <th>Dato Anterior</th>
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
            <td><?php echo $params[$i]['ID_Traza'];?></td>
            <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
            <td><?php echo $params[$i]['Hora'];?></td>
            <td align="center"><?php echo $dias_abierto->format('%a');?></td>
            <td><?php echo $params[$i]['Nombre']." ".$params[$i]['Apellido'] ?></td>
            <td><?php echo $params[$i]['Tabla_Afectada'];?></td>
            <td><?php echo $params[$i]['Dato_Actualizado'];?></td>
            <td><?php echo $params[$i]['Dato_Anterior'];?></td>
            </tr>
            <?php }
            ?>
            </tbody>
        </table>
        </section>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>