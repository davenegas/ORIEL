<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Accesos programados</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script language="javascript" src="vistas/js/valida_un_solo_click_en_formulario.js"></script>  
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn">
            <h1>Programaciones: Acceso-Alarma-CCTV</h1>
            <!--Seleccionar archivo para actualizar controladore automaticamente-->
            <div class="espacio-abajo-10 well">
                <!--<h3>Seleccionar Archivo para actualizar controladores:</h3>-->
                <form class="form-horizontal" role="form" enctype="multipart/form-data" onSubmit="return enviado()" method="POST" action="index.php?ctl=">
                    <div class="row">
                        <div class="col-md-4 espacio-abajo">
                            <label for="fecha">Fecha</label>
                            <input type="date" required="required" class="form-control" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>">
                        </div>
                        <div class="col-md-4 espacio-abajo">
                            <label for="hora">Hora</label>
                            <input type="time" required="required" class="form-control" id="hora" name="hora" value="<?php echo date("H:i", time());?>">
                        </div>
                        <div class="col-md-4 espacio-abajo">
                            <label for="usuario">Usuario</label>
                            <input type="text" hidden id="ID_Usuario" name="ID_Usuario" value="<?php echo $_SESSION['id'];?>">
                            <input type="text" required="required" class="form-control" id="usuario" name="usuario" value="<?php echo $_SESSION['name'].' '.$_SESSION['apellido'];?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 espacio-abajo">
                            <label for="solicitante">Funcionario que solicita</label>
                            <input type="text" required="required" class="form-control" id="solicitante" name="solicitante">
                        </div>
                        <div class="col-md-4 espacio-abajo">
                            <label for="autoriza">Funcionario que autoriza</label>
                            <input type="text" required="required" class="form-control" id="autoriza" name="autoriza">
                        </div>
                        <div class="col-md-4 espacio-abajo">
                            <label for="unidad_ejecutora">Unidad Ejecutora del solicitante</label>
                            <input type="text" required="required" class="form-control" id="unidad_ejecutora" name="unidad_ejecutora">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 espacio-abajo">
                            <label for="tipo_solicitud">Tipo de Solicitud</label>
                            <select class="form-control" id="confirmacion" name="confirmacion" > 
                                <option value="Activar gafete">Activar gafete</option>
                                <option value="Desactivar gafete">Desactivar gafete</option>
                                <option value="Agregar areas">Agregar áreas</option>
                                <option value="Eliminar areas">Eliminar áreas</option>
                                <option value="Ampliar fecha">Ampliar fecha</option>
                                <option value="Reporte">Reporte</option>
                                <option value="Horario especial">Horario especial</option>
                                <option value="Modificar horario">Modificar horario</option>
                                <option value="Modificar Continuum">Modificar Continuum</option>
                                <option value="">Activar carnet</option>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo">
                            <label for="gafete">Número de gafete</label>
                            <input type="text" required="required" class="form-control" id="gafete" name="gafete">
                        </div>
                        <div class="col-md-4 espacio-abajo">
                            <label for="fecha_vencimiento">Fecha de vencimiento de la solicitud</label>
                            <input type="date" required class="form-control" id="fecha_vencimiento" name="fecha_vencimiento"  value="<?php echo date("Y-m-d");?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 espacio-abajo">
                            <label for="detalle">Detalle</label>
                            <input type="text" required="required" class="form-control" id="detalle" name="detalle">
                        </div>
                        <div class="col-md-4 espacio-abajo">
                            <label for="confirmacion">Confirmación</label>
                            <select class="form-control" id="confirmacion" name="confirmacion" > 
                                <option value="Pendiente">Pendiente</option>
                                <option value="Confirmado">Confirmado</option>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo">
                            <label for="archivo_adjunto">Adjuntar Archivo</label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                            <input type="file" name="archivo_adjunto" id="seleccionar_archivo" class="btn btn-default">
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-4 espacio-abajo">
                            <label for="detalle">Seleccionar areas asignadas/eliminadas</label>
                            <input type="text" required="required" class="form-control" id="detalle" name="detalle">
                        </div>
                    </div>
                    <button class="btn btn-default"><a href="javascript:%20validar_enlace()" id="submit">Guardar</a></button>
                    <a href="index.php?ctl=principal" class="btn btn-default" role="button">Salir</a> 
                </form>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>