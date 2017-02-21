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
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <form class="form-horizontal" role="form" method="POST" name="form" action="index.php?ctl=guarda_usuariop">
            <h2>Agregar Asistencia de Operador</h2>
            <hr>
            <input hidden="" id="ID_Usuario" name="ID_Usuario" type="text" value="<?php echo $vector[0]['ID_Usuario'];?>">
            
            <label for="Cedula">Ingrese el Numero de Cedula</label>                    
            <input type="text" class="form-control espacio-abajo" id=Cedula name="Cedula" placeholder="Ingrese Cedula" value="<?php echo $vector[0]['Cedula'];?>">
            
            <label for="Nombre">Ingrese el Nombre</label>                    
            <input type="text" class="form-control espacio-abajo" id="Nombre" name="Nombre" placeholder="Ingrese el Nombre" value="<?php echo $vector[0]['Nombre'];?>">
            
            <label for="Apellido">Ingrese el Apellido</label>                    
            <input type="text" class="form-control espacio-abajo" id="Apellido" name="Apellido" placeholder="Ingrese el Apellido" value="<?php echo $vector[0]['Apellido'];?>">
            
            <label for="Observaciones">Observaciones</label>                    
            <input type="text" class="form-control espacio-abajo" id="Observaciones" name="Observaciones" placeholder="Observaciones" value="<?php echo $vector[0]['Observaciones'];?>">
            <br>
            <div>
                <label for="Turno">Turno</label>
                   <select name="Turno" id="Turno" class="form-grup">                  
                    <?php
                         $tam=count($vector_turno);
                         for($i=0;$i<$tam;$i++){
                             if($vector_turno[$i]['ID_Turno']==$vector[0]['ID_Turno']){ ?>    
                       <option selected value="<?php echo $vector_turno[$i]['ID_Turno']; ?>" ><?php echo $vector_turno[$i]['Turno']; ?></option>
                     <?php  }else{?> 
                      <option  value="<?php echo $vector_turno[$i]['ID_Turno']; ?>" ><?php echo $vector_turno[$i]['Turno']; ?></option>
                     <?php }}?>
                </select>
            </div>
            <br>
            <div>
                <label for="Horario">Horario</label>                    
                <select name="Horario" id="Horario" class="form-grup">
                    <?php
                         $tam=count($vector_horario);
                         for($i=0;$i<$tam;$i++){
                             if($vector_horario[$i]['ID_Horariop']==$vector[0]['ID_Horariop']){ ?>    
                       <option  selected value="<?php echo $vector_horario[$i]['ID_Horariop']; ?>" ><?php echo $vector_horario[$i]['Horario']; ?></option>
                     <?php } else {?>   
                      <option  value="<?php echo $vector_horario[$i]['ID_Horariop']; ?>" ><?php echo $vector_horario[$i]['Horario']; ?></option>
                     <?php }}?>              
                </select>
            </div>
            <br>
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
            <br>
            <button type="submit">Guardar</button>
            </form>
           </div>
         <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>