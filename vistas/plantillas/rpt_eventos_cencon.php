<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Lista de Eventos Cerrados</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>   
        
        <script type="text/javascript">
            function hacer_click(){
                $('#cuerpo').html('<center><img align="center" src="vistas/Imagenes/loading.gif"/></center>');

                fecha_inicial=document.getElementById('fecha_inicial').value;
                fecha_final=document.getElementById('fecha_final').value;

                $.post("index.php?ctl=actualiza_en_vivo_reporte_cencon", {fecha_inicial: fecha_inicial,fecha_final:fecha_final}, function(data){
                    $("#titulo").html("Eventos de acuerdo a parámetros:");  
                    $("#tabla").html(data);   
                    $("#tabla").dataTable().fnDestroy();
                    $("#tabla").dataTable().draw();
                });    
            }
            
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: (function() { var data = [];  data.push(['<?php echo $titulo?>']); return data; })()
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: (function() { var data = [];
                            <?php for($i = 6 ;$i<20;$i++){ ?>
                                data.push(['<?php echo $reporte_aperturas[$i]['Horas'];?>']);
                            <?php } ?>
                            return data;
                            })()
                    },
                    yAxis: {
                        title: {
                            text: 'Cantidad de Aperturas'
                        }
                    },
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: false
                        }
                    },
                    series: [{
                        name: 'Total',
                        data: (function() { var data = [];
                                <?php   for($i = 6 ;$i<20;$i++){     ?>
                                data.push([<?php echo $reporte_aperturas[$i]['TOTAL'];?>]);
                                <?php } ?>
                                return data;
                                })()
                    }]
                });
            });
        </script>
    </head>
    <body>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="vistas/js/exporting.js"></script>
        
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn quitar-float">
            <h3>Generar Reporte de Eventos de Cencon del Sistema</h3> 
            <div>
                <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=reporte_cencon">
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
            <!--Div para gráfico-->
            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            
            <div class="container animated fadeIn">
                <h3 id="titulo">Listado de Eventos Cencon del día de hoy:</h3>
                <table id="tabla" class="display2">
                    <thead>   
                        <tr>
                            <th hidden>ID_Evento_Cencon</th>
                            <th style="text-align:center">Fecha Apertura</th>
                            <th style="text-align:center">Hora Apertura</th>
                            <th style="text-align:center">Fecha Cierre</th>
                            <th style="text-align:center">Hora Cierre</th>
                            <th style="text-align:center">Nombre Cajero</th>
                            <th style="text-align:center">Funcionario</th>
                            <th style="text-align:center">Empresa</th>
                            <th style="text-align:center">Usuario</th>   
                            <th style="text-align:center">Observaciones</th>
                            <th style="text-align:center">Seguimiento</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpo">
                        <?php 
                        $tam=count($params);
                        for ($i = 0; $i <$tam; $i++) { ?>
                            <tr>
                                <td hidden style="text-align:center"><?php echo $params[$i]['ID_Evento_Cencon'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Fecha_Apertura'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Hora_Apertura'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Fecha_Cierre'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Hora_Cierre'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Codigo']." - ".$params[$i]['Nombre'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Nombre_Persona'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Empresa'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Nombre_usuario'].' '.$params[$i]['Apellido_usuario'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Seguimiento'];?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>