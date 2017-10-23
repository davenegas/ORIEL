<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Áreas de Apoyo</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_areas_apoyo.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
    </head>
    <body>
        <?php require_once 'encabezado.php'; ?>
        <div class="container">
            <h2>Gestión de Áreas de Apoyo del Sistema</h2>
            <p>Mediante esta pantalla, podrá agregar o editar Áreas de Apoyo del sistema:</p>
            <div class="container">
                <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=area_apoyo_actualizar&id=<?php echo $params[0]['ID_Area_Apoyo'];?>">
                    <div class="col-md-6 espacio-abajo">
                        <label for="Nombre">Nombre Área</label>
                        <input type="text" required="required" class="form-control" id="Nombre" name="Nombre" value="<?php echo $params[0]['Nombre_Area'];?>">
                    </div>

                    <div class="col-md-6 espacio-abajo">
                        <label for="tipo_area">Tipo de Área</label>
                        <select class="form-control" id="tipo_area" name="tipo_area" > 
                            <?php
                            $tam = count($tipo_area);
                            for($i=0; $i<$tam;$i++){
                                if($tipo_area[$i]['ID_Tipo_Area_Apoyo']==$params[0]['ID_Tipo_Area_Apoyo']){ ?> 
                                    <option value="<?php echo $tipo_area[$i]['ID_Tipo_Area_Apoyo']?>" selected="selected"><?php echo $tipo_area[$i]['Nombre_Tipo_Area']?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $tipo_area[$i]['ID_Tipo_Area_Apoyo']?>" ><?php echo $tipo_area[$i]['Nombre_Tipo_Area']?></option>   
                                <?php }
                            } ?>
                        </select>
                    </div>

                    <div class="col-md-4 espacio-abajo">
                        <label for="Provincia">Provincia</label>
                        <select class="form-control" id="Provincia" name="Provincia" > 
                            <?php
                            $tam = count($provincias);

                            for($i=0; $i<$tam;$i++) {
                                if($provincias[$i]['ID_Provincia']==$cantones[$distritos[$params[0]['ID_Distrito']]['ID_Canton']]['ID_Provincia']){ ?>
                                    <option value="<?php echo $provincias[$i]['ID_Provincia']?>" selected="selected"><?php echo $provincias[$i]['Nombre_Provincia']?></option><?php
                                } else { ?>
                                    <option value="<?php echo $provincias[$i]['ID_Provincia']?>" ><?php echo $provincias[$i]['Nombre_Provincia']?></option>   
                                <?php }
                            }  ?>
                        </select>
                    </div>

                    <div class="col-md-4 espacio-abajo">
                        <label for="Canton">Cantón</label>
                        <select class="form-control" id="Canton" name="Canton" > 
                            <?php
                            $tam = count($cantones);

                            for($i=0; $i<$tam;$i++){
                                if($cantones[$i]['ID_Canton']==$distritos[$params[0]['ID_Distrito']]['ID_Canton']){ ?> 
                                    <option value="<?php echo $cantones[$i]['ID_Canton']?>" selected="selected"><?php echo $cantones[$i]['Nombre_Canton']?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $cantones[$i]['ID_Canton']?>" ><?php echo $cantones[$i]['Nombre_Canton']?></option>   
                                <?php }
                            } ?>
                        </select>
                    </div>

                    <div class="col-md-4 espacio-abajo">
                        <label for="Distrito">Distrito</label>
                        <select class="form-control" id="Distrito" name="Distrito" > 
                            <?php
                            $tam = count($distritos);
                            for($i=0; $i<$tam;$i++){
                                if($distritos[$i]['ID_Distrito']==$params[0]['ID_Distrito']){ ?> 
                                    <option value="<?php echo $distritos[$i]['ID_Distrito']?>" selected="selected"><?php echo $distritos[$i]['Nombre_Distrito']?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $distritos[$i]['ID_Distrito']?>" ><?php echo $distritos[$i]['Nombre_Distrito']?></option>   
                                <?php }
                            }  ?>
                        </select>
                    </div>

                    <div class="col-md-6 espacio-abajo">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $params[0]['Direccion'];?>">
                    </div>

                    <div class="col-md-6 espacio-abajo">
                        <label for="observaciones">Observaciones</label>
                        <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $params[0]['Observaciones'];?>">
                    </div>  

                    <div hidden class="col-md-4 espacio-abajo">
                        <label for="Estado">Estado</label>
                        <select class="form-control" id="Estado" name="Estado" >
                            <?php if ($params[0]['Estado']==1){ ?>
                                <option value="1" selected="selected">Activo</option>
                                <option value="0">Inactivo</option>  
                            <?php } else { ?>
                               <option value="1">Activo</option>
                               <option value="0" selected="selected">Inactivo</option>   
                            <?php } ?>  
                        </select>
                    </div> 
                    <!--Muestras los numero(s) de teléfono del area de apoyo-->
                    <!--si el area de apoyo no es nueva-->
                    <?php if($params[0]['ID_Area_Apoyo']!=0) { ?>
                    <div>
                        <?php if($_SESSION['modulos']['Editar- Áreas Apoyo']==1){ ?>
                            <h3 class="quitar-float">Información de teléfonos <a id="popup" onclick="mostrar_agregar_telefono()" class="btn azul" role="button">Agregar número</a></h3> 
                        <?php } else {?>
                            <h3 class="quitar-float">Información de teléfonos</h3>
                        <?php } ?>
                        <table class="display col-md-12 table-striped quitar-float espacio-abajo" id="telefonos">
                        <thead>
                            <th style="text-align:center">ID Teléfono</th>
                            <th style="text-align:center">Tipo de Teléfono</th>
                            <th style="text-align:center">Número teléfono</th>
                            <th style="text-align:center">Observaciones</th>
                            <?php if($_SESSION['modulos']['Editar- Áreas Apoyo']==1){ ?>
                            <th style="text-align:center" colspan="2">Opciones número</th>
                            <?php } ?>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($params);
                            for ($i = 0; $i <$tam; $i++) {
                            ?>
                            <tr>
                                <td style="text-align:center"><?php echo $params[$i]['ID_Telefono'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Tipo_Telefono'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Numero'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Observaciones_Tel'];?></td>
                                <?php if($_SESSION['modulos']['Editar- Áreas Apoyo']==1){  ?>
                                    <td style="text-align:center"><a class="btn azul" role="button" onclick="Editar_telefono(<?php echo $params[$i]['ID_Telefono'];?>,<?php echo $params[$i]['ID_Tipo_Telefono'];?>,'<?php echo $params[$i]['Numero'];?>','<?php echo $params[$i]['Observaciones_Tel'];?>')">
                                        Editar</a></td> 
                                    <td style="text-align:center"><a class="btn rojo" role="button" onclick="eliminar_telefono(<?php echo $params[$i]['ID_Telefono'];?>);">
                                        Eliminar</a></td>

                                <?php } ?>
                            </tr>
                            <?php } ?>
                        </tbody> 
                    </table>
                    </div>
                    <!--Solicita teléfono en caso de ser una nueva area de apoyo-->
                    <?php } ELSE { ?>
                            <div class="col-md-6 espacio-abajo-5">
                                <label for="Tipo_Telefono">Tipo de Teléfono</label>
                                    <select class="form-control" id="Tipo_Telefono" name="Tipo_Telefono"> 
                                    <?php
                                    $tam = count($tipo_telefono);
                                    for($i=0; $i<$tam;$i++)
                                    {  
                                        if($tipo_telefono[$i]['ID_Tipo_Telefono']==11||$tipo_telefono[$i]['ID_Tipo_Telefono']==12||
                                            $tipo_telefono[$i]['ID_Tipo_Telefono']==13||$tipo_telefono[$i]['ID_Tipo_Telefono']==14||
                                            $tipo_telefono[$i]['ID_Tipo_Telefono']==15||$tipo_telefono[$i]['ID_Tipo_Telefono']==16||
                                            $tipo_telefono[$i]['ID_Tipo_Telefono']==17|| $tipo_telefono[$i]['ID_Tipo_Telefono']==18||
                                            $tipo_telefono[$i]['ID_Tipo_Telefono']==19||$tipo_telefono[$i]['ID_Tipo_Telefono']==20||
                                            $tipo_telefono[$i]['ID_Tipo_Telefono']==21||$tipo_telefono[$i]['ID_Tipo_Telefono']==22||
                                            $tipo_telefono[$i]['ID_Tipo_Telefono']==24||$tipo_telefono[$i]['ID_Tipo_Telefono']==25||
                                            $tipo_telefono[$i]['ID_Tipo_Telefono']==26){?>
                                            <option value="<?php echo $tipo_telefono[$i]['ID_Tipo_Telefono']?>" ><?php echo $tipo_telefono[$i]['Tipo_Telefono']?></option>   
                                    <?php }}  ?>
                                    </select>
                                </div>
                                <div class="col-md-6 espacio-abajo-5">
                                    <label for="numero">Número</label>
                                    <input type="text" maxlength="8" class="form-control" id="numero" name="numero" placeholder="Número de teléfono- 8 digitos">
                                </div>
                    <?php } ?>
                <button type="submit" class="btn btn-default espacio-arriba" >Guardar</button>
                <td><a href="index.php?ctl=areas_apoyo_listar" class="btn btn-default espacio-arriba" role="button">Cancelar</a></td>
                </form> 
            </div>
        </div>  
        
        <!--agregar teléfono a la Persona-->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <!--Formulario para ingresar nuevos números de teléfono-->
                <form id="ventana" method="POST" name="form" action="index.php?ctl=area_apoyo_numero_telefono_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Agregar número de teléfono</h2>
                    <hr>
                    <input hidden id="ID_Telefono" name="ID_Telefono" type="text">
                    <input hidden id="ID_Area_Apoyo" name="ID_Area_Apoyo" type="text" value="<?php echo $params[0]['ID_Area_Apoyo']; ?>">
                    
                    <label for="Tipo_Telefono">Tipo de Teléfono</label>
                    <select class="form-control espacio-abajo" id="Tipo_Telefono" name="Tipo_Telefono"> 
                        <?php
                        $tam = count($tipo_telefono);
                        for($i=0; $i<$tam;$i++){  
                            if($tipo_telefono[$i]['ID_Tipo_Telefono']==11||$tipo_telefono[$i]['ID_Tipo_Telefono']==12||
                                    $tipo_telefono[$i]['ID_Tipo_Telefono']==13||$tipo_telefono[$i]['ID_Tipo_Telefono']==14||
                                    $tipo_telefono[$i]['ID_Tipo_Telefono']==15||$tipo_telefono[$i]['ID_Tipo_Telefono']==16||
                                    $tipo_telefono[$i]['ID_Tipo_Telefono']==17|| $tipo_telefono[$i]['ID_Tipo_Telefono']==18||
                                    $tipo_telefono[$i]['ID_Tipo_Telefono']==19||$tipo_telefono[$i]['ID_Tipo_Telefono']==20||
                                    $tipo_telefono[$i]['ID_Tipo_Telefono']==21||$tipo_telefono[$i]['ID_Tipo_Telefono']==22||
                                    $tipo_telefono[$i]['ID_Tipo_Telefono']==24||$tipo_telefono[$i]['ID_Tipo_Telefono']==25||
                                    $tipo_telefono[$i]['ID_Tipo_Telefono']==26){ ?>
                                <option value="<?php echo $tipo_telefono[$i]['ID_Tipo_Telefono']?>" ><?php echo $tipo_telefono[$i]['Tipo_Telefono']?></option>   
                            <?php } 
                        }  ?>
                    </select>
                    <label for="numero">Número de Teléfono</label>
                    <input class="form-control espacio-abajo" maxlength="8" required id="numero" name="numero" placeholder="Número de teléfono - 8 digitos" type="text">
                    <label for="observaciones_tel">Observaciones</label>
                    <textarea class="form-control espacio-abajo" id="observaciones_tel" name="observaciones_tel" placeholder="Observaciones del número"></textarea>
                    <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                </form>
            </div>
            <!--Cierre agregar teléfono a Punto BCR-->
        </div>
         
        <?php require_once 'pie_de_pagina.php' ?>     
    </body>   
</html>