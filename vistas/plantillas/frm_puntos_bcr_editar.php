<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Puntos BCR</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_puntobcr.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>

    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
        <h2>Gestión de Puntos BCR del Sistema
            <a href="index.php?ctl=gestion_punto_bcr&id=<?php echo $params[0]['ID_PuntoBCR']-1?>;"><img src='vistas/Imagenes/boton-antes.png' width="25"></a>
            <a href="index.php?ctl=gestion_punto_bcr&id=<?php echo $params[0]['ID_PuntoBCR']+1?>;"><img src='vistas/Imagenes/boton-siguiente.png' width="25"></a>
        </h2>
        <h3>Información General del Punto BCR 
            <input class="quitar-float" type="checkbox" id="chk_informacion_general" name="chk_ubicacion">
        </h3>
        
        <div class="container">
        <!--<form class="form-horizontal" role="form" method="POST" action="index.php?ctl=guardar_punto_bcr&id=<?php echo trim($ide);?>">-->
        <div >    
            <div class="col-md-4">
              <label for="ID_PuntoBCR">ID Punto</label>
              <input type="text" required="ID_PuntoBCR" readonly class="form-control" id="ID_PuntoBCR" name="ID_PuntoBCR" value="<?php echo $params[0]['ID_PuntoBCR'];?>">
            </div>
            <div class="col-md-4">
              <label for="Codigo">Codigo</label>
              <input type="text" required="required" readonly class="form-control" id="Codigo" name="Codigo" value="<?php echo $params[0]['Codigo'];?>">
            </div>
            <div class="col-md-4">
              <label for="Cuenta_SIS">Cuenta SIS</label>
              <input type="text" required="required" readonly class="form-control" id="Cuenta_SIS" name="Cuenta_SIS" value="<?php echo $params[0]['Cuenta_SIS'];?>">
            </div>
            
            <div class="col-md-6 espacio-abajo">
              <label for="Nombre">Nombre</label>
              <input type="text" required="required" readonly class="form-control" id="Nombre" name="Nombre" value="<?php echo $params[0]['Nombre'];?>">
            </div>
            <div class="col-md-6 espacio-abajo">
                <label for="Tipo_Punto">Tipo de Punto</label>
                <select class="form-control" id="Tipo_Punto" disabled name="Tipo_Punto" > 
                <?php
                $tam = count($tipo_puntos);

                for($i=0; $i<$tam;$i++)
                {
                    if($tipo_puntos[$i]['ID_Tipo_Punto']==$params[0]['ID_Tipo_Punto']){
                        
                       ?> <option value="<?php echo $tipo_puntos[$i]['ID_Tipo_Punto']?>" selected="selected"><?php echo $tipo_puntos[$i]['Tipo_Punto']?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $tipo_puntos[$i]['ID_Tipo_Punto']?>" ><?php echo $tipo_puntos[$i]['Tipo_Punto']?></option>   
                <?php }}  ?>
                </select>
            </div>
            <h5 class="quitar-float">Información de telefonos del Punto BCR: <a>Agregar número</a></h5> 
            <div>
            <table class="display col-md-12 table-striped quitar-float espacio-abajo" id="telefonos">
                <thead> 
                    <th>ID_Telefono</th>
                    <th style="text-align:center">Tipo de Teléfono</th>
                    <th style="text-align:center">Número teléfono</th>
                    <th style="text-align:center">Observaciones</th>
                    <th style="text-align:center">Quitar número</th>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($telefonos);
                    for ($i = 0; $i <$tam; $i++) {
                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo $telefonos[$i]['ID_Telefono'];?></td>
                        <td style="text-align:center"><?php echo $telefonos[$i]['Tipo_Telefono'];?></td>
                        <td style="text-align:center"><?php echo $telefonos[$i]['Numero'];?></td>
                        <td style="text-align:center"><?php echo $telefonos[$i]['Observaciones'];?></td>
                        <td style="text-align:center"><a class="btn" role="button" id="prueba" name="prueba" onclick="eliminar_telefono(<?php echo $telefonos[$i]['ID_Telefono'];?>)">
                                <img src='vistas/Imagenes/menos.png' width="20"></a></td>
                    </tr>
                    <?php } ?>
                </tbody> 
            </table>
            </div>
            <table class="display col-md-12  table-striped quitar-float" id="unidad_ejecutora">
                <thead> 
                    <th style="text-align:center">Numero UE</th>
                    <th style="text-align:center">Departamento</th>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($unidad_ejecutora);
                    for ($i = 0; $i <$tam; $i++) {
                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo $unidad_ejecutora[$i]['Numero_UE'];?></td>
                        <td style="text-align:center"><?php echo $unidad_ejecutora[$i]['Departamento'];?></td>
                    </tr>
                    <?php } ?>
                </tbody> 
            </table>
        </div> 

        <h3 class="espacio-arriba quitar-float">Ubicación <input class="quitar-float" type="checkbox" id="chk_ubicacion" name="chk_ubicacion"></h3>

        <div>
            <div class="col-md-4">
                <label for="Provincia">Provincia</label>
                <select class="form-control" disabled id="Provincia" name="Provincia" > 
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
                <select class="form-control" disabled id="Canton" name="Canton" > 
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
                <select class="form-control" disabled id="Distrito" name="Distrito" > 
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
            
            <div class="col-md-12">
              <label for="Direccion">Direccion</label>
              <input type="text" required="required" readonly class="form-control" id="Direccion" name="Direccion" value="<?php echo $params[0]['Direccion'];?>">
            </div>
        </div>    
                
        <br><br><br><br><br><br><br>
        <h4>Información de Areas Apoyo</h4>    
        <div>
            <table class="display col-md-12 table-striped quitar-float espacio-abajo" id="areas_apoyo">
                <thead> 
                    <th style="text-align:center">Area de Apoyo</th>
                    <th style="text-align:center">Nombre de Area</th>
                    <th style="text-align:center">Numero telefono</th>
                    <th style="text-align:center">Direccion</th>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($areas_apoyo);
                    for ($i = 0; $i <$tam; $i++) {
                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo $areas_apoyo[$i]['Nombre_Tipo_Area'];?></td>
                        <td style="text-align:center"><?php echo $areas_apoyo[$i]['Nombre_Area'];?></td>
                        <td style="text-align:center"><?php echo $areas_apoyo[$i]['Numero'];?></td>
                        <td style="text-align:center"><?php echo $areas_apoyo[$i]['Direccion'];?></td>
                    </tr>
                    <?php } ?>
                </tbody> 
            </table>
            <h4>Información de Personal del PuntoBCR</h4>
            <table id="tabla" class="display" cellspacing="0" width="100%">
                <thead> 
                    <th style="text-align:center">Apellido y Nombre</th>
                    <th style="text-align:center">Puesto</th>
                    <th style="text-align:center">Numero telefono</th>
                    <th style="text-align:center">Puesto</th>
                    <th style="text-align:center">Departamento</th>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($personal);
                    for ($i = 0; $i <$tam; $i++) {
                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo $personal[$i]['Apellido_Nombre'];?></td>
                        <td style="text-align:center"><?php echo $personal[$i]['Puesto'];?></td>
                        <td style="text-align:center"><?php echo $personal[$i]['Numero'];?></td>
                        <td style="text-align:center"><?php echo $personal[$i]['Puesto'];?></td>
                        <td style="text-align:center"><?php echo $personal[$i]['Departamento'];?></td>
                    </tr>
                    <?php } ?>
                </tbody> 
            </table>
            <h4>Información Otra</h4>
            <div class="col-md-4 espacio-abajo">
                <label for="Empresa">Remesa</label>
                <select class="form-control" id="Empresa" disabled name="Empresa"> 
                <?php
                $tam = count($empresas);
                for($i=0; $i<$tam;$i++)
                {
                    if($empresas[$i]['ID_Empresa']==$params[0]['ID_Empresa']){
                       ?> <option value="<?php echo $empresas[$i]['ID_Empresa']?>" selected="selected"><?php echo $empresas[$i]['Empresa']?></option><?php
                    }   
                    else { ?>
                        <option value="<?php echo $empresas[$i]['ID_Empresa']?>" ><?php echo $empresas[$i]['Empresa']?></option>   
                <?php } }  ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="Horario">Horario Días</label>
                <select class="form-control" id="Horario" disabled name="Horario" > 
                <?php
                $tam = count($horarios);

                for($i=0; $i<$tam;$i++)
                {
                    if($horarios[$i]['ID_Horario']==$params[0]['ID_Horario']){
                        
                       ?> <option value="<?php echo $horarios[$i]['ID_Horario']?>" selected="selected"><?php echo $horarios[$i]['Dia_Laboral']?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $horarios[$i]['ID_Horario']?>" ><?php echo $horarios[$i]['Dia_Laboral']?></option>   
                <?php }}  ?>
                </select>
            </div>
            
            <div class="col-md-4">
                <label for="Horario">Horario Horas</label>
                <select class="form-control" id="Horario" disabled name="Horario" > 
                <?php
                $tam = count($horarios);

                for($i=0; $i<$tam;$i++)
                {
                    if($horarios[$i]['ID_Horario']==$params[0]['ID_Horario']){
                        
                       ?> <option value="<?php echo $horarios[$i]['ID_Horario']?>" selected="selected"><?php echo $horarios[$i]['Hora_Laboral']?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $horarios[$i]['ID_Horario']?>" ><?php echo $horarios[$i]['Hora_Laboral']?></option>   
                <?php }}  ?>
                </select>
            </div>
            
            <table class="display col-md-12  table-striped quitar-float espacio-abajo" id="direccionIP">
                <thead> 
                    <th style="text-align:center">Tipo Direccion</th>
                    <th style="text-align:center">Direccion IP</th>
                    <th style="text-align:center">Observaciones</th>
                    <th style="text-align:center">Estado</th>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($direccionIP);
                    for ($i = 0; $i <$tam; $i++) {
                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo $direccionIP[$i]['Tipo_IP'];?></td>
                        <td style="text-align:center"><?php echo $direccionIP[$i]['Direccion_IP'];?></td>
                        <td style="text-align:center"><?php echo $direccionIP[$i]['Observaciones'];?></td>
                        <td style="text-align:center"><a href="">Link</a></td>
                    </tr>
                    <?php } ?>
                </tbody> 
            </table>
            <div class="col-md-8">
              <label for="Observaciones">Observaciones</label>
              <input type="text" disabled class="form-control" id="Observaciones" name="Observaciones" value="<?php echo $params[0]['Observaciones'];?>">
            </div>
            
            <div class="col-md-4">
                <label for="Estado">Estado</label>
                <select class="form-control" disabled id="Estado" name="Estado" >
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
        </div>
        <br><br><br><br><br>
            <!--<button type="submit" class="btn btn-default" >Guardar</button>-->
            <a href="index.php?ctl=puntos_bcr_listar" class="btn btn-default" role="button">Volver</a>
<!--        </form>                               -->
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
    </div>
</html>