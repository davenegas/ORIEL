<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Justificar inconsistencia</title>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
        <script>
            $(document).ready(function (){
                document.getElementById('operador').removeAttribute("hidden");
                <?php if($_SESSION['modulos']['Módulo-Asistencia de Personal']==1 && $inconsistencia[0]['ID_Estado_Inconsistencia']==1){ ?>
                    document.getElementById('justificacion').removeAttribute("disabled");
                <?php } if($_SESSION['modulos']['Módulo-Asistencia encargado empresa']==1 && $inconsistencia[0]['ID_Estado_Inconsistencia']==3){ ?>
                    document.getElementById('operador').removeAttribute("hidden");
                    document.getElementById('encargado_empresa').removeAttribute("hidden");
                    document.getElementById('seguimiento_empresa').removeAttribute("disabled");
                <?php } if($_SESSION['modulos']['Módulo-Asistencia encargado Banco']==1 && $inconsistencia[0]['ID_Estado_Inconsistencia']==4){ ?>
                    document.getElementById('operador').removeAttribute("hidden");
                    document.getElementById('encargado_empresa').removeAttribute("hidden");
                    document.getElementById('encargado_banco').removeAttribute("hidden");
                    document.getElementById('observaciones_banco').removeAttribute("disabled");
                    document.getElementById('estado_inconsistencia').removeAttribute("disabled");
                    document.getElementById('tipo_inconsistencia').removeAttribute("disabled");
                <?php } if ($inconsistencia[0]['ID_Estado_Inconsistencia']==5 || $inconsistencia[0]['ID_Estado_Inconsistencia']==6) {?>
                    document.getElementById('operador').removeAttribute("hidden");
                    document.getElementById('encargado_empresa').removeAttribute("hidden");
                    document.getElementById('encargado_banco').removeAttribute("hidden");
                <?php }?>
            });
            
            function guardar_justificacion(tipo){
                var justificacion= document.getElementById('justificacion').value;
                var cont = justificacion.length;
                console.log("Palabras: "+cont);
                if(cont>=10){
                    $.confirm({title: 'Confirmación!', content: 'Después de guardada la justificación no se podrá cambiar. ¿Desea guardar la justificación actual?', 
                    confirm: function(){
                        id_inconsistencia = document.getElementById('ID_Inconsistencia_Marca').value;
                        $.post("index.php?ctl=asistencia_guardar_justificacion_inconsistencia", { id_inconsistencia: id_inconsistencia, tipo: tipo, justificacion:justificacion}, function(data){
                            // alert(data);
                            console.log(data);
                            location.reload();
                        });
                    },
                    cancel: function(){}
                    });
                } else {
                    alert("La justificación debe contener mínimo 10 caracteres!!!");
                }
            }
            function guardar_seguimiento(tipo){
                var seguimiento= document.getElementById('seguimiento_empresa').value;
                var cont = seguimiento.length;
                console.log("Palabras: "+cont);
                if(cont>=10){
                    $.confirm({title: 'Confirmación!', content: 'Después de guardar el seguimiento no se podrá cambiar. ¿Desea guardar el seguimiento actual?', 
                    confirm: function(){
                        id_inconsistencia = document.getElementById('ID_Inconsistencia_Marca').value;
                        $.post("index.php?ctl=asistencia_guardar_justificacion_inconsistencia", { id_inconsistencia: id_inconsistencia, tipo: tipo, seguimiento:seguimiento}, function(data){
                            // alert(data);
                            console.log(data);
                            location.reload();
                        });
                    },
                    cancel: function(){}
                    });
                } else {
                    alert("El seguimiento debe contener mínimo 10 caracteres!!!");
                }
            }
            function guardar_observaciones(tipo){
                $.confirm({title: 'Confirmación!', content: 'Después de guardar la observación no se podrá cambiar. ¿Desea guardar la observación actual?', 
                confirm: function(){
                    id_inconsistencia = document.getElementById('ID_Inconsistencia_Marca').value;
                    observaciones = document.getElementById('observaciones_banco').value;
                    console.log(observaciones);
                    $.post("index.php?ctl=asistencia_guardar_justificacion_inconsistencia", { id_inconsistencia: id_inconsistencia, tipo: tipo, observaciones:observaciones}, function(data){
                        // alert(data);
                        console.log(data);
                        //location.reload();
                    });
                },
                cancel: function(){}
                });
            }
            function cambiar_estado(tipo){
                $.confirm({title: 'Confirmación!', content: 'Después de cambiar el estado a la justificación no se podrá cambiar el estado, el tipo ni agregar observaciones. ¿Desea continuar con el cambio?', 
                confirm: function(){
                    id_inconsistencia = document.getElementById('ID_Inconsistencia_Marca').value;
                    estado_inconsistencia= document.getElementById('estado_inconsistencia').value;
                    $.post("index.php?ctl=asistencia_guardar_justificacion_inconsistencia", { id_inconsistencia: id_inconsistencia, tipo: tipo, estado_inconsistencia:estado_inconsistencia}, function(data){
                        // alert(data);
                        console.log(data);
                        location.reload();
                    });
                },
                cancel: function(){ location.reload(); }
                });
            }
            function cambiar_tipo(tipo){
                id_inconsistencia = document.getElementById('ID_Inconsistencia_Marca').value;
                tipo_inconsistencia = document.getElementById('tipo_inconsistencia').value;
                $.post("index.php?ctl=asistencia_guardar_justificacion_inconsistencia", { id_inconsistencia: id_inconsistencia, tipo: tipo, tipo_inconsistencia:tipo_inconsistencia}, function(data){
                    // alert(data);
                    console.log(data);
                    //location.reload();
                });
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class="row">
            <div class="col-sm-1 sidenav"></div>
            
            <div class="col-sm-10 container">
                <h2>Justificar inconsistencia</h2>
                <p></p>
                <!--<form class="form-horizontal" id="guardar_inconsistencia" role="form" method="POST" action="index.php?ctl=asistencia_guardar_justificacion_inconsistencia">-->
                    <div id="informacion_general" class="row espacio-abajo">
                        <input type="text" hidden id="ID_Inconsistencia_Marca" name="ID_Inconsistencia_Marca" value="<?php echo $inconsistencia[0]['ID_Inconsistencia_Marca']?>">
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
                            <textarea type="text" maxlength="500" disabled onblur="guardar_justificacion('Justificacion_Usuario');" class="form-control" id="justificacion" name="justificacion" placeholder="La justificación permite un mínimo de 10 caracteres y un máximo de 500 caracteres"><?php echo $inconsistencia[0]['Justificacion_Usuario']?></textarea>
                        </div>
                        <div class="col-sm-4">
                            <label for="nombre_usuario">Nombre usuario</label>
                            <input type="text" readonly class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?php echo $inconsistencia[0]['Nombre']." ".$inconsistencia[0]['Apellido']?>">
                        </div>
                    </div>
                    <div id="encargado_empresa" hidden class="row espacio-abajo">
                        <div class="col-sm-8">
                            <label for="seguimiento_empresa">Seguimiento empresa</label>
                            <textarea type="text" disabled onblur="guardar_seguimiento('Seguimiento_Empresa');" class="form-control" id="seguimiento_empresa" name="seguimiento_empresa" placeholder="El seguimiento del coordinar empresa permite un máximo de 500 caracteres"><?php echo $inconsistencia[0]['Seguimiento_Empresa']?></textarea>
                        </div>
                        <div class="col-sm-4">
                            <label for="coordinador_empresa">Coordinador empresa</label>
                            <input type="text" disabled class="form-control" id="coordinador_empresa" name="coordinador_empresa" value="<?php echo $inconsistencia[0]['Usuario_Empresa']?>">
                        </div>
                    </div>
                    <div id="encargado_banco" hidden class="row espacio-abajo">
                        <div class="col-sm-8">
                            <label for="observaciones_banco">Observaciones</label>
                            <textarea type="text" disabled onblur="guardar_observaciones('Observaciones_Banco');" class="form-control" id="observaciones_banco" name="observaciones_banco" placeholder="Estas observaciones no son necesarias, cambiar el estado Sí"><?php echo $inconsistencia[0]['Observaciones_Banco']?></textarea>
                        </div>
                        <div class="col-sm-4">
                            <label for="coordinador_banco">Coordinador Banco</label>
                            <input type="text" disabled class="form-control" id="coordinador_banco" name="coordinador_banco" value="<?php echo $inconsistencia[0]['Usuario_Banco']?>">
                        </div>
                    </div>
                    <div id="informacion_general_2" class="row espacio-abajo">
                        <div class="col-sm-6">
                            <label for="estado_inconsistencia">Estado de la inconsistencia</label>
                            <select class="form-control" onchange="cambiar_estado('Cambiar_Estado');" disabled id="estado_inconsistencia" name="estado_inconsistencia">
                                <option value="<?php echo $inconsistencia[0]['ID_Estado_Inconsistencia']?>"><?php echo $inconsistencia[0]['Estado_Inconsistencia']?></option>
                                <option value="5">Justificación valida</option>
                                <option value="6">Justificación invalida</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="tipo_inconsistencia">Tipo de inconsistencia</label>
                            <select class="form-control" onchange="cambiar_tipo('Cambiar_Tipo');" disabled id="tipo_inconsistencia" name="tipo_inconsistencia">
                                <option value="<?php echo $inconsistencia[0]['ID_Tipo_Inconsistencia']?>"><?php echo $inconsistencia[0]['Tipo_Inconsistencia']?></option>
                                <option value="7">Vacaciones</option>
                                <option value="8">Incapacidad</option>
                                <option value="10">Permiso Especial</option>
                            </select>
                        </div>
                    </div>
<!--                    <button><a id="submit">Guardar</a></button>
                </form>-->
                
            </div>
            
            <div class="col-sm-1 sidenav"></div>
        </section>
        <?php require_once 'pie_de_pagina.php' ?>

    
    </body>
</html>
