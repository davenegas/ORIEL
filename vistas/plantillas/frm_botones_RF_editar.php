<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión Botones Guardados</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_cencon.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
        <script>  
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_2').style.display = "none";
                document.getElementById('ventana_oculta_3').style.display = "none";
            }
            
            function buscar_persona(){
                document.getElementById('ventana_oculta_2').style.display= "block";
            }
            
            function agregar_persona(id){
                document.getElementById('ID_Persona').value=id;
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            
            //Funcion seleccionar punto
            function buscar_punto(){
                document.getElementById('ventana_oculta_3').style.display= "block";
            }
            
            //Funcion seleccionar punto
            function agregar_punto(id) {
                document.getElementById('ID_PuntoBCR').value=id;
                document.getElementById('ventana_oculta_3').style.display= "none";   
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <section class="container">
            <div class="container">
                <div class="col-sm-5"> 
                    <h2>Edicion de Botones</h2>
                    <p>Informacion general del boton programado:</p>
                </div>
            </div> 
            <br> 
            <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=botones_editar&ID_Boton=<?php echo $botones_rf[0]['ID_Boton'];?>"> 
                <div class="container">
                    <div class="col-sm-4">
                        <label for="punto">ID Punto BCR<a id="popup" onclick="buscar_punto()" class="btn azul" role="button">Actualizar Punto</a></label>
                        <input type="text" class="form-control" id="ID_PuntoBCR" name="ID_PuntoBCR" value="<?php echo $botones_rf[0]['ID_PuntoBCR'].' '.$botones_rf[0]['Nombre'];?>">
                    </div>
                    <div class="col-sm-4">
                        <label for="usuario">ID Funcionario BCR<a id="popup" onclick="buscar_persona()" class="btn azul" role="button">Actualizar Persona</a></label>
                        <input type="text" class="form-control" id="ID_Persona" name="ID_Persona" value="<?php echo $botones_rf[0]['ID_Persona'].' '.$botones_rf[0]['Apellido_Nombre'];?>">
                    </div> 
                    <div class="col-sm-4">
                        <label for="tipo_panel">Tipo de Panel<a id="popup" onclick="...()" class="btn azul" role="button">(Modelo)</a></label>
                        <input type="text" readonly="readonly" class="form-control" id="tipo_panel" name="tipo_panel" value="<?php echo $botones_rf[0]['Tipo_Panel'];?>">
                    </div>
                </div>
                <br>
                <div class="container">
                    <div class="col-sm-4">
                        <label for="numero_zona">Numero de Zona</label>
                        <input type="text" class="form-control" id="numero_zona" name="numero_zona" placeholder="Digite el numero de zona" value="<?php echo $botones_rf[0]['Numero_Zona'];?>"> 
                    </div>
                    <div class="col-sm-4">
                        <label for="tipo_respuesta">Tipo de Respuesta</label>
                        <input type="text" readonly="readonly" class="form-control" id="tipo_respuesta" name="tipo_respuesta" placeholder="Digite el numero de zona" value="<?php echo $botones_rf[0]['Tipo_Respuesta'];?>">     
                    </div>
                    <div class="container">
                        <div class="col-sm-4">
                            <label for="tipo_entrada">Tipo de Entrada</label>
                            <input type="text" readonly="readonly" class="form-control" id="tipo_entrada" name="tipo_entrada" placeholder="Digite el numero de zona" value="<?php echo $botones_rf[0]['Tipo_Entrada'];?>">         
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-4">
                        <label for="numero_serie">Numero de Serie</label>
                        <input type="text" class="form-control espacio-abajo" id="numero_serie" name="numero_serie" placeholder="Serie del Dispositivo" value="<?php echo $botones_rf[0]['Numero_Serie'];?>"> 
                    </div>
                    <div class="col-sm-4">
                        <label for="observaciones">Observaciones</label>
                        <input type="text" class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones" value="<?php echo $botones_rf[0]['Observaciones'];?>">       
                    </div>
                    <div class="col-sm-4">
                        <label for="sel1">Estado</label>
                        <select class="form-control" id="estado" name="estado" >
                            <?php if ($botones_rf[0]['Estado']==1){ ?>
                                <option value="1" selected="selected">Activo</option>
                                <option value="0">Inactivo</option>  
                            <?php  }  else { ?>
                               <option value="1">Activo</option>
                               <option value="0" selected="selected">Inactivo</option>   
                            <?php } ?>  
                        </select>  
                    </div>
                </div>
                <div class="container">
                    <div class="col-sm-4">    
                        <button type="submit" class="btn btn-default">Guardar</button>
                        <a href="index.php?ctl=botones_listar" class="btn btn-default" role="button">Cancelar</a> 
                    </div>
                </div>
            </form> 
        </section>
        <!--Formulario para Asignar Personal-->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Personal-->
                    <h3 class="bordegris text-center">Seleccione el Funcionario</h3>
                    <table id="tabla" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">ID</th>
                                <th style="text-align:center">Cedula</th>
                                <th style="text-align:center">Nombre</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($personal_bcr);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $personal_bcr[$i]['ID_Persona'];?></td>
                                    <td style="text-align:center"><?php echo $personal_bcr[$i]['Cedula'];?></td>
                                    <td style="text-align:center"><?php echo $personal_bcr[$i]['Apellido_Nombre'];?></td>
                                    <td style="text-align:center"><a class="btn" role="button" onclick="agregar_persona(<?php echo $personal_bcr[$i]['ID_Persona'];?>,'<?php echo $personal_bcr[$i]['Apellido_Nombre'];?>');">
                                            Seleccionar Persona</a></td>
                                </tr>
                            <?php } ?>
                         </tbody>
                    </table>
                </div>
            </div>
        </div> 
        <!--Formulario para Asignar Oficina BCR-->        
        <div id="ventana_oculta_3">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h3 class="bordegris text-center">Seleccione Oficina BCR</h3>
                    <table id="tabla3" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">ID</th>
                                <th style="text-align:center">Codigo</th>
                                <th style="text-align:center">Nombre</th>
                                <th style="text-align:center">Direccion</th>
                                <th style="text-align:center">Observaciones</th>
                                <th style="text-align:center">Opcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam = count($puntos_bcr);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $puntos_bcr[$i]['ID_PuntoBCR'];?></td>
                                    <td style="text-align:center"><?php echo $puntos_bcr[$i]['Codigo'];?></td>
                                    <td style="text-align:center"><?php echo $puntos_bcr[$i]['Nombre'];?></td>
                                    <td style="text-align:center"><?php echo $puntos_bcr[$i]['Direccion'];?></td>
                                    <td style="text-align:center"><?php echo $puntos_bcr[$i]['Observaciones'];?></td>
                                    <td style="text-align:center"><a class="btn" role="button" onclick="agregar_punto(<?php echo $puntos_bcr[$i]['ID_PuntoBCR'];?>,'<?php echo $puntos_bcr[$i]['Nombre'];?>');">
                                        Seleccionar Punto</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>
