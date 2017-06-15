<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Puestos de Monitoreo</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <script>
            $(document).ready(function () {
                if ( $.fn.dataTable.isDataTable('#tabla') ) {
                    table = $('#tabla').DataTable();
                }
                table.destroy();
                table = $('#tabla').DataTable({
                    stateSave: true,
                    "lengthMenu": [[10, 25, 50,100,-1], [10, 25, 50,100,"All"]]
                });     
            });
            
            //Funcion para ocultar ventana de mantenimiento de proveedor
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_1').style.display = "none";
                document.getElementById('ventana_oculta_5').style.display = "none";
            }
            
            //Valida informacion completa de formulario de proveedor
            function check_empty() {
                if (document.getElementById('nombre').value =="") {
                    alert("Digita el nombre del Puesto de Monitoreo!");
                } else {
                    if (isNaN(document.getElementById('tiempo_estandar_revision').value)) {
                        alert("Digita un valor númerico para el tiempo estándar del puesto de monitoreo!");
                    }  else{ 
                        document.getElementById('ventana').submit();
                        document.getElementById('ventana_oculta_1').style.display = "none";
                    }
                }
            }
            
            //Funcion para agregar un nuevo tipo de telefono- formulario en blanco
            function mostrar_agregar_puesto_monitoreo() {
                document.getElementById('ID_Puesto_Monitoreo').value="0";
                document.getElementById('nombre').value=null;
                document.getElementById('descripcion').value=null;
                document.getElementById('observaciones').value=null;
                document.getElementById('ventana_oculta_1').style.display = "block";
            }
            //Funcion para editar informacion de tipo telefono
            function Editar_Puesto_Monitoreo(id_puest,nomb,descrip,obser,tiempo){
                document.getElementById('ID_Puesto_Monitoreo').value=id_puest;
                document.getElementById('nombre').value=nomb;
                document.getElementById('descripcion').value=descrip;
                document.getElementById('observaciones').value=obser;
                document.getElementById('tiempo_estandar_revision').value=tiempo;
                document.getElementById('tiempo_revision_original').value=tiempo;
                document.getElementById('ventana_oculta_1').style.display = "block";
            }
           
            function tomar_puesto_de_monitoreo(id_puesto,nom){
                //alert(nom);
                $.confirm({
                    title: 'Confirmación!',
                    content: 'Desea tomar el puesto de monitoreo: '+nom+' ?',
                    confirm: function(){
                        $.post("index.php?ctl=tomar_puesto_de_monitoreo", {id_puesto: id_puesto},function(data){
                            var srt = data;
                            var n= srt.search("Inactivo");
                           //alert(data);
                            if(n>0){
                                $.alert({
                                    title: 'Información!',
                                    content: 'Este puesto de monitoreo se encuentra inactivo, favor notifique a su Supervisor!!!',
                                });
                            }else{
                                n= srt.search("En otro puesto");
                                if(n>0){
                                    $.alert({
                                        title: 'Información!',
                                        content: 'Solo es posible tener como máximo un puesto de monitoreo a la vez. Por favor libere el actual!!!',
                                    });
                                }else{
                                    n= srt.search("Ocupado");
                                    if(n>0){
                                        $.alert({
                                            title: 'Información!',
                                            content: 'Este puesto se encuentra bloqueado, no es posible tomarlo!!! Solamente la Persona que lo tiene o un Encargado lo puede liberar.',
                                        });
                                    }else{
                                        n= srt.search("Sin_Unidades");
                                        if(n>0){
                                            $.alert({
                                                title: 'Información!',
                                                content: 'Este puesto de monitoreo no tiene unidades de video asignadas para revisar. Favor contacte a su Supervisor!!!',
                                            });
                                        }else{
                                            $.alert({
                                                title: 'Información!',
                                                content: 'Puesto tomado exitosamente!!!',
                                                });
                                            //     alert(data);
                                            //     location.reload(); 
                                            document.location.href="index.php?ctl=controles_de_video_listar";
                                        }
                                    }
                                }
                            }
                        });  
                    },
                    cancel: function(){
              
                    }
                });
            }
            function mostrar_distribucion_de_unidades_de_video_en_puestos_de_monitoreo() {
                document.getElementById('ventana_oculta_5').style.display = "block";
            }    
            function liberar_puesto_de_monitoreo(id_puesto,nom,id_us){
                 //alert(id_us);
                var bandera=0;
                <?php 
                //Solamente los coordinadores ven esta opcion de agregar mezclas
                if($_SESSION['modulos']['Catálogos-Puestos de Monitoreo']==1){ ?>
                    bandera=1;
                <?php }else{ ?>
                    if (id_us==<?php echo $_SESSION['id'];?>){
                        bandera=1;
                    }
                    //
                <?php }?>

                if (bandera==1){
                    $.confirm({
                        title: 'Confirmación!',
                        content: 'Desea liberar el puesto de monitoreo: '+nom+' ?',
                        confirm: function(){
                            $.post("index.php?ctl=liberar_puesto_de_monitoreo", {id_puesto: id_puesto},function(data){
                                var srt = data;
                                var n= srt.search("liberado");

                                if(n>0){
                                    $.alert({
                                        title: 'Información!',
                                        content: 'Puesto liberado correctamente!!!',
                                    });
                                    location.reload();
                                }else{
                                    //alert(data);
                                    alert("No fue posible liberar este puesto de monitoreo!!!Contacte a su Supervisor.");
                                }
                            });  
                        },
                        cancel: function(){
                        }
                    });
                }else{
                    alert("No puedes liberar este puesto de monitoreo!!!Contacte a su Supervisor.");
                }

            }
            
        </script>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container animated fadeIn col-xs-10 quitar-float">
            <h2>Listado General de Puestos de Monitoreo (Control de Video)</h2>
            <?php if ($_SESSION['modulos']['Catálogos-Inconsistencias de Video']==1){ ?>
                <h4><a href="index.php?ctl=inconsistencias_de_video_listar">Inconsistencias de Video</a></h4>             
            <?php };?>   

            <p>A continuación se detallan los diferentes puestos de monitoreo registrados en el sistema:</p>            
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden="hidden">ID_Puesto_Monitoreo</th>
                        <th style="text-align:center">Nombre</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Usuario Actual</th>
                        <th style="text-align:center">Observaciones</th>
                        <?php if ($_SESSION['modulos']['Catálogos-Puestos de Monitoreo']==1){?>  
                            <th style="text-align:center">Tiempo Estándar Revisión (Segundos)</th>
                            <th style="text-align:center">Total de Unidades</th>
                            <th style="text-align:center">Total Cámaras</th>
                            <th style="text-align:center">Total Minutos</th>
                            <th style="text-align:center">Estado</th>
                            <th style="text-align:center">Cambiar Estado</th>
                            <th style="text-align:center">Mantenimiento</th>
                            <th style="text-align:center">Control de Video</th>
                        <?php }?>
                        <th style="text-align:center">Tomar</th>
                        <th style="text-align:center">Liberar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($params);  
                    for ($i = 0; $i <$tam; $i++) {
                        $bandera=0;
                        if ($params[$i]['Estado']==1){
                            $bandera=1;
                        }else{
                            if (($params[$i]['Estado']==0)&&($_SESSION['modulos']['Catálogos-Puestos de Monitoreo']==1)){
                                $bandera=1;
                            }
                        }
                        if ($bandera==1){ ?>
                            <tr>
                                <td hidden="hidden"><?php echo $params[$i]['ID_Puesto_Monitoreo'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Nombre'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Descripcion'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Nombre_Completo'];?></td>
                                <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                                <?php if ($_SESSION['modulos']['Catálogos-Puestos de Monitoreo']==1){?> 
                                    <td style="text-align:center"><?php echo $params[$i]['Tiempo_Estandar_Revision'];?></td>
                                    <td style="text-align:center"><?php echo $vector_estadisticas[$i]['Total_Unidades'];?></td>
                                    <td style="text-align:center"><?php echo $vector_estadisticas[$i]['Total_Camaras'];?></td>
                                    <td style="text-align:center"><?php echo $vector_estadisticas[$i]['Total_Minutos'];?></td>
                                    <?php if ($params[$i]['Estado']==1){?>  
                                        <td style="text-align:center">Activo</td>
                                    <?php }else {?>  
                                        <td style="text-align:center">Inactivo</td>
                                    <?php }?>
                                    <td style="text-align:center"><a href="index.php?ctl=puesto_monitoreo_cambiar_estado&id=<?php echo $params[$i]['ID_Puesto_Monitoreo']?>&estado=<?php echo $params[$i]['Estado']?>">
                                        Activar/Desactivar</a>
                                    </td>

                                    <td style="text-align:center"><a role="button" onclick="Editar_Puesto_Monitoreo('<?php echo $params[$i]['ID_Puesto_Monitoreo'];?>','<?php echo $params [$i]['Nombre'];?>',
                                        '<?php echo $params [$i]['Descripcion'];?>','<?php echo $params [$i]['Observaciones'];?>','<?php echo $params [$i]['Tiempo_Estandar_Revision'];?>')">Editar</a>
                                    </td>

                                    <td style="text-align:center"><a href="index.php?ctl=puestos_de_monitoreo_editar&id=<?php echo $params[$i]['ID_Puesto_Monitoreo']?>&tiempo_revision=<?php echo $params[$i]['Tiempo_Estandar_Revision']?>&nombre=<?php echo $params[$i]['Nombre']?>">
                                       Lista de Unidades</a>
                                    </td>
                                <?php } ?>
                                <?php if ($params[$i]['Nombre_Completo']=="Libre"){?>  
                                    <td style="text-align:center"><a href="#" onclick="tomar_puesto_de_monitoreo('<?php echo $params[$i]['ID_Puesto_Monitoreo'];?>','<?php echo $params[$i]['Nombre'];?>');">Tomar Puesto</a></td>
                                <?php }else {?>  
                                    <td style="text-align:center"></td>
                                <?php }?>
                                <?php if ($params[$i]['Nombre_Completo']=="Libre"){?>  
                                    <td style="text-align:center"></td>
                                <?php }else {?>  
                                    <td style="text-align:center"><a href="#" onclick="liberar_puesto_de_monitoreo('<?php echo $params[$i]['ID_Puesto_Monitoreo'];?>','<?php echo $params[$i]['ID_Usuario'];?>','<?php echo $params[$i]['ID_Usuario'];?>');">Liberar Puesto</a></td>
                                <?php }?>       
                            </tr>     
                        <?php }
                    } ?>
                </tbody>
            </table>

            <?php if ($_SESSION['modulos']['Catálogos-Puestos de Monitoreo']==1){ ?>
                <h4><a role="button" onclick="mostrar_distribucion_de_unidades_de_video_en_puestos_de_monitoreo();">Distribución de Unidades de Video en Puestos de Monitoreo</a></h4>             
            <?php };?> 

            <?php if ($_SESSION['modulos']['Catálogos-Puestos de Monitoreo']==1){ ?>
                <a id="popup" onclick="mostrar_agregar_puesto_monitoreo()" class="btn btn-default" role="button">Agregar Nuevo Puesto de Monitoreo</a>
            <?php };?>   
        </div>
        
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        
        <!--agregar o editar-->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <!--Formulario para proveedor de enlaces de telecomunicaciones-->
                <form id="ventana" method="POST" name="form" action="index.php?ctl=puesto_monitoreo_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Puesto de Monitoreo</h2>
                    <hr>
                    
                    <input hidden id="ID_Puesto_Monitoreo" name="ID_Puesto_Monitoreo" type="text">
                    <input hidden id="tiempo_revision_original" name="tiempo_revision_original" type="text">
                    
                    <label for="nombre">Nombre</label>
                    <input class="form-control espacio-abajo" required id="nombre" name="nombre" placeholder="Nombre" type="text">
                    
                    <label for="descripcion">Descripción</label>
                    <input class="form-control espacio-abajo" required id="descripcion" name="descripcion" placeholder="Descripción" type="text">
                    
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones del Puesto">
                    
                    <label for="tiempo_estandar_revision">Tiempo Estándar Revisión (Unidad Segundos)</label>
                    <input class="form-control espacio-abajo" required id="tiempo_estandar_revision" name="tiempo_estandar_revision" placeholder="Tiempo Estándar en Segundos" type="text">
                   
                    <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                </form>
            </div>
        <!--Cierre agregar teléfono a Punto BCR-->
        </div>
       
        <div id="ventana_oculta_5">
            <div id="popupventana2">
                <div id="ventana2">
                <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla4" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">Unidad de Video</th>
                                <th style="text-align:center">Cantidad Puestos</th>
                                <th style="text-align:center">Nombre Puestos</th>
                                <th style="text-align:center">Cámaras</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tama=count($vector_distribucion_unidades);
                            for ($i = 0; $i <$tama; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $vector_distribucion_unidades[$i]['descrip'];?></td>
                                    <td style="text-align:center"><?php echo $vector_distribucion_unidades[$i]['Cantidad_Puestos'];?></td>
                                    <td style="text-align:center"><?php echo $vector_distribucion_unidades[$i]['Lista_Puestos'];?></td>
                                    <td style="text-align:center"><?php echo $vector_distribucion_unidades[$i]['Camaras_Habilitadas'];?></td>
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
