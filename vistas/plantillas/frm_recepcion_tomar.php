<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de recepcion_puesto</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>
            //Valida informacion completa de formulario
            function check_empty() {
                if (document.getElementById('Nombre').value =="") {
                    alert("Digita el nombre del Proveedor !");
                } else {
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana2').submit();
                    document.getElementById('ventana_oculta_2').style.display = "none";
                }
            }
            //Funcion para editar informacion de recepcion_puesto
            function Tomar_recepcion_puesto(pID_RecepcionPuesto,pNombre){
                $.confirm({
                    title: 'Confirmación!',
                    content: 'Desea tomar el puesto: '+pNombre+' ?',
                    confirm: function(){
                        $.post("index.php?ctl=recepcion_puesto_revision", {ID_RecepcionPuesto: pID_RecepcionPuesto},function(data){
                            console.log(data);
                            var srt = data;
                            var n= srt.search("Inactivo");
                           //alert(data);
                            if(n>0){
                                $.alert({
                                    title: 'Información!',
                                    content: 'Este puesto '+pNombre+' se encuentra inactivo, favor notifique a CoodinacionCentroControl!!!',
                                });
                            }else{
                                n= srt.search("En otro puesto");
                                if(n>0){
                                    $.alert({
                                        title: 'Información!',
                                        content: 'Solo es posible tener como máximo un puesto de monitoreo a la vez. Por favor libere el actual!!!',
                                    });
                                }else{
                                    n= srt.search("Ocupado");
                                    if(n>0){
                                        $.alert({
                                            title: 'Información!',
                                            content: 'Este puesto se encuentra bloqueado, no es posible tomarlo!!! Solamente la Persona que lo tiene o un Encargado lo puede liberar.',
                                        });
                                    }else{
                                        n= srt.search("Tomar");
                                        if(n>0){
                                            $.alert({
                                                title: 'Información!',
                                                content: 'Puesto tomado exitosamente!!!',
                                            });
                                            ir_alpuesto(pID_RecepcionPuesto);
                                        }
                                    }
                                }
                            }
                        });  
                    },
                    cancel: function(){              
                    }
                });
            };
            function ir_alpuesto(pID_RecepcionPuesto){
                var $form = $("<form />");
                $form.attr("action","index.php?ctl=recepcion_puesto_apertura");
                $form.attr("method","POST");
                $form.append('<input type="hidden" name="ID_RecepcionPuesto" value="'+pID_RecepcionPuesto+'" />');
                $("body").append($form);
                $form.submit();
            }
            function Liberar_recepcion_puesto(pID_RecepcionPuesto,pNombre,pID_Usuario){
                $.confirm({
                    title: 'Confirmación!',
                    content: 'Desea liberar el puesto: '+pNombre+' ?',
                    confirm: function(){
                        $.post("index.php?ctl=recepcion_apertura_liberar", {ID_RecepcionPuesto: pID_RecepcionPuesto, ID_Usuario:pID_Usuario},function(data){
                            console.log(data);
                            location.reload();
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
            <h2>Listado General de control de ingreso al BCR</h2>
            <p>A continuación se detallan los registros del sistema:</p>
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID_RecepcionPuesto</th>                        
                        <th style="text-align:center">Nombre</th>
                        <th style="text-align:center">Funcionario</th>
                        <th style="text-align:center">Descripcion</th>
                        <th style="text-align:center">Tomar</th>
                        <th style="text-align:center">Liberar</th>
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($recepcion_puesto); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                        <td hidden style="text-align:center"><?php echo $recepcion_puesto[$i]['ID_RecepcionPuesto'];?></td>                        
                        <td><?php echo $recepcion_puesto[$i]['Nombre'];?></td>
                        <td><?php echo $recepcion_puesto[$i]['Usuario'];?></td>
                        <td><?php echo $recepcion_puesto[$i]['Descripcion'];?></td>
                        <?php if($recepcion_puesto[$i]['ID_Usuario'] ==0){ ?>
                        <td style="text-align:center"><a role="button" onclick="Tomar_recepcion_puesto('<?php echo $recepcion_puesto[$i]['ID_RecepcionPuesto'];?>','<?php echo $recepcion_puesto[$i]['Nombre'];?>')">Tomar Puesto</a></td>
                        <td style="text-align:center"></td>
                        <?php }else{ ?>
                        <td style="text-align:center"><a role="button" onclick="ir_alpuesto('<?php echo $recepcion_puesto[$i]['ID_RecepcionPuesto'];?>')">Ir al Puesto</a></td>
                        <td style="text-align:center"><a role="button" onclick="Liberar_recepcion_puesto('<?php echo $recepcion_puesto[$i]['ID_RecepcionPuesto'];?>','<?php echo $recepcion_puesto[$i]['Nombre'];?>','<?php echo $recepcion_puesto[$i]['ID_Usuario'];?>')">Liberar Puesto</a></td>
                        <?php }?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>