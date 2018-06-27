<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Roles</title>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html';?>
        <script>
            function mostrar_agregardocumento(){
                document.getElementById('ventana_oculta_3').style.display = "block";
            }
            
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_3').style.display = "none";
            }
            function validar_area(){                
                if (document.getElementById('Nombre').value == "" || document.getElementById('Link').value == "" || document.getElementById('Descripcion').value == "") {
                    alert("Digita el Nombre, Link y la descripción del documento !");
                } else {
                    //alert("Form Submitted Successfully...");
                    document.getElementById('nuevo_documento').submit();
                    document.getElementById('ventana_oculta_3').style.display = "none";
                }
            }
            function Editar_Documento(pid_biblioteca,pnombre, ptipodocumento,pseguridad,plink,pdescripcion){
                document.getElementById('ID_Biblioteca').value=pid_biblioteca;
                document.getElementById('Nombre').value=pnombre;                               
                $("#Tipo_Documento option[value='"+ptipodocumento+"']").attr("selected",true);
                document.getElementById('Link').value=plink;
                document.getElementById('Descripcion').value=pdescripcion;
                document.getElementById('ventana_oculta_3').style.display = "block";
                $("#Seguridad option[value='"+pseguridad+"']").attr("selected",true);                
            };
        </script>            
    </head>
    <body>
        <?php require_once 'encabezado.php';?>

           <div class="container animated fadeIn col-xs-10 quitar-float">
            <div class="col-md-5">
                <h2>Listado de Documentos</h2>                
            </div>

               <table id="tabla" class="display">
                <thead>
                    <tr>
                        <th hidden="true">ID_Biblioteca</th>                        
                        <th style="text-align:center">Nombre</th>
                        <th style="text-align:center">Tipo Documento</th>
                        <th style="text-align:center">Archivo</th>                        
                        <th style="text-align:center">Link</th>
                        <th style="text-align:center">Fecha Hora</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Seguridad</th>
                        <th style="text-align:center">Mantenimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($biblioteca);
                    for ($i = 0; $i <$tam; $i++) { 
                        $fecha_biblioteca = date_create( $biblioteca[$i]['Fecha_Hora']);
                        ?>                        
                        <tr data-toggle="tooltip" title="<?php echo $biblioteca[$i]['Nombre'];?>">
                            <td style="text-align:center" hidden="true"><?php echo $biblioteca[$i]['ID_Biblioteca'];?></td>
                            <td style="text-align:center" hidden="true"><?php echo $biblioteca[$i]['Tipo_Documento'];?></td>
                            <td style="text-align:center" hidden="true"><?php echo $biblioteca[$i]['Seguridad'];?></td>
                            <td style="text-align:center"><?php echo $biblioteca[$i]['Nombre'];?></td>
                            <td style="text-align:center"><?php echo $biblioteca[$i]['Tipo_DocumentoDes'];?></td>
                            <?php
                             if (strlen($biblioteca[$i]['Archivo'])==3){ ?>
                                    <td><?php echo $biblioteca[$i]['Archivo'];?></td>
                                <?php }else { ?>
                                    <td><a href="../../../Adjuntos_Bitacora/<?php echo $biblioteca[$i]['Archivo'];?>" download="<?php echo $biblioteca[$i]['Archivo'];?>"><img src="vistas/Imagenes/Descargar.png" class="img-rounded" alt="Cinque Terre" width="15" height="15"></a></td>                                    
                                <?php } ?>                            
                            
                            <td style="text-align:center"><?php echo $biblioteca[$i]['Link'];?></td>                            
                            <td style="text-align:center"><?php echo date_format($fecha_biblioteca , 'Y/m/d');?></td>
                            <td style="text-align:center"><?php echo $biblioteca[$i]['Descripcion'];?></td>
                            <td style="text-align:center"><?php echo $biblioteca[$i]['SeguridadDes'];?></td>
                            <td style="text-align:center"><a role="button" onclick="Editar_Documento(<?php echo $biblioteca[$i]['ID_Biblioteca'];?>,'<?php echo $biblioteca[$i]['Nombre'];?>','<?php echo $biblioteca[$i]['Tipo_Documento'];?>','<?php echo $biblioteca[$i]['Seguridad'];?>','<?php echo $biblioteca[$i]['Link'];?>','<?php echo $biblioteca[$i]['Descripcion'];?>')">Editar</a></td>
                        </td>
                    </tr>
                    <?php }  ?>
                </tbody>
            </table>
               <a  id="popup" onclick="mostrar_agregardocumento()" class="btn btn-default" role="button">Agregar Documento</a>
        </div>        
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        
          <!--Agregar o asignar areas de apoyo-->
        <div id="ventana_oculta_3">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Agregar nuevo documento</h2>
                    <form class="form-horizontal" id="nuevo_documento" role="form" enctype="multipart/form-data" onSubmit="return enviado()" method="POST" action="index.php?ctl=guardar_Biblioteca">
                        <input hidden id="ID_Biblioteca" name="ID_Biblioteca" type="text">
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="Nombre">Nombre del documento</label>
                            <input type="text" required="nombre" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre del documento" value="">
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="Tipo_Documento">Tipos Documentos</label>
                            <select class="form-control" id="Tipo_Documento" name="Tipo_Documento">
                                <option value="1">Normativa</option>
                                <option value="2">Manuales</option>
                                <option value="3">Noticias</option>
                                <option value="4">Otros</option>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="Seguridad">Seguridad</label>
                            <select class="form-control" id="Seguridad" name="Seguridad">
                                <option value="1">Privado</option>
                                <option value="2">Coordinación BCR</option>
                                <option value="3">Coordinación Empresa</option>
                                <option value="4">General</option>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="Link">Link</label>
                            <input type="text" class="form-control" id="Link" name="Link" placeholder="Link" value="">
                        </div>
                        <div class="col-md-8 espacio-abajo-5">
                            <label for="Descripcion">Descripción</label>
                            <textarea type="text" class="form-control" id="Descripcion" name="Descripcion" placeholder="Descripción del documento" value=""></textarea>
                        </div>
                        <div class="col-md-8 espacio-abajo-5" id="archivo_adjunto">
                                <label for="archivo_adjunto">Adjuntar Archivo: </label>
                                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                <input type="file" name="archivo_adjunto" id="seleccionar_archivo" class="btn btn-default">
                            </div>
                        
                        <div class="row">
                        </div>
                        <div>                            
                            <button class="quitar-float espacio-abajo espacio-arriba"><a href="javascript:%20validar_area()" id="submit">Guardar</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>