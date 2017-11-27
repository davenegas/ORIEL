<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Accesos programados</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script language="javascript" src="vistas/js/valida_un_solo_click_en_formulario.js"></script>  
        <script language="javascript" src="vistas/js/lista_dependientes_programacion.js?0.4.3"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <!--<pre><?php print_r($vencidos);?></pre>-->
        <div class="row">
            <div class="col-md-1"></div>
            <div class="animated fadeIn col-md-9">
                <h2>Programaciones: Acceso-Alarma-CCTV</h2>
                <div class="espacio-abajo-6 well">
                    <form class="form-horizontal" id="nueva_programacion" method="POST" enctype="multipart/form-data" action="index.php?ctl=programacion_guardar">
                        <div class="row espacio-abajo">
                            <div class="col-md-4">
                                <label for="Fecha">Fecha</label>
                                <input type="date" required class="form-control" id="Fecha" name="Fecha" value="<?php echo date("Y-m-d");?>">
                            </div>
                            <div class="col-md-4">
                                <label for="Hora">Hora</label>
                                <input type="time" required class="form-control" id="Hora" name="Hora" value="<?php echo date("H:i", time());?>">
                            </div>
                            <div class="col-md-4">
                                <label for="usuario">Usuario</label>
                                <input type="text" hidden id="ID_Usuario" name="ID_Usuario" value="<?php echo $_SESSION['id'];?>">
                                <input type="text" disabled class="form-control" id="usuario" name="usuario" value="<?php echo $_SESSION['name'].' '.$_SESSION['apellido'];?>">
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-md-4">
                                <label for="solicitante">Persona al que se programa</label>
                                <input type="text" hidden id="ID_Persona" name="ID_Persona">
                                <input type="text" hidden id="ID_Empresa" name="ID_Empresa">
                                <input type="text" required class="form-control" id="solicitante" name="solicitante" onclick="buscar_persona();">
                            </div>
                            <div class="col-md-4">
                                <label for="autoriza">Funcionario que autoriza</label>
                                <input type="text" hidden id="ID_Persona_Autoriza" name="ID_Persona_Autoriza">
                                <input type="text" required class="form-control" id="autoriza" name="autoriza" onclick="buscar_persona();">
                            </div>
                            <div class="col-md-4">
                                <label for="unidad_ejecutora">Unidad Ejecutora del funcionario</label>
                                <input type="text" hidden id="ID_Unidad_Ejecutora" name="ID_Unidad_Ejecutora" value="0">
                                <input type="text" disabled class="form-control" id="unidad_ejecutora" name="unidad_ejecutora">
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-md-4">
                                <label for="tipo_solicitud">Tipo de Solicitud</label>
                                <select class="form-control" id="tipo_solicitud" name="tipo_solicitud"> 
                                    <option value="0"></option>
                                    <option value="Activar gafete">Activar gafete</option>
                                    <option value="Desactivar gafete">Desactivar gafete</option>
                                    <option value="Agregar areas">Agregar áreas</option>
                                    <option value="Eliminar areas">Eliminar áreas</option>
                                    <option value="Reporte">Reporte</option>
                                    <option value="Horario especial">Horario especial</option>
                                    <option value="Modificar horario">Modificar horario</option>
                                    <option value="Modificar Continuum">Modificar Continuum</option>
                                    <option value="Agregar alarma">Agregar clave alarma</option>
                                    <option value="Agregar video">Agregar acceso Rapid-Eye</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="fecha_vencimiento">Fecha de vencimiento de la solicitud</label>
                                <input type="date" required class="form-control" id="fecha_vencimiento" name="fecha_vencimiento"  value="<?php echo date("Y-m-d");?>">
                            </div>
                            <div class="col-md-4">
                                <label for="Detalle">Detalle u Observaciones</label>
                                <input type="text" class="form-control" id="Detalle" name="Detalle">
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-md-4">
                                <label for="puntobcr">Oficina</label>
                                <input type="text" hidden id="ID_PuntoBCR" name="ID_PuntoBCR">
                                <input type="text" disabled class="form-control" id="puntobcr" name="puntobcr" onclick="buscar_punto();">
                            </div>
                            <div class="col-md-4">
                                <label for="gafete">Número de gafete</label>
                                <input type="text" disabled class="form-control" id="gafete" name="gafete">
                            </div>
                            <div class="col-md-4">
                                <label for="detalle">Seleccionar áreas asignadas/eliminadas</label>
                                <input type="text" disabled class="form-control" onclick="seleccionar_modulos();" id="detalle" name="detalle">
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-md-5">
                                <label for="archivo_adjunto">Adjuntar Archivo</label>
                                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                <input type="file" name="archivo_adjunto" id="seleccionar_archivo" class="btn btn-default">
                            </div> 
                        </div>
                        <!--Lista de módulos- Ventana oculta-->
                        <div id="ventana_oculta_2">
                            <div id="popupventana2">
                                <div id="ventana2">
                                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                                    <h2>Listado de Módulos controlados</h2>
                                    <table class="tabla_modulo" border="1" id="tabla_modulo">
                                        <thead>
                                            <tr>
                                                <!--<th>Owner</th>-->
                                                <th>Name</th>
                                                <th>IOU</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $tam=count($modulos);
                                            for ($i = 0; $i <$tam; $i++){?>
                                                <tr>
                                                    <!--<td><?php echo $modulos[$i]['Owner'];?></td>-->
                                                    <td><?php echo $modulos[$i]['Name'];?></td>
                                                    <td><?php echo $modulos[$i]['IOU'];?></td>
                                                    <td><input type="checkbox" 
                                                        name="lista[]" value="<?php echo $modulos[$i]['ID_Modulo_Puerta_Controlada'];?>">
                                                    </td> 
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-default"><a href="javascript:%20validar_programacion()" >Guardar</a></button>
                        <a href="index.php?ctl=principal" class="btn btn-default" role="button">Salir</a> 
                    </form>
                </div>
            </div>
            <div class="col-md-2">
                <h3>Alertas</h3>
                <?php if(count($vencidos)> 0){?>
                    <div class="well">
                        <h4>Programaciones vencidas</h4>
                        <?php for($i = 0; $i <count($vencidos); $i++){ ?>
                            <p onclick="buscar_programacion(<?php echo $vencidos[$i]['ID_Programacion']?>);"><?php echo "#".$vencidos[$i]['ID_Programacion']." / ". $vencidos[$i]['Tipo_Solicitud']?></p>
                        <?php }?>
                    </div> 
                <?php }?>
            </div>
        </div>
        <div class="row">
            <div class="espacio-abajo-6 container">
                <h3 class="icon-caret-right" data-toggle="collapse" data-target="#reporte_programaciones">Lista de programaciones</h3>
                <div id="reporte_programaciones" class="collapse">
                    <div class="row espacio-abajo">
                        <h4 class="espacio-arriba">Seleccionar parámetros del filtro:</h4>
                        <div class="row espacio-abajo">
                            <div class="col-xs-2">
                                <input type="text" hidden id="Numero_evento" name="Numero_evento">
                                <label for="fecha_inicial_reporte">Fecha Inicial:</label>
                                <input type="date" required class="form-control" id="fecha_inicial_reporte" name="fecha_inicial_reporte" value="<?php echo date("Y-m-d");?>">
                            </div> 
                            <div class="col-xs-2">
                                <label for="fecha_final_reporte">Fecha Final:</label>
                                <input type="date" required class="form-control" id="fecha_final_reporte" name="fecha_final_reporte" value="<?php echo date("Y-m-d");?>">
                            </div>
                            <div class="col-xs-3">
                                <label for="tipo_solicitud_reporte">Tipo de Solicitud</label>
                                <select class="form-control" id="tipo_solicitud_reporte" name="tipo_solicitud_reporte"> 
                                    <option value="0">Todas</option>
                                    <option value="Vencidos">Vencidos</option>
                                    <option value="Activar gafete">Activar gafete</option>
                                    <option value="Desactivar gafete">Desactivar gafete</option>
                                    <option value="Agregar areas">Agregar áreas</option>
                                    <option value="Eliminar areas">Eliminar áreas</option>
                                    <option value="Ampliar fecha">Ampliar fecha</option>
                                    <option value="Reporte">Reporte</option>
                                    <option value="Horario especial">Horario especial</option>
                                    <option value="Modificar horario">Modificar horario</option>
                                    <option value="Modificar Continuum">Modificar Continuum</option>
                                    <option value="Agregar alarma">Agregar clave alarma</option>
                                    <option value="Agregar video">Agregar acceso Rapid-Eye</option>
                                </select>
                            </div>
                            <a class="btn btn-default espacio-arriba" role="button" id="prueba" name="prueba" onclick="generar_reporte()">Generar Reporte</a>
                        </div>
                        <div class="row">
                            <table id="tabla3" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="text-align:center">Número</th>
                                    <th style="text-align:center">Fecha</th>
                                    <th style="text-align:center">Hora</th>
                                    <th style="text-align:center">Usuario</th>
                                    <th style="text-align:center">Persona</th>
                                    <th style="text-align:center">Autoriza</th>
                                    <th style="text-align:center">Tipo solicitud</th>
                                    <th style="text-align:center">Fecha vencimiento</th>
                                    <th style="text-align:center">Detalle</th>
                                    <th style="text-align:center">Estado</th>
                                    <th style="text-align:center">PuntoBCR</th>
                                    <th style="text-align:center">Gafete</th>
                                    <th style="text-align:center">Módulos</th>
                                    <th style="text-align:center">Adjunto</th>
                                </tr>
                            </thead>  
                            <tbody id="cuerpo_tabla"></tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php'?>
        
        <!--Asignar Persona para programar y autorizar -->
        <div id="ventana_oculta_1">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <h4>Lista de Personal</h4>
                    <br>
                    <table id="tabla2" class="display espacio-arriba borde-gris" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">Cedula</th>
                                <th style="text-align:center">Apellidos Nombre</th>
                                <th style="text-align:center">Departamento</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($params);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $params[$i]['Cedula'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Apellido_Nombre'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Empresa'];?></td>
                                    <td style="text-align:center">
                                        <a class="btn" role="button" onclick="agregar_persona(<?php echo $params[$i]['ID_Persona'];?>,'<?php echo $params[$i]['Cedula'];?>',
                                        '<?php echo $params[$i]['Apellido_Nombre'];?>','<?php echo $params[$i]['Empresa'];?>',<?php echo $params[$i]['ID_Empresa'];?>);">
                                            Personal solicitud</a>
                                        <?php if(isset($params[$i]['Departamento'])){?>
                                            <a class="btn" role="button" onclick="agregar_persona_autoriza(<?php echo $params[$i]['ID_Persona'];?>,'<?php echo $params[$i]['Cedula'];?>',
                                            '<?php echo $params[$i]['Apellido_Nombre'];?>','<?php echo $params[$i]['Departamento'];?>',<?php echo $params[$i]['ID_Empresa'];?>,'<?php echo $params[$i]['ID_Unidad_Ejecutora'];?>');">
                                                Autoriza solicitud</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <!--Cierre Asignar Personal-->
        </div>
        
        <!--Lista de módulos programados -->
        <div id="ventana_oculta_3">
            <div id="popupventana">
                <div id="ventana">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <h4>Lista de módulos programados</h4>
                    <br>
                    <table id="tabla_modulos" border="1" cellspacing="0" width="100%">
                    </table>
                </div>
            </div>
            <!--Cierre Asignar Personal-->
        </div>
        
        <!--Lista de Puntos BCR-->
        <div id="ventana_oculta_4">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <h4>Lista de Puntos BCR</h4>
                    <br>
                    <table id="tabla4" class="display espacio-arriba borde-gris" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">ID</th>
                                <th style="text-align:center">Nombre</th>
                                <th style="text-align:center">Código</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($puntosbcr);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $puntosbcr[$i]['ID_PuntoBCR'];?></td>
                                    <td style="text-align:center"><?php echo $puntosbcr[$i]['Nombre'];?></td>
                                    <td style="text-align:center"><?php echo $puntosbcr[$i]['Codigo'];?></td>
                                    <td style="text-align:center">
                                        <a class="btn" role="button" onclick="agregar_punto(<?php echo $puntosbcr[$i]['ID_PuntoBCR'];?>, '<?php echo $puntosbcr[$i]['Nombre'];?>');">
                                            Seleccionar Punto BCR</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <!--Cierre Asignar PuntoBCR-->
        </div>
    </body>
</html>