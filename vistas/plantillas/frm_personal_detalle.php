<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Personal BCR</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_personal.js?1.0"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class="container">
            <!--Información general y foto-->
            <div class="row espacio-abajo">
                <!--Titulo-->
                <div class="row">
                    <div class="col-md-12">
                        <h2>Detalle de Personas 
                            <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                                <a href="index.php?ctl=personal_gestion&id=<?php echo $params[0]['ID_Persona']-1?>;"><img src='vistas/Imagenes/boton-antes.png' width="25"></a>
                                <a href="index.php?ctl=personal_gestion&id=<?php echo $params[0]['ID_Persona']+1?>;"><img src='vistas/Imagenes/boton-siguiente.png' width="25"></a>
                            <?php }?>
                        </h2>
                    </div>
                </div>
                <div class="row"> 
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Información General
                                <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                                    <input class="quitar-float" type="checkbox" id="chk_general" name="chk_general">
                                <?php }?>
                            </h3>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row espacio-abajo">
                            <div class="col-md-6">
                                <label for="ID_Persona">ID Persona</label>
                                <input type="text" required="ID_Persona" readonly class="form-control" id="ID_Persona" name="ID_Persona" value="<?php echo $params[0]['ID_Persona'];?>">
                            </div>
                            <div class="col-md-6">
                                <label for="cedula">Cédula</label>
                                <input type="text" required="cedula" readonly class="form-control" id="cedula" name="cedula" value="<?php echo $params[0]['Cedula'];?>">
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-md-12">
                                <label for="nombre">Nombre y Apellidos</label>
                                <input type="text" required readonly class="form-control" ALIGN="right" id="nombre" name="nombre" value="<?php echo $params[0]['Apellido_Nombre'];?>">
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-md-12">
                                <label for="observaciones">Observaciones</label>
                                <input type="text" required readonly class="form-control" id="observaciones" name="observaciones" value="<?php echo $params[0]['Observaciones'];?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="unidad_ejecutora">Unidad Ejecutora
                                    <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                                        <a id="popup" onclick="mostrar_lista_ue()" class="btn azul" role="button">- Editar</a>
                                    <?php } ?>
                                </label>
                                <input  type="text" required readonly class="form-control" id="nombre" name="nombre" value="<?php echo $params[0]['Departamento'];?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <IMG SRC="<?php echo $params[0]['Link_Foto'];?>" id="foto_personal">
                        </div> 
                    </div>
                </div>
            </div>
            <!--Información de puesto y direccion-->
            <div class="row espacio-abajo">
                <div class="row espacio-abajo">
                    <div class="col-md-8">
                        <label for="puesto">Puesto
                            <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                            <a id="popup" onclick="mostrar_lista_puesto()" role="button">- Editar</a>
                            <?php } ?>
                        </label>
                        <input type="text" required readonly class="form-control" id="nombre" name="nombre" value="<?php echo $params[0]['Puesto'];?>">
                    </div>
                    <div class="col-md-4">
                        <label for="numero_gafete">Número de Carné</label>
                        <input type="text" required readonly class="form-control" id="numero_gafete" name="numero_gafete" value="<?php echo $params[0]['Numero_Gafete'];?>">
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="direccion">Dirección</label>
                        <input type="text" required readonly class="form-control" id="direccion" name="direccion" value="<?php echo $params[0]['Direccion'];?>">
                    </div>
                    <div class="col-md-4">
                        <label for="correo">Correo</label>
                        <input type="email" required readonly class="form-control" id="correo" name="correo" value="<?php echo $params[0]['Correo'];?>">
                    </div>
                </div>
            </div>
            <!--Información de teléfonos-->
            <div class="row well">
                <div class="col-md-12">
                    <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                        <h3 class="quitar-float">Información de teléfonos <a id="popup" onclick="mostrar_agregar_telefono()" class="btn azul" role="button">Agregar número</a></h3> 
                    <?php } else {?>
                        <h3 class="quitar-float">Información de teléfonos</h3>
                    <?php } ?>
                    <table class="display col-md-12 table-striped" id="telefonos">
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
                            $tam=count($params);
                            for ($i = 0; $i <$tam; $i++) { ?>
                                <tr>
                                    <td style="text-align:center"><?php echo $params[$i]['Tipo_Telefono'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Numero'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Observaciones_Tel'];?></td>
                                    <?php if($_SESSION['modulos']['Editar- Personal']==1){  ?>
                                        <td style="text-align:center"><a class="btn azul" role="button" id="prueba" name="prueba" 
                                                onclick="Editar_telefono(<?php echo $params[$i]['ID_Telefono'];?>,<?php echo $params[$i]['ID_Tipo_Telefono'];?>,'<?php echo $params[$i]['Numero'];?>','<?php echo $params[$i]['Observaciones_Tel'];?>')">
                                            Editar</a></td> 
                                        <td style="text-align:center"><a class="btn rojo" role="button" id="prueba" name="prueba" onclick="eliminar_telefono(<?php echo $params[$i]['ID_Telefono'];?>);">
                                            Eliminar</a></td>

                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody> 
                    </table>
                </div>
            </div>
            <a href="index.php?ctl=personal_listar" class="btn btn-default" role="button">Volver</a> 
        </section>
        <?php require_once 'pie_de_pagina.php' ?>
        
        <!--agregar teléfono a la Persona-->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <!--Formulario para ingresar nuevos números de teléfono-->
                <form id="ventana" method="POST" name="form" action="index.php?ctl=personal_numero_telefono_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Agregar número de teléfono</h2>
                    <hr>
                    <input hidden id="ID_Telefono" name="ID_Telefono" type="text">
                    <input hidden id="ID_Persona" name="ID_Persona" type="text" value="<?php echo $params[0]['ID_Persona']; ?>">
                    
                    <label for="Tipo_Telefono">Tipo de Teléfono</label>
                    <select class="form-control espacio-abajo" id="Tipo_Telefono" name="Tipo_Telefono"> 
                        <?php
                        $tam = count($tipo_telefono);
                        for($i=0; $i<$tam;$i++)
                        {  
                            if($tipo_telefono[$i]['ID_Tipo_Telefono']==27||$tipo_telefono[$i]['ID_Tipo_Telefono']==2||
                                    $tipo_telefono[$i]['ID_Tipo_Telefono']==3||$tipo_telefono[$i]['ID_Tipo_Telefono']==4){?>
                                <option value="<?php echo $tipo_telefono[$i]['ID_Tipo_Telefono']?>" ><?php echo $tipo_telefono[$i]['Tipo_Telefono']?></option>   
                        <?php }}  ?>
                    </select>
                    <label for="numero">Número de Teléfono</label>
                    <input class="form-control espacio-abajo" maxlength="8" required id="numero" name="numero" placeholder="Número de teléfono - 8 digitos" type="text">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones del número"></textarea>
                    <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                </form>
            </div>
        <!--Cierre agregar teléfono a la persona-->
        </div>
        
        <!--Asignar UE a la Persona-->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla2" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">Unidad Ejecutora</th>
                                <th style="text-align:center">Departamento</th>
                                <th style="text-align:center">Observaciones</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                            $tam=count($todas_ue);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $todas_ue[$i]['Numero_UE'];?></td>
                                    <td style="text-align:center"><?php echo $todas_ue[$i]['Departamento'];?></td>
                                    <td style="text-align:center"><?php echo $todas_ue[$i]['Observaciones'];?></td>
                                    <td style="text-align:center"><a class="btn" role="button" onclick="cambiar_ue(<?php echo $todas_ue[$i]['ID_Unidad_Ejecutora'];?>);">
                                              Seleccionar UE</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <!--Cierre Asignar UE a la Persona-->
        </div> 
        
        <!--Asignar Puesto a la persona-->
        <div id="ventana_oculta_3">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla3" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">ID Puesto</th>
                                <th style="text-align:center">Puesto</th>
                                <th style="text-align:center">Observaciones</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($puestos);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $puestos[$i]['ID_Puesto'];?></td>
                                    <td style="text-align:center"><?php echo $puestos[$i]['Puesto'];?></td>
                                    <td style="text-align:center"><?php echo $puestos[$i]['Observaciones'];?></td>
                                    <td style="text-align:center"><a class="btn" role="button" onclick="cambiar_puesto(<?php echo $puestos[$i]['ID_Puesto'];?>);">
                                                Seleccionar Puesto</a></td>
                                </tr>
                            <?php } ?>
                         </tbody>
                    </table>
                </div>
            </div>
        <!--Cierre Asignar UE a la persona-->
        </div>
    </body>
</html>