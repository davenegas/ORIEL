<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="content-type" content="text/plain; charset=UTF-8">
        <title>Reporte de Enlaces Telecomunicaciones</title>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
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

                tmpElemento.download = 'Líneas Actualizadas-Reporte Actualizado '+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'.xls';
                // Simulamos el click al elemento creado para descargarlo
                tmpElemento.click(); 
            }
            
            function eliminar_enlace(ide, puntobcr){
                id_enlace= ide;
                $.confirm({title: 'Confirmación!', content: 'Desea eliminar el enlace de Telecomunicaciones?', 
                    confirm: function(){
                        id_puntobcr = puntobcr;
                        $.post("index.php?ctl=puntobcr_eliminar_enlace", { id_enlace: id_enlace, id_puntobcr:id_puntobcr }, function(data){
                            location.reload();
                            //alert (data);
                          });
                    },
                    cancel: function(){
                            //$.alert('Canceled!')
                    }
                });
            }
            
            function mostrar_editar_enlace(id, enlace, interf, linea,provee, tipo, bandw, medio, obser ){
                document.getElementById('ID_Enlace').value=id;
                $("#enlace option[value='"+enlace+"']").attr("selected",true);
                document.getElementById('interface').value=interf;
                document.getElementById('linea').value=linea;
                document.getElementById('bandwidth').value=bandw;
                $("#medio_enlace option[value="+medio+"]").attr("selected",true);
                $("#proveedor_enlace option[value="+provee+"]").attr("selected",true);
                $("#tipo_enlace option[value="+tipo+"]").attr("selected",true);
                document.getElementById('observaciones_enlace').value=obser;
                document.getElementById('ventana_oculta_6').style.display = "block";
            }
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_6').style.display = "none";
            }
            function validar_enlace(){
                if (document.getElementById('interface').value == "" ||document.getElementById('linea').value==""
                        ||document.getElementById('bandwidth').value=="") {
                     alert("Completa la información del enlace !");
                 } else {
                     //alert("Form Submitted Successfully...");
                     document.getElementById('frm_enlace_guardar').submit();
                     document.getElementById('ventana_oculta_6').style.display = "none";
                 }  
             }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div id="cargando">
            <center><img align="center" src="vistas/Imagenes/Espere.gif"/></center>
        </div>
        <div class="row content">
            <div class="col-sm-1 sidenav">
            </div>
            <div class="col-sm-11 container animated fadeIn">
                <h3>Detalle de enlaces telecomunicaciones</h3>
                <div>
                    <table id="tabla" class="display" cellspacing="0" width="100%">   
                        <thead> 
                            <tr>
                                <th style="text-align:center">Nombre</th>
                                <th style="text-align:center">Código</th>
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
                                <th style="text-align:center">Estado Oficina</th>
                                <?php if($_SESSION['modulos']['Editar Telecomunicaciones- Puntos BCR']==1){ ?>   
                                    <th style="text-align:center">Editar</th>
                                    <th style="text-align:center">Eliminar</th>
                                <?php } ?>
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
                                    <?php if ($params[$i]['Estado_Oficina']==1){ ?>  
                                        <td style="text-align:center">Activo</td>
                                    <?php } else{ ?>  
                                        <td style="text-align:center">Inactivo</td>
                                    <?php } ?>
                                    <?php if($_SESSION['modulos']['Editar Telecomunicaciones- Puntos BCR']==1){ ?>   
                                        <td style="text-align:center"><a class="btn" role="button" onclick="mostrar_editar_enlace(<?php echo $params[$i]['ID_Enlace'];?>,'<?php echo $params[$i]['Enlace'];?>',
                                                            '<?php echo $params[$i]['Interface_Enlace'];?>','<?php echo $params[$i]['Numero_Linea'];?>','<?php echo $params[$i]['ID_Proveedor'];?>','<?php echo $params[$i]['ID_Tipo_Enlace'];?>',
                                                            '<?php echo $params[$i]['Bandwidth'];?>','<?php echo $params[$i]['ID_Medio_Enlace'];?>','<?php echo $params[$i]['Observaciones'];?>');">
                                                Editar</a></td>
                                        <td style="text-align:center"><a class="btn" role="button" onclick="eliminar_enlace('<?php echo $params[$i]['ID_Enlace'];?>', '<?php echo $params[$i]['ID_PuntoBCR'];?>');">
                                           Eliminar</a></td>
                                    <?php } ?>   
                                </tr>
                            <?php } ?>
                        </tbody> 
                    </table>
                    
                    <div>
                        <form id="frm_enlace_guardar" method="POST" name="form" action="index.php?ctl=enlace_exportar">                            
                            <button type="submit" id="export_csv_data" name='export_csv_data' value="Generar Reporte" class="btn btn-default espacio-abajo">Generar Reporte</button>
                        </form>
                    </div>

                    <!--<table hidden id="enlaces_telecom" class="display" cellspacing="0" width="100%" border='2px'>
                        <thead> 
                            <tr bgcolor="#58ACFA">
                                <th style="text-align:center">Nombre</th>
                                <th style="text-align:center">Código</th>
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
                        <tbody>-->   
                            <?php 
                          /*  $tam=count($telecom);
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
                            <?php } */ ?>
                        <!--</tbody>
                    </table>--> 
                </div>
                <!--<a class="btn btn-default espacio-abajo" role="button" onclick="generar_reporte();">Generar Reporte</a>-->
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        
        <!--agregar o editar enlace del Punto BCR-->
        <div id="ventana_oculta_6"> 
            <div id="popupventana4">
                <div id="ventana4">
                <!--Formulario para ingresar nuevos números de teléfono-->
                <form id="frm_enlace_guardar" method="POST" name="form" action="index.php?ctl=enlace_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Información de Enlace</h2>
                    <hr>
                    <input hidden id="ID_Enlace" name="ID_Enlace" type="text">
                    
                    <label for="enlace">Enlace</label>
                    <select class="form-control" id="enlace" name="enlace" > 
                        <option value="Principal">Principal</option>
                        <option value="Respaldo 1">Respaldo 1</option>
                        <option value="Respaldo 2">Respaldo 2</option>
                        <option value="Internet Red Cors">Internet Red Cors</option>
                    </select>
                    <label for="interface">Interface</label>
                    <input class="form-control" required id="interface" name="interface" type="text">
                    
                    <label for="linea">Número de Línea</label>
                    <input class="form-control" required id="linea" name="linea" type="text">
                    
                    <label for="bandwidth">Bandwidth(kbps)</label>
                    <input class="form-control" required id="bandwidth" name="bandwidth" type="text">
                    
                    <label for="proveedor_enlace">Proveedor de Enlace</label>
                    <select class="form-control" id="proveedor_enlace" name="proveedor_enlace" > 
                        <?php
                        $tam = count($proveedor_enlace);
                        for($i=0; $i<$tam;$i++){?> 
                            <option value="<?php echo $proveedor_enlace[$i]['ID_Proveedor']?>"><?php echo $proveedor_enlace[$i]['Nombre_Proveedor'];?></option>
                        <?php   }   ?>
                    </select>
                    
                    <label for="tipo_enlace">Tipo de Enlace</label>
                    <select class="form-control" id="tipo_enlace" name="tipo_enlace" > 
                        <?php
                        $tam = count($tipo_enlace);
                        for($i=0; $i<$tam;$i++){?> 
                            <option value="<?php echo $tipo_enlace[$i]['ID_Tipo_Enlace']?>"><?php echo $tipo_enlace[$i]['Tipo_Enlace'];?></option>
                        <?php   }   ?>
                    </select>
                    
                    <label for="medio_enlace">Medio de Enlace</label>
                    <select class="form-control" id="medio_enlace" name="medio_enlace" > 
                        <?php
                        $tam = count($medio_enlace);
                        for($i=0; $i<$tam;$i++){?> 
                            <option value="<?php echo $medio_enlace[$i]['ID_Medio_Enlace']?>"><?php echo $medio_enlace[$i]['Medio_Enlace'];?></option>
                        <?php   }   ?>
                    </select>
                    
                    <label for="observaciones_enlace">Observaciones</label>
                    <textarea class="form-control espacio-abajo" id="observaciones_enlace" name="observaciones_enlace"></textarea>
                    <button><a href="javascript:%20validar_enlace()" id="submit">Guardar</a></button>
                    </form>
                </div>
            </div>
            <!--Cierre agregar o editar enlace del Punto BCR-->
        </div> 
    </body>
</html>
