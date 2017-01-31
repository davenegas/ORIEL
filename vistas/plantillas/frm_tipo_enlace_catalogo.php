<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Proveedores</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <script>
            //Funcion para ocultar ventana de mantenimiento de proveedor
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_1').style.display = "none";
            }
            //Valida informacion completa de formulario de proveedor
            function check_empty() {
                if (document.getElementById('nombre').value == "") {
                    alert("Digita el nombre del tipo de enlace !");
                } else {
                    //alert("Form Submitted Successfully...");
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana').submit();
                    document.getElementById('ventana_oculta_1').style.display = "none";
                }
            }
            //Funcion para agregar un nuevo proveedor- formulario en blanco
            function mostrar_agregar_tipo_enlace() {
                document.getElementById('ID_Tipo_Enlace').value="0";
                document.getElementById('nombre').value=null;
                document.getElementById('observaciones').value=null;
                document.getElementById('ventana_oculta_1').style.display = "block";
            }
            //Funcion para editar informacion de proveedor
            function Editar_tipo_enlace(id_enlace,nomb, obser){
                document.getElementById('ID_Tipo_Enlace').value=id_enlace;
                document.getElementById('nombre').value=nomb;
                document.getElementById('observaciones').value=obser;
                document.getElementById('ventana_oculta_1').style.display = "block";
            };
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container">
        <h2>Listado General de Tipo de Enlaces BCR</h2>
        <p>A continuación se detallan los diferentes tipo de enlace que están registrados en el sistema:</p>            
        <table id="tabla" class="display" cellspacing="0">
          <thead>
            <tr>
              <th>ID Tipo Enlace</th>
              <th>Tipo de Enlace</th>
              <th>Observaciones</th>
              <th>Estado</th>
              <th>Cambiar Estado</th>
              <th>Mantenmiento</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tam=count($params);  
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <td><?php echo $params[$i]['ID_Tipo_Enlace'];?></td>
                <td><?php echo $params[$i]['Tipo_Enlace'];?></td>
                <td><?php echo $params[$i]['Observaciones'];?></td>
                <?php if ($params[$i]['Estado']==1){?>  
                    <td>Activo</td>
                <?php }else {?>  
                    <td>Inactivo</td>
                <?php }?>
                <td><a href="index.php?ctl=tipo_enlace_cambiar_estado&ide=<?php echo $params[$i]['ID_Tipo_Enlace']?>&estado=<?php echo $params[$i]['Estado']?>"> 
                        Activar/Desactivar</a></td>
                <td><a role="button" onclick="Editar_tipo_enlace(<?php echo $params[$i]['ID_Tipo_Enlace'];?>,'<?php echo $params[$i]['Tipo_Enlace'];?>','<?php echo $params[$i]['Observaciones'];?>')"> 
                       Editar</a></td>
            </tr>     
            <?php } ?>
            </tbody>
        </table>
        <a id="popup" onclick="mostrar_agregar_tipo_enlace()" class="btn btn-default" role="button">Agregar Nuevo Tipo de Enlace</a>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        
        <!--agregar o editar proveedor-->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <!--Formulario para proveedor de enlaces de telecomunicaciones-->
                <form id="ventana" method="POST" name="form" action="index.php?ctl=tipo_enlace_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Proveedor de enlaces</h2>
                    <hr>
                    <input hidden id="ID_Tipo_Enlace" name="ID_Tipo_Enlace" type="text">
                    <label for="nombre">Tipo de Enlace</label>
                    <input class="form-control espacio-abajo" required id="nombre" name="nombre" placeholder="Nombre del proveedor del enlace" type="text">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones del proveedor">
                    <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                </form>
            </div>
        <!--Cierre agregar teléfono a Punto BCR-->
        </div>
    </body>
</html>