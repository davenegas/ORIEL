<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Puntos BCR</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_puntobcr.js"></script>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css">
        <?php require_once 'frm_librerias_head.html'; ?>
        

    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
        <header class="bordegris espacio-abajo">
            <h2>Gestión de Puntos BCR del Sistema
                <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?>
                <a href="index.php?ctl=gestion_punto_bcr&id=<?php echo $params[0]['ID_PuntoBCR']-1?>;"><img src='vistas/Imagenes/boton-antes.png' width="25"></a>
                <a href="index.php?ctl=gestion_punto_bcr&id=<?php echo $params[0]['ID_PuntoBCR']+1?>;"><img src='vistas/Imagenes/boton-siguiente.png' width="25"></a>
                <?php }?>
            </h2>
        </header>
<!--            <pre>
                <?php print_r($params)?>
            </pre>-->
            <div class="bordegris"> 
            <h3>Información General del Punto BCR
            <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?>
                <input class="quitar-float" type="checkbox" id="chk_informacion_general" name="chk_ubicacion">
            <?php }?>
            </h3>
            <div class="col-md-4">
              <label for="ID_PuntoBCR">ID Punto</label>
              <input type="text" required="ID_PuntoBCR" readonly class="form-control" id="ID_PuntoBCR" name="ID_PuntoBCR" value="<?php echo $params[0]['ID_PuntoBCR'];?>">
            </div>
            <div class="col-md-4">
              <label for="Codigo">Codigo</label>
              <input type="text" required="required" readonly class="form-control" id="Codigo" name="Codigo" value="<?php echo $params[0]['Codigo'];?>">
            </div>
            <div class="col-md-4">
              <label for="Cuenta_SIS">Cuenta SIS</label>
              <input type="text" required="required" readonly class="form-control" id="Cuenta_SIS" name="Cuenta_SIS" value="<?php echo $params[0]['Cuenta_SIS'];?>">
            </div>
            
            <div class="col-md-6 espacio-abajo">
              <label for="Nombre">Nombre</label>
              <input type="text" required="required" readonly class="form-control" id="Nombre" name="Nombre" value="<?php echo $params[0]['Nombre'];?>">
            </div>
            <div class="col-md-6 espacio-abajo">
                <label for="Tipo_Punto">Tipo de Punto</label>
                <select class="form-control" id="Tipo_Punto" disabled name="Tipo_Punto" > 
                <?php
                $tam = count($tipo_puntos);

                for($i=0; $i<$tam;$i++)
                {
                    if($tipo_puntos[$i]['ID_Tipo_Punto']==$params[0]['ID_Tipo_Punto']){
                        
                       ?> <option value="<?php echo $tipo_puntos[$i]['ID_Tipo_Punto']?>" selected="selected"><?php echo $tipo_puntos[$i]['Tipo_Punto']?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $tipo_puntos[$i]['ID_Tipo_Punto']?>" ><?php echo $tipo_puntos[$i]['Tipo_Punto']?></option>   
                <?php }}  ?>
                </select>
            </div>
                <div class="bordegris"  >
            <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?>
                <h3 class="quitar-float">Información de telefonos del Punto BCR <a id="popup" onclick="mostrar_agregar_telefono()" class="btn azul" role="button">Agregar número</a></h3> 
            <?php } else {?>
                <h3 class="quitar-float">Información de telefonos del Punto BCR</h3>
            <?php } ?>
            
            <table class="display col-md-12 table-striped quitar-float espacio-abajo" id="telefonos">
                <thead> 
                    <th style="text-align:center">Tipo de Teléfono</th>
                    <th style="text-align:center">Número teléfono</th>
                    <th style="text-align:center">Observaciones</th>
                    <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?>
                        <th style="text-align:center">Eliminar número</th>
                    <?php } ?>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($telefonos);
                    for ($i = 0; $i <$tam; $i++) {
                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo $telefonos[$i]['Tipo_Telefono'];?></td>
                        <td style="text-align:center"><?php echo $telefonos[$i]['Numero'];?></td>
                        <td style="text-align:center"><?php echo $telefonos[$i]['Observaciones'];?></td>
                        <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?>
                            <td style="text-align:center"><a class="btn rojo" role="button" id="prueba" name="prueba" onclick="eliminar_telefono(<?php echo $telefonos[$i]['ID_Telefono'];?>);">
                                Eliminar</a></td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody> 
            </table>
            </div>
            <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?>   
            <h3 class="quitar-float">Unidades Ejecutoras asociadas al PuntoBCR <a id="popup" onclick="mostrar_lista_ue()" class="btn azul" role="button">Agregar UE</a></h3> 
            <?php } else {?>
            <h3 class="quitar-float">Unidades Ejecutoras asociadas al PuntoBCR</h3>
            <?php } ?>
            <div>
            <table class="display col-md-12  table-striped quitar-float espacio-abajo" id="unidad_ejecutora">
                <thead> 
                    <th style="text-align:center">Numero UE</th>
                    <th style="text-align:center">Departamento</th>
                    <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?> 
                        <th style="text-align:center">Eliminar UE</th>
                     <?php } ?>    
                </thead>
                <tbody>
                    <?php 
                    $tam=count($unidad_ejecutora);
                    for ($i = 0; $i <$tam; $i++) {
                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo $unidad_ejecutora[$i]['Numero_UE'];?></td>
                        <td style="text-align:center"><?php echo $unidad_ejecutora[$i]['Departamento'];?></td>
                        <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?> 
                        <td style="text-align:center"><a class="btn rojo" role="button" id="prueba" name="prueba" onclick="eliminar_ue(<?php echo $unidad_ejecutora[$i]['ID_Unidad_Ejecutora'];?>);">
                                Eliminar</a></td>
                         <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody> 
            </table>
            </div> 
        </div>
            
        <div> 
            <header>
                <h3 class="espacio-arriba quitar-float">Ubicación
                <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?> 
                    <input class="quitar-float" type="checkbox" id="chk_ubicacion" name="chk_ubicacion">
                <?php } ?>
                </h3>
            </header>
            <div class="col-md-4">
                <label for="Provincia">Provincia</label>
                <select class="form-control" disabled id="Provincia" name="Provincia" > 
                <?php
                $tam = count($provincias);

                for($i=0; $i<$tam;$i++)
                {
                    if($provincias[$i]['ID_Provincia']==$cantones[$distritos[$params[0]['ID_Distrito']]['ID_Canton']]['ID_Provincia']){
                        
                        ?><option value="<?php echo $provincias[$i]['ID_Provincia']?>" selected="selected"><?php echo $provincias[$i]['Nombre_Provincia']?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $provincias[$i]['ID_Provincia']?>" ><?php echo $provincias[$i]['Nombre_Provincia']?></option>   
                <?php }}  ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="Canton">Cantón</label>
                <select class="form-control" disabled id="Canton" name="Canton" > 
                <?php
                $tam = count($cantones);
                
                for($i=0; $i<$tam;$i++)
                {
                    if($cantones[$i]['ID_Canton']==$distritos[$params[0]['ID_Distrito']]['ID_Canton']){
                       ?> <option value="<?php echo $cantones[$i]['ID_Canton']?>" selected="selected"><?php echo $cantones[$i]['Nombre_Canton']?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $cantones[$i]['ID_Canton']?>" ><?php echo $cantones[$i]['Nombre_Canton']?></option>   
                <?php }}  ?>
                </select>
            </div>
            
            <div class="col-md-4">
                <label for="Distrito">Distrito</label>
                <select class="form-control" disabled id="Distrito" name="Distrito" > 
                <?php
                $tam = count($distritos);
                for($i=0; $i<$tam;$i++)
                {
                    if($distritos[$i]['ID_Distrito']==$params[0]['ID_Distrito']){
                        
                       ?> <option value="<?php echo $distritos[$i]['ID_Distrito']?>" selected="selected"><?php echo $distritos[$i]['Nombre_Distrito']?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $distritos[$i]['ID_Distrito']?>" ><?php echo $distritos[$i]['Nombre_Distrito']?></option>   
                <?php }}  ?>
                </select>
            </div>
            
            <div class="col-md-12 espacio-abajo">
              <label for="Direccion">Direccion</label>
              <input type="text" required="required" readonly class="form-control" id="Direccion" name="Direccion" value="<?php echo $params[0]['Direccion'];?>">
            </div>
        </div>
          
        <div>
            <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?> 
                <h3>Información de Areas Apoyo<a id="popup" onclick="mostrar_area_apoyo()" class="btn azul" role="button">Agregar Area Apoyo</a></h3>    
            <?php } else {?>
                <h3>Información de Areas Apoyo</h3>
            <?php } ?>
                <div class="bordegris">
            <table class="display col-md-12 table-striped quitar-float espacio-abajo" id="areas_apoyo">
                <thead> 
                    <th style="text-align:center">Area de Apoyo</th>
                    <th style="text-align:center">Nombre de Area</th>
                    <th style="text-align:center">Numero telefono</th>
                    <th style="text-align:center">Direccion</th>
                    <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?> 
                    <th style="text-align:center">Quitar area de apoyo</th>
                    <?php } ?>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($areas_apoyo);
                    for ($i = 0; $i <$tam; $i++) {
                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo $areas_apoyo[$i]['Nombre_Tipo_Area'];?></td>
                        <td style="text-align:center"><?php echo $areas_apoyo[$i]['Nombre_Area'];?></td>
                        <td style="text-align:center"><?php echo $areas_apoyo[$i]['Numero'];?></td>
                        <td style="text-align:center"><?php echo $areas_apoyo[$i]['Direccion'];?></td>
                        <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?> 
                        <td style="text-align:center"><a class="btn rojo" role="button" id="eliminar_area" name="eliminar_area" onclick="eliminar_area(<?php echo $areas_apoyo[$i]['ID_Area_Apoyo'];?>);">
                                Eliminar</a></td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody> 
            </table>
            </div>
            
                <h3>Información de Personal del PuntoBCR</h3>
            <div>
            <table id="tabla" class="display" cellspacing="0" width="100%">
                <thead> 
                    <th style="text-align:center">Apellido y Nombre</th>
                    <th style="text-align:center">Cedula</th>
                    <th style="text-align:center">Numero telefono</th>
                    <th style="text-align:center">Puesto</th>
                    <th style="text-align:center">Departamento</th>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($personal);
                    for ($i = 0; $i <$tam; $i++) {
                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo $personal[$i]['Apellido_Nombre'];?></td>
                        <td style="text-align:center"><?php echo $personal[$i]['Cedula'];?></td>
                        <td style="text-align:center"><?php echo $personal[$i]['Numero'];?></td>
                        <td style="text-align:center"><?php echo $personal[$i]['Puesto'];?></td>
                        <td style="text-align:center"><?php echo $personal[$i]['Departamento'];?></td>
                    </tr>
                    <?php }?>

                </tbody> 
            </table>
            </div>
            
        </div>
        
        <div class="bordegris espacio-arriba"></div>
        <div class="bordegris espacio-abajo-5">
            <div>
            <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?> 
                <h3>Información de Direcciones IP<a id="popup" onclick="mostrar_direccion_IP()" class="btn azul" role="button">Agregar Dirección IP</a></h3>    
            <?php } else {?>
                <h3>Información de Direcciones IP</h3>
            <?php } ?> 
            <table class="display col-md-12  table-striped quitar-float espacio-abajo" id="direccionIP">
                <thead> 
                    <th style="text-align:center">Tipo Direccion</th>
                    <th style="text-align:center">Direccion IP</th>
                    <th style="text-align:center">Observaciones</th>
                    <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?> 
                        <th style="text-align:center" colspan="2">Funciones</th>
                    <?php } ?>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($direccionIP);
                    for ($i = 0; $i <$tam; $i++) {
                    ?>

                    <tr>
                        <td style="text-align:center"><?php echo $direccionIP[$i]['Tipo_IP'];?></td>
                        <td style="text-align:center"><?php echo $direccionIP[$i]['Direccion_IP'];?></td>
                        <td style="text-align:center"><?php echo $direccionIP[$i]['Observaciones'];?></td>
                        <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?> 
                            <td style="text-align:center"><a href="">Editar</a></td>
                            <td style="text-align:center"><a class="btn rojo" role="button" id="eliminar_ip" name="eliminar_ip" onclick="eliminar_ip(<?php echo $direccionIP[$i]['ID_Direccion_IP'];?>);">
                                    Eliminar</a></td>
                         <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody> 
            </table>
            </div>
        </div>
        
        <div>
            <h3>Información adicional
                <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?>
                    <input class="quitar-float" type="checkbox" id="chk_info_adicional" name="chk_info_adicional">
                 <?php } ?>
            </h3>
            
            <div class="col-md-4 espacio-abajo">
                <label for="Empresa">Remesa</label>
                <select class="form-control" id="Empresa" disabled name="Empresa"> 
                <?php
                $tam = count($empresas);
                for($i=0; $i<$tam;$i++)
                {
                    if($empresas[$i]['ID_Empresa']==$params[0]['ID_Empresa']){
                       ?> <option value="<?php echo $empresas[$i]['ID_Empresa']?>" selected="selected"><?php echo $empresas[$i]['Empresa']?></option><?php
                    }   
                    else { ?>
                        <option value="<?php echo $empresas[$i]['ID_Empresa']?>" ><?php echo $empresas[$i]['Empresa']?></option>   
                <?php } }  ?>
                </select>
            </div>
            
            <div class="col-md-8 espacio-abajo">
              <label for="Observaciones_generales">Observaciones</label>
              <input type="text" readonly class="form-control" id="Observaciones_generales" name="Observaciones_generales" value="<?php echo $params[0]['Observaciones_Punto'];?>">
            </div>
            
            <!--Información del Gerente de Zona del BCR-->
            <div class="col-md-4 espacio-abajo">
              <label for="zonas_gerente">Gerente de Zona BCR</label>
              <select class="form-control" id="zonas_gerente" disabled name="zonas_gerente"> 
                <?php
                $tam = count($gerente_zona_bcr);
                $ubicacionpersona="";
                for($i=0; $i<$tam;$i++){
                    if($gerente_zona_bcr[$i]['ID_Gerente_Zona']==$params[0]['ID_Gerente_Zona']){
                        $ubicacionpersona=$i;
                       ?> <option value="<?php echo $gerente_zona_bcr[$i]['ID_Gerente_Zona']?>" selected="selected" ><?php echo $gerente_zona_bcr[$i]['Zona_Gerencia_BCR'];?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $gerente_zona_bcr[$i]['ID_Gerente_Zona']?>"><?php echo $gerente_zona_bcr[$i]['Zona_Gerencia_BCR']?></option>   
                <?php }} ?>
                </select>
            </div>
            <div class="col-md-4 espacio-abajo">
              <label for="nombre_gerente">Nombre Gerente de Zona</label>
              <input type="text" readonly class="form-control" id="nombre_gerente" name="nombre_gerente" value="<?php echo $gerente_zona_bcr[$ubicacionpersona]['Apellido_Nombre'];?>">
            </div>
            <div class="col-md-4 espacio-abajo">
              <label for="tel_gerente">Teléfono</label>
              <input type="text" readonly class="form-control" id="tel_gerente" name="tel_gerente" value="<?php echo $gerente_zona_bcr[$ubicacionpersona]['Numero'];?>">
            </div>
            
            <!--Información del Supervisor de Zona privado-->
            <div class="col-md-4 espacio-abajo">
              <label for="zonas_supervisores">Supervisor de Zona</label>
              <select class="form-control" id="zonas_supervisores" disabled name="zonas_supervisores" > 
                <?php
                $tam = count($supervisor_zona_externo);

                for($i=0; $i<$tam;$i++)
                {
                    if($supervisor_zona_externo[$i]['ID_Supervisor_Zona']==$params[0]['ID_Supervisor_Zona']){
                        $ubicacionpersona=$i;
                       ?> <option value="<?php echo $supervisor_zona_externo[$i]['ID_Supervisor_Zona']?>" selected="selected"><?php echo $supervisor_zona_externo[$i]['Zona_Supervisor'];?></option><?php
                    }
                    else {?>
                        <option value="<?php echo $supervisor_zona_externo[$i]['ID_Supervisor_Zona']?>" ><?php echo $supervisor_zona_externo[$i]['Zona_Supervisor']?></option>   
                <?php }}  ?>
                </select>
            </div>
            <div class="col-md-4 espacio-abajo">
              <label for="nombre_supervisor">Nombre del Supervisor</label>
              <input type="text" readonly class="form-control" id="nombre_supervisor" name="nombre_supervisor" value="<?php echo $supervisor_zona_externo[$ubicacionpersona]['Apellido_Nombre'];?>">
            </div>
            <div class="col-md-4 espacio-abajo">
              <label for="tel_supervisor">Teléfono</label>
              <input type="text" readonly class="form-control" id="tel_supervisor" name="tel_supervisor" value="<?php echo $supervisor_zona_externo[$ubicacionpersona]['Numero'];?>">
            </div>
        </div>  
        
        <div class="bordegris espacio-abajo-5">
            <div>
            <?php if($_SESSION['modulos']['Editar- Puntos BCR']==1){ ?> 
                <h3>Horario Punto BCR<a id="popup" onclick="mostrar_horario()" class="btn azul" role="button">Cambiar Horario</a></h3>    
            <?php } else {?>
                <h3>Horario Punto BCR</h3>
            <?php } ?> 
            <table class="display col-md-12  table-striped quitar-float espacio-abajo" id="direccionIP">
                <thead> 
                    <tr>
                        <th style="text-align:center">Horario</th>
                        <th style="text-align:center">Domingo</th>
                        <th style="text-align:center">Lunes</th>
                        <th style="text-align:center">Martes</th>
                        <th style="text-align:center">Miercoles</th>
                        <th style="text-align:center">jueves</th>
                        <th style="text-align:center">Viernes</th>
                        <th style="text-align:center">Sábado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center">Hora de apertura a público</td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Apertura_Domingo'];?></td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Apertura_Lunes'];?></td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Apertura_Martes'];?></td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Apertura_Miercoles'];?></td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Apertura_Jueves'];?></td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Apertura_Viernes'];?></td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Apertura_Sabado'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align:center">Hora de cierre a público</td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Cierre_Domingo'];?></td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Cierre_Lunes'];?></td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Cierre_Martes'];?></td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Cierre_Miercoles'];?></td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Cierre_Jueves'];?></td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Cierre_Viernes'];?></td>
                        <td style="text-align:center"><?php echo $horariopunto[0]['Hora_Cierre_Sabado'];?></td>
                    </tr>
                    <?php //}?>
                </tbody> 
            </table>
            </div>
        </div>
        
        <a href="index.php?ctl=puntos_bcr_listar" class="btn btn-default espacio-arriba" role="button">Volver</a>
        <?php require_once 'pie_de_pagina.php' ?>
        </div>
        
        
        <!--agregar teléfono a Punto BCR-->
        <div id="agregar_telefono"> 
            <div id="popupventana">
                <!--Formulario para ingresar nuevos números de teléfono-->
                <form id="ventana" method="post" name="form" action="index.php?ctl=puntobcr_numero_telefono_guardar">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Agregar número de Punto BCR</h2>
                    <hr>
                    <input hidden id="ID_Tipo_Telefono" name="ID_Tipo_Telefono" type="text" value="0">
                    <input hidden id="ID_PuntoBCR" name="ID_PuntoBCR" type="text" value="<?php echo $params[0]['ID_PuntoBCR']; ?>">
                    <label for="Tipo_Telefono">Tipo de Telefono</label>
                        <select class="form-control espacio-abajo" id="Tipo_Telefono" name="Tipo_Telefono"> 
                        <?php
                        $tam = count($tipo_telefono);
                        for($i=0; $i<$tam;$i++)
                        {  
                            if($tipo_telefono[$i]['ID_Tipo_Telefono']==1||$tipo_telefono[$i]['ID_Tipo_Telefono']==5||$tipo_telefono[$i]['ID_Tipo_Telefono']==6||
                                $tipo_telefono[$i]['ID_Tipo_Telefono']==7||$tipo_telefono[$i]['ID_Tipo_Telefono']==8||$tipo_telefono[$i]['ID_Tipo_Telefono']==9||
                                    $tipo_telefono[$i]['ID_Tipo_Telefono']==10){?>
                                <option value="<?php echo $tipo_telefono[$i]['ID_Tipo_Telefono']?>" ><?php echo $tipo_telefono[$i]['Tipo_Telefono']?></option>   
                        <?php }}  ?>
                        </select>
                    <label for="numero">Número de Teléfono</label>
                    <input class="form-control espacio-abajo" maxlength="8" required id="numero" name="numero" placeholder="Número de teléfono - 8 digitos" type="text">
                    <label for="numero">Observaciones</label>
                    <textarea class="form-control espacio-abajo" id="observaciones" name="observaciones" placeholder="Observaciones del número"></textarea>
                    <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                    </form>
                </div>
            <!--Cierre agregar teléfono a Punto BCR-->
            </div>
        
        <!--Asignar UE a Punto BCR-->
        <div id="asignar_ue">
            <div id="popupventana2">
                <div id="ventana2">
                <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla2" class="display" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="text-align:center">Unidad Ejecutora</th>
                        <th style="text-align:center">Departamento</th>
                        <th style="text-align:center">Observaciones</th>
                        <th style="text-align:center">Opciones</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php 
                      $tam=count($todas_ue);
                      for ($i = 0; $i <$tam; $i++) { ?>  
                        
                      <tr>
                        <td style="text-align:center"><?php echo $todas_ue[$i]['Numero_UE'];?></td>
                        <td style="text-align:center"><?php echo $todas_ue[$i]['Departamento'];?></td>
                        <td style="text-align:center"><?php echo $todas_ue[$i]['Observaciones'];?></td>
                        <td style="text-align:center"><a class="btn" role="button" onclick="agregar_ue(<?php echo $todas_ue[$i]['ID_Unidad_Ejecutora'];?>);">
                                    Asignar al PuntoBCR</a></td>
                      </tr>
                      <?php } ?>
                     </tbody>
                  </table>
                </div>
            </div>
        <!--Cierre Asignar UE a Punto BRC-->
        </div> 
        
        <!--Agregar o asignar areas de apoyo-->
        <div id="asignar_area">
            <div id="popupventana2">
                <div id="ventana2">
                <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Areas de Apoyo</h2>
                    <h4>Agregar nueva area de apoyo</h4>
                    <!--Formulario para ingresar areas de apoyo-->
                    <form class="bordegris" id="nueva_area_apoyo" method="post" name="form" action="index.php?ctl=Area_apoyo_agregar">
                        <input hidden id="ID_PuntoBCR" name="ID_PuntoBCR" type="text" value="<?php echo $params[0]['ID_PuntoBCR']; ?>">
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="nombre">Nombre de Area Apoyo</label>
                            <input type="text" required="nombre" class="form-control" id="nombre" name="nombre" placeholder="Nombre del area de apoyo">
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                        <label for="Tipo_Area_Apoyo">Tipo de Area</label>
                            <select class="form-control" id="Tipo_Area_Apoyo" name="Tipo_Area_Apoyo"> 
                            <?php
                            $tam = count($tipos_areas_apoyo);
                            for($i=0; $i<$tam;$i++)
                            {  ?>
                                <option value="<?php echo $tipos_areas_apoyo[$i]['ID_Tipo_Area_Apoyo']?>" ><?php echo $tipos_areas_apoyo[$i]['Nombre_Tipo_Area']?></option>   
                            <?php }  ?>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="observaciones">Observaciones</label>
                            <input type="text" class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones del area de apoyo">
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="provincia">Provincia</label>
                            <select class="form-control" id="provincia" name="provincia" > 
                                <?php
                                $tam = count($provincias);

                                for($i=0; $i<$tam;$i++)
                                {
                                    if($provincias[$i]['ID_Provincia']==$cantones[$distritos[$params[0]['ID_Distrito']]['ID_Canton']]['ID_Provincia']){

                                        ?><option value="<?php echo $provincias[$i]['ID_Provincia']?>" selected="selected"><?php echo $provincias[$i]['Nombre_Provincia']?></option><?php
                                    }
                                    else {?>
                                        <option value="<?php echo $provincias[$i]['ID_Provincia']?>" ><?php echo $provincias[$i]['Nombre_Provincia']?></option>   
                                <?php }}  ?>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="canton2">Cantón</label>
                            <select class="form-control" id="canton2" name="canton2" > 
                            <?php
                            $tam = count($cantones);

                            for($i=0; $i<$tam;$i++)
                            {
                                if($cantones[$i]['ID_Canton']==$distritos[$params[0]['ID_Distrito']]['ID_Canton']){
                                   ?> <option value="<?php echo $cantones[$i]['ID_Canton']?>" selected="selected"><?php echo $cantones[$i]['Nombre_Canton']?></option><?php
                                }
                                else {?>
                                    <option value="<?php echo $cantones[$i]['ID_Canton']?>" ><?php echo $cantones[$i]['Nombre_Canton']?></option>   
                            <?php }}  ?>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="distrito2">Distrito</label>
                            <select class="form-control" id="distrito2" name="distrito2"> 
                            <?php
                            $tam = count($distritos);
                            for($i=0; $i<$tam;$i++) {
                                if($distritos[$i]['ID_Distrito']==$params[0]['ID_Distrito']){
                                   ?> <option value="<?php echo $distritos[$i]['ID_Distrito']?>" selected="selected"><?php echo $distritos[$i]['Nombre_Distrito']?></option><?php
                                }   else    {?>
                                    <option value="<?php echo $distritos[$i]['ID_Distrito']?>" ><?php echo $distritos[$i]['Nombre_Distrito']?></option>   
                            <?php }}  ?>
                            </select>
                        </div>
                        
                        <div class="col-md-12 espacio-abajo-5">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirreción del area de apoyo exacta">
                        </div>
                        <div class="col-md-6 espacio-abajo-5">
                        <label for="Tipo_Telefono">Tipo de Telefono</label>
                            <select class="form-control" id="Tipo_Telefono" name="Tipo_Telefono"> 
                            <?php
                            $tam = count($tipo_telefono);
                            for($i=0; $i<$tam;$i++)
                            {  
                                if($tipo_telefono[$i]['ID_Tipo_Telefono']==12||$tipo_telefono[$i]['ID_Tipo_Telefono']==13||$tipo_telefono[$i]['ID_Tipo_Telefono']==14||
                                    $tipo_telefono[$i]['ID_Tipo_Telefono']==15||$tipo_telefono[$i]['ID_Tipo_Telefono']==16||$tipo_telefono[$i]['ID_Tipo_Telefono']==17||
                                        $tipo_telefono[$i]['ID_Tipo_Telefono']==18||$tipo_telefono[$i]['ID_Tipo_Telefono']==19||$tipo_telefono[$i]['ID_Tipo_Telefono']==25
                                        ||$tipo_telefono[$i]['ID_Tipo_Telefono']==26){?>
                                    <option value="<?php echo $tipo_telefono[$i]['ID_Tipo_Telefono']?>" ><?php echo $tipo_telefono[$i]['Tipo_Telefono']?></option>   
                            <?php }}  ?>
                            </select>
                        </div>
                        <div class="col-md-6 espacio-abajo-5">
                            <label for="numero">Número</label>
                            <input type="text" maxlength="8" class="form-control" id="numero" name="numero" placeholder="Número de teléfono- 8 digitos">
                        </div>
                        <button class="quitar-float espacio-abajo espacio-arriba"><a href="javascript:%20validar_area()" id="submit">Guardar</a></button>
                    </form>
                    
                    <!--lista de areas de apoyo registradas-->
                    <h4>Areas de apoyo registradas en el sistema</h4>
                    <table id="tabla3" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                
                                <th style="text-align:center">Area de Apoyo</th>
                                <th style="text-align:center">Nombre de Area</th>
                                <th style="text-align:center">Numero telefono</th>
                                <th style="text-align:center">Direccion</th>
                                <th style="text-align:center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                            $tam=count($todas_areas_apoyo);
                            for ($i = 0; $i <$tam; $i++) {
                            ?>
                            <tr>
                                <td style="text-align:center"><?php echo $todas_areas_apoyo[$i]['Nombre_Tipo_Area'];?></td>
                                <td style="text-align:center"><?php echo $todas_areas_apoyo[$i]['Nombre_Area'];?></td>
                                <td style="text-align:center"><?php echo $todas_areas_apoyo[$i]['Numero'];?></td>
                                <td style="text-align:center"><?php echo $todas_areas_apoyo[$i]['Direccion'];?></td>
                                <td style="text-align:center"><a class="btn" role="button" onclick="agregar_area(<?php echo $todas_areas_apoyo[$i]['ID_Area_Apoyo'];?>);">
                                    Asignar al PuntoBCR</a></td>
                            </tr>
                            <?php } ?>
                        </tbody> 
                    </table>                  
                </div>
            </div>
        </div>
        
        <!--Agregar o asignar direccion IP-->
        <div id="asignar_direccion_IP">
            <div id="popupventana2">
                <div id="ventana2">
                <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Direcciones IP del PuntoBCR</h2>
                    <h4>Agregar nueva direccion IP</h4>
                    <!--Formulario para ingresar areas de apoyo-->
                    <form class="bordegris" id="nueva_direccion_ip" method="post" name="form" action="index.php?ctl=direccionIP_agregar">
                        <input hidden id="ID_PuntoBCR" name="ID_PuntoBCR" type="text" value="<?php echo $params[0]['ID_PuntoBCR']; ?>">
                        
                        <div class="col-md-4 espacio-abajo-5">
                        <label for="tipo_ip">Tipo de dirección IP</label>
                            <select class="form-control" id="tipo_ip" name="tipo_ip"> 
                            <?php
                            $tam = count($tipos_direccion_ip);
                            for($i=0; $i<$tam;$i++)
                            {  ?>
                                <option value="<?php echo $tipos_direccion_ip[$i]['ID_Tipo_IP']?>" ><?php echo $tipos_direccion_ip[$i]['Tipo_IP']?></option>   
                            <?php }  ?>
                            </select>
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="direccion_ip">Dirección IP</label>
                            <input type="text" class="form-control" id="direccion_ip" name="direccion_ip" placeholder="Dirección IP. Ej: 192.168.1.1 ">
                        </div>
                        <div class="col-md-4 espacio-abajo-5">
                            <label for="observaciones">Observaciones</label>
                            <input type="text" class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones de la dirección IP">
                        </div>
                        <button class="quitar-float espacio-abajo espacio-arriba"><a href="javascript:%20validar_direccion_ip()" id="submit">Guardar</a></button>
                    </form>
                    
                    <!--lista de areas de apoyo registradas-->
                    <h4>Direcciones IP registradas en el sistema</h4>
                    <table id="tabla4" class="display" cellspacing="0" width="100%">
                        <thead> 
                            <tr>
                                <th>ID</th>
                                <th style="text-align:center">Tipo Direccion</th>
                                <th style="text-align:center">Direccion IP</th>
                                <th style="text-align:center">Observaciones</th>
                                <th style="text-align:center">Funciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($todas_direccionIP);
                            for ($i = 0; $i <$tam; $i++) {
                            ?>
                            <tr>
                                <td><?php echo $todas_direccionIP[$i]['ID_Direccion_IP'];?></td>
                                <td style="text-align:center"><?php echo $todas_direccionIP[$i]['Tipo_IP'];?></td>
                                <td style="text-align:center"><?php echo $todas_direccionIP[$i]['Direccion_IP'];?></td>
                                <td style="text-align:center"><?php echo $todas_direccionIP[$i]['Observaciones'];?></td>
                                <td style="text-align:center"><a class="btn" role="button" id="asignar_ip" name="asignar_ip" onclick="asignar_ip(<?php echo $todas_direccionIP[$i]['ID_Direccion_IP'];?>);">
                                        Asignar al PuntoBCr</a></td>
                            </tr>
                            <?php } ?>
                        </tbody> 
                    </table>                  
                </div>
            </div>
        </div>
        
        <!--Asignar Horario al Punto BCR-->
        <div id="asignar_horario">
            <div id="popupventana3">
                <div id="ventana3">
                <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                    <!--Tabla con la lista de Horarios-->
                    <table id="tabla5" class="display" cellspacing="0" width="100%">
                    <thead> 
                        <tr>
                            <th style="text-align:center">Horario</th>
                            <th style="text-align:center">Domingo</th>
                            <th style="text-align:center">Lunes</th>
                            <th style="text-align:center">Martes</th>
                            <th style="text-align:center">Miercoles</th>
                            <th style="text-align:center">jueves</th>
                            <th style="text-align:center">Viernes</th>
                            <th style="text-align:center">Sábado</th>
                             <th style="text-align:center">Observaciones</th>
                            <th style="text-align:center">Opciones</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php $tam = count($horarios);
                    
                    for($i=0; $i<$tam;$i++){?>
                    <tr>
                        <td style="text-align:center">Horario público</td>
                        <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Domingo']." - ".$horarios[$i]['Hora_Cierre_Domingo'];?></td>
                        <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Lunes']." - ".$horarios[$i]['Hora_Cierre_Lunes'];?></td>
                        <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Martes']." - ".$horarios[$i]['Hora_Cierre_Martes'];?></td>
                        <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Miercoles']." - ".$horarios[$i]['Hora_Cierre_Miercoles'];?></td>
                        <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Jueves']." - ".$horarios[$i]['Hora_Cierre_Jueves'];?></td>
                        <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Viernes']." - ".$horarios[$i]['Hora_Cierre_Viernes'];?></td>
                        <td style="text-align:center"><?php echo $horarios[$i]['Hora_Apertura_Sabado']." - ".$horarios[$i]['Hora_Cierre_Sabado'];?></td>
                        <td style="text-align:center"><?php echo $horarios[$i]['Observaciones'];?></td>
                        <td style="text-align:center"><a class="btn" role="button" onclick="asignar_horario(<?php echo $horarios[$i]['ID_Horario'];?>);">
                                    Asignar al PuntoBCR</a></td>
                    </tr>
                    <?php }?>
                </tbody> 
                  </table>
                </div>
            </div>
        <!--Cierre Asignar Horario a Punto BCR-->
        </div> 
    </body>
</html>