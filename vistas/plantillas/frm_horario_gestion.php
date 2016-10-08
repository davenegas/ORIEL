<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Horario</title>
        <?php require_once 'frm_librerias_head.html'; ?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class="container">
        <h2>Gestión de Horario</h2>
        <p>Mediante esta pantalla, podrá agregar o editar horarios:</p>
        <div class="container">
            
        <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=horario_guardar&id=<?php echo $params[0]['ID_Horario'];?>">
            
<!--        <input hidden id="id_horario" name="id_horario" type="text" value="<?php echo $params[0]['ID_Horario']; ?>">-->
        <div class="form-group">
          <label for="dias_laborados">Días Laborados</label>
          <input type="text" required class="form-control" id="dias_laborados" name="dias_laborados" placeholder="Indique los días que trabaja la oficina" value="<?php echo $params[0]['Dia_Laboral'];?>">
        </div>
            
        <div class="form-group">
          <label for="horas_laboradas">Horas Laboradas</label>
          <input type="text" required class="form-control" id="horas_laboradas" name="horas_laboradas" placeholder="Indique las horas de apertura al publico" value="<?php echo $params[0]['Hora_Laboral'];?>">
        </div>
            
        <div class="form-group">
          <label for="observaciones">Observaciones</label>
          <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $params[0]['Observaciones'];?>">
        </div>
            
        <div class="form-group">
        <label for="sel1">Estado</label>
        <select class="form-control" id="estado" name="estado" >
            <?php if ($params[0]['Estado']==1){
            ?>
                <option value="1" selected="selected">Activo</option>
                <option value="0">Inactivo</option>  
            <?php
            }  else {
            ?>
               <option value="1">Activo</option>
               <option value="0" selected="selected">Inactivo</option>
            <?php
            }
            ?>  
        </select>
      </div>
        <button type="submit" class="btn btn-default">Guardar</button>
        <td><a href="index.php?ctl=horario_listar" class="btn btn-default" role="button">Cancelar</a></td>
      </form>     
    </div>
    </section>
    <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>