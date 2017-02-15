<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Tipos de Eventos</title>
        <?php require_once 'frm_librerias_head.html';?>
         <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> 
        <script>
            
            $(document).ready(function () {
                    if ( $.fn.dataTable.isDataTable('#tabla') ) {
                        table = $('#tabla').DataTable();
                    }
                    table.destroy();
                    table = $('#tabla').DataTable( {
                        stateSave: true,
                        "lengthMenu": [[10, 25, 50,100,-1], [10, 25, 50,100,"All"]]
                    });   
                    actualiza_cajas_de_texto();
                    
                     var table = document.getElementById("myTable");    
                    //alert (table.rows.length);
                    document.getElementById("identificador_filas").value=table.rows.length-2;
                    //alert (table.rows.length-2);
                    //identificador_filas
            });
            
             //Funcion para ocultar ventana de mantenimiento de proveedor
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_5').style.display = "none";
                 document.getElementById('ventana_oculta_1').style.display = "none";
            } 
        $(document).ready(function(){
            $(".Subir,.Bajar,.Eliminar").click(function(){
                //alert("10");
                var row = $(this).parents("tr:first");
                if ($(this).is(".Subir")) {
                    row.insertBefore(row.prev());
                } 
                if ($(this).is(".Bajar")) {
                    row.insertAfter(row.next());
                } 
                if ($(this).is(".Eliminar")) {
                    row.remove();
                } 

            });

        });

        function agregar_unidad_de_video_al_puesto(id_uni,nom,tipo,desc,cam,tie,id_pues){
              var table = document.getElementById("myTable");
        //    
        //    alert (table.rows.length);
        
            var identificador=parseInt(document.getElementById("identificador_filas").value)+1;
            document.getElementById("identificador_filas").value=identificador;
            //alert(identificador);
            
            $('#myTable tr:last').after('<tr><td hidden="true"  style="text-align:center">'+id_pues+'</td><td hidden="true"  style="text-align:center">'+id_uni+'</td><td style="text-align:center">'+nom+'</td><td style="text-align:center">'+desc+'</td><td style="text-align:center">'+tipo+'</td><td style="text-align:center">'+cam+'</td><td style="text-align:center" id="'+ identificador + '-Tiempo_Personalizado_Revision" onclick="edita_dato('+identificador+','+tie+')">' +tie+'</td><td><a href="#" class="Subir">Subir</a></td><td><a href="#" class="Bajar">Bajar</a></td><td><a href="#" class="Eliminar" onclick="actualiza_cajas_de_texto();">Eliminar</a></td></tr>');

            $(".Subir,.Bajar,.Eliminar").unbind('click'); 

            $(".Subir,.Bajar,.Eliminar").click(function(){
               // alert($('#myTable tr .active').index());
                var row = $(this).parents("tr:first");
                if ($(this).is(".Subir")) {
                    row.insertBefore(row.prev());
                } 
                if ($(this).is(".Bajar")) {
                    row.insertAfter(row.next());
                } 
                if ($(this).is(".Eliminar")) {
                    row.remove();
                } 

            }); 
            actualiza_cajas_de_texto();
        }
        
        function actualiza_cajas_de_texto(){
            var table = document.getElementById("myTable");    
            //alert (table.rows.length);
            document.getElementById("cantidad_unidades").value=table.rows.length-2;

            var t_camaras=0;
            var t_minutos=0;

            for (var i=2;i < table.rows.length; i++){
                t_camaras=t_camaras+Number(table.rows[i].cells[5].innerHTML);
                t_minutos=t_minutos+Number(table.rows[i].cells[6].innerHTML);
            } 
            document.getElementById("cantidad_camaras").value=t_camaras;
            document.getElementById("tiempo_minutos").value= Math.round(t_minutos/60); 
        }

        function guardar_cambios_puesto_monitoreo(){
            var $rows= $("#myTable tbody tr");      
            var data = [];

            $rows.each(function(row, v) {
                $(this).find("td").each(function(cell, v) {
                    if (typeof data[cell] === 'undefined') {
                        data[cell] = [];
                    }
                    data[cell][row] = $(this).text();
                });
            });
             $.post("index.php?ctl=actualiza_puesto_de_monitoreo", {data: data});
                       
             document.location.href="index.php?ctl=puestos_de_monitoreo_listar";
        }
        
         //Valida informacion completa de formulario de notas de coordinacion
            function mostrar_unidades_de_video_sin_puesto_de_monitoreo() {
           
                  document.getElementById('ventana_oculta_5').style.display = "block";

            }    
            
            //Valida informacion completa de formulario de notas de coordinacion
            function edita_dato(id_unidad,texto) {
                //document.getElementById('titulo_ventana_oculta').innerHTML=titulo;
                //alert(document.getElementById("identificador_filas").value);
                document.getElementById('ID_Unidad_Video').value=id_unidad;
                document.getElementById('campo_a_editar').value="Tiempo_Personalizado_Revision";
                document.getElementById('detalle').value=document.getElementById(document.getElementById('ID_Unidad_Video').value+'-'+document.getElementById('campo_a_editar').value).innerHTML;
                document.getElementById('ventana_oculta_1').style.display = "block";        
            }
            
             //Valida informacion completa de formulario de proveedor
            function check_empty() {
                if (document.getElementById('detalle').value =="") {
                    alert("Digita el tiempo expresado en segundos!");
                } else {
                    if (isNaN(document.getElementById('detalle').value)) {
                        alert("Digita un valor númerico para el tiempo personalizado de revisión de esta unidad de video!");
                    }  else{ 
                        //document.getElementById('ventana').submit();
                        document.getElementById(document.getElementById('ID_Unidad_Video').value+'-'+document.getElementById('campo_a_editar').value).innerHTML=document.getElementById('detalle').value;
                        document.getElementById('ventana_oculta_1').style.display = "none";
                    }
                }
            }   
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <!--<div class="container">-->
            
        <div class="col-md-5">
            <h3>Puesto de Monitoreo: <?php echo $_GET['nombre'];?></h3>
            <p>A continuación se detallan las Unidades de Video ligadas al puesto de monitoreo en orden de revisión del operador:</p>   
            <label id="cantidad_unidade" for="cantidad_unidades" style="text-align:center">#Unidades:</label>
            <input id="cantidad_unidades" name="cantidad_unidades" type="text" size="6" value="" style="text-align:center" readonly> 
            <label id="tiempo_minuto" for="tiempo_minutos" style="text-align:center">Tiempo(minutos):</label>
            <input id="tiempo_minutos" name="tiempo_minutos" type="text" size="6" value="" style="text-align:center" readonly> 
            <label id="cantidad_camara" for="cantidad_camaras" style="text-align:center">#Cámaras:</label>
            <input id="cantidad_camaras" name="cantidad_camaras" type="text" size="6" value="" style="text-align:center" readonly> 
            <br><br>
            
            <a id="popup" onclick="guardar_cambios_puesto_monitoreo()" class="btn btn-default" role="button">Guardar Cambios y Volver al Listado</a>
            <a href="index.php?ctl=puestos_de_monitoreo_listar" class="btn btn-default" role="button">Cancelar</a>
        <table id="myTable" class="table table-hover">
            <thead>
            <tr>
               <th hidden="hidden" style="text-align:center">Id Puesto Monitoreo</th>
               <th hidden="hidden" style="text-align:center">Id Unidad Video</th>
               <th style="text-align:center">Punto BCR</th>
               <th style="text-align:center">Descripción</th>
               <th style="text-align:center">Tipo Punto</th>
               <th style="text-align:center">Cámaras</th>
               <th style="text-align:center">Tiempo Revisión(segundos)</th>
              <th></th> 
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <tr hidden="hidden">
                <td hidden="hidden" style="text-align:center"><?php echo $_GET['id'];?></td>
                <td hidden="hidden" style="text-align:center">Temporal</td>
                <td style="text-align:center">Temporal</td>
                <td style="text-align:center">Temporal</td>
                <td style="text-align:center">Temporal</td>
                <td style="text-align:center">Temporal</td>
                <td style="text-align:center">Temporal</td>
                <td>
                    <a href="#" class="Subir">Subir</a>    
               </td>
               <td>
                   <a href="#" class="Bajar">Bajar</a>
               </td>
                <td>
                    <a href="#" class="Eliminar" onclick="actualiza_cajas_de_texto();">Eliminar</a>
               </td>
          </tr>
          
          <?php 
                $tam=count($unidades_asociadas_al_puesto);
                for ($i = 0; $i <$tam; $i++) {
                //Solamente muestra los puntos activos o todos a quien puede cambiar el estado             
                ?>
                <tr>
                    <td hidden="hidden" style="text-align:center"><?php echo $unidades_asociadas_al_puesto[$i]['ID_Puesto_Monitoreo'];?></td>
                    <td hidden="hidden" style="text-align:center"><?php echo $unidades_asociadas_al_puesto[$i]['ID_Unidad_Video'];?></td>
                    <td style="text-align:center"><?php echo $unidades_asociadas_al_puesto[$i]['Nombre'];?></td>
                    <td style="text-align:center"><?php echo $unidades_asociadas_al_puesto[$i]['Descripcion'];?></td>
                    <td style="text-align:center"><?php echo $unidades_asociadas_al_puesto[$i]['Tipo_Punto'];?></td>
                    <td style="text-align:center"><?php echo $unidades_asociadas_al_puesto[$i]['Camaras_Habilitadas'];?></td>
                    <td style="text-align:center" id="<?php echo ($i+1).'-Tiempo_Personalizado_Revision';?>" onclick="edita_dato('<?php echo ($i+1);?>','<?php echo $unidades_asociadas_al_puesto[$i]['Tiempo_Personalizado_Revision'];?>')"><?php echo $unidades_asociadas_al_puesto[$i]['Tiempo_Personalizado_Revision'];?></td>
                    
                    <td>
                        <a href="#" class="Subir">Subir</a>    
                    </td>
                    <td>
                       <a href="#" class="Bajar">Bajar</a>
                    </td>
                    <td>
                        <a href="#" class="Eliminar" onclick="actualiza_cajas_de_texto();">Eliminar</a>
                    </td>
                </tr>     
            <?php } ?>
          
          </tbody> 
           
       
        
      </table>
            <!--<button onclick="myFunction()">Try it</button>-->
        </div>
         <div class="col-md-7">
            <h3>Lista de Unidades de Video</h3>    
            <a role="button" onclick="mostrar_unidades_de_video_sin_puesto_de_monitoreo();">Unidades de video no asignadas en puestos de monitoreo</a></td>
            <p>A continuación se detallan las Unidades de Video que están registradas en el sistema con un Punto BCR relacionado:</p>   
        <table id="tabla" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th hidden style="text-align:center">ID Unidad de Video</th>
                    <th style="text-align:center">Punto BCR</th>
                    <th style="text-align:center">Provincia</th>
                    <th style="text-align:center">Descripción</th>
                    <th style="text-align:center">Tipo de Punto</th>
                    <th style="text-align:center">#Serie</th>
                    <th style="text-align:center">Mac Address</th>
                    <th style="text-align:center">#Cámaras</th>   
                </tr>
          </thead>
          <tbody>
                <?php 
                $tam=count($params);
                for ($i = 0; $i <$tam; $i++) {
                //Solamente muestra los puntos activos o todos a quien puede cambiar el estado             
                ?>
                <tr>
                    <td hidden style="text-align:center"><?php echo $params[$i]['ID_Unidad_Video'];?></td>                   
                    <td style="text-align:center"><a href="#" onclick="agregar_unidad_de_video_al_puesto('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Nombre'];?>','<?php echo $params[$i]['Tipo_Punto'];?>','<?php echo $params[$i]['Descripcion'];?>','<?php echo $params[$i]['Camaras_Habilitadas'];?>','<?php echo $tiempo_estandar;?>','<?php echo $_GET['id'];?>');"><?php echo $params[$i]['Nombre'];?></a></td>
                    
                    <td style="text-align:center"><?php echo $params[$i]['Nombre_Provincia'];?></td>
                    <td style="text-align:center"><?php echo $params[$i]['Descripcion'];?></td>
                    <td style="text-align:center"><?php echo $params[$i]['Tipo_Punto'];?></td>
                    <td style="text-align:center"><?php echo $params[$i]['Serie'];?></td>
                    <td style="text-align:center"><?php echo $params[$i]['Mac_Address'];?></td>
                    <td style="text-align:center"><?php echo $params[$i]['Camaras_Habilitadas'];?></td>
                </tr>     
            <?php } ?>
            </tbody>
        </table>
         </div>

        <div id="ventana_oculta_5">
            <div id="popupventana2">
                <div id="ventana2">
                <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla4" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="text-align:center">Código</th>
                            <th style="text-align:center">Nombre</th>
                            <th style="text-align:center">Tipo</th>
                            <th style="text-align:center">Provincia</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tama=count($unidades_video_sin_puesto_monitoreo);
                        for ($i = 0; $i <$tama; $i++) { ?>  
                        <tr>
                            <td style="text-align:center"><?php echo $unidades_video_sin_puesto_monitoreo[$i]['Nombre'];?></td>
                            <td style="text-align:center"><?php echo $unidades_video_sin_puesto_monitoreo[$i]['Nombre_Provincia'];?></td>
                            <td style="text-align:center"><?php echo $unidades_video_sin_puesto_monitoreo[$i]['Descripcion'];?></td>
                            <td style="text-align:center"><?php echo $unidades_video_sin_puesto_monitoreo[$i]['Camaras_Habilitadas'];?></td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                </div>
            </div>
        <!--Cierre Asignar UE a Punto BRC-->
        </div> 
        <!--</div>-->
        
        
         <!--Agregar o Editar Campos de la tabla -->
        <div id="ventana_oculta_1"> 
            <div id="popupventana2">
                <!--Formulario para actualización-->
                <!--<form id="ventana" method="POST" name="form" action="index.php?ctl=editar_campo_unidades_de_video">-->
                <div id="ventana" class="text-center">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2 align="center" id="titulo_ventana_oculta">Tiempo Personalizado de Revisión:</h2>
                    <hr>
                    <input hidden id="identificador_filas" name="identificador_filas" type="text" value="">
                    <input hidden id="ID_Unidad_Video" name="ID_Unidad_Video" type="text" value="">
                    <input hidden id="campo_a_editar" name="campo_a_editar" type="text" value="">
                    <label id="titulo_campo_ventana_oculta" for="detalle">Cantidad de Segundos:</label>
                    <input id="detalle" name="detalle" type="text" value="">            
                    <hr>
                    <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                </div>
                <!--</form>-->
            </div>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>