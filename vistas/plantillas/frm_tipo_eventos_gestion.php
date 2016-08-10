<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Tipo de Eventos</title>
        <?php require_once 'frm_librerias_head.html'; ?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
        <h2>Gestión de Tipo de Eventos</h2>
        <p>Mediante esta pantalla, podrá agregar o editar lod tipos de evento:</p>
        <div class="container">
        <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=tipo_eventos_guardar&id=<?php echo trim($ide);?>">
        <div class="form-group">
          <label for="evento">Nombre del Evento</label>
          <input type="text" required="required" class="form-control" id="evento" name="evento" value="<?php echo $evento;?>">
        </div>
        <div class="form-group">
          <label for="observaciones">Observaciones</label>
          <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $observaciones;?>">
        </div>
        <div class="form-group">
            <label for="prioridad">Prioridad</label>
            <select class="form-control" id="prioridad" name="prioridad" >
            <?php if ($prioridad==1){
            ?>
                <option value="1" selected="selected">1- Baja</option>
                <option value="2">2- Alta</option>  
            <?php
            }  else {
            ?>
               <option value="1">1- Baja</option>
               <option value="2" selected="selected">2- Alta</option>   
            <?php
            }
            ?>  
        </select>
        </div>
        <div class="form-group">
        <label for="estado">Estado</label>
        <select class="form-control" id="estado" name="estado" >
            <?php if ($estado==1){
            ?>
                <option value="Activo" selected="selected">Activo</option>
                <option value="Inactivo">Inactivo</option>  
            <?php
            }  else {
            ?>
               <option value="Activo">Activo</option>
               <option value="Inactivo" selected="selected">Inactivo</option>   
            <?php
            }
            ?>  
        </select>
      </div>
        <button type="submit" class="btn btn-default">Guardar</button>
        <td><a href="index.php?ctl=tipo_eventos_listar" class="btn btn-default" role="button">Cancelar</a></td>
      </form>     
      <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>