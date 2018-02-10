<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Tipo de Eventos</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <script>
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_1').style.display = "none";
            }
            //Valida informacion completa de formulario de proveedor
            function check_empty() {
                if (document.getElementById('Descripcion').value == "") {
                    alert("Digita la descripcion del evento de cierre");
                } else {
                    //alert("Form Submitted Successfully...");
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana').submit();
                    document.getElementById('ventana_oculta_1').style.display = "none";
                }
            }
            //Funcion para agregar un nuevo proveedor- formulario en blanco
            function agregar_evento_cierre() {
                document.getElementById('ID_Tipo_Evento_Cierre').value="0";
                document.getElementById('Descripcion').value="";
                document.getElementById('ventana_oculta_1').style.display = "block";
            }
            //Funcion para editar informacion de proveedor
            function editar_evento_cierre(id_evento, descrip, estado){
                document.getElementById('ID_Tipo_Evento_Cierre').value=id_evento;
                document.getElementById('Descripcion').value=descrip;
                $("#estado option[value="+estado+"]").attr("selected",true);
                document.getElementById('ventana_oculta_1').style.display = "block";
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Gestión de Tipo de Eventos</h2>
            <p>Mediante esta pantalla, podrá agregar o editar los tipos de evento:</p>
            <div class="container">
                <!--Gestión de tipo de evento-->
                <div class="col-sm-12 well">
                    <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=tipo_eventos_guardar&id=<?php echo trim($ide);?>">
                        <input type="text" hidden id="ID_Evento" name="ID_Evento" value="<?php echo trim($ide);?>">
                        <div class="row espacio-abajo">
                            <div class="col-sm-6">
                                <label for="evento">Nombre del Evento</label>
                                <input type="text" required="required" class="form-control" id="evento" name="evento" value="<?php echo $evento;?>">
                            </div>
                            <div class="col-sm-6">
                                <label for="observaciones">Observaciones</label>
                                <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $observaciones;?>">
                            </div>
                        </div>
                        <div class="row espacio-abajo"> 
                            <div class="col-sm-6">
                                <label for="prioridad">Prioridad</label>
                                <select class="form-control" id="prioridad" name="prioridad" >
                                    <?php if ($prioridad==1){   ?>
                                        <option value="1" selected="selected">1- Baja</option>
                                        <option value="2">2- Alta</option>  
                                    <?php }  else { ?>
                                        <option value="1">1- Baja</option>
                                        <option value="2" selected="selected">2- Alta</option>   
                                    <?php } ?>  
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="estado">Estado</label>
                                <select class="form-control" id="estado" name="estado" >
                                    <?php if ($estado==1){ ?>
                                        <option value="Activo" selected="selected">Activo</option>
                                        <option value="Inactivo">Inactivo</option>  
                                    <?php }  else { ?>
                                       <option value="Activo">Activo</option>
                                       <option value="Inactivo" selected="selected">Inactivo</option>   
                                    <?php } ?>  
                                </select>
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-default">Guardar</button>
                                <td><a href="index.php?ctl=tipo_eventos_listar" class="btn btn-default" role="button">Cancelar</a></td>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!--Gestión de evento de cierre-->
                <div class="col-sm-12 well">
                    <h3>Eventos de cierre</h3>
                    <button class="btn btn-default espacio-abajo" onclick="agregar_evento_cierre();">Agregar evento cierre</button>
                    <!--Tabla de eventos de cierre-->
                    <div class="row">
                        <table id="tabla" class="display" cellspacing="0">
                            <thead> 
                                <tr>
                                    <th hidden>ID</th>
                                    <th style="text-align:center">Descripción</th>
                                    <th style="text-align:center">Estado</th>
                                    <th style="text-align:center">Mantenimiento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $tam=count($params);
                                for ($i = 0; $i <$tam; $i++) { ?>
                                    <tr>
                                        <td hidden><?php echo $params[$i]['ID_Tipo_Evento_Cierre'];?></td>
                                        <td style="text-align:center"><?php echo $params[$i]['Descripcion'];?></td>
                                        <?php if ($params[$i]['Estado']==1){ ?>  
                                            <td style="text-align:center">Activo</td>
                                        <?php } else{ ?>  
                                            <td style="text-align:center">Inactivo</td>
                                        <?php } ?>
                                        <td style="text-align:center"><a role="button" onclick="editar_evento_cierre(<?php echo $params[$i]['ID_Tipo_Evento_Cierre'];?>,'<?php echo $params[$i]['Descripcion'];?>',<?php echo $params[$i]['Estado'];?>)"> 
                                            Editar</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once 'pie_de_pagina.php' ?>
        
        <!--Editar evento de cierre-->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <form id="ventana" method="POST" name="form" action="index.php?ctl=tipo_evento_cierre_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Tipo de evento de cierre</h2>
                    <hr>
                    <input hidden id="ID_Tipo_Evento_Cierre" name="ID_Tipo_Evento_Cierre">
                    <input hidden id="ID_Evento" name="ID_Evento" value="<?php echo trim($ide);?>">
                    <div class="espacio-abajo">
                        <label for="Descripcion">Nombre del Evento Cierre</label>
                        <input type="text" class="form-control" id="Descripcion" name="Descripcion">
                    </div>
                    <div class="espacio-abajo">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado" >
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>  
                        </select>
                    </div>
                    <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                </form>
            </div>
        <!--Cierre agregar teléfono a Punto BCR-->
        </div>
    </body>
</html>