<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Puntos BCR</title>
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
                <div class="col-md-4 espacio-abajo">
                    <label for="ID_Persona">ID Persona</label>
                    <input type="text" required="ID_Persona" readonly class="form-control" id="ID_Persona" name="ID_Persona" value="<?php echo $params[0]['ID_Persona'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="cedula">Cedula</label>
                    <input type="text" required="cedula" readonly class="form-control" id="cedula" name="cedula" value="<?php echo $params[0]['Cedula'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <IMG SRC="<?php echo $params[0]['Link_Foto'];?>" id="foto_personal">
                </div> 
                <div class="col-md-8 espacio-abajo quitar-float">
                    <label for="nombre">Nombre y Apellidos</label>
                    <input type="text" required readonly class="form-control" ALIGN="right" id="nombre" name="nombre" value="<?php echo $params[0]['Apellido_Nombre'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="Empresa">Empresa</label>
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
                
                <div class="col-md-4 espacio-abajo">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" required readonly class="form-control" id="observaciones" name="observaciones" value="<?php echo $params[0]['Observaciones'];?>">
                </div>
                <div class="col-md-8 espacio-abajo quitar-float">
                    <label for="unidad_ejecutora">Unidad Ejecutora
                        <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                            <a id="popup" onclick="mostrar_lista_ue()" class="btn azul" role="button">- Editar</a>
                        <?php } ?>
                    </label>
                    <input  type="text" required readonly class="form-control" id="nombre" name="nombre" value="<?php echo $params[0]['Departamento'];?>">
                </div>
                <div class="col-md-8 espacio-abajo">
                    <label for="puesto">Puesto
                         <?php if($_SESSION['modulos']['Editar- Personal']==1){ ?>
                        <a id="popup" onclick="mostrar_lista_puesto()" class="btn azul" role="button">- Editar</a>
                        <?php } ?>
                    </label>
                    <input type="text" required readonly class="form-control" id="nombre" name="nombre" value="<?php echo $params[0]['Puesto'];?>">
                </div>
                <div class="col-md-4 espacio-abajo espacio-arriba-15">
                    <label for="numero_gafete">Número de Carné</label>
                    <input type="text" required readonly class="form-control" id="numero_gafete" name="numero_gafete" value="<?php echo $params[0]['Numero_Gafete'];?>">
                </div>                
                <div class="col-md-8 espacio-abajo">
                    <label for="direccion">Dirección</label>
                    <input type="text" required readonly class="form-control" id="direccion" name="direccion" value="<?php echo $params[0]['Direccion'];?>">
                </div>
                <div class="col-md-4 espacio-abajo">
                    <label for="correo">Correo</label>
                    <input type="email" required readonly class="form-control" id="correo" name="correo" value="<?php echo $params[0]['Correo'];?>">
                </div>
            </div>
        </section>
        
        <!--Información de Número de teléfono de la persona-->
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
            <a href="index.php?ctl=personal_listar" class="btn btn-default espacio-arriba" role="button">Volver</a>
            <?php require_once 'pie_de_pagina.php' ?>
        </section>
        
        
        <!--agregar teléfono a la Persona-->
        <div id="agregar_telefono"> 
            <div id="popupventana">
                <!--Formulario para ingresar nuevos números de teléfono-->
                <form id="ventana" method="POST" name="form" action="index.php?ctl=personal_numero_telefono_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Agregar número de teléfono</h2>
                    <hr>
                    <input hidden id="ID_Telefono" name="ID_Telefono" type="text">
                    <input hidden id="ID_Persona" name="ID_Persona" type="text" value="<?php echo $params[0]['ID_Persona']; ?>">
                    
                    <label for="Tipo_Telefono">Tipo de Telefono</label>
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
        <!--Cierre agregar teléfono a Punto BCR-->
        </div>
        
        <!--Asignar UE a la Persona-->
        <div id="asignar_ue">
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
        <!--Cierre Asignar UE a Punto BRC-->
        </div> 
        
        <!--Asignar Puesto a la persona-->
        <div id="asignar_area">
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
        <!--Cierre Asignar UE a Punto BRC-->
        </div>
    </body>
</html>