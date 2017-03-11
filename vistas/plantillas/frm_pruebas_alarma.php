<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pruebas Alarma</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_pruebas.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> 
        <?php require_once 'frm_librerias_head.html'; ?>
        <script>
            function aplicar_seguridad(datos){
                var variable= <?php echo $_SESSION['modulos']['Editar- Pruebas de Alarma']?>;

                if(variable==0){
                    if(datos['ID_Persona_Reporta_Apertura']!=null){
                        document.getElementById('nombre_persona_prueba').disabled="true";
                        document.getElementById('tipo_prueba').disabled="true";
                        document.getElementById('revision_atm').disabled="true";
                    } else {
                        document.getElementById('nombre_persona_prueba').removeAttribute("disabled");
                        document.getElementById('tipo_prueba').removeAttribute("disabled");
                        document.getElementById('revision_atm').removeAttribute("disabled");
                    }
                    if(datos['Hora_Apertura_Alarma']!=null){
                        document.getElementById('hora_apertura').disabled="true";
                    } else {
                        document.getElementById('hora_apertura').removeAttribute("disabled");
                    }
                    if(datos['Hora_Prueba_Alarma']!=null){
                        document.getElementById('hora_prueba').disabled="true";
                        document.getElementById('zona_prueba').disabled="true";
                    } else {
                        document.getElementById('hora_prueba').removeAttribute("disabled");
                        document.getElementById('zona_prueba').removeAttribute("disabled");
                    }
                    if(datos['Hora_Cierre_Alarma']!=null){
                        document.getElementById('hora_cierre').disabled="true";
                    } else {
                        document.getElementById('hora_cierre').removeAttribute("disabled");
                    }
                    if(datos['ID_Persona_Reporta_Cierre']==null ){
                        document.getElementById('nombre_persona_cierre').value="";
                    }
                }
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container-fluid text-center">
            <h2>Pruebas de Alarma</h2> 
            <div class="row content">
                <!--Se mantienen este div para dejar espacio a la izquierda de la tabla-->    
                <div class="col-sm-1 sidenav">
                </div>
                <!--DIV central contiene la tabla con el personal externo-->    
                <div class="col-sm-8 container">
                    
                    <h4>Registrar pruebas de alarma
                        <?php if($_SESSION['modulos']['Editar- Pruebas de Alarma']==1){ ?>
                            <a onclick="eliminar_registro_prueba()" class="btn azul" role="button"><img src='vistas/Imagenes/cerrarAlert.jpg' width="25"></a>
                        <?php } ?>
                    </h4>
                    <input type="text" hidden id="ID_PuntoBCR" name="ID_PuntoBCR"  value="0">
                    <input type="text" hidden id="ID_Prueba_Alarma" name="ID_Prueba_Alarma" value="0">
                    <input type="text" hidden id="ID_Persona_Reporta_Apertura" name="ID_Persona_Reporta_Apertura"  value="0">
                    <input type="text" hidden id="ID_Persona_Reporta_Cierre" name="ID_Persona_Reporta_Cierre"  value="0">
                    
                    <div class="col-sm-4 espacio-abajo-5">
                        <label for="numero_punto">Código de agencia</label>
                        <input type="text" class="form-control" id="numero_punto" name="numero_punto" onblur="evento_buscar_puntobcr();" onfocus="borrar_datos();" placeholder="Digite el código de la agencia">
                    </div>
                    <div class="col-sm-4 espacio-abajo-5">
                        <label for="nombre_punto">Nombre de la agencia</label>
                        <input type="text" class="form-control" disabled id="nombre_punto" name="nombre_punto" placeholder="">
                    </div>
                    <div class="col-sm-4 espacio-abajo-5">
                        <label for="tipo_punto">Tipo de agencia</label>
                        <input type="text" class="form-control" disabled id="tipo_punto" name="tipo_punto" placeholder="">
                    </div>
                    <div class="col-sm-4 espacio-abajo">
                        <label for="nombre_persona_prueba">Persona reporta prueba alarma</label>
                        <input type="text" class="form-control" id="nombre_persona_prueba" readonly onclick="buscar_persona_prueba();" name="nombre_persona" placeholder="Click para buscar la persona" title="Usuario no Disponible">
                    </div>
                    <div class="col-sm-4 espacio-abajo">
                        <label for="empresa_persona">Empresa de la persona</label>
                        <input type="text" class="form-control" disabled id="empresa_persona" name="empresa_persona" placeholder="">
                    </div>
                    <div class="col-sm-2 espacio-abajo">
                        <label for="tipo_prueba">Tipo Prueba</label>
                        <select class="form-control" id="tipo_prueba" name="tipo_prueba" onchange="guardar_registro_prueba('Tipo_Prueba');">
                            <option value="Panico">Panico</option>
                            <option value="Intrusion">Intrusión</option>
                            <option value="Fuego">Fuego</option>
                        </select>
                    </div>
                    <div class="col-sm-2 espacio-abajo">
                        <label for="revision_atm">Revisión cajero</label>
                        <select class="form-control" id="revision_atm" name="revision_atm" onchange="guardar_registro_prueba('Tipo_Prueba');">
                            <option value="NO">No</option>
                            <option value="SI">Si</option>
                            <option value="NA">NA</option>
                        </select>
                    </div>
                    <div class="col-sm-4 espacio-abajo">
                        <label for="hora_apertura">Hora apertura agencia SIS</label>
                        <input type="time"  class="form-control" id="hora_apertura" name="hora_apertura" value="" onblur="guardar_apertura();" title="Usuario no Disponible">
                    </div>
                    <div class="col-sm-4 espacio-abajo">
                        <label for="hora_prueba">Hora prueba de alarma</label>
                        <input type="time"  class="form-control" id="hora_prueba" name="hora_prueba" value="" onblur="guardar_prueba_alarma();">
                    </div>
                    <div class="col-sm-4 espacio-abajo">
                        <label for="zona_prueba">Número de zona prueba</label>
                        <input type="number" class="form-control" id="zona_prueba" name="zona_prueba" onchange="guardar_prueba_alarma();">
                    </div>
                    <div class="col-sm-4 espacio-abajo-5">
                        <label for="nombre_persona_cierre">Persona consulta cierre alarma</label>
                        <input type="text" class="form-control" id="nombre_persona_cierre" readonly onchange="buscar_persona_prueba();" onclick="buscar_persona_prueba();" name="nombre_persona_cierre" placeholder="Click para buscar la persona" title="Usuario no Disponible">
                    </div>
                    <div class="col-sm-4 espacio-abajo-5">
                        <label for="cuentas_secundarias">Cierre cuenta(s) secundaria(s)</label>
                        <select class="form-control" id="cuentas_secundarias" name="cuentas_secundarias" onchange="guarda_reporte_cuenta();">
                            <option value=""></option>
                            <option value="Se confirman los cierres">Se confirman los cierres</option>
                            <option value="Partición(es) abierta(s)">Partición(es) abierta(s)</option>
                        </select>
                    </div>
                    <div class="col-sm-4 espacio-abajo-5">
                        <label for="cuenta_principal">Cierre cuenta principal</label>
                        <select class="form-control" id="cuenta_principal" name="cuenta_principal" onchange="guarda_reporte_cuenta();">
                            <option value=""></option>
                            <option value="Se confirma el cierre">Se confirma el cierre</option>
                            <option value="Partición abierta">Partición abierta</option>
                        </select>
                    </div>
                    <div class="col-sm-4 espacio-abajo-5">
                        <label for="hora_cierre">Hora cierre agencia SIS</label>
                        <input type="time"  class="form-control" id="hora_cierre" name="hora_cierre" onblur="guardar_cierre();" title="Usuario no Disponible">
                    </div>
                    <div class="col-sm-4 espacio-abajo-5">
                        <label for="seguimiento">Seguimiento</label>
                        <select class="form-control" id="seguimiento" name="seguimiento" onchange="guarda_seguimiento();">
                            <option value="0"></option>
                            <option value="Se solicitó la prueba">Se solicitó la prueba</option>
                            <option value="Oficina en asueto">Oficina en Asueto</option>
                            <option value="Oficina con trabajos">Oficina con Trabajos</option>
                        </select>
                    </div>  
                    <div class="col-md-4 espacio-abajo-5">
                        <label for="observaciones">Observaciones</label>
                        <input type="text"  class="form-control" id="observaciones" name="observaciones" onchange="guardar_observaciones();" placeholder="Observaciones o comentarios de la prueba de alarma">
                    </div>
                      
                    <!--<div>
                        <h4><b>Pruebas de alarma Reportadas</b></h4>
                        <table id="tabla4" class="display" cellspacing="0" width="100%">
                        </table>
                    </div>-->
                </div>

                <div class="col-sm-3 sidenav">
                    <?php if(isset($pruebas_pendientes)){?>
                        <div class="well" align="left">
                            <p><b>Pruebas pendientes</b></p>
                            <?php 
                            $tam=$tam=count($pruebas_pendientes);
                            for ($i = 0; $i <$tam; $i++) {?>
                                <p style="<?php echo $pruebas_pendientes[$i]['Color']?>"><?php echo "- ".$pruebas_pendientes[$i]['Mensaje'];?></p>
                            <?php }?>   
                        </div>
                    <?php } ?>
                    
                    <?php if(isset($aperturas_pendietes)){?>
                        <div class="well" align="left">
                            <p><b>Aperturas pendientes</b></p>
                            <?php 
                            $tam=$tam=count($aperturas_pendietes);
                            for ($i = 0; $i <$tam; $i++) {?>
                                <p style="<?php echo $aperturas_pendietes[$i]['Color']?>"><?php echo "- ".$aperturas_pendietes[$i]['Mensaje'];?></p>
                            <?php }?>   
                        </div>
                    <?php } ?>
                    
                    <?php if(isset($cierres_pendientes)){?>
                        <div class="well" align="left">
                            <p><b>Cierres pendientes</b></p>
                            <?php 
                            $tam=$tam=count($cierres_pendientes);
                            for ($i = 0; $i <$tam; $i++) {?>
                                <p style="<?php echo $cierres_pendientes[$i]['Color']?>"><?php echo "- ".$cierres_pendientes[$i]['Mensaje'];?></p>
                            <?php }?>   
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>

        <!--Asignar Persona para prueba -->
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
                            $tam=count($params);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $params[$i]['Cedula'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Apellido_Nombre'];?></td>
                                    <td style="text-align:center"><?php echo $params[$i]['Empresa'];?></td>
                                    <td style="text-align:center">
                                        <a class="btn" role="button" onclick="agregar_persona_prueba(<?php echo $params[$i]['ID_Persona'];?>,'<?php echo $params[$i]['Cedula'];?>',
                                        '<?php echo $params[$i]['Apellido_Nombre'];?>','<?php echo $params[$i]['Empresa'];?>',<?php echo $params[$i]['ID_Empresa'];?>);">
                                            Reporta Prueba</a>
                                        <a class="btn" role="button" onclick="agregar_persona_cierre(<?php echo $params[$i]['ID_Persona'];?>,'<?php echo $params[$i]['Cedula'];?>',
                                        '<?php echo $params[$i]['Apellido_Nombre'];?>','<?php echo $params[$i]['Empresa'];?>',<?php echo $params[$i]['ID_Empresa'];?>);">
                                            Reporta Cierre</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <!--Cierre Asignar Personal-->
        </div> 
    </body>
</html>
