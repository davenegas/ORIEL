<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Padrón Fotográfico Puntos BCR</title>
        <?php require_once 'frm_librerias_head.html';?>
         <script>
         $(document).ready(function() {
            $(".fancybox-button").fancybox({
                    prevEffect		: 'none',
                    nextEffect		: 'none',
                    closeBtn		: false,
                    helpers		: {
                            title	: { type : 'inside' },
                            buttons	: {}
                    }
            });
        });
        
        function eliminar_imagen(id_imagen){
            
            id=id_imagen;
            //n_ruta=ruta_imagen;
            
            $.confirm({
            title: 'Confirmación!',
            content: 'Desea eliminar esta imagen?',
            confirm: function(){
                //alert (id_imagen );
                $.post("index.php?ctl=eliminar_imagen_prontuario_puntobcr", {id_imagen:id_imagen});//,function(data){
                               $.alert({
                            title: 'Información!',
                            content: 'Imágen eliminada con exito con éxito!!!',
                            
                        });       
                        location.reload();  
            },
            cancel: function(){
              
            }
            });
            
        }  
        </script>
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
                        <option value="Salud Ocupacional" >Salud Ocupacional</option>   
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
            
            
             <table id="tabla" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>  
                <th style="text-align:center">Categoría</th>
                <th style="text-align:center">Nombre Imágen</th>
                <th style="text-align:center">Descripción</th>
                <th style="text-align:center">Imágen</th>
                <!--<th style="text-align:center" hidden="hidden">ID_Imagen</th>-->
                <th style="text-align:center">Gestión</th>
<!--                <th style="text-align:center">Rol</th>
                <th style="text-align:center">Observaciones</th>
                <th style="text-align:center">Estado</th>
                <th style="text-align:center">Cambiar Estado</th>
                <th style="text-align:center">Password</th>
                <th style="text-align:center">Editar</th>-->
            </tr>
          </thead>

          <tbody>
            <?php
            $tam=count($params);
            
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
            <td style="text-align:center"><?php echo $params[$i]['categoria'];?></td>
            <td style="text-align:center"><?php echo $params[$i]['nombre_imagen'];?></td>
            <td style="text-align:center"><?php echo $params [$i]['descripcion'];?></td>
            <td style="text-align:center"><a class="fancybox-button" rel="fancybox-button" href="../../../Padron_Fotografico_Puntos_BCR/<?php echo $params[$i]['nombre_ruta'];?>" title="<?php echo $params[$i]['nombre_imagen'].' ('.$params[$i]['descripcion'].')';?>">
                <img src="../../../Padron_Fotografico_Puntos_BCR/<?php echo $params[$i]['nombre_ruta'];?>" alt="" width="200px"/></a></td>
            <td align="center"><a onclick="eliminar_imagen(<?php echo $params[$i]['ID_padron_puntobcr'];?>);">Eliminar</a></td>    
            <!--<td style="text-align:center"><?php echo $params[$i]['nombre_ruta'].'.'.$params[$i]['formato'];?></td>-->
            <!--<td style="text-align:center"><img src="../../../Padron_Fotografico_Puntos_BCR/<?php echo $params[$i]['nombre_ruta'];?>" alt="" width="100" height="100"/></td>-->
<!--            <td style="text-align:center"><?php echo $params[$i]['Descripcion'];?></td>

            <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>-->
           
<!--            <td><a href="index.php?ctl=cambiar_estado_usuario&id=
               <?php echo $params[$i]['ID_Usuario']?>&estado=<?php echo $params[$i]['Estado']?>&rol=<?php echo $params[$i]['ID_Rol']?>">
                   Activar/ Desactivar</a></td>
            <td><a href="index.php?ctl=reset_password&id=<?php echo $params[$i]['ID_Usuario']."&cedula=".$params[$i]['Cedula']?>"> 
                    Reset Password</a> </td>
            <td><a href="index.php?ctl=gestion_usuarios&id=<?php echo $params[$i]['ID_Usuario']?>">
                   Editar Usuario</a></td>-->
            </tr>     
                    
            <?php }
            ?>
            </tbody>
        </table>
            
            
            
            
            

        </div>

            <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>
