<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Puestos de Monitoreo</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
 <script>
            //Funcion para ocultar ventana de mantenimiento de proveedor
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_1').style.display = "none";
            }
            //Valida informacion completa de formulario de proveedor
            function check_empty() {
                if (document.getElementById('nombre').value =="") {
                    alert("Digita el nombre del Puesto de Monitoreo!");
                } else {
                    if (isNaN(document.getElementById('tiempo_estandar_revision').value)) {
                        alert("Digita un valor númerico para el tiempo estándar del puesto de monitoreo!");
                    }  else{ 
                        document.getElementById('ventana').submit();
                        document.getElementById('ventana_oculta_1').style.display = "none";
                    }
                }
            }
            //Funcion para agregar un nuevo tipo de telefono- formulario en blanco
            function mostrar_agregar_puesto_monitoreo() {
                document.getElementById('ID_Puesto_Monitoreo').value="0";
                document.getElementById('nombre').value=null;
                document.getElementById('descripcion').value=null;
                document.getElementById('observaciones').value=null;
                document.getElementById('ventana_oculta_1').style.display = "block";
            }
            //Funcion para editar informacion de tipo telefono
            function Editar_Puesto_Monitoreo(id_puest,nomb,descrip,obser,tiempo){
                document.getElementById('ID_Puesto_Monitoreo').value=id_puest;
                document.getElementById('nombre').value=nomb;
                document.getElementById('descripcion').value=descrip;
                document.getElementById('observaciones').value=obser;
                document.getElementById('tiempo_estandar_revision').value=tiempo;
                document.getElementById('ventana_oculta_1').style.display = "block";
            };
        </script>
        
         </head>
         <body>
   <?php require_once 'encabezado.php';?>
        
        <div class="container">
        <h2>Listado General de Puestos de Monitoreo (Control de Video)</h2>
        <p>A continuación se detallan los diferentes puestos de monitoreo registrados en el sistema:</p>            
        <table id="tabla" class="display" cellspacing="0">
          <thead>
            <tr>
              <th hidden="hidden">ID_Puesto_Monitoreo</th>
              <th style="text-align:center">Nombre</th>
              <th style="text-align:center">Descripción</th>
              <th style="text-align:center">Observaciones</th>
              <th style="text-align:center">Tiempo Estándar Revisión (Segundos)</th>
              <th style="text-align:center">Total de Unidades</th>
              <th style="text-align:center">Total Cámaras</th>
              <th style="text-align:center">Total Minutos</th>
              <th style="text-align:center">Estado</th>
              <th style="text-align:center">Cambiar Estado</th>
              <th style="text-align:center">Mantenimiento</th>
              <th style="text-align:center">Control de Video</th>
            </tr>
          </thead>
    <tbody>
            <?php 
            $tam=count($params);  
            for ($i = 0; $i <$tam; $i++) {
            ?>
            <tr>
                <td hidden="hidden"><?php echo $params[$i]['ID_Puesto_Monitoreo'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Nombre'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Descripcion'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Observaciones'];?></td>
                <td style="text-align:center"><?php echo $params[$i]['Tiempo_Estandar_Revision'];?></td>
                <td style="text-align:center"><?php echo $vector_estadisticas[$i]['Total_Unidades'];?></td>
                <td style="text-align:center"><?php echo $vector_estadisticas[$i]['Total_Camaras'];?></td>
                <td style="text-align:center"><?php echo $vector_estadisticas[$i]['Total_Minutos'];?></td>
                <?php if ($params[$i]['Estado']==1){?>  
                    <td style="text-align:center">Activo</td>
                <?php }else {?>  
                    <td style="text-align:center">Inactivo</td>
                <?php }?>
                  <td style="text-align:center"><a href="index.php?ctl=puesto_monitoreo_cambiar_estado&id=<?php echo $params[$i]['ID_Puesto_Monitoreo']?>&estado=<?php echo $params[$i]['Estado']?>">
                    Activar/Desactivar</a></td>
                
             <td style="text-align:center"><a role="button" onclick="Editar_Puesto_Monitoreo('<?php echo $params[$i]['ID_Puesto_Monitoreo'];?>','<?php echo $params [$i]['Nombre'];?>',
             '<?php echo $params [$i]['Descripcion'];?>','<?php echo $params [$i]['Observaciones'];?>','<?php echo $params [$i]['Tiempo_Estandar_Revision'];?>')">Editar</a></td>
                    
            <td style="text-align:center"><a href="index.php?ctl=puestos_de_monitoreo_editar&id=<?php echo $params[$i]['ID_Puesto_Monitoreo']?>&tiempo_revision=<?php echo $params[$i]['Tiempo_Estandar_Revision']?>&nombre=<?php echo $params[$i]['Nombre']?>">
                   Lista de Unidades</a></td>
            </tr>     
            <?php } ?>
            </tbody>
        </table>
        <a id="popup" onclick="mostrar_agregar_puesto_monitoreo()" class="btn btn-default" role="button">Agregar Nuevo Puesto de Monitoreo</a>
        </div>
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        
       <!--agregar o editar-->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <!--Formulario para proveedor de enlaces de telecomunicaciones-->
                <form id="ventana" method="POST" name="form" action="index.php?ctl=puesto_monitoreo_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Puesto de Montoreo</h2>
                    <hr>
                    
                    <input hidden id="ID_Puesto_Monitoreo" name="ID_Puesto_Monitoreo" type="text">
                    
                    <label for="nombre">Nombre</label>
                    <input class="form-control espacio-abajo" required id="nombre" name="nombre" placeholder="Nombre" type="text">
                    
                    <label for="descripcion">Descripción</label>
                    <input class="form-control espacio-abajo" required id="descripcion" name="descripcion" placeholder="Descripción" type="text">
                    
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones del Puesto">
                    
                    <label for="tiempo_estandar_revision">Tiempo Estándar Revisión (Unidad Segundos)</label>
                    <input class="form-control espacio-abajo" required id="tiempo_estandar_revision" name="tiempo_estandar_revision" placeholder="Tiempo Estándar en Segundos" type="text">
                   
                   
                   <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                </form>
            </div>
        <!--Cierre agregar teléfono a Punto BCR-->
        </div>
    </body>
</html>
