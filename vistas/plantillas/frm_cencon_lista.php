<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Personal Externo</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_personal_externo.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class="container">
            <table id="tabla" class="display" cellspacing="0" width="100%">
                <thead> 
                    <tr>
                        <th style="text-align:center">ATM</th>
                        <th style="text-align:center">Funcionario</th>
                        <th style="text-align:center">Cédula</th>
                        <th style="text-align:center">Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($params)){
                        $tam=count($params);
                        for ($i = 0; $i <$tam; $i++) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $params[$i][''];?></td>
                            <td style="text-align:center"><?php echo $params[$i][''];?></td>
                            <td style="text-align:center"><?php echo $params[$i][''];?></td>
                            <td style="text-align:center"><?php echo $params[$i][''];?></td>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
            <a href="index.php?ctl=cencon_gestion&id=0" class="btn btn-default" role="button">Agregar Nueva Relación</a>
        </section>
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>