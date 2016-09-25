<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Areas de Apoyo</title>
        <?php require_once 'frm_librerias_head.html'; ?>

    </head>
    <body>
        <?php require_once 'encabezado.php'; ?>
        <div class="container">
        <h2>Gestión de Areas de Apoyo del Sistema</h2>
        <p>Mediante esta pantalla, podrá agregar o editar Areas de Apoyo del sistema:</p>
        <div class="container">
        <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=guardar_usuario&id=<?php echo trim($ide);?>">
            <div class="col-md-6 espacio-abajo">
              <label for="Nombre">Nombre Area</label>
              <input type="text" required="required" class="form-control" id="Nombre" name="Nombre" value="<?php echo $params[0]['Nombre_Area'];?>">
            </div>
            
            <div class="col-md-6 espacio-abajo">
                <label for="tipo_area">Tipo de Area</label>
                <select class="form-control" id="tipo_area" name="tipo_area" > 
                <?php
                $tam = count($tipo_area);

                for($i=0; $i<$tam;$i++)
                {
                    if($tipo_area[$i]['ID_Tipo_Area_Apoyo']==$params[0]['ID_Tipo_Area_Apoyo']){
                        
                       ?> <option value="<?php echo $tipo_area[$i]['ID_Tipo_Area_Apoyo']?>" selected="selected"><?php echo $tipo_area[$i]['Nombre_Tipo_Area']?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $tipo_area[$i]['ID_Tipo_Area_Apoyo']?>" ><?php echo $tipo_area[$i]['Nombre_Tipo_Area']?></option>   
                <?php }}  ?>
                </select>
            </div>
            
            <div class="col-md-4">
                <label for="Provincia">Provincia</label>
                <select class="form-control" id="Provincia" name="Provincia" > 
                <?php
                $tam = count($provincias);

                for($i=0; $i<$tam;$i++)
                {
                    if($provincias[$i]['ID_Provincia']==$cantones[$distritos[$params[0]['ID_Distrito']]['ID_Canton']]['ID_Provincia']){
                        
                        ?><option value="<?php echo $provincias[$i]['ID_Provincia']?>" selected="selected"><?php echo $provincias[$i]['Nombre_Provincia']?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $provincias[$i]['ID_Provincia']?>" ><?php echo $provincias[$i]['Nombre_Provincia']?></option>   
                <?php }}  ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="Canton">Cantón</label>
                <select class="form-control" id="Canton" name="Canton" > 
                <?php
                $tam = count($cantones);
                
                for($i=0; $i<$tam;$i++)
                {
                    if($cantones[$i]['ID_Canton']==$distritos[$params[0]['ID_Distrito']]['ID_Canton']){
                       ?> <option value="<?php echo $cantones[$i]['ID_Canton']?>" selected="selected"><?php echo $cantones[$i]['Nombre_Canton']?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $cantones[$i]['ID_Canton']?>" ><?php echo $cantones[$i]['Nombre_Canton']?></option>   
                <?php }}  ?>
                </select>
            </div>
            
            <div class="col-md-4">
                <label for="Distrito">Distrito</label>
                <select class="form-control" id="Distrito" name="Distrito" > 
                <?php
                $tam = count($distritos);
                for($i=0; $i<$tam;$i++)
                {
                    if($distritos[$i]['ID_Distrito']==$params[0]['ID_Distrito']){
                        
                       ?> <option value="<?php echo $distritos[$i]['ID_Distrito']?>" selected="selected"><?php echo $distritos[$i]['Nombre_Distrito']?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $distritos[$i]['ID_Distrito']?>" ><?php echo $distritos[$i]['Nombre_Distrito']?></option>   
                <?php }}  ?>
                </select>
            </div>
            
            <div class="col-md-4 espacio-abajo">
              <label for="direccion">Direccion</label>
              <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $params[0]['Direccion'];?>">
            </div>
            
            <div class="col-md-4 espacio-abajo">
              <label for="observaciones">Observaciones</label>
                <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $params[0]['Observaciones'];?>">
            </div>  

            <div class="col-md-4 espacio-abajo">
            <label for="Estado">Estado</label>
            <select class="form-control" id="Estado" name="Estado" >
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
            
      <button type="submit" class="btn btn-default" >Guardar</button>
        <td><a href="index.php?ctl=listar_usuarios" class="btn btn-default" role="button">Cancelar</a></td>
      </form>     
                               
      <?php require_once 'pie_de_pagina.php' ?>
    </body>
    </div>
        </div>
</html>