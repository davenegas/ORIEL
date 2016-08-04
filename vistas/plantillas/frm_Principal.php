<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Usuarios</title>
        <?php require_once 'frm_librerias_head.html'; ?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container animated fadeIn">
            <h2 align="center">Bienvenido(a):</h2>
        <h3 align="center"><?php echo $_SESSION['name']." ".$_SESSION['apellido'];?></h3>
        <div align="center">
            <!--<iframe src="http://bancobcr.com" width=1000 height=600 frameborder=1 scrolling=auto></iframe></div>-->
            
            </div>
     <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>