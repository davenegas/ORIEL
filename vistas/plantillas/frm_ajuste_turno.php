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
            <form class="form-horizontal" role="form" method="POST" name="form" action="index.php?ctl=guardar_turno">
                <h2>Editar Turno</h2>
                <hr>
                <input hidden="" id="ID_Turno" name="ID_Turno" type="text" value="<?php echo $vector[0]['ID_Turno'];?>">

                <label for="nombre">ingrese el turno</label>
                <input class="form-control espacio-abajo" required id="nombre" name="nombre" placeholder="Digite el Turno" type="text" value="<?php echo $vector[0]['nombre'];?>">

                <label for="observaciones">Observaciones</label>
                <input type="text" class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones del proveedor" value="<?php echo $vector[0]['Observaciones'];?>">

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
<!--                       <select id="estado" class="form-control">
                           <option value="1">Valido</option>
                           <option value="0">Invalido</option>
                       </select>-->
                </div>
               <button type="submit">Guardar</button>
            </form>
        </div>
    </body>
</html>