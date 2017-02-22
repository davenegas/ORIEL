<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pruebas Alarma</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_pruebas.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> 
        <?php require_once 'frm_librerias_head.html'; ?>  
    </head>
    <body>
        
        <?php require_once 'encabezado.php';?>
        <div class="container-fluid text-center">
            <h2>Pruebas de Alarma</h2> 
            <div class="row content">
                <!--Se mantienen este div para dejar espacio a la izquierda de la tabla-->    
                <div class="col-sm-1 sidenav">
                </div>
                <!--DIV central contiene la tabla con el personal externo-->    
                <div class="col-sm-8 container">
                    <div>
                        <h4>Registrar pruebas de alarma</h4>
                        <form class="bordegris" id="nuevo_evento_cencon" method="post" name="form" action="index.php?ctl=">
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="numero_punto">Código de agencia</label>
                                <input type="text" class="form-control" id="numero_punto" name="numero_punto" onblur="evento_buscar_puntobcr();" placeholder="Digite el número del cajero automático">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="nombre_punto">Nombre de la agencia</label>
                                <input type="text" class="form-control" disabled id="nombre_punto" name="nombre_punto" placeholder="">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="tipo_punto">Tipo de agencia</label>
                                <input type="text" class="form-control" disabled id="tipo_punto" name="tipo_punto" placeholder="">
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
                                <label for="seguimiento">Tipo Prueba</label>
                                <select class="form-control" id="seguimiento" disabled name="seguimiento" >
                                    <option value="Panico" selected="selected">Activación de Panico</option>
                                    <option value="Intrusion">Activación de Intrusión</option>
                                    <option value="Fuego">Activación de Fuego</option>
                                </select>
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="hora">Hora apertura</label>
                                <input type="time" disabled class="form-control" id="hora" name="hora" value="">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="hora">Hora prueba</label>
                                <input type="time" disabled class="form-control" id="hora" name="hora" value="">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="acceso_atms">Número de zona</label>
                                <input type="text" disabled class="form-control" id="acceso_atms" name="acceso_atms" placeholder="">
                            </div>
                            <div class="col-sm-4 espacio-abajo-5">
                                <label for="hora">Hora cierre</label>
                                <input type="time" disabled class="form-control" id="hora" name="hora" value="">
                            </div>
                            <div class="col-sm-6 espacio-abajo-5">
                                <label for="observaciones">Observaciones</label>
                                <input type="text" disabled class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones o comentarios de la prueba de alarma">
                            </div>
                            <div class="col-sm-2 espacio-abajo-5">
                                <label for="observaciones">Revisión cajeros</label>
                                <input type="checkbox" id="revision" name="revision" class="form-control">
                            </div>
                            
                            <input type="button" class="quitar-float espacio-abajo espacio-arriba" value="Guardar" onclick="guardar_prueba();">
                        </form>
                    </div>
                    
                    <div>
                        <h4><b>Cajeros automáticos abiertos</b></h4>
                        <table id="tabla4" class="display" cellspacing="0" width="100%">
                            <thead> 
                                <tr>
                                    <th hidden style="text-align:center">ID</th>
                                    <th style="text-align:center">Fecha</th>
                                    <th style="text-align:center">Hora</th>
                                    <th style="text-align:center">ATM</th>
                                    <th style="text-align:center">Funcionario</th>
                                    <th style="text-align:center">Observaciones</th>
                                    <th style="text-align:center">Seguimiento</th>
                                    <th style="text-align:center">Cerrar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $tam=count($params);
                                for ($i = 0; $i <$tam; $i++) { ?>  
                                    <tr>
                                        <td hidden style="text-align:center"><?php echo $params[$i]['ID_Evento_Cencon'];?></td>
                                        <td style="text-align:center"><?php echo $params[$i]['Fecha_Apertura'];?></td>
                                        <td style="text-align:center"><?php echo $params[$i]['Hora_Apertura'];?></td>
                                        <td style="text-align:center"><?php echo $params[$i]['Codigo']." - ".$params[$i]['Nombre'];?></td>
                                        <td style="text-align:center" onclick="reasignar_apertura('<?php echo $params[$i]['ID_Evento_Cencon'];?>','<?php echo $params[$i]['ID_PuntoBCR'];?>');"><?php echo $params[$i]['Nombre_Persona'];?></td>
                                        <td style="text-align:center" onclick="editar_observaciones('<?php echo $params[$i]['ID_Evento_Cencon'];?>','<?php echo $params[$i]['Observaciones'];?>')"><?php echo $params[$i]['Observaciones'];?></td>
                                        <td style="text-align:center" onclick="editar_seguimiento('<?php echo $params[$i]['ID_Evento_Cencon'];?>','<?php echo $params[$i]['Seguimiento'];?>')"><?php echo $params[$i]['Seguimiento'];?></td>
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
                        <p>Alerta de tiempo de apertura:</p>
                    </div>
                    <?php if(isset($vencidos)){?>
                        <div class="well" align="left">
                            <p><b> | ATM | Días | Horas | Minutos</b></p>
                            <?php 
                            $tam=$tam=count($vencidos);
                            for ($i = 0; $i <$tam; $i++) {?>
                                <p style="<?php echo $vencidos[$i]['color']?>"><?php echo "- ".$vencidos[$i]['mensaje'];?> <br></p>
                            <?php }?>   
                        </div>
                <?php } ?>
                </div>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    
    
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <div id="ventana">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <h2 align="center" id="titulo_ventana_oculta">Evento Cencon Observaciones</h2>
                    <hr>
                    <input hidden id="ID_Evento_Cencon" name="ID_Evento_Cencon" type="text" value="">

                    <label for="observaciones_evento">Observaciones</label>
                    <input class="form-control" id="observaciones_evento" name="observaciones_evento" type="text">            
                    <hr>
                    <button onclick="guardar_observaciones_evento();">Guardar</a></button>
                </div>
            </div>
        </div>

        <div id="ventana_oculta_2"> 
            <div id="popupventana">
                <div id="ventana">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <h2 align="center" id="titulo_ventana_oculta">Reasignar apertura Cencon</h2>
                    <hr>
    <!--                <input hidden id="ID_Evento_Cencon" name="ID_Evento_Cencon" type="text" value="">-->
                    <input hidden id="numero_cajero" name="numero_cajero" type="text" value="">

                    <label for="Cedula_persona">Número de Cédula</label>
                    <input class="form-control" id="Cedula_persona" name="Cedula_persona" type="text">            
                    <hr>
                    <button onclick="reasignar_apertura_cencon();">Guardar</a></button>
                </div>
            </div>
        </div>

        <div id="ventana_oculta_3"> 
            <div id="popupventana">
                <div id="ventana">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <h2 align="center" id="titulo_ventana_oculta">Evento Cencon Seguimiento</h2>
                    <hr>
                    <!--<input hidden id="ID_Evento_Cencon" name="ID_Evento_Cencon" type="text" value="">-->
                    <label for="seguimiento_evento">Seguimiento</label>
                        <select class="form-control" id="seguimiento_evento" name="seguimiento_evento" >
                            <option value=""></option>
                            <option value="Se envió correo al funcionario">Se envió correo al funcionario</option>
                            <option value="Se envió correo al encargado">Se envió correo al encargado</option>
                            <option value="Se le informó al coordinador">Se le informó al coordinador</option>
                            <option value="Arqueo de ATM">Arqueo de ATM</option>
                            <option value="ATM en Mantenimiento">ATM en Mantenimiento</option>
                            <option value="Apertura con llave Azul">Apertura con llave Azul</option>
                        </select>          
                    <hr>
                    <button onclick="guardar_seguimiento_evento();">Guardar</a></button>
                </div>
            </div>
        </div>
    </body>
</html>
