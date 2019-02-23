<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de recepcion_puesto</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>
            function ver_lugar(pID_RecepcionTipo)
            {
                 if(pID_RecepcionTipo==1)
                {                    
                    var idpuesto = document.getElementById('ID_Recepcion_Puesto').value;
                    var idapertura = document.getElementById('ID_Recepcion_Apertura').value;
                    var idUsuarioApertura = document.getElementById('ID_Usuario_Apertura').value;
                    var $form = $("<form />");
                    $form.attr("action","index.php?ctl=recepcion_visita_lugares");
                    $form.attr("method","POST");
                    $form.append('<input type="hidden" name="ID_Recepcion_Apertura" value="'+idapertura+'" />');
                    $form.append('<input type="hidden" name="ID_Usuario_Apertura" value="'+idUsuarioApertura+'" />');
                    $("body").append($form);
                    $form.submit();
                }
                if(pID_RecepcionTipo==2)
                {                    
                    var idpuesto = document.getElementById('ID_Recepcion_Puesto').value;
                    var idapertura = document.getElementById('ID_Recepcion_Apertura').value;
                    var idUsuarioApertura = document.getElementById('ID_Usuario_Apertura').value;
                    var $form = $("<form />");
                    $form.attr("action","index.php?ctl=recepcion_inventario_lugares");
                    $form.attr("method","POST");
                    $form.append('<input type="hidden" name="ID_Recepcion_Apertura" value="'+idapertura+'" />');
                    $form.append('<input type="hidden" name="ID_RecepcionPuesto" value="'+idpuesto+'" />');
                    $form.append('<input type="hidden" name="ID_RecepcionTipo" value="'+pID_RecepcionTipo+'" />');
                    $form.append('<input type="hidden" name="ID_Usuario_Apertura" value="'+idUsuarioApertura+'" />');
                    $("body").append($form);
                    $form.submit();
                }
            }
            function borrar_detalle_linea(pID_RecepcionInventario)
            {
                var idpuesto = document.getElementById('ID_Recepcion_Puesto').value;
                $.confirm({
                    title: 'Confirmación!',
                    content: '¿Desea borrar esta línea de detalle?',
                    confirm: function(){
                        $.post("index.php?ctl=recepcion_inventario_borrar", {ID_RecepcionInventario: pID_RecepcionInventario},function(data){
                            //console.log(data);
                            var srt = data;
                            var n= srt.search("borradoinventario");
                            refrescarpagina(idpuesto);
                        });
                    },
                    cancel: function(){
                    }
                });
            }
            //Valida informacion completa de formulario
            function check_empty() {
                var idpuesto = document.getElementById('ID_Recepcion_Puesto').value;
                var idapertura = document.getElementById('ID_Recepcion_Apertura').value;
                var descrip = document.getElementById('Descripcion').value;
                if (document.getElementById('Descripcion').value =="") {
                    alert("Por favor ingrese una descripción !");
                } else {                    
                    //Envia el formulario
                     $.post("index.php?ctl=recepcion_apertura_guardar", {ID_Recepcion_Apertura: idapertura,Descripcion: descrip},function(data){
                            console.log(data);
                            var srt = data;
                            var n= srt.search("guardado");
                           //alert(data);
                            if(n>0){
                                refrescarpagina(idpuesto);
                            }
                        });
                }
            }
            //Valida informacion completa de formulario
            function check_empty_inventario() {
                var idpuesto = document.getElementById('ID_Recepcion_Puesto').value;
                var idapertura = document.getElementById('ID_Recepcion_Apertura').value;
                var descrip = document.getElementById('DescripcionInv').value;
                if (document.getElementById('DescripcionInv').value =="") {
                    alert("Por favor ingrese una descripción !");
                } else {                    
                    //Envia el formulario
                     $.post("index.php?ctl=recepcion_inventario_guardar", {ID_Recepcion_Apertura: idapertura,Descripcion: descrip},function(data){
                            console.log(data);
                            var srt = data;
                            var n= srt.search("guardadoinventario");
                           //alert(data);
                            if(n>0){
                                refrescarpagina(idpuesto);
                            }
                        });
                }
            }
            function refrescarpagina(idpuesto)
            {
                var $form = $("<form />");
                $form.attr("action","index.php?ctl=recepcion_puesto_apertura");
                $form.attr("method","POST");
                $form.append('<input type="hidden" name="ID_RecepcionPuesto" value="'+idpuesto+'" />');
                $("body").append($form);
                $form.submit();
            }
            function Liberar_recepcion_puesto(){
                var pID_RecepcionPuesto = document.getElementById('ID_Recepcion_Puesto').value;
                var pNombre = document.getElementById('NomPuesto').value;
                var pID_Usuario = 0;
                $.confirm({
                    title: 'Confirmación!',
                    content: 'Desea liberar el puesto: '+pNombre+' ?',
                    confirm: function(){
                        $.post("index.php?ctl=recepcion_apertura_liberar", {ID_RecepcionPuesto: pID_RecepcionPuesto, ID_Usuario:pID_Usuario},function(data){
                            document.location.href="index.php?ctl=recepcion_puesto_tomar";
                        });
                    },
                    cancel: function(){
                    }
                });
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <a class="btn btn-info pull-right" href="index.php?ctl=recepcion_puesto_tomar" id="regresar">Regresar</a>
            <div class="col-md-8">                
                <form id="apertura_datos" method="POST" name="apertura_datos" action="index.php?ctl=recepcion_apertura_guardar">
                    <input hidden required id="NomPuesto" name="NomPuesto" placeholder="NomPuesto" type="text" value="<?php echo $recep_puestoApertura[0]['Puesto']?>">
                    <input hidden required id="ID_Recepcion_Apertura" name="ID_Recepcion_Apertura" placeholder="ID_Recepcion_Apertura" type="text" value="<?php echo $recep_puestoApertura[0]['ID_Recepcion_Apertura']?>">
                    <input hidden required id="ID_Recepcion_Puesto" name="ID_Recepcion_Puesto" placeholder="ID_Recepcion_Puesto" type="text" value="<?php echo $recep_puestoApertura[0]['ID_RecepcionPuesto']?>">
                    <input hidden required id="ID_Usuario_Apertura" name="ID_Usuario_Apertura" placeholder="ID_Usuario_Apertura" type="text" value="<?php echo $recep_puestoApertura[0]['ID_Usuario_Apertura']?>">
                    <input hidden required id="ID_UsuarioLog" name="ID_UsuarioLog" placeholder="ID_UsuarioLog" type="text" value="<?php echo $UsuarioSIS?>">
                    <h2>Puesto: <?php echo $recep_puestoApertura[0]['Puesto']?></h2>
                    <h3>A continuación se detalla la información del puesto:</h3>
                    <div class="form-group col-md-6">
                        <label for="UsuarioApertura">Usuario Apertura Puesto</label>
                        <input readonly="true" class="form-control espacio-abajo" required id="UsuarioApertura" name="UsuarioApertura" placeholder="Usuario Apertura" type="text" value="<?php echo $recep_puestoApertura[0]['UsuarioApertura']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Fecha_Apertura">Fecha/Hora Apertura Puesto</label>
                        <input readonly="true"  class="form-control espacio-abajo" required id="Fecha_Apertura" name="Fecha_Apertura" placeholder="Fecha Apertura" type="text" value="<?php echo $recep_puestoApertura[0]['Fecha_Apertura']?>">
                    </div>
                    <div hidden class="form-group col-md-6">
                        <label for="nombre">Usuario Cierra Puesto</label>
                        <input readonly="true"  class="form-control espacio-abajo" required id="UsuarioCierre" name="UsuarioCierre" placeholder="Usuario Cierre" type="text" value="<?php echo $recep_puestoApertura[0]['UsuarioCierre']?>">
                    </div>
                    <div hidden class="form-group col-md-6">
                        <label for="Fecha_Cierre">Fecha/Hora Cierra Puesto</label>
                        <input readonly="true"  class="form-control espacio-abajo" required id="Fecha_Cierre" name="Fecha_Cierre" placeholder="Fecha Cierre" type="text" value="<?php if($recep_puestoApertura[0]['Fecha_Cierre']!="1900-01-01 00:00:00"){ echo $recep_puestoApertura[0]['Fecha_Cierre'];}else{ echo '';}?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="Descripcion">Nota de apertura o cierre</label>
                        <textarea class="form-control" rows="3" required id="Descripcion" name="Descripcion" placeholder="Nota de cierre y apertura" type="text" value="<?php echo $recep_puestoApertura[0]['Descripcion']?>"><?php echo $recep_puestoApertura[0]['Descripcion']?></textarea>
                    </div>
                    <a class="btn btn-success pull-left" href="javascript:%20Liberar_recepcion_puesto()" id="submit">Liberar Puesto</a>
                    <?php if($recep_puestoApertura[0]['ID_Usuario_Apertura'] == $UsuarioSIS ){?>
                    <a class="btn btn-info pull-right" href="javascript:%20check_empty()" id="submit">Guardar</a>
                    <?php }?>
                </form>
                <div>&nbsp;</div>
                <div class="bordegris">&nbsp;</div>
                <h3>A continuación se detallan la información del inventario:</h3>
                <div class="col-md-12">
                    <form id="apertura_guardar" method="POST" name="apertura_guardar" action="index.php?ctl=recepcion_inventario_guardar">
                        <div class="form-group col-md-10">
                            <label for="DescripcionInv">Detalle del inventario</label>
                            <input class="form-control espacio-abajo" required id="DescripcionInv" name="DescripcionInv" placeholder="Descripción" type="text">
                        </div>&nbsp;
                        <div class="form-group col-md-2">
                            <?php if($recep_puestoApertura[0]['ID_Usuario_Apertura'] == $UsuarioSIS ){?>
                            <a class="btn btn-info" href="javascript:%20check_empty_inventario()" id="agregar">Agregar Detalle</a>
                            <?php }?>
                        </div>
                    </form>
                    <table id="tabla" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th hidden style="text-align:center">ID_RecepcionPuesto</th>
                                <th style="text-align:center">Detalle Inventario</th>
                                <th style="text-align:center">Borrar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $tam=count($recep_puestoInventario); for ($i = 0; $i <$tam; $i++) { ?>
                            <tr>
                                <td hidden style="text-align:center"><?php echo $recep_puestoInventario[$i]['ID_RecepcionInventario'];?></td>
                                <td style="text-align:center"><?php echo $recep_puestoInventario[$i]['Descripcion'];?></td>
                                <?php if($recep_puestoApertura[0]['ID_Usuario_Apertura'] == $UsuarioSIS ){?>
                                <td style="text-align:center"><a role="button" onclick="borrar_detalle_linea('<?php echo $recep_puestoInventario[$i]['ID_RecepcionInventario'];?>')">Borrar</a></td>
                                <?php }else{?>
                                <td style="text-align:center"></td>
                                <?php }?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <h3>Lugares Disponibles:</h3>
                <table id="tabla2" class="display" cellspacing="0">
                    <thead>
                        <tr>
                            <th hidden style="text-align:center">ID_RecepcionPuesto</th>
                            <th style="text-align:center">Recepción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $tam=count($recepcion_puestotipos); for ($i = 0; $i <$tam; $i++) { ?>
                        <tr>
                            <td hidden style="text-align:center"><?php echo $recepcion_puestotipos[$i]['ID_RecepcionTipo'];?></td>
                            <td style="text-align:center"><a role="button" onclick="ver_lugar('<?php echo $recepcion_puestotipos[$i]['ID_RecepcionTipo'];?>')"><?php echo $recepcion_puestotipos[$i]['Tipo'];?></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>