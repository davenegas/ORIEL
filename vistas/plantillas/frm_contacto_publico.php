<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Personal BCR</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php require_once 'frm_librerias_head.html';?>
    </head>
    
    <body>
        <br>
        <center><img src="vistas/Imagenes/Banner_Centro_de_Control.jpg" alt=""/></center>
        <br>
        <!--Menú completo de la ventana-->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href="#">Oriel</a>-->
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php?ctl=inicio"><b>Inicio</b></a></li>
                        <li><a href="index.php?ctl=personal_listar_publico">Personal</a></li>
                        <li><a href="index.php?ctl=puntobcr_listar_publico">Puntos BCR</a></li>
                        <li><a href="index.php?ctl=personal_externo_listar_publico">Padrones Fotográficos</a></li>
                        <li class="active"><a href="index.php?ctl=frm_contacto_publico">Contáctenos</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Ayuda
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="index.php?ctl=manual_personal_externo_publico">Manual Personal Externo</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php?ctl=iniciar_sesion"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--Cuerpo de la página HTML-->
        <div class="container-fluid text-left">
            <div class="row content">
                <!--DIV de navegación lado izquierdo de la ventana-->
                <!--    <div class="col-sm-1 sidenav">
                      <p><a href="#">Formulario Claves de Alarma</a></p>
                      <p><a href="#">Formulario Acceso Controlado</a></p>
                      <p><a href="#">Formulario de Video</a></p>
                </div>-->
                
                <!--DIV Central de la ventana-->
                <div class="col-sm-12 text-center">
                    <div>
                        <center><img src="vistas/Imagenes/contacto.jpg" width="600" /></center>
                    </div>
                </div>
                
                <!--DIV de navegación lado derecho de la ventana-->
                <!--    <div class="col-sm-2 sidenav">
                      <div class="well">
                          <p>Jefatura de Seguridad del Banco de Costa Rica<br>
                          </p>
                      </div>
                      <div class="well">
                        <p>ADS</p>
                      </div>
                </div>-->
          </div>
        </div>

        <!--Pie de página-->
        <footer class="container-fluid text-center">
          <hr/>
            Jefatura de Seguridad Banco de Costa Rica - Centro de Control y Monitoreo &copy; <br>
            <?php $hoy = date("F j, Y, g:i a"); 
                $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

                echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
                echo ", ".date("H:i", time()) . " hrs";?>
        </footer>

    </body>
</html>