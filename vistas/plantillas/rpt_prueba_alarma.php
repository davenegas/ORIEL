<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Reporte de pruebas de alarma</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?> 
        <script>
        $(document).ready(function(){
           $("#tipo_punto").change(function () {
                   $("#tipo_punto option:selected").each(function () {
                    id_tipo_punto_bcr = $(this).val();
                    id_provincia=document.getElementById('nombre_provincia').value;
                    $.post("index.php?ctl=actualiza_en_vivo_punto_bcr", { id_tipo_punto_bcr: id_tipo_punto_bcr,id_provincia:id_provincia }, function(data){
                        $("#punto_bcr").html(data);
                        
                    });            
                });
           });
           $("#nombre_provincia").change(function () {
                   $("#nombre_provincia option:selected").each(function () {
                    id_provincia = $(this).val();
                    id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
                    $.post("index.php?ctl=actualiza_en_vivo_punto_bcr", { id_tipo_punto_bcr: id_tipo_punto_bcr,id_provincia:id_provincia }, function(data){
                        $("#punto_bcr").html(data); 
                        
                    });            
                });
           });
        });
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container animated fadeIn quitar-float">
            <h3>Generar Reporte de pruebas de alarma</h3> 
            <div class="espacio-abajo">
                <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=reporte_prueba_alarma">
                    <h4 class="espacio-arriba">Seleccionar parámetros del filtro:</h4>
                    <div class="col-xs-2">
                        <label for="fecha_inicial">Fecha Inicial:</label>
                        <input type="date" required=”required” class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo $fecha_inicio;?>">
                    </div> 
                    <div class="col-xs-2">
                        <label for="fecha_final">Fecha Final:</label>
                        <input type="date" required=”required” class="form-control" id="fecha_final" name="fecha_final" value="<?php echo $fecha_fin;?>">
                    </div>
                    <div class="col-xs-2">
                        <label for="punto_bcr">Punto BCR</label>
                        <select class="form-control" required=”required” id="punto_bcr" name="punto_bcr" >
                            <option value="0">Todos</option>
                            <?php 
                            $tam_puntos_bcr=count($Oficinas);
                            for($i=0; $i<$tam_puntos_bcr;$i++){ ?>
                                <option value="<?php echo $Oficinas[$i]['ID_PuntoBCR']?>"><?php echo $Oficinas[$i]['Nombre']?></option>                           
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="col-xs-2">
                        <label for="tipo_seguimiento">Tipo Seguimiento</label>
                        <select class="form-control" required=”required” id="tipo_seguimiento" name="tipo_seguimiento" >
                            <option value="0">Todos</option>
                            <option value="Se solicitó la prueba">Se solicitó la prueba</option>
                            <option value="Oficina en Asueto">Oficina en Asueto</option>
                            <option value="Oficina con trabajos">Oficina con Trabajos</option>
                            <option value="Alarma abierta 24 horas">Alarma abierta 24 horas</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default" style="margin-top: 25px; "value="Generar Reporte">Generar Reporte</button>
                </form>
            </div>
            <div class="container animated fadeIn">
               
                <table id="tabla" class="display2">
                    <thead>   
                        <tr>
                            <th hidden style="text-align:center">ID Prueba Alarma</th>
                            <th style="text-align:center">Fecha</th>
                            <th style="text-align:center">Código</th>
                            <th style="text-align:center">Nombre</th>
                            <th style="text-align:center">Nombre Persona Prueba</th>
                            <th style="text-align:center">Hora Apertura Alarma</th>
                            <th style="text-align:center">Hora Prueba Alarma</th>
                            <th style="text-align:center">Número Zona Prueba</th>
                            <th style="text-align:center">Hora Cierre Alarma</th>
                            <th style="text-align:center">Seguimiento</th>
                            <th style="text-align:center">Tipo Prueba</th>
                            <th style="text-align:center">Nombre Persona Cierre</th>
                            <th style="text-align:center">Partición Secundaria Cierre</th>
                            <th style="text-align:center">Partición Principal Cierre</th>
                            <th style="text-align:center">Observaciones</th>  
                        </tr>
                    </thead>
                    <tbody id="cuerpo">
                        <?php 
                        $tam=count($prueba);
                        for ($i = 0; $i <$tam; $i++) { ?>
                            <tr>
                                <td hidden style="text-align:center"><?php echo $prueba[$i]['ID_Prueba_Alarma'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Fecha'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Codigo'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Nombre'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Nombre_Persona_Apertura'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Hora_Apertura_Alarma'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Hora_Prueba_Alarma'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Numero_Zona_Prueba'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Hora_Cierre_Alarma'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Seguimiento'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Tipo_Prueba'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Nombre_Persona_Cierre'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Particion_Secundaria_Cierre'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Particion_Principal_Cierre'];?></td>
                                <td style="text-align:center"><?php echo $prueba[$i]['Observaciones'];?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>