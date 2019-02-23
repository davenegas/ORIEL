<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de recepcion_parqueo</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>            
            function limpiar_campos_ctrl()
            {
                document.getElementById('Num_Lugar').value="";
                document.getElementById('ID_RecepcionParqueo').value="";
                document.getElementById('ID_Persona').value="";
                document.getElementById('Ubicacion').value="";
                document.getElementById('Tipo_Vehiculo').value="";
                document.getElementById('Estado_Uso').value="";
                document.getElementById('Nombre').value="";
                document.getElementById('Prestamo').value="";
                document.getElementById('Cedula').value="";
                document.getElementById('Placa').value="";
                document.getElementById('Fecha_Entrada').value="0000-00-00";
                document.getElementById('Hora_Entrada').value="00:00:00";
                document.getElementById('Fecha_Salida').value="0000-00-00";
                document.getElementById('Hora_Salida').value="00:00:00";
                document.getElementById("Es_Prestamo").value=false;
                document.getElementById('divliberar').style.display = "none";
                document.getElementById('divreservar').style.display = "none";
            }
            function bloquearCtrl(){
                var checkBox = document.getElementById("Es_Prestamo");
                if (checkBox.checked == true){
                     document.getElementById('Prestamo').readOnly = false;
                     document.getElementById('Cedula').readOnly = false;
                     document.getElementById('Placa').readOnly = false;
                 } else {
                     document.getElementById('Prestamo').readOnly = true;
                     document.getElementById('Cedula').readOnly = true;
                     document.getElementById('Placa').readOnly = true;
                 }
            }
            function evento_espacio_parqueo(){
                pNum_Lugar= document.getElementById('Num_Lugar').value;
                $.post("index.php?ctl=recepcion_lugar_numcampo", { Num_Lugar: pNum_Lugar}, function(data){
                    var n= data.search("No se encontró");
                    if(n==-1){
                        var res = data.substring(data.indexOf("{"), data.length);
                        var datos =JSON.parse(res);
                        document.getElementById('ID_RecepcionParqueo').value=datos['ID_RecepcionParqueo'];
                        document.getElementById('ID_Persona').value=datos['ID_Persona'];
                        document.getElementById('Num_Lugar').value=datos['Num_Lugar'];
                        document.getElementById('Ubicacion').value=datos['Ubicacion'];
                        document.getElementById('Tipo_Vehiculo').value=datos['Descripcion'];
                        document.getElementById('Estado_Uso').value=datos['Estado_Uso'];
                        document.getElementById('Nombre').value=datos['Nombre'];
                        document.getElementById('Prestamo').value=datos['Prestamo'];
                        document.getElementById('Cedula').value=datos['Cedula'];
                        document.getElementById('Placa').value=datos['Placa'];
                        document.getElementById('Fecha_Entrada').value=datos['Fecha_Entrada'];
                        document.getElementById('Hora_Entrada').value=datos['Hora_Entrada'];
                        document.getElementById('Fecha_Salida').value=datos['Fecha_Salida'];
                        document.getElementById('Hora_Salida').value=datos['Hora_Salida'];
                        if(datos['Es_Prestamo']==1)
                        {
                            document.getElementById("Es_Prestamo").checked=true;
                        }else
                        {
                            document.getElementById("Es_Prestamo").checked=false;
                        }
                        
                        document.getElementById('Estado_Uso').style.color = "Black";
                        
                        document.getElementById('divliberar').style.display = "none";
                        document.getElementById('divreservar').style.display = "none";
                        $("#Es_Prestamo").attr("disabled",false);
                        if(datos['Estado_Uso']=="D")
                        {
                            document.getElementById('Estado_Uso').value="Disponible";
                            document.getElementById('Estado_Uso').style.color = "Blue";
                            document.getElementById('divreservar').style.display = "block";
                        }
                        if(datos['Estado_Uso']=="O")
                        {
                            document.getElementById('Estado_Uso').value="Ocupado";
                            document.getElementById('Estado_Uso').style.color = "Red";
                            document.getElementById('divliberar').style.display = "block";
                            document.getElementById('Prestamo').readOnly = true;
                            document.getElementById('Prestamo').readOnly = true;
                            document.getElementById('Cedula').readOnly = true;
                            $("#Es_Prestamo").attr("disabled",true);
                        }
                        if(datos['Estado_Uso']=="O")
                        {
                            document.getElementById('Estado_Uso').value="No Disponible";                            
                        }
                        
                        usuarioapertura= document.getElementById('ID_Usuario_Apertura').value;
                        usuariolog= document.getElementById('ID_UsuarioLog').value;
                        if(usuarioapertura!=usuariolog)
                        {
                            document.getElementById('divconsulta').style.display = "block";
                            document.getElementById('divliberar').style.display = "none";
                            document.getElementById('divreservar').style.display = "none";
                        }
                        
                    } else{                        
                        limpiar_campos_ctrl();
                        document.getElementById('Ubicacion').value="No se encontró el lugar";
                    }
                });
            }
            //Valida informacion completa de formulario
            function check_empty() {
                if (document.getElementById('ID_Recepcion_Apertura').value =="") {
                    alert("Digita el nombre del Proveedor !");
                } else {
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana2').submit();
                    document.getElementById('ventana_oculta_2').style.display = "none";
                }
            }
            function reservar_lugar()
            {
                var esError = false;
                pID_RecepcionParqueo =document.getElementById("ID_RecepcionParqueo").value;
                pID_Recepcion_Apertura =document.getElementById("ID_Recepcion_Apertura").value;
                pPrestamo =document.getElementById("Prestamo").value;
                pCedula =document.getElementById("Cedula").value;
                pPlaca =document.getElementById("Placa").value;
                pEs_Prestamo = document.getElementById("Es_Prestamo").value;
                if(pID_RecepcionParqueo <=0)
                {
                    alert("Por favor ingrese ID_RecepcionParqueo!");
                    esError=true;
                }
                if(pID_Recepcion_Apertura <=0)
                {
                    alert("Por favor ingrese pID_Recepcion_Apertura!");
                    esError=true;
                }
                if (pEs_Prestamo.checked == true)
                {
                    if(pPrestamo =="")
                    {
                        alert("Por favor ingrese el nombre a quien se le presto el campo!");
                        esError=true;
                    }
                    if(pCedula =="")
                    {
                        alert("Por favor ingrese la cédula a quien se le presto el campo !");
                        esError=true;
                    }
                    if(pPlaca =="")
                    {
                        alert("Por favor ingrese el número de placa a quien se le presto el campo!");
                        esError=true;
                    }
                }
                if(esError==false)
                {
                    $.post("index.php?ctl=recepcion_lugar_reservar",{ID_RecepcionParqueo:pID_RecepcionParqueo,ID_Recepcion_Apertura:pID_Recepcion_Apertura, Es_Prestamo:pEs_Prestamo, Prestamo:pPrestamo, Cedula:pCedula, Placa:pPlaca,Estado_Uso:"O"}, function(data){
                        //console.log(data);
                        location.reload();
                    });
                }
            }
            function liberar_lugar()
            {
                pID_RecepcionParqueo =document.getElementById("ID_RecepcionParqueo").value;
                pID_Recepcion_Apertura ="0";
                pPrestamo ="";
                pCedula ="";
                pPlaca ="";
                pEs_Prestamo = false;
        
                $.post("index.php?ctl=recepcion_lugar_reservar",{ID_RecepcionParqueo:pID_RecepcionParqueo,ID_Recepcion_Apertura:pID_Recepcion_Apertura, Es_Prestamo:pEs_Prestamo, Prestamo:pPrestamo, Cedula:pCedula, Placa:pPlaca, Estado_Uso:"D"}, function(data){
                    location.reload();
                });
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <a class="btn btn-info pull-right" href="index.php?ctl=recepcion_puesto_tomar" id="regresar">Regresar</a>
            <h2>Listado General de recepción de vehículos del BCR</h2>
            <p>A continuación se detallan los campos a registrar:</p>
            <input hidden id="ID_Recepcion_Apertura" name="ID_Recepcion_Apertura" type="text" value="<?php echo $ID_Recepcion_Apertura;?>">
            <input hidden id="ID_RecepcionParqueo" name="ID_RecepcionParqueo" type="text">
            <input hidden required id="ID_Usuario_Apertura" name="ID_Usuario_Apertura" placeholder="ID_Usuario_Apertura" type="text" value="<?php echo $ID_Usuario_Apertura?>">
            <input hidden required id="ID_UsuarioLog" name="ID_UsuarioLog" placeholder="ID_UsuarioLog" type="text" value="<?php echo $UsuarioSIS?>">
            <div class="row">
                <form id="recervar_espacio" method="POST" name="recervar_espacio" action="index.php?ctl=">
                    <input hidden  required id="ID_Persona" name="ID_Persona" placeholder="ID_Persona" type="text">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">                        
                    <div class="form-group col-md-3">
                        <label for="Num_Lugar">Ingrese el número de espacio</label>
                        <input class="form-control espacio-abajo" required id="Num_Lugar" name="Num_Lugar" onblur="evento_espacio_parqueo();" onclick="limpiar_campos_ctrl();" placeholder="Número" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Ubicacion">Ubicación</label>
                        <input readonly class="form-control espacio-abajo" required id="Ubicacion" name="Ubicacion" placeholder="Ubicación" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="Tipo_Vehiculo">Tipo Vehículo</label>
                        <input readonly class="form-control espacio-abajo" required id="Tipo_Vehiculo" name="Tipo_Vehiculo" placeholder="Tipo Vehículo" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="Estado_Uso">Estado de uso</label>
                        <input readonly class="form-control espacio-abajo" required id="Estado_Uso" name="Estado_Uso" placeholder="Estado de uso" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="Nombre">Dueño</label>
                        <input readonly class="form-control espacio-abajo" required id="Nombre" name="Nombre" placeholder="Dueño" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="Prestamo">Prestamo A</label>
                        <label class="checkbox-inline"><input id="Es_Prestamo" name="Es_Prestamo" type="checkbox" onclick="bloquearCtrl()" >&nbsp;</label>
                        <input readonly class="form-control espacio-abajo" required id="Prestamo" name="Prestamo" placeholder="Prestamo A" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="Cedula">Cédula</label>
                        <input readonly class="form-control espacio-abajo" required id="Cedula" name="Cedula" placeholder="Cédula" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="Placa">Placa</label>
                        <input readonly class="form-control espacio-abajo" required id="Placa" name="Placa" placeholder="Placa" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="Fecha_Entrada">Fecha Entrada</label>
                        <input readonly class="form-control espacio-abajo" required id="Fecha_Entrada" name="Fecha_Entrada" placeholder="Fecha Entrada" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="Hora_Entrada">Hora Entrada</label>
                        <input readonly class="form-control espacio-abajo" required id="Hora_Entrada" name="Hora_Entrada" placeholder="Hora Entrada" type="text">
                    </div>

                    <div hidden class="form-group col-md-3">
                        <label for="Fecha_Salida">Fecha Salida</label>
                        <input readonly class="form-control espacio-abajo" required id="Fecha_Salida" name="Fecha_Salida" placeholder="Fecha Salida" type="text">
                    </div>

                    <div hidden class="form-group col-md-3">
                        <label for="Hora_Salida">Hora Salida</label>
                        <input readonly class="form-control espacio-abajo" required id="Hora_Salida" name="Hora_Salida" placeholder="Hora Salida" type="text">
                    </div>
                    <div id="divconsulta" name="divliberar" hidden class=" pull-right">Modo consulta</div>
                    <div class="row"></div>                    
                    <div id="divliberar" name="divliberar" hidden><a class="btn btn-warning pull-right" href="javascript:%20liberar_lugar()" id="liberarC" name="liberarC">Liberar Espacio</a></div>
                    <div id="divreservar" name="divreservar" hidden><a class="btn btn-primary pull-right" href="javascript:%20reservar_lugar()" id="reservarC" name="reservarC">Reservar Espacio</a></div>
                </form>
            </div>
            <div class="bordegris">&nbsp;</div>
            <div>&nbsp;</div>
            <div class="row">
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID_RecepcionParqueo</th>
                        <th hidden style="text-align:center">ID_Recepcion_Apertura</th>
                        <th hidden style="text-align:center">ID_Persona</th>
                        <th hidden style="text-align:center">ID_Ubicacion</th>
                        <th hidden style="text-align:center">ID_Tipo_Vehiculo</th>
                        <th style="text-align:center">Núm Lugar</th>
                        <th style="text-align:center">Nombre</th>
                        <th style="text-align:center">Prestamo</th>                        
                        <th style="text-align:center">Cédula</th>
                        <th style="text-align:center">Placa</th>
                        <th style="text-align:center">Fecha Entrada</th>
                        <th style="text-align:center">Hora Entrada</th>                        
                        <th style="text-align:center">Estado</th>
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($recepcion_parqueo); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                    <td hidden style="text-align:center"><?php echo $recepcion_parqueo[$i]['ID_RecepcionParqueo'];?></td>
                    <td hidden><?php echo $recepcion_parqueo[$i]['ID_Recepcion_Apertura'];?></td>
                    <td hidden><?php echo $recepcion_parqueo[$i]['ID_Persona'];?></td>
                    <td hidden><?php echo $recepcion_parqueo[$i]['ID_Ubicacion'];?></td>
                    <td hidden><?php echo $recepcion_parqueo[$i]['ID_Tipo_Vehiculo'];?></td>
                    <td><?php echo $recepcion_parqueo[$i]['Num_Lugar'];?></td>
                    <td><?php echo $recepcion_parqueo[$i]['Nombre'];?></td>
                    <td><?php echo $recepcion_parqueo[$i]['Prestamo'];?></td>
                    <td><?php echo $recepcion_parqueo[$i]['Cedula'];?></td>
                    <td><?php echo $recepcion_parqueo[$i]['Placa'];?></td>
                    <td><?php echo $recepcion_parqueo[$i]['Fecha_Entrada'];?></td>
                    <td><?php echo $recepcion_parqueo[$i]['Hora_Entrada'];?></td>                        
                    <td style="<?php if($recepcion_parqueo[$i]['Estado_Uso'] =='D'){echo 'background-color:  #b7f2b5';}if($recepcion_parqueo[$i]['Estado_Uso'] =='O'){echo 'background-color:  #ff6666';}?>"><?php echo $recepcion_parqueo[$i]['EstadoUso'];?></td>
                </tr>
                <?php } ?>
            </tbody>
            </table>           
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>