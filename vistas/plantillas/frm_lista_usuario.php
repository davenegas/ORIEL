<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina Inicio</title>
         <meta charset="utf-8">
    <link href="../../../bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="vistas/js/jquery.min.js"></script>        
<script src="../../../bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
   
    </head>
    
    <body>
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>  
     </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <li class="active"><a href="index.php?ctl=inicio">Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">  
          
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
  </div>
  </div>
</nav>
        <h1>Inicio</h1>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cedula</th>
                    <th>Apellido Nombre</th>
                    <th>Observaciones</th>
                    <th>Turno</th>
                    <th>Horario</th>
                    <th>Estado</th>
                    <th>Mantenimiento</th>
                    
                </tr>
                
            </thead>
            <tbody>
                <?php
                $tam= count($vector);
                for($i=0;$i<$tam;$i++){
                ?>
                <tr>
                    <td><?php echo $vector[$i]['ID_Usuario'] ?></td> 
                    <td><?php echo $vector[$i]['Cedula'] ?></td>
                    <td><?php echo $vector[$i]['Apellido_Nombre']?></td>
                    <td><?php echo $vector[$i]['Observaciones']?></td>
                    <td><?php echo $vector[$i]['Turno'] ?></td>
                    <td><?php echo $vector[$i]['Horario'] ?></td>
                    <td><?php echo $vector[$i]['Estado'] ?></td>
                    <td><a href="index.php?ctl=obtiene_todos_los_usuarios&id=<?php echo $vector[$i]['ID_Usuario']?>
                           &Cedula=<?php echo $vector[$i]['Cedula']?>
                           &Apellido_Nombre=<?php echo $vector[$i]['Apellido_Nombre']?>
                           &Observaciones=<?php echo $vector[$i]['Observaciones']?>
                           &Turno=<?php echo $vector[$i]['Turno']?>
                           &horario=<?php echo $vector[$i]['Horario']?>
                           &Estado=<?php echo $vector[$i]['Estado']?>">Editar Usuario</a></td>
                </tr>  
                <?php } ?>
            </tbody>
        </table>
        <button><a href="index.php?ctl=obtiene_todos_los_usuarios&id=0&Estado=1" class="btn">Nuevo</a></button>
      </body>
</html>
