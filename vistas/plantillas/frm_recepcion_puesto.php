<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de recepcion_puesto</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>
            //Funcion para ocultar ventana de mantenimiento
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            //Valida informacion completa de formulario
            function check_empty() {
                if (document.getElementById('Nombre').value =="") {
                    alert("Digita el nombre del Proveedor !");
                } else {
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana2').submit();
                    document.getElementById('ventana_oculta_2').style.display = "none";
                }
            }
            //Funcion para agregar un nuevo punto- formulario en blanco
            function mostrar_agregar_recepcion_puesto() {
                document.getElementById('ID_RecepcionPuesto').value="0";
                document.getElementById('Nombre').value=null;
                document.getElementById('Descripcion').value=null;
                document.getElementById('Estado').value=1;
                document.getElementById('ventana_oculta_2').style.display = "block";
            }
        //Funcion para editar informacion de recepcion_puesto
            function Editar_recepcion_puesto(pID_RecepcionPuesto,pNombre,pDescripcion,pEstado){
                document.getElementById('ID_RecepcionPuesto').value=pID_RecepcionPuesto;
                document.getElementById('Nombre').value=pNombre;
                document.getElementById('Descripcion').value=pDescripcion;
                document.getElementById('Estado').value=pEstado;
                document.getElementById('ventana_oculta_2').style.display = "block";
            };
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Listado General de Control de Visitas del BCR</h2>
            <p>A continuación se detallan los registros del sistema:</p>
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align:center">ID_RecepcionPuesto</th>
                        <th style="text-align:center">Nombre</th>
                        <th style="text-align:center">Descripcion</th>
                        <th style="text-align:center">Estado</th>
                        <th style="text-align:center">Cambiar Estado</th>
                        <th style="text-align:center">Mantenimiento</th>
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($recepcion_puesto); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                        <td hidden style="text-align:center"><?php echo $recepcion_puesto[$i]['ID_RecepcionPuesto'];?></td>
                        <td><?php echo $recepcion_puesto[$i]['Nombre'];?></td>
                        <td><?php echo $recepcion_puesto[$i]['Descripcion'];?></td>
                        <?php if ($recepcion_puesto[$i]['Estado']==1){?>
                            <td style="text-align:center">Activo</td>
                        <?php }else {?>
                            <td style="text-align:center">Inactivo</td>
                        <?php }?>

                        <td style="text-align:center"><a href="index.php?ctl=recepcion_puesto_cambiar_estado&ID_RecepcionPuesto=<?php echo $recepcion_puesto[$i]['ID_RecepcionPuesto']?>&Estado=<?php echo $recepcion_puesto[$i]['Estado']?>">Activar/Desactivar</a></td>
                        <td style="text-align:center"><a role="button" onclick="Editar_recepcion_puesto('<?php echo $recepcion_puesto[$i]['ID_RecepcionPuesto'];?>','<?php echo $recepcion_puesto[$i]['Nombre'];?>','<?php echo $recepcion_puesto[$i]['Descripcion'];?>','<?php echo $recepcion_puesto[$i]['Estado'];?>')">Editar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a id="popup" onclick="mostrar_agregar_recepcion_puesto()" class="btn btn-default" role="button">Agregar recepcion_puesto</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        <!--agregar o editar recepcion_puesto-->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
            <!--Formulario para recepcion_puesto-->
                    <form id="ventana2" method="POST" name="ventana2" action="index.php?ctl=recepcion_puesto_guardar">
                        <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                        <h2>recepcion_puesto</h2> <hr>
                        <input hidden id="ID_RecepcionPuesto" name="ID_RecepcionPuesto" type="text">

                        <div class="form-group">
                            <label for="Nombre">Nombre</label>
                            <input class="form-control espacio-abajo" required id="Nombre" name="Nombre" placeholder="Nombre" type="text">
                        </div>

                        <div class="form-group">
                            <label for="Descripcion">Descripcion</label>
                            <input class="form-control espacio-abajo" required id="Descripcion" name="Descripcion" placeholder="Descripcion" type="text">
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
        <!--Cierre agregar o editar recepcion_puesto-->
    </body>
</html>