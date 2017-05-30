<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>TL300 en Puntos BCR</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_direcciones_ip.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
          <script>
            $(document).ready(function () {
                                          
                if ( $.fn.dataTable.isDataTable('#tabla') ) {
                    table = $('#tabla').DataTable();
                }
                table.destroy();
                table = $('#tabla').DataTable( {
                    stateSave: true,
                    "lengthMenu": [[10, 25, 50,100,-1], [10, 25, 50,100,"All"]]
                });           
            });
          </script>
    </head>
    <body>
        <?php require_once 'encabezado.php'; ?>

        <div class="container">
            <h2>Listado General de Puntos BCR con TL300</h2>
            <p>A continuación se detallan las diferentes Puntos BCR que cuentan con TL300:</p> 
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align:center">Nombre</th>
                        <th style="text-align:center">Dirección</th>
                        <th style="text-align:center">Cuenta SIS</th>
                        <th style="text-align:center">Código</th>
                        <th style="text-align:center">Direccion IP TL300</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tam = count($params);
                    for ($i = 0; $i < $tam; $i++) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $params[$i]['Nombre']; ?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Direccion']; ?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Cuenta_SIS']; ?></td> 
                            <td style="text-align:center"><?php echo $params[$i]['Codigo']; ?></td> 
                            <td style="text-align:center"><?php echo $params[$i]['Direccion_IP']; ?></td> 
                        </tr>     
                    <?php } ?>
                </tbody>
            </table>
            
        </div>
        
        <?php require 'vistas/plantillas/pie_de_pagina.php'?>
    </body>
</html>