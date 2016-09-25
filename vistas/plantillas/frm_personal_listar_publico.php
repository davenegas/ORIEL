<!DOCTYPE html>
<html lang="en">
<head>
  <title>Personal BCR</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once 'frm_librerias_head.html';?>
    <script>
        $(document).ready(function () {
        // Una vez se cargue al completo la página desaparecerá el div "cargando"
        $('#cargando').hide();
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
        <li class="active"><a href="index.php?ctl=personal_listar_publico">Personal</a></li>
        <li><a href="index.php?ctl=puntobcr_listar_publico">Puntos BCR</a></li>
        <!--<li><a href="#">Padrones Fotograficos</a></li>-->
        <li><a href="#">Contáctenos</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?ctl=iniciar_sesion"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-1 sidenav">
<!--      <p><a href="#">Bancobcr.com</a></p>
      <p><a href="#">Somos BCR</a></p>-->
      <!--<p><a href="#">Link</a></p>-->
    </div>
      
    <div class="col-sm-9 text-left">
        <div id="cargando">
            <center><img align="center" src="vistas/Imagenes/Espere.gif"/></center>
        </div>
        <h2>Listado General de Personal</h2>  
        <table id="tabla" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="text-align:center">Cedula</th>
              <th style="text-align:center">Apellido y Nombre</th>
              <th style="text-align:center">Departamento</th>
              <th style="text-align:center">Telefonos</th>
              <th style="text-align:center">Correo</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tam=count($personas);
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <td style="text-align:center"><?php echo $personas[$i]['Cedula'];?></td>
                <td style="text-align:center"><?php echo $personas[$i]['Apellido_Nombre'];?></td>
                <td style="text-align:center"><?php echo $personas[$i]['Departamento'];?></td>
                <td style="text-align:center"><?php echo $personas[$i]['Numero'];?></td>
                <td style="text-align:center"><?php echo $personas[$i]['Correo'];?></td>
            </tr>     
                    
            <?php }
            ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>Información del Personal BCR</p>
      </div>
<!--      <div class="well">
        <p>ADS</p>
      </div>-->
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <hr/>
    Jefatura de Seguridad Banco de Costa Rica - Centro de Control y Monitoreo &copy; <br>
    <?php $hoy = date("F j, Y, g:i a"); 
               //echo  $hoy; 
    ?>
    <?php
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
        echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        echo ", ".date("H:i", time()) . " hrs";
 
?>
</footer>

</body>
</html>