<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Módulos Puertas</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script language="javascript" src="vistas/js/valida_un_solo_click_en_formulario.js"></script>  
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container animated fadeIn">
            <h1>Control de Acceso: Módulos Controlados</h1>
            <!--Seleccionar archivo para actualizar controladore automaticamente-->
            <div class="espacio-abajo-10 well">
                <h3>Seleccionar Archivo para actualizar módulos:</h3>
                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="index.php?ctl=actualizar_modulo_puerta_paso_1">
                    <div class="col-xs-12 quitar-float espacio-abajo-5">
                        <!--<label for="archivo_adjunto">Adjuntar Archivo: </label>-->
                        <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                        <input type="file" name="seleccionar_archivo" id="seleccionar_archivo" class="btn btn-default">
                    </div>  
                    <div class="col-xs-12 quitar-float">
                        <button type="submit" class="btn btn-default">Enviar Información</button>
                    </div>
                </form>
            </div>
            
            <!--Lista de Controladores ingresados al sistema-->
            <div class="well">
                <h3>Lista de Módulos de Puertas controladas actuales</h3>
                <table id="tabla" class="display">
                    <thead>
                        <tr>
                            <th style="text-align:center" hidden>ID</th>
                            <th style="text-align:center">Owner</th>
                            <th style="text-align:center">IOU</th>
                            <th style="text-align:center">Name</th>
                            <th style="text-align:center">ModuloID</th>
                            <th style="text-align:center">CommStatus</th>
                            <th style="text-align:center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tam=count($params);
                        for ($i = 0; $i <$tam; $i++) { ?>
                            <tr>
                                <td hidden><?php echo $params[$i]['ID_Puerta_Controlada'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Owner'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Name'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['IOU'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['ModuloID'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['CommStatus'];?></td>
                                <?php if ($params[$i]['Estado']==1){  ?>  
                                    <td style="text-align:center">Activo</td>
                                <?php } else {?>  
                                    <td style="text-align:center">Inactivo</td>
                                <?php }?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <a href="index.php?ctl=principal" class="btn btn-default espacio-abajo" role="button">Salir</a> 
        </div>
        
        <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>