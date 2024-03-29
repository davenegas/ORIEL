<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Importar Prontuario 10 (Personas)</title>
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

                tmpElemento.download = 'Inconsistencias-Telefonos Casa de Habitacion '+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'.xls';
                // Simulamos el click al elemento creado para descargarlo
                tmpElemento.click();

                //Código para generar documento excel a partir de una tabla
                tmpElemento = document.createElement('a');
                // obtenemos la información desde el div que lo contiene en el html
                // Obtenemos la información de la tabla
                data_type = 'data:application/vnd.ms-excel;';
                tabla_div = document.getElementById('tabla_extensiones_cero');
                tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
                tmpElemento.href = data_type + ', ' + tabla_html;
                //Asignamos el nombre a nuestro EXCEL
                tmpElemento.download = 'Personas con extensiones en cero-Reporte Actualizacion '+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'.xls';
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
            <h2>Importación del Personal(10/10):</h2>
            <h3>Detalle de actualización:</h3>

            <ul class="list-group">
                <li class="list-group-item list-group-item-success"><?php echo $resultados;?></li> 
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

            <div class="container">
                <table hidden="hidden" id="tabla_extensiones_cero" cellspacing="0" width="100%">   
                    <tbody>
                        <?php  $tam=count($vector_personas_con_numeros_en_cero);
                        for ($i = 0; $i <$tam; $i++) { 
                            $tam2=count($vector_personas_con_numeros_en_cero[$i]);
                            for ($j = 0; $j <$tam2; $j++) {  ?>
                                <tr>
                                    <td><?php echo $vector_personas_con_numeros_en_cero[$i][$j]['Apellido_Nombre'];?></td>
                                    <td><?php echo $vector_personas_con_numeros_en_cero[$i][$j]['Cedula'];?></td>
                                    <td><?php echo $vector_personas_con_numeros_en_cero[$i][$j]['ID_Persona'];?></td>
                                </tr>     
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>

            <a href="index.php?ctl=frm_importar_prontuario_paso_11" class="btn btn-default espacio-abajo" role="button">Confirmación Final</a>
            <a href="index.php?ctl=principal" class="btn btn-default espacio-abajo" role="button">Salir del Asistente</a> 
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>