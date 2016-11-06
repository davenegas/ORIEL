<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Padrón Fotográfico Puntos BCR</title>
        <?php require_once 'frm_librerias_head.html';?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container animated fadeIn">
            <h1 align="center">Padrón Fotográfico</h1>
            <h3>Agregar nueva Imágen</h3>
                
                <!--Agregar nuevo detalle o seguimiento del evento-->
                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="index.php?ctl=guardar_imagen_puntos_bcr">
              
                <div class="col-xs-12 quitar-float espacio-abajo">
                    <label for="archivo_adjunto">Adjuntar Archivo: </label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                    <input type="file" name="archivo_adjunto" id="seleccionar_archivo" class="btn btn-default">
                </div>   
              
                <div class="col-xs-4">
                    <label for="Nombre">Nombre</label>
                    <input type="text" required=”required” class="form-control" id="Nombre" name="Nombre" >
                </div>
              
              <div hidden="hidden" class="col-xs-4">
                    <label for="id_punto_bcr">id_punto_bcr</label>
                    <input type="text" class="form-control" id="id_punto_bcr" name="id_punto_bcr" value="<?php echo $_GET['id'];?>">
                </div>
                
                <div class="col-xs-4">
                    <label for="Descripcion">Descripción</label>
                    <textarea type="text" required=”required” class="form-control" id="Descripcion" name="Descripcion" value="" maxlength="500" minlength="5" placeholder="Máximo 500 caracteres por seguimiento"></textarea>
                </div>
                
                <div class="col-xs-4 espacio-abajo">
                    <label for="Categoria">Categoría</label>
                    <select class="form-control espacio-abajo" id="Categoria" name="Categoria" required=”required”> 
                        <option value="Equipos de Respaldo y Soporte" >Equipos Ambientales</option>  
                        <option value="Equipos de Respaldo y Soporte" >Equipos de Respaldo y Soporte</option>  
                        <option value="Equipos de Seguridad" >Equipos de Seguridad</option>   
                        <option value="Equipos de Telecomunicaciones" >Equipos de Telecomunicaciones</option>   
                        <option value="Vista Atms" >Vista Atms</option>   
                        <option value="Vista Estructural" >Vista Estructural</option>  
                        <option value="Vista Estructural" >Vista Geográfica</option>   
                         <option value="Vista General Exterior" >Vista General Exterior</option>  
                        <option value="Vista General Interior" >Vista General Interior</option>   
 
                    </select>
                </div>
                    
                <button type="submit" class="btn btn-default">Guardar Imágen</button>
                <!--<button type="submit" class="btn btn-default">Guardar Seguimiento</button>-->
               
            </form>
        
       
        
        <!--Detalles de Evento--> 
            <hr/>
            <a href="index.php?ctl=gestion_punto_bcr&id=<?php echo $_GET['id'];?>" class="btn btn-default" role="button">Volver</a>
            <h3>Visualización de Imágenes</h3>

        </div>

            <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>
