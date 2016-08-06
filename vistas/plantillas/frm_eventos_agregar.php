<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Bitácora Digital</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_bitacora.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>  
    </head>
    
    <body>
        <?php require_once 'encabezado.php'; ?>
        <div class="container animated fadeIn">
        <h2>Agregar Evento para Bitácora</h2>
        <!--<p>Mediante esta pantalla, podrá agregar o editar Roles de seguridad:</p>-->
        <hr/> 
        
        <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=guardar_evento">
            <div class="col-xs-4">
              <label for="fecha">Fecha</label>
              <input type="date" required=”required” class="form-control" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>">
            </div> 
            <div class="col-xs-4">
              <label for="hora">Hora</label>
              <input type="time" required=”required” class="form-control" id="hora" name="hora" value=<?php echo date("H:i", time());?>>
            </div>         
            <div class="col-xs-4">
                <label for="tipo_evento">Tipo de Evento</label>
                <select class="form-control" required=”required” id="tipo_evento" name="tipo_evento" > 
                <?php
                    $tam_tipo_eventos = count($lista_tipos_de_eventos);

                    for($i=0; $i<$tam_tipo_eventos;$i++)
                    {                      
                           ?> 
                    <option value="<?php echo $lista_tipos_de_eventos[$i]['ID_Tipo_Evento']?>"><?php echo $lista_tipos_de_eventos[$i]['Evento']?></option>
                    <?php

                    } ?>  
                </select>
            </div>
            <br/><br/><br/><br/>
            <div class="col-xs-4">
              <label for="nombre_provincia">Provincia</label>
              <select class="form-control" required=”required” id="nombre_provincia" name="nombre_provincia" > 
                <?php
                    $tam_provincias = count($lista_provincias);

                    for($i=0; $i<$tam_provincias;$i++)
                    {                      
                           ?> 
                    <option value="<?php echo $lista_provincias[$i]['ID_Provincia']?>"><?php echo $lista_provincias[$i]['Nombre_Provincia']?></option>
                    <?php

                    } ?>  
                </select>
            </div>
            <div class="col-xs-4">
              <label for="tipo_punto">Tipo Punto</label>
              <select class="form-control" required=”required” id="tipo_punto" name="tipo_punto" > 
                <?php
                    $tam_tipo_punto_bcr = count($lista_tipos_de_puntos_bcr);

                    for($i=0; $i<$tam_tipo_punto_bcr;$i++)
                    {                      
                           ?> 
                    <option value="<?php echo $lista_tipos_de_puntos_bcr[$i]['ID_Tipo_Punto']?>"><?php echo $lista_tipos_de_puntos_bcr[$i]['Tipo_Punto']?></option>
                    <?php

                    } ?>  
              </select>
            </div>
           
            <div class="col-xs-4">
              <label for="punto_bcr">Punto BCR</label>
              <select class="form-control" required=”required” id="punto_bcr" name="punto_bcr" ></select>
            </div>
            <br/><br/><br/><br/>
               <div class="col-xs-4">
                    <label for="estado_evento">Estado del Evento</label>
                    <select class="form-control" required=”required” id="estado_evento" name="estado_evento" > 
                    <?php
                    $tam = count($estadoEventos);

                    for($i=0; $i<$tam;$i++)
                    {
                        if($estadoEventos[$i]['Estado_Evento']==$params[0]['Estado_Evento']){

                           ?> <option value="<?php echo $estadoEventos[$i]['ID_EstadoEvento']?>" selected="selected"><?php echo $estadoEventos[$i]['Estado_Evento']?></option><?php
                        }
                        else {?>
                            <option value="<?php echo $estadoEventos[$i]['ID_EstadoEvento']?>" ><?php echo $estadoEventos[$i]['Estado_Evento']?></option>   
                    <?php }}  ?>
                    </select>
             </div>
             <br/><br/><br/><br/>
            <div class="form-group">
                    <label for="seguimiento">Detalle del Evento</label>
                    <textarea type="text" class="form-control" id="seguimiento" name="seguimiento" value=""></textarea>
            </div>
           
            <div>
            <button type="submit" class="btn btn-default" >Guardar</button>
            <a href="index.php?ctl=frm_eventos_listar" class="btn btn-default" role="button">Cancelar</a>
            </div>
        </form> 
        </div>
   
      <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>