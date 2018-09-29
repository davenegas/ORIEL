<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="refresh" content="180"/>
        <title>Alertas Generales</title>
        <?php require_once 'frm_librerias_head.html'; ?>
        <script src="vistas/js/highcharts.js"></script>
        <script src="vistas/js/exporting.js"></script>
        <script type="text/javascript">
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
            
            $(document).ready(function () {
                val=0;
                cctv();
                setInterval(cctv,30000);
            });
            
            function cctv(){
                $.post("index.php?ctl=reporte_tiempo_revision_actual", {}, function(data){
                    var n= data.search("No se encontró");
                    datos_control.innerHTML = data;
                });
            }
	</script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <script src="vistas/js/highcharts.js"></script>
        <script src="vistas/js/exporting.js"></script>
        
        <div class="col-sm-4 sidenav espacio-abajo">
            <div class="well" align="center">SISTEMA DE ALARMA</div>
            <div class="">
                <h5><strong>Pruebas pendientes: <?php echo $datos['cont_pruebas_pendientes'];?></strong></h5>
                <h5>Pruebas recibidas: <?php echo $datos['contador_pruebas'];?></h5>
                <h5><strong>Aperturas pendientes: <?php echo $datos['cont_aperturas_pendientes'];?></strong></h5>
                <h5>Aperturas recibidas: <?php echo $datos['contador_aperturas'];?></h5>
                <h5><strong>Cierres pendientes: <?php echo $datos['cont_cierres_pendientes'];?></strong></h5>
                <h5>Cierres recibidas: <?php echo $datos['contador_cierres'];?></h5>
            </div>
            
            <div class="well espacio-arriba" align="center" >CERRADURAS CENCON</div>
            <?php if(isset($vencidos)){ ?>
                <div style="text-align: justify;" >
                    <h5 style="color: blueviolet">Cajero(s) informado al coordinador BCR= <?php echo $cajero_violeta;?></h5> 
                    <h5 style="color: orange">Cajero(s) con seguimiento= <?php echo $cajero_naranja;?></h5>
                    <h5 style="color: black">Cajero(s) abierto normales= <?php echo $cajero_negro;?></h5>
                    <h5 style="color: mediumblue;text-decoration: underline;">Cajero(s) con apertura especial= <?php echo $cajero_especial;?></h5>
                    <?php if(isset($sin_coordinar[0]['Total'])){ ?>
                        <p><strong>Cantidad de aperturas sin coordinar en tiempo establecido: <?php echo $sin_coordinar[0]['Total']?></strong></p>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        
        <div class="col-sm-4 sidenav espacio-abajo">
            <div class="well" align="center" >CONTROL DE VIDEO</div>
            <div class="espacio-abajo well">
                <h5 style="color: red;">Unidades de video, ultima revisión más de 2:30 horas= <?php echo $revision_151_mas;?></h5>
                <h5 style="color: orange;">Unidades de video, ultima revisión entre 2 y 2:30 horas= <?php echo $revision_121_150;?></h5>
                <h5>Unidades de video, ultima revisión entre 1:30 y 2 horas= <?php echo $revision_91_120;?></h5>
                <h5>Unidades de video, ultima revisión entre 1 hora y 1:30= <?php echo $revision_61_90;?></h5>
                <h5>Unidades de video, ultima revisión entre 30 minutos y 1 horas= <?php echo $revision_31_60;?></h5>
                <h5>Unidades de video, ultima revisión en menos de una 30 minutos= <?php echo $revision_0_30;?></h5>
            </div>
            
            <div id="datos_control" style="text-align: justify;" class="espacio-abajo borde-gris"></div>

            
        </div>
        
        <div class="col-sm-4 sidenav espacio-abajo">
            <div class="well" align="center">PENDIENTES POR PUESTO</div>
            <div style="text-align: justify;" >
                <p><b>Puesto 1</b></p>
                    <?php if (isset($pendiente_puesto1[0]['Mensaje'])){
                        $tam=$tam=count($pendiente_puesto1);
                        for ($i = 0; $i <$tam; $i++) {?>
                            <p><?php echo "> ".$pendiente_puesto1[$i]['Mensaje'];?> <br></p>
                        <?php }   
                    } ?>
                <p><b>Puesto 2</b></p>
                    <?php if (isset($pendiente_puesto2[0]['Mensaje'])){
                        $tam=$tam=count($pendiente_puesto2);
                        for ($i = 0; $i <$tam; $i++) {?>
                            <p><?php echo "> ".$pendiente_puesto2[$i]['Mensaje'];?> <br></p>
                        <?php }   
                    } ?>
                <p><b>Puesto 3</b></p>
                    <?php if (isset($pendiente_puesto3[0]['Mensaje'])){
                        $tam=$tam=count($pendiente_puesto3);
                        for ($i = 0; $i <$tam; $i++) {?>
                            <p><?php echo "> ".$pendiente_puesto3[$i]['Mensaje'];?> <br></p>
                        <?php }   
                    } ?>
                <p><b>Puesto 4</b></p>
                    <?php if (isset($pendiente_puesto4[0]['Mensaje'])){
                        $tam=$tam=count($pendiente_puesto4);
                        for ($i = 0; $i <$tam; $i++) {?>
                            <p><?php echo "> ".$pendiente_puesto4[$i]['Mensaje'];?> <br></p>
                        <?php }   
                    } ?>
                <p><b>Puesto Z2</b></p>
                    <?php if (isset($pendiente_puestoZ2[0]['Mensaje'])){
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
