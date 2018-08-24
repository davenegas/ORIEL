<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Categorías</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>
            //Funcion para ocultar ventana de mantenimiento
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            //Valida informacion completa de formulario
            function check_empty() {
                if (document.getElementById('Descripcion').value =="") {
                    alert("Digita el nombre del Proveedor !");
                } else {
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana2').submit();
                    document.getElementById('ventana_oculta_2').style.display = "none";
                }
            }
            //Funcion para agregar un nuevo punto- formulario en blanco
            function mostrar_agregar_andru_categoria() {
                document.getElementById('ID_Categoria').value="0";
                document.getElementById('Descripcion').value=null;
                document.getElementById('Estado').value=1;
                document.getElementById('ventana_oculta_2').style.display = "block";
            }
        //Funcion para editar informacion de andru_categoria
            function Editar_andru_categoria(pID_Categoria,pDescripcion,pEstado){
                document.getElementById('ID_Categoria').value=pID_Categoria;
                document.getElementById('Descripcion').value=pDescripcion;
                document.getElementById('Estado').value=pEstado;
                document.getElementById('ventana_oculta_2').style.display = "block";
            };
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Listado General de Categorías de Andru</h2>
            <p>A continuación se detallan los registros del sistema:</p>
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID_Categoria</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Estado</th>
                        <th style="text-align:center">Cambiar Estado</th>
                        <th style="text-align:center">Mantenimiento</th>
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($andru_categoria); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                        <td  hidden style="text-align:center"><?php echo $andru_categoria[$i]['ID_Categoria'];?></td>
                        <td><?php echo $andru_categoria[$i]['Descripcion'];?></td>
                        <?php if ($andru_categoria[$i]['Estado']==1){?>
                            <td style="text-align:center">Activo</td>
                        <?php }else {?>
                            <td style="text-align:center">Inactivo</td>
                        <?php }?>

                        <td style="text-align:center"><a href="index.php?ctl=andru_categoria_cambiar_estado&ID_Categoria=<?php echo $andru_categoria[$i]['ID_Categoria']?>&Estado=<?php echo $andru_categoria[$i]['Estado']?>">Activar/Desactivar</a></td>
                        <td style="text-align:center"><a role="button" onclick="Editar_andru_categoria('<?php echo $andru_categoria[$i]['ID_Categoria'];?>','<?php echo $andru_categoria[$i]['Descripcion'];?>','<?php echo $andru_categoria[$i]['Estado'];?>')">Editar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a id="popup" onclick="mostrar_agregar_andru_categoria()" class="btn btn-default" role="button">Agregar Categoría</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        <!--agregar o editar andru_categoria-->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
            <!--Formulario para andru_categoria-->
                    <form id="ventana2" method="POST" name="ventana2" action="index.php?ctl=andru_categoria_guardar">
                        <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                        <h2>Mantenimiento de Categorías</h2> <hr>
                        <input hidden id="ID_Categoria" name="ID_Categoria" type="text">

                        <div class="form-group">
                            <label for="Descripcion">Descripción</label>
                            <input class="form-control espacio-abajo" required id="Descripcion" name="Descripcion" placeholder="Descripción" type="text">
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
        <!--Cierre agregar o editar andru_categoria-->
    </body>
</html>