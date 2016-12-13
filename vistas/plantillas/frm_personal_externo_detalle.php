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
                    <input type="text" required="ID_Persona" class="form-control" id="ID_Persona" name="ID_Persona" value="<?php echo $params[0]['ID_Persona_Externa'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="identificacion">Identificación</label>
                    <input type="text" required="cedula" class="form-control" id="identificacion" name="identificacion" value="<?php echo $params[0]['Identificacion'];?>">
                </div>
                <div class="col-md-4 col-xs-4 espacio-abajo">
                    <label for="Empresa">Empresa</label>
                    <select class="form-control" id="Empresa" name="Empresa"> 
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
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" ALIGN="right" id="nombre" name="nombre" value="<?php echo $params[0]['Nombre'];?>">
                </div>
                <div class="col-md-8 espacio-abajo">
                    <label for="apellido">Apellidos</label>
                    <input type="text" class="form-control" ALIGN="right" id="apellido" name="apellido" value="<?php echo $params[0]['Apellido'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" ALIGN="right" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $params[0]['Fecha_Nacimiento'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                    <input type="date" class="form-control" ALIGN="right" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $params[0]['Fecha_Ingreso'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_salida">Fecha de Salida</label>
                    <input type="date" class="form-control" ALIGN="right" id="fecha_salida" name="fecha_salida" value="<?php echo $params[0]['Fecha_Salida'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="nacionalidad">Nacionalidad</label>
                    <select class="form-control" id="nacionalidad" name="nacionalidad"> 
                        <?php
                        $tam = count($nacionalidad);
                        for($i=0; $i<$tam;$i++){
                            if($nacionalidad[$i]['ID_Nacionalidad']==$params[0]['ID_Nacionalidad']){
                               ?> <option value="<?php echo $nacionalidad[$i]['ID_Nacionalidad']?>" selected="selected"><?php echo $nacionalidad[$i]['Nacionalidad']?></option><?php
                            }   
                            else { ?>
                                <option value="<?php echo $nacionalidad[$i]['ID_Nacionalidad']?>" ><?php echo $nacionalidad[$i]['Nacionalidad']?></option>   
                        <?php } }  ?>
                    </select>
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_residencia">Fecha de vencimiento Residencia</label>
                    <input type="date" class="form-control" ALIGN="right" id="fecha_residencia" name="fecha_residencia" value="<?php echo $params[0]['Fecha_Vencimiento_Residencia'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_portacion">Fecha de vencimiento Portación</label>
                    <input type="date" class="form-control" ALIGN="right" id="fecha_portacion" name="fecha_portacion" value="<?php echo $params[0]['Fecha_Vencimiento_Portacion'];?>">
                </div>
               
                
                <div class="col-md-4">
                <label for="Provincia">Provincia</label>
                    <select class="form-control" id="Provincia" name="Provincia" > 
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
                    <select class="form-control" id="Canton" name="Canton" > 
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
                    <select class="form-control" id="Distrito" name="Distrito" > 
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
                  <input type="text" required="required" class="form-control" id="Direccion" name="Direccion" value="<?php echo $params[0]['Direccion'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="estado_civil">Estado Civil</label>
                    <select class="form-control" id="estado_civil" name="estado_civil"> 
                        <?php
                        $tam = count($estado_civil);
                        for($i=0; $i<$tam;$i++){
                            if($estado_civil[$i]['ID_Estado_Civil']==$params[0]['ID_Estado_Civil']){
                               ?> <option value="<?php echo $estado_civil[$i]['ID_Estado_Civil']?>" selected="selected"><?php echo $estado_civil[$i]['Estado_Civil']?></option><?php
                            }   
                            else { ?>
                                <option value="<?php echo $estado_civil[$i]['ID_Estado_Civil']?>" ><?php echo $estado_civil[$i]['Estado_Civil']?></option>   
                        <?php } }  ?>
                    </select>
                </div>
                 <div class="col-md-4 espacio-abajo">
                    <label for="correo">Correo</label>
                    <input type="text" class="form-control" ALIGN="right" id="correo" name="correo" value="<?php echo $params[0]['Correo'];?>">
                </div>
                
                <div class="col-md-4 espacio-abajo">
                    <label for="nivel_academico">Nivel Academico</label>
                    <select class="form-control" id="nivel_academico" name="nivel_academico"> 
                        <?php
                        $tam = count($nivel_academico);
                        for($i=0; $i<$tam;$i++){
                            if($nivel_academico[$i]['ID_Nivel_Academico']==$params[0]['ID_Nivel_Academico']){
                               ?> <option value="<?php echo $nivel_academico[$i]['ID_Nivel_Academico']?>" selected="selected"><?php echo $nivel_academico[$i]['Nivel_Academico']?></option><?php
                            }   
                            else { ?>
                                <option value="<?php echo $nivel_academico[$i]['ID_Nivel_Academico']?>" ><?php echo $nivel_academico[$i]['Nivel_Academico']?></option>   
                        <?php } }  ?>
                    </select>
                </div>
                <div class="col-md-8 espacio-abajo">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control" ALIGN="right" id="observaciones" name="observaciones" value="<?php echo $params[0]['Observaciones'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="estado_personal">Estado de la persona</label>
                    <select class="form-control" id="estado_personal" name="estado_personal"> 
                        <?php
                        $tam = count($estado_persona);
                        for($i=0; $i<$tam;$i++){
                            if($estado_persona[$i]['ID_Estado_Persona']==$params[0]['ID_Estado_Persona']){
                               ?> <option value="<?php echo $estado_persona[$i]['ID_Estado_Persona']?>" selected="selected"><?php echo $estado_persona[$i]['Nombre_Estado']?></option><?php
                            }   
                            else { ?>
                                <option value="<?php echo $estado_persona[$i]['ID_Estado_Persona']?>" ><?php echo $estado_persona[$i]['Nombre_Estado']?></option>   
                        <?php } }  ?>
                    </select>
                </div>
            </div>
            </section>
                    <section class="container bordegris">
                <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                    <h3 class="quitar-float">Información de telefonos <a id="popup" onclick="mostrar_agregar_telefono()" class="btn azul" role="button">Agregar número</a></h3> 
                <?php } else {?>
                    <h3 class="quitar-float">Información de telefonos</h3>
                <?php } ?>
                <table class="display col-md-12 table-striped quitar-float espacio-abajo" id="telefonos">
                    <thead> 
                        <th style="text-align:center">Tipo de Teléfono</th>
                        <th style="text-align:center">Número teléfono</th>
                        <th style="text-align:center">Observaciones</th>
                        <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                        <th style="text-align:center" colspan="2">Opciones número</th>
                        <?php } ?>
                    </thead>
                    <tbody>
                        <?php 
                        $tam=count($params);
                        for ($i = 0; $i <$tam; $i++) {
                        ?>
                        <tr>
                            <td style="text-align:center"><?php echo $params[$i]['Tipo_Telefono'];?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Numero'];?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Observaciones_Tel'];?></td>
                            <?php if($_SESSION['modulos']['Editar- Personal']==1){  ?>
                                <td style="text-align:center"><a class="btn azul" role="button" id="prueba" name="prueba" 
                                        onclick="Editar_telefono(<?php echo $params[$i]['ID_Telefono'];?>,<?php echo $params[$i]['ID_Tipo_Telefono'];?>,<?php echo $params[$i]['Numero'];?>,'<?php echo $params[$i]['Observaciones_Tel'];?>')">
                                    Editar</a></td> 
                                <td style="text-align:center"><a class="btn rojo" role="button" id="prueba" name="prueba" onclick="eliminar_telefono(<?php echo $params[$i]['ID_Telefono'];?>);">
                                    Eliminar</a></td>

                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody> 
                </table>
                
                <!--Tabla con fotos del personal externo-->
                <div>
                    <table id="tabla" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>  
                                <th style="text-align:center">Categoría</th>
                                <th style="text-align:center">Nombre Imágen</th>
                                <th style="text-align:center">Descripción</th>
                                <th style="text-align:center">Imágen</th>
                                <?php if($_SESSION['modulos']['Editar- Padrón Fotográfico Puntos BCR']==1){ ?>
                                <th style="text-align:center">Gestión</th>
                                <?php } ?>
                                <th style="text-align:center" hidden="hidden">Nombre Ruta</th>
                            </tr>
                          </thead>
                        <tbody>
                            <?php
                            $tam=count($params);

                            for ($i = 0; $i <$tam; $i++) { ?>
                            <tr>
                                <td style="text-align:center"><?php echo $params[$i]['Categoria'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Nombre_Imagen'];?></td>
                                <td style="text-align:center"><?php echo $params [$i]['Descripcion'];?></td>
                                <td style="text-align:center"><a class="fancybox-button" rel="fancybox-button" href="../../../Padron_Fotografico_Puntos_BCR/<?php echo $params[$i]['Nombre_Ruta'];?>" title="<?php echo $params[$i]['Nombre_Imagen'].' ('.$params[$i]['Descripcion'].')';?>">
                                    <img src="../../../Padron_Fotografico_Puntos_BCR/<?php echo $params[$i]['Nombre_Ruta'];?>" alt="" width="200px"/></a></td>
                                <?php if($_SESSION['modulos']['Editar- Padrón Fotográfico Puntos BCR']==1){ ?>
                                <td align="center"><a onclick="eliminar_imagen(<?php echo $params[$i]['ID_Padron_PuntoBCR'];?>);">Eliminar</a></td>    
                                <?php } ?>
                                <td style="text-align:center" hidden="hidden"><?php echo $params [$i]['Nombre_Ruta'];?></td>
                            </tr>   
                            <?php }//Fin ciclo for ?>
                        </tbody>
                    </table>
                </div>
                
            <a href="index.php?ctl=personal_listar" class="btn btn-default espacio-arriba" role="button">Volver</a>
                
                <?php require_once 'pie_de_pagina.php' ?>
            </section>
    </body>
</html>