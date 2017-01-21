<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bitácora Cencon</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_cencon.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>  
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container-fluid text-center">
            <h2>Bitácora Digital de Cencon</h2> 
<!--            <pre>
                <?php print_r($params);?>
            </pre>-->
            <div class="row content">
            <!--Se mantienen este div para dejar espacio a la izquierda de la tabla-->    
                <div class="col-sm-1 sidenav">
                </div>
                <!--DIV central contiene la tabla con el personal externo-->    
                <div class="col-sm-8 container">
                    <div>
                        <h4>Ingresar nueva apertura de cajero automático</h4>
                        <form class="bordegris" id="nuevo_evento_cencon" method="post" name="form" action="index.php?ctl=">
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="numero_atm">Número de Cajero Automático</label>
                                <input type="text" class="form-control" id="numero_atm" name="numero_atm" onblur="evento_buscar_cajero();" placeholder="Digite el número del cajero automático">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="nombre_atm">Nombre del Cajero Automático</label>
                                <input type="text" class="form-control" disabled id="nombre_atm" name="nombre_atm" placeholder="">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="tipo_atm">Tipo de Cajero</label>
                                <input type="text" class="form-control" disabled id="tipo_atm" name="tipo_atm" placeholder="">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="cedula">Número de Cedula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" onblur="evento_buscar_persona();" placeholder="Digite el número de cedula">
                                
                            </div>
                            <div>
                                <input hidden type="text" id="ID_Empresa">
                                <input hidden type="text" id="ID_PuntoBCR">
                                <input hidden type="text" id="ID_Persona">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="nombre_persona">Nombre del Funcionario</label>
                                <input type="text" class="form-control" disabled id="nombre_persona" name="nombre_persona" placeholder="">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="unidad_ejecutora">Unidad Ejecutora</label>
                                <input type="text" class="form-control" disabled id="unidad_ejecutora" name="unidad_ejecutora" placeholder="">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="hora">Hora</label>
                                <input type="time" class="form-control" id="hora" name="hora" value="<?php echo date("H:i", time());?>">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="acceso_atms">Acceso a cajeros</label>
                                <input type="text" disabled class="form-control" id="acceso_atms" name="acceso_atms" placeholder="">
                            </div>
                            <div class="col-sm-12 espacio-abajo-5">
                                <label for="observaciones">Observaciones</label>
                                <input type="text"  class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones o comentarios de la apertura">
                            </div>
                            <input type="button" class="quitar-float espacio-abajo espacio-arriba" value="Agregar apertura" onclick="agregar_evento_cencon();">
                        </form>
                    </div>
                    
                    <div>
                        <h4><b>Cajeros automáticos abiertos</b></h4>
                        <table id="tabla4" class="display" cellspacing="0" width="100%">
                            <thead> 
                                <tr>
                                    <th style="text-align:center">Fecha</th>
                                    <th style="text-align:center">Hora</th>
                                    <th style="text-align:center">ATM</th>
                                    <th style="text-align:center">Funcionario</th>
                                    <th style="text-align:center">Observaciones</th>
                                    <th style="text-align:center">Cerrar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $tam=count($params);
                                for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $params[$i]['Fecha_Apertura'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Hora_Apertura'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Codigo']." - ".$params[$i]['Nombre'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Nombre_Persona'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                                    <td style="text-align:center"><a class="btn" role="button" onclick="evento_cencon_cerrar(<?php echo $params[$i]['ID_Evento_Cencon'];?>);">
                                            Cerrar Cajero</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-3 sidenav">
                    <div class="well">
                        <p>Alerta de tiempo de apertura +40min</p>
                    </div>
                    <div class="well" align="left">
                        <p>Lista</p>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>
