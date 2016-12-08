<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Importar Prontuario 5 (Personas)</title>
        <?php require_once 'frm_librerias_head.html'; ?> 
        <script>
          $(document).ready(function () {
            // Una vez se cargue al completo la página desaparecerá el div "cargando"
            $('#cargando').hide();
            
            //Código para generar documento excel a partir de una tabla
            var tmpElemento = document.createElement('a');
            // obtenemos la información desde el div que lo contiene en el html
            // Obtenemos la información de la tabla
            var data_type = 'data:application/vnd.ms-excel;';
            var tabla_div = document.getElementById('tabla_cambios_de_puesto');
            var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
            tmpElemento.href = data_type + ', ' + tabla_html;
            //Asignamos el nombre a nuestro EXCEL
            var f = new Date( )

            tmpElemento.download = 'Cambios de Puesto en Personas-Reporte Actualizacion '+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'.xls';
            // Simulamos el click al elemento creado para descargarlo
            tmpElemento.click();
            
            //Código para generar documento excel a partir de una tabla
            tmpElemento = document.createElement('a');
            // obtenemos la información desde el div que lo contiene en el html
            // Obtenemos la información de la tabla
            data_type = 'data:application/vnd.ms-excel;';
            tabla_div = document.getElementById('tabla_cambios_de_ue');
            tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
            tmpElemento.href = data_type + ', ' + tabla_html;
            //Asignamos el nombre a nuestro EXCEL
            tmpElemento.download = 'Cambios de Unidad Ejecutora en Personas-Reporte Actualizacion '+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'.xls';
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
        <h2>Importación del Personal(5/10):</h2>
        <h3>Detalle de actualización:</h3>
       
        <ul class="list-group">
        <li class="list-group-item list-group-item-info"><?php echo $total_personas;?></li>
        <li class="list-group-item list-group-item-success"><?php echo $nuevas_personas;?></li>
        <li class="list-group-item list-group-item-warning"><?php echo $personas_editadas;?></li>
        <!--<li class="list-group-item list-group-item-warning"><?php echo $puestos_inactivos;?></li>-->
        </ul>
        
        <div class="container">
        <table hidden="hidden" id="tabla_cambios_de_puesto" cellspacing="0" width="100%">   
          <tbody>
            <?php  $tam=count($vector_cambios_de_puesto);

            for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                <td><?php echo $vector_cambios_de_puesto[$i][0];?></td>
                <td><?php echo $vector_cambios_de_puesto[$i][1];?></td>
                <td><?php echo $vector_cambios_de_puesto[$i][2];?></td>
                <td><?php echo $vector_cambios_de_puesto[$i][3];?></td>
                <td><?php echo $vector_cambios_de_puesto[$i][4];?></td>
                </tr>     
                    
            <?php } ?>
          </tbody>
        </table>
        </div>
        
         <div class="container">
        <table hidden="hidden" id="tabla_cambios_de_ue" cellspacing="0" width="100%">   
          <tbody>
            <?php  $tam=count($vector_cambios_de_ue);

            for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                <td><?php echo $vector_cambios_de_ue[$i][0];?></td>
                <td><?php echo $vector_cambios_de_ue[$i][1];?></td>
                <td><?php echo $vector_cambios_de_ue[$i][2];?></td>
                <td><?php echo $vector_cambios_de_ue[$i][3];?></td>
                <td><?php echo $vector_cambios_de_ue[$i][4];?></td>
                </tr>     
                    
            <?php } ?>
          </tbody>
        </table>
        </div>
        
        <a href="index.php?ctl=frm_importar_prontuario_paso_6" class="btn btn-default espacio-abajo" role="button">Gestionar Salida de Personas</a>
        <a href="index.php?ctl=principal" class="btn btn-default espacio-abajo" role="button">Salir del Asistente</a> 
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>