<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión Botones Nuevos</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_cencon.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
        <script>  
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
            function buscar_persona(){
                document.getElementById('ventana_oculta_2').style.display= "block";
            }
            function agregar_persona(id,nom){
                document.getElementById('id_persona').value=id;
                document.getElementById('usuario').value= nom;
                document.getElementById('ventana_oculta_2').style.display = "none";
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <section class="container">
            <div class="container">
                <div class="col-sm-5"> 
                    <h2>Gestión de Botones Nuevos</h2>
                    <p>Informacion general del boton a incorporar:</p>
                </div>
            </div> 
            <br> 
            <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=botones_guardar">
                <input hidden id="id_boton" name="id_boton" type="text">

                <div class="container">
                    <div class="col-sm-4">
                        <label for="id_puntobcr">Punto BCR<a id="popup" onclick="...()" class="btn azul" role="button">(Código)</a></label>   
                        <input type="text" readonly="readonly" class="form-control" id="id_puntobcr" name="id_puntobcr" value="<?php echo $params[0]['ID_PuntoBCR'];?>">
                    </div>
                    <div class="col-sm-4">
                        <label for="usuario">Funcionario BCR<a id="popup" onclick="buscar_persona()" class="btn azul" role="button">Agregar Persona</a></label>
                        <input hidden type="text" id="id_persona" name="id_persona" value="<?php echo $nombre[0]['ID_Persona'];?>">
                        <input type="text" readonly="readonly" onfocus="buscar_persona()" class="form-control" id="usuario" name="usuario">
                    </div>
                    <div class="col-sm-4">
                        <label for="tipo_panel">Tipo de Panel<a id="popup" onclick="...()" class="btn azul" role="button">(Alarma)</a></label>
                        <input type="text" readonly="readonly" class="form-control" id="tipo_panel" name="tipo_panel" value="<?php echo $params[0]['Tipo_Panel'];?>">
                    </div>
                </div>
                <br>
                <div class="container">
                    <div class="col-sm-4">
                        <label for="numero_zona">Numero de Zona</label>
                        <input type="text" class="form-control" id="numero_zona" name="numero_zona" placeholder="Digite el numero de zona"> 
                    </div>
                    <div class="col-sm-4">
                        <label for="tipo_respuesta">Tipo de Respuesta</label>
                        <select class="form-control" id="tipo_respuesta" name="tipo_respuesta">  
                            <option value="6 24 hour silent" selected='true'>6 24 hour silent</option>
                            <!--                        <option value="disabled">0 disabled</option>
                                    <option value="entri/exit 1">1 entri/exit 1</option>
                                    <option value="entri/exit 2">2 entri/exit 2</option>
                                    <option value="perimeter">3 perimeter</option>
                                    <option value="interior follower">4 interior follwer</option>
                                    <option value="trouble day/alarma night">5 trouble day/alarma night</option>
                                    <option value="hour audible">7 hour audible</option>
                                    <option value="hour auxiliar ">8 hour auxiliar</option>
                                    <option value="fire">9 fire</option>
                                    <option value="interior">10 interior</option>
                                    <option value="Arming stay">20 Arming stay</option>
                                    <option value="Arming Away">21 Arming Away</option>
                                    <option value="disarming">22 disarming</option>
                                    <option value="no arming">23 no arming</option>-->
                        </select>
                    </div>
                    <div class="container">
                        <div class="col-sm-4">
                            <label for="tipo_entrada">Tipo de Entrada</label>
                            <select class="form-control" id="tipo_entrada" name="tipo_entrada">  
                                <option value="rf botton type" selected='true'>rf botton type</option>
                                <!--                        <option value="no used">no used</option>
                                    <option value="hardwired">hardwired</option>
                                    <option value="superviset rf">superviset rf</option>
                                    <option value="unsuperviset rf">unsuperviset rf</option>-->
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-4">
                        <label for="numero_serie">Numero de Serie</label>
                        <input type="text" class="form-control espacio-abajo" id="numero_serie" name="numero_serie" placeholder="Serie del Dispositivo"> 
                    </div>
                    <div class="col-sm-4">
                        <label for="observaciones">Observaciones</label>
                        <input type="text" class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones">       
                    </div>
                    <div class="col-sm-4">
                        <label for="sel1">Estado</label>
                        <select class="form-control" id="estado" name="estado">  
                            <option value="1" selected='true'>Activo</option>
                            <option value="0">Inactivo</option>
                        </select>     
                    </div>
                </div>
                <div class="container">
                    <div class="col-sm-4">    
                        <button type="submit" class="btn btn-default">Guardar</button>
                        <a href="index.php?ctl=botones_listar" class="btn btn-default" role="button">Cancelar</a> 
                    </div>
                </div>
            </form> 
        </section>
        <!--Asignar Persona-->
        <div id="ventana_oculta_2">
            <div id="popupventana2">
                <div id="ventana2">
                <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Personal-->
                    <h3 class="bordegris text-center">Seleccione el Funcionario</h3>
                    <table id="tabla" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">ID</th>
                                <th style="text-align:center">Cedula</th>
                                <th style="text-align:center">Nombre</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($nombre);
                            for ($i = 0; $i <$tam; $i++) { ?>  
                                <tr>
                                    <td style="text-align:center"><?php echo $nombre[$i]['ID_Persona'];?></td>
                                    <td style="text-align:center"><?php echo $nombre[$i]['Cedula'];?></td>
                                    <td style="text-align:center"><?php echo $nombre[$i]['Apellido_Nombre'];?></td>
                                    <td style="text-align:center"><a class="btn" role="button" onclick="agregar_persona(<?php echo $nombre[$i]['ID_Persona'];?>,
                                    '<?php echo $nombre[$i]['Apellido_Nombre'];?>');">
                                    Seleccionar</a></td>
                                </tr>
                            <?php } ?>
                         </tbody>
                    </table>
                </div>
            </div>
            <!--Cierre Asignar Personal Externo a Empresa-->
        </div>         

        <?php require_once 'pie_de_pagina.php' ?>
        
    </body>
</html>
