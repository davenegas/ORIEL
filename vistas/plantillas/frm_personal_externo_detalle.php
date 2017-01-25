<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Personal Externo</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_personal_externo.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class="container bordegris">
            <h2>Detalle de Personas 
                <?php if($_SESSION['modulos']['Editar- Personal Externo']==1){ ?>
                    <a href="index.php?ctl=personal_gestion&id=<?php echo $params[0]['ID_Persona']-1?>;"><img src='vistas/Imagenes/boton-antes.png' width="25"></a>
                    <a href="index.php?ctl=personal_gestion&id=<?php echo $params[0]['ID_Persona']+1?>;"><img src='vistas/Imagenes/boton-siguiente.png' width="25"></a>
                <?php }?>
            </h2>
<!--            <pre>
                <?php print_r($params); ?>
            </pre>-->
            <div>
                <h3>Información General
                <?php if($_SESSION['modulos']['Editar- Personal Externo']==1){ ?>
                    <input class="quitar-float" type="checkbox" id="chk_general" name="chk_general">
                <?php }?>
                </h3>
                <!--Información del personal Externo-->
                <input type="text" hidden required="ID_Persona" readonly id="ID_Persona" name="ID_Persona" value="<?php echo $params[0]['ID_Persona_Externa'];?>">

                <div class="col-md-4 espacio-abajo">
                    <label for="identificacion">Identificación</label>
                    <input type="text" required="cedula" readonly class="form-control" id="identificacion" name="identificacion" value="<?php echo $params[0]['Identificacion'];?>">
                </div>
                <div class="col-md-4 col-xs-4 espacio-abajo">
                    <label for="Empresa">Empresa</label>
                    <select class="form-control" disabled id="Empresa" name="Empresa"> 
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
                    <label for="carnet">Número de Gafete</label>
                    <input type="text" required="carnet" readonly class="form-control" id="carnet" name="ID_Persona" value="">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="nombre">Nombre</label>
                    <input type="text" style="text-transform: uppercase" class="form-control" readonly ALIGN="right" id="nombre" name="nombre" value="<?php echo $params[0]['Nombre'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="apellido">Apellidos</label>
                    <input type="text" style="text-transform: uppercase" class="form-control" readonly ALIGN="right" id="apellido" name="apellido" value="<?php echo $params[0]['Apellido'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="ocupacion">Ocupación</label>
                    <input type="text" class="form-control" readonly ALIGN="right" id="ocupacion" name="ocupacion" value="<?php echo $params[0]['Ocupacion'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" readonly  ALIGN="right" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $params[0]['Fecha_Nacimiento'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                    <input type="date" class="form-control" readonly ALIGN="right" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $params[0]['Fecha_Ingreso'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_salida">Fecha de Salida</label>
                    <input type="date" class="form-control" readonly ALIGN="right" id="fecha_salida" name="fecha_salida" value="<?php echo $params[0]['Fecha_Salida'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="nacionalidad">Nacionalidad</label>
                    <select class="form-control" disabled id="nacionalidad" name="nacionalidad"> 
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
                    <label for="fecha_residencia">Fecha de vencimiento Identificación/Residencia</label>
                    <input type="date" class="form-control" readonly ALIGN="right" id="fecha_residencia" name="fecha_residencia" value="<?php echo $params[0]['Fecha_Vencimiento_Residencia'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="fecha_portacion">Fecha de vencimiento Portación</label>
                    <input type="date" class="form-control" readonly ALIGN="right" id="fecha_portacion" name="fecha_portacion" value="<?php echo $params[0]['Fecha_Vencimiento_Portacion'];?>">
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
                    <select class="form-control" disabled id="estado_civil" name="estado_civil"> 
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
                    <input type="text" class="form-control" readonly ALIGN="right" id="correo" name="correo" value="<?php echo $params[0]['Correo'];?>">
                </div>
                
                <div class="col-md-4 espacio-abajo">
                    <label for="nivel_academico">Nivel Academico</label>
                    <select class="form-control" disabled id="nivel_academico" name="nivel_academico"> 
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
                    <input type="text" class="form-control" readonly ALIGN="right" id="observaciones" name="observaciones" value="<?php echo $params[0]['Observaciones'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="estado_persona">Estado de la persona</label>
                    <select class="form-control" disabled id="estado_persona" name="estado_persona"> 
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
                <div class="col-md-4 espacio-abajo">
                    <label for="genero">Genero</label>
                    <select class="form-control" disabled id="genero" name="genero"> 
                        <?php if($params[0]['Genero']=="M"){?>
                            <option value="M" selected>Masculino</option>
                            <option value="F">Femenina</option>
                        <?php } else { ?>
                            <option value="M">Masculino</option>
                            <option value="F" selected>Femenina</option>
                        <?php }?>    
                    </select>
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="validado">Validado</label>
                    <?php if($_SESSION['modulos']['Validar- Personal Externo']==1){ ?>
                        <select class="form-control" id="validado" name="validado" onchange="validar_persona_externa();"> 
                    <?php } else{ ?>
                        <select class="form-control" disabled readonly id="validado" name="validado" > 
                    <?php } ?>
                        <?php if($params[0]['Validado']=='0'){?>
                        <option value="0" selected style="color: red">No Validado</option>
                            <option value="1">Validado</option>
                        <?php } else { ?>
                            <option value="0" style="color: red">No Validado</option>
                            <option value="1" selected>Validado</option>
                        <?php }?>  
                    </select>
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="ocupacion">Validado por:</label>
                    <input type="text" class="form-control" readonly ALIGN="right" id="ocupacion" name="ocupacion" value="<?php echo $params[0]['Nombre_Usuario'].' '.$params[0]['Apellido_Usuario'];?>">
                </div>
            </div>
        </section>
        
        <!--Sección para informacion de teléfonos-->
        <section class="container bordegris espacio-abajo">
            <?php if($_SESSION['modulos']['Editar- Personal Externo']==1){ ?>
                <h3 class="quitar-float">Información de teléfonos <a id="popup" onclick="mostrar_agregar_telefono()" class="btn azul" role="button">Agregar número</a></h3> 
            <?php } else {?>
                <h3 class="quitar-float">Información de teléfonos</h3>
            <?php } ?>
            <table class="display col-md-12 table-striped quitar-float espacio-abajo" id="telefonos">
                <thead>
                    <tr>
                        <th style="text-align:center">Tipo de Teléfono</th>
                        <th style="text-align:center">Número teléfono</th>
                        <th style="text-align:center">Observaciones</th>
                        <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                        <th style="text-align:center" colspan="2">Opciones número</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($num_telefono);
                    for ($i = 0; $i <$tam; $i++) { ?>
                    <tr>
                        <td style="text-align:center"><?php echo $num_telefono[$i]['Tipo_Telefono'];?></td>
                        <td style="text-align:center"><?php echo $num_telefono[$i]['Numero'];?></td>
                        <td style="text-align:center"><?php echo $num_telefono[$i]['Observaciones'];?></td>
                        <?php if($_SESSION['modulos']['Editar- Personal Externo']==1){  ?>
                            <td style="text-align:center"><a class="btn azul" role="button" id="prueba" name="prueba" 
                                    onclick="Editar_telefono(<?php echo $num_telefono[$i]['ID_Telefono'];?>,<?php echo $num_telefono[$i]['ID_Tipo_Telefono'];?>,'<?php echo $num_telefono[$i]['Numero'];?>','<?php echo $num_telefono[$i]['Observaciones'];?>')">
                                Editar</a></td> 
                            <td style="text-align:center"><a class="btn rojo" role="button" id="prueba" name="prueba" onclick="eliminar_telefono(<?php echo $num_telefono[$i]['ID_Telefono'];?>);">
                                Eliminar</a></td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody> 
            </table>
        </section>
            
        <!--Sección para fotos del personal externo-->
        <section class="container">
            <?php if($_SESSION['modulos']['Editar- Personal Externo']==1){ ?>
                <h3 class="quitar-float">Fotos del personal <a id="popup" onclick="mostrar_agregar_foto()" class="btn azul" role="button">Agregar foto</a></h3> 
            <?php } else {?>
                <h3 class="quitar-float">Fotos del personal</h3>
            <?php } ?>
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
                        $tam=count($fotos);
                        for ($i = 0; $i <$tam; $i++) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $fotos[$i]['Categoria'];?></td>
                            <td style="text-align:center"><?php echo $fotos[$i]['Nombre_Imagen'];?></td>
                            <td style="text-align:center"><?php echo $fotos [$i]['Descripcion'];?></td>
                            <td style="text-align:center"><a class="fancybox-button" rel="fancybox-button" href="../../../Padron_Fotografico_Personal_externo/<?php echo $fotos[$i]['Nombre_Ruta'];?>" title="<?php echo $fotos[$i]['Nombre_Imagen'].' ('.$fotos[$i]['Descripcion'].')';?>">
                                <img src="../../../Padron_Fotografico_Personal_externo/<?php echo $fotos[$i]['Nombre_Ruta'];?>" alt="" width="200px"/></a></td>
                            <?php if($_SESSION['modulos']['Editar- Padrón Fotográfico Puntos BCR']==1){ ?>
                            <td align="center"><a onclick="eliminar_imagen(<?php echo $fotos[$i]['ID_Padron_Personal'];?>);">Eliminar</a></td>    
                            <?php } ?>
                            <td style="text-align:center" hidden="hidden"><?php echo $fotos [$i]['Nombre_Ruta'];?></td>
                        </tr>   
                        <?php }//Fin ciclo for ?>
                    </tbody>
                </table>
            </div>
        <a href="index.php?ctl=personal_externo_listar" class="btn btn-default espacio-arriba" role="button">Volver</a> 
        </section>
        <?php require_once 'pie_de_pagina.php' ?>
        
<!--    ***********************************************************************
        *******FORMULARIOS OCULTOS PARA FUNCIONALIDAD DE LA VENTANA************-->

        <!--agregar teléfono a la Persona-->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <!--Formulario para ingresar nuevos números de teléfono-->
                <form id="ventana" method="POST" name="form" action="index.php?ctl=personal_externo_numero_telefono_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Agregar número de teléfono</h2>
                    <hr>
                    <input hidden id="ID_Telefono" name="ID_Telefono" type="text">
                    <input hidden id="ID_Persona" name="ID_Persona" type="text" value="<?php echo $params[0]['ID_Persona_Externa']; ?>">
                    
                    <label for="Tipo_Telefono">Tipo de Telefono</label>
                        <select class="form-control espacio-abajo" id="Tipo_Telefono" name="Tipo_Telefono"> 
                        <?php
                        $tam = count($tipo_telefono);
                        for($i=0; $i<$tam;$i++)
                        {  
                            if($tipo_telefono[$i]['ID_Tipo_Telefono']==28||$tipo_telefono[$i]['ID_Tipo_Telefono']==29){?>
                                <option value="<?php echo $tipo_telefono[$i]['ID_Tipo_Telefono']?>" ><?php echo $tipo_telefono[$i]['Tipo_Telefono']?></option>   
                        <?php }}  ?>
                        </select>
                    <label for="numero">Número de Teléfono</label>
                    <input class="form-control espacio-abajo" maxlength="8" required id="numero" name="numero" placeholder="Número de teléfono - 8 digitos" type="text">
                    <label for="observaciones_tel">Observaciones</label>
                    <textarea class="form-control espacio-abajo" id="observaciones_tel" name="observaciones_tel" placeholder="Observaciones del número"></textarea>
                    
                    <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                </form>
            </div>
        <!--Cierre agregar teléfono -->
        </div>
        
        <!--Agregar foto al personal externo-->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
                <div id="ventana2">
                <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Fotos de Personal</h2>
                    <h4>Agregar nueva foto a la persona</h4>
                    <!--Formulario para ingresar areas de apoyo-->
                    <!--Agregar nuevo detalle o seguimiento del evento-->
                    <form class="form-horizontal"  id="guardar_foto" role="form" enctype="multipart/form-data" method="POST" action="index.php?ctl=guardar_imagen_persona_externa">
                        <div class="col-xs-12 quitar-float espacio-abajo">
                            <label for="archivo_adjunto">Adjuntar Archivo: </label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                            <input type="file" name="archivo_adjunto" id="seleccionar_archivo" class="btn btn-default">
                        </div> 
                        
                        <div class="col-xs-4">
                            <label for="Nombre">Nombre</label>
                            <input type="text" required=”required” class="form-control" id="Nombre" name="Nombre" >
                        </div>
              
                        <div hidden="hidden" class="col-xs-4">
                            <label for="ID_Persona">ID_Persona</label>
                            <input type="text" class="form-control" id="ID_Persona" name="ID_Persona" value="<?php echo $params[0]['ID_Persona_Externa'];?>">
                        </div>
                
                        <div class="col-xs-4">
                            <label for="Descripcion">Descripción</label>
                            <textarea type="text" required=”required” class="form-control" id="Descripcion" name="Descripcion" value="" maxlength="500" minlength="2" placeholder="Máximo 500 caracteres por seguimiento"></textarea>
                        </div>
                
                        <div class="col-xs-4 espacio-abajo">
                            <label for="Categoria">Categoría</label>
                            <select class="form-control espacio-abajo" id="Categoria" name="Categoria" required=”required”> 
                                <option value="Rostro" >Rostro</option>  
                                <option value="Cuerpo completo" >Cuerpo entero</option>  
                                <option value="Documentos" >Documentos</option>
                            </select>
                        </div>
                        <button><a href="javascript:%20valida_foto()" id="submit">Guardar Imágen</a></button>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>