<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de clave</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>
            //Funcion para ocultar ventana de mantenimiento
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            //Valida informacion completa de formulario
            function check_empty() {
                if (document.getElementById('Codigo').value =="") {
                    alert("Digita el nombre del Proveedor !");
                } else {
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana2').submit();
                    document.getElementById('ventana_oculta_2').style.display = "none";
                }
            }
            //Funcion para agregar un nuevo punto- formulario en blanco
            function mostrar_agregar_clave() {
                document.getElementById('ID_Clave').value="0";
                document.getElementById('TipoClave').value=null;
                document.getElementById('Codigo').value=null;
                document.getElementById('Descripcion').value=null;
                document.getElementById('Extension').value=null;
                document.getElementById('Estado').value=1;
                document.getElementById('ventana_oculta_2').style.display = "block";
            }
        //Funcion para editar informacion de clave
            function Editar_clave(pID_Clave,pID_TipoClave,pCodigo,pDescripcion,pExtension,pEstado){
                document.getElementById('ID_Clave').value=pID_Clave;
                document.getElementById('TipoClave').value=pID_TipoClave;
                document.getElementById('Codigo').value=pCodigo;
                document.getElementById('Descripcion').value=pDescripcion;
                document.getElementById('Extension').value=pExtension;
                document.getElementById('Estado').value=pEstado;
                document.getElementById('ventana_oculta_2').style.display = "block";
            };
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Listado General de Claves de Radiofrecuencia del BCR</h2>
            <p>A continuación se detallan los registros del sistema:</p>
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID_Clave</th>
                        <th hidden style="text-align:center">ID_TipoClave</th>
                        <th style="text-align:center">Código</th>
                        <th style="text-align:center">Tipo Clave</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Extensión</th>
                        <th style="text-align:center">Estado</th>
                        <th <?php if(($_SESSION['rol']!=3)&& ($_SESSION['rol']!=11)&&($_SESSION['rol']!=1)){ echo 'hidden';} ?> style="text-align:center">Cambiar Estado</th>
                        <th <?php if(($_SESSION['rol']!=3)&& ($_SESSION['rol']!=11)&&($_SESSION['rol']!=1)){ echo 'hidden';} ?> style="text-align:center">Mantenimiento</th>
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($clave); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                        <td hidden style="text-align:center"><?php echo $clave[$i]['ID_Clave'];?></td>
                        <td hidden><?php echo $clave[$i]['ID_TipoClave'];?></td>                        
                        <td><strong><?php echo $clave[$i]['Codigo'];?></strong></td>
                        <td><?php echo $clave[$i]['TipoClave'];?></td>
                        <td><?php echo $clave[$i]['Descripcion'];?></td>
                        <td><?php echo $clave[$i]['Extension'];?></td>
                        <?php if ($clave[$i]['Estado']==1){?>
                            <td style="text-align:center">Activo</td>
                        <?php }else {?>
                            <td style="text-align:center">Inactivo</td>
                        <?php }?>

                        <td <?php if(($_SESSION['rol']!=3)&& ($_SESSION['rol']!=11)&&($_SESSION['rol']!=1)){ echo 'hidden';} ?> style="text-align:center"><a href="index.php?ctl=clave_cambiar_estado&ID_Clave=<?php echo $clave[$i]['ID_Clave']?>&Estado=<?php echo $clave[$i]['Estado']?>">Activar/Desactivar</a></td>
                        <td <?php if(($_SESSION['rol']!=3)&& ($_SESSION['rol']!=11)&&($_SESSION['rol']!=1)){ echo 'hidden';} ?> style="text-align:center"><a role="button" onclick="Editar_clave('<?php echo $clave[$i]['ID_Clave'];?>','<?php echo $clave[$i]['ID_TipoClave'];?>','<?php echo $clave[$i]['Codigo'];?>','<?php echo $clave[$i]['Descripcion'];?>','<?php echo $clave[$i]['Extension'];?>','<?php echo $clave[$i]['Estado'];?>')">Editar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div <?php if(($_SESSION['rol']!=3)&& ($_SESSION['rol']!=11)&&($_SESSION['rol']!=1)){ echo 'hidden';} ?> >
                <a id="popup" onclick="mostrar_agregar_clave()" class="btn btn-default" role="button">Agregar clave</a>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        <!--agregar o editar clave-->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
            <!--Formulario para clave-->
                    <form id="ventana2" method="POST" name="ventana2" action="index.php?ctl=clave_guardar">
                        <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                        <h2>Agregar Claves Radiofrecuencia</h2> <hr>
                        <input hidden id="ID_Clave" name="ID_Clave" type="text">

                        <div class="form-group">
                            <label for="Codigo">Código</label>
                            <input class="form-control espacio-abajo" required id="Codigo" name="Codigo" placeholder="Codigo" type="text">
                        </div>
                        
                        <div class="form-group">
                            <label for="TipoClave">Tipo Clave</label>
                            <select class="form-control" id="TipoClave" name="TipoClave"> 
                                <?php $tam=count($claveTipo); for ($i = 0; $i <$tam; $i++) { ?>
                                <option value="<?php echo $claveTipo[$i]['ID_TipoClave'];?>"><?php echo $claveTipo[$i]['Descripcion'];?></option>
                                <?php }?>                               
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Descripcion">Descripción</label>
                            <input class="form-control espacio-abajo" required id="Descripcion" name="Descripcion" placeholder="Descripcion" type="text">
                        </div>

                        <div class="form-group">
                            <label for="Extension">Extensión</label>
                            <input class="form-control espacio-abajo" required id="Extension" name="Extension" placeholder="Extension" type="text">
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
        <!--Cierre agregar o editar clave-->
    </body>
</html>