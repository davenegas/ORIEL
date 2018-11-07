<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Categorías</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"><script>
            var arrayIdPuntosBcr = [];
           
            function ptobcrClick(checkbox){
                if(checkbox.checked)
                {
                    arrayIdPuntosBcr.push(checkbox.id);
                }
                else
                {
                    for (var i = arrayIdPuntosBcr.length; i--;) {
                        if (arrayIdPuntosBcr[i] === checkbox.id) {
                            arrayIdPuntosBcr.splice(i, 1);
                        }
                    }
                }
                cargartxtRespuestas();
            }
            
            function cargartxtRespuestas() {
                document.getElementById('ptsbcr').value = arrayIdPuntosBcr.join(',');
            }
            
            //Valida informacion completa de formulario
            function check_empty() {
                var supervisor = document.getElementById('supervisorid').value;
                
                if (supervisor =="-1")
                {
                    alert("Seleccione un supervisor !");
                }
                else
                {
                    if (arrayIdPuntosBcr.length > 0) {
                       v_texto = '¿Seguro(a) que desea asignar estos puntos bcr?';
                        $.confirm({title: 'Confirmación!', content: v_texto,
                            confirm: function () {
                                vid_supervisor = document.getElementById('supervisorid').value;
                                vid_puntos = document.getElementById('ptsbcr').value;
                                $.post("index.php?ctl=supervisor_por_zona_guardar", {id_supervisor: vid_supervisor, id_puntos: vid_puntos}, function (data) {
                                    //console.log(data);
                                    location.reload();
                                    //alert (data);
                                });
                            },
                            cancel: function () {
                                //$.alert('Canceled!')
                            }
                        });
                    }  
                }                
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Asignar Supervisores de Zona</h2>
            <p>A continuación se detallan los puntos de venta y supervisores:</p>
            <div class="col-md-4 espacio-abajo-5">
                <label for="Tipo_Documento">Supervisores</label>
                <select class="form-control" id="supervisorid" name="supervisorid">
                    <option value="-1" selected="-1">Seleccione un supervisor</option>
                    <?php $tam2=count($objsupervisor); for ($i = 0; $i <$tam2; $i++) { ?>
                    <option value=<?php echo $objsupervisor[$i]["ID_Supervisor_Zona"]?>><?php echo $objsupervisor[$i]["Nombre"]?></option>
                    <?php } ?>
                </select>
                <br>
            </div>            
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID_PuntoBCR</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Supervisor Actual</th>
                        <th style="text-align:center">Selecc</th>                        
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($objpuntobcr); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                        <td  hidden style="text-align:center"><?php echo $objpuntobcr[$i]['ID_PuntoBCR'];?></td>
                        <td><?php echo $objpuntobcr[$i]['Nombre'];?></td>
                        <td><?php echo $objpuntobcr[$i]['Supervisor'];?></td>
                        <td style="text-align:center"><input id="<?php echo $objpuntobcr[$i]['ID_PuntoBCR'];?>" onclick="ptobcrClick(this)" type="checkbox" value="<?php echo $objpuntobcr[$i]['ID_PuntoBCR'];?>"></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <button><a href="javascript:%20check_empty()" id="submit">Asignar Sucursales</a></button>
        </div>
        <input hidden required disabled id="ptsbcr" name="ptsbcr" type="text" value="">
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>