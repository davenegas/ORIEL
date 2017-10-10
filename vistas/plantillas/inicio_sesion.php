<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Inicio de Sesión</title>
        <link rel="shortcut icon" href="vistas/Imagenes/Oriel.ico">
        <link href="../../../bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="vistas/js/jquery.min.js"></script>   
        <script src="../../../bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <center><img src="vistas/Imagenes/Banner_Centro_de_Control.jpg" alt=""/></center>
        <hr/>
        <?php if(!isset($_SERVER['HTTPS'])){
            //header("Location:https://bcr0209ori01/Oriel/index.php?ctl=iniciar_sesion");
        }?>
        <table style="margin: 0 auto;">
            <tr><h3 class="text-primary" align="center">Inicio de Sesión</h3></tr>
        </table>
        <div>
            <form action="index.php?ctl=listar" method="POST">
                <table style="margin: 0 auto;">
                    <tr>
                        <td><h4>Nombre de Usuario:</h4></td>
                        <td><input type="text" name="nombre" id="nombre" class="form-control"><br></td>
                    </tr>
                    <tr>
                        <td><h4>Contraseña:</h4></td>
                        <td><input type="password" name="password" id="password" class="form-control"><br></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Validar" class="btn btn-primary"></td>
                        <td><a href="index.php?ctl=cambiar_password">|Cambio de Clave|</a>
                            <a href="#" 
                            title="Digite su número de identificación en Nombre de Usuario y oprima este link para recordar la clave" 
                            onclick="this.href='index.php?ctl=recordar_password&nom='+document.getElementById('nombre').value;
                            somefunction(this, event); return true;">
                            |Recordar Clave|
                        </a></td>     
                    </tr>
                </table>
            </form>
        </div>
        <br>
        
        <div class="<?php echo $tipo_de_alerta;?>" align="center">
            <strong>Información!</strong>  <?php echo $validacion;?>
        </div>
        
        <div>
            <table style="margin: 0 auto;">
                <tr>
                    <td> 
                        <div class="btn-group">
                            <a href="index.php?ctl=inicio" class="btn" role="button">Volver Menú Principal</a> 
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        
        <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>