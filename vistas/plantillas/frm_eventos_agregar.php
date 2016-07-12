<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Bitácora Digital</title>
        <?php require_once 'frm_librerias_head.html'; ?>   
    </head>
    <body>
        <?php require_once 'encabezado.php'; ?>
        <div class="container">
        <h2>Bitácora del Centro de Control</h2>
        <!--<p>Mediante esta pantalla, podrá agregar o editar Roles de seguridad:</p>-->
        <div class="container">
        <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=guardar_evento&id=<?php echo trim($ide);?>">
            <div class="col-xs-4">
              <label for="fecha">Fecha</label>
              <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>">
            </div> 
            <div class="col-xs-4">
              <label for="hora">Hora</label>
              <input type="time" class="form-control" id="hora" name="hora" value=<?php echo date("H:i:s", time());?>>
            </div>
            <div class="col-xs-4">
              <label for="Evento">Tipo de Evento</label>
              <input type="text" class="form-control" id="<?php echo $params[0]['ID_Tipo_Evento'];?>" name="Evento" value="<?php echo $params[0]['Evento'];?>">
            </div>
            <div class="col-xs-4">
              <label for="Nombre_Provincia">Provincia</label>
              <input type="text" class="form-control" id="<?php echo $params[0]['ID_Provincia'];?>" name="Nombre_Provincia" value="<?php echo $params[0]['Nombre_Provincia'];?>">
            </div>
            <div class="col-xs-4">
              <label for="Tipo_Punto">Tipo Punto</label>
              <input type="text" class="form-control" id="<?php echo $params[0]['ID_Tipo_Punto'];?>" name="Tipo_Punto" value="<?php echo $params[0]['Tipo_Punto'];?>">
            </div>
            <div class="col-xs-4">
              <label for="Nombre">Punto BCR</label>
              <input type="text" class="form-control" id="<?php echo $params[0]['ID_PuntoBCR'];?>" name="Nombre" value="<?php echo $params[0]['Nombre'];?>">
            </div>
<!--            <div class="col-xs-4">
                <label for="Seguimiento">Estado del Evento</label>
                <select class="form-control" id="Seguimiento" name="Seguimiento" > 
                <?php
                $tam = count($roles);

                for($i=0; $i<$tam;$i++)
                {
                    if($roles[$i]['ID_Seguimiento']==$params[0]['ID_Seguimiento']){

                       ?> <option value="<?php echo $roles[$i]['ID_Seguimiento']?>" selected="selected"><?php echo $roles[$i]['Seguimiento']?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $roles[$i]['ID_Seguimiento']?>" ><?php echo $roles[$i]['Seguimiento']?></option>   
                <?php }}  ?>
                </select>
            </div>-->
            <div class="col-xs-4">
                    <label for="DetalleSeguimiento">Detalle del Evento</label>
                    <textarea type="text" required=”required” class="form-control" id="DetalleSeguimiento" name="DetalleSeguimiento" value=""></textarea>
            </div>
            </tbody>
                <button type="submit" class="btn btn-default" >Guardar</button>
            <td><a href="index.php?ctl=frm_eventos_listar" class="btn btn-default" role="button">Cancelar</a></td>
        </form> </br></br></br>
        </div>
   
      <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>