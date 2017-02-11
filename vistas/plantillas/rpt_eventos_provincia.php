<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; utf-8"/>
        <title>Historico de Activaciones por provincia</title>
        <?php require_once 'frm_librerias_head.html'; ?>
        <script src="vistas/js/highstock.js"></script>
        <script src="vistas/js/exporting.js"></script>
        <script src="vistas/js/highcharts-3d.js"></script>
        <script type="text/javascript">
$(function () {
    // Set up the chart
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 5,
                beta: 10,
                depth: 50,
                viewDistance: 25
            }
        },
        xAxis: {
            categories: ['San José', 'Alajuela', 'Cartago', 'Heredia', 'Guanacaste', 'Puntarenas', 'Limón'],
                title: {
                    text: null
               }
        },
        title: {
            text: (function() { var data = [];  data.push(['<?php echo $titulo?>']); return data; })()
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        series: [{
                        name: 'Activación de Duress',
			data: (function() { var data = [];
                                <?php   for($j = 1 ;$j<8;$j++){
                                    $dato=0;
                                    for($i = 0 ;$i<count($params);$i++){
                                        if($params[$i]['ID_Provincia']==$j && $params[$i]['ID_Tipo_Evento']==4){    
                                            $dato = $params[$i]['Total_evento'];    ?>
                                        <?php }
                                    }?>
                                    data.push([<?php echo $dato;?>]);
                                <?php } ?>
                                return data;
                                })()
                    },{
                        name: 'Activación de Fuego',
			data: (function() { var data = [];
                                <?php   for($j = 1 ;$j<8;$j++){
                                    $dato=0;
                                    for($i = 0 ;$i<count($params);$i++){
                                        if($params[$i]['ID_Provincia']==$j && $params[$i]['ID_Tipo_Evento']==5){    
                                            $dato = $params[$i]['Total_evento'];    ?>
                                        <?php }
                                    }?>
                                    data.push([<?php echo $dato;?>]);
                                <?php } ?>
                                return data;
                                })()
                    },{
                        name: 'Activación de Intrusión',
			data: (function() { var data = [];
                                <?php   for($j = 1 ;$j<8;$j++){
                                    $dato=0;
                                    for($i = 0 ;$i<count($params);$i++){
                                        if($params[$i]['ID_Provincia']==$j && $params[$i]['ID_Tipo_Evento']==6){    
                                            $dato = $params[$i]['Total_evento'];    ?>
                                        <?php }
                                    }?>
                                    data.push([<?php echo $dato;?>]);
                                <?php } ?>
                                return data;
                                })()
                    },{
                        name: 'Activación de Panico',
			data: (function() { var data = [];
                                <?php   for($j = 1 ;$j<8;$j++){
                                    $dato=0;
                                    for($i = 0 ;$i<count($params);$i++){
                                        if($params[$i]['ID_Provincia']==$j && $params[$i]['ID_Tipo_Evento']==7){    
                                            $dato = $params[$i]['Total_evento'];    ?>
                                        <?php }
                                    }?>
                                    data.push([<?php echo $dato;?>]);
                                <?php } ?>
                                return data;
                                })()
                    }
                    ]
    });

    function showValues() {
        $('#alpha-value').html(chart.options.chart.options3d.alpha);
        $('#beta-value').html(chart.options.chart.options3d.beta);
        $('#depth-value').html(chart.options.chart.options3d.depth);
    }

    // Activate the sliders
    $('#sliders input').on('input change', function () {
        chart.options.chart.options3d[this.id] = this.value;
        showValues();
        chart.redraw(false);
    });

    showValues();
});
		</script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="col-sm-2 sidenav" style="margin-top: 40px;">
            <b><p class="espacio-arriba">Seleccionar parámetros del filtro:</p></b>
            <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=reporte_eventos_provincia">
                <div class="col-sm-12 espacio-abajo-5">
                    <label for="fecha_inicial">Fecha Inicial:</label>
                    <input type="date" required=”required” class="form-control text-center" id="fecha_inicial" name="fecha_inicial" value="<?php echo $fecha_inicio;?>">
                </div> 
                <div class="col-sm-12">
                    <label for="fecha_final">Fecha Final:</label>
                    <input type="date" required=”required” class="form-control text-center" id="fecha_final" name="fecha_final" value="<?php echo $fecha_fin;?>">
                </div>
                <button type="submit" class="btn btn-default" style="margin-top: 25px; margin: 27px;">Generar Reporte</button>
            </form>
        </div>
        
        <div class="col-sm-10 container espacio-abajo">
        <section class='container' >
            <div id="container" style="min-width: 310px; max-width: 1000px; height: 500px; margin: 20 auto; margin-top: 50px;"></div>
            <div id="sliders" style="min-width: 310px; max-width: 800px;">
                <table>
                    <tr>
                            <td>Alpha Angle</td>
                            <td><input id="alpha" type="range" min="0" max="45" value="5"/> <span id="alpha-value" class="value"></span></td>
                    </tr>
                    <tr>
                            <td>Beta Angle</td>
                            <td><input id="beta" type="range" min="-45" max="45" value="10"/> <span id="beta-value" class="value"></span></td>
                    </tr>
                    <tr>
                            <td>Depth</td>
                            <td><input id="depth" type="range" min="20" max="100" value="50"/> <span id="depth-value" class="value"></span></td>
                    </tr>
                </table>
            </div>
        </section>
        </div>
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>


