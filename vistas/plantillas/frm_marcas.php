<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8"/>
        <title>Sistema de Asistencia</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        
        <script>
            function alerta(){
                alert('Ustede ya no tiene mas descansos');
            }        
            function justificacion_entrada(){
                confirmar=confirm("Desea continuar")
                if(confirmar){
                    id=document.getElementById('ID_Asistencia').value
               justificar_entrada=document.getElementById('jutificacion_entrada').value
               hora_salida=''
               justificar_salida=''
                $.post("index.php?ctl=guardar_marcas",{justificar_salida:justificar_salida,hora_salida:hora_salida,justificar_entrada:justificar_entrada,id:id}, function(data){
                   alert('Justificasion enviada');
                   
                }); 
                }else{
                   // alert('cancelado');
                            
                }
            }
            function justificacion_salida(){
                 confirmar=confirm("Desea continuar")
                if(confirmar){
                   id=document.getElementById('ID_Asistencia').value
               justificar_entrada=document.getElementById('jutificacion_entrada').value
               justificar_salida=document.getElementById('jutificacion_salida').value
             
               hora_salida=document.getElementById('hora_salida').value
                $.post("index.php?ctl=guardar_marcas",{hora_salida:hora_salida,justificar_entrada:justificar_entrada,justificar_salida:justificar_salida,id:id}, function(data){
                  // alert(data);
                  alert('Justificasion enviada');
                   // location.reload(); 
                }); 
                }else{
                    
                }
            }      
            function justificacion_decanso(){
                 confirmar=confirm("Desea continuar")
                if(confirmar){
               id=document.getElementById('ID_Descanso').value
               justificar_descanso=document.getElementById('justificacion_descanso').value
               Total=document.getElementById('total').value
               Hora_Descanso_Entrada=document.getElementById('entrada_descanso').value
               Hora_Descanso_Salida=document.getElementById('salida_descanso').value
                $.post("index.php?ctl=guardar_marcas_descanso",{id:id,justificar_descanso:justificar_descanso,Total:Total,Hora_Descanso_Entrada:Hora_Descanso_Entrada,Hora_Descanso_Salida:Hora_Descanso_Salida}, function(data){
               //    alert(data);
                    alert('Justificasion enviada');
                });
                }else{
                    
                }
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
                id_marcas='0'
                hora_entrada=momentoActual.getHours()+":"+momentoActual.getMinutes()+":"+momentoActual.getSeconds();
                justificar_entrada=''
                validar_entrada=''                   
                hora_salida_turno=''
                justificar_salida=''
                validar_salida=''
                fecha=momentoActual.getFullYear()+"/"+(momentoActual.getMonth()+1)+"/"+momentoActual.getDate()
                observaciones=''
                estado=''
                //alert(hora);
                //Sin parametros
               // $.post("index.php?ctl=guardar_marcas");
                //$.pos
                           
                // enviar parametro
                $.post("index.php?ctl=guardar_marcas",{fecha:fecha,hora_entrada:hora_entrada,id_marcas:id_marcas}, function(data){
//                    alert(data);
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
                id_marcas= document.getElementById('ID_Asistencia').value;
                $.post("index.php?ctl=guardar_marcas",{id_marcas:id_marcas, hora_salida:hora_salida, hora_entrada:hora_entrada,
                justificar_entrada:justificar_entrada,justificar_salida:justificar_salida }, function(data){
//                    alert(data);
               // location.reload(); 
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
           //alert(data);
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
                document.getElementById('entrada_descanso').value =hora+":"+ minutos +":"+segundos
               
                id=document.getElementById('ID_Descanso').value;
                //alert(id);
                Hora_Descanso_Entrada=hora+":"+ minutos +":"+segundos;
                justificar_descanso='';
                Hora_Descanso_Salida='';
                Total='';
              
               $.post("index.php?ctl=guardar_marcas_descanso",{ Hora_Descanso_Entrada:Hora_Descanso_Entrada,Hora_Descanso_Salida:Hora_Descanso_Salida,justificar_descanso:justificar_descanso,id:id,Total:Total }, function(data){
                  // alert(data)
                //location.reload(); 
                })
               
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
                     ///////////////////////////////////////
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
              ////////////////////////////////////////////////////    
               
                if(Total<cantidad){
                    document.getElementById("total").value = Total;
                    document.getElementById("total").style.color='green';
                }else {
                   if(Total>cantidad && Total<amarillo ){
                      document.getElementById("total").style.color='orange';
                    document.getElementById("total").value=Total; 
                   }else{
                    document.getElementById("total").style.color='red';
                    document.getElementById("total").value=Total;
                    }
                }
//                Hora_Descanso_Entrada=document.getElementById('entrada_descanso').value;
//                Hora_Descanso_Salida=document.getElementById('salida_descanso').value;
//                justificar_descanso=document.getElementById('Justificar_Descanso').value;
//                Total=document.getElementById('total').value;
//                alert(Total); 
                id= document.getElementById('ID_Descanso').value;
                id_marcas=document.getElementById('ID_Asistencia').value;
                contador=document.getElementById('Contador').value;
               id_ajus_descanso=contador
               
                
               // alert(id);
              $.post("index.php?ctl=guardar_marcas_descanso",{Hora_Descanso_Entrada:Hora_Descanso_Entrada,
             Hora_Descanso_Salida:Hora_Descanso_Salida ,justificar_descanso:justificar_descanso, Total:Total,id:id,id_marcas:id_marcas,contador:contador}, function(data){
               
              //alert(data);
                //location.reload(); 
                });
                
            } 
        </script>
    </head>
   
    <body onload="bloqueo()">
        <nav class="navbar navbar-inverse">
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <li class="active"><a href="index.php?ctl=inicio">Inicio</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">  
          
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
    </div>
    </nav>
        <div class="container">
            <input type="text" hidden id="ID_Asistencia" value="<?php echo $params[0]['ID_Asistencia']?>">
            <input type="text" hidden id="fecha" value="<?php echo Date('y-m-d');?>">
            <input type="text" hidden id="Contador" value="<?php echo $params[0]['Contador']+1?>">
            <input type="text" hidden id="Contador_salida" value="<?php echo $params[0]['Contador']?>">
            
            <div class="col-sm-4">
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
                <button><a id="btn_justificacion_entrada"  onclick="justificacion_entrada()">Ingresar</a></button>
            </div>
         </div>
        
         <div class="container">
            <div class="col-sm-4">
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
                 <button><a id="btn_justificacion_salida" onclick="justificacion_salida()"> Ingresar</a></button>
            </div> 
        </div>
       
        <hr style=height:3px; width="95%">
        <br>
        
        <div class="container">
            <div class="col-sm-4">
                  
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
            <div class="col-sm-4">
                <label>Entrada del descanso</label>
                <input type="text" value="<?php echo $tiempos_descanso[0]['Hora_Descanso_Entrada']?>" class="form-control" id="entrada_descanso">
                <br>
                <button><a id="boton2" onclick="entrada_descanso()" >Ingresar</a></button>
            </div>
            <div class="col-sm-4">
                <label>Total</label>
                <input type="text"  hidden id="Cantidad" value="<?php  echo $descanso[0]['Duracion_Descanso'];?>">
                <input  type="text" value="<?php echo $tiempos_descanso[0]['Total_Descanso']?>" class="form-control" id="total">
               
                
            </div>
        </div>
        
        <div class="container">
             <br>
            <div class="col-sm-4">
                <label>Justificación Descanso </label>
                <input type="text" id="justificacion_descanso" value="<?php echo $tiempos_descanso[0]['Justificar_Descanso']?>" class="form-control">
                
            </div>
             <div class="col-sm-4">
                 <br>
                 <button><a id="btn_justificacion_descanso" onclick="justificacion_decanso()" >Ingresar</a></button>
            </div>
        </div> 
        <hr style=height:3px; width="95%">      
         <table class="table">
         <thead>
         <tr>
             <th> ID_Asistencia </th>  
             <th> Apellido y nombre  </th>  
             <th> Hora de entrada  </th> 
             <th> Justificar entrada </th>       
             <th> Hora de salida </th>
             <th> Justificar salida </th>
             <th> Fecha </th>
             </tr>
         </thead>                          
         <tbody>
             <?php
                $tam= count($marcas);
                
                for($i=0;$i<$tam;$i++){
               ?>
                <tr>
                    <td><?php echo $marcas[$i]['ID_Asistencia'] ?></td>
                    <td><?php echo $marcas[$i]['Apellido_Nombre'] ?></td>
                    <td><?php echo $marcas[$i]['Hora_Entrada_Turno'] ?></td>
                    <td><?php echo $marcas[$i]['Justificar_Entrada'] ?></td>   
                    <td><?php echo $marcas[$i]['Hora_Salida_Turno']?></td>
                    <td><?php echo $marcas[$i]['Justificar_Salida']?></td>
                    <td><?php echo $marcas[$i]['Fecha']?></td> 
                    <?php } ?>
                </tr>  
              
         </tbody>
    </table>
        <hr style=height:3px>   
    <table class="table">
         <thead>
         <tr>
             <th> Fecha  </th>
             <th> salida al descanso </th>
             <th> entrada del decanso </th>
             <th> Justificar descanso </th>
             <th> Total </th>
             <th> Duracion descanso </th>
             <th> Numero descanso </th>
             </tr>
         </thead>                          
         <tbody>
             <?php
                $tam2= count($descanso);
                for($i=0;$i<$tam2;$i++){
               ?>
                <tr> 
                     <td><?php echo $descanso[$i]['Fecha_Descanso'] ?></td>
                     <td><?php echo $descanso[$i]['Hora_Descanso_Salida'] ?></td>
                     <td><?php echo $descanso[$i]['Hora_Descanso_Entrada'] ?></td>
                     <td><?php echo $descanso[$i]['Justificar_Descanso'] ?></td>
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
                     <td><?php echo $descanso[$i]['Duracion_Descanso'] ?></td> 
                     <td><?php echo $descanso[$i]['ID_Ajus_Descanso'] ?></td> 
                     <?php } ?>
                </tr>  
         </tbody>
    </table>     
 </html>