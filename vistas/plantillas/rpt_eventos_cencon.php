<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Eventos Cerrados</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_reporte_cencon.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>   
        <script>
        function hacer_click(){

        $('#cuerpo').html('<center><img align="center" src="vistas/Imagenes/loading.gif"/></center>');
        
         fecha_inicial=document.getElementById('fecha_inicial').value;
         fecha_final=document.getElementById('fecha_final').value;
                           
        $.post("index.php?ctl=actualiza_en_vivo_reporte_cencon", {fecha_inicial: fecha_inicial,fecha_final:fecha_final}, function(data){
        
            $("#titulo").html("Eventos de acuerdo a parámetros:");  
            $("#tabla").html(data);   
            $("#tabla").dataTable().fnDestroy();
            $("#tabla").dataTable().draw();
            
        });    
	}
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
<!--        <pre>
            <?php print_r($params)?>
        </pre>-->
        <div class="container animated fadeIn quitar-float">
        <h3>Generar Reporte de Eventos Cerrados del Sistema</h3> 
        
        <h4 class="espacio-arriba">Seleccionar parámetros del filtro:</h4>
      
        <div class="col-xs-2">
              <label for="fecha_inicial">Fecha Inicial:</label>
              <input type="date" required=”required” class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo date("Y-m-d");?>">
        </div> 
         <div class="col-xs-2">
              <label for="fecha_final">Fecha Final:</label>
              <input type="date" required=”required” class="form-control" id="fecha_final" name="fecha_final" value="<?php echo date("Y-m-d");?>">
        </div> 

        <a class="btn btn btn-default azul" style="margin-top: 25px; " role="button" onclick="hacer_click()">Generar Reporte</a>
        
        <div class="container animated fadeIn">
        <h3 id="titulo">Listado de Eventos Cencon del día de hoy:</h3>
        
        <table id="tabla" class="display2">
            <thead>   
                <tr>
                    <th hidden>ID_Evento_Cencon</th>
                    <th style="text-align:center">Fecha Apertura</th>
                    <th style="text-align:center">Hora Apertura</th>
                    <th style="text-align:center">Fecha Cierre</th>
                    <th style="text-align:center">Hora Cierre</th>
                    <th style="text-align:center">Nombre Cajero</th>
                    <th style="text-align:center">Funcionario</th>
                    <th style="text-align:center">Empresa</th>
                    <th style="text-align:center">Usuario</th>   
                    <th style="text-align:center">Observaciones</th>
                </tr>
            </thead>
            <tbody id="cuerpo">
                <?php 
                $tam=count($params);

                for ($i = 0; $i <$tam; $i++) { ?>
                    <tr>
                        <td hidden style="text-align:center"><?php echo $params[$i]['ID_Evento_Cencon'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Fecha_Apertura'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Hora_Apertura'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Fecha_Cierre'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Hora_Cierre'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Codigo']." - ".$params[$i]['Nombre'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Nombre_Persona'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Empresa'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Nombre_usuario'].' '.$params[$i]['Apellido_usuario'];?></td>
                        <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                    </tr>
            <?php } ?>
            
            </tbody>
        </table>
        
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>