<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="refresh" content="180"/>
        <title>Historico de Activaciones por provincia</title>
        <?php require_once 'frm_librerias_head.html'; ?>        
        <script src="vistas/js/highcharts201808/highcharts201808.js"></script>
        <script src="vistas/js/highcharts201808/series-label201808.js"></script>
        <script src="vistas/js/highcharts201808/exporting201808.js"></script>
        <script src="vistas/js/highcharts201808/export-data201808.js"></script>
        <script type="text/javascript">
            $(function () {
            var fec1 = document.getElementById("fecha1").value;
            var fec2 = document.getElementById("fecha2").value;
            jQuery.noConflict();
            var example = 'spline-irregular-time',
                    theme = 'default';
            (function($){ // encapsulate jQuery

            Highcharts.chart('container', {
            chart: {
            type: 'spline'
            },
                    title: {
                    text: 'Alerta de Video'
                    },
                    subtitle: {
                    text: 'Del ' + fec1 + ' Al ' + fec2
                    },
                    xAxis: {
                    type: 'datetime',
                            dateTimeLabelFormats: { // don't display the dummy year

                            hour: '%H:%M %e. %b'

                            },
                            title: {
                            text: 'Fecha'
                            }
                    },
                    yAxis: {
                    title: {
                    text: 'Valores'
                    },
                            min: 0
                    },
                    tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                            pointFormat: '{point.x:FEC: %e.de %b, HR: %H:%M} VAL: {point.y:.2f} m'
                    },
                    plotOptions: {
                    spline: {
                    marker: {
                    enabled: true
                    }
                    }
                    },
                    colors: ['#ff1a1a', '#ff5c33', '#06C', '#036', '#39F', '#00b300'],
                    // Define the data points. All series have a dummy year
                    // of 1970/71 in order to be compared on the same x axis. Note
                    // that in JavaScript, months start at 0 for January, 1 for February etc.
                    series: [{//1
                    name: "Más de 2.5 Hrs",
                            data: [
                                <?php $tam = count($revision1);
                                for ($j = 0; $j < $tam; $j++) {
                                    ?>
                                    <?php if ($j == ($tam - 1)) { ?>
                                     [Date.UTC(<?php echo date('Y', strtotime($revision1[$j]['Fecha'])); ?>, <?php echo date('m', strtotime($revision1[$j]['Fecha'])); ?>, <?php echo date('d', strtotime($revision1[$j]['Fecha'])); ?>,<?php echo date('H', strtotime($revision1[$j]['Fecha'])); ?>,<?php echo date('i', strtotime($revision1[$j]['Fecha'])); ?>), <?php echo $revision1[$j]['Valor']; ?>]
                                    <?php } else { ?>
                                     [Date.UTC(<?php echo date('Y', strtotime($revision1[$j]['Fecha'])); ?>, <?php echo date('m', strtotime($revision1[$j]['Fecha'])); ?>, <?php echo date('d', strtotime($revision1[$j]['Fecha'])); ?>,<?php echo date('H', strtotime($revision1[$j]['Fecha'])); ?>,<?php echo date('i', strtotime($revision1[$j]['Fecha'])); ?>), <?php echo $revision1[$j]['Valor']; ?>],
                                    <?php } ?>
                                <?php } ?>
                            ]
                    }, {//2
                    name: "De 2 a 2.5 Hrs",
                            data: [
                            <?php $tam = count($revision2);
                            for ($j = 0; $j < $tam; $j++) {
                                ?>
                                <?php if ($j == ($tam - 1)) { ?>
                                [Date.UTC(<?php echo date('Y', strtotime($revision2[$j]['Fecha'])); ?>, <?php echo date('m', strtotime($revision2[$j]['Fecha'])); ?>, <?php echo date('d', strtotime($revision2[$j]['Fecha'])); ?>,<?php echo date('H', strtotime($revision2[$j]['Fecha'])); ?>,<?php echo date('i', strtotime($revision2[$j]['Fecha'])); ?>), <?php echo $revision2[$j]['Valor']; ?>]
                                <?php } else { ?>
                                [Date.UTC(<?php echo date('Y', strtotime($revision2[$j]['Fecha'])); ?>, <?php echo date('m', strtotime($revision2[$j]['Fecha'])); ?>, <?php echo date('d', strtotime($revision2[$j]['Fecha'])); ?>,<?php echo date('H', strtotime($revision2[$j]['Fecha'])); ?>,<?php echo date('i', strtotime($revision2[$j]['Fecha'])); ?>), <?php echo $revision2[$j]['Valor']; ?>],
                                <?php } ?>
                            <?php } ?>
                            ]
                    }, {//3
                    name: "De 1.5 a 2 Hrs",
                            data: [
                            <?php $tam = count($revision3);
                            for ($j = 0; $j < $tam; $j++) {
                                ?>
                                <?php if ($j == ($tam - 1)) { ?>
                                [Date.UTC(<?php echo date('Y', strtotime($revision3[$j]['Fecha'])); ?>, <?php echo date('m', strtotime($revision3[$j]['Fecha'])); ?>, <?php echo date('d', strtotime($revision3[$j]['Fecha'])); ?>,<?php echo date('H', strtotime($revision3[$j]['Fecha'])); ?>,<?php echo date('i', strtotime($revision3[$j]['Fecha'])); ?>), <?php echo $revision3[$j]['Valor']; ?>]
                                <?php } else { ?>
                                [Date.UTC(<?php echo date('Y', strtotime($revision3[$j]['Fecha'])); ?>, <?php echo date('m', strtotime($revision3[$j]['Fecha'])); ?>, <?php echo date('d', strtotime($revision3[$j]['Fecha'])); ?>,<?php echo date('H', strtotime($revision3[$j]['Fecha'])); ?>,<?php echo date('i', strtotime($revision3[$j]['Fecha'])); ?>), <?php echo $revision3[$j]['Valor']; ?>],
                                <?php } ?>
                            <?php } ?>
                            ]
                    }, {//4
                    name: "De 1 a 1.5 Hrs",
                            data: [
                                <?php $tam = count($revision4);
                                for ($j = 0; $j < $tam; $j++) {
                                    ?>
                                    <?php if ($j == ($tam - 1)) { ?>
                                    [Date.UTC(<?php echo date('Y', strtotime($revision4[$j]['Fecha'])); ?>, <?php echo date('m', strtotime($revision4[$j]['Fecha'])); ?>, <?php echo date('d', strtotime($revision4[$j]['Fecha'])); ?>,<?php echo date('H', strtotime($revision4[$j]['Fecha'])); ?>,<?php echo date('i', strtotime($revision4[$j]['Fecha'])); ?>), <?php echo $revision4[$j]['Valor']; ?>]
                                    <?php } else { ?>
                                    [Date.UTC(<?php echo date('Y', strtotime($revision4[$j]['Fecha'])); ?>, <?php echo date('m', strtotime($revision4[$j]['Fecha'])); ?>, <?php echo date('d', strtotime($revision4[$j]['Fecha'])); ?>,<?php echo date('H', strtotime($revision4[$j]['Fecha'])); ?>,<?php echo date('i', strtotime($revision4[$j]['Fecha'])); ?>), <?php echo $revision4[$j]['Valor']; ?>],
                                    <?php } ?>
                                <?php } ?>
                            ]
                    }, {//5
                    name: "De 0.5 a 1 Hrs",
                            data: [
                            <?php $tam = count($revision5);
                            for ($j = 0; $j < $tam; $j++) {
                                ?>
                                <?php if ($j == ($tam - 1)) { ?>
                                [Date.UTC(<?php echo date('Y', strtotime($revision5[$j]['Fecha'])); ?>, <?php echo date('m', strtotime($revision5[$j]['Fecha'])); ?>, <?php echo date('d', strtotime($revision5[$j]['Fecha'])); ?>,<?php echo date('H', strtotime($revision5[$j]['Fecha'])); ?>,<?php echo date('i', strtotime($revision5[$j]['Fecha'])); ?>), <?php echo $revision5[$j]['Valor']; ?>]
                                <?php } else { ?>
                                [Date.UTC(<?php echo date('Y', strtotime($revision5[$j]['Fecha'])); ?>, <?php echo date('m', strtotime($revision5[$j]['Fecha'])); ?>, <?php echo date('d', strtotime($revision5[$j]['Fecha'])); ?>,<?php echo date('H', strtotime($revision5[$j]['Fecha'])); ?>,<?php echo date('i', strtotime($revision5[$j]['Fecha'])); ?>), <?php echo $revision5[$j]['Valor']; ?>],
                                <?php } ?>
                            <?php } ?>
                            ]
                    }, {//6
                    name: "Menos de 0.5 Hrs",
                            data: [
                            <?php $tam = count($revision6);
                            for ($j = 0; $j < $tam; $j++) {
                                ?>
                                <?php if ($j == ($tam - 1)) { ?>
                                [Date.UTC(<?php echo date('Y', strtotime($revision6[$j]['Fecha'])); ?>, <?php echo date('m', strtotime($revision6[$j]['Fecha'])); ?>, <?php echo date('d', strtotime($revision6[$j]['Fecha'])); ?>,<?php echo date('H', strtotime($revision6[$j]['Fecha'])); ?>,<?php echo date('i', strtotime($revision6[$j]['Fecha'])); ?>), <?php echo $revision6[$j]['Valor']; ?>]
                                <?php } else { ?>
                                [Date.UTC(<?php echo date('Y', strtotime($revision6[$j]['Fecha'])); ?>, <?php echo date('m', strtotime($revision6[$j]['Fecha'])); ?>, <?php echo date('d', strtotime($revision6[$j]['Fecha'])); ?>,<?php echo date('H', strtotime($revision6[$j]['Fecha'])); ?>,<?php echo date('i', strtotime($revision6[$j]['Fecha'])); ?>), <?php echo $revision6[$j]['Valor']; ?>],
                                <?php } ?>
                            <?php } ?>
                            ]
                    }
                    ]
            }); })(jQuery);
            });
        </script>						
    </head>
    <body>
