<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina Inicio</title>
        <meta charset="utf-8">
        <link href="../../../bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="Vista/js/jquery-2.1.1.min.js"></script>        
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
                        <li class="active"><a href="index.php?ctl=inicio">Inicio</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">  
                        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <h1>Reporte</h1>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID_Usuario</th>
                    <th> Apellido y nombre  </th>  
                    <th> Fecha  </th>
                    <th> Hora de entrada  </th> 
                    <th> Justificar entrada </th>       
                    <th> Hora de salida </th>
                    <th> Justificar salida </th>  
                    <th> salida al descanso </th>
                    <th> entrada del decanso </th>
                    <th> Justificar descanso </th>
                    <th> Total </th>
                    <th> Duracion </th>               
                </tr>
            </thead>
            <tbody>
                <?php
                $tam_usuario= count($usuarios); 
                for($i=0;$i<$tam_usuario;$i++) { ?>
                    <tr> 
                        <td><?php echo $usuarios[$i]['ID_Usuario'] ?></td> 
                        <td><?php echo $usuarios[$i]['Apellido_Nombre'] ?></td>
                        <?php $tam_marcas=count($marcas);
                        for($i_marcas=0;$i_marcas<$tam_marcas;$i_marcas++){ ?>
                            <td><?php echo $marcas[$i]['Fecha'] ?></td>
                            <td><?php echo $marcas[$i]['Hora_Entrada_Turno'] ?></td>
                            <td><?php echo $marcas[$i]['Justificar_Entrada'] ?></td>
                            <td><?php echo $marcas[$i]['Hora_Salida_Turno']?></td>
                            <td><?php echo $marcas[$i]['Justificar_Salida']?></td>
                        <?php } ?>
                        <?php $tam_marcas_descanso=count($marcas_descanso); 
                        for($i_marcas_descanso=0;$i_marcas_descanso<$tam_marcas_descanso;$i_marcas_descanso++){ ?>
                            <td><?php echo $marcas_descanso[$i]['Hora_Descanso_Salida'] ?></td>
                            <td><?php echo $marcas_descanso[$i]['Hora_Descanso_Entrada'] ?></td>
                            <td><?php echo $marcas_descanso[$i]['Justificar_Descanso'] ?></td>
                            <td><?php echo $marcas_descanso[$i]['Total_Descanso'] ?></td> 
                            <td><?php echo $marcas_descanso[$i]['Duracion_Descanso'] ?></td> 
                        <?php } ?>
                    </tr>     
                <?php } ?>
            </tbody>
        </table>
      </body>
</html>
