<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Asistencia</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        
       <script>
          
            function alerta(){
                alert('Ustede ya no tiene mas descansos');
            }        
            function justificacion_entrada(){
              
               id=document.getElementById('ID_Asistencia').value
               justificar_entrada=document.getElementById('jutificacion_entrada').value
               hora_salida='';
               justificar_salida='';
               $.post("index.php?ctl=guardar_marcas",{justificar_salida:justificar_salida,hora_salida:hora_salida,justificar_entrada:justificar_entrada,id:id}, function(data){
               location.reload(); 
               }); 
            }
            function justificacion_salida(){
               
                id=document.getElementById('ID_Asistencia').value
                justificar_entrada=document.getElementById('jutificacion_entrada').value
                justificar_salida=document.getElementById('jutificacion_salida').value
                hora_salida=document.getElementById('hora_salida').value
                $.post("index.php?ctl=guardar_marcas",{hora_salida:hora_salida,justificar_entrada:justificar_entrada,justificar_salida:justificar_salida,id:id}, function(data){
                location.reload(); 
                }); 
            } 
            function justificacion_decanso(){
                
               id=document.getElementById('ID_Descanso').value
               justificar_descanso=document.getElementById('justificacion_descanso').value
               Total=document.getElementById('total').value
               Hora_Descanso_Entrada=document.getElementById('entrada_descanso').value
               Hora_Descanso_Salida=document.getElementById('salida_descanso').value
               $.post("index.php?ctl=guardar_marcas_descanso",{id:id,justificar_descanso:justificar_descanso,Total:Total,Hora_Descanso_Entrada:Hora_Descanso_Entrada,Hora_Descanso_Salida:Hora_Descanso_Salida}, function(data){
               alert(id); 
               location.reload();
               });
            }
            function bloqueo(){
                document.getElementById('hora_entrada').readOnly=true
                document.getElementById('hora_salida').readOnly=true
                document.getElementById('salida_descanso').readOnly=true
                document.getElementById('entrada_descanso').readOnly=true
                document.getElementById('total').readOnly=true
            }
            function entrada_hora(){
                momentoActual = new Date();
                document.getElementById('hora_entrada').value =momentoActual.getHours()+":"+momentoActual.getMinutes()+":"+momentoActual.getSeconds();
                id='0'
                hora_entrada=momentoActual.getHours()+":"+momentoActual.getMinutes()+":"+momentoActual.getSeconds();
                justificar_entrada=''
                validar_entrada=''                   
                hora_salida_turno=''
                justificar_salida=''
                validar_salida=''
                fecha=momentoActual.getFullYear()+"/"+(momentoActual.getMonth()+1)+"/"+momentoActual.getDate()
                observaciones=''
                estado=''
                $.post("index.php?ctl=guardar_marcas",{fecha:fecha,hora_entrada:hora_entrada,id:id}, function(data){
                location.reload(); 
                });
            }
            function salida_hora(){
                momentoActual = new Date()
                document.getElementById('hora_salida').value =momentoActual.getHours()+":"+momentoActual.getMinutes()+":"+momentoActual.getSeconds()
                hora_salida=momentoActual.getHours()+":"+momentoActual.getMinutes()+":"+momentoActual.getSeconds();
                hora_entrada= document.getElementById('hora_entrada').value;
                justificar_entrada= document.getElementById('jutificacion_entrada').value;
                justificar_salida= document.getElementById('jutificacion_salida').value;
                id=document.getElementById('ID_Asistencia').value
                $.post("index.php?ctl=guardar_marcas",{id:id,hora_salida:hora_salida,hora_entrada:hora_entrada,
                justificar_entrada:justificar_entrada,justificar_salida:justificar_salida }, function(data){
                location.reload(); 
                });
            }
            function salida_descanso(){
                momentoActual = new Date()
                hora=momentoActual.getHours()
                minutos=momentoActual.getMinutes()
                segundos=momentoActual.getSeconds()
                  hora = hora.toString();
                    minutos = minutos.toString();
                      segundos = segundos.toString();
                    
                    if (hora.length < 2) {
                      hora = "0"+hora;
                    }
                    if (hora.length < 2) {
                      hora = "0"+hora;
                    }
                    if (minutos.length < 2) {
                      minutos = "0"+minutos;
                    }
                    if (minutos.length < 2) {
                      minutos = "0"+minutos;
                    }
                    if (segundos.length < 2) {
                      segundos = "0"+segundos;
                    }
                    if (segundos.length < 2) {
                      segundos = "0"+segundos;
                    }
              document.getElementById('salida_descanso').value =hora+":"+ minutos +":"+segundos
              id='0';
              Hora_Descanso_Salida=hora+":"+ minutos +":"+segundos
              justificar_descanso=''
              Hora_Descanso_Entrada=''
              Total=''
              id_ajus_descanso=document.getElementById('Contador_salida').value;
             
              $.post("index.php?ctl=guardar_marcas_descanso",{ id:id,Hora_Descanso_Salida:Hora_Descanso_Salida,id_ajus_descanso:id_ajus_descanso }, function(data){
              alert(id); 
              location.reload(); 
              });
            }
            function entrada_descanso(){
              //Calcula la tabla entrada descanso
                momentoActual = new Date()
                hora=momentoActual.getHours()
                minutos=momentoActual.getMinutes()
                segundos=momentoActual.getSeconds()
                 hora = hora.toString();
                  minutos = minutos.toString();
                   segundos = segundos.toString();
                    
                    if (hora.length < 2) {
                      hora = "0"+hora;
                    }
                    if (hora.length < 2) {
                      hora = "0"+hora;
                    }
                    if (minutos.length < 2) {
                      minutos = "0"+minutos;
                    }
                    if (minutos.length < 2) {
                      minutos = "0"+minutos;
                    }
                    if (segundos.length < 2) {
                      segundos = "0"+segundos;
                    }
                    if (segundos.length < 2) {
                      segundos = "0"+segundos;
                    }
           
                    inicio = document.getElementById("salida_descanso").value;
                    fin = document.getElementById("entrada_descanso").value;

                    inicioMinutos = parseInt(inicio.substr(3,2));
                    inicioHoras = parseInt(inicio.substr(0,2));
                    inicioSegundos = parseInt(inicio.substr(6,4));
                    
                    finMinutos = parseInt(fin.substr(3,2));
                    finHoras = parseInt(fin.substr(0,2));
                    finSegundos = parseInt(fin.substr(6,4));

                    transcurridoMinutos = finMinutos - inicioMinutos;
                    transcurridoHoras = finHoras - inicioHoras;
                    transcurridoSegundos = finSegundos - inicioSegundos;

                    if (transcurridoMinutos < 0) {
                      transcurridoHoras--;
                      transcurridoMinutos = 60 + transcurridoMinutos;
                    }
                    if (transcurridoSegundos < 0) {
                      transcurridoMinutos--;
                      transcurridoSegundos = 60 + transcurridoSegundos;
                    }
                    horas = transcurridoHoras.toString();
                    minutos = transcurridoMinutos.toString();
                    segundos = transcurridoSegundos.toString();

                    if (horas.length < 2) {
                      horas = "0"+horas;
                    }
                    if (horas.length < 2) {
                      horas = "0"+horas;
                    }
                    if (minutos.length < 2) {
                      minutos = "0"+minutos;
                    }
                    if (minutos.length < 2) {
                      minutos = "0"+minutos;
                    }
                    if (segundos.length < 2) {
                      segundos = "0"+segundos;
                    }
                    if (segundos.length < 2) {
                      segundos = "0"+segundos;
                    }
                    Total= horas+":"+minutos+":"+segundos;
               
                    cantidad=document.getElementById('Cantidad').value;
                    inicio = cantidad
                    fin = '00:01:00'

                    inicioMinutos = parseInt(inicio.substr(3,2));
                    inicioHoras = parseInt(inicio.substr(0,2));
                    inicioSegundos = parseInt(inicio.substr(6,4));
                    
                    finMinutos = parseInt(fin.substr(3,2));
                    finHoras = parseInt(fin.substr(0,2));
                    finSegundos = parseInt(fin.substr(6,4));

                    transcurridoMinutos = finMinutos + inicioMinutos;
                    transcurridoHoras = finHoras + inicioHoras;
                    transcurridoSegundos = finSegundos + inicioSegundos;

                    if (transcurridoMinutos < 0) {
                      transcurridoHoras--;
                      transcurridoMinutos = 60 + transcurridoMinutos;
                    }
                    if (transcurridoSegundos < 0) {
                      transcurridoMinutos--;
                      transcurridoSegundos = 60 + transcurridoSegundos;
                    }

                    horas = transcurridoHoras.toString();
                    minutos = transcurridoMinutos.toString();
                    segundos = transcurridoSegundos.toString();

                    if (horas.length < 2) {
                      horas = "0"+horas;
                    }
                    if (horas.length < 2) {
                      horas = "0"+horas;
                    }
                    if (minutos.length < 2) {
                      minutos = "0"+minutos;
                    }
                    if (minutos.length < 2) {
                      minutos = "0"+minutos;
                    }
                    if (segundos.length < 2) {
                      segundos = "0"+segundos;
                    }
                    if (segundos.length < 2) {
                      segundos = "0"+segundos;
                    }
                    
                    amarillo= horas+":"+minutos+":"+segundos;
               
                    if(Total<cantidad){
                    document.getElementById("total").value = Total;
                    document.getElementById("total").style.color='green';
                    }else{
                    if(Total>cantidad && Total<amarillo ){
                    document.getElementById("total").style.color='orange';
                    document.getElementById("total").value=Total; 
                    }else{
                    document.getElementById("total").style.color='red';
                    document.getElementById("total").value=Total;
                    }
                }
                 
                Hora_Descanso_Entrada=document.getElementById('entrada_descanso').value;
                Hora_Descanso_Salida=document.getElementById('salida_descanso').value;
                justificar_descanso=document.getElementById('justificacion_descanso').value
                Total=document.getElementById('total').value;
                id=document.getElementById('ID_Descanso').value;
                id=document.getElementById('ID_Asistencia').value;
                contador=document.getElementById('Contador').value;
                id_ajus_descanso=contador

              $.post("index.php?ctl=guardar_marcas_descanso",{Hora_Descanso_Entrada:Hora_Descanso_Entrada,
              Hora_Descanso_Salida:Hora_Descanso_Salida ,justificar_descanso:justificar_descanso,Total:Total,id:id,id:id,contador:contador}, function(data){
               
              alert(id);
              location.reload(); 
              });     
        } 
        </script>
    </head>
   
    <body onload="bloqueo()">
        <?php require_once 'encabezado.php';?>
        <h5>Sistema de Asistencia:</h5>
        <div class="container">
            <input type="text" hidden id="ID_Asistencia" value="<?php echo $params[0]['ID_Asistencia']?>">
            <input type="text" hidden id="ID_Descanso" value="<?php echo $tiempos_descanso[0]['ID_Descanso']?>">
            <input type="text" hidden id="fecha" value="<?php echo Date('y-m-d');?>">
            <input type="text" hidden id="Contador" value="<?php echo $params[0]['Contador']+1?>">
            <input type="text" hidden id="Contador_salida" value="<?php echo $params[0]['Contador']?>">
            
            <div class="col-sm-3">
                <label>Hora Entrada</label>
                <input type="text" class="form-control" id="hora_entrada" value="<?php echo $params[0]['Hora_Entrada_Turno']?>">
            </div>
            <div class="col-sm-2">
                <br>
                <button><a id="btn_1"  onclick="entrada_hora()">Ingresar</a></button>
            </div>
            
            <div class="col-sm-4">
                <label>Justificacion Entrada</label>
                <input type="text" id="jutificacion_entrada" value="<?php echo $params[0]['Justificar_Entrada']?>" class="form-control">
            </div>
            <div class="col-sm-2">
                <br>
                <button><a id="jutificacion_entrada"  onclick="justificacion_entrada()">Ingresar</a></button>
            </div>
         </div>
        
         <div class="container">
            <div class="col-sm-3">
                <label>Hora Salida</label>
                <input type="text" value="<?php echo $params[0]['Hora_Salida_Turno']?>" class="form-control " id="hora_salida">
            </div>
            <div class="col-sm-2">
                 <br>               
                 <button><a id="boton" onclick="salida_hora()"> Ingresar</a></button>
            </div>
            <div class="col-sm-4">
                <label>Justificación salida</label>
                <input type="text" id="jutificacion_salida" value="<?php echo $params[0]['Justificar_Salida']?>" class="form-control">
            </div>
            <div class="col-sm-2">
                 <br>
                 <button><a id="jutificacion_salida" onclick="justificacion_salida()"> Ingresar</a></button>
            </div> 
        </div>
       
        <hr style=height:2px; width="100%">    
        <div class="container">
            <div class="col-sm-3">
                <label>Salida a descanso</label>
                <input type="text" hidden id="ID_Descanso" value="<?php echo $tiempos_descanso[0]['ID_Descanso'];?>">
                <input type="text" value="<?php echo $tiempos_descanso[0]['Hora_Descanso_Salida']?>" class="form-control" id="salida_descanso">
                <br>
                <?php if( $params[0]['Contador']<=count($cantidad_descanso)){?>
                <button><a id="btn"  onclick="salida_descanso()">Ingresar</a></button>
                <?php }else{?>
                <button><a id="btn"  onclick="alerta()">Ingresar</a></button>
                <?php }?>
            </div>
            <div class="container">
            <div class="col-sm-3">
                <label>Justificación Descanso </label>
                <input type="text" id="justificacion_descanso" value="<?php echo $tiempos_descanso[0]['Justificar_Descanso']?>" class="form-control">
                
            </div>
            <div class="col-sm-2">
            <br>
                 <button><a id="btn_justificacion_descanso" onclick="justificacion_decanso()" >Ingresar</a></button>
            </div>
            </div> 
        </div>
        <br>
        <div class="container">
          <div class="col-sm-3">
                <label>Entrada del descanso</label>
                <input type="text" value="<?php echo $tiempos_descanso[0]['Hora_Descanso_Entrada']?>" class="form-control" id="entrada_descanso">
                <br>
                <button><a id="boton2" onclick="entrada_descanso()" >Ingresar</a></button>
          </div>  
          <div class="col-sm-3">
                <label>Total</label>
                <input type="text"  hidden id="Cantidad" value="<?php  echo $descanso[0]['Duracion_Descanso'];?>">
                <input type="text" value="<?php echo $tiempos_descanso[0]['Total_Descanso']?>" class="form-control" id="total">    
          </div>
        </div>    
        <hr style=height:2px; width="100%">      
         <table class="table">
         <thead>
         <tr>
             <th style="text-align:center">Fecha </th>
             <th style="text-align:center">ID_Asistencia </th>  
             <th style="text-align:center">Colaborador   </th>  
             <th style="text-align:center">Hora de Entrada  </th> 
             <th style="text-align:center">Justificar Entrada </th>       
             <th style="text-align:center">Hora de Salida </th>
             <th style="text-align:center">Justificar Salida </th>
         </tr>
         </thead>                          
         <tbody>
             <?php
                $tam= count($marcas);
                for($i=0;$i<$tam;$i++){
               ?>
                <tr>
                    <th style="text-align:center"><?php echo $marcas[$i]['Fecha']?></td>
                    <th style="text-align:center"><?php echo $marcas[$i]['ID_Asistencia'] ?></td>
                    <th style="text-align:center"><?php echo $marcas[$i]['Nombre']." ".$marcas[$i]['Apellido']?></td>
                    <th style="text-align:center"><?php echo $marcas[$i]['Hora_Entrada_Turno'] ?></td>
                    <th style="text-align:center"><?php echo $marcas[$i]['Justificar_Entrada'] ?></td> 
                    <th style="text-align:center"><?php echo $marcas[$i]['Hora_Salida_Turno']?></td>
                    <th style="text-align:center"><?php echo $marcas[$i]['Justificar_Salida']?></td>
                    <?php } ?>
                </tr>  
              
         </tbody>
    </table>
       <hr style=height:2px; width="100%">      
    <table class="table">
         <thead>
         <tr>
             <th style="text-align:center"> Fecha  </th>
             <th style="text-align:center"> ID  </th>
             <th style="text-align:center"> Salida al Descanso </th>
             <th style="text-align:center"> Entrada del Decanso </th>
             <th style="text-align:center"> Justificar Descanso </th>
             <th> Total </th>
             <th style="text-align:center"> Duracion Descanso </th>
             <th style="text-align:center"> Cantidad Descansos </th>
         </tr>
         </thead>                          
         <tbody>
             <?php
                $tam2= count($descanso);
                for($i=0;$i<$tam2;$i++){
               ?>
                <tr> 
                     <th style="text-align:center"><?php echo $descanso[$i]['Fecha_Descanso'] ?></td>
                     <th style="text-align:center"><?php echo $descanso[$i]['ID_Descanso'] ?></td>   
                     <th style="text-align:center"><?php echo $descanso[$i]['Hora_Descanso_Salida'] ?></td>
                     <th style="text-align:center"><?php echo $descanso[$i]['Hora_Descanso_Entrada'] ?></td>
                     <th style="text-align:center"><?php echo $descanso[$i]['Justificar_Descanso'] ?></td>
                     <?php if($descanso[$i]['Total_Descanso']<$descanso[$i]['Duracion_Descanso'] ){ ?>
                     <td style=" color:green"><?php echo $descanso[$i]['Total_Descanso'] ?></td> 
                     <?php }else{
                     //Agrega un minuto a la duracion para poder mostrarlo en el color anaranjado
                     $horaInicial=  $descanso[0]['Duracion_Descanso'];
                     $minutoAnadir=1;
                     $segundos_horaInicial=strtotime($horaInicial);
                     $segundos_minutoAnadir=$minutoAnadir*60;
                     $nuevaHora=date("H:i:s",$segundos_horaInicial+$segundos_minutoAnadir); 
                     if($descanso[0]['Duracion_Descanso']< $descanso[$i]['Total_Descanso'] &&  $descanso[$i]['Total_Descanso']<$nuevaHora){?>
                     <td style=" color:orange" ><?php   echo $descanso[$i]['Total_Descanso']?></td>
                     <?php }else{?>
                     <td style=" color:red" ><?php   echo $descanso[$i]['Total_Descanso']?></td>
                     <?php }} ?>
                     <th style="text-align:center"><?php echo $descanso[$i]['Duracion_Descanso'] ?></td> 
                     <th style="text-align:center"><?php echo $descanso[$i]['ID_Ajus_Descanso'] ?></td> 
                     <?php } ?>
                </tr>   
         </tbody>
    </body>
 </html>