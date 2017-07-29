<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />-->
        <title>Importar Prontuario 3 (Unidades Ejecutoras)</title>
        <?php require_once 'frm_librerias_head.html'; ?>     
        <script>
            $(document).ready(function () {
                // Una vez se cargue al completo la página desaparecerá el div "cargando"
                $('#cargando').hide();

                var tmpElemento = document.createElement('a');
                // obtenemos la información desde el div que lo contiene en el html
                // Obtenemos la información de la tabla
                var data_type = 'data:application/vnd.ms-excel;';
                var tabla_div = document.getElementById('tabla_inconsistencias');
                var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
                tmpElemento.href = data_type + ', ' + tabla_html;
                //Asignamos el nombre a nuestro EXCEL
                var f = new Date( )

                tmpElemento.download = 'Unidades Ejecutoras-Reporte Actualizacion '+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'.xls';
                // Simulamos el click al elemento creado para descargarlo
                tmpElemento.click();
            });
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div id="cargando">
            <center><img align="center" src="vistas/Imagenes/Espere.gif"/></center>
        </div>
        <div class="container animated fadeIn">
            <h2>Importación de Unidades Ejecutoras (3/10):</h2>
            <h3>Detalle de actualización:</h3>

            <ul class="list-group">
                <li class="list-group-item list-group-item-info"><?php echo $total_unidades_ejecutoras;?></li>
                <li class="list-group-item list-group-item-success"><?php echo $nuevas_unidades_ejecutoras;?></li>
                <li class="list-group-item list-group-item-warning"><?php echo $unidades_editadas;?></li>
                <li class="list-group-item list-group-item-warning"><?php echo $unidades_inactivas;?></li>
            </ul>

            <div class="container">
                <table hidden="hidden" id="tabla_inconsistencias" cellspacing="0" width="100%">   
                    <tbody>
                    <?php  $tam=count($vector_inconsistencias);
                    for ($i = 0; $i <$tam; $i++) { ?>
                        <tr>
                            <td><?php echo $vector_inconsistencias[$i][0];?></td>
                            <td><?php echo $vector_inconsistencias[$i][1];?></td>
                        </tr>     
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <!--<div class="espacio-arriba"><a href="javascript:void(null)"><img src="vistas/Imagenes/export_to_excel.gif" onClick="generar_excel();"></a></div>--> 
            <a href="index.php?ctl=frm_importar_prontuario_paso_4" class="btn btn-default espacio-abajo" role="button">Gestionar Puestos BCR</a>
            <a href="index.php?ctl=principal" class="btn btn-default espacio-abajo" role="button">Salir del Asistente</a> 
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>