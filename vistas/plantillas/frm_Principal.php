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

                <!-- <h4 align="center" style="min-width: 800px; height: 70px; max-width: 300px; margin: 0 auto; margin-top: 30px;">
                    Objetivo del Centro de Control: Detectar, prevenir y atender situaciones que incrementen riesgos para el BCR, sus funcionarios y clientes, coordinando prontamente con los departamentos internos y externos necesarios para controlar el evento.
                </h4>-->
                <!--<iframe src="http://bancobcr.com" width=1000 height=600 frameborder=1 scrolling=auto></iframe></div>-->

            </div>
            <div class="col-sm-2 sidenav">
                <?php if(isset($cant_inconsistencias)){
                    if($cant_inconsistencias>0){?>
                        <br><br><br><br>
                        <h4>Cantidad de inconsistencias de marcas sin justificar</h4>
                        <h1><a href="index.php?ctl=asistencia_lista_marcas"><?php echo $cant_inconsistencias?></a></h1>
                    <?php } 
                }?>
            </div>
        </div>
     <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        
    </body>
</html>