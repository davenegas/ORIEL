<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Principal Oriel</title>
        <?php require_once 'frm_librerias_head.html'; ?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container-fluid text-center">
            <div class="col-sm-2 sidenav">
 
            </div>
            <div class="col-sm-8 animated fadeIn">
                <h2 align="center">Bienvenido(a):</h2>
                <h3 align="center"><?php echo $_SESSION['name']." ".$_SESSION['apellido'];?></h3>
                <center>
                    <img src="vistas/Imagenes/Objetivo Z1.jpg" alt=""/>
                </center>
            </div>
        </div>
     <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        
    </body>
</html>