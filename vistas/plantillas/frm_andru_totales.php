<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Fases</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>
            //Funcion para ocultar ventana de mantenimiento
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            //Valida informacion completa de formulario
            function check_empty() {
                if (document.getElementById('Descripcion').value =="") {
                    alert("Digita el nombre del Proveedor !");
                } else {
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana2').submit();
                    document.getElementById('ventana_oculta_2').style.display = "none";
                }
            }
            //Funcion para agregar un nuevo punto- formulario en blanco
            function mostrar_agregar_andru_fases() {
                document.getElementById('ID_Fase').value="0";
                document.getElementById('Descripcion').value=null;
                document.getElementById('Estado').value=1;
                document.getElementById('ventana_oculta_2').style.display = "block";
            }
        //Funcion para editar informacion de andru_fases
            function Editar_andru_fases(pID_Fase,pDescripcion,pEstado){
                document.getElementById('ID_Fase').value=pID_Fase;
                document.getElementById('Descripcion').value=pDescripcion;
                document.getElementById('Estado').value=pEstado;
                document.getElementById('ventana_oculta_2').style.display = "block";
            };
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <h2>Listado General de Cálculo de Cuestionarios Andru</h2>
            <p>A continuación se detallan los registros del sistema:</p>
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID_Cuestionario</th>
                        
                        <th style="text-align:center">Punto BCR</th>
                        <?php $tam=count($andru_tipos); for ($i = 0; $i <$tam; $i++) { ?>
                        <th style="text-align:center"><?php echo $andru_tipos[$i]['Descripcion'];?></th>
                        <?php } ?>                        
                        <th style="text-align:center">Cant. Preguntas</th>
                        <th style="text-align:center">Cant. Respuestas</th>
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($andru_cuestionario); for ($i = 0; $i <$tam; $i++) { ?>
                <?php if($tipoporcentaje == $andru_cuestionario[$i]['ID_Tipo_Porcentaje'] ) { ?>
                <tr>
                        <td  hidden style="text-align:center"><?php echo $andru_cuestionario[$i]['ID_Cuestionario'];?></td>                        
                        <td><?php echo $andru_cuestionario[$i]['Nombre'];?></td>
                        <?php $tam2=count($andru_tipos); for ($i2 = 0; $i2 <$tam2; $i2++) { ?>
                        <?php $tam3=count($andru_cuestionario); for ($i3 = 0; $i3 <$tam3; $i3++) { ?>
                        <?php if(($andru_cuestionario[$i3]['ID_Tipo_Porcentaje']==$andru_tipos[$i2]['ID_Tipo_Porcentaje'])&&($andru_cuestionario[$i]['ID_Cuestionario']==$andru_cuestionario[$i3]['ID_Cuestionario'])) { ?>
                        <td style="<?php if(($andru_cuestionario[$i3]['Promedio'] <= 3.00)&&($andru_cuestionario[$i3]['Promedio'] > 2)){ echo 'background-color: #ffb366';}?>
                            <?php if($andru_cuestionario[$i3]['Promedio'] > 3.00){ echo 'background-color:  #ff6666';}?>
                            <?php if($andru_cuestionario[$i3]['Promedio'] < 2.00){ echo 'background-color: #b7f2b5';}?>
                            ;text-align:center" 
                            ><?php echo $andru_cuestionario[$i3]['Promedio'];?></td>
                        <?php } } } ?>
                        <td style="text-align:center"><?php echo $andru_cuestionario[$i]['TotalPreguntas'];?></td>
                        <td style="text-align:center"><?php echo $andru_cuestionario[$i]['TotalRespuestas'];?></td>                        
                    </tr>
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
            
            <br>
                <br>
                <br>
                <h4>Simbología de colores</h4>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align:center">Color</th>
                                <th style="text-align:center">Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align:center;background-color: #ff6666">
                                <td>Rojo</td>
                                <td>Grado Crítico. Promedio mayor a 3</td>
                            </tr>
                            <tr style="text-align:center;background-color: #ffb366">
                                <td>Naranja</td>
                                <td>Grado Medio. Promedio entre 2 y 3</td>
                            </tr>
                            <tr style="text-align:center;background-color: #b7f2b5">
                                <td>Verde</td>
                                <td>Grado Normal. Promedio menor a 2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        <!--agregar o editar andru_fases-->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
            <!--Formulario para andru_fases-->
                    <form id="ventana2" method="POST" name="ventana2" action="index.php?ctl=andru_fases_guardar">
                        <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                        <h2>Matenimiento de Fases de Andru</h2> <hr>
                        <input hidden id="ID_Fase" name="ID_Fase" type="text">

                        <div class="form-group">
                            <label for="Descripcion">Descripción</label>
                            <input class="form-control espacio-abajo" required id="Descripcion" name="Descripcion" placeholder="Descripción" type="text">
                        </div>

                        <div class="form-group">
                            <label for="sel1">Estado</label>
                            <select class="form-control" id="Estado" name="Estado"> 
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="row"></div>
                        <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                    </form>
                </div>
            </div>
        <!--Cierre agregar o editar andru_fases-->
    </body>
</html>