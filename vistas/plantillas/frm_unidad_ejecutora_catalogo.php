<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Unidades Ejecutoras</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <script>
            //Funcion para ocultar ventana de mantenimiento de proveedor
            function ocultar_elemento(){
                document.getElementById('formulario_oculto_1').style.display = "none";
            }
            //Valida informacion completa de formulario de proveedor
            function check_empty() {
                if (document.getElementById('nombre').value == "") {
                    alert("Digita el nombre del Proveedor !");
                } else {
                    //alert("Form Submitted Successfully...");
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana').submit();
                    document.getElementById('formulario_oculto_1').style.display = "none";
                }
            }
            //Funcion para agregar un nuevo proveedor- formulario en blanco
            function mostrar_agregar_proveedor() {
                document.getElementById('ID_Unidad_Ejecutora').value="0";
                document.getElementById('numero').value=null;
                document.getElementById('nombre').value=null;
                document.getElementById('observaciones').value=null;
                document.getElementById('formulario_oculto_1').style.display = "block";
            }
            //Funcion para editar informacion de proveedor
            function Editar_UE(id_ue,num,nomb,obser, estado){
                document.getElementById('ID_Unidad_Ejecutora').value=id_ue;
                document.getElementById('numero').value=num;
                document.getElementById('nombre').value=nomb;
                document.getElementById('observaciones').value=obser;
                $("#estado option[value="+estado+"]").attr("selected",true);
                document.getElementById('formulario_oculto_1').style.display = "block";
            };
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container">
        <h2>Listado General de Unidades Ejecutoras BCR</h2>
        <p>A continuación se detallan las diferentes unidades ejecutoras que están registrados en el sistema:</p>            
        <table id="tabla" class="display" cellspacing="0">
          <thead>
            <tr>
              <th style="text-align:center">ID Unidad Ejecutora</th>
              <th style="text-align:center">Numero de UE</th>
              <th style="text-align:center">Nombre UE</th>
              <th style="text-align:center">Observaciones</th>
              <th style="text-align:center">Estado</th>
              <th style="text-align:center">Mantenmiento</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tam=count($params);  
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <th style="text-align:center"><?php echo $params[$i]['ID_Unidad_Ejecutora'];?></td>
                <th style="text-align:center"><?php echo $params[$i]['Numero_UE'];?></td>
                <th><?php echo $params[$i]['Departamento'];?></td>
                <th style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                <?php if ($params[$i]['Estado']==1){?>  
                    <th style="text-align:center">Activo</td>
                <?php }else {?>  
                    <th style="text-align:center">Inactivo</td>
                <?php }?>
                
                <th style="text-align:center"><a role="button" onclick="Editar_UE(<?php echo $params[$i]['ID_Unidad_Ejecutora'];?>,'<?php echo $params[$i]['Numero_UE'];?>',
                                                        '<?php echo $params[$i]['Departamento'];?>','<?php echo $params[$i]['Observaciones'];?>', <?php echo $params[$i]['Estado'];?>)"> 
                       Editar</a></td>
            </tr>     
            <?php } ?>
            </tbody>
        </table>
        <a id="popup" onclick="mostrar_agregar_proveedor()" class="btn btn-default" role="button">Agregar Nueva UE</a>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        
        <!--agregar o editar Unidad ejecutora-->
        <div id="formulario_oculto_1"> 
            <div id="popupventana">
                <!--Formulario para proveedor de enlaces de telecomunicaciones-->
                <form id="ventana" method="POST" name="form" action="index.php?ctl=unidad_ejecutora_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Unidad Ejecutora</h2>
                    <hr>
                    <input hidden id="ID_Unidad_Ejecutora" name="ID_Unidad_Ejecutora" type="text">
                    
                    <label for="numero">Número de UE</label>
                    <input class="form-control espacio-abajo" required id="numero" name="numero" placeholder="Número de Unidad Ejecutora" type="text">
                    
                    <label for="nombre">Nombre UE</label>
                    <input class="form-control espacio-abajo" required id="nombre" name="nombre" placeholder="Nombre de la Unidad Ejecutora" type="text">
                    
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones del proveedor">
                    <div class="form-group">
                        <label for="sel1">Estado</label>
                        <select class="form-control" id="estado" name="estado">
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