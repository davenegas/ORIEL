<!DOCTYPE html>
<html lang="es">
<head>
    <title>Asistencia</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="vistas/css/reloj.css">
    <?php require_once 'frm_librerias_head.html'; ?> 
    <style>    
        .ancho{
            display: table;
            table-layout: fixed;
            height: 350px;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php require_once 'encabezado.php';?>
    <div class="container text-center">    
        <div class="row">
            <div class="col-sm-12">   
                <div class="row"></div>
                <div class="col-sm-12">
                    <div> <p></p></div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="well ancho" >
                            <h3>Registro de Marca Turno</h3>
                            <section id="Fecha_hoy">
                                <?php 
                                $hoy = date("F j, Y, g:i a");
                                $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                ?><h4><?php echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. ", ".date('Y')."."; ?></h4>
                            </section>    
                            <section id="contReloj">
                                <p id="pHoras"></p>
                                <p>:</p>
                                <p id="pMinutos"></p>
                                <p>:</p>
                                <p id="pSegundos"></p>
                                <script language="javascript" src="vistas/js/listas_dependientes_asistencia.js"></script>
                            </section>
                            <h4>Estado de marca del hoy</h4>
                            <section id='marca_turno'>
                                <label for="entrada_turno">Marca entrada: <span class="glyphicon glyphicon-ok"></span> Correcta</label><br>
                                <label for="salida_turno">Marca salida: <span class="glyphicon glyphicon-remove"></span> Pendiente</label><br><br>
                                <a onclick="" class="btn btn-default" role="button">ENTRADA</a>
                                <a onclick="" class="btn btn-default" role="button">SALIDA</a>
                            </section>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="well ancho">
                            <h3>Registro Descansos</h3>
                            <br><br>
                            <h4>Descansos pendientes del turno: #</h4><br>
                            <section id='marca_descanso'>
                                <label for="entrada_turno">Descanso salida: --:--</label><br>
                                <label for="salida_turno">Descanso entrada: --:--</label><br>
                                <label for="salida_turno">Total ultimo descanso: -- minutos</label><br><br>
                                <a onclick="" class="btn btn-default" role="button">SALIDA</a>
                                <a onclick="" class="btn btn-default" role="button">ENTRADA</a>
                            </section>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="well ancho">
                            <h3>Inconsistencias</h3>
                            <br><br>
                            <h4>Cantidad de inconsistencias personas sin justificar</h4>
                            <h1><a>#</a></h1>
                            <h4>Se horario está próximo a vencer, por favor comuníquese con su supervisor inmediato para la actualización del mismo</h4>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="well ancho">
                            <h3>Otros indicadores</h3>
                        </div>
                    </div>
                </div>
            </div>
          </div>
    </div>
    <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
</body>
</html>