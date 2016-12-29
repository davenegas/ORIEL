<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Personal Externo</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_personal.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class="container bordegris">
<!--            <pre>
                //<?php print_r($puestos); ?>
            </pre>-->
            <h2>Detalle de Personas 
                <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                    <a href="index.php?ctl=personal_gestion&id=<?php echo $params[0]['ID_Persona']-1?>;"><img src='vistas/Imagenes/boton-antes.png' width="25"></a>
                    <a href="index.php?ctl=personal_gestion&id=<?php echo $params[0]['ID_Persona']+1?>;"><img src='vistas/Imagenes/boton-siguiente.png' width="25"></a>
                <?php }?>
            </h2>
            <div>
                <h3>Información General
                <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                    <input class="quitar-float" type="checkbox" id="chk_general" name="chk_general">
                <?php }?>
                </h3>
                <!--Información del personal Externo-->
                <div class="col-md-4 espacio-abajo">
                    <label for="ID_Persona">ID Persona</label>
                    <input type="text" required="ID_Persona" readonly class="form-control" id="ID_Persona" name="ID_Persona" value="<?php echo $params[0]['ID_Persona_Externa'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="identificacion">Identificación</label>
                    <input type="text" required="cedula" readonly class="form-control" id="identificacion" name="identificacion" value="<?php echo $params[0]['Identificacion'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="Empresa">Empresa</label>
                    <select class="form-control" id="Empresa" disabled name="Empresa"> 
                        <?php
                        $tam = count($empresas);
                        for($i=0; $i<$tam;$i++){
                            if($empresas[$i]['ID_Empresa']==$params[0]['ID_Empresa']){
                               ?> <option value="<?php echo $empresas[$i]['ID_Empresa']?>" selected="selected"><?php echo $empresas[$i]['Empresa']?></option><?php
                            }   
                            else { ?>
                                <option value="<?php echo $empresas[$i]['ID_Empresa']?>" ><?php echo $empresas[$i]['Empresa']?></option>   
                        <?php } }  ?>
                    </select>
                </div>
                <div class="col-md-12 espacio-abajo quitar-float">
                    <label for="nombre">Nombre y Apellidos</label>
                    <input type="text" class="form-control" ALIGN="right" id="nombre" name="nombre" value="<?php echo $params[0]['Apellido_Nombre'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="text" class="form-control" ALIGN="right" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $params[0]['Apellido_Nombre'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                    <input type="text" class="form-control" ALIGN="right" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $params[0]['Apellido_Nombre'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_salida">Fecha de Ingreso</label>
                    <input type="text" class="form-control" ALIGN="right" id="fecha_salida" name="fecha_salida" value="<?php echo $params[0]['Apellido_Nombre'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_residencia">Fecha de vencimiento Residencia</label>
                    <input type="text" class="form-control" ALIGN="right" id="fecha_residencia" name="fecha_residencia" value="<?php echo $params[0]['Apellido_Nombre'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_portacion">Fecha de vencimiento Portación</label>
                    <input type="text" class="form-control" ALIGN="right" id="fecha_portacion" name="fecha_portacion" value="<?php echo $params[0]['Apellido_Nombre'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="correo">Correo</label>
                    <input type="text" class="form-control" ALIGN="right" id="correo" name="correo" value="<?php echo $params[0]['Apellido_Nombre'];?>">
                </div>
                
                <div class="col-md-4">
                <label for="Provincia">Provincia</label>
                    <select class="form-control" disabled id="Provincia" name="Provincia" > 
                    <?php
                        $tam = count($provincias);
                        for($i=0; $i<$tam;$i++) {
                            if($provincias[$i]['ID_Provincia']==$cantones[$distritos[$params[0]['ID_Distrito']]['ID_Canton']]['ID_Provincia']){
                                ?><option value="<?php echo $provincias[$i]['ID_Provincia']?>" selected="selected"><?php echo $provincias[$i]['Nombre_Provincia']?></option><?php
                            }   else    {?>
                                <option value="<?php echo $provincias[$i]['ID_Provincia']?>" ><?php echo $provincias[$i]['Nombre_Provincia']?></option>   
                            <?php }}  ?>
                    </select>
                </div>
                
                <div class="col-md-4">
                <label for="Canton">Cantón</label>
                    <select class="form-control" disabled id="Canton" name="Canton" > 
                    <?php
                    $tam = count($cantones);

                    for($i=0; $i<$tam;$i++){
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
                    for($i=0; $i<$tam;$i++){
                        if($distritos[$i]['ID_Distrito']==$params[0]['ID_Distrito']){
                           ?> <option value="<?php echo $distritos[$i]['ID_Distrito']?>" selected="selected"><?php echo $distritos[$i]['Nombre_Distrito']?></option><?php
                        }   else    {?>
                            <option value="<?php echo $distritos[$i]['ID_Distrito']?>" ><?php echo $distritos[$i]['Nombre_Distrito']?></option>   
                        <?php }}  ?>
                    </select>
                </div>
                <div class="col-md-12 espacio-abajo">
                  <label for="Direccion">Direccion</label>
                  <input type="text" required="required" readonly class="form-control" id="Direccion" name="Direccion" value="<?php echo $params[0]['Direccion'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="estado_civil">Estado Civil</label>
                    <select class="form-control" id="estado_civil" disabled name="estado_civil"> 
                        <?php
                        $tam = count($empresas);
                        for($i=0; $i<$tam;$i++){
                            if($empresas[$i]['ID_Empresa']==$params[0]['ID_Empresa']){
                               ?> <option value="<?php echo $empresas[$i]['ID_Empresa']?>" selected="selected"><?php echo $empresas[$i]['Empresa']?></option><?php
                            }   
                            else { ?>
                                <option value="<?php echo $empresas[$i]['ID_Empresa']?>" ><?php echo $empresas[$i]['Empresa']?></option>   
                        <?php } }  ?>
                    </select>
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="nacionalidad">Nacionalidad</label>
                    <select class="form-control" id="nacionalidad" disabled name="nacionalidad"> 
                        <?php
                        $tam = count($empresas);
                        for($i=0; $i<$tam;$i++){
                            if($empresas[$i]['ID_Empresa']==$params[0]['ID_Empresa']){
                               ?> <option value="<?php echo $empresas[$i]['ID_Empresa']?>" selected="selected"><?php echo $empresas[$i]['Empresa']?></option><?php
                            }   
                            else { ?>
                                <option value="<?php echo $empresas[$i]['ID_Empresa']?>" ><?php echo $empresas[$i]['Empresa']?></option>   
                        <?php } }  ?>
                    </select>
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="nivel_academico">Nivel Academico</label>
                    <select class="form-control" id="nivel_academico" disabled name="nivel_academico"> 
                        <?php
                        $tam = count($empresas);
                        for($i=0; $i<$tam;$i++){
                            if($empresas[$i]['ID_Empresa']==$params[0]['ID_Empresa']){
                               ?> <option value="<?php echo $empresas[$i]['ID_Empresa']?>" selected="selected"><?php echo $empresas[$i]['Empresa']?></option><?php
                            }   
                            else { ?>
                                <option value="<?php echo $empresas[$i]['ID_Empresa']?>" ><?php echo $empresas[$i]['Empresa']?></option>   
                        <?php } }  ?>
                    </select>
                </div>
                <div class="col-md-12 espacio-abajo">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control" ALIGN="right" id="observaciones" name="observaciones" value="<?php echo $params[0]['Apellido_Nombre'];?>">
                </div>
            </div>
        </section>
    </body>
</html>