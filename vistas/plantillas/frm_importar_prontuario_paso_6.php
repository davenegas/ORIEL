<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Importar Prontuario 6 (Personas)</title>
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
            var tabla_div = document.getElementById('tabla_personas_eliminadas');
            var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
            tmpElemento.href = data_type + ', ' + tabla_html;
            //Asignamos el nombre a nuestro EXCEL
            var f = new Date( )

            tmpElemento.download = 'Personas BCR Eliminadas de la BD-Reporte Actualizacion '+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'.xls';
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
        <h2>Importación del Personal(6/10):</h2>
        <h3>Detalle de actualización:</h3>
       
        <ul class="list-group">
        <li class="list-group-item list-group-item-success"><?php echo $personas_fuera;?></li>
        <?php if (!($excepciones=="")){?>
        <li class="list-group-item list-group-item-danger"><?php echo $excepciones;?></li>
        <?php }?>
        </ul> 
        
        
         <div class="container">
        <table hidden="hidden" id="tabla_personas_eliminadas" cellspacing="0" width="100%">   
          <tbody>
            <?php  $tam=count($vector_personas_eliminadas);

            for ($i = 0; $i <$tam; $i++) { 
                $tam2=count($vector_personas_eliminadas[$i]);
                for ($j = 0; $j <$tam2; $j++) {  ?>
                    <tr>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['ID_Persona'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Cedula'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Apellido_Nombre'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['ID_Unidad_Ejecutora'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['ID_Puesto'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Correo'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Numero_Gafete'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Direccion'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Link_Foto'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['ID_Empresa'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Observaciones'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Estado'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Departamento'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Empresa'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Tipo_Telefono'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['ID_Tipo_Telefono'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Numero'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['ID_Telefono'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Observaciones_Tel'];?></td>
                    <td><?php echo $vector_personas_eliminadas[$i][$j]['Puesto'];?></td>
                    </tr>     
                    
            <?php 
                }
                } ?>
          </tbody>
        </table>
        </div>
        <a href="index.php?ctl=frm_importar_prontuario_paso_7" class="btn btn-default espacio-abajo" role="button">Gestionar Teléfonos Celulares</a>
        <a href="index.php?ctl=principal" class="btn btn-default espacio-abajo" role="button">Salir del Asistente</a> 
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>