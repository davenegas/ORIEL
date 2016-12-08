<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8"/>
        <title>Lista de Supervisores de Zona</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <script>
            //Funcion para ocultar ventana de Supervisor
            function ocultar_elemento1(){
                document.getElementById('ventana_oculta_1').style.display = "none";
            }
            //Funcion chequeo editar
            function check_empty() {
                if (document.getElementById('nombre').value =="") {
                    alert("Digita el nombre!");
                } else {
            //alert("Form Submitted Successfully...");
            //Envia el formulario y lo oculta
                    document.getElementById('ventana').submit();
                    document.getElementById('ventana_oculta_1').style.display = "none";
                }
            }
            //Funcion para editar informacion de Supervisor
            function editar_supervisor(id_su,nomb,num,obser,esta){
                document.getElementById('ID_Supervisor_Zona').value=id_su;
                document.getElementById('nombre').value=nomb;
                document.getElementById('numero').value=num;
                document.getElementById('observaciones').value=obser; 
                document.getElementById('estado').value=esta; 
                document.getElementById('ventana_oculta_1').style.display = "block";
            }
            //Funcion para agregar un nuevo Supervisor 
            function ocultar_elemento2(){
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            //Funcion chequeo guardar 
            function check_empty_G() {
                if (document.getElementById('nombre2').value =="") {
                    alert("Digita el nombre!");
                } else {
                    //alert("Form Submitted Successfully...");
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana2').submit();
                    document.getElementById('ventana_oculta_2').style.display = "none";
                }
            }
            function guardar_supervisor() {
                document.getElementById('ID_Supervisor_Zona').value="0";
                document.getElementById('nombre2').value=null;
                document.getElementById('numero2').value=null;
                document.getElementById('observaciones2').value=null;
                document.getElementById('estado2').value=null;
                document.getElementById('ventana_oculta_2').style.display = "block";
            };
        </script>
        
         </head>
         <body>
   <?php require_once 'encabezado.php';?>
        
        <div class="container">
        <h2>Listado General de Supervisores de Zona BCR</h2>
        <p>A continuación se detallan los diferentes Supervisores que están registrados en el sistema por Zona:</p>            
        <table id="tabla" class="display" cellspacing="0">
          <thead>
            <tr>
              <th style="text-align:center">Nombre del Supervisor</th>
              <th style="text-align:center">Zona de Supervicion</th>
              <th style="text-align:center">Observaciones</th>
              <th style="text-align:center">Estado</th>
              <th style="text-align:center">Cambiar Estado</th>
              <th style="text-align:center">Mantenmiento</th>
            </tr>
          </thead>
    <tbody>
            <?php 
            $tam=count($params);  
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <!--<td><?php echo $params[$i]['ID_Supervisor_Zona'];?></td>-->
                <td><?php echo $params[$i]['Apellido_Nombre'];?></td>
                <td><?php echo $params[$i]['Zona_Supervisor'];?></td>
                <td><?php echo $params[$i]['Observaciones'];?></td>
                
                <?php if ($params[$i]['Estado']==1){?>  
                    <td style="text-align:center">Activo</td>
                <?php }else {?>  
                    <td style="text-align:center">Inactivo</td>
                <?php }?>
           
                  <td style="text-align:center"><a href="index.php?ctl=supervisor_zona_cambiar_estado&id=<?php echo $params[$i]['ID_Supervisor_Zona']?>&estado=<?php echo $params[$i]['Estado']?>">
                    Activar/Desactivar</a></td>
                
            <td style="text-align:center"><a role="button" onclick="editar_supervisor('<?php echo $params[$i]['ID_Supervisor_Zona'];?>',<?php echo $params [$i]['ID_Persona'];?>,
            '<?php echo $params [$i]['Zona_Supervisor'];?>','<?php echo $params [$i]['Observaciones'];?>','<?php echo $params [$i]['Estado'];?>')">
                    
                    Editar</a></td>
                    
            </tr>     
            <?php } ?>
            </tbody>
        </table>
        <a id="popup" onclick="guardar_supervisor()" class="btn btn-default" role="button">Agregar</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        <!--editar-->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <!--Formulario para editar supervisor-->
                <form id="ventana" method="POST" name="form" action="index.php?ctl=supervisor_zona_editar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento1()">
                    <h2>Supervisor de Zona</h2>
                    <hr>
                    
                    <input hidden id="ID_Supervisor_Zona" name="ID_Supervisor_Zona" type="text">
                    
                    <div class="form-group">
                        
                    <label for="nombre">Nombre del Supervisor</label>
                    <select class="form-control" id="nombre" name="nombre">
                        
                            <?php
                            $tam = count($nombre);
                            for($i=0; $i<$tam;$i++)
                            {  ?>
                            <option value="<?php echo $nombre[$i]['ID_Persona']?>"><?php echo $nombre[$i]['Apellido_Nombre']?></option>   
                            <?php }  ?>
                            </select>
                    <br>     
                    <label for="numero">Zona del Supervisor</label>
                    <select class="form-control" id="numero" name="numero">
                        
                            <?php
                            $tam = count($numero);
                            for($i=0; $i<$tam;$i++)
                            {  ?>
                            <option value="<?php echo $numero[$i]['Zona_Supervisor']?>"><?php echo $numero[$i]['Zona_Supervisor']?></option>   
                            <?php }  ?>
                            </select>
                    </div>
                     
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones">  
                    
                    <label for="estado">Estado</label>
                    <input type="text" class="form-control espacio-abajo" id="estado" name="estado" placeholder="Estado">
                    
                    <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                   
                </form> 
                
            </div>
         </div>
         <!--agregar-->
         <div id="ventana_oculta_2"> 
            <div id="popupventana2">
                <!--Formulario para guardar supervisor nuevo-->
                <form id="ventana2" method="POST" name="form" action="index.php?ctl=supervisor_zona_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento2()">
                    <h2>Supervisor de Zona</h2>
                    <hr>
                    
                    <input hidden id="ID_Supervisor_Zona" name="ID_Supervisor_Zona" type="text">
                    
                    <div class="form-group">
                        
                    <label for="nombre2">Nombre del Supervisor</label>
                    <select class="form-control" id="nombre2" name="nombre2">
                        
                            <?php
                            $tam = count($nombre);
                            for($i=0; $i<$tam;$i++)
                            {  ?>
                            <option value="<?php echo $nombre[$i]['ID_Persona']?>"><?php echo $nombre[$i]['Apellido_Nombre']?></option>   
                            <?php }  ?>
                            </select>
                    </div>
                    <br>
                    <label for="numero2">Zona de Gerencia</label>
                    <input type="text" class="form-control espacio-abajo" id="numero2" name="numero2" placeholder="Digite nueva Zona">
                    
                    <label for="observaciones2">Observaciones</label>
                    <input type="text" class="form-control espacio-abajo" id="observaciones2" name="observaciones2" placeholder="Observaciones">       
                    
                    <div class="form-group">
                    <label for="sel1">Estado</label>
                    <select class="form-control" id="estado2" name="estado2">  
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    </select>
                    </div>
                    
                   <button><a href="javascript:%20check_empty_G()" id="submit">Guardar</a></button>
                   
                </form> 
            </div>
        </div>
       
    </body>
</html>

