<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de net_test</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>            
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
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Listado General de Ping Oficinas del BCR</h2>
                    <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=net_test_Buscar">
                    <h4 class="espacio-arriba">Seleccionar parámetros del filtro:</h4>                    
                    <div class="col-xs-2">
                            <label for="codigo">Cód. PuntoBCR</label>
                            <input class="form-control espacio-abajo" required id="codigo" name="codigo" placeholder="Código" type="text">
                        </div>
                    <div class="col-xs-2">
                        <label for="fecha_inicial">Fecha Inicial:</label>
                        <input type="date" required class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo $fecha_inicio;?>">
                    </div> 
                    <div class="col-xs-2">
                        <label for="fecha_final">Fecha Final:</label>
                        <input type="date" required class="form-control" id="fecha_final" name="fecha_final" value="<?php echo $fecha_fin;?>">
                    </div>
                    <div class="col-xs-2">
                        <label for="hora_inicial">Hora Inicial:</label>
                        <input type="time" required class="form-control" id="hora_inicial" name="hora_inicial" value="<?php echo $hora_inicio;?>">
                    </div> 
                    <div class="col-xs-2">
                        <label for="hora_final">Hora Final:</label>
                        <input type="time" required class="form-control" id="hora_final" name="hora_final" value="<?php echo $hora_fin;?>">
                    </div>                     
                    <div class="col-xs-2">
                        <label for="tipo_ip">Tipo IP</label>
                        <select class="form-control" required id="Tipo_IP" name="Tipo_IP" >
                            <option value="0">Todas los Tipos IP</option>                            
                            <?php 
                            $tam_tipoip=count($tipo_ip);                            
                            for($i=0; $i<$tam_tipoip;$i++){ ?>
                                <option value="<?php echo $tipo_ip[$i]['ID_Tipo_IP']?>"><?php echo $tipo_ip[$i]['Tipo_IP']?></option>                           
                            <?php } ?> 
                        </select>                        
                    </div>
                    <div class="row"></div>
                    <button  type="submit" type="button" class="btn btn-primary">Consultar</button>                        
                </form>
            <br>
            <br>
            <p>A continuación se detallan los registros del sistema:</p>
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID_PuntoBCR</th>
                        <th style="text-align:center">Nombre</th>
                        <th style="text-align:center">Código</th>
                        <th style="text-align:center">Dirección IP</th>
                        <th style="text-align:center">Estado</th>
                        <th style="text-align:center">Fecha</th>
                        <th style="text-align:center">Duración</th>                        
                        <th style="text-align:center">Tipo Ip</th>                        
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($net_test); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                        <td hidden style="text-align:center"><?php echo $net_test[$i]['ID_PuntoBCR'];?></td>
                        <td><?php echo $net_test[$i]['Nombre'];?></td>
                        <td><?php echo $net_test[$i]['Codigo'];?></td>
                        <td><?php echo $net_test[$i]['Direccion_IP'];?></td>
                        <td style="<?php if($net_test[$i]['Estado'] == "Success"){ echo 'background-color: #b7f2b5';}else{echo 'background-color: #ffb366';}?>" ><?php echo $net_test[$i]['Estado'];?></td>
                        <td><?php echo $net_test[$i]['Fecha'];?></td>
                        <td><?php echo $net_test[$i]['Duracion'];?></td>
                        <td><?php echo $net_test[$i]['Tipo_IP'];?></td>                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a id="popup" onclick="mostrar_agregar_net_test()" class="btn btn-default" role="button">Agregar net_test</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>        
    </body>
</html>