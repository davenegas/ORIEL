<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Reporte de revisión de video</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?> 
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn quitar-float">
            <!--<pre><?php //print_r($bitacora_revision_video);?></pre>-->
            <h3>Generar Reporte de revisiones de video</h3> 
            <div class="espacio-abajo">
                <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=reporte_revisiones_video">
                    <h4 class="espacio-arriba">Seleccionar parámetros del filtro:</h4>
                    <div class="col-xs-2">
                        <label for="fecha_inicial">Fecha Inicial:</label>
                        <input type="date" required class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo $fecha_inicio;?>">
                    </div> 
                    <div class="col-xs-2">
                        <label for="fecha_final">Fecha Final:</label>
                        <input type="date" required class="form-control" id="fecha_final" name="fecha_final" value="<?php echo $fecha_fin;?>">
                    </div>
                    <div class="col-xs-2">
                        <label for="hora_inicial">Hora Inicial:</label>
                        <input type="time" required class="form-control" id="hora_inicial" name="hora_inicial" value="<?php echo $hora_inicio;?>">
                    </div> 
                    <div class="col-xs-2">
                        <label for="hora_final">Hora Final:</label>
                        <input type="time" required class="form-control" id="hora_final" name="hora_final" value="<?php echo $hora_fin;?>">
                    </div> 
                    <div class="col-xs-3">
                        <label for="unidad_video">Unidad de Video</label>
                        <select class="form-control" required id="unidad_video" name="unidad_video" >
                            <option value="0">Todas las unidades de video</option>
                            <?php 
                            $tam_puntos_bcr=count($unidades_video);
                            for($i=0; $i<$tam_puntos_bcr;$i++){ ?>
                                <option value="<?php echo $unidades_video[$i]['ID_Unidad_Video']?>"><?php echo $unidades_video[$i]['Descripcion']?></option>                           
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="col-xs-2">
                        <label for="puesto_monitoreo">Puesto de monitoreo</label>
                        <select class="form-control" required id="puesto_monitoreo" name="puesto_monitoreo" >
                            <option value="0">Todos los puestos</option>
                            <?php 
                            $tam_puntos_bcr=count($puestos_monitoreo);
                            for($i=0; $i<$tam_puntos_bcr;$i++){ ?>
                                <option value="<?php echo $puestos_monitoreo[$i]['ID_Puesto_Monitoreo']?>"><?php echo $puestos_monitoreo[$i]['Nombre']?></option>                           
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <label for="usuario_revision">Operador</label>
                        <select class="form-control" required id="usuario_revision" name="usuario_revision" >
                            <option value="0">Todos los operadores</option>
                            <?php 
                            $tam_puntos_bcr=count($lista_de_operadores);
                            for($i=0; $i<$tam_puntos_bcr;$i++){ ?>
                                <option value="<?php echo  $lista_de_operadores[$i]['ID_Usuario']?>"><?php echo  $lista_de_operadores[$i]['Nombre_Completo']?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="checkbox col-md-2" style="margin-top: 25px;">
                        <input type="checkbox" id="retrasos" name="retrasos">Solo mostrar tiempos excedidos
                    </div> 
                    <button type="submit" class="btn btn-default" style="margin-top: 25px;" value="Generar Reporte">Generar Reporte</button>
                </form>
            </div>
            <div class="container animated fadeIn">
                <?php if(isset($bitacora_revision_video)){?>
                    <table id="tabla" class="display2">
                        <thead>   
                            <tr>
                                <th hidden style="text-align:center">ID Bitácota Revisión</th>
                                <th style="text-align:center">Hora inició revisión</th>
                                <th style="text-align:center">Hora fin revisión</th>
                                <th style="text-align:center">Usuario</th>
                                <th style="text-align:center">Unidad de Video</th>
                                <th style="text-align:center">Puesto</th>
                                <th style="text-align:center">Duración revisión</th>
                                <th style="text-align:center">Justificación</th>
                                <th style="text-align:center">Estado Conexión</th>
                                <th style="text-align:center">Mantenimiento</th>
                                <th style="text-align:center">Reporta situación</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo">
                            <?php 
                            $tam=count($bitacora_revision_video);
                            for ($i = 0; $i <$tam; $i++) { ?>
                                <tr>
                                    <td hidden style="text-align:center"><?php echo $bitacora_revision_video[$i]['ID_Bitacora_Revision_Video'];?></td>
                                    <td style="text-align:center"><?php echo $bitacora_revision_video[$i]['Fecha_Inicia_Revision']." / ".$bitacora_revision_video[$i]['Hora_Inicia_Revision'];?></td>
                                    <td style="text-align:center"><?php echo $bitacora_revision_video[$i]['Fecha_Termina_Revision']." / ".$bitacora_revision_video[$i]['Hora_Termina_Revision'];?></td>
                                    <td style="text-align:center"><?php echo $bitacora_revision_video[$i]['Nombre_Completo'];?></td>
                                    <td style="text-align:center"><?php echo $bitacora_revision_video[$i]['Descripcion'];?></td>
                                    <td style="text-align:center"><?php echo $bitacora_revision_video[$i]['Nombre'];?></td>
                                    <td style="text-align:center"><?php echo $bitacora_revision_video[$i]['Duracion_Revision']." excedido por: ".$bitacora_revision_video[$i]['Retraso_Segundos'];?></td>
                                    <td style="text-align:center"><?php echo $bitacora_revision_video[$i]['Justificacion_Retraso'];?></td>
                                    <?php if($bitacora_revision_video[$i]['Resultado_Conexion']==0){?>
                                        <td style="text-align:center">Positiva</td>
                                    <?php } if($bitacora_revision_video[$i]['Resultado_Conexion']==1){?>
                                        <td style="text-align:center">Negativa</td>
                                    <?php } if($bitacora_revision_video[$i]['Resultado_Conexion']==2) { ?>
                                        <td style="text-align:center">No Despliega</td>
                                    <?php } ?>
                                    <?php if($bitacora_revision_video[$i]['Requirio_Mantenimiento']==0){?>
                                        <td style="text-align:center">No</td>
                                    <?php } else { ?>
                                        <td style="text-align:center">Si</td>
                                    <?php } ?>
                                    <td style="text-align:center"><?php echo $bitacora_revision_video[$i]['Reporta_Situacion'];?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php }?>
            </div>
            <div class="container animated fadeIn" style="margin-top: 50px;">
                <?php if(isset($cantidad_revisiones_puesto)){?>
                    <table id="tabla2" class="display2">
                        <thead>   
                            <tr>
                                <th hidden style="text-align:center">ID Puesto</th>
                                <th style="text-align:center">Puesto</th>
                                <th style="text-align:center">Cantidad de revisiones</th>
                                <th style="text-align:center">Tiempo en puesto</th>
                                <th style="text-align:center">Segundos en puesto</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo">
                            <?php 
                            $tam=count($cantidad_revisiones_puesto);
                            for ($i = 0; $i <$tam; $i++) { ?>
                                <tr>
                                    <td hidden style="text-align:center"><?php echo $cantidad_revisiones_puesto[$i]['ID_Puesto'];?></td>
                                    <td style="text-align:center"><?php echo $cantidad_revisiones_puesto[$i]['Puesto'];?></td>
                                    <td style="text-align:center"><?php echo $cantidad_revisiones_puesto[$i]['Cantidad'];?></td>
                                    <td style="text-align:center"><?php echo $cantidad_revisiones_puesto[$i]['Tiempo_Puesto'];?></td>
                                    <td style="text-align:center"><?php echo $cantidad_revisiones_puesto[$i]['Total_Tiempo'];?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php }?>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>