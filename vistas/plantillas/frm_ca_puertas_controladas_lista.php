<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Puertas Controladas</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script language="javascript" src="vistas/js/valida_un_solo_click_en_formulario.js"></script>  
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container animated fadeIn">
            <h1>Control de Acceso: Puertas Controladas</h1>
            <!--Seleccionar archivo para actualizar controladore automaticamente-->
            <div class="espacio-abajo-10 well">
                <h3>Seleccionar Archivo para actualizar Puertas:</h3>
                <form class="form-horizontal" role="form" enctype="multipart/form-data" onSubmit="return enviado()" method="POST" action="index.php?ctl=">
                    <div class="col-xs-12 quitar-float espacio-abajo-5">
                        <!--<label for="archivo_adjunto">Adjuntar Archivo: </label>-->
                        <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                        <input type="file" name="seleccionar_archivo" id="seleccionar_archivo" class="btn btn-default">
                    </div>  
                    <div class="col-xs-12 quitar-float">
                        <button type="submit" class="btn btn-default">Enviar Información</button>
                    </div>
                </form>
            </div>
            
            <!--Lista de Controladores ingresados al sistema-->
            <div class="well">
                <h3>Lista de Puertas controladas actuales</h3>
                <table id="tabla" class="display">
                    <thead>
                        <tr>
                            <th style="text-align:center">Owner</th>
                            <th style="text-align:center">Name</th>
                            <th style="text-align:center">State</th>
                            <th style="text-align:center">DoorSwitch</th>
                            <th style="text-align:center">Value</th>
                            <th style="text-align:center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <a href="index.php?ctl=principal" class="btn btn-default espacio-abajo" role="button">Salir</a> 
        </div>
        
        <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>