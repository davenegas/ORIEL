   <!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Cuestionario</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Listado General de andru_cuestionario del BCR</h2>
            <p>A continuación se detallan los registros del sistema:</p>
<table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID_Cuestionario</th>
                        <th hidden style="text-align:center">ID_PuntoBCR</th>
                        <th hidden style="text-align:center">ID_Fase</th>
                        <th hidden style="text-align:center">Usuario_Crea</th>
                        <th hidden style="text-align:center">Usuario_Modifica</th>
                        <th style="text-align:center">Oficina</th>
                        <th style="text-align:center">Fase</th>
                        <th style="text-align:center">Usuario Crea</th>
                        <th style="text-align:center">Fecha Crea</th>
                        <th style="text-align:center">Usuario Modifica</th>
                        <th style="text-align:center">Fecha Modifica</th>
                        <th style="text-align:center">Estado</th>
                        <th style="text-align:center">Cambiar Estado</th>
                        <th style="text-align:center">Mantenimiento</th>
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($andru_cuestionario); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                        <td  hidden style="text-align:center"><?php echo $andru_cuestionario[$i]['ID_Cuestionario'];?></td>
                        <td hidden ><?php echo $andru_cuestionario[$i]['ID_PuntoBCR'];?></td>
                        <td hidden ><?php echo $andru_cuestionario[$i]['ID_Fase'];?></td>
                        <td hidden ><?php echo $andru_cuestionario[$i]['Usuario_Crea'];?></td>
                        <td hidden ><?php echo $andru_cuestionario[$i]['Usuario_Modifica'];?></td>
                        <td><?php echo $andru_cuestionario[$i]['Nombre'];?></td>
                        <td><?php echo $andru_cuestionario[$i]['Descripcion'];?></td>
                        <td><?php echo $andru_cuestionario[$i]['Crea'];?></td>                        
                        <td><?php echo $andru_cuestionario[$i]['Fecha_Crea'];?></td>
                        <td><?php echo $andru_cuestionario[$i]['Modifica'];?></td>
                        <td><?php echo $andru_cuestionario[$i]['Fecha_Modifica'];?></td>
                        <?php if ($andru_cuestionario[$i]['Estado']==1){?>
                            <td style="text-align:center">Activo</td>
                        <?php }else {?>
                            <td style="text-align:center">Inactivo</td>
                        <?php }?>

                        <td style="text-align:center"><a href="index.php?ctl=andru_cuestionario_cambiar_estado&ID_Cuestionario=<?php echo $andru_cuestionario[$i]['ID_Cuestionario']?>&Estado=<?php echo $andru_cuestionario[$i]['Estado']?>">Activar/Desactivar</a></td>
                        <td style="text-align:center"><a role="button" href="index.php?ctl=andru_cuestionario&idcues=<?php echo $andru_cuestionario[$i]['ID_Cuestionario']?>&idpunto=<?php echo $andru_cuestionario[$i]['ID_PuntoBCR']?>&idfase=<?php echo $andru_cuestionario[$i]['ID_Fase']?>">Editar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="index.php?ctl=andru_cuestionario&idcues=0&idpunto=0&idfase=0" class="btn btn-default" role="button">Agregar Cuestionario</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>
