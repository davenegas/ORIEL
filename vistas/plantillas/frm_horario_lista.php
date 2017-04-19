<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista Horarios BCR</title>
        <?php require_once 'frm_librerias_head.html'; ?>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class='container'>
            <h2>Listado General de Horarios</h2>
            <p>A continuación se detallan los diferentes horario registrados en el sistema</p>
            <table id="tabla5" class="display" cellspacing="0" width="100%">
                <thead> 
                    <tr>
                        <th style="text-align:center">Horario</th>
                        <th style="text-align:center">Domingo</th>
                        <th style="text-align:center">Lunes</th>
                        <th style="text-align:center">Martes</th>
                        <th style="text-align:center">Miercoles</th>
                        <th style="text-align:center">jueves</th>
                        <th style="text-align:center">Viernes</th>
                        <th style="text-align:center">Sábado</th>
                        <th style="text-align:center">Observaciones</th>
                        <th style="text-align:center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $tam = count($horarios);
                    for($i=0; $i<$tam;$i++){ ?>
                        <tr>
                            <?php if ($horarios[$i]['Tipo_Horario']=="Público"){ ?>
                                <td style="text-align:center">Horario público</td>
                            <?php } else { ?>
                                <td style="text-align:center">Horario oficina</td>
                            <?php } ?>
                            <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Domingo']." - ".$horarios[$i]['Hora_Cierre_Domingo'];?></td>
                            <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Lunes']." - ".$horarios[$i]['Hora_Cierre_Lunes'];?></td>
                            <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Martes']." - ".$horarios[$i]['Hora_Cierre_Martes'];?></td>
                            <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Miercoles']." - ".$horarios[$i]['Hora_Cierre_Miercoles'];?></td>
                            <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Jueves']." - ".$horarios[$i]['Hora_Cierre_Jueves'];?></td>
                            <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Viernes']." - ".$horarios[$i]['Hora_Cierre_Viernes'];?></td>
                            <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Sabado']." - ".$horarios[$i]['Hora_Cierre_Sabado'];?></td>
                            <td style="text-align:center"><?php echo $horarios[$i]['Observaciones'];?></td>
                            <td style="text-align:center"><a href="index.php?ctl=horario_gestion&ide=
                                <?php echo $horarios[$i]['ID_Horario']?>">
                                    Editar Horario</a></td>
                        </tr>
                    <?php } ?>
                </tbody> 
            </table> 
            <a href="index.php?ctl=horario_gestion&ide=0" class="btn btn-default" role="button">Agregar Nuevo Horario</a>
        </section>
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>