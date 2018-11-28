   <!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Cuestionario</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <script>
            var arrayChkPts = [];            
            //Funcion para ocultar ventana de mantenimiento
            
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            //Funcion para agregar un nuevo punto- formulario en blanco
            function mostrar_copiar_respuesta() {                
                document.getElementById('ventana_oculta_2').style.display = "block";
            }
            function checkPtsBcr(chkPtBcr){
                var v_existe = false;
                console.log(chkPtBcr.checked);
                for (var i = arrayChkPts.length; i--; ) {                    
                    if (arrayChkPts[i] == chkPtBcr.value) {
                        if (chkPtBcr.checked == false){
                            arrayChkPts.splice(i, 1);
                        }
                        v_existe = true;
                    }
                }
                if (v_existe == false) {                    
                    arrayChkPts.push(chkPtBcr.value);
                }
               document.getElementById('lstPts').value = arrayChkPts.join(',');                
            }
         </script>
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
            <div class="col-sm-3">
            <a href="index.php?ctl=andru_cuestionario&idcues=0&idpunto=0&idfase=0" class="btn btn-default" role="button">Agregar Cuestionario</a>
            </div>
            <div class="col-sm-3">
            <a id="popup" onclick="mostrar_copiar_respuesta()" class="btn btn-default" role="button">Copiar Respuestas</a>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        <!--agregar o editar andru_categoria-->        
        <div id="ventana_oculta_2">
            <div id="popupventana2">
                <!--Formulario para andru_categoria-->
                <form id="ventana2" method="POST" name="ventana2" action="index.php?ctl=andru_cuestionario_copiar">                        
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h4>Copiar respuestas en otros Puntos BCR</h4><hr>
                    <input hidden required disabled id="lstPts" name="lstPts" type="text" value="">                    
                    <div class="col-sm-6">
                        <label for="ID_PtsBcr">Seleccione el Punto BCR con las respuestas</label>
                        <select class="form-control" id="ID_PtsBcr" name="ID_PtsBcr">
                            <?php $tam=count($andru_cuestionario); for ($i = 0; $i <$tam; $i++) { ?>
                            for($i=0; $i<$tam;$i++){  ?>
                            <option  value="<?php echo $andru_cuestionario[$i]['ID_PuntoBCR'];?>"><?php echo $andru_cuestionario[$i]['Nombre'];?></option>
                            <?php }  ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="ID_FaseBcr">Fase</label>
                        <select class="form-control" id="ID_FaseBcr" name="ID_FaseBcr">
                            <?php $tam=count($andru_fases); for ($i = 0; $i <$tam; $i++) { ?>
                            for($i=0; $i<$tam;$i++){  ?>
                            <option <?php if($andru_fases[$i]['ID_Fase'] == 5){echo 'selected';} ?> value="<?php echo $andru_fases[$i]['ID_Fase'];?>"><?php echo $andru_fases[$i]['Descripcion'];?></option>
                            <?php }  ?>
                        </select>
                    </div>  
                    <div class="col-sm-12">
                        <br>
                        <label for="tabla2">Seleccione los puntos a pegar las respuestas</label>
                        <table id="tabla2" class="display" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align:j ñ{}
                                        center">Oficina</th>
                                    <th style="text-align:center">Selección</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $tam=count($andru_cuestionario); for ($i = 0; $i <$tam; $i++) { ?>
                                <tr>                                    
                                    <td><?php echo $andru_cuestionario[$i]['Nombre'];?></td>
                                    <td style="text-align:center">
                                        <label><input name="<?php echo 'chk'.$andru_cuestionario[$i]['ID_PuntoBCR'];?>" onchange="checkPtsBcr(this)" id="<?php echo 'chk'.$andru_cuestionario[$i]['ID_PuntoBCR'];?>" type="checkbox" value="<?php echo $andru_cuestionario[$i]['ID_PuntoBCR'];?>"></label>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row"></div>
                    <button><a href="javascript:%20check_empty()" id="submit">Guardar Cambios</a></button>
                </form>
            </div>
        </div>
        <!--Cierre agregar o editar andru_categoria-->
    </body>
</html>
