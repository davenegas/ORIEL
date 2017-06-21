<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Reporte Últimas revisiones de video</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?> 
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn quitar-float">
            <h3>Reporte de últimas revisiones de video</h3> 
            <div class="container animated fadeIn">
                <table id="tabla" class="display table asc" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th hidden style="text-align:center">ID</th>
                            <th style="text-align:center">Tiempo transcurrido</th>
                            <th style="text-align:center">Fecha última revisión</th>
                            <th style="text-align:center">Tiempo promedio de revisión</th>
                            <th style="text-align:center">Unidad de Video</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tam=count($ultima_revision);
                        $sum =count($ultima_revision);
                        for ($i = 0; $i <$tam; $i++) { ?>  
                            <tr>
                                <td hidden style="text-align:center"><?php echo $sum; $sum--;?></td>
                                <td style="text-align:center"><?php echo $ultima_revision[$i]['Total_Tiempo'];?></td>
                                <td style="text-align:center"><?php echo $ultima_revision[$i]['Fecha_Hora'];?></td>
                                <td style="text-align:center"><?php echo $ultima_revision[$i]['Tiempo_Promedio'];?></td>
                                <td style="text-align:center"><?php echo $ultima_revision[$i]['Descripcion'];?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>
