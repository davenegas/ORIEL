<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Net Test Ping</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>
            //Funcion para ocultar ventana de mantenimiento
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            //Valida informacion completa de formulario
            function check_empty() {
                if (document.getElementById('ID_PuntoBCR').value =="") {
                    alert("Digita el nombre del Proveedor !");
                } else {
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana2').submit();
                    document.getElementById('ventana_oculta_2').style.display = "none";
                }
            }
            //Funcion para agregar un nuevo punto- formulario en blanco
            function mostrar_agregar_net_puesto() {
                document.getElementById('ID_Puesto_Monitoreo2').value=document.getElementById('ID_Puesto_Monitoreo').value;
                document.getElementById('ID_PuntoBCR').value=null;
                document.getElementById('ID_Tipo_IP').value=null;
                document.getElementById('Estado').value=1;
                document.getElementById('EsNuevo').value=1;
                document.getElementById('ventana_oculta_2').style.display = "block";                
            }
        //Funcion para editar informacion de net_puesto
            function Editar_net_puesto(pID_Puesto_Monitoreo,pID_PuntoBCR,pID_Tipo_IP,pEstado,pCodigo,pNombre){
                document.getElementById('EsNuevo').value=0;
                document.getElementById('ID_Puesto_Monitoreo2').value=pID_Puesto_Monitoreo;
                document.getElementById('ID_PuntoBCR').value=pID_PuntoBCR;
                document.getElementById('ID_Tipo_IP').value=pID_Tipo_IP;
                document.getElementById('Codigo').value=pCodigo;
                document.getElementById('Nombrebcr').value=pNombre;
                document.getElementById('Estado').value=pEstado;
                document.getElementById('ventana_oculta_2').style.display = "block";                
            };
            
        var myRedirect = function(redirectUrl, arg, value) {
            var form = $('<form action="' + redirectUrl + '" method="post">' +
                    '<input type="hidden" name="'+ arg +'" value="' + value + '"></input>' + '</form>');
            $('body').append(form);
            $(form).submit();
        };
         //Funcion para redireccionar y refrescar el listado
        function RefrescarPuesto()
        {
             var vID_Puesto_Monitoreo= document.getElementById('ID_Puesto_Monitoreo').value;
             myRedirect("index.php?ctl=net_puesto_listar&ID="+vID_Puesto_Monitoreo, "ID_Puesto_Monitoreo", vID_Puesto_Monitoreo);
             //$.post("index.php?ctl=net_puesto_listar", { ID_Puesto_Monitoreo: vID_Puesto_Monitoreo}, function(data){});
        };
        function limpiar_info_cajero(){
            document.getElementById('Nombrebcr').value="";
            document.getElementById('Codigo').value="";
            document.getElementById('ID_PuntoBCR').value="0";
        }
        function buscar_NetTest_PuntoBCR(){
            id= document.getElementById('Codigo').value;
            $.post("index.php?ctl=buscar_NetTest_PuntoBCR", { id: id}, function(data){
                var n= data.search("No se encontró");                
                if(n==-1){
                    var res = data.substring(data.indexOf("{"), data.length);
                    var datos =JSON.parse(res);
                    document.getElementById('ID_PuntoBCR').value=datos['ID_PuntoBCR'];
                    document.getElementById('Nombrebcr').value=datos['Nombre'];
                    document.getElementById('Codigo').value=datos['Codigo'];                    
                } else{                    
                    document.getElementById('ID_PuntoBCR').value="-1";
                    document.getElementById('Nombrebcr').value="No se encontró el Punto";
                    document.getElementById('Codigo').value="0";
                }               
            });
        }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Listado General de NetTest por Puestos</h2>            
                <p>A continuación se detallan los registros del puesto:
                <select onchange="javascript:RefrescarPuesto()" id="ID_Puesto_Monitoreo" name="ID_Puesto_Monitoreo">
                    <option <?php if($id_puestoMonitoreo==0){ echo 'selected';} ?> value="0">General</option>
                    <?php $tam = count($puestomonitoreo);
                    for($i=0; $i<$tam;$i++){  ?>
                    <option <?php if($id_puestoMonitoreo==$puestomonitoreo[$i]['ID_Puesto_Monitoreo']){ echo 'selected';} ?> value="<?php echo $puestomonitoreo[$i]['ID_Puesto_Monitoreo']?>"><?php echo $puestomonitoreo[$i]['Nombre']?></option>
                    <?php }?>
                </select>
            </p>
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID_Puesto_Monitoreo</th>
                        <th hidden style="text-align:center">ID_PuntoBCR</th>
                        <th hidden style="text-align:center">ID_Tipo_IP</th>
                        <th style="text-align:center">Puesto</th>
                        <th style="text-align:center">Código</th>
                        <th style="text-align:center">Punto BCR</th>                        
                        <th style="text-align:center">Tipo IP</th>
                        <th style="text-align:center">Estado</th>
                        <th style="text-align:center">Cambiar Estado</th>
                        <th style="text-align:center">Mantenimiento</th>
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($net_puesto); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                        <td hidden style="text-align:center"><?php echo $net_puesto[$i]['ID_Puesto_Monitoreo'];?></td>
                        <td hidden><?php echo $net_puesto[$i]['ID_PuntoBCR'];?></td>
                        <td hidden><?php echo $net_puesto[$i]['ID_Tipo_IP'];?></td>
                        <td><?php echo $net_puesto[$i]['Puesto'];?></td>
                        <td><?php echo $net_puesto[$i]['Codigo'];?></td>
                        <td><?php echo $net_puesto[$i]['Nombre'];?></td>
                        <td><?php echo $net_puesto[$i]['Tipo_Ip'];?></td>
                        <?php if ($net_puesto[$i]['Estado']==1){?>
                            <td style="text-align:center">Activo</td>
                        <?php }else {?>
                            <td style="text-align:center">Inactivo</td>
                        <?php }?>

                        <td style="text-align:center"><a href="index.php?ctl=net_puesto_cambiar_estado&ID_Puesto_Monitoreo=<?php echo $net_puesto[$i]['ID_Puesto_Monitoreo']?>&Estado=<?php echo $net_puesto[$i]['Estado']?>">Activar/Desactivar</a></td>
                        <td style="text-align:center"><a role="button" onclick="Editar_net_puesto('<?php echo $net_puesto[$i]['ID_Puesto_Monitoreo'];?>','<?php echo $net_puesto[$i]['ID_PuntoBCR'];?>','<?php echo $net_puesto[$i]['ID_Tipo_IP'];?>','<?php echo $net_puesto[$i]['Estado'];?>','<?php echo $net_puesto[$i]['Codigo'];?>','<?php echo $net_puesto[$i]['Nombre'];?>')">Editar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a id="popup" onclick="mostrar_agregar_net_puesto()" class="btn btn-default" role="button">Agregar PING</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        <!--agregar o editar net_puesto-->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
            <!--Formulario para net_puesto-->
                    <form id="ventana2" method="POST" name="ventana2" action="index.php?ctl=net_puesto_guardar">
                        <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                        <h2>Puesto Monitoreo: <?php echo $puestoMonitoreoNombre; ?> </h2> <hr>
                        <input hidden id="EsNuevo" name="EsNuevo" type="text">
                        <input hidden id="ID_Puesto_Monitoreo2" name="ID_Puesto_Monitoreo2" type="text">
                        <input hidden id="ID_PuntoBCR" name="ID_PuntoBCR" type="text">                        
                        
                        <div class="form-group col-md-3">
                            <label for="Codigo">Punto BCR</label>
                            <input type="text" class="form-control" id="Codigo" name="Codigo" onclick="limpiar_info_cajero();" onblur="buscar_NetTest_PuntoBCR();" placeholder="Código">                            
                        </div>
                        <div class="form-group col-md-9">
                            <label for="Nombrebcr">Nombre</label>
                            <input Readonly class="form-control " required id="Nombrebcr" name="Nombrebcr" placeholder="Nombre" type="text">                            
                        </div>
                        <div class="form-group">
                            <label for="ID_Tipo_IP">Tipo IP</label>
                            <select class="form-control" id="ID_Tipo_IP" name="ID_Tipo_IP">                                
                                <?php $tam = count($tipoip);
                                for($i=0; $i<$tam;$i++){  ?>
                                <option value="<?php echo $tipoip[$i]['ID_Tipo_IP']?>"><?php echo $tipoip[$i]['Tipo_IP']?></option>
                                <?php }  ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sel1">Estado</label>
                            <select class="form-control" id="Estado" name="Estado"> 
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="row"></div>
                        <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                    </form>
                </div>
            </div>
        <!--Cierre agregar o editar net_puesto-->
    </body>
</html>