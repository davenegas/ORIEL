<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="Content-Type" content="text/html; utf-8"/>
        <title>Contador Control de Video</title>
        <?php require_once 'frm_librerias_head.html'; ?>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="col-sm-2 sidenav" style="margin-top: 40px;">
            <b><p class="espacio-arriba">Seleccionar parámetros del filtro:</p></b>
            <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=reporte_contador_video">
                <div class="col-sm-12 espacio-abajo-5">
                    <label for="fecha_inicial">Fecha Inicial:</label>
                    <input type="date" required=”required” class="form-control text-center" id="fecha_inicial" name="fecha_inicial" value="<?php echo $fecha_inicio;?>">
                </div> 
                <div class="col-sm-12">
                    <label for="fecha_final">Fecha Final:</label>
                    <input type="date" required=”required” class="form-control text-center" id="fecha_final" name="fecha_final" value="<?php echo $fecha_fin;?>">
                </div>
                <button type="submit" class="btn btn-default" style="margin-top: 25px; margin: 27px;">Generar Reporte</button>
            </form> 
        </div>
        <div class="col-sm-10 container espacio-abajo">
            <div>
                <h3 id="titulo">Listado del Contador del día de hoy:</h3>
                <table id="tabla" class="display2">
                    <thead>   
                        <tr>
                            <th hidden>ID_Revision_Contador</th>
                            <th style="text-align:center">Fecha Hora</th>
                            <th style="text-align:center">Suma revisión</th>
                            <th style="text-align:center">Detalle</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpo">
                        <?php 
                        $tam=count($params);
                        for ($i = 0; $i <$tam; $i++) { ?>
                            <tr>
                                <td hidden style="text-align:center"><?php echo $params[$i]['ID_Revision_Contador'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Fecha_Hora'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Suma_Revisiones'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Descripcion'];?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>