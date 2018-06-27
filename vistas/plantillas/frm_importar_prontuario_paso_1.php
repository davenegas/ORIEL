<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Importar Prontuario Paso 1 (Seleccionar Adjunto)</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script language="javascript" src="vistas/js/valida_un_solo_click_en_formulario.js"></script>  
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container animated fadeIn">
            <h1>Asistente para Importación de Prontuario al Sistema</h1>
            
            <h3>Seleccionar Archivo (Paso 1/10):</h3>
            <form class="form-horizontal" role="form" enctype="multipart/form-data" onSubmit="return enviado()" method="POST" action="index.php?ctl=frm_importar_prontuario_paso_2">
                <div class="col-xs-12 quitar-float espacio-abajo">
                    <!--<label for="archivo_adjunto">Adjuntar Archivo: </label>-->
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                    <input type="file" name="seleccionar_archivo" id="seleccionar_archivo" class="btn btn-default">
                </div>
               
                <button type="submit" class="btn btn-default">Enviar Información</button>
                <td><a href="index.php?ctl=principal" class="btn btn-default" role="button">Salir del Asistente</a></td> 
            </form>
        </div>
        
        <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>
