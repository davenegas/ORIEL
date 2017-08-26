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
                var ruta_imagen=document.getElementsByTagName("td")[5].innerHTML;
                //alert(id_imagen);
                $.confirm({
                    title: 'Confirmación!',
                    content: 'Desea eliminar esta imagen?',
                    confirm: function(){
                        //alert (id_imagen );
                        $.post("index.php?ctl=eliminar_imagen_padron_puntobcr", {id_imagen:id_imagen,ruta_imagen:ruta_imagen});//,function(data){
                            $.alert({
                                title: 'Información!',
                                content: 'Imagen eliminada con éxito!!!',
                            });       
                            location.reload();  
                    },
                    cancel: function(){}
                });
            }  
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container animated fadeIn">
            <h1 align="center">Padrón Fotográfico</h1>
            <?php if($_SESSION['modulos']['Editar- Padrón Fotográfico Puntos BCR']==1){ ?>
                <h3>Agregar nueva Imagen (no aplica para capturas de grabador de video)</h3>
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
                        <textarea type="text" required=”required” class="form-control" id="Descripcion" name="Descripcion" value="" maxlength="500" minlength="2" placeholder="Máximo 500 caracteres por seguimiento"></textarea>
                    </div>

                    <div class="col-xs-4 espacio-abajo">
                        <label for="Categoria">Categoría</label>
                        <select class="form-control espacio-abajo" id="Categoria" name="Categoria" required=”required”> 
                            <option value="Equipos Ambientales" >Equipos Ambientales</option>  
                            <option value="Equipos de Respaldo y Soporte" >Equipos de Respaldo y Soporte</option>  
                            <option value="Equipos de Seguridad" >Equipos de Seguridad</option>   
                            <option value="Equipos de Telecomunicaciones" >Equipos de Telecomunicaciones</option>   
                            <option value="Salud Ocupacional" >Salud Ocupacional</option>   
                            <option value="Vista Atms" >Vista Atms</option>   
                            <option value="Vista Estructural" >Vista Estructural</option>  
                            <option value="Vista Geográfica" >Vista Geográfica</option>   
                            <option value="Vista General Exterior" >Vista General Exterior</option>  
                            <option value="Vista General Interior" >Vista General Interior</option>   
                        </select>
                    </div>

                <button type="submit" class="btn btn-default">Guardar Imagen</button>
                </form>
            <?php }?>
        
            <!--Detalles de Evento--> 
            <hr/>
            <a href="index.php?ctl=gestion_punto_bcr&id=<?php echo $_GET['id'];?>" class="btn btn-default" role="button">Volver</a>
            <h3>Visualización de Imágenes del Punto BCR (<?php echo trim($params_puntobcr[0]['Nombre']);?>)</h3>
            
            <table id="tabla" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>  
                        <th style="text-align:center">Categoría</th>
                        <th style="text-align:center">Nombre Imagen</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Imagen</th>
                        <?php if($_SESSION['modulos']['Editar- Padrón Fotográfico Puntos BCR']==1){ ?>
                            <th style="text-align:center">Gestión</th>
                        <?php } ?>
                        <th style="text-align:center" hidden="hidden">Nombre Ruta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tam=count($params);

                    for ($i = 0; $i <$tam; $i++) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $params[$i]['Categoria'];?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Nombre_Imagen'];?></td>
                            <td style="text-align:center"><?php echo $params [$i]['Descripcion'];?></td>
                            <td style="text-align:center"><a class="fancybox-button" rel="fancybox-button" href="../../../Padron_Fotografico_Puntos_BCR/<?php echo $params[$i]['Nombre_Ruta'];?>" title="<?php echo $params[$i]['Nombre_Imagen'].' ('.$params[$i]['Descripcion'].')';?>">
                                <img src="../../../Padron_Fotografico_Puntos_BCR/<?php echo $params[$i]['Nombre_Ruta'];?>" alt="" width="200px"/></a></td>
                            <?php if($_SESSION['modulos']['Editar- Padrón Fotográfico Puntos BCR']==1){ ?>
                                <td align="center"><a onclick="eliminar_imagen(<?php echo $params[$i]['ID_Padron_PuntoBCR'];?>);">Eliminar</a></td>    
                            <?php } ?>
                            <td style="text-align:center" hidden="hidden"><?php echo $params [$i]['Nombre_Ruta'];?></td>
                        </tr>     
                    <?php } ?>
                </tbody>
            </table>
            
            <?php if ($_SESSION['modulos']['Módulo-Puestos de Monitoreo']==1){?>
            <h3>Visualización de Capturas de Control de Video Referentes al Punto BCR</h3>
            
            
            <table id="tabla2" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>  
                <th style="text-align:center">Categoría</th>
                <th style="text-align:center">Nombre Imagen</th>
                <th style="text-align:center">Descripción</th>
                <th style="text-align:center">Imagen</th>
                
                <th style="text-align:center" hidden="hidden">Nombre Ruta</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $tam=count($params_unidades);
            
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
            <?php if ($params_unidades[$i]['Categoria']==0){ ?>
            <td style="text-align:center">Día</td>
            <?php }  else { ?>
            <td style="text-align:center">Noche</td> 
            <?php } ?>  
           
            <td style="text-align:center"><?php echo $params_unidades[$i]['Nombre_Imagen'];?></td>
            <td style="text-align:center"><?php echo $params_unidades [$i]['Descripcion'];?></td>
            <td style="text-align:center"><a class="fancybox-button" rel="fancybox-button" href="../../../Padron_Fotografico_Unidades_Video/<?php echo $params_unidades[$i]['Nombre_Ruta'];?>" title="<?php echo $params_unidades[$i]['Nombre_Imagen'].' ('.$params_unidades[$i]['Descripcion'].')';?>">
                <img src="../../../Padron_Fotografico_Unidades_Video/<?php echo $params_unidades[$i]['Nombre_Ruta'];?>" alt="" width="200px"/></a></td>
          
            <td style="text-align:center" hidden="hidden"><?php echo $params_unidades [$i]['Nombre_Ruta'];?></td>
           
            </tr>     
                    
            <?php }
            ?>
            </tbody>
        </table>
            
        <?php }; ?>     
        </div>

        <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>
