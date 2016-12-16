<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Eventos</title>
        <?php require_once 'frm_librerias_head.html'; ?>          
        <script language="javascript" src="vistas/js/refresca_pagina_automaticamente.js"></script>  
         <script>
          $(document).ready(function () {
            $.post("index.php?ctl=cuenta_visitas_a_bitacora_digital");
          });
          $(document).ready(function () {
              puestoenviado=<?php echo $puesto_enviado ?>;
            $("#puesto option[value="+puestoenviado+"]").attr("selected",true);
          });
        function validar_puesto(pst){
            puesto = pst;
            document.getElementById('puestos').submit();
        }
        
        function cambiar_estado_boton_resumen(codigo){
 
            identificador='btn'+codigo;
           
            var objetoSPAN = document.getElementById(identificador); 
                        
            if (objetoSPAN.innerHTML =='+'){
                objetoSPAN.innerHTML = '-'; 
            } else {
                 objetoSPAN.innerHTML = '+'; 
            }
            
           
            
//            else {
//             alert('entra');
//                if (objetoSPAN.innerHTML ='-'){
//                    
//                    objetoSPAN.innerHTML = "+"; 
//                }
//             }
            //alert(document.getElementById('btn').value);
            //var prueba ='btn';
            
            //var objetoSPAN = document.getElementById(prueba); 
            // objetoSPAN.innerHTML = "hola"; 
             
            //if(objetoSPAN.innerHTML=="+") 
           
            //else 
            //objetoSPAN.innerHTML = "ESTE ES UN TEXTO DE PRUEBA"	
            //return true; 
            //alert(document.getElementById('btn').);
           // $('btn').html('prueba');
//            if (document.getElementById('btn').value="+"){
//                document.getElementById('btn').textContentvalue='-';
//                document.getElementById('btn').value='-';
//                $get('btn').value = 'Cerrar'; 
//                $get('btn').textContentvalue = 'Cerrar'; 
//                
//            }else{
//                
//            }
        }
        
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn">
        <div class="col-md-5">
            <h2>Listado de Eventos</h2>
            <!--<p>A continuación se detallan los diferentes roles que están registrados en el sistema:</p>-->            
            <a href="index.php?ctl=frm_eventos_agregar&id=0" class="btn btn-default espacio-abajo" role="button">Agregar Nuevo Evento de Bitácora</a>
            <a href="index.php?ctl=frm_eventos_lista_cerrados" class="btn btn-default espacio-abajo quitar-float" role="button">Eventos Cerrados</a> 
        </div>
        <div class="col-md-2" style="margin-top: 35px;">
            <form id="puestos" method="POST" name="form" action="index.php?ctl=eventos_listar_filtrado">
            <label for="puesto">Puesto</label>
            <select class="form-control" id="puesto" name="puesto" onchange="validar_puesto(value);"> 
                <option value="0">Todos</option>
                <option value="1">Puesto 1</option>
                <option value="2">Puesto 2</option>
                <option value="3">Puesto 3</option>
                <option value="4">Puesto 4</option>
            </select>
            </form>
        </div>
        
        <table id="tabla" class="display">
          <thead>
            <tr>
              <th hidden="true">ID_Evento</th>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Lapso</th>
              <th>Provincia</th>
              <th>Tipo Punto</th>
              <th>Punto BCR</th>
              <th>Codigo</th>
              <th>Tipo de Evento</th>
              <th>Estado del Evento</th>
              <th>Último Seguimiento</th>
              <th>Editar Evento</th>
              <th>Resumen</th>
              <th id="demo1" hidden="hidden">Seguimientos</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tam=count($params);
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr data-toggle="tooltip" title="<?php echo $detalle_y_ultimo_usuario[$i]['Detalle'];?>">
            <?php
            $fecha_evento = date_create($params[$i]['Fecha']);
            $fecha_actual = date_create(date("d-m-Y"));
            $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            ?>
                <td hidden="true"><?php echo $params[$i]['ID_Evento'];?></td>
            <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
            <td><?php echo $params[$i]['Hora'];?></td>
            <td align="center"><?php echo $dias_abierto->format('%a');?></td>
            <td><?php echo $params[$i]['Nombre_Provincia'];?></td>
            <td><?php echo $params[$i]['Tipo_Punto'];?></td>
            <td><?php echo $params[$i]['Nombre'];?></td>
            <td><?php echo $params[$i]['Codigo'];?></td>
            <td><?php echo $params[$i]['Evento'];?></td>
            <td><?php echo $params[$i]['Estado_Evento'];?></td>
            <!--<td><?php echo $params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido'] ?></td>-->
            <td><?php echo $detalle_y_ultimo_usuario[$i]['Usuario'] ?></td>
            <td align="center"><a href="index.php?ctl=frm_eventos_editar&accion=editar_abiertos&id=
               <?php echo $params[$i]['ID_Evento']?>">Gestionar Seguimiento</a></td>
            <td style="text-align:center"><button data-toggle="collapse" data-target="#<?php echo $params[$i]['ID_Evento'];?>" id="btn<?php echo $params[$i]['ID_Evento'];?>" onclick="cambiar_estado_boton_resumen(<?php echo $params[$i]['ID_Evento'];?>);">+</button></td>
            <td id="<?php echo $params[$i]['ID_Evento'];?>" hidden="hidden">
                <table class="table-condensed">
            <thead>
                <tr>
                  <th>Fecha de Seguimiento</th>
                  <th>Hora de Seguimiento</th>
                  <th>Detalle del Seguimiento</th>
                  <th>Ingresado Por</th>
               </tr>
            </thead>
                <tbody>
                <?php 
                $tama=count($todos_los_seguimientos_juntos);
                for ($j = 0; $j <$tama; $j++) {
                ?>
                <tr>
                <?php
                $fecha_evento = date_create($todos_los_seguimientos_juntos[$j]['Fecha']);
                $fecha_actual = date_create(date("d-m-Y"));
                $dias_abierto= date_diff($fecha_evento, $fecha_actual);
                if ($params[$i]['ID_Evento']==$todos_los_seguimientos_juntos[$j]['ID_Evento']){
                ?>
                
                <td><?php echo date_format($fecha_evento, 'd/m/Y');?></td>
                <td><?php echo $todos_los_seguimientos_juntos[$j]['Hora'];?></td>
                <td><?php echo $todos_los_seguimientos_juntos[$j]['Detalle'];?></td>
                <td><?php echo $todos_los_seguimientos_juntos[$j]['Nombre_Usuario']." ".$todos_los_seguimientos_juntos[$j]['Apellido'] ?></td>               
                <?php }} ?>
                </tbody>
            </table>  
            </td>
            </tr>
            
            
            <?php }
            ?>
            </tbody>
            
        </table>
        
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>