<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Cencon</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_cencon.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <section class="container espacio-arriba-15">
            <h2>Gestión Módulo de Cencon</h2>
            <p>A continuación se detallan los diferentes proveedor que están registrados en el sistema:</p>
            <div class="col-sm-4 quitar-float">
                <label for="tipo_funcionario">Tipo de Funcionario</label>
                <select class="form-control" id="tipo_funcionario" name="tipo_funcionario" > 
                    <option value="-"></option>
                    <option value="0">Personal Interno</option>
                    <option value="1">Personal Externo</option>
                </select>
            </div>

            <div class="quitar-float col-sm-6" style="margin-bottom: 15px; margin-top: 15px;">
                <a class="quitar-float" id="buscar_persona" onclick="buscar_persona()">Buscar Persona</a>
            </div>
                
            <input  required hidden disabled id="ID_Persona" name="ID_Persona" type="text">
            <input  required hidden disabled id="ID_Empresa" name="ID_Empresa" type="text">
            
            <div class="quitar-float">
                <div class="col-sm-4">
                    <label for="nombre_persona">Nombre del Funcionario</label>
                    <input class="form-control" disabled id="nombre_persona" name="nombre_persona" type="text">
                </div>
                
                <div class="col-sm-4">
                    <label for="cedula_persona">Número de Cédula formato Cencon</label>
                    <input class="form-control" readonly id="cedula_persona" name="cedula_persona" type="text">
                </div>
                
                <div class="col-sm-4">
                    <label for="unidad_ejecutora">Departamento</label>
                    <input class="form-control" disabled id="unidad_ejecutora" name="unidad_ejecutora" type="text">
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom: 20px; margin-top: 10px;">
                <a id="buscar_cajero1" onclick="buscar_cajero()">Buscar Cajero Automático</a>
            </div>
            
            <div class="col-sm-4" style="margin-bottom: 20px; margin-top: 10px;">
                <a id="todos_cajero1" onclick="todos_cajero('agregar')">Agregar todos los cajeros</a>
            </div>
            
            <div class="col-sm-4" style="margin-bottom: 20px; margin-top: 10px;">
                <a id="todos_cajero2" onclick="todos_cajero('eliminar')">Eliminar todos los cajeros</a>
            </div>
            
            <div>
                <table id="cajeros_persona" class="col-md-12">
                    <thead> 
                    </thead>
                    <tbody>
                    </tbody> 
                </table>
            </div>

        </section>
        
        <?php require_once 'pie_de_pagina.php' ?>
        
        <!--Asignar Persona BCR -->
        <div id="ventana_oculta_1">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">Cédula</th>
                                <th style="text-align:center">Apellidos Nombre</th>
                                <th style="text-align:center">Departamento</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($personal_bcr);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $personal_bcr[$i]['Cedula'];?></td>
                                    <td style="text-align:center"><?php echo $personal_bcr[$i]['Apellido_Nombre'];?></td>
                                    <td style="text-align:center"><?php echo $personal_bcr[$i]['Departamento'];?></td>
                                    <td style="text-align:center"><a class="btn" role="button" onclick="agregar_persona(<?php echo $personal_bcr[$i]['ID_Persona'];?>,'<?php echo $personal_bcr[$i]['Cedula'];?>','<?php echo $personal_bcr[$i]['Apellido_Nombre'];?>','<?php echo $personal_bcr[$i]['Departamento'];?>',<?php echo $personal_bcr[$i]['ID_Empresa'];?> );">
                                            Seleccionar Persona</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <!--Cierre Asignar Personal BCR a Cencon-->
        </div> 
        
        <!--Asignar Persona externo -->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla2" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">Identificación</th>
                                <th style="text-align:center">Apellidos Nombre</th>
                                <th style="text-align:center">Empresa</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($personal_externo);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $personal_externo[$i]['Identificacion'];?></td>
                                    <td style="text-align:center"><?php echo $personal_externo[$i]['Apellido']." ".$personal_externo[$i]['Nombre'];?></td>
                                    <td style="text-align:center"><?php echo $personal_externo[$i]['Empresa'];?></td>
                                    <td style="text-align:center"><a class="btn" role="button" onclick="agregar_persona(<?php echo $personal_externo[$i]['ID_Persona_Externa'];?>,
                                                '<?php echo $personal_externo[$i]['Identificacion'];?>','<?php echo $personal_externo[$i]['Apellido']." ".$personal_externo[$i]['Nombre'];?>',
                                                '<?php echo $personal_externo[$i]['Empresa'];?>',<?php echo $personal_externo[$i]['ID_Empresa'];?>);">
                                            Seleccionar Persona</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                  </table>
                </div>
            </div>
        <!--Cierre Asignar Personal Externo a Cencon-->
        </div> 
        
        <!--Asignar Cajeros a la persona-->
        <div id="ventana_oculta_3">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla3" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">Código ATM</th>
                                <th style="text-align:center">Nombre ATM</th>
                                <th style="text-align:center">Tipo de ATM</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($puntosbcr);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $puntosbcr[$i]['Codigo'];?></td>
                                    <td style="text-align:center"><?php echo $puntosbcr[$i]['Nombre'];?></td>
                                    <td style="text-align:center"><?php echo $puntosbcr[$i]['Tipo_Punto'];?></td>
                                    <td style="text-align:center"><a class="btn" role="button" onclick="agregar_atm(<?php echo $puntosbcr[$i]['ID_PuntoBCR'];?>);">
                                            Seleccionar ATM</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <!--Cierre Asignar cajero a la persona-->
        </div> 
        
        <!--Agregar Observaciones al cajero asignado-->
        <div id="ventana_oculta_4"> 
            <div id="popupventana">
                <div id="ventana">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <h2 align="center" id="titulo_ventana_oculta">Cencon Observaciones ATM</h2>
                    <hr>
                    <input id="ID_Cencon" name="ID_Cencon" type="text" value="">

                    <label for="observaciones_cencon">Observaciones</label>
                    <input class="form-control" id="observaciones_cencon" name="observaciones_cencon" type="text">            
                    <hr>
                    <button onclick="guardar_observaciones_cencon();">Guardar</a></button>
                </div>
            </div>
        </div>
    </body>
</html>
