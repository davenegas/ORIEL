<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de tipoip</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>
            //Funcion para ocultar ventana de mantenimiento
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            //Valida informacion completa de formulario
            function check_empty() {
                if (document.getElementById('Tipo_IP').value =="") {
                    alert("Digita el nombre del Proveedor !");
                } else {
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana2').submit();
                    document.getElementById('ventana_oculta_2').style.display = "none";
                }
            }
            //Funcion para agregar un nuevo punto- formulario en blanco
            function mostrar_agregar_tipoip() {
                document.getElementById('ID_Tipo_IP').value="0";
                document.getElementById('Tipo_IP').value=null;
                document.getElementById('Observaciones').value=null;
                document.getElementById('Estado').value=1;
                document.getElementById('ventana_oculta_2').style.display = "block";
            }
        //Funcion para editar informacion de tipoip
            function Editar_tipoip(pID_Tipo_IP,pTipo_IP,pObservaciones,pEstado){
                document.getElementById('ID_Tipo_IP').value=pID_Tipo_IP;
                document.getElementById('Tipo_IP').value=pTipo_IP;
                document.getElementById('Observaciones').value=pObservaciones;
                document.getElementById('Estado').value=pEstado;
                document.getElementById('ventana_oculta_2').style.display = "block";
            };
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Listado General de Tipo de IP del BCR</h2>
            <p>A continuación se detallan los registros del sistema:</p>
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID_Tipo_IP</th>
                        <th style="text-align:center">Tipo</th>
                        <th style="text-align:center">Observaciones</th>
                        <th style="text-align:center">Estado</th>
                        <th style="text-align:center">Cambiar Estado</th>
                        <th style="text-align:center">Mantenimiento</th>
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($tipoip); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                        <td hidden style="text-align:center"><?php echo $tipoip[$i]['ID_Tipo_IP'];?></td>
                        <td><?php echo $tipoip[$i]['Tipo_IP'];?></td>
                        <td><?php echo $tipoip[$i]['Observaciones'];?></td>
                        <?php if ($tipoip[$i]['Estado']==1){?>
                            <td style="text-align:center">Activo</td>
                        <?php }else {?>
                            <td style="text-align:center">Inactivo</td>
                        <?php }?>

                        <td style="text-align:center"><a href="index.php?ctl=tipoip_cambiar_estado&ID_Tipo_IP=<?php echo $tipoip[$i]['ID_Tipo_IP']?>&Estado=<?php echo $tipoip[$i]['Estado']?>">Activar/Desactivar</a></td>
                        <td style="text-align:center"><a role="button" onclick="Editar_tipoip('<?php echo $tipoip[$i]['ID_Tipo_IP'];?>','<?php echo $tipoip[$i]['Tipo_IP'];?>','<?php echo $tipoip[$i]['Observaciones'];?>','<?php echo $tipoip[$i]['Estado'];?>')">Editar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a id="popup" onclick="mostrar_agregar_tipoip()" class="btn btn-default" role="button">Agregar Tipo IP</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        <!--agregar o editar tipoip-->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
            <!--Formulario para tipoip-->
                    <form id="ventana2" method="POST" name="ventana2" action="index.php?ctl=tipoip_guardar">
                        <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                        <h2>tipoip</h2> <hr>
                        <input hidden id="ID_Tipo_IP" name="ID_Tipo_IP" type="text">

                        <div class="form-group">
                            <label for="Tipo_IP">Tipo</label>
                            <input class="form-control espacio-abajo" required id="Tipo_IP" name="Tipo_IP" placeholder="Tipo" type="text">
                        </div>

                        <div class="form-group">
                            <label for="Observaciones">Observaciones</label>
                            <input class="form-control espacio-abajo" required id="Observaciones" name="Observaciones" placeholder="Observaciones" type="text">
                        </div>

                        <div class="form-group">
                            <label for="sel1">Estado</label>
                            <select class="form-control" id="Estado" name="Estado"> 
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="row"></div>
                        <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                    </form>
                </div>
            </div>
        <!--Cierre agregar o editar tipoip-->
    </body>
</html>