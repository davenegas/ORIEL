<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Reporte de pruebas de alarma</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>   
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
<!--         <pre>
            <?php print_r($prueba);?>
        </pre>-->
        <div class="container animated fadeIn quitar-float">
            <h3>Generar Reporte de pruebas de alarma</h3> 
            <div class="espacio-abajo">
                <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=reporte_prueba_alarma">
                    <h4 class="espacio-arriba">Seleccionar parámetros del filtro:</h4>
                    <div class="col-xs-2">
                        <label for="fecha_inicial">Fecha Inicial:</label>
                        <input type="date" required=”required” class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo $fecha_inicio;?>">
                    </div> 
                    <div class="col-xs-2">
                        <label for="fecha_final">Fecha Final:</label>
                        <input type="date" required=”required” class="form-control" id="fecha_final" name="fecha_final" value="<?php echo $fecha_fin;?>">
                    </div> 
                    <button type="submit" class="btn btn-default" style="margin-top: 25px; "value="Generar Reporte">Generar Reporte</button>
                </form>
            </div>
            <div class="container animated fadeIn">
               
                <table id="tabla" class="display2">
                    <thead>   
                        <tr>
                            <th hidden>ID_Prueba_Alarma</th>
                            <th style="text-align:center">Fecha</th>
                            <th style="text-align:center">Codigo</th>
                            <th style="text-align:center">Nombre</th>
                            <th style="text-align:center">Nombre_Persona_Apertura</th>
                            <th style="text-align:center">Hora_Apertura_Alarma</th>
                            <th style="text-align:center">Hora_Prueba_Alarma</th>
                            <th style="text-align:center">Numero_Zona_Prueba</th>
                            <th style="text-align:center">Nombre_Persona_Cierre</th>
                            <th style="text-align:center">Particion_Secundaria_Cierre</th>
                            <th style="text-align:center">Particion_Principal_Cierre</th>
                            <th style="text-align:center">Hora_Cierre_Alarma</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpo">
                        <?php 
                        $tam=count($prueba);
                        for ($i = 0; $i <$tam; $i++) { ?>
                            <tr>
                                <td hidden style="text-align:center"><?php echo $prueba[$i]['ID_Prueba_Alarma'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Fecha'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Codigo'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Nombre'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Nombre_Persona_Apertura'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Hora_Apertura_Alarma'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Hora_Prueba_Alarma'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Numero_Zona_Prueba'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Nombre_Persona_Cierre'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Particion_Secundaria_Cierre'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Particion_Principal_Cierre'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Hora_Cierre_Alarma'];?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>