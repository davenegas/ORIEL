<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Configuración de Usuarios</title>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
        <script>
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_1').style.display = "none";
                document.getElementById('ventana_oculta_2').style.display = "none";
                document.getElementById('ventana_oculta_3').style.display = "none";
            }
            function buscar_usuario() {
                document.getElementById('ventana_oculta_1').style.display = "block";
            }
            function ver_horarios() {
                if(document.getElementById('ID_Usuario').value>0){
                    document.getElementById('ventana_oculta_3').style.display = "block";
                }else {
                    alert("Por favor seleccione un usuario!");
                }
            }
            function seleccionar_usuario(id, nombre, apellido, rol){
                document.getElementById('ID_Usuario').value=id;
                document.getElementById('ID_Usuario_Descanso').value=id;
                document.getElementById('nombre_usuario').value=nombre;
                document.getElementById('apellido_usuario').value=apellido;
                document.getElementById('rol_usuario').value=rol;

                document.getElementById('ventana_oculta_1').style.display = "none";

                $.post("index.php?ctl=asistencia_buscar_descanso", { id:id }, function(data){
                    //alert(data);
                    $("#descanso_usuario").html(data);
                });
                $.post("index.php?ctl=asistencia_buscar_descanso", { id:id }, function(data){$("#descanso_usuario").html(data);});
                $.post("index.php?ctl=asistencia_buscar_horarios", { id:id }, function(data){
                    //alert(data);
                    $("#tabla3").html(data);
                });
                document.getElementById('entrada_domingo').value="";
                document.getElementById('salida_domingo').value="";
                document.getElementById('entrada_lunes').value="";
                document.getElementById('salida_lunes').value="";
                document.getElementById('entrada_martes').value="";
                document.getElementById('salida_martes').value="";
                document.getElementById('entrada_miercoles').value="";
                document.getElementById('salida_miercoles').value="";
                document.getElementById('entrada_jueves').value="";
                document.getElementById('salida_jueves').value="";
                document.getElementById('entrada_viernes').value="";
                document.getElementById('salida_viernes').value="";
                document.getElementById('entrada_sabado').value="";
                document.getElementById('salida_sabado').value="";
                document.getElementById('fecha_inicio_horario').value = "";
                document.getElementById('fecha_fin_horario').value = "";
            }
            function frm_descanso_usuario() {
                if(document.getElementById('ID_Usuario').value>0){
                    document.getElementById('ID_Ajuste_Descanso').value="0";
                    document.getElementById('tiempo_descanso').value="";
                    document.getElementById('detalle_descanso').value="";
                    document.getElementById('ventana_oculta_2').style.display = "block";
                } else {
                    alert("Por favor seleccione un usuario!");
                }
            }
            function editar_descanso(id_ajuste, tiempo, detalle){
                document.getElementById('ID_Ajuste_Descanso').value=id_ajuste;
                document.getElementById('tiempo_descanso').value=tiempo;
                document.getElementById('detalle_descanso').value=detalle;
                document.getElementById('ventana_oculta_2').style.display = "block";
            }
            function validar_descanso(){
                if (document.getElementById('tiempo_descanso').value == "") {
                    alert("Digite el tiempo del descanso !");
                } else {
                    ID_Ajuste_Descanso = document.getElementById('ID_Ajuste_Descanso').value;
                    ID_Usuario_Descanso = document.getElementById('ID_Usuario_Descanso').value;
                    tiempo_descanso = document.getElementById('tiempo_descanso').value;
                    detalle_descanso = document.getElementById('detalle_descanso').value;
                    $.post("index.php?ctl=asistencia_ajutes_descanso_usuario", {ID_Ajuste_Descanso:ID_Ajuste_Descanso, ID_Usuario_Descanso:ID_Usuario_Descanso, tiempo_descanso:tiempo_descanso, detalle_descanso:detalle_descanso }, function(data){
                        //alert(data);
                        console.log("descanso guardado: "+data);
                    });
                    $.post("index.php?ctl=asistencia_buscar_descanso", { id:ID_Usuario_Descanso }, function(data){$("#descanso_usuario").html(data);});
                    $.post("index.php?ctl=asistencia_buscar_descanso", { id:ID_Usuario_Descanso }, function(data){$("#descanso_usuario").html(data);});
                    document.getElementById('ventana_oculta_2').style.display = "none";
                }
            }
            function eliminar_descanso(ID_Ajuste_Descanso ){
                $.confirm({title: 'Confirmación!', content: 'Desea eliminar permanentemente el descanso del usuario?', 
                confirm: function(){
                    id=document.getElementById('ID_Usuario').value;
                    $.post("index.php?ctl=asistencia_eliminar_descanso", { id:id, ID_Ajuste_Descanso:ID_Ajuste_Descanso  }, function(data){
                        //alert(data);
                    });
                    $.post("index.php?ctl=asistencia_buscar_descanso", { id:id }, function(data){$("#descanso_usuario").html(data);});
                    $.post("index.php?ctl=asistencia_buscar_descanso", { id:id }, function(data){$("#descanso_usuario").html(data);});
                },
                cancel: function(){}
                });
            }
            function horario_defecto(turno){
                if(document.getElementById('tipo_horario').value=="Normal"){
                    if(turno=="Mañana"){
                        document.getElementById('entrada_domingo').value="05:55";
                        document.getElementById('salida_domingo').value="13:55";
                        document.getElementById('entrada_lunes').value="05:55";
                        document.getElementById('salida_lunes').value="13:55";
                        document.getElementById('entrada_martes').value="05:55";
                        document.getElementById('salida_martes').value="13:55";
                        document.getElementById('entrada_miercoles').value="05:55";
                        document.getElementById('salida_miercoles').value="13:55";
                        document.getElementById('entrada_jueves').value="05:55";
                        document.getElementById('salida_jueves').value="13:55";
                        document.getElementById('entrada_viernes').value="05:55";
                        document.getElementById('salida_viernes').value="13:55";
                        document.getElementById('entrada_sabado').value="05:55";
                        document.getElementById('salida_sabado').value="13:55";
                    }if(turno=="Tarde"){
                        document.getElementById('entrada_domingo').value="13:55";
                        document.getElementById('salida_domingo').value="21:55";
                        document.getElementById('entrada_lunes').value="13:55";
                        document.getElementById('salida_lunes').value="21:55";
                        document.getElementById('entrada_martes').value="13:55";
                        document.getElementById('salida_martes').value="21:55";
                        document.getElementById('entrada_miercoles').value="13:55";
                        document.getElementById('salida_miercoles').value="21:55";
                        document.getElementById('entrada_jueves').value="13:55";
                        document.getElementById('salida_jueves').value="21:55";
                        document.getElementById('entrada_viernes').value="13:55";
                        document.getElementById('salida_viernes').value="21:55";
                        document.getElementById('entrada_sabado').value="13:55";
                        document.getElementById('salida_sabado').value="21:55";
                    }if(turno=="Noche"){
                        document.getElementById('entrada_domingo').value="21:55";
                        document.getElementById('salida_domingo').value="05:55";
                        document.getElementById('entrada_lunes').value="21:55";
                        document.getElementById('salida_lunes').value="05:55";
                        document.getElementById('entrada_martes').value="21:55";
                        document.getElementById('salida_martes').value="05:55";
                        document.getElementById('entrada_miercoles').value="21:55";
                        document.getElementById('salida_miercoles').value="05:55";
                        document.getElementById('entrada_jueves').value="21:55";
                        document.getElementById('salida_jueves').value="05:55";
                        document.getElementById('entrada_viernes').value="21:55";
                        document.getElementById('salida_viernes').value="05:55";
                        document.getElementById('entrada_sabado').value="21:55";
                        document.getElementById('salida_sabado').value="05:55";
                    }
                }
            }
            function validar_horario(){
                if(document.getElementById('ID_Usuario').value<1){
                    alert("Por favor seleccione un usuario!");
                } else {
                    if (document.getElementById('fecha_inicio_horario').value == "" || document.getElementById('fecha_fin_horario').value == "") {
                        alert("Seleccione ambas fechas de vigencia del horario!");
                    } else {
                        //Calculo de días entre 2 fechas
                        var fecha1= document.getElementById('fecha_inicio_horario').value;
                        var fecha2 = document.getElementById('fecha_fin_horario').value;
                        var fecha3 = fecha1.split('-');
                        var fecha4 = fecha2.split('-');
                        var f1 = Date.UTC(fecha3[0],fecha3[1]-1,fecha3[2]);
                        var f2 = Date.UTC(fecha4[0],fecha4[1]-1,fecha4[2]);
                        var dif = f2-f1;
                        var dias = Math.floor(dif/(1000*60*60*24));
                        if(dias<7){
                            alert("Los horarios deben tener una vigencia minima de 7 días. Se esta intentando guardar un horario con "+dias+" días");
                        } else {
                            document.getElementById('frm_horario_usuario').submit();
                        }
                    }
                }
            }
            function select_tipo_horario(tipo){
                if(tipo=="Vacaciones" || tipo=="Incapacidad"){
                    document.getElementById('entrada_domingo').value="";
                    $("#entrada_domingo").attr("readonly",true);
                    document.getElementById('salida_domingo').value="";
                    $("#salida_domingo").attr("readonly",true);
                    document.getElementById('entrada_lunes').value="";
                    $("#entrada_lunes").attr("readonly",true);
                    document.getElementById('salida_lunes').value="";
                    $("#salida_lunes").attr("readonly",true);
                    document.getElementById('entrada_martes').value="";
                    $("#entrada_martes").attr("readonly",true);
                    document.getElementById('salida_martes').value="";
                    $("#salida_martes").attr("readonly",true);
                    document.getElementById('entrada_miercoles').value="";
                    $("#entrada_miercoles").attr("readonly",true);
                    document.getElementById('salida_miercoles').value="";
                    $("#salida_miercoles").attr("readonly",true);
                    document.getElementById('entrada_jueves').value="";
                    $("#entrada_jueves").attr("readonly",true);
                    document.getElementById('salida_jueves').value="";
                    $("#salida_jueves").attr("readonly",true);
                    document.getElementById('entrada_viernes').value="";
                    $("#entrada_viernes").attr("readonly",true);
                    document.getElementById('salida_viernes').value="";
                    $("#salida_viernes").attr("readonly",true);
                    document.getElementById('entrada_sabado').value="";
                    $("#entrada_sabado").attr("readonly",true);
                    document.getElementById('salida_sabado').value="";
                    $("#salida_sabado").attr("readonly",true);
                    document.getElementById('rth_1').disabled=true;
                    document.getElementById('rth_2').disabled=true;
                    document.getElementById('rth_3').disabled=true;
                }if(tipo=="Normal"){
                    document.getElementById('entrada_domingo').removeAttribute("readonly");
                    document.getElementById('salida_domingo').removeAttribute("readonly");
                    document.getElementById('entrada_lunes').removeAttribute("readonly");
                    document.getElementById('salida_lunes').removeAttribute("readonly");
                    document.getElementById('entrada_martes').removeAttribute("readonly");
                    document.getElementById('salida_martes').removeAttribute("readonly");
                    document.getElementById('entrada_miercoles').removeAttribute("readonly");
                    document.getElementById('salida_miercoles').removeAttribute("readonly");
                    document.getElementById('entrada_jueves').removeAttribute("readonly");
                    document.getElementById('salida_jueves').removeAttribute("readonly");
                    document.getElementById('entrada_viernes').removeAttribute("readonly");
                    document.getElementById('salida_viernes').removeAttribute("readonly");
                    document.getElementById('entrada_sabado').removeAttribute("readonly");
                    document.getElementById('salida_sabado').removeAttribute("readonly");
                    document.getElementById('rth_1').disabled=false;
                    document.getElementById('rth_2').disabled=false;
                    document.getElementById('rth_3').disabled=false;
                }
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class="row">
            <div class="col-sm-1 sidenav">
                
            </div>
            
            <div class="col-sm-10 container">
                <h2>Gestión de horario y descansos de usuarios</h2>
                <div class="row">
                    <div class="col-sm-12">  
                        <div class="row">
                            <div class="col-sm-12 well">
                                <h4>Información de los usuario <a onclick="buscar_usuario();" class="glyphicon glyphicon-user" title="Seleccionar usuario de una lista"></a></h4>
                                <div class="col-sm-4">
                                    <div class="well form-group">
                                        <label for="nombre_usuario">Nombre del usuario</label>
                                        <input type="text" disabled class="form-control" id="nombre_usuario" name="nombre_usuario">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="well">
                                        <label for="apellido_usuario">Apellido del usuario</label>
                                        <input type="text" disabled class="form-control" id="apellido_usuario" name="apellido_usuario">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="well">
                                        <label for="rol_usuario">Rol del usuario</label>
                                        <input type="text" disabled class="form-control" id="rol_usuario" name="rol_usuario">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 well">
                                <h4>Descansos del usuario <a onclick="frm_descanso_usuario();" class="glyphicon glyphicon-plus" title="Agregar un descanso al usuario"></a></h4>
                                <div class="col-sm-12">
                                    <div class="well">
                                        <table id="descanso_usuario" class="display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center">Tiempo</th>
                                                    <th style="text-align:center">Detalle</th>
                                                    <th style="text-align:center">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody> 
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 well">
                                
                                <h4>Horario del usuario <a onclick="ver_horarios();" class="glyphicon glyphicon-zoom-in" title="Ver horarios asignados al usuario"></a><br>
                                    <input type="radio" name="radio_turno_horario" id="rth_1" onclick="horario_defecto('Mañana');" value="Mañana">Mañana
                                    <input type="radio" name="radio_turno_horario" id="rth_2" onclick="horario_defecto('Tarde');" value="Tarde">Tarde
                                    <input type="radio" name="radio_turno_horario" id="rth_3" onclick="horario_defecto('Noche');" value="Noche">Noche
                                </h4>
                                <p>El horario es asignado al usuario seleccionado y debe tener una vigencia mínima de 7 días.</p>
                                <!--<p>Para ver horario(s) asignado al usuario, dar click a la lupa que se encuentra arriba.</p>-->
                                <form class="form-horizontal text-center" id="frm_horario_usuario"role="form" method="POST" action="index.php?ctl=asistencia_guardar_horario_usuario">
                                    <input type="text" hidden id="ID_Usuario" name="ID_Usuario" value="0">
                                    <div class="col-sm-12">
                                        <h4>Vigencia: 
                                            <input type="date" required style="border: 2px solid #ccffff; border-radius: 6px;" id="fecha_inicio_horario" name="fecha_inicio_horario">
                                            <input type="date" required style="border: 2px solid #ccffff; border-radius: 6px;" id="fecha_fin_horario" name="fecha_fin_horario">
                                        </h4>
                                        <h4>Tipo de Horario: 
                                            <input type="radio" name="tipo_horario" id="tipo_horario" onclick="select_tipo_horario('Normal');" value="Normal" checked="checked">Normal
                                            <input type="radio" name="tipo_horario" id="tipo_horario" onclick="select_tipo_horario('Vacaciones');" value="Vacaciones">Vacaciones
                                            <input type="radio" name="tipo_horario" id="tipo_horario" onclick="select_tipo_horario('Incapacidad');" value="Incapacidad">Incapacidad
                                        </h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="col-sm-3">
                                            <div>
                                                <label>Días laborales </label>
                                                <label class="form-control">Hora entrada</label>
                                                <label class="form-control">Hora Salida</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <div>
                                                <label>Domingo</label>
                                                <input type="time" class="form-control espacio-abajo-5" id="entrada_domingo" name="entrada_domingo">
                                                <input type="time" class="form-control" id="salida_domingo" name="salida_domingo">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div>
                                                <label>Lunes</label>
                                                <input type="time" class="form-control espacio-abajo-5" id="entrada_lunes" name="entrada_lunes">
                                                <input type="time" class="form-control" id="salida_lunes" name="salida_lunes">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div>
                                                <label>Martes</label>
                                                <input type="time" class="form-control espacio-abajo-5" id="entrada_martes" name="entrada_martes">
                                                <input type="time" class="form-control" id="salida_martes" name="salida_martes">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="col-sm-3">
                                            <div>
                                                <label>Miercoles</label>
                                                <input type="time" class="form-control espacio-abajo-5" id="entrada_miercoles" name="entrada_miercoles">
                                                <input type="time" class="form-control" id="salida_miercoles" name="salida_miercoles">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div>
                                                <label>Jueves</label>
                                                <input type="time" class="form-control espacio-abajo-5" id="entrada_jueves" name="entrada_jueves">
                                                <input type="time" class="form-control" id="salida_jueves" name="salida_jueves">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div>
                                                <label>Viernes</label>
                                                <input type="time" class="form-control espacio-abajo-5" id="entrada_viernes" name="entrada_viernes">
                                                <input type="time" class="form-control" id="salida_viernes" name="salida_viernes">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div>
                                                <label>Sabado</label>
                                                <input type="time" class="form-control espacio-abajo-5" id="entrada_sabado" name="entrada_sabado">
                                                <input type="time" class="form-control" id="salida_sabado" name="salida_sabado">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 espacio-arriba">
                                        <button><a href="javascript:%20validar_horario()" id="submit">Guardar<span class="glyphicon glyphicon-floppy-saved"></span></a></button>
                                        <a class="buttons" href="index.php?ctl=asistencia_personal">Cancelar <span class="glyphicon glyphicon-share-alt" ></span></a>
                                    </div>   
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-1 sidenav">
                
            </div>
        </section>
        <?php require_once 'pie_de_pagina.php' ?>
        
        <!--Seleccionar usuario -->
        <div id="ventana_oculta_1">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla2" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">Cedula</th>
                                <th style="text-align:center">Nombre</th>
                                <th style="text-align:center">Apellido</th>
                                <th style="text-align:center">Departamento</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($usuarios);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $usuarios[$i]['Cedula'];?></td>
                                    <td style="text-align:center"><?php echo $usuarios[$i]['Nombre'];?></td>
                                    <td style="text-align:center"><?php echo $usuarios[$i]['Apellido'];?></td>
                                    <td style="text-align:center"><?php echo $usuarios[$i]['Descripcion'];?></td>
                                    <td style="text-align:center"><a class="btn" role="button" onclick="seleccionar_usuario(<?php echo $usuarios[$i]['ID_Usuario'];?>,'<?php echo $usuarios[$i]['Nombre'];?>','<?php echo $usuarios[$i]['Apellido'];?>','<?php echo $usuarios[$i]['Descripcion'];?>' );">
                                            Seleccionar</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <!--Cierre seleccionar usuario-->
        </div> 
        
        <!--agregar descanso al usuario-->
        <div id="ventana_oculta_2"> 
            <div id="popupventana">
                <!--Formulario para ingresar descansos a los usuarios-->
                <div id="ventana">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Agregar Descanso al usuario</h2>
                    <hr>
                    <input hidden id="ID_Ajuste_Descanso" name="ID_Ajuste_Descanso" type="text" value="0">
                    <input hidden id="ID_Usuario_Descanso" name="ID_Usuario_Descanso" type="text">
                    
                    <label for="tiempo_descanso">Tiempo del descanso</label>
                    <input class="form-control espacio-abajo" maxlength="8" required id="tiempo_descanso" name="tiempo_descanso" placeholder="Tiempo de descanso en minutos" type="number">
                    
                    <label for="detalle_descanso">Detalle</label>
                    <input class="form-control espacio-abajo" id="detalle_descanso" name="detalle_descanso" placeholder="Detalle opcional del descanso" type="text">
                    
                    <button><a onclick="validar_descanso();">Guardar</a></button>
                </div>
            </div>
        <!--Cierre agregar descanso al usuario-->
        </div>
        
        <!--Lista de horarios de operador-->
        <div id="ventana_oculta_3">
            <div id="popupventana3">
                <div id="ventana3">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla3" class="display" cellspacing="0" width="100%">
                    </table>
                </div>
            </div>
        <!--Cierre seleccionar usuario-->
        </div> 
    </body>
</html>