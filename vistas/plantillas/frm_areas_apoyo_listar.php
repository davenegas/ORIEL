<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Áreas de Apoyo</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <script>
            $(document).ready(function () {
                if ( $.fn.dataTable.isDataTable('#tabla') ) {
                    table = $('#tabla').DataTable();
                }
                table.destroy();
                table = $('#tabla').DataTable( {
                    "lengthMenu": [[10, 25, 50,100,-1], [10, 25, 50,100,"All"]]
                });        
            });
            
            function mostrar_area_apoyo(){
                document.getElementById('ventana_oculta_3').style.display = "block";
            }

            function validar_area(){
                if (document.getElementById('nombre').value == "" || document.getElementById('numero').value == "") {
                    alert("Digita el nombre y el número de teléfono del área de apoyo !");
                } else {
                    //alert("Form Submitted Successfully...");
                    document.getElementById('nueva_area_apoyo').submit();
                    document.getElementById('ventana_oculta_3').style.display = "none";
                }
            }
            
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_3').style.display = "none";
            }
            
            $(document).ready(function(){
                //Buscar Distritos al seleccionar cantón
                $("#Provincia").change(function () {
                    $("#Provincia option:selected").each(function () {
                        id_provincia = $(this).val();
                        //id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
                        $.post("index.php?ctl=actualiza_en_vivo_canton", { id_provincia: id_provincia}, function(data){
                            $("#Canton").html(data);
                        });            
                    });
                });

                //Buscar Distritos al seleccionar cantón
                $("#Canton").change(function () {
                    $("#Canton option:selected").each(function () {
                        id_canton = $(this).val();
                        //id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
                        $.post("index.php?ctl=actualiza_en_vivo_distrito", { id_canton: id_canton}, function(data){
                            $("#Distrito").html(data);  
                        });            
                    });
                });
            });
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container">
            <h2>Listado General de Áreas de Apoyo</h2>

            <p>A continuación se detallan los diferentes tipos de áreas de apoyo que están registrados en el sistema:</p>            
            <table id="tabla" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID Area</th>
                        <th style="text-align:center">Nombre Área</th>
                        <th style="text-align:center">Tipo de Área</th>
                        <th style="text-align:center">Observaciones</th>
                        <th style="text-align:center">Dirección</th>
                        <th style="text-align:center">Número</th>
                        <?php if($_SESSION['modulos']['Editar- Áreas Apoyo']==1){ ?>
                            <th style="text-align:center">Mantenimiento</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($params);
                    for ($i = 0; $i <$tam; $i++) { ?>
                        <tr>
                            <td hidden style="text-align:center"><?php echo $params[$i]['ID_Area_Apoyo'];?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Nombre_Area'];?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Nombre_Tipo_Area'];?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Direccion'];?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Numero'];?></td>
                            <?php if($_SESSION['modulos']['Editar- Áreas Apoyo']==1){?>
                                <td style="text-align:center"><a href="index.php?ctl=area_apoyo_gestion&id=
                                    <?php echo $params[$i]['ID_Area_Apoyo']?>">
                                        Editar</a></td>
                                <?php } ?>
                         </tr>     
                    <?php } ?>
                </tbody>
            </table>
            <a  id="popup" onclick="mostrar_area_apoyo()" class="btn btn-default" role="button">Agregar Nueva Area de Apoyo</a>
        </div>
        
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        
        <!--Agregar o asignar areas de apoyo-->
        <div id="ventana_oculta_3">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Agregar nueva área de apoyo</h2>
                    <form class="bordegris" id="nueva_area_apoyo" method="post" name="form" action="index.php?ctl=Area_apoyo_agregar">
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="nombre">Nombre de Área Apoyo</label>
                            <input type="text" required="nombre" class="form-control" id="nombre" name="nombre" placeholder="Nombre del area de apoyo">
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="Tipo_Area_Apoyo">Tipo de Área</label>
                            <select class="form-control" id="Tipo_Area_Apoyo" name="Tipo_Area_Apoyo"> 
                                <?php
                                $tam = count($tipos_areas_apoyo);
                                for($i=0; $i<$tam;$i++){  ?>
                                    <option value="<?php echo $tipos_areas_apoyo[$i]['ID_Tipo_Area_Apoyo']?>" ><?php echo $tipos_areas_apoyo[$i]['Nombre_Tipo_Area']?></option>   
                                <?php }  ?>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="observaciones">Observaciones</label>
                            <input type="text" class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones del área de apoyo">
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="Provincia">Provincia</label>
                            <select class="form-control" id="Provincia" name="Provincia" > 
                                <?php
                                $tam = count($provincias);

                                for($i=0; $i<$tam;$i++){
                                    if($provincias[$i]['ID_Provincia']==$cantones[$distritos[$params[0]['ID_Distrito']]['ID_Canton']]['ID_Provincia']){ ?>
                                        <option value="<?php echo $provincias[$i]['ID_Provincia']?>" selected="selected"><?php echo $provincias[$i]['Nombre_Provincia']?></option><?php
                                    }   else    {?>
                                        <option value="<?php echo $provincias[$i]['ID_Provincia']?>" ><?php echo $provincias[$i]['Nombre_Provincia']?></option>   
                                <?php }}  ?>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="Canton">Cantón</label>
                            <select class="form-control" id="Canton" name="Canton" > 
                                <?php
                                $tam = count($cantones);
                                for($i=0; $i<$tam;$i++){
                                    if($cantones[$i]['ID_Canton']==$distritos[$params[0]['ID_Distrito']]['ID_Canton']){ ?> 
                                        <option value="<?php echo $cantones[$i]['ID_Canton']?>" selected="selected"><?php echo $cantones[$i]['Nombre_Canton']?></option><?php
                                    }   else {?>
                                        <option value="<?php echo $cantones[$i]['ID_Canton']?>" ><?php echo $cantones[$i]['Nombre_Canton']?></option>   
                                <?php }}  ?>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="Distrito">Distrito</label>
                            <select class="form-control" id="Distrito" name="Distrito"> 
                                <?php
                                $tam = count($distritos);
                                for($i=0; $i<$tam;$i++) {
                                    if($distritos[$i]['ID_Distrito']==$params[0]['ID_Distrito']){
                                       ?> <option value="<?php echo $distritos[$i]['ID_Distrito']?>" selected="selected"><?php echo $distritos[$i]['Nombre_Distrito']?></option><?php
                                    }   else    {?>
                                        <option value="<?php echo $distritos[$i]['ID_Distrito']?>" ><?php echo $distritos[$i]['Nombre_Distrito']?></option>   
                                <?php }}  ?>
                            </select>
                        </div>
                        <div class="col-md-12 espacio-abajo-5">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirreción del área de apoyo exacta">
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                        <label for="Tipo_Telefono">Tipo de Teléfono</label>
                            <select class="form-control" id="Tipo_Telefono" name="Tipo_Telefono"> 
                                <?php
                                $tam = count($tipo_telefono);
                                for($i=0; $i<$tam;$i++){  
                                    if($tipo_telefono[$i]['ID_Tipo_Telefono']==12||$tipo_telefono[$i]['ID_Tipo_Telefono']==13||$tipo_telefono[$i]['ID_Tipo_Telefono']==14||
                                        $tipo_telefono[$i]['ID_Tipo_Telefono']==15||$tipo_telefono[$i]['ID_Tipo_Telefono']==16||$tipo_telefono[$i]['ID_Tipo_Telefono']==17||
                                            $tipo_telefono[$i]['ID_Tipo_Telefono']==18||$tipo_telefono[$i]['ID_Tipo_Telefono']==19||$tipo_telefono[$i]['ID_Tipo_Telefono']==25
                                            ||$tipo_telefono[$i]['ID_Tipo_Telefono']==26){?>
                                        <option value="<?php echo $tipo_telefono[$i]['ID_Tipo_Telefono']?>" ><?php echo $tipo_telefono[$i]['Tipo_Telefono']?></option>   
                                <?php }}  ?>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="numero">Número</label>
                            <input type="text" maxlength="8" class="form-control" id="numero" name="numero" placeholder="Número de teléfono- 8 digitos">
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="observaciones_tel">Observaciones del número</label>
                            <input type="text" maxlength="8" class="form-control" id="observaciones_tel" name="observaciones_tel" placeholder="Observaciones del número: Ext, horario, otros">
                        </div>
                        <button class="quitar-float espacio-abajo espacio-arriba"><a href="javascript:%20validar_area()" id="submit">Guardar</a></button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>