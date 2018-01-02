<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Listado de Botones RF</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?> 
        <script>
            //Funcion para ocultar formulario
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_1').style.display = "none";
            }
            
            //Funcion seleccionar punto
            function buscar_punto(){
                document.getElementById('ventana_oculta_1').style.display= "block";
            }
            
            //Funcion seleccionar punto
            function selec_punto(id) {
                document.getElementById('ID_PuntoBCR').value=id;
                document.getElementById('ventana_oculta_1').style.display= "block";   
            };
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class="container">
            <h2>Listado General de Botones RF</h2>
            <p>A continuación se detallan los Botones RF Registrados en el Sistema:</p>
            <br> 
            <table id="tabla" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="text-align:center">Punto BCR</th>
                        <th style="text-align:center">Tipo de Panel</th>
                        <th style="text-align:center">Funcionario BCR</th>
                        <th style="text-align:center">Numero Zona</th>
                        <th style="text-align:center">Tipo de Respuesta</th>
                        <th style="text-align:center">Tipo de Entrada</th>
                        <th style="text-align:center">Numero Serie</th>
                        <th style="text-align:center">Observaciones</th>
                        <th style="text-align:center">Estado</th> 
                        <th style="text-align:center">Editar</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tam = count($zona);
                    for ($i = 0; $i < $tam; $i++) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $zona[$i]['Nombre'];?></td>
                            <td style="text-align:center"><?php echo $zona[$i]['Tipo_Panel'];?></td>
                            <td style="text-align:center"><?php echo $zona[$i]['Apellido_Nombre'];?></td>
                            <td style="text-align:center"><?php echo $zona[$i]['Numero_Zona'];?></td>
                            <td style="text-align:center"><?php echo $zona[$i]['Tipo_Respuesta'];?></td>
                            <td style="text-align:center"><?php echo $zona[$i]['Tipo_Entrada'];?></td>
                            <td style="text-align:center"><?php echo $zona[$i]['Numero_Serie'];?></td>
                            <td style="text-align:center"><?php echo $zona[$i]['Observaciones'];?></td>
                            <?php if ($zona[$i]['Estado']==1){?>  
                                <td style="text-align:center">Activo</td>
                            <?php }else {?>  
                                <td style="text-align:center">Inactivo</td>
                            <?php } ?>
                            <td style="text-align:center"><a href="index.php?ctl=botones_selec_editar&id_boton=<?php echo $zona[$i]['ID_Boton']?>">Editar</a></td>
                        </tr>     
                    <?php } ?>
                </tbody>
            </table>
            <div class="container">
                <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=botones_guardar&id=<?php echo $params[0]['ID_PuntoBCR'];?>">
                    <div class="form-group">
                        <label for="id_punto"><a id="popup" onclick="selec_punto()" class="btn btn-default" role="button">Agregar Panel</a></label>
                        <input hidden type="text" id="ID_PuntoBCR" name="ID_PuntoBCR" value="<?php echo $params[0]['ID_PuntoBCR']?>">
                    </div>  
                </form>     
            </div>
        </section>
        <?php require_once 'pie_de_pagina.php' ?>
        <!Formulario para seleccionar Oficina---->
        <div id="ventana_oculta_1">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <!Formulario para seleccionar una Oficina---->
                    <h3 class="bordegris text-center">Seleccione Oficina BCR</h3>
                    <table id="tabla3" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">ID</th>
                                <th style="text-align:center">Codigo</th>
                                <th style="text-align:center">Nombre</th>
                                <th style="text-align:center">Panel</th>
                                <th style="text-align:center">Direccion</th>
                                <th style="text-align:center">Observaciones</th>
                                <th style="text-align:center">Opcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam = count($params);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $params[$i]['ID_PuntoBCR'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Codigo'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Nombre'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Tipo_Panel'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Direccion'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                                    <td style="text-align:center"><a href="index.php?ctl=botones_selec_guardar&id_puntobcr=<?php echo $params[$i]['ID_PuntoBCR']?>&id_boton=<?php echo $zona[0]['ID_Boton'];?>">Seleccionar</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </body>
</html>