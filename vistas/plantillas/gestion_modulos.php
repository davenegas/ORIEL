<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Módulos</title>
     <link href="../../../bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <script src="vistas/js/jquery.min.js"></script>    
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>-->      
  <script src="../../../bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
        <h2>Gestión de Módulos de Seguridad</h2>
        <p>Mediante esta pantalla, podrá agregar o editar módulos de seguridad:</p>
        <div class="container">
        <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=modulos_guardar&id=<?php echo trim($ide);?>">
        <div class="form-group">
          <label for="email">Descripción/Nombre de Módulo</label>
          <input type="text" required="required" class="form-control" id="descripcion" name="descripcion" value="<?php echo $desc;?>">
        </div>
        <div class="form-group">
        <label for="sel1">Estado</label>
        <select class="form-control" id="estado" name="estado" >
            <?php if ($esta==1){
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
        <td><a href="index.php?ctl=modulos_listar" class="btn btn-default" role="button">Cancelar</a></td>
      </form>     
      <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>