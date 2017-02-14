<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Tipo Telefonos</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <script>
            //Funcion para ocultar ventana de mantenimiento de proveedor
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_1').style.display = "none";
            }
            //Valida informacion completa de formulario de proveedor
            function check_empty() {
                if (document.getElementById('nombre').value =="") {
                    alert("Digita el nombre del Proveedor !");
                } else {
                    //alert("Form Submitted Successfully...");
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana').submit();
                    document.getElementById('ventana_oculta_1').style.display = "none";
                }
            }
            //Funcion para agregar un nuevo tipo de telefono- formulario en blanco
            function mostrar_agregar_tipo() {
                document.getElementById('ID_Tipo_Telefono').value="0";
                document.getElementById('nombre').value=null;
                document.getElementById('observaciones').value=null;
                document.getElementById('ventana_oculta_1').style.display = "block";
            }
            //Funcion para editar informacion de tipo telefono
            function Editar_TT(id_tt,nomb,obser,esta){
                document.getElementById('ID_Tipo_Telefono').value=id_tt;
                document.getElementById('nombre').value=nomb;
                document.getElementById('observaciones').value=obser;
                $("#estado option[value="+esta+"]").attr("selected",true);
                document.getElementById('ventana_oculta_1').style.display = "block";
            };
        </script>
        
    </head>
    
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
        <h2>Listado General de Tipos Telefonos del BCR</h2>
        <p>A continuación se detallan los diferentes Tipos de Telefonos que están registrados en el sistema:</p>            
        <table id="tabla" class="display" cellspacing="0">
            <thead>
                <tr>
                    <th style="text-align:center">ID_Telefono</th>
                    <th style="text-align:center">Tipo de Telefono</th>
                    <th style="text-align:center">Observaciones</th>
                    <th style="text-align:center">Estado</th>
                    <th style="text-align:center">Cambiar Estado</th>
                    <th style="text-align:center">Mantenmiento</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $tam=count($params);  
                for ($i = 0; $i <$tam; $i++) {  ?>
                    <tr>
                        <td style="text-align:center"><?php echo $params[$i]['ID_Tipo_Telefono'];?></td>
                        <td><?php echo $params[$i]['Tipo_Telefono'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                        <?php if ($params[$i]['Estado']==1){?>  
                            <td style="text-align:center">Activo</td>
                        <?php }else {?>  
                            <td style="text-align:center">Inactivo</td>
                        <?php }?>
                        <td style="text-align:center"><a href="index.php?ctl=tipo_telefono_cambiar_estado&id=<?php echo $params[$i]['ID_Tipo_Telefono']?>&estado=<?php echo $params[$i]['Estado']?>">
                            Activar/Desactivar</a></td>
                        <td style="text-align:center"><a role="button" onclick="Editar_TT('<?php echo $params[$i]['ID_Tipo_Telefono'];?>','<?php echo $params [$i]['Tipo_Telefono'];?>',
                            '<?php echo $params [$i]['Observaciones'];?>',<?php echo $params [$i]['Estado'];?>)">
                            Editar</a></td>
                    </tr>     
                <?php } ?>
            </tbody>
        </table>
        <a id="popup" onclick="mostrar_agregar_tipo()" class="btn btn-default" role="button">Agregar Nuevo Tipo</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        
        <!--agregar o editar-->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <!--Formulario para tipos de teléfonos-->
                <form id="ventana" method="POST" name="form" action="index.php?ctl=tipo_telefono_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Tipo Telefono</h2>
                    <hr>
                    <input hidden id="ID_Tipo_Telefono" name="ID_Tipo_Telefono" type="text">
                    
                    <label for="nombre">Tipo Telefono</label>
                    <input class="form-control espacio-abajo" required id="nombre" name="nombre" placeholder="Tipo Telefono" type="text">
                    
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones del Tipo">
                   
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
        <!--Cierre agregar o editar-->
        </div>
    </body>
</html>
