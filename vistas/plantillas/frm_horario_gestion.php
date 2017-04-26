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
            
                    <div class="col-md-4">
                        <label><h4>Día de la semana</h4></label>
                    </div>
                    <div class="col-md-4">
                        <label><h4>Hora Entrada</h4></label>
                    </div>
                    <div class="col-md-4">
                        <label><h4>Hora Salida</h4></label>
                    </div>
                    <div class="col-md-4">
                        <label>Domingo</label>
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="entrada_domingo" name="entrada_domingo" value="<?php echo $params[0]['Hora_Apertura_Domingo'];?>">
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="salida_domingo" name="salida_domingo" value="<?php echo $params[0]['Hora_Cierre_Domingo'];?>">
                    </div>
                    <div class="col-md-4">
                    <label>Lunes</label>
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="entrada_lunes" name="entrada_lunes" value="<?php echo $params[0]['Hora_Apertura_Lunes'];?>">
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="salida_lunes" name="salida_lunes" value="<?php echo $params[0]['Hora_Cierre_Lunes'];?>">
                    </div>
                    <div class="col-md-4">
                        <label>Martes</label>
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="entrada_martes" name="entrada_martes" value="<?php echo $params[0]['Hora_Apertura_Martes'];?>">
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="salida_martes" name="salida_martes" value="<?php echo $params[0]['Hora_Cierre_Martes'];?>">
                    </div>
                    <div class="col-md-4">
                        <label>Miercoles</label>
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="entrada_miercoles" name="entrada_miercoles" value="<?php echo $params[0]['Hora_Apertura_Miercoles'];?>">
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="salida_miercoles" name="salida_miercoles" value="<?php echo $params[0]['Hora_Cierre_Miercoles'];?>">
                    </div>    
                    <div class="col-md-4">
                        <label>Jueves</label>
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="entrada_jueves" name="entrada_jueves" value="<?php echo $params[0]['Hora_Apertura_Jueves'];?>">
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="salida_jueves" name="salida_jueves" value="<?php echo $params[0]['Hora_Cierre_Jueves'];?>">
                    </div>
                    <div class="col-md-4">
                        <label>Viernes</label>
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="entrada_viernes" name="entrada_viernes" value="<?php echo $params[0]['Hora_Apertura_Viernes'];?>">
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="salida_viernes" name="salida_viernes" value="<?php echo $params[0]['Hora_Cierre_Viernes'];?>">
                    </div>
                    <div class="col-md-4">
                        <label>Sábado</label>
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="entrada_sabado" name="entrada_sabado" value="<?php echo $params[0]['Hora_Apertura_Sabado'];?>">
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="salida_sabado" name="salida_sabado" value="<?php echo $params[0]['Hora_Cierre_Sabado'];?>">
                    </div>    
                    <div class="form-group">
                      <label for="observaciones">Observaciones</label>
                      <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $params[0]['Observaciones'];?>">
                    </div>
                    <div class="form-group">
                        <label for="sel1">Tipo de Horario</label>
                        <select class="form-control" id="tipo_horario" name="tipo_horario">
                            <?php if ($params[0]['Tipo_Horario']=="Público"){ ?>
                                <option value="Público" selected="selected">Horario público</option>
                                <option value="Oficina">Horario de oficina</option>  
                            <?php }  else { ?>
                                <option value="Público">Horario público</option>
                                <option value="Oficina" selected="selected">Horario de oficina</option>
                            <?php } ?>  
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sel1">Estado</label>
                        <select class="form-control" id="estado" name="estado">
                            <?php if ($params[0]['Estado']==1){ ?>
                                <option value="1" selected="selected">Activo</option>
                                <option value="0">Inactivo</option>  
                            <?php }  else { ?>
                                <option value="1">Activo</option>
                                <option value="0" selected="selected">Inactivo</option>
                            <?php } ?>  
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