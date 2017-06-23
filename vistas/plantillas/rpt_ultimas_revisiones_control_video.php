<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Reporte Últimas revisiones de video</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?> 
        <script>
            function mostrar_ultimas_revisiones(){
                $("#table").html('<center><img align="center" src="vistas/Imagenes/Espere.gif"/></center>');
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn quitar-float">
            <h2>Reporte de tiempos de las últimas revisiones de video</h2> 
            <div class="container animated fadeIn">
                <?php if(isset($ultima_revision )){?>
                <h4 class="espacio-abajo espacio-arriba">El tiempo promedio de revisión general y de cada unidad de video, se basa en las revisiones de video de los últimos 5 días</h4>
                <h4 class="espacio-abajo">El tiempo promedio de revisión general es de:<b> <?php echo $promedio_general;?></b></h4>
                <table id="tabla" class="display table asc" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="text-align:center">Posición de tiempo transcurrido</th>
                            <th style="text-align:center">Tiempo transcurrido</th>
                            <th style="text-align:center">Fecha última revisión</th>
                            <th style="text-align:center">Tiempo promedio en segundos</th>
                            <th style="text-align:center">Tiempo promedio de revisión</th>
                            <th style="text-align:center">Unidad de Video</th>
                            <th style="text-align:center">Puestos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tam=count($ultima_revision);
                        $sum =count($ultima_revision);
                        for ($i = 0; $i <$tam; $i++) { ?>  
                            <tr>
                                <td style="text-align:center"><?php echo $sum; $sum--;?></td>
                                <td style="text-align:center"><?php echo $ultima_revision[$i]['Total_Tiempo'];?></td>
                                <td style="text-align:center"><?php echo $ultima_revision[$i]['Fecha_Hora'];?></td>
                                <td style="text-align:center"><?php echo $ultima_revision[$i]['Tiempo_Promedio_Segundos'];?></td>
                                <td style="text-align:center"><?php echo $ultima_revision[$i]['Tiempo_Promedio'];?></td>
                                <td style="text-align:center"><?php echo $ultima_revision[$i]['Descripcion'];?></td>
                                <td style="text-align:center"><?php echo $ultima_revision[$i]['Lista_Puestos'];?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                <div class="container animated fadeIn">
                    <h4><span class="glyphicon glyphicon-alert"></span> Este reporte puede tardar varios minutos.</h4><h4>Para generar el reporte dar click en el botón: "Generar reporte"</h4>
                    <a class="btn btn-default" style="margin-top: 25px;" onclick="mostrar_ultimas_revisiones();" href="index.php?ctl=reporte_ultimas_revisiones_video_completo">Generar reporte</a> 
                    <a class="btn btn-default" style="margin-top: 25px;" href="index.php?ctl=principal">Volver a página principal</a>
                    <div id="table"></div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>
