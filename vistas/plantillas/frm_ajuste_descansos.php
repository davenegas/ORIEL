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
        
            <form class="form_horizontal" role="form" method="POST" name="form" action="index.php?ctl=guardar_descansos">
                    
               <h2>Editar descansos</h2>
               <hr>
               <input hidden="" id="ID_Ajus_Descanso" name="ID_Ajus_Descanso" type="text" Value="<?php echo $vector[0]['ID_Ajus_Descanso'];?>">
               <label for="nombre">Duracion de descansos</label>
               <input class="form-control espacio-abajo"  id="Duracion_Descanso" name="Duracion" placeholder="Duracion de descanso" type="text" value="<?php echo $vector[0]['Duracion'];?>">
                    
               <label for="nombre">Observaciones</label>
               <input class="form-control espacio-abajo"  id="Observaciones" name="Observaciones" placeholder="Observaciones" type="text" value="<?php echo $vector[0]['Observaciones'];?>">
               <div class="form-grup">
               <label for="Estado">Estado</label>
                    <?php 
                        if($_GET['estado']=="0"){
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