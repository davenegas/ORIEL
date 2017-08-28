<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--<meta http-equiv="Content-Type" content="text/html; utf-8"/>-->
        <title>Reportes Controles de Video</title>
        <?php require_once 'frm_librerias_head.html'; ?>
        <script src="vistas/js/highstock.js"></script>
        <script src="vistas/js/highcharts-3d.js"></script>
        <script src="vistas/js/exporting.js"></script>
        
        
        <script type="text/javascript">
             $(document).ready(function () {
                operadorenviado=<?php echo $operador ?>;
                turnoenviado=<?php echo $turno ?>;
                $("#lista_operadores option[value="+operadorenviado+"]").attr("selected",true);
                $("#turno_monitoreo option[value="+turnoenviado+"]").attr("selected",true);
            });
            <?php if ($tipo_grafico==1){ ?>  
            $(function () {
		$('#container').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    title: {
			text: (function() { var data = [];  data.push(['<?php echo $titulo?>']); return data; })()
                    },
                    subtitle: {
			text: (function() { var data = [];  data.push(['<?php echo $subtitulo?>']); return data; })()
                    },
                    xAxis: {
                        categories: (function() { var data = [];
                        <?php   for($i = 0 ;$i<count($params);$i++){ ?>
                            data.push(['<?php echo $params[$i]['Nombre'].' '.$params[$i]['Apellido'];?>']);
                        <?php } ?>
                        return data;
                        })()
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Cantidad de Revisiones de Video ',
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
                        name: 'Cantidad Revisiones de Video: '+'<?php echo $suma_revisiones;?>',
			data: (function() { var data = [];
                            <?php   for($i = 0 ;$i<count($params);$i++){     ?>
                            data.push([<?php echo $params[$i]['TOTAL'];?>]);
                            <?php } ?>
                            return data;
                            })()
                    }]
                });
            });
            
              $(function () {
                $('#container2').highcharts({
                    chart: {
                        type: 'column',
                        options3d: {
                            enabled: true,
                            alpha: 10,
                            beta: 25,
                            depth: 70
                        }
                    },
                    title: {
                        text: (function() { var data = [];  data.push(['<?php echo $titulo2?>']); return data; })()
                    },
                    subtitle: {
                        text: (function() { var data = [];  data.push(['<?php echo $subtitulo?>']); return data; })()
                    },
                    plotOptions: {
                        column: {
                            depth: 25
                        }
                    },
                    xAxis: {
                        categories: (function() { var data = [];
                            data.push(['<?php echo 'Justificaciones Automáticas';?>']);
                            data.push(['<?php echo 'Justificaciones de Operadores';?>']);
                            data.push(['<?php echo 'Injusticadas';?>']);
                            return data;
                            })()
                           //}
                    //xAxis: {
                        //categories: Highcharts.getOptions().lang.shortMonths
                    },
                    yAxis: {
                        title: {
                            text: null
                        }
                    },
                    series: [{
                        name: 'Cantidad de Retrasos: '+'<?php echo $suma_inconsistencias;?>',
                        data: (function() { var data = [];
                            <?php   for($i = 0 ;$i<count($params2);$i++){     ?>
                            data.push([<?php echo $params2[$i]['Total'];?>]);
                            <?php } ?>
                            return data;
                            })(),
                        dataLabels: {
                            enabled: true,
                            rotation: -90,
                            color: '#FFFFFF',
                            align: 'right',
                            format: '{point.y:.f}', // one decimal
                            y: 10, // 10 pixels down from the top
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
                });
            });
            <?php } ?>  
            
            <?php if ($tipo_grafico==2){ ?>  
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: (function() { var data = [];  data.push(['<?php echo $titulo?>']); return data; })()
                    },
                    subtitle: {
                        text: (function() { var data = [];  data.push(['<?php echo $subtitulo?>']); return data; })()
                    },
                    xAxis: {
                        type: 'category',
                        labels: {
                            rotation: -45,
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Cantidad Revisiones de Video: '+'<?php echo $suma_revisiones;?>'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        pointFormat: 'Laborado: <b>{point.y:.f} Revisiones de Video</b>'
                    },
             
                    series: [{
                        name: 'Cantidad Revisiones de Video: '+'<?php echo $suma_revisiones;?>',
                        data:(function() { var data = [];
                            <?php   for($i = 0 ;$i<count($params);$i++){     ?>
                            data.push(['<?php echo $params[$i]['mes'];?>',<?php echo $params[$i]['numFilas'];?>]);
                            <?php } ?>
                            return data;
                            })() ,
                        dataLabels: {
                            enabled: true,
                            rotation: -90,
                            color: '#FFFFFF',
                            align: 'right',
                            format: '{point.y:.f}', // one decimal
                            y: 10, // 10 pixels down from the top
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
                });
            });
        
            $(function () {
                $('#container2').highcharts({
                    chart: {
                        type: 'column',
                        options3d: {
                            enabled: true,
                            alpha: 10,
                            beta: 25,
                            depth: 70
                        }
                    },
                    title: {
                        text: (function() { var data = [];  data.push(['<?php echo $titulo2?>']); return data; })()
                    },
                    subtitle: {
                        text: (function() { var data = [];  data.push(['<?php echo $subtitulo?>']); return data; })()
                    },
                    plotOptions: {
                        column: {
                            depth: 25
                        }
                    },
                    xAxis: {
                        categories: (function() { var data = [];
                            data.push(['<?php echo 'Justificaciones Automáticas';?>']);
                            data.push(['<?php echo 'Justificaciones de Operador';?>']);
                            data.push(['<?php echo 'Injusticadas';?>']);
                            return data;
                            })()
                        //}
                        //xAxis: {
                        //categories: Highcharts.getOptions().lang.shortMonths
                    },
                    yAxis: {
                        title: {
                            text: null
                        }
                    },
                    series: [{
                        name: 'Cantidad de Retrasos: '+'<?php echo $suma_inconsistencias;?>',
                        data: (function() { var data = [];
                            <?php   for($i = 0 ;$i<count($params2);$i++){     ?>
                            data.push([<?php echo $params2[$i]['Total'];?>]);
                            <?php } ?>
                            return data;
                            })(),
                        dataLabels: {
                           enabled: true,
                           rotation: -90,
                           color: '#FFFFFF',
                           align: 'right',
                           format: '{point.y:.f}', // one decimal
                           y: 10, // 10 pixels down from the top
                           style: {
                               fontSize: '13px',
                               fontFamily: 'Verdana, sans-serif'
                           }
                       }
                    }]
                });
            });
            <?php } ?>  
            
            <?php if ($tipo_grafico==3){ ?>  
                $(document).ready(function () {
                    <?php if ($tipo_grafico==3){ ?>  
                        var divisor= document.getElementById('container3');
                        divisor.hidden=false;
                    <?php } ?>  
                });
          
                $(function () {
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: (function() { var data = [];  data.push(['<?php echo $titulo?>']); return data; })()
                        },
                        subtitle: {
                            text: (function() { var data = [];  data.push(['<?php echo $subtitulo?>']); return data; })()
                        },
                        xAxis: {
                            type: 'category',
                            labels: {
                                rotation: -45,
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Cantidad Revisiones de Video: '+'<?php echo $suma_revisiones;?>'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            pointFormat: 'Laborado: <b>{point.y:.f} Revisiones de Video</b>'
                        },
             
                        series: [{
                            name: 'Cantidad Revisiones de Video: '+'<?php echo $suma_revisiones;?>',
                            data:(function() { var data = [];
                                <?php   for($i = 0 ;$i<count($params);$i++){     ?>
                                data.push(['<?php echo $params[$i]['mes'];?>',<?php echo $params[$i]['numFilas'];?>]);
                                <?php } ?>
                                return data;
                                })() ,
                            dataLabels: {
                                enabled: true,
                                rotation: -90,
                                color: '#FFFFFF',
                                align: 'right',
                                format: '{point.y:.f}', // one decimal
                                y: 10, // 10 pixels down from the top
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        }]
                    });
                });
        
                $(function () {
		$('#container3').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    title: {
			text: (function() { var data = [];  data.push(['<?php echo $titulo3?>']); return data; })()
                    },
                    subtitle: {
			text: (function() { var data = [];  data.push(['<?php echo $subtitulo3?>']); return data; })()
                    },
                    xAxis: {
                        categories: (function() { var data = [];
                            <?php   for($i = 0 ;$i<count($params3);$i++){ ?>
                                data.push(['<?php echo $params3[$i]['Nombre'].' '.$params3[$i]['Apellido'];?>']);
                            <?php } ?>
                            return data;
                            })()
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Cantidad de Revisiones de Video ',
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
                        name: 'Cantidad Revisiones de Video: '+'<?php echo $suma_revisiones2;?>',
			data: (function() { var data = [];
                            <?php   for($i = 0 ;$i<count($params3);$i++){     ?>
                            data.push([<?php echo $params3[$i]['TOTAL'];?>]);
                            <?php } ?>
                            return data;
                            })()
                    }]
                });
            });
            
        
            $(function () {
            $('#container2').highcharts({
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 10,
                        beta: 25,
                        depth: 70
                    }
                },
                title: {
                    text: (function() { var data = [];  data.push(['<?php echo $titulo2?>']); return data; })()
                },
                subtitle: {
                    text: (function() { var data = [];  data.push(['<?php echo $subtitulo?>']); return data; })()
                },
                plotOptions: {
                    column: {
                        depth: 25
                    }
                },
                xAxis: {
                    categories: (function() { var data = [];
                        data.push(['<?php echo 'Justificaciones Automáticas';?>']);
                        data.push(['<?php echo 'Justificaciones de Operador';?>']);
                        data.push(['<?php echo 'Injusticadas';?>']);

                        return data;
                    })()
                    //}
             //xAxis: {
                 //categories: Highcharts.getOptions().lang.shortMonths
                },
                yAxis: {
                    title: {
                        text: null
                    }
                },
                series: [{
                    name: 'Cantidad de Retrasos: '+'<?php echo $suma_inconsistencias;?>',
                    data: (function() { var data = [];
                        <?php   for($i = 0 ;$i<count($params2);$i++){     ?>
                        data.push([<?php echo $params2[$i]['Total'];?>]);
                        <?php } ?>
                        return data;
                        })(),
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
            });
        });
        <?php } ?>  
	</script>
        
   
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="col-sm-2 sidenav" style="margin-top: 40px;">
            <h3 align="center"><b><p class="espacio-arriba">Seleccionar Parámetros del Filtro</p></b></h3>
            <br><br>
            <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=reporte_controles_de_video_listar">
                <div class="col-sm-12 espacio-abajo-5">
                    <label for="fecha_inicial">Fecha Inicial:</label>
                    <input type="date" required=”required” class="form-control text-center" id="fecha_inicial" name="fecha_inicial" value="<?php echo $fecha_inicio;?>">
                </div> 
                <br><br><br><br>
                <div class="col-sm-12">
                    <label for="fecha_final">Fecha Final:</label>
                    <input type="date" required=”required” class="form-control text-center" id="fecha_final" name="fecha_final" value="<?php echo $fecha_fin;?>">
                </div>
                <br><br><br><br>
                <div class="col-sm-12">
                <label for="lista_usuarios">Operador:</label>
                <select class="form-control" required=”required” id="lista_operadores" name="lista_operadores" > 
                    <option value="0" selected="true">Todos los Operadores</option>
                    <?php
                    $tam_lista_operadores = count($lista_de_operadores);
                    for($i=0; $i<$tam_lista_operadores;$i++) { ?> 
                        <option value="<?php echo  $lista_de_operadores[$i]['ID_Usuario']?>"><?php echo  $lista_de_operadores[$i]['Nombre_Completo']?></option>
                    <?php } ?>  
                </select>
                </div>
                <br><br><br><br>
                <div class="col-sm-12">
                <label for="turno_monitoreo">Turno:</label>
                <select class="form-control" required=”required” id="turno_monitoreo" name="turno_monitoreo" > 
                    <option value="0">Todos los turnos</option>
                    <option value="1">Día</option>
                    <option value="2">Tarde</option>
                    <option value="3">Noche</option>
                </select>
                </div>
                <button type="submit" class="btn btn-default" style="margin-top: 25px; margin: 27px;">Generar Reporte</button>
            </form> 
        </div>
        <div class="col-sm-10 container espacio-abajo">
            <section class='container text-center' >
                <div id="container" style="min-width: 310px; max-width: 1000px; height: 1000px; margin: 20 auto; margin-top: 50px;"></div>
            </section>
            <section class='container text-center' >
                <div id="container3" hidden="true" style="min-width: 310px; max-width: 1000px; height: 1000px; margin: 20 auto; margin-top: 50px;"></div>
            </section>
             <section class='container text-center' >
                <div id="container2" style="min-width: 310px; max-width: 1000px; height: 1000px; margin: 20 auto; margin-top: 50px;"></div>
            </section>
        </div>
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>