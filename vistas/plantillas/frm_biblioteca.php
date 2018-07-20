<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Documentos</title>
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
            function mostrar_agregardocumento(){
                document.getElementById('ID_Biblioteca').value=null;
                document.getElementById('ruta2').value=null;
                document.getElementById('mod_file').checked =true;
                document.getElementById('mod_fileD').style.display="none";
                document.getElementById('ventana_oculta_3').style.display = "block";
            }
            
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_3').style.display = "none";
            }
            function validar_area(){
                if (document.getElementById('Nombre').value == "" || document.getElementById('Descripcion').value == "") {
                    alert("Digita el Nombre y la descripción del documento !");                   
                } else {                    
                    //alert("Form Submitted Successfully...");
                    document.getElementById('nuevo_documento').submit();
                    document.getElementById('ventana_oculta_3').style.display = "none";
                }
            }
            function Editar_Documento(pid_biblioteca,pnombre, ptipodocumento,pseguridad,plink,pdescripcion,pArchivo,pEstado){
                document.getElementById('ID_Biblioteca').value=pid_biblioteca;                
                document.getElementById('Nombre').value=pnombre;                               
                $("#Tipo_Documento option[value='"+ptipodocumento+"']").attr("selected",true);
                document.getElementById('Link').value=plink;
                document.getElementById('Descripcion').value=pdescripcion;
                document.getElementById('ventana_oculta_3').style.display = "block";
                document.getElementById('ruta2').value=pArchivo;
                document.getElementById('Archivo').value=pArchivo;
                document.getElementById('mod_file').checked =false;
                document.getElementById('mod_fileD').style.display="block";
                $("#Seguridad option[value='"+pseguridad+"']").attr("selected",true);
                $("#Estado option[value='"+pEstado+"']").attr("selected",true);                
            };
            
        </script>            
    </head>
    <body>
        <?php require_once 'encabezado.php';?>

           <div class="container animated fadeIn col-xs-10 quitar-float">
               <h2>Listado de Documentos</h2>
               <p>A continuación se detallan los documentos que están registrados en el sistema:</p>
               <table id="tabla" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th hidden="true">ID_Biblioteca</th>                        
                        <th hidden="true">Tipo_Documento</th>
                        <th hidden="true">Seguridad</th>
                        <th style="text-align:center">Nombre</th>
                        <th style="text-align:center">Tipo Documento</th>
                        <th style="text-align:center">Archivo</th>                        
                        <th style="text-align:center">Link</th>
                        <th style="text-align:center">Fecha Hora</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Estado</th>
                        <th style="text-align:center">Seguridad</th>
                        <?php if($_SESSION['modulos']['Editar- Biblioteca']==1){ ?>
                            <th style="text-align:center">Mantenimiento</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    $tam=count($biblioteca);
                    for ($i = 0; $i <$tam; $i++) { 
                        $fecha_biblioteca = date_create( $biblioteca[$i]['Fecha_Hora']);
                        ?>                        
                        <tr data-toggle="tooltip" title="<?php echo $biblioteca[$i]['Nombre'];?>">
                            <td style="text-align:center" hidden><?php echo $biblioteca[$i]['ID_Biblioteca'];?></td>
                            <td style="text-align:center" hidden><?php echo $biblioteca[$i]['Tipo_Documento'];?></td>
                            <td style="text-align:center" hidden><?php echo $biblioteca[$i]['Seguridad'];?></td>
                            <td style="text-align:center"><?php echo $biblioteca[$i]['Nombre'];?></td>
                            <td style="text-align:center"><?php echo $biblioteca[$i]['Tipo_DocumentoDes'];?></td>
                            <?php
                             if (strlen($biblioteca[$i]['Archivo'])==3){ ?>
                                    <td><?php echo $biblioteca[$i]['Archivo'];?></td>
                                <?php }else { ?>
                                    <td><a href="../../../Biblioteca_Archivos/<?php echo $biblioteca[$i]['Archivo'];?>" download="<?php echo $biblioteca[$i]['Archivo'];?>"><img src="vistas/Imagenes/Descargar.png" class="img-rounded" alt="Cinque Terre" width="15" height="15"></a></td>                                    
                                <?php } ?>                            
                            
                            <td style="text-align:center"><?php echo $biblioteca[$i]['Link'];?></td>                            
                            <td style="text-align:center"><?php echo date_format($fecha_biblioteca , 'Y/m/d');?></td>
                            <td style="text-align:center"><?php echo $biblioteca[$i]['Descripcion'];?></td>
                            <?php if ($biblioteca[$i]['Estado']==1){?>
                                <td style="text-align:center">Activo</td>
                            <?php }else {?>
                                <td style="text-align:center">Inactivo</td>
                            <?php }?>
                                
                            <td style="text-align:center"><?php echo $biblioteca[$i]['SeguridadDes'];?></td>
                            <?php if($_SESSION['modulos']['Editar- Biblioteca']==1){ ?>
                                <td style="text-align:center"><a onclick="Editar_Documento(<?php echo $biblioteca[$i]['ID_Biblioteca'];?>,'<?php echo $biblioteca[$i]['Nombre'];?>','<?php echo $biblioteca[$i]['Tipo_Documento'];?>','<?php echo $biblioteca[$i]['Seguridad'];?>','<?php echo $biblioteca[$i]['Link'];?>','<?php echo $biblioteca[$i]['Descripcion'];?>','<?php echo $biblioteca[$i]['Archivo'];?>','<?php echo $biblioteca[$i]['Estado'];?>')">Editar</a></td>
                            <?php } ?>
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
                        <input hidden id="ruta2" name="ruta2" type="text">
                        <input hidden id="Archivo" name="Archivo" type="text">
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="Nombre">Nombre del documento</label>
                            <input type="text" required="nombre" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre del documento" value="">
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="Tipo_Documento">Tipos Documentos</label>
                            <select class="form-control" id="Tipo_Documento" name="Tipo_Documento">
                                <option value="1">Normativa</option>
                                <option selected="true" value="2">Manuales</option>
                                <option value="3">Noticias</option>
                                <option value="4">Otros</option>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="Seguridad">Seguridad</label>
                            <select class="form-control" id="Seguridad" name="Seguridad">
                                <option selected="true" value="4">General</option>
                                <option value="1">Privado</option>
                                <option value="2">Coordinación BCR</option>
                                <option value="3">Coordinación Empresa</option>                                
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
                        <div class="col-md-6 espacio-abajo-5" id="archivo_adjunto">
                                <label for="archivo_adjunto">Adjuntar Archivo: </label>
                                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                <input type="file" name="archivo_adjunto" id="seleccionar_archivo" class="btn btn-default">
                        </div>
                         <div class="col-md-6 espacio-abajo-5">
                            <label for="sel1">Estado</label>
                            <select class="form-control" id="Estado" name="Estado"> 
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-md-12 has-sucess espacio-abajo-5" >
                            <div id="mod_fileD" name="mod_fileD" class="checkbox">
                                <br>
                                <label for="mod_file"><input id="mod_file" name="mod_file" type="checkbox" value="1">Modificar archivo</label>
                            </div>
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
