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
        <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=guardar_evento&id=<?php echo trim($ide);?>">
            <div class="col-xs-4">
              <label for="fecha">Fecha</label>
              <input type="date" required=”required” class="form-control" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>">
            </div> 
            <div class="col-xs-4">
              <label for="hora">Hora</label>
              <input type="time" required=”required” class="form-control" id="hora" name="hora" value="<?php echo date("H:i", time());?>">
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
                        if($lista_provincias[$i]['ID_Provincia']==$cantones[$distritos[$params[0]['ID_Distrito']]['ID_Canton']]['ID_Provincia']){
                            ?> <option value="<?php echo $lista_provincias[$i]['ID_Provincia']?>" selected="selected"><?php echo $lista_provincias[$i]['Nombre_Provincia']?></option><?php
                        }
                        else {?>
                            <option value="<?php echo $lista_provincias[$i]['ID_Provincia']?>" ><?php echo $lista_provincias[$i]['Nombre_Provincia']?></option>  
                        <?php
                    } } ?>  
                </select>
            </div>
            <div class="col-xs-4">
              <label for="tipo_punto">Tipo Punto</label>
              <select class="form-control" required=”required” id="tipo_punto" name="tipo_punto" > 
                <?php
                    $tam_tipo_punto_bcr = count($lista_tipos_de_puntos_bcr);

                    for($i=0; $i<$tam_tipo_punto_bcr;$i++){
                        if($lista_tipos_de_puntos_bcr[$i]['ID_Tipo_Punto']==$params[0]['ID_Tipo_Punto']){
                           ?> 
                            <option value="<?php echo $lista_tipos_de_puntos_bcr[$i]['ID_Tipo_Punto']?>" selected="selected"><?php echo $lista_tipos_de_puntos_bcr[$i]['Tipo_Punto']?></option>
                    <?php }else {?>
                            <option value="<?php echo $lista_tipos_de_puntos_bcr[$i]['ID_Tipo_Punto']?>"><?php echo $lista_tipos_de_puntos_bcr[$i]['Tipo_Punto']?></option> 
                        <?php
                    }} ?>  
              </select>
            </div>
           
            <div class="col-xs-4">
              <label for="punto_bcr">Punto BCR</label>
              <select class="form-control" required=”required” id="punto_bcr" name="punto_bcr" >
                  <?php  if($params[0]['ID_PuntoBCR']!=0){?>
                    <option value="<?php echo $params[0]['ID_PuntoBCR']?>"><?php echo $params[0]['Nombre']?></option>
                  <?php } ?>
                    
                    <?php 
                    if($ide==0){
                        $tam_puntos_bcr=count($lista_puntos_bcr_oficinas_sj);
                        for($i=0; $i<$tam_puntos_bcr;$i++){
                            if ($i==0){?>
                                <option value="<?php echo $lista_puntos_bcr_oficinas_sj[$i]['ID_PuntoBCR']?>" selected="selected"><?php echo $lista_puntos_bcr_oficinas_sj[$i]['Nombre']?></option>                           
                            <?php }else{?>
                                <option value="<?php echo $lista_puntos_bcr_oficinas_sj[$i]['ID_PuntoBCR']?>"><?php echo $lista_puntos_bcr_oficinas_sj[$i]['Nombre']?></option>                           
                            <?php }} ?>  
                    <?php } ?>
                    
              </select>
            </div>
            <br/><br/><br/><br/>
            
            <div class="col-xs-6">
                    <label for="seguimiento">Detalle del Evento</label>
                    <textarea type="text" class="form-control" id="seguimiento" name="seguimiento" value="" maxlength="500" placeholder="Máximo 500 caracteres por seguimiento"></textarea>
            </div>
           <div class="col-xs-6">
              <label for="estado_evento">Estado Evento</label>
              <select class="form-control" required=”required” id="estado_evento" name="estado_evento" ></select>
            </div>
            <br/><br/><br/>
             <br/><br/>
            <div>
            <button type="submit" class="btn btn-default" >Guardar</button>
            <a href="index.php?ctl=frm_eventos_listar" class="btn btn-default" role="button">Cancelar</a>
            </div>
        </form> 
        <h2>Histórico de Eventos Relacionados a este Punto BCR:</h2>
        <table id='tabla' class='display'>
        <?php if ($ide!=0){ ?>
             <thead>
               
            <tr>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Lapso</th>
              <th>Provincia</th>
              <th>Tipo Punto</th>
              <th>Punto BCR</th>
              <th>Tipo de Evento</th>
              <th>Estado del Evento</th>
              <th>Ingresado Por</th>
              <th>Consulta</th>
            </tr>
          </thead>
          <tbody>
        
            <?php 

            $tam=count($eventos_relacionados);

            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
            <?php
            $fecha_evento = date_create($eventos_relacionados[$i]['Fecha']);
            $fecha_actual = date_create(date("d-m-Y"));
            $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            ?>
            <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
            <td><?php echo $eventos_relacionados[$i]['Hora'];?></td>
            <td align="center"><?php echo $dias_abierto->format('%a');?></td>
            <td><?php echo $eventos_relacionados[$i]['Nombre_Provincia'];?></td>
            <td><?php echo $eventos_relacionados[$i]['Tipo_Punto'];?></td>
            <td><?php echo $eventos_relacionados[$i]['Nombre'];?></td>
            <td><?php echo $eventos_relacionados[$i]['Evento'];?></td>
            <td><?php echo $eventos_relacionados[$i]['Estado_Evento'];?></td>
            <td><?php echo $eventos_relacionados[$i]['Nombre_Usuario']." ".$eventos_relacionados[$i]['Apellido'] ?></td>
            <td align="center"><a href="index.php?ctl=frm_eventos_editar&accion=consulta_relacionados&id=
               <?php echo $eventos_relacionados[$i]['ID_Evento']?>">Ver detalle</a></td>
            </tr>
            <?php }
            ?>
            </tbody>
            <?php }  ?>
        </table>
        </div>
        
      <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>