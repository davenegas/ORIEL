<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Direcciones IP</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_direcciones_ip.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html';?>
        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <div class="container">
        <h2>Listado General de Direcciones IP</h2>
        <p>A continuación se detallan las diferentes Direcciones IP que están registrados en el sistema:</p> 
<!--        <pre>
           <?php print_r($params);?>
        </pre>-->
        <table id="tabla" class="display" cellspacing="0">
          <thead>
            <tr>
                <!--<th style="text-align:center">ID Direccion IP</th>-->
                <th style="text-align:center">Tipo Direccion</th>
                <th style="text-align:center">Direccion IP</th>
                <th style="text-align:center">Observaciones</th>
                <th style="text-align:center">Editar Direccion IP</th>
                <th style="text-align:center">Eliminar Direccion IP</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tam=count($params);  
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
<!--                <td style="text-align:center"><?php echo $params[$i]['ID_Direccion_IP'];?></td>-->
                <td style="text-align:center"><?php echo $params[$i]['Tipo_IP'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Direccion_IP'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>          
                <td style="text-align:center"><a href="">Editar</a></td>
                <td style="text-align:center"><a href="">Eliminar</a></td>
            </tr>     
            
            <?php }
            ?>
          </tbody>
        </table>
        <a href="" class="btn btn-default" role="button">Agregar Nueva Direccion IP</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>