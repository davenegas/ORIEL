<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de recepcion_parqueo</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Listado General de Control de Visitas del BCR</h2>
            <p>A continuación se detallan los registros del sistema:</p>
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>

                        <th style="text-align:center">Nombre</th>
                        <th style="text-align:center">Prestamo</th>
                        <th style="text-align:center">Prestamo A</th>
                        <th style="text-align:center">Lugar</th>                        
                        <th style="text-align:center">Cédula</th>
                        <th style="text-align:center">Placa</th>
                        <th style="text-align:center">Fecha Entrada</th>
                        <th style="text-align:center">Hora Entrada</th>
                        <th style="text-align:center">Fecha Salida</th>
                        <th style="text-align:center">Hora Salida</th>
                        <th style="text-align:center">Ubicación</th>
                        <th style="text-align:center">Tipo</th>                        
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($recepcion_parqueo); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>

                        <td><?php echo $recepcion_parqueo[$i]['Nombre'];?></td>
                        <td><?php echo $recepcion_parqueo[$i]['Es_Prestamo'];?></td>
                        <td><?php echo $recepcion_parqueo[$i]['Prestamo'];?></td>
                        <td><?php echo $recepcion_parqueo[$i]['Num_Lugar'];?></td>                        
                        <td><?php echo $recepcion_parqueo[$i]['Cedula'];?></td>
                        <td><?php echo $recepcion_parqueo[$i]['Placa'];?></td>
                        <td><?php echo $recepcion_parqueo[$i]['Fecha_Entrada'];?></td>
                        <td><?php echo $recepcion_parqueo[$i]['Hora_Entrada'];?></td>
                        <td><?php echo $recepcion_parqueo[$i]['Fecha_Salida'];?></td>
                        <td><?php echo $recepcion_parqueo[$i]['Hora_Salida'];?></td>
                        <td><?php echo $recepcion_parqueo[$i]['Ubicacion'];?></td>
                        <td><?php echo $recepcion_parqueo[$i]['Descripcion'];?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>            
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>