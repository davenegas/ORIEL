<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../../../bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="vistas/js/jquery.min.js"></script>        
        <script src="../../../bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <form class="form-horizontal" role="form" method="POST" name="form" action="index.php?ctl=guardar_usuarios">
            <h2>Editar usuario</h2>
            <hr>
            <input hidden="" id="ID_Usuario" name="ID_Usuario" type="text" value="<?php echo $vector[0]['ID_Usuario'];?>">
            
            <label for="cedula">ingrese el numero de celdula</label>                    
            <input type="text" class="form-control espacio-abajo" id=cedula name="Cedula" placeholder="Ingrese Cedula" value="<?php echo $vector[0]['Cedula'];?>">
            
            <label for="Apellido_Nombre">ingrese el Apellido y nombre</label>                    
            <input type="text" class="form-control espacio-abajo" id="apellido_nombre" name="apellido_nombre" placeholder="Ingrese Apellido y Nombre" value="<?php echo $vector[0]['Apellido_Nombre'];?>">
            
            <label for="Observaciones">Observaciones</label>                    
            <input type="text" class="form-control espacio-abajo" id="Observaciones" name="Observaciones" placeholder="Observaciones" value="<?php echo $vector[0]['Observaciones'];?>">
          
            
            
            
            
            
            <div>
                <label for="turno">Turno</label>
                   <select name="turno" id="turno" class="form-grup">                    <?php
                         $tam=count($vector_turno);
                         for($i=0;$i<$tam;$i++){
                             if($vector_turno[$i]['ID_Turno']==$vector[0]['ID_Turno']){           
                     ?>    
                       <option selected=""  value="<?php echo $vector_turno[$i]['ID_Turno']; ?>" ><?php echo $vector_turno[$i]['Turno']; ?></option>
                     <?php
                         }else{
                     ?> 
                      <option  value="<?php echo $vector_turno[$i]['ID_Turno']; ?>" ><?php echo $vector_turno[$i]['Turno']; ?></option>
                     <?php 
                         }}
                     ?>
                </select>
            </div>
           
            
            
            <div>
                <label for="Horario">Horario</label>                    
                <select name="Horario" id="Horario" class="form-grup">
                    <?php
                         $tam=count($vector_horario);
                         for($i=0;$i<$tam;$i++){
                             if($vector_horario[$i]['ID_Horario']==$vector[0]['ID_Horario']){ ?>    
                                <option  selected value="<?php echo $vector_horario[$i]['ID_Horario']; ?>" ><?php echo $vector_horario[$i]['Horario']; ?></option>
                        <?php } else {?>   
                                <option  value="<?php echo $vector_horario[$i]['ID_Horario']; ?>" ><?php echo $vector_horario[$i]['Horario']; ?></option>
                         <?php }}?>
                                
                </select>
            </div>
            
            <div class="form-grup">
            <label for="Estado">Estado</label>
                <?php 
                    if($_GET['Estado']=="0"){
                ?>      <select name="Estado" id="Estado" class="form-grup">
                            <option value="0">Invalido</option>
                            <option value="1">Valido</option>
                        </select>
                <?php  
                    }else {
                ?>
                        <select name="Estado" id="Estado" class="form-grup">
                            <option value="1">Valido</option>
                            <option value="0">Invalido</option>
                        </select>
                <?php
                            }
                ?>
            </div>
            
            <button type="submit">Guardar</button>
            </form>
           </div>
        
    </body>
</html>