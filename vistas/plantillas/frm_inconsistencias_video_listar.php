<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Inconsistencias de Video</title>
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
            });
            
            //Funcion para ocultar ventana de mantenimiento de proveedor
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_1').style.display = "none";
                document.getElementById('ventana_oculta_2').style.display = "none";
                document.getElementById('ventana_oculta_3').style.display = "none";
            }
            
            
             //Valida informacion completa de formulario de proveedor
            function check_empty_va() {
                
                document.getElementById('ventana').submit();
                document.getElementById('ventana_oculta_1').style.display = "none";
                   
            }
            
             //Valida informacion completa de formulario de proveedor
            function check_empty_re() {
                
                document.getElementById('ingresar_reporte_inconsistencia').submit();
                document.getElementById('ventana_oculta_2').style.display = "none";
                   
            }
            
             //Valida informacion completa de formulario de proveedor
            function check_empty_so() {
                
                document.getElementById('ingresar_solucion_inconsistencia').submit();
                document.getElementById('ventana_oculta_3').style.display = "none";
                   
            }
            
            //Funcion para editar informacion de tipo telefono
            function edita_reportado_por(id_in,id_rev,est,id_ave,obs){     
                document.getElementById('ID_Inconsistencia_Video_RE').value=id_in;
                document.getElementById('ID_Bitacora_Revision_Video_RE').value=id_rev;
                $("#estado_reporte option[value="+est+"]").attr("selected",true);
                document.getElementById('observaciones_reporte').value=obs;
                document.getElementById('id_averia').value=id_ave;
                document.getElementById('ventana_oculta_2').style.display = "block";
            }
           
            //Funcion para editar informacion de tipo telefono
            function edita_validado_por(id_in,id_rev,est,tip_in,obs){     
                document.getElementById('ID_Inconsistencia_Video').value=id_in;
                document.getElementById('ID_Bitacora_Revision_Video').value=id_rev;
                $("#tipo_inconsistencia option[value="+tip_in+"]").attr("selected",true);
                $("#estado_validacion option[value="+est+"]").attr("selected",true);
                document.getElementById('observaciones_validacion').value=obs;
                document.getElementById('ventana_oculta_1').style.display = "block";
            }
            
            //Funcion para editar informacion de tipo telefono
            function edita_solucionado_por(id_in,id_rev,est,obs){     
                document.getElementById('ID_Inconsistencia_Video_SO').value=id_in;
                document.getElementById('ID_Bitacora_Revision_Video_SO').value=id_rev;
                $("#estado_solucion option[value="+est+"]").attr("selected",true);
                document.getElementById('observaciones_solucion').value=obs;
                document.getElementById('ventana_oculta_3').style.display = "block";
            }
            
        </script>
        
         </head>
         <body>
   <?php require_once 'encabezado.php';?>
        
        <div class="container animated fadeIn col-xs-10 quitar-float">
        <h2>Listado General de Inconsistencias Generadas desde el Control de Video</h2>
        <p>A continuación se detallan los diferentes puestos de monitoreo registrados en el sistema:</p>            
        <table id="tabla" class="display" cellspacing="0">
          <thead>
            <tr>
              <th hidden="hidden">ID_Inconsistencia_Video</th>
              <th hidden="hidden">ID_Bitacora_Revision_Video</th>
              <th hidden="hidden">ID_Unidad_Video</th>
              <th style="text-align:center">Estado</th>
              <th style="text-align:center">Unidad Video</th>
              <th style="text-align:center">Detectado por</th>
              <th style="text-align:center">Detalle</th>
              <th style="text-align:center">Puesto de Monitoreo</th>
              <th style="text-align:center">Validado por</th>
              <th style="text-align:center">Reportado por</th>
              <th style="text-align:center">Solventado por</th>
            </tr>
          </thead>
    <tbody>
            <?php 
            $tam=count($params);  
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <!--<td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-ID_PuntoBCR';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['ID_PuntoBCR'];?>','ID_PuntoBCR','Punto BCR')"><?php echo $params[$i]['Nombre'];?></td>-->
                
                <td hidden="hidden"><?php echo $params[$i]['ID_Inconsistencia_Video'];?></td>
                <td hidden="hidden"><?php echo $params[$i]['ID_Bitacora_Revision_Video'];?></td>
                <td hidden="hidden"><?php echo $params[$i]['ID_Unidad_Video'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Estado_Traducido'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Descripcion'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Detectado_Por'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Reporta_Situacion'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Nombre_Puesto'];?></td>
                <td style="text-align:center" onclick="edita_validado_por('<?php echo $params[$i]['ID_Inconsistencia_Video'];?>','<?php echo $params[$i]['ID_Bitacora_Revision_Video'];?>','<?php echo $params[$i]['Estado'];?>','<?php echo $params[$i]['Tipo_Inconsistencia'];?>','<?php echo $params[$i]['Observaciones_Validacion'];?>')"><?php echo $params[$i]['Validado_Por'];?></td>
                <td style="text-align:center" onclick="edita_reportado_por('<?php echo $params[$i]['ID_Inconsistencia_Video'];?>','<?php echo $params[$i]['ID_Bitacora_Revision_Video'];?>','<?php echo $params[$i]['Estado'];?>','<?php echo $params[$i]['ID_Averia'];?>','<?php echo $params[$i]['Observaciones_Reporte'];?>')"><?php echo $params[$i]['Reportado_Por'];?></td>
                <td style="text-align:center" onclick="edita_solucionado_por('<?php echo $params[$i]['ID_Inconsistencia_Video'];?>','<?php echo $params[$i]['ID_Bitacora_Revision_Video'];?>','<?php echo $params[$i]['Estado'];?>','<?php echo $params[$i]['Observaciones_Solucionada'];?>')"><?php echo $params[$i]['Solucionado_Por'];?></td>
                               
            </tr>     
           
            <?php } ?>
            </tbody>
        </table>
        <!--<a id="popup" onclick="mostrar_agregar_puesto_monitoreo()" class="btn btn-default" role="button">Agregar Nuevo Puesto de Monitoreo</a>-->
        </div>
       <!--agregar o editar-->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <!--Formulario para proveedor de enlaces de telecomunicaciones-->
                <form id="ventana" method="POST" name="form" action="index.php?ctl=validar_inconsistencias_video_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2 align="center">Validar Inconsistencia de Video</h2>
                    <hr>
                    
                    <input hidden id="ID_Inconsistencia_Video" name="ID_Inconsistencia_Video" type="text">
                    <input hidden id="ID_Bitacora_Revision_Video" name="ID_Bitacora_Revision_Video" type="text">
                    
                    <label for="estado_validacion">Estado Actual</label>
                    <select class="form-control" id="estado_validacion" name="estado_validacion" > 
                        <option value="0">Pendiente</option>
                        <option value="1">Atendida</option>
                        <option value="2">Validada para Reportar a SE</option> 
                    </select>
                    
                     <label for="tipo_inconsistencia">Tipo Inconsistencia</label>
                    <select class="form-control" id="tipo_inconsistencia" name="tipo_inconsistencia" > 
                        <option value="0">Cámara(s) Movida(s)</option>
                        <option value="1">Falla Color</option>
                        <option value="2">Falla Imágen</option> 
                        <option value="3">Cámara Desenfocada</option> 
                        <option value="4">Diferencia Cantidad Cámaras</option> 
                        <option value="5">Falla Grabador de Video</option> 
                        <option value="6">Sin Problemas</option> 
                    </select>
            
                    <label for="observaciones_validacion">Observaciones</label>
                    <input type="text" class="form-control espacio-abajo" id="observaciones_validacion" name="observaciones_validacion" placeholder="Observaciones de la Validación">
                                     
                   <button><a href="javascript:%20check_empty_va()" id="submit">Guardar</a></button>
                </form>
            </div>
        </div>
       
       
       <!--agregar o editar-->
        <div id="ventana_oculta_2"> 
            <div id="popupventana">
                <div id="ventana">
                <!--Formulario para proveedor de enlaces de telecomunicaciones-->
                <form id="ingresar_reporte_inconsistencia" method="POST" name="ingresar_reporte_inconsistencia" action="index.php?ctl=reportar_inconsistencias_video_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2 align="center">Reportar Inconsistencia de Video</h2>
                    <hr>
                    
                    <input hidden id="ID_Inconsistencia_Video_RE" name="ID_Inconsistencia_Video_RE" type="text">
                    <input hidden id="ID_Bitacora_Revision_Video_RE" name="ID_Bitacora_Revision_Video_RE" type="text">
                    
                    <label for="estado_reporte">Estado Actual</label>
                    <select class="form-control" id="estado_reporte" name="estado_reporte" > 
                        <option value="0">Pendiente</option>
                        <option value="1">Atendida</option>
                        <option value="3">Reportada a SE</option> 
                    </select>
                    
                     <label for="id_averia">ID Reporte Avería</label>
                    <input type="text" class="form-control espacio-abajo" id="id_averia" name="id_averia" placeholder="Número identificador de la avería">
            
                    <label for="observaciones_reporte">Observaciones</label>
                    <input type="text" class="form-control espacio-abajo" id="observaciones_reporte" name="observaciones_reporte" placeholder="Observaciones del Reporte a SE">
                                     
                   <button><a href="javascript:%20check_empty_re()" id="submit">Guardar</a></button>
                </form>
                </div>
            </div>
        </div>
       
       
       <!--agregar o editar-->
        <div id="ventana_oculta_3"> 
            <div id="popupventana">
                <div id="ventana">
                <!--Formulario para proveedor de enlaces de telecomunicaciones-->
                <form id="ingresar_solucion_inconsistencia" method="POST" name="ingresar_solucion_inconsistencia" action="index.php?ctl=solucionar_inconsistencias_video_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2 align="center">Registrar Solución de Inconsistencia de Video</h2>
                    <hr>
                    
                    <input hidden id="ID_Inconsistencia_Video_SO" name="ID_Inconsistencia_Video_SO" type="text">
                    <input hidden id="ID_Bitacora_Revision_Video_SO" name="ID_Bitacora_Revision_Video_SO" type="text">
                    
                    <label for="estado_solucion">Estado Actual</label>
                    <select class="form-control" id="estado_solucion" name="estado_solucion" > 
                        <option value="0">Pendiente</option>
                        <option value="1">Atendida</option>
                        <option value="4">Reparada por SE</option> 
                    </select>

                    <label for="observaciones_solucion">Observaciones</label>
                    <input type="text" class="form-control espacio-abajo" id="observaciones_solucion" name="observaciones_solucion" placeholder="Observaciones del Reporte a SE">
                                     
                   <button><a href="javascript:%20check_empty_so()" id="submit">Guardar</a></button>
                </form>
                </div>
            </div>
        </div>
       <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>