<?php require_once 'encabezado.php'; ?>
        <input hidden disabled id="fecha1" name="fecha1" type="text" value="<?php echo $fecha_inicial; ?>">
        <input hidden disabled id="fecha2" name="fecha2" type="text" value="<?php echo $fecha_final; ?>">

        <div class="col-sm-2 sidenav" style="margin-top: 40px;">
            <b><p class="espacio-arriba">Seleccionar parámetros del filtro:</p></b>
            <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=reporte_general_detalle_listar">
                <div class="col-sm-12 espacio-abajo-5">
                    <label for="fecha_inicial">Fecha Inicial:</label>
                    <input type="date" required=”required” class="form-control text-center" id="fecha_inicial" name="fecha_inicial" value="<?php echo $fecha_inicial; ?>">
                </div> 
                <div class="col-sm-12">
                    <label for="fecha_final">Fecha Final:</label>
                    <input type="date" required=”required” class="form-control text-center" id="fecha_final" name="fecha_final" value="<?php echo $fecha_final; ?>">
                </div>
                <button type="submit" class="btn btn-default" style="margin-top: 25px; margin: 27px;">Generar Reporte</button>
            </form>
        </div>

        <div class="col-sm-10 container espacio-abajo">
            <section class='container' >
                <div id="container" style="min-width: 310px; max-width: 1000px; height: 500px; margin: 20 auto; margin-top: 50px;"></div>
            </section>
        </div>
<?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>


