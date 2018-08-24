<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Preguntas</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>
            //Funcion para ocultar ventana de mantenimiento
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            //Valida informacion completa de formulario
            function check_empty() {
                if (document.getElementById('ID_Fase').value =="") {
                    alert("Digita el nombre del Proveedor !");
                } else {
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana2').submit();
                    document.getElementById('ventana_oculta_2').style.display = "none";
                }
            }
            //Funcion para agregar un nuevo punto- formulario en blanco
            function mostrar_agregar_andru_preguntas() {
                document.getElementById('ID_Pregunta').value="0";
                document.getElementById('ID_Fase').value=null;
                document.getElementById('ID_Categoria').value=null;
                document.getElementById('Descripcion').value=null;
                document.getElementById('Estado').value=1;
                var rowstable = document.getElementById("tporcentaje").getElementsByTagName("tr").length-1;
                for(var i=0;i < rowstable;i++ ){
                    document.getElementById('tbldesc['+i+']').value ="0";
                }
                limpiar_tabla();
                document.getElementById('ventana_oculta_2').style.display = "block";                
            }
            function limpiar_tabla(){
                var myTable = document.getElementById("trespuestas");
                var rowCount = myTable.rows.length;
                
                for (var x=rowCount-1; x>0; x--) {
                    myTable.deleteRow(x);
                }                
            }
        //Funcion para editar informacion de andru_preguntas
            function Editar_andru_preguntas(pID_Pregunta,pID_Fase,pID_Categoria,pDescripcion,pEstado){
                document.getElementById('ID_Pregunta').value=pID_Pregunta;
                document.getElementById('ID_Fase').value=pID_Fase;
                document.getElementById('ID_Categoria').value=pID_Categoria;
                document.getElementById('Descripcion').value=pDescripcion;
                document.getElementById('Estado').value=pEstado;
                document.getElementById('ventana_oculta_2').style.display = "block";
                limpiar_tabla();
                $.post("index.php?ctl=andru_preguntas_porcentajes_trae", { id: pID_Pregunta}, function(data){
                    var n= data.search("No se encontró");
                    if(n==-1){
                        var res = data.substring(data.indexOf("{"), data.length);
                        var datos =JSON.parse(res);
                        
                        for(var i=0;i < Object.keys(datos).length;i++ ){
                            for(var i2=0;i2 < Object.keys(datos).length;i2++ ){                                
                                if(document.getElementById('tblId['+i2+']').value == datos[i]["ID_Tipo_Porcentaje"]){                                    
                                    document.getElementById('tbldesc['+i2+']').value =datos[i]["Valor"];
                                }
                            }
                        }
                        
                        datos=null;                        
                    } else{
                       console.log('no encontro data');
                    }
                });               
                
                $.post("index.php?ctl=andru_preguntas_respuestas_trae", { id: pID_Pregunta}, function(data){
                    var n= data.search("No se encontró");
                    if(n==-1){
                        var res = data.substring(data.indexOf("{"), data.length);
                        var datos =JSON.parse(res);
                        
                        for(var i=0;i < Object.keys(datos).length;i++ ){
                            AgregarLineaRespuesta(datos[i]["ID_Respuesta"], datos[i]["Descripcion"], datos[i]["Nivel"], datos[i]["Estado"]);
                        }                        
                        datos=null;                        
                    } else{
                       console.log('no encontro data');
                    }
                });
            };
            
            function AgregarLineaRespuesta(pid,pdesc,pnivel,pestado){
                var x = document.getElementById("trespuestas").rows.length-1;                
                var table = document.getElementById("trespuestas");
                var row = table.insertRow(1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                
                if(x<0){x=0;}
                
                cell1.innerHTML = "<input type='hidden' name='tblIdRes["+x+"]' id='tblIdRes["+x+"]' value='"+pid+"' readonly>";
                cell1.setAttribute('class','hidden')
                cell2.innerHTML = "<input class='form-control'  name='tbldescRes["+x+"]' id='tbldescRes["+x+"]' value='"+pdesc+"'>";
                cell2.setAttribute('class','text-left col-md-8')
                cell3.innerHTML = "<input type='number' min='1' max='10' class='form-control' name='tblnivelRes["+x+"]' id='tblnivelRes["+x+"]' value='"+pnivel+"'>";
                cell3.setAttribute('class','text-center col-md-2')
                if(pestado==0){
                    cell4.innerHTML = "<select class='form-control' name='tblestadoRes["+x+"]' id='tblestadoRes["+x+"]'><option value='1' >SÍ</option><option selected value='0' >NO</option>";
                }else{
                    cell4.innerHTML = "<select class='form-control' name='tblestadoRes["+x+"]' id='tblestadoRes["+x+"]'><option  selected value='1' >SÍ</option><option value='0' >NO</option>";
                }
                
                cell4.setAttribute('class','text-left col-md-2')
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Listado General de Preguntas de Andru</h2>
            <p>A continuación se detallan los registros del sistema:</p>
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID_Pregunta</th>
                        <th hidden style="text-align:center">ID_Fase</th>
                        <th hidden style="text-align:center">ID_Categoria</th>
                        <th style="text-align:center">Fase</th>
                        <th style="text-align:center">Categoría</th>
                        <th style="text-align:center">Pregunta</th>
                        <th style="text-align:center">Estado</th>
                        <th style="text-align:center">Cambiar Estado</th>
                        <th style="text-align:center">Mantenimiento</th>
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($andru_preguntas); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                        <td  hidden style="text-align:center"><?php echo $andru_preguntas[$i]['ID_Pregunta'];?></td>
                        <td hidden ><?php echo $andru_preguntas[$i]['ID_Fase'];?></td>
                        <td hidden ><?php echo $andru_preguntas[$i]['ID_Categoria'];?></td>
                        <td><?php echo $andru_preguntas[$i]['fase'];?></td>
                        <td><?php echo $andru_preguntas[$i]['categoria'];?></td>
                        <td><?php echo $andru_preguntas[$i]['Descripcion'];?></td>
                        <?php if ($andru_preguntas[$i]['Estado']==1){?>
                            <td style="text-align:center">Activo</td>
                        <?php }else {?>
                            <td style="text-align:center">Inactivo</td>
                        <?php }?>

                        <td style="text-align:center"><a href="index.php?ctl=andru_preguntas_cambiar_estado&ID_Pregunta=<?php echo $andru_preguntas[$i]['ID_Pregunta']?>&Estado=<?php echo $andru_preguntas[$i]['Estado']?>">Activar/Desactivar</a></td>
                        <td style="text-align:center"><a role="button" onclick="Editar_andru_preguntas('<?php echo $andru_preguntas[$i]['ID_Pregunta'];?>','<?php echo $andru_preguntas[$i]['ID_Fase'];?>','<?php echo $andru_preguntas[$i]['ID_Categoria'];?>','<?php echo $andru_preguntas[$i]['Descripcion'];?>','<?php echo $andru_preguntas[$i]['Estado'];?>')">Editar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a id="popup" onclick="mostrar_agregar_andru_preguntas()" class="btn btn-default" role="button">Agregar Preguntas</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        <!--agregar o editar andru_preguntas-->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
            <!--Formulario para andru_preguntas-->
                    <form id="ventana2" method="POST" name="ventana2" action="index.php?ctl=andru_preguntas_guardar">
                        <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                        <h2>Mantenimiento de Preguntas</h2> <hr>
                        <input hidden id="ID_Pregunta" name="ID_Pregunta" type="text">

                        <div class="form-group col-md-6">
                            <label for="ID_Fase">Fase</label>                            
                            <select class="form-control" id="ID_Fase" name="ID_Fase">
                                <?php $tam = count($andru_fases);
                                for($i=0; $i<$tam;$i++){  ?>
                                <option value="<?php echo $andru_fases[$i]['ID_Fase']?>"><?php echo $andru_fases[$i]['Descripcion']?></option>
                                <?php }  ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="ID_Categoria">Categoría</label>
                            <select class="form-control" id="ID_Categoria" name="ID_Categoria">       
                             <?php $tam = count($andru_catagorias);
                                for($i=0; $i<$tam;$i++){  ?>
                                <option value="<?php echo $andru_catagorias[$i]['ID_Categoria']?>"><?php echo $andru_catagorias[$i]['Descripcion']?></option>
                             <?php }  ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Descripcion">Descripción</label>                            
                            <textarea class="form-control espacio-abajo" required id="Descripcion" name="Descripcion" placeholder="Descripción" type="text"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="sel1">Estado</label>
                            <select class="form-control" id="Estado" name="Estado"> 
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        
                            <div class="row"></div>
                            
                                <ul class="nav nav-pills">
                                    <li class="active"><a data-toggle="tab" href="#Respuestas" data-toggle="tab">Respuestas</a></li>
                                    <li><a data-toggle="tab" href="#Porcentajes">Porcentajes</a></li>
                                </ul>
                            <div class="tab-content">
                                
                                <div id="Respuestas" class="tab-pane fade in active">
                                    <h3>Respuestas<a class="btn btn-info pull-right" href="javascript:%20AgregarLineaRespuesta(-1,'',1,1)" id="submit">Agregar</a>
                                    <table id="trespuestas" name="trespuestas" class="table table-striped text-center">
                                        <tr>
                                            <th hidden>IDRespuesta</th>
                                            <th class="text-center col-md-8">Descripción</th>
                                            <th class="text-center col-md-2">Nivel</th>
                                            <th class="text-center col-md-2">Visible</th>
                                        </tr>                                        
                                    </table>
                                </div>
                                <div id="Porcentajes" class="tab-pane fade">
                                    <h3>Porcentajes</h3>
                                    <table id="tporcentaje" name="tporcentaje" class="table table-striped text-center">
                                        <tr>
                                            <th class="text-center">Tipo</th>
                                            <th class="text-center">Porcentaje</th>                                                    
                                        </tr>
                                        <?php
                                        if (isset($andru_tiposporcentaje)) {
                                            $tam = count($andru_tiposporcentaje);
                                            for ($i = 0; $i < $tam; $i++) { 
                                        ?>
                                        <tr>
                                            <td hidden><input type="hidden" name="tblId[<?php echo $i; ?>]" id="tblId[<?php echo $i; ?>]" value="<?php echo $andru_tiposporcentaje[$i]['ID_Tipo_Porcentaje']; ?>" readonly> </td>
                                            <td class="text-left col-md-6" contenteditable="false" ><input class="form-control"  name="tblcol[]" id="tblcol[]" value="<?php echo $andru_tiposporcentaje[$i]['Descripcion']; ?>" readonly></td>
                                            <td class="text-left col-md-6" contenteditable="false" ><input type="number" min="100" max="200" class="form-control" name="tbldesc[<?php echo $i; ?>]" id="tbldesc[<?php echo $i; ?>]" value=""></td>                                                   
                                        </tr>
                                        <?php }} ?>
                                    </table>
                                </div>
                            </div>
                        
                        <div class="row"></div>
                        <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                    </form>
                </div>
            </div>
        <!--Cierre agregar o editar andru_preguntas-->
    </body>
</html>
