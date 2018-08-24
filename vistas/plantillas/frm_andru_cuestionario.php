<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de andru_cuestionario</title>
        <?php require_once 'frm_librerias_head.html'; ?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"><script>
            //arreglo que controla las respuestas
            var arrayIdRespuestas = [];
            var arrayRespuestas = [];

            $(document).ready(function () {
                arrayIdRespuestas =<?php
        if (isset($id_preguntasvec)) {
            echo json_encode($id_preguntasvec);
        } else {
            echo 'new Array();';
        }
        ?>;
                arrayRespuestas =<?php
        if (isset($id_respuestasvec)) {
            echo json_encode($id_respuestasvec);
        } else {
            echo 'new Array();';
        }
        ?>;
                cargartxtRespuestas();
            });
            function buscarRespuesta(idItem, desItem) {
                var v_existe = false;
                console.log(idItem);
                for (var i = arrayRespuestas.length; i--; ) {
                    if (arrayIdRespuestas[i] == idItem) {
                        if (desItem == "-1") {
                            arrayIdRespuestas.splice(i, 1);
                            arrayRespuestas.splice(i, 1);
                        } else {
                            arrayRespuestas[i] = desItem;
                        }
                        v_existe = true;
                    }
                }
                if (v_existe == false) {
                    arrayIdRespuestas.push(idItem);
                    arrayRespuestas.push(desItem);
                }
                cargartxtRespuestas();
            }
            function cargartxtRespuestas() {
                document.getElementById('UsuarioPreguntas').value = arrayIdRespuestas.join(',');
                document.getElementById('UsuarioRespuestas').value = arrayRespuestas.join(',');
                //document.getElementById('idpre').innerHTML=arrayIdRespuestas.length;
                document.getElementById('idres').innerHTML = arrayRespuestas.length;
            }
            function buscar_oficina() {
                document.getElementById('ventana_oculta_3').style.display = "block";
            }
            function ocultar_oficina() {
                document.getElementById('ventana_oculta_3').style.display = "none";
            }
            function buscar_fase() {
                document.getElementById('ventana_oculta_2').style.display = "block";
            }
            function ocultar_fase() {
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            function selecc_fase(id) {
                document.getElementById('ID_Fase').value = id;
                ocultar_fase();
                redireccionar();
            }
            function selecc_oficina(id) {
                document.getElementById('ID_PuntoBCR').value = id;
                ocultar_oficina();
                redireccionar();
            }
            function redireccionar() {
                var v_idcuestionario = document.getElementById('ID_Cuestionario').value;
                var v_idpunto = document.getElementById('ID_PuntoBCR').value;
                var v_idfase = document.getElementById('ID_Fase').value;
                window.location.replace("http://localhost/ORIEL/index.php?ctl=andru_cuestionario&idcues=" + v_idcuestionario + "&idpunto=" + v_idpunto + "&idfase=" + v_idfase);
            }
            function recalcular(idpregunta) {
                var v_cantitipoporcentaje = document.getElementById('canttipoporcentaje').value;
                var v_respuesta = document.getElementById('idrespuesta' + idpregunta);
                var v_idrespuesta = v_respuesta.options[v_respuesta.selectedIndex].value;
                var v_nivel = v_respuesta.options[v_respuesta.selectedIndex].dataset.nivel;
                for (var i = 1; i <= v_cantitipoporcentaje; i++) {
                    var v_pocentaje = document.getElementById('porcentaje' + idpregunta + 'p' + i).innerHTML;
                    document.getElementById('pregunta' + idpregunta + 'p' + i).innerHTML = parseFloat((v_pocentaje * v_nivel) / 100).toFixed(2);
                }
                buscarRespuesta(idpregunta, v_idrespuesta);
            }
            //Valida informacion completa de formulario
            function check_empty() {
                var v_cantpreguntas = document.getElementById('cantpreguntas').value;
                var v_texto = "";
                if (arrayIdRespuestas.length <= v_cantpreguntas) {
                    if (arrayIdRespuestas.length < v_cantpreguntas) {
                        v_texto = 'Ha decidido contestar ' + arrayIdRespuestas.length + ' preguntas de ' + v_cantpreguntas + '. ¿Desea guardarlo?';
                    }
                    if (arrayIdRespuestas.length == v_cantpreguntas) {
                        v_texto = '¿Seguro(a) que desea guardar las respuestas?';
                    }
                    $.confirm({title: 'Confirmación!', content: v_texto,
                        confirm: function () {
                            vid_cuestionario = document.getElementById('ID_Cuestionario').value;
                            vid_punto = document.getElementById('ID_PuntoBCR').value;
                            vid_fase = document.getElementById('ID_Fase').value;
                            vid_preguntas = document.getElementById('UsuarioPreguntas').value;
                            vid_respuestas = document.getElementById('UsuarioRespuestas').value;
                            $.post("index.php?ctl=andru_cuestionario_guardar", {ID_Cuestionario: vid_cuestionario, ID_PuntoBCR: vid_punto, ID_Fase: vid_fase, id_preguntas: vid_preguntas, id_respuestas: vid_respuestas}, function (data) {
                                console.log(data);
                                //location.reload();
                                //alert (data);
                            });
                        },
                        cancel: function () {
                            //$.alert('Canceled!')
                        }
                    });
                }
            }
            function totalPreguntas() {
                return arrayIdRespuestas.length;
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php'; ?>
        <div class="row">
            <nav class="col-sm-2">
                <ul class="nav nav-pills nav-stacked  pull-left" data-spy="affix" data-offset-top="205">
                    <li class="active"><a>Preguntas <span id="idpre" name="idpre"><?php echo count($preguntas); ?></span></a></li>
                    <li class="active"><a>Respuestas <span id="idres" name="idres">0</span></a></li>        
                </ul>
            </nav>
            <div class="col-sm-9"> 
                <h4><a onclick="buscar_oficina()">Oficina Seleccionada: <?php echo $nom_puntobcr; ?></a><a class="pull-right" onclick="buscar_fase()">Fase Seleccionada: <?php echo $nom_fase; ?></a></h4>
                <br>
                <!-- cuerpo -->
                <table id="tabla" class="display table-striped2" cellspacing="0">
                    <thead>
                        <tr>
                            <th hidden style="text-align:center">ID_Cuestionario</th>
                            <th style="text-align:center">Tipo</th>
                            <th style="text-align:center">Pregunta</th> 
                            <?php
                            $tam = count($tipos_porcentajes);
                            for ($i = 0; $i < $tam; $i++) {
                                ?>
                                <th style="text-align:center">%Asig. <?php echo $tipos_porcentajes[$i]['Descripcion']; ?></th>
                            <?php } ?>
                            <th style="text-align:center">Respuesta</th>
                            <?php
                            $tam = count($tipos_porcentajes);
                            for ($i = 0; $i < $tam; $i++) {
                                ?>
                                <th style="text-align:center">%Cal. <?php echo $tipos_porcentajes[$i]['Descripcion']; ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tam = count($preguntas);
                        for ($i = 0; $i < $tam; $i++) {
                            ?>
                            <tr>
                                <td  hidden style="text-align:center"><?php echo $preguntas[$i]['ID_Pregunta']; ?></td>                        
                                <td class="col-md-1"><?php echo $preguntas[$i]['Fase']; ?></td>
                                <td class="col-md-5"><?php echo $preguntas[$i]['Pregunta']; ?></td>
                                <?php
                                $tam4 = count($preguntasporcentaje);
                                for ($i4 = 0; $i4 < $tam4; $i4++) {
                                    if ($preguntas[$i]['ID_Pregunta'] == $preguntasporcentaje[$i4]['ID_Pregunta']) {
                                        ?>
                                        <td><h3><span id="<?php echo "porcentaje" . $preguntas[$i]['ID_Pregunta'] . "p" . $preguntasporcentaje[$i4]["ID_Tipo_Porcentaje"]; ?>" class="label label-defaul" style="color: gray;"><?php echo $preguntasporcentaje[$i4]['Valor']; ?></span></h3></td><?php
                                    }
                                }
                                ?><td>
                                    <select onchange="recalcular(<?php echo $preguntas[$i]['ID_Pregunta']; ?>)" class="form-control" id="idrespuesta<?php echo $preguntas[$i]['ID_Pregunta']; ?>" name="idrespuesta<?php echo $preguntas[$i]['ID_Pregunta']; ?>">
                                        <option  data-nivel="0" value="-1">Seleccione una opción</option>
                                        <?php
                                        $tam2 = count($respuestas);
                                        for ($i2 = 0; $i2 < $tam2; $i2++) {
                                            if ($preguntas[$i]['ID_Pregunta'] == $respuestas[$i2]['ID_Pregunta']) {
                                                ?>
                                                <option <?php
                                                if ($respuestas[$i2]["IdSelec"] > 0) {
                                                    echo 'Selected';
                                                }
                                                ?> data-nivel="<?php echo $respuestas[$i2]['Nivel']; ?>" value="<?php echo $respuestas[$i2]['ID_Respuesta']; ?>"><?php echo $respuestas[$i2]['Respuesta']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                    </select>
                                </td>
                                <?php
                                $tam3 = count($respuestasporcentaje);
                                for ($i3 = 0; $i3 < $tam3; $i3++) {
                                    if ($preguntas[$i]['ID_Pregunta'] == $respuestasporcentaje[$i3]['ID_Pregunta']) {
                                        ?>
                                        <td><h3><span id="<?php echo "pregunta" . $preguntas[$i]['ID_Pregunta'] . "p" . $respuestasporcentaje[$i3]["ID_Tipo_Porcentaje"]; ?>" class="label label-defaul" style="color: gray;"><?php echo $respuestasporcentaje[$i3]["Calculo"]; ?></span></h3></td>
                                        <?php
                                    }
                                }
                                ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <input hidden required disabled id="ID_Cuestionario" name="ID_Cuestionario" type="text" value="<?php echo $idcuestionario; ?>">
                <input hidden required disabled id="ID_PuntoBCR" name="ID_PuntoBCR" type="text" value="<?php echo $idpuntobcr; ?>">
                <input hidden required disabled id="ID_Fase" name="ID_Fase" type="text" value="<?php echo $idfase; ?>">
                <input hidden required disabled id="UsuarioPreguntas" name="UsuarioPreguntas" type="text" value="">
                <input hidden required disabled id="UsuarioRespuestas" name="UsuarioRespuestas" type="text" value="">
                <input hidden required disabled id="canttipoporcentaje" name="canttipoporcentaje" type="text" value="<?php echo count($tipos_porcentajes); ?>">
                <input hidden required disabled id="cantpreguntas" name="cantpreguntas" type="text" value="<?php echo count($preguntas); ?>">
                <button><a href="javascript:%20check_empty()" id="submit">Guardar y Calcular</a></button>
                <button><a href="index.php?ctl=andru_cuestionario_listar" id="submit">Regresar</a></button>
                <br>
                <br>
                <br>
                <h4>Promedios según tipo porcentaje</h4>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Porcentaje</th>
                                <th>Resultado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $tam4 = count($cuestionariopromedios);
                                for ($i4 = 0; $i4 < $tam4; $i4++) {
                                    ?>
                                <tr>
                                    <td><?php echo $cuestionariopromedios[$i4]["Descripcion"] ?></td>
                                    <td><?php echo $cuestionariopromedios[$i4]["Promedio"] ?></td>
                                </tr> <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?php require 'vistas/plantillas/pie_de_pagina.php'; ?>
        <!--Asignar Sucursal-->
        <div id="ventana_oculta_3">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_oficina()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla3" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">Código</th>
                                <th style="text-align:center">Nombre</th>                                
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tam = count($puntosbcr);
                            for ($i = 0; $i < $tam; $i++) {
                                ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $puntosbcr[$i]['Codigo']; ?></td>
                                    <td style="text-align:center"><?php echo $puntosbcr[$i]['Nombre']; ?></td>                                    
                                    <td style="text-align:center"><a class="btn" role="button" onclick="selecc_oficina(<?php echo $puntosbcr[$i]['ID_PuntoBCR']; ?>);">Seleccionar ATM</a></td>
                                </tr>                                
<?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>        
        </div>
        <!--Cierre Asignar Sucursal-->
        <!--Asignar Fase-->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
                <div id="ventana2">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_fase()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla2" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">Código</th>
                                <th style="text-align:center">Nombre</th>                                
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tam = count($fasesbcr);
                            for ($i = 0; $i < $tam; $i++) {
                                ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $fasesbcr[$i]['ID_Fase']; ?></td>
                                    <td style="text-align:center"><?php echo $fasesbcr[$i]['Descripcion']; ?></td>                                    
                                    <td style="text-align:center"><a class="btn" role="button" onclick="selecc_fase(<?php echo $fasesbcr[$i]['ID_Fase']; ?>);">Seleccionar Fase</a></td>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>        
        </div>
        <!--Cierre Asignar Fase-->
    </body>
</html>
