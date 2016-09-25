<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Importar Prontuario 9 (Personas)</title>
        <?php require_once 'frm_librerias_head.html'; ?> 
        <script>
          $(document).ready(function () {
            // Una vez se cargue al completo la página desaparecerá el div "cargando"
            $('#cargando').hide();
          });
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div id="cargando">
            <center><img align="center" src="vistas/Imagenes/Espere.gif"/></center>
        </div>
        <div class="container animated fadeIn">
        <h2>Importación del Personal(9/10):</h2>
        <h3>Detalle de actualización:</h3>
       
        <ul class="list-group">
        <li class="list-group-item list-group-item-success"><?php echo $resultados;?></li> 
        </ul> 
        <a href="index.php?ctl=frm_importar_prontuario_paso_10" class="btn btn-default espacio-abajo" role="button">Confirmación Final</a>
        <a href="index.php?ctl=principal" class="btn btn-default espacio-abajo" role="button">Salir del Asistente</a> 
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>