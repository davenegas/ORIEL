<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de marcas</title>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class="row">
            <div class="col-sm-1 sidenav">     
            </div>
            
            <div class="col-sm-10 container">
                <h2>Lista de marcas por usuario</h2>
                <div class="row">
                    <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=asistencia_lista_marcas">
                        <h4 class="espacio-arriba">Seleccionar parámetros del filtro:</h4>
                        <div class="col-xs-2">
                            <label for="fecha_inicial">Fecha Inicial:</label>
                            <input type="date" required=”required” class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo $fecha_inicio;?>">
                        </div> 
                        <div class="col-xs-2">
                            <label for="fecha_final">Fecha Final:</label>
                            <input type="date" required=”required” class="form-control" id="fecha_final" name="fecha_final" value="<?php echo $fecha_fin;?>">
                        </div> 
                        <button type="submit" class="btn btn-default" style="margin-top: 25px; "value="Generar Reporte">Generar Reporte</button>
                        <a class="btn btn-default" style="margin-top: 25px;" href="index.php?ctl=asistencia_personal">Volver <span class="glyphicon glyphicon-share-alt" ></span></a>
                    </form>
                    
                </div>
                <div class="row espacio-arriba well">
                    <h4>Lista de marcas realizadas</h4>
                    <table id="tabla2" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th hidden style="text-align:center">ID_Marca</th>
                                <th style="text-align:center">Usuario</th>
                                <th style="text-align:center">Tipo marca</th>
                                <th style="text-align:center">Inicio</th>
                                <th style="text-align:center">Fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($marcas)){
                                $tam=count($marcas);
                                for ($i = 0; $i <$tam; $i++) { ?>
                                <tr>
                                    <td hidden style="text-align:center"><?php echo $marcas[$i]['ID_Marca'];?></td>
                                    <td style="text-align:center"><?php echo $marcas[$i]['Nombre']." ".$marcas[$i]['Apellido'];?></td>
                                    <td style="text-align:center"><?php echo $marcas[$i]['Tipo_Marca'];?></td>
                                    <td style="text-align:center"><?php echo $marcas[$i]['Marca_Entrada'];?></td>
                                    <td style="text-align:center"><?php echo $marcas[$i]['Marca_Salida'];?></td>
                                </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
                <div class="row espacio-arriba well">
                    <h4>Lista inconsistencias</h4>
                    <table id="tabla" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th hidden style="text-align:center">ID Inconsistencia Marca</th>
                                <th style="text-align:center">Usuario</th>
                                <th style="text-align:center">Marca entrada</th>
                                <th style="text-align:center">Marca salida</th>
                                <th style="text-align:center">Tipo marca</th>
                                <th style="text-align:center">Justificación</th>
                                <th style="text-align:center">Tipo Inconsistencia</th>
                                <th style="text-align:center">Estado Inconsistencia</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($inconsistencias)){
                                $tam=count($inconsistencias);
                                for ($i = 0; $i <$tam; $i++) { ?>
                                <tr>
                                    <td hidden style="text-align:center"><?php echo $inconsistencias[$i]['ID_Inconsistencia_Marca'];?></td>
                                    <td style="text-align:center"><?php echo $inconsistencias[$i]['Nombre']. " ".$inconsistencias[$i]['Apellido'];?></td>
                                    <td style="text-align:center"><?php echo $inconsistencias[$i]['Marca_Entrada'];?></td>
                                    <td style="text-align:center"><?php echo $inconsistencias[$i]['Marca_Salida'];?></td>
                                    <td style="text-align:center"><?php echo $inconsistencias[$i]['Tipo_Marca'];?></td>
                                    <td style="text-align:center"><?php echo $inconsistencias[$i]['Justificacion_Usuario'];?></td>
                                    <td style="text-align:center"><?php echo $inconsistencias[$i]['Tipo_Inconsistencia'];?></td>
                                    <td style="text-align:center"><?php echo $inconsistencias[$i]['Estado_Inconsistencia'];?></td>
                                    <?php if($inconsistencias[$i]['ID_Estado_Inconsistencia']==1 || $_SESSION['modulos']['Módulo-Asistencia encargado empresa']==1|| $_SESSION['modulos']['Módulo-Asistencia encargado Banco']==1) {?>
                                        <td style="text-align:center"><a href="index.php?ctl=asistencia_inconsistencia_justificar&id=<?php echo $inconsistencias[$i]['ID_Inconsistencia_Marca'];?>">
                                            Justificar inconsistencia</a></td>
                                    <?php } else {?>
                                        <td style="text-align:center"></td> 
                                    <?php }?>
                                </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
                <a class="buttons" href="index.php?ctl=asistencia_lista_marcas">Volver <span class="glyphicon glyphicon-share-alt" ></span></a>
            </div>
            
            <div class="col-sm-1 sidenav">
            </div>
        </section>
        <?php require_once 'pie_de_pagina.php' ?>

    </body>
</html>
