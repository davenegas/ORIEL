<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Direcciones IP</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_direcciones_ip.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>

        <script>
            //Funcion para ocultar ventana de mantenimiento de proveedor
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_1').style.display = "none";
            }
            //Valida informacion completa de formulario de proveedor
            function check_empty() {
                if (document.getElementById('numero').value =="") {
                    alert("Digita el nombre del Proveedor !");
                } else {
                    //alert("Form Submitted Successfully...");
                    //Envia el formulario y lo oculta
                    document.getElementById('ventana').submit();
                    document.getElementById('ventana_oculta_1').style.display = "none";
                }
            }
            //Funcion para agregar un nuevo tipo ip- formulario en blanco
            function mostrar_agregar_ip() {
                document.getElementById('ID_Direccion_IP').value="0";
                document.getElementById('nombre').value=null;
                document.getElementById('numero').value=null;
                document.getElementById('observaciones').value=null;
                document.getElementById('ventana_oculta_1').style.display = "block";
            }
            //Funcion para editar informacion de tipo ip
            function edita_ip(id_ip,nombre,num,obser){
                document.getElementById('ID_Direccion_IP').value=id_ip;
                $("#nombre option[value="+nombre+"]").attr("selected",true);
                document.getElementById('numero').value=num;
                document.getElementById('observaciones').value=obser;
                document.getElementById('ventana_oculta_1').style.display = "block";
            };
        </script>
        
    </head>
    <body>
        <?php require_once 'encabezado.php'; ?>

        <div class="container">
            <h2>Listado General de Direcciones IP</h2>
            <p>A continuación se detallan las diferentes Direcciones IP que están registrados en el sistema:</p> 
            <!--<pre>
            <?php print_r($params); ?>
            </pre>-->
            <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align:center" >Tipo de Direccion IP</th>
                        <th style="text-align:center" >Direccion IP</th>
                        <th style="text-align:center" >Observaciones</th>
                        <th style="text-align:center" >Editar Direccion IP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tam = count($params);
                    for ($i = 0; $i < $tam; $i++) {
                        ?>
                        <tr>
                            
                            <td style="text-align:center"><?php echo $params[$i]['Tipo_IP']; ?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Direccion_IP']; ?></td>
                            <td style="text-align:center"><?php echo $params[$i]['Observaciones']; ?></td> 

                            <td><a role="button" onclick="edita_ip('<?php echo $params[$i]['ID_Direccion_IP'];?>','<?php echo $params [$i]['ID_Tipo_IP'];?>',
                           '<?php echo $params [$i]['Direccion_IP'];?>','<?php echo $params [$i]['Observaciones'];?>')">
                    
                    Editar</a></td>
                    
                        </tr>     

                    <?php }
                    ?>
                </tbody>
            </table>

            <a id="popup" onclick="mostrar_agregar_ip()" class="btn btn-default" role="button">Agregar IP</a>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php'?>

        <!--agregar o editar-->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <!--Formulario para direccionamiento de las ip-->
                 <form id="ventana" method="POST" name="form" action="index.php?ctl=direcciones_ip_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Direccionamiento IP</h2>
                    <hr>
                    
                    <input hidden id="ID_Direccion_IP" name="ID_Direccion_IP" type="text">
                    
                    <div class="form-group">
                        
                    <label for="nombre">Tipo de dirección IP</label>
                    
                            <select class="form-control" id="nombre" name="nombre"> 
                            <?php
                            $tam = count($tipo_IP);
                            for($i=0; $i<$tam;$i++)
                            {  ?>
                            <option value="<?php echo $tipo_IP[$i]['ID_Tipo_IP']?>"><?php echo $tipo_IP[$i]['Tipo_IP']?></option>   
                            <?php }  ?>
                            </select>
         
                    <label for="numero">Direccion IP</label>
                    <input class="form-control espacio-abajo" required id="numero" name="numero" placeholder="Direccion IP del Equipo" type="text">
                   
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones de la IP">                
                    </div>
                   <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                </form>
            
            </div>      
            </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>