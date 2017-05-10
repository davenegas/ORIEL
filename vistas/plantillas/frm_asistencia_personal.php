<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="vistas/Imagenes/Oriel.ico">
        <title>Asistencia Usuarios</title>
        <?php require_once 'frm_librerias_head.html'; ?> 
        <link rel="stylesheet" href="vistas/css/reloj.css">
        <style>    
            .ancho{
                display: table;
                table-layout: fixed;
                height: 350px;
                width: 100%;
            }
        </style>
        <script>
            
            var centesimas = 0;
            var segundos = 0;
            var minutos = 0;
            var horas = 0;   
            $(document).ready(function (){
                <?php $cant_descan_actual=  count($marca_descanso);
                if(isset($marca_turno[0]['ID_Marca']) && $marca_turno[0]['Tipo_Marca']=="Turno"){ ?> 
                    document.getElementById('ID_Marca_Turno').value=<?php echo $marca_turno[0]['ID_Marca'];
                } if(isset($marca_descanso[0]['ID_Marca']) && $marca_descanso[0]['Tipo_Marca']=="Descanso"){ ?> 
                    document.getElementById('ID_Marca_Descanso').value=<?php echo $marca_descanso[$cant_descan_actual-1]['ID_Marca'];?>;
                    <?php
                    //Contador de descansos
                    if($marca_descanso[$cant_descan_actual-1]['Marca_Salida']=="" || $marca_descanso[$cant_descan_actual-1]['Marca_Salida']==null){ 
                        $fecha_actual= getdate();
                        $fecha_actual= $fecha_actual['year']."-".$fecha_actual['mon']."-".$fecha_actual['mday'].' '.$fecha_actual['hours'].':'.$fecha_actual['minutes'].':'.$fecha_actual['seconds'];
                        $fecha1 = new DateTime($fecha_actual);
                    } else { 
                        $fecha1= new DateTime($marca_descanso[$cant_descan_actual-1]['Marca_Salida']);
                    }
                    $fecha2 = new DateTime($marca_descanso[$cant_descan_actual-1]['Marca_Entrada']);
                    $diff = $fecha1->diff($fecha2);?>
                    centesimas = 0;
                    segundos = <?php echo intval($diff->s)?>;
                    minutos = <?php echo intval($diff->i)?>;
                    horas = <?php echo intval($diff->h)?>;
                    if (segundos < 10) { segundos = "0"+segundos }
                    segundos_decanso.innerHTML = ":"+segundos;
                    if (minutos < 10) { minutos = "0"+minutos }        
                    minutos_decanso.innerHTML = ":"+minutos;
                    console.log(segundos+' '+minutos+' '+horas);
                    if (horas < 10) { horas = "0"+horas }
                    horas_descanso.innerHTML = horas;
                    <?php if($marca_descanso[$cant_descan_actual-1]['Marca_Salida']=="" || $marca_descanso[$cant_descan_actual-1]['Marca_Salida']==null){ ?>
                        setInterval(cronometro,10);
                    <?php } ?>

                <?php } ?>  
            });


            function cronometro () {
                if (centesimas < 99) {
                    centesimas++;
                    if (centesimas < 10) { centesimas = "0"+centesimas }
                    //Centesimas.innerHTML = ":"+centesimas;
                }
                if (centesimas == 99) {
                    centesimas = -1;
                }
                if (centesimas == 0) {
                    segundos ++;
                    if (segundos < 10) { segundos = "0"+segundos }
                    segundos_decanso.innerHTML = ":"+segundos;
                }
                if (segundos == 59) {
                    segundos = -1;
                }
                if ( (centesimas == 0)&&(segundos == 0) ) {
                    minutos++;
                    if (minutos < 10) { minutos = "0"+minutos }
                    minutos_decanso.innerHTML = ":"+minutos;
                }
                if (minutos == 59) {
                    minutos = -1;
                }
                if ( (centesimas == 0)&&(segundos == 0)&&(minutos == 0) ) {
                    horas ++;
                    if (horas < 10) { horas = "0"+horas }
                    horas_descanso.innerHTML = horas;
                }
                <?php $cant_descan_actual=  count($marca_descanso);
                if(isset($info_descansos[$cant_descan_actual-1]['Tiempo'])){ ?>
                    if(minutos > <?php echo $info_descansos[$cant_descan_actual-1]['Tiempo'];?>){
                        document.getElementById('segundos_decanso').style.color="red";
                        document.getElementById('minutos_decanso').style.color="red";
                        document.getElementById('horas_descanso').style.color="red";
                    }
                <?php } else { ?>
                    document.getElementById('segundos_decanso').style.color="red";
                    document.getElementById('minutos_decanso').style.color="red";
                    document.getElementById('horas_descanso').style.color="red";
                <?php } ?>
            }

            function marca_turno(tipo){
                console.log(tipo);
                //Registra marca de ingreso a turno
                if(tipo=='Entrada_Turno'){
                    <?php if(isset($marca_turno[0]['Marca_Entrada'])){?>
                        alert('Su marca de entrada a turno ya ha sido registrada!');
                    <?php } else { ?>
                        id_marca = document.getElementById('ID_Marca_Turno').value;
                        //console.log(id_marca);
                        $.post("index.php?ctl=marca_guardar", { id_marca: id_marca, tipo: tipo}, function(data){
                            console.log("id marca: "+data);
                            //location.reload();
                            document.getElementById('ID_Marca_Turno').value=parseInt(data);
                            id_marca= parseInt(data);
                            
                            <?php if($horario_turno[0]['Tipo_Horario']=="NA"){ ?>
                                tipo_inconsistencia = 3;                    
                                $.post("index.php?ctl=asistencia_generar_inconsistencia", { id_marca: id_marca, tipo_inconsistencia: tipo_inconsistencia}, function(data){console.log(data);}); 
                                alert('<?php echo $_SESSION['name']." ".$_SESSION['apellido'];?>'+", su marca de entrada a sido ingresada correctamente, ésta es inconsistente debido a que hoy no tiene un horario de trabajo establecido");
                                setTimeout(function(){window.location.reload();},5000);
                            <?php } if($horario_turno[0]['Tipo_Horario']=="Vacaciones") { ?>
                                tipo_inconsistencia = 3;                    
                                $.post("index.php?ctl=asistencia_generar_inconsistencia", { id_marca: id_marca, tipo_inconsistencia: tipo_inconsistencia}, function(data){console.log(data);}); 
                                alert('<?php echo $_SESSION['name']." ".$_SESSION['apellido'];?>'+", su marca de entrada a sido ingresada correctamente, ésta es inconsistente debido a que hoy tiene un horario establecido de vacaciones");
                                setTimeout(function(){window.location.reload();},5000);
                            <?php } if($horario_turno[0]['Tipo_Horario']=="Incapacidad") { ?>
                                tipo_inconsistencia = 3;                    
                                $.post("index.php?ctl=asistencia_generar_inconsistencia", { id_marca: id_marca, tipo_inconsistencia: tipo_inconsistencia}, function(data){console.log(data);}); 
                                alert('<?php echo $_SESSION['name']." ".$_SESSION['apellido'];?>'+", su marca de entrada a sido ingresada correctamente, ésta es inconsistente debido a que hoy tiene un horario establecido de Incapacidad");
                                setTimeout(function(){window.location.reload();},5000);
                            <?php } if($horario_turno[0]['Tipo_Horario']=="Normal") { ?>
                                <?php if($horario_turno[0]['Hora_Entrada']=="") { ?>
                                    //tipo_inconsistencia = 3;                    
                                    //$.post("index.php?ctl=asistencia_generar_inconsistencia", { id_marca: id_marca, tipo_inconsistencia: tipo_inconsistencia}, function(data){console.log(data);}); 
                                    alert('<?php echo $_SESSION['name']." ".$_SESSION['apellido'];?>'+", su marca de entrada a sido ingresada correctamente, ésta es inconsistente debido a que hoy se encuentra en su día libre");
                                    setTimeout(function(){window.location.reload();},5000);
                                <?php } else {?>
                                    var fechaactual = new Date();
                                    var fecha1= new Date("2017/01/01 "+(fechaactual.getHours()+':'+fechaactual.getMinutes()+':'+fechaactual.getSeconds()));
                                    var fecha2= new Date("2017/01/01 "+'<?php echo $horario_turno[0]['Hora_Entrada']?>');
                                    var diff= ((fecha1-fecha2)/60000);
                                    //console.log("fecha1: "+fecha1+", Difencia"+diff);
                                    if(diff>0){
                                        tipo_inconsistencia = 1;                    
                                        $.post("index.php?ctl=asistencia_generar_inconsistencia", { id_marca: id_marca, tipo_inconsistencia: tipo_inconsistencia}, function(data){console.log(data);}); 
                                        alert('<?php echo $_SESSION['name']." ".$_SESSION['apellido'];?>'+", su marca de entrada a sido ingresada correctamente, se ha generado una inconsistencia ya que marcó "+parseInt(diff)+" minutos tarde");
                                        setTimeout(function(){window.location.reload();},5000);
                                    } else {
                                        alert('<?php echo $_SESSION['name']." ".$_SESSION['apellido'];?>'+", su marca de entrada a sido ingresada correctamente.");                          
                                        setTimeout(function(){window.location.reload();},4000);
                                    }
                                <?php } ?>
                            <?php } ?>
                        });
                    <?php } ?>
                } 
                //Guarda la salida a turno, edita una pendiente
                if(tipo=='Salida_Turno'){
                    id_marca = document.getElementById('ID_Marca_Turno').value;
                    console.log(id_marca);
                    $.post("index.php?ctl=marca_guardar", { id_marca: id_marca, tipo: tipo}, function(data){
                        console.log(data);
                        //location.reload();
                    }); 
                    <?php if($horario_turno[0]['Tipo_Horario']=="NA"){ ?>
                        alert("Su marca de salida a sido ingresada correctamente, se ha generado inconsistente debido a que hoy no tiene un horario de trabajo establecido");
                        tipo_inconsistencia = 3;                    
                        $.post("index.php?ctl=asistencia_generar_inconsistencia", { id_marca: id_marca, tipo_inconsistencia: tipo_inconsistencia}, function(data){console.log(data);}); 
                        setTimeout(function(){window.location.reload();},5000);
                    <?php } if($horario_turno[0]['Tipo_Horario']=="Vacaciones") { ?>
                        alert("Su marca de salida a sido ingresada correctamente, se ha generado inconsistente debido a que hoy tiene un horario establecido de vacaciones");
                        tipo_inconsistencia = 3;                    
                        $.post("index.php?ctl=asistencia_generar_inconsistencia", { id_marca: id_marca, tipo_inconsistencia: tipo_inconsistencia}, function(data){console.log(data);}); 
                        setTimeout(function(){window.location.reload();},5000);
                    <?php } if($horario_turno[0]['Tipo_Horario']=="Incapacidad") { ?>
                        alert("Su marca de salida a sido ingresada correctamente, se ha generado inconsistente debido a que hoy tiene un horario establecido de Incapacidad");
                        tipo_inconsistencia = 3;                    
                        $.post("index.php?ctl=asistencia_generar_inconsistencia", { id_marca: id_marca, tipo_inconsistencia: tipo_inconsistencia}, function(data){console.log(data);}); 
                        setTimeout(function(){window.location.reload();},5000);
                    <?php } if($horario_turno[0]['Tipo_Horario']=="Normal") { ?>
                        <?php if($horario_turno[0]['Hora_Entrada']=="") { ?>
                            tipo_inconsistencia = 3;                    
                            $.post("index.php?ctl=asistencia_generar_inconsistencia", { id_marca: id_marca, tipo_inconsistencia: tipo_inconsistencia}, function(data){console.log(data);}); 
                            alert('<?php echo $_SESSION['name']." ".$_SESSION['apellido'];?>'+", su marca de entrada a sido ingresada correctamente, ésta es inconsistente debido a que hoy se encuentra en su día libre");
                            setTimeout(function(){window.location.reload();},5000);
                        <?php } else {?>
                            var fechaactual = new Date();
                            var fecha1= new Date("2017/01/01 "+(fechaactual.getHours()+':'+fechaactual.getMinutes()+':'+fechaactual.getSeconds()));
                            var fecha2= new Date("2017/01/01 "+'<?php echo $horario_turno[0]['Hora_Salida']?>');
                            var diff= ((fecha2-fecha1)/60000);
                            console.log("fecha1: "+fecha1+", Difencia"+diff);
                            if(diff>0){
                                alert("Su marca de salida a sido ingresada correctamente, marcó "+parseInt(diff)+" minutos antes de su hora de salida: "+'<?php echo $horario_turno[0]['Hora_Salida']?>'+". Puede volver a realizar su marca de salida cuando sea correcta de lo contrario se generará una inconsistencia");
                                setTimeout(function(){window.location.reload();},5000);
                            } else {
                                alert("Su marca de salida a sido ingresada correctamente.");
                                setTimeout(function(){window.location.reload();},4000);
                            }  
                        <?php } ?>
                    <?php } ?>
                }
                //Registra marca de inicio de descanso
                if(tipo=='Inicio_Descanso'){
                    <?php $cant_descan_actual = count($marca_descanso); ?>
                    <?php if($marca_descanso[$cant_descan_actual-1]['Marca_Entrada']!="" && $marca_descanso[$cant_descan_actual-1]['Marca_Salida']==""){?>
                        alert('En este momento se encuentra en un tiempo de descanso!');
                    <?php } else { ?>
                        id_marca = 0;
                        console.log(id_marca);
                        $.post("index.php?ctl=marca_guardar", { id_marca: id_marca, tipo: tipo}, function(data){
                            console.log(data);
                            document.getElementById('ID_Marca_Descanso').value=parseInt(data);
                            location.reload();
                        });
                    <?php } ?>
                }
                //Edita registro de descanso con marca de entrada
                if(tipo=='Fin_Descanso'){
                    id_marca = document.getElementById('ID_Marca_Descanso').value;
                    console.log(id_marca);
                    $.post("index.php?ctl=marca_guardar", { id_marca: id_marca, tipo: tipo}, function(data){
                        console.log(data);
                        //location.reload();
                    });
                    <?php $cant_descan_actual=  count($marca_descanso);
                    if(isset($info_descansos[$cant_descan_actual-1]['Tiempo'])){ ?>
                        if(minutos > <?php echo $info_descansos[$cant_descan_actual-1]['Tiempo'];?>){
                            tipo_inconsistencia = 4;                    
                            $.post("index.php?ctl=asistencia_generar_inconsistencia", { id_marca: id_marca, tipo_inconsistencia: tipo_inconsistencia}, function(data){console.log(data);}); 
                            alert("El tiempo de descanso ha excedido lo establecido por su supervisor inmediato ("+'<?php echo $info_descansos[$cant_descan_actual-1]['Tiempo']?>'+" minutos), se ha generado una inconsistencia");
                            setTimeout(function(){window.location.reload();},5000);
                        }else {
                            location.reload();
                        }
                    <?php } else { ?>
                        tipo_inconsistencia = 9;                    
                        $.post("index.php?ctl=asistencia_generar_inconsistencia", { id_marca: id_marca, tipo_inconsistencia: tipo_inconsistencia}, function(data){console.log(data);}); 
                        alert("No cuenta con descansos asignados o ha agotado los disponibles por turno, se ha generado una inconsistencia");
                        setTimeout(function(){window.location.reload();},5000);
                    <?php } ?>
                }
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container text-center">    
            <div class="row">
                <div class="col-sm-12">   
                    <div class="row"></div>
                    <div class="col-sm-12">
                        <div> <p></p></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="well ancho" >
                                <h3>Registro de Marca Turno</h3>
                                <section id="Fecha_hoy">
                                    <?php 
                                    $hoy = date("F j, Y, g:i a");
                                    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                    ?><h4><?php echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. ", ".date('Y')."."; ?></h4>
                                </section>    
                                <section id="contReloj">
                                    <p id="pHoras"></p>
                                    <p>:</p>
                                    <p id="pMinutos"></p>
                                    <p>:</p>
                                    <p id="pSegundos"></p>
                                    <script language="javascript" src="vistas/js/listas_dependientes_asistencia.js"></script>
                                </section>
                                <h4>Estado de marca del hoy</h4>
                                <section id='marca_turno'>
                                    <input hidden id="ID_Marca_Turno" value="0">
                                    <label for="entrada_turno">Marca entrada:
                                        <?php if (isset($marca_turno[0]['Marca_Entrada'])){
                                            $date= date_create($marca_turno[0]['Marca_Entrada']);
                                            echo date_format($date,"H:i:s");?>
                                        <span class="glyphicon glyphicon-ok"></span>
                                        <?php } else { ?>
                                            Pendiente <span class="glyphicon glyphicon-remove"></span> 
                                        <?php }?>
                                    </label><br>
                                    <label for="salida_turno">Marca salida:
                                        <?php if (isset($marca_turno[0]['Marca_Salida'])){ 
                                            $date= date_create($marca_turno[0]['Marca_Salida']);
                                            echo date_format($date,"H:i:s");?>    
                                            <span class="glyphicon glyphicon-ok"></span>
                                        <?php } else { ?>
                                            Pendiente <span class="glyphicon glyphicon-remove"></span> 
                                        <?php }?>
                                    </label><br><br>
                                    <a onclick="marca_turno('Entrada_Turno');" class="btn btn-default" role="button">ENTRADA</a>
                                    <a onclick="marca_turno('Salida_Turno');" class="btn btn-default" role="button">SALIDA</a>
                                </section>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="well ancho">
                                <h3>Inconsistencias</h3>
                                <br><br>
                                <h4>Cantidad de inconsistencias personales sin justificar</h4>
                                <h1><a href="index.php?ctl=asistencia_lista_marcas"><?php echo $cant_inconsistencias?></a></h1>
                                <!--<h4>Se horario está próximo a vencer, por favor comuníquese con su supervisor inmediato para la actualización del mismo</h4>-->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="well ancho">
                                <?php if($_SESSION['modulos']['Módulo-Asistencia encargado empresa']==0|| $_SESSION['modulos']['Módulo-Asistencia encargado Banco']==0) {?>
                                    <h3>Registro Descanso</h3>
                                    <br><br>
                                    <h4>Total de descansos por turno: 
                                        <?php if(isset($info_descansos[0]['ID_Ajuste_Descanso'])){echo count($info_descansos);} ?>
                                    </h4><br>
                                    <section id='marca_descanso'>
                                        <input hidden id="ID_Marca_Descanso" value="0">
                                        <label for="entrada_turno">Salida descanso:
                                            <?php $cant_descan_actual = count($marca_descanso); 
                                                if (isset($marca_descanso[$cant_descan_actual-1]['Marca_Entrada'])){
                                                $date= date_create($marca_descanso[$cant_descan_actual-1]['Marca_Entrada']); ?>
                                                <span id="tiempo_descanso"><?php echo date_format($date,"H:i:s");?></span>
                                            <?php } else {?>
                                                --:--
                                            <?php }?>
                                        </label><br>
                                        <label for="salida_turno">Entrada descanso:
                                            <?php if (isset($marca_descanso[$cant_descan_actual-1]['Marca_Salida'])){ 
                                                $date= date_create($marca_descanso[$cant_descan_actual-1]['Marca_Salida']); ?>
                                                <span id="tiempo_descanso"><?php echo date_format($date,"H:i:s");?></span>
                                            <?php } else {?>
                                                --:--
                                            <?php }?>
                                        </label><br>
                                        <label for="salida_turno">Total ultimo descanso  
                                            <span id="horas_descanso">00</span>
                                            <span id="minutos_decanso">:00</span>
                                            <span id="segundos_decanso">:00</span>
                                        </label><br><br>
                                        <a onclick="marca_turno('Inicio_Descanso');" class="btn btn-default" role="button">SALIDA</a>
                                        <a onclick="marca_turno('Fin_Descanso');" class="btn btn-default" role="button">ENTRADA</a>
                                    </section>
                                <?php } else {?>
                                    <h3>Información de marcas del turno</h3>
                                    <br><br><br>
                                    <h2>***PROXIMAMENTE***</h2>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="well ancho">
                                <?php if($_SESSION['modulos']['Módulo-Asistencia encargado empresa']==1|| $_SESSION['modulos']['Módulo-Asistencia encargado Banco']==1) {?>
                                    <h3>Otros indicadores</h3>
                                    <br><br><br>
                                    <p>En la configuración se puede asigar descansos a los usuarios, horario de trabajo, horario de vacaciones u horarior de incapacidad</p>
                                    <h1><a href="index.php?ctl=asistencia_configuracion_usuarios">CONFIGURACIÓN</a></h1>
                                <?php } else { ?>
                                    <h3>Evaluación de desempeño</h3>
                                    <br><br><br>
                                    <h2>***PROXIMAMENTE***</h2>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>