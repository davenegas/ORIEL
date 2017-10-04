<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Controladores</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script language="javascript" src="vistas/js/valida_un_solo_click_en_formulario.js"></script>  
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container animated fadeIn">
            <h1>Control de Acceso: Controladores</h1>
            <!--Seleccionar archivo para actualizar controladore automaticamente-->
            <div class="espacio-abajo-10 well">
                <h3>Seleccionar Archivo para actualizar controladores:</h3>
                <form class="form-horizontal" role="form" enctype="multipart/form-data" onSubmit="return enviado()" method="POST" action="index.php?ctl=actualizar_controladores_paso_1">
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
            <div>
                <h3>Lista de Controladores actuales</h3>
                <table id="tabla" class="display">
                    <thead>
                        <tr><th hidden>ID_Control_Acceso</th>
                            <th style="text-align:center">Owner</th>
                            <th style="text-align:center">Name</th>
                            <th style="text-align:center">NetworkId</th>
                            <th style="text-align:center">IPAddress</th>
                            <th style="text-align:center">CommStatus</th>
                            <th style="text-align:center">CreateTime</th>
                            <th style="text-align:center">CreateBy</th>
                            <th style="text-align:center">VersionNum</th>
                            <th style="text-align:center">SubnetMask</th>
                            <th style="text-align:center">Model</th>
                            <th style="text-align:center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tam=count($controladores_bd);
                        for ($i = 0; $i <$tam; $i++) { ?>
                            <tr>
                                <td hidden><?php echo $controladores_bd[$i]['ID_Control_Acceso'];?></td>
                                <td style="text-align:center"><?php echo $controladores_bd[$i]['Owner'];?></td>
                                <td style="text-align:center"><?php echo $controladores_bd[$i]['Name'];?></td>
                                <td style="text-align:center"><?php echo $controladores_bd[$i]['NetworkId'];?></td>
                                <td style="text-align:center"><?php echo $controladores_bd[$i]['IPAddress'];?></td>
                                <td style="text-align:center"><?php echo $controladores_bd[$i]['CommStatus'];?></td>
                                <td style="text-align:center"><?php echo $controladores_bd[$i]['CreateTime'];?></td>
                                <td style="text-align:center"><?php echo $controladores_bd[$i]['CreateBy'];?></td>
                                <td style="text-align:center"><?php echo $controladores_bd[$i]['VersionNum'];?></td>
                                <td style="text-align:center"><?php echo $controladores_bd[$i]['SubnetMask'];?></td>
                                <td style="text-align:center"><?php echo $controladores_bd[$i]['Model'];?></td>
                                <?php if ($controladores_bd[$i]['Estado']==1){  ?>  
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