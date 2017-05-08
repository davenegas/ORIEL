<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Justificar inconsistencia</title>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
        <script>
            $(document).ready(function (){
                <?php if($_SESSION['modulos']['Módulo-Asistencia de Personal']==1){ ?>
                    document.getElementById('operador').removeAttribute("hidden");
                    document.getElementById('justificacion').removeAttribute("readonly");
                <?php } ?>
                <?php if($_SESSION['modulos']['Módulo-Asistencia encargado empresa']==1){ ?>
                    document.getElementById('operador').removeAttribute("hidden");
                    document.getElementById('encargado_empresa').removeAttribute("hidden");
                    document.getElementById('seguimiento_empresa').removeAttribute("readonly");
                <?php } ?>
                <?php if($_SESSION['modulos']['Módulo-Asistencia encargado Banco']==1){ ?>
                    document.getElementById('operador').removeAttribute("hidden");
                    document.getElementById('encargado_empresa').removeAttribute("hidden");
                    document.getElementById('encargado_banco').removeAttribute("hidden");
                    document.getElementById('observaciones').removeAttribute("readonly");
                    document.getElementById('estado_inconsistencia').removeAttribute("disabled");
                    document.getElementById('tipo_inconsistencia').removeAttribute("disabled");
                <?php } ?>
            });
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class="row">
            <div class="col-sm-1 sidenav"></div>
            
            <div class="col-sm-10 container">
                <h2>Justificar inconsistencia</h2>
                <p></p>
                <form class="form-horizontal" id="guardar_inconsistencia" role="form" method="POST" action="index.php?ctl=asistencia_guardar_justificacion_inconsistencia">
                    <div id="informacion_general" class="row espacio-abajo">
                        <input type="text" hidden id="ID_Inconsistencia_Marca" name="ID_Inconsistencia_Marca">
                        <div class="col-sm-4">
                            <label for="marca_entrada">Marca entrada</label>
                            <input type="text" class="form-control" disabled id="marca_entrada" name="marca_entrada" value="<?php echo $inconsistencia[0]['Marca_Entrada']?>">
                        </div>
                        <div class="col-sm-4">
                            <label for="marca_salida">Marca salida</label>
                            <input type="text" class="form-control" disabled id="marca_salida" name="marca_salida" value="<?php echo $inconsistencia[0]['Marca_Salida']?>">
                        </div>
                        <div class="col-sm-4">
                            <label for="tipo_marca">Tipo marca</label>
                            <input type="text" class="form-control" disabled id="tipo_marca" name="tipo_marca" value="<?php echo $inconsistencia[0]['Tipo_Marca']?>">
                        </div>
                    </div>
                    <div id="operador" hidden class="row espacio-abajo">
                        <div class="col-sm-8">
                            <label for="justificacion">Justificación</label>
                            <input type="text" readonly class="form-control" id="justificacion" name="justificacion" value="<?php echo $inconsistencia[0]['Justificacion_Usuario']?>">
                        </div>
                        <div class="col-sm-4">
                            <label for="nombre_usuario">Nombre usuario</label>
                            <input type="text" readonly class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?php echo $inconsistencia[0]['Nombre']." ".$inconsistencia[0]['Apellido']?>">
                        </div>
                    </div>
                    <div id="encargado_empresa" hidden class="row espacio-abajo">
                        <!--                    <div class="col-sm-12">
                            <input type="radio" name="tipo_justificacion" id="tipo_justificacion" value="Normal" checked="checked">Normal
                            <input type="radio" name="tipo_justificacion" id="tipo_justificacion" value="Vacaciones">Vacaciones
                            <input type="radio" name="tipo_justificacion" id="tipo_justificacion" value="Incapacidad">Incapacidad
                            <input type="radio" name="tipo_justificacion" id="tipo_justificacion" value="Permiso">Permiso especial            
                        </div>-->
                        <div class="col-sm-8">
                            <label for="seguimiento_empresa">Seguimiento empresa</label>
                            <input type="text" readonly class="form-control" id="seguimiento_empresa" name="seguimiento_empresa" value="<?php echo $inconsistencia[0]['Seguimiento_Empresa']?>">
                        </div>
                        <div class="col-sm-4">
                            <label for="coordinador_empresa">Coordinador empresa</label>
                            <input type="text" hidden id="ID_Supervisor_Empresa" name="ID_Supervisor_Empresa" value="<?php echo $inconsistencia[0]['ID_Supervisor_Empresa']?>">
                            <input type="text" disabled class="form-control" id="coordinador_empresa" name="coordinador_empresa">
                        </div>
                    </div>
                    <div id="encargado_banco" hidden class="row espacio-abajo">
                        <div class="col-sm-8">
                            <label for="observaciones">Observaciones</label>
                            <input type="text" readonly class="form-control" id="observaciones" name="observaciones" value="<?php echo $inconsistencia[0]['Observaciones_Banco']?>">
                        </div>
                        <div class="col-sm-4">
                            <label for="coordinador_banco">Coordinador Banco</label>
                            <input type="text" hidden id="ID_Supervisor_Banco" name="ID_Supervisor_Banco" value="<?php echo $inconsistencia[0]['ID_Supervisor_Banco']?>">
                            <input type="text" disabled class="form-control" id="coordinador_banco" name="coordinador_banco">
                        </div>
                    </div>
                    <div id="informacion_general_2" class="row espacio-abajo">
                        <div class="col-sm-6">
                            <label for="estado_inconsistencia">Estado de la inconsistencia</label>
                            <select class="form-control" disabled id="estado_inconsistencia" name="estado_inconsistencia">
                                <option value="<?php echo $inconsistencia[0]['ID_Estado_Inconsistencia']?>"><?php echo $inconsistencia[0]['Estado_Inconsistencia']?></option>
                                <option value="5">Justificación valida</option>
                                <option value="6">Justificación invalida</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="tipo_inconsistencia">Tipo de inconsistencia</label>
                            <select class="form-control" disabled id="tipo_inconsistencia" name="tipo_inconsistencia">
                                <option value="<?php echo $inconsistencia[0]['ID_Tipo_Inconsistencia']?>"><?php echo $inconsistencia[0]['Tipo_Inconsistencia']?></option>
                                <option value="7">Vacaciones</option>
                                <option value="8">Incapacidad</option>
                                <option value="10">Permiso Especial</option>
                            </select>
                        </div>
                    </div>
                    <button><a href="javascript:%20validar_horario()" id="submit">Guardar</a></button>
                </form>
            </div>
            
            <div class="col-sm-1 sidenav"></div>
        </section>
        <?php require_once 'pie_de_pagina.php' ?>

    </body>
</html>
