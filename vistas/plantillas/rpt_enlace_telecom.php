<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="content-type" content="text/plain; charset=UTF-8">
        <title>Reporte de Enlaces Telecomunicaciones</title>
        <?php require_once 'frm_librerias_head.html'; ?>     
        <script>
            $(document).ready(function () {
                // Una vez se cargue al completo la página desaparecerá el div "cargando"
                $('#cargando').hide();
            });
            function generar_reporte(){
                var tmpElemento = document.createElement('a');
                // obtenemos la información desde el div que lo contiene en el html
                // Obtenemos la información de la tabla
                var data_type = 'data:application/vnd.ms-excel;';
                var tabla_div = document.getElementById('enlaces_telecom');
                var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
                var tabla_html = tabla_html.replace(/á/g, '&aacute;');
                var tabla_html = tabla_html.replace(/é/g, '&eacute;');
                var tabla_html = tabla_html.replace(/í/g, '&iacute;');
                var tabla_html = tabla_html.replace(/ó/g, '&oacute;');
                var tabla_html = tabla_html.replace(/ú/g, '&uacute;');
                var tabla_html = tabla_html.replace(/Á/g, '&Aacute;');
                var tabla_html = tabla_html.replace(/É/g, '&Eacute;');
                var tabla_html = tabla_html.replace(/Í/g, '&Iacute;');
                var tabla_html = tabla_html.replace(/Ó/g, '&Oacute;');
                var tabla_html = tabla_html.replace(/Ú/g, '&Uacute;');
                var tabla_html = tabla_html.replace(/ñ/g, '&ntilde;');
                var tabla_html = tabla_html.replace(/Ñ/g, '&Ntilde;');
                tmpElemento.href = data_type + ', ' + tabla_html;
                //Asignamos el nombre a nuestro EXCEL
                var f = new Date( )

                tmpElemento.download = 'Enlaces Telecomunicaciones-Reporte Actualizado '+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'.xls';
                // Simulamos el click al elemento creado para descargarlo
                tmpElemento.click(); 
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div id="cargando">
            <center><img align="center" src="vistas/Imagenes/Espere.gif"/></center>
        </div>
        <div class="container animated fadeIn">
            <h3>Detalle de enlaces telecomunicaciones</h3>
       
            <div class="container">
                <table id="tabla" class="display" cellspacing="0" width="100%">   
                    <thead> 
                        <tr>
                            <th style="text-align:center">Nombre</th>
                            <th style="text-align:center">Codigo</th>
                            <th style="text-align:center">Gateway</th>
                            <th style="text-align:center">Loopback</th>
                            <th style="text-align:center">Enlace</th>
                            <th style="text-align:center">Interface</th>
                            <th style="text-align:center">Línea</th>
                            <th style="text-align:center">Proveedor</th>
                            <th style="text-align:center">Tipo enlace</th>
                            <th style="text-align:center">Bandwidth(kbps)</th>
                            <th style="text-align:center">Medio enlace</th>
                            <th style="text-align:center">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tam=count($telecom);
                        for ($i = 0; $i <$tam; $i++) { ?>
                            <tr>
                                <td style="text-align:center"><?php echo $params[$i]['Nombre'];?></td>
                                <?php if($params[$i]['Codigo']>=1000 or $params[$i]['Codigo']=="X41" or $params[$i]['Codigo']=="X45" or $params[$i]['Codigo']=="X56"){?>
                                    <td style="text-align:center">UE: <?php echo $params[$i]['Numero_UE'];?></td>
                                <?php }else{ ?> 
                                    <td style="text-align:center">ATM: <?php echo $params[$i]['Codigo'];?></td>
                                <?php }?> 
                                    <!--Valida si tiene Gateway principal de lo contrario escribe NA-->
                                <?php if(isset($params[$i]['Gateway principal'])){?>
                                    <td style="text-align:center"><?php echo $params[$i]['Gateway principal'];?></td>
                                <?php } else {?>
                                    <td style="text-align:center">NA</td>
                                <?php }?>
                                    <!--Valida si tiene Loopback de lo contrario escribe NA-->
                                <?php if(isset($params[$i]['Loopback'])){?>
                                    <td style="text-align:center"><?php echo $params[$i]['Loopback'];?></td>
                                <?php } else {?>   
                                    <td style="text-align:center">NA</td>
                                <?php }?>
                                <td style="text-align:center"><?php echo $params[$i]['Enlace'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Interface_Enlace'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Numero_Linea'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Nombre_Proveedor'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Tipo_Enlace'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Bandwidth'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Medio_Enlace'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                            </tr>
                        <?php } ?>
                    </tbody> 
                </table>
            
                <table hidden id="enlaces_telecom" class="display" cellspacing="0" width="100%" border='2px'>   
                    <thead> 
                        <tr bgcolor="#58ACFA">
                            <th style="text-align:center">Nombre</th>
                            <th style="text-align:center">Codigo</th>
                            <th style="text-align:center">Gateway</th>
                            <th style="text-align:center">Loopback</th>
                            <th style="text-align:center">Enlace</th>
                            <th style="text-align:center">Interface</th>
                            <th style="text-align:center">Línea</th>
                            <th style="text-align:center">Proveedor</th>
                            <th style="text-align:center">Tipo enlace</th>
                            <th style="text-align:center">Bandwidth(kbps)</th>
                            <th style="text-align:center">Medio enlace</th>
                            <th style="text-align:center">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tam=count($telecom);
                        for ($i = 0; $i <$tam; $i++) { ?>
                            <tr>
                                <td style="text-align:center"><?php echo $params[$i]['Nombre'];?></td>
                                <?php if($params[$i]['Codigo']>=1000 or $params[$i]['Codigo']=="X41" or $params[$i]['Codigo']=="X45" or $params[$i]['Codigo']=="X56"){?>
                                    <td style="text-align:center">UE: <?php echo $params[$i]['Numero_UE'];?></td>
                                <?php }else{ ?> 
                                    <td style="text-align:center">ATM: <?php echo $params[$i]['Codigo'];?></td>
                                <?php }?> 
                                    <!--Valida si tiene Gateway principal de lo contrario escribe NA-->
                                <?php if(isset($params[$i]['Gateway principal'])){?>
                                    <td style="text-align:center"><?php echo $params[$i]['Gateway principal'];?></td>
                                <?php } else {?>
                                    <td style="text-align:center">NA</td>
                                <?php }?>
                                    <!--Valida si tiene Loopback de lo contrario escribe NA-->
                                <?php if(isset($params[$i]['Loopback'])){?>
                                    <td style="text-align:center"><?php echo $params[$i]['Loopback'];?></td>
                                <?php } else {?>   
                                    <td style="text-align:center">NA</td>
                                <?php }?>
                                <td style="text-align:center"><?php echo $params[$i]['Enlace'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Interface_Enlace'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Numero_Linea'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Nombre_Proveedor'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Tipo_Enlace'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Bandwidth'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Medio_Enlace'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                            </tr>
                        <?php } ?>
                    </tbody> 
                </table>
            </div>
            <a class="btn btn-default espacio-abajo" role="button" onclick="generar_reporte();">Generar Reporte</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>
