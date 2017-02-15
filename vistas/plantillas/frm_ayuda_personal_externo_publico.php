<!DOCTYPE html>
<html lang="en">
<head>
    <title>Principal ORIEL</title>
    <!--<meta http-equiv="refresh" content="2">-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once 'frm_librerias_head.html';?>
     <script>
     $(document).ready(function(){
        //alert('prueba');
        $.post("index.php?ctl=cuenta_visitas_a_la_pagina");      

      });
    </script>
</head>
<body>
<br>
    <center><img src="vistas/Imagenes/Banner_Centro_de_Control.jpg" alt=""/></center>
    <br>  
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
                <li><a href="index.php?ctl=frm_contacto_publico">Contáctenos</a></li>
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
  
    <div class="container-fluid text-left">
        <div class="row content">
            <div class="col-sm-12 text-center">
               <!--<embed src="vistas/Manuales/ORIEL_MANUAL_USUARIO_PERSONAL_EXTERNO_VP.pdf#toolbar=0" width="900" height="450">-->
               <embed src="vistas/Manuales/ORIEL_MANUAL_USUARIO_PERSONAL_EXTERNO_VP.pdf" width="1000" height="600">
            </div>
        </div>
    </div>

    <footer class="container-fluid text-center">
      <hr/>
        Jefatura de Seguridad Banco de Costa Rica - Centro de Control y Monitoreo &copy; <br>
        <?php $hoy = date("F j, Y, g:i a"); 
                   //echo  $hoy; 

            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
            echo ", ".date("H:i", time()) . " hrs";
    ?>
    </footer>

</body>
</html>