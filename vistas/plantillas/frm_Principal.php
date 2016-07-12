<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Usuarios</title>
     <link href="../../../bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <script src="vistas/js/jquery.min.js"></script>    
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>-->      
  <script src="../../../bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container">
            <h2 align="center">Bienvenido(a):</h2>
        <h3 align="center"><?php echo $_SESSION['name']." ".$_SESSION['apellido'];?></h3>
        <div align="center">
            <!--<iframe src="http://bancobcr.com" width=1000 height=600 frameborder=1 scrolling=auto></iframe></div>-->
            
            </div>
     <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>