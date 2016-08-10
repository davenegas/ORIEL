<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Empresas</title>
        <?php require_once 'frm_librerias_head.html'; ?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
        <h2>Gestión de Empresas</h2>
        <p>Mediante esta pantalla, podrá agregar o editar empresas:</p>
        <div class="container">
        <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=empresa_guardar&id=<?php echo trim($ide);?>">
        <div class="form-group">
          <label for="empresa">Nombre de la Empresa</label>
          <input type="text" required="required" class="form-control" id="empresa" name="empresa" value="<?php echo $empresa;?>">
        </div>
        <div class="form-group">
          <label for="observaciones">Observaciones</label>
          <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $observaciones;?>">
        </div>
        <div class="form-group">
        <label for="sel1">Estado</label>
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
        <td><a href="index.php?ctl=empresas_listar" class="btn btn-default" role="button">Cancelar</a></td>
      </form>     
      <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>