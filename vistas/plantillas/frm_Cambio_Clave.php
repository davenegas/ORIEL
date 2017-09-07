
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Cambio de Contraseña</title>
        <link href="../../../bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="vistas/js/jquery.min.js"></script>    
        <script src="../../../bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <center><img src="vistas/Imagenes/Banner_Centro_de_Control.jpg" alt=""/></center>
        <hr/>   
        <div class="alert alert-info" align="center">
            <strong>Gestión de Usuarios!  </strong>Cambio de Contraseña
        </div>
        <table style="margin: 0 auto;">
            <tr><h3 class="text-primary" align="center">Cambio de Clave</h3></tr>
        </table>
        <div>
            <form action="index.php?ctl=cambia_clave_usuario_post" method="POST">
                <table style="margin: 0 auto;">
                    <tr>
                        <td><h4>Nombre de Usuario:</h4></td>
                        <?php if ($usuario !=""){ ?>
                            <td><input type="text" name="usu" class="form-control" readonly="readonly" value="<?php echo $usuario?>"><br></td>
                        <?php } else { ?>    
                            <td><input type="text" name="usu" class="form-control"><br></td>
                        <?php }?>
                    </tr>
                    <tr>
                        <td><h4>Contraseña Actual:</h4></td>
                        <?php if ($clave !=""){ ?>
                            <td><input type="password" name="password_antiguo" class="form-control" readonly="readonly" value="<?php echo $clave?>"><br></td>
                        <?php }else{ ?>    
                            <td><input type="password" name="password_antiguo" class="form-control"><br></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><h4>Nueva Contraseña:</h4></td>
                        <td><input type="password" name="password_nuevo" class="form-control"><br></td>
                    </tr>
                    <tr>
                        <td><h4>Confirmación:</h4></td>
                        <td><input type="password" name="confirmacion_password" class="form-control"><br></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Aceptar" class="btn btn-primary" align="right"></td>
                        <td><a href="index.php?ctl=inicio" class="btn btn-primary" role="button">Salir</a></td>
                    </tr>     
                </table>
            </form>       
        </div>
        <br>
        <div class="<?php echo $tipo_de_alerta;?>" align="center">
            <strong>Información!</strong>  <?php echo $validacion;?>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>