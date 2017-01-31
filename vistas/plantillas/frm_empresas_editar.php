<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Empresas</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
        
        <script>  
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_1').style.display = "none";
                document.getElementById('ventana_oculta_2').style.display = "none";
                document.getElementById('ventana_oculta_3').style.display = "none";
            }
            function buscar_personal_externo(){
                document.getElementById('ventana_oculta_2').style.display= "block";
            }
            function buscar_personal_bcr(){
                document.getElementById('ventana_oculta_1').style.display= "block";
            }
            function buscar_ue(){
                document.getElementById('ventana_oculta_3').style.display= "block";
            }
            function agregar_persona_bcr(id, apellido_nombre){
                document.getElementById('ID_Persona').value=id;
                document.getElementById('encargado_bcr').value= apellido_nombre;
                document.getElementById('ventana_oculta_1').style.display = "none";
            }
            function agregar_persona_externa(id, apellido_nombre){
                document.getElementById('ID_Personal_Externo').value=id;
                document.getElementById('encargado').value= apellido_nombre;
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            function agregar_ue(id, ue){
                document.getElementById('ID_Unidad_Ejecutora').value=id;
                document.getElementById('ue_bcr').value= ue;
                document.getElementById('ventana_oculta_3').style.display = "none";
            }
            
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class="container">
<!--            <pre>
                <?php print_r($empresa)?>
            </pre>-->
        <h2>Gestión de Empresas</h2>
        <p>Mediante esta pantalla, podrá agregar o editar empresas:</p>
        <div class="container">
            
        <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=empresa_guardar&id=<?php echo $empresa[0]['ID_Empresa'];?>">
        <div class="form-group">
          <label for="empresa">Nombre de la Empresa</label>
          <input type="text" required="required" class="form-control" id="empresa" name="empresa" value="<?php echo $empresa[0]['Empresa'];?>">
        </div>
        <div class="form-group">
          <label for="cedula_juridica">Cédula Jurídica</label>
          <input type="text" required="required" class="form-control" id="cedula_juridica" name="cedula_juridica" value="<?php echo $empresa[0]['Cedula_Juridica'];?>">
        </div>
        <div class="form-group">
          <label for="encargado">Encargado de la Empresa<a id="popup" onclick="buscar_personal_externo()" class="btn azul" role="button">Cambiar encargado</a></label>
          <input hidden type="text" id="ID_Personal_Externo" name="ID_Personal_Externo" value="<?php echo $empresa[0]['ID_Persona_Externa'];?>">
          <input type="text" disabled class="form-control" id="encargado" name="encargado" value="<?php echo $empresa[0]['Nombre_Externo'].' '.$empresa[0]['Apellido_Externo'];?>">
        </div>
        <div class="form-group">
          <label for="telefono_empresa">Número de teléfono empresa</label>
          <input type="text" required="required" class="form-control" id="telefono_empresa" name="telefono_empresa" value="<?php echo $empresa[0]['Telefono_Empresa'];?>">
        </div> 
        <div class="form-group">
          <label for="direccion">Dirección</label>
          <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $empresa[0]['Direccion'];?>">
        </div>  
        <div class="form-group">
          <label for="tipo_empresa">Tipo de Empresa</label>
          <input type="text" required="required" class="form-control" id="tipo_empresa" name="tipo_empresa" value="<?php echo $empresa[0]['Tipo_Empresa'];?>">
        </div> 
        <div class="form-group">
          <label for="encargado_bcr">Responsable BCR por el contrato<a id="popup" onclick="buscar_personal_bcr()" class="btn azul" role="button">Cambiar encargado BCR</a></label>
          <input hidden type="text" id="ID_Persona" name="ID_Persona" value="<?php echo $empresa[0]['ID_Persona']?>">
          <input type="text" required="required" disabled class="form-control" id="encargado_bcr" name="encargado_bcr" value="<?php echo $empresa[0]['Apellido_Nombre'];?>">
        </div> 
        <div class="form-group">
          <label for="ue_bcr">Unidad Ejecutora responsable por el contrato<a id="popup" onclick="buscar_ue()" class="btn azul" role="button">Cambiar Unidad Ejecutora</a></label>
          <input hidden type="text" id="ID_Unidad_Ejecutora" name="ID_Unidad_Ejecutora" value="<?php echo $empresa[0]['ID_Unidad_Ejecutora']?>">
          <input type="text" disabled required="required" class="form-control" id="ue_bcr" name="ue_bcr" value="<?php echo $empresa[0]['Departamento'];?>">
        </div> 
        <div class="form-group">
          <label for="fecha_inicio">Fecha Inicio del contrato</label>
          <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $empresa[0]['Fecha_Inicio'];?>">
        </div>
        <div class="form-group">
          <label for="fecha_final">Fecha Final del contrato</label>
          <input type="date" required="required" class="form-control" id="fecha_final" name="fecha_final" value="<?php echo $empresa[0]['Fecha_Final'];?>">
        </div>     
        <div class="form-group">
          <label for="observaciones">Observaciones</label>
          <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $empresa[0]['Observaciones'];?>">
        </div>
        <div class="form-group">
        <label for="sel1">Estado</label>
        <select class="form-control" id="estado" name="estado" >
            <?php if ($empresa[0]['Estado']==1){
            ?>
                <option value="1" selected="selected">Activo</option>
                <option value="0">Inactivo</option>  
            <?php
            }  else {
            ?>
               <option value="1">Activo</option>
               <option value="0" selected="selected">Inactivo</option>   
            <?php
            }
            ?>  
        </select>
      </div>
        <button type="submit" class="btn btn-default">Guardar</button>
        <td><a href="index.php?ctl=empresas_listar" class="btn btn-default" role="button">Cancelar</a></td>
      </form>     
      </div>
    </section>
    <?php require_once 'pie_de_pagina.php' ?>
        
        <!--Asignar Persona BCR -->
        <div id="ventana_oculta_1">
            <div id="popupventana2">
                <div id="ventana2">
                <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla2" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="text-align:center">Cedula</th>
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
                            <td style="text-align:center"><a class="btn" role="button" onclick="agregar_persona_bcr(<?php echo $personal_bcr[$i]['ID_Persona'];?>,'<?php echo $personal_bcr[$i]['Apellido_Nombre'];?>');">
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
                    <table id="tabla" class="display" cellspacing="0" width="100%">
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
                            <td style="text-align:center"><a class="btn" role="button" onclick="agregar_persona_externa(<?php echo $personal_externo[$i]['ID_Persona_Externa'];?>,
                                        '<?php echo $personal_externo[$i]['Apellido']." ".$personal_externo[$i]['Nombre'];?>');">
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
                            <th style="text-align:center">Número de UE</th>
                            <th style="text-align:center">Departamento</th>
                            <th style="text-align:center">Observaciones</th>
                            <th style="text-align:center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tam=count($unidad_ejecutora);
                        for ($i = 0; $i <$tam; $i++) { ?>  
                        <tr>
                            <td style="text-align:center"><?php echo $unidad_ejecutora[$i]['Numero_UE'];?></td>
                            <td style="text-align:center"><?php echo $unidad_ejecutora[$i]['Departamento'];?></td>
                            <td style="text-align:center"><?php echo $unidad_ejecutora[$i]['Observaciones'];?></td>
                            <td style="text-align:center"><a class="btn" role="button" onclick="agregar_ue(<?php echo $unidad_ejecutora[$i]['ID_Unidad_Ejecutora'];?>,'<?php echo $unidad_ejecutora[$i]['Departamento'];?>');">
                                    Seleccionar ATM</a></td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                </div>
            </div>
        <!--Cierre Asignar UE al personal-->
        </div> 
    </body>
</html>