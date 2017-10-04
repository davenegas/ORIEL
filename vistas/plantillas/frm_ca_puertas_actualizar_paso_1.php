<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Actualizar puertas paso 1</title>
        <?php require_once 'frm_librerias_head.html'; ?>  
        <script>
            $(document).ready(function () {
                // Una vez se cargue al completo la página desaparecerá el div "cargando"
                $('#cargando').hide();
            });
        </script>        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div id="cargando">
            <center><img align="center" src="vistas/Imagenes/Espere.gif"/></center>
        </div>
        <div class="animated fadeIn">
            <h2>Listado de puertas contraladas Recibidas:</h2>
            
            <a href="index.php?ctl=actualizar_puertas_paso_2" class="btn btn-default espacio-abajo" role="button">Validar información</a>
            <a href="index.php?ctl=principal" class="btn btn-default espacio-abajo" role="button">Salir del Asistente</a> 

            <table id="tabla" class="display espacio-arriba">
                <thead>
                    <tr>
                        <th style="text-align:center">Owner</th>
                        <th style="text-align:center">Name</th>
                        <th style="text-align:center">State</th>
                        <th style="text-align:center">DoorSwitch</th>
                        <th style="text-align:center">value</th>
                        <th style="text-align:center">ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($_SESSION['controladores']);
                    for ($i = 0; $i <$tam; $i++){ ?>
                        <tr>
                            <td style="text-align:center"><?php echo $_SESSION['controladores'][$i][0];?></td>
                            <td style="text-align:center"><?php echo $_SESSION['controladores'][$i][1];?></td>
                            <td style="text-align:center"><?php echo $_SESSION['controladores'][$i][2];?></td>
                            <td style="text-align:center"><?php echo $_SESSION['controladores'][$i][3];?></td>
                            <td style="text-align:center"><?php echo $_SESSION['controladores'][$i][4];?></td>
                            <td style="text-align:center"><?php echo $_SESSION['controladores'][$i][5];?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>