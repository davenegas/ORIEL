<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta http-equiv="refresh" content="150"/>
        <title>Alertas Generales</title>
        <?php require_once 'frm_librerias_head.html'; ?>
        <script src="vistas/js/highcharts.js"></script>
        <script src="vistas/js/exporting.js"></script>
        
        <script type="text/javascript">
            $(function () {
                $(document).ready(function () {
                    $('#pruebas').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Pruebas pendientes= <?php echo $pruebas_pendientes;?>'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [{
                                name: 'Pruebas recibidas',
                                y: <?php echo $contador_pruebas?>
                            }, {
                                name: 'Pruebas pendientes',
                                y: <?php echo $pruebas_pendientes?>,
                                sliced: true,
                                selected: true
                            }]
                        }]
                    });
                });
                
                $(document).ready(function () {
                    $('#aperturas').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Aperturas pendientes= <?php echo $aperturas_pendientes;?>'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [{
                                name: 'Aperturas recibidas',
                                y: <?php echo $contador_aperturas?>
                            }, {
                                name: 'Aperturas pendientes',
                                y: <?php echo $aperturas_pendientes?>,
                                sliced: true,
                                selected: true
                            }]
                        }]
                    });
                });
                
                $(document).ready(function () {
                    $('#cierres').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Cierres pendientes= <?php echo $cierres_pendientes;?>'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [{
                                name: 'Cierres recibidos',
                                y: <?php echo $contador_cierres?>
                            }, {
                                name: 'Cierres pendientes',
                                y: <?php echo $cierres_pendientes?>,
                                sliced: true,
                                selected: true
                            }]
                        }]
                    });
                });
            });
            $(function () {
                    $('#pendientes_puesto').highcharts({
                            chart: {
                                    type: 'bar'
                            },
                            title: {
                                    text: 'Eventos pendientes por puesto'
                            },
                            xAxis: {
                                    categories: ['Puesto 1', 'Puesto 2', 'Puesto 3', 'Puesto 4', 'Puesto Z2'],
                                    title: {
                                            text: null
                                    }
                            },
                            yAxis: {
                                    min: 0,
                                    title: {
                                            text: 'Eventos pendientes',
                                            align: 'high'
                                    },
                                    labels: {
                                            overflow: 'justify'
                                    }
                            },
                            plotOptions: {
                                    bar: {
                                            dataLabels: {
                                                    enabled: true
                                            }
                                    }
                            },
                            credits: {
                                    enabled: false
                            },
                            series: [{
                                    name: 'Eventos pendientes',
                                    data: [<?php echo $pendiente_puesto1[0]['Contador']?>, 
                                        <?php echo $pendiente_puesto2[0]['Contador']?>, 
                                        <?php echo $pendiente_puesto3[0]['Contador']?>, 
                                        <?php echo $pendiente_puesto4[0]['Contador']?>, 
                                        <?php echo $pendiente_puestoZ2[0]['Contador']?>]
                            }]
                    });
		});
            
	</script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <script src="vistas/js/highcharts.js"></script>
        <script src="vistas/js/exporting.js"></script>
        
        <div class="col-sm-4 sidenav espacio-abajo">
            <div class="well" align="center">SISTEMA DE ALARMA</div>
            <div id="pruebas"  style="min-width: 300px; height: 350px; max-width: 500px; margin: 0 auto"></div>
            <div id="aperturas" style="min-width: 300px; height: 350px; max-width: 500px; margin: 0 auto"></div>
            <div id="cierres" style="min-width: 300px; height: 350px; max-width: 500px; margin: 0 auto"></div>
        </div>
        
        <div class="col-sm-4 sidenav espacio-abajo">
            <div class="well" align="center" >CERRADURAS CENCON</div>
            <?php if(isset($vencidos)){ ?>
                <div style="text-align: justify;" >
                    <?php 
                    $tam=$tam=count($vencidos);
                    for ($i = 0; $i <$tam; $i++) {?>
                        <p style="<?php echo $vencidos[$i]['color']?>"><?php echo "> ".$vencidos[$i]['mensaje'];?> <br></p>
                    <?php }?>   
                </div>
            <?php } ?>
        </div>
        
        <div class="col-sm-4 sidenav espacio-abajo">
            <div class="well" align="center">PENDIENTES POR PUESTO</div>
            <div style="text-align: justify;" >
                <p><b>Puesto 1</b></p>
                    <?php if (isset($pendiente_puesto1)){
                        $tam=$tam=count($pendiente_puesto1);
                        for ($i = 0; $i <$tam; $i++) {?>
                            <p><?php echo "> ".$pendiente_puesto1[$i]['Mensaje'];?> <br></p>
                        <?php }   
                    } ?>
                <p><b>Puesto 2</b></p>
                    <?php if (isset($pendiente_puesto2)){
                        $tam=$tam=count($pendiente_puesto2);
                        for ($i = 0; $i <$tam; $i++) {?>
                            <p><?php echo "> ".$pendiente_puesto2[$i]['Mensaje'];?> <br></p>
                        <?php }   
                    } ?>
                <p><b>Puesto 3</b></p>
                    <?php if (isset($pendiente_puesto3)){
                        $tam=$tam=count($pendiente_puesto3);
                        for ($i = 0; $i <$tam; $i++) {?>
                            <p><?php echo "> ".$pendiente_puesto3[$i]['Mensaje'];?> <br></p>
                        <?php }   
                    } ?>
                <p><b>Puesto 4</b></p>
                    <?php if (isset($pendiente_puesto4)){
                        $tam=$tam=count($pendiente_puesto4);
                        for ($i = 0; $i <$tam; $i++) {?>
                            <p><?php echo "> ".$pendiente_puesto4[$i]['Mensaje'];?> <br></p>
                        <?php }   
                    } ?>
                <p><b>Puesto Z2</b></p>
                    <?php if (isset($pendiente_puestoZ2)){
                        $tam=$tam=count($pendiente_puestoZ2);
                        for ($i = 0; $i <$tam; $i++) {?>
                            <p><?php echo "> ".$pendiente_puestoZ2[$i]['Mensaje'];?> <br></p>
                        <?php }   
                    } ?>
                </div>
            <div id="pendientes_puesto"  style="min-width: 300px; height: 350px; max-width: 500px; margin: 0 auto"></div>
        </div>
        
        <?php //require_once 'pie_de_pagina.php' ?>
    </body>
</html>
