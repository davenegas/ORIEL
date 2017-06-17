
<?php function nota_obtener() {
    $obj_general = new cls_general();
    $obj_general->obtener_notas();
    $notas= $obj_general->getArreglo(); 
    return $notas;
} ?>
    
<html lang="en"> 
    <head>
        <link rel="stylesheet" href="vistas/css/main.css">
        <script src="vistas/js/jquery-1-4-2-min.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_encabezado.js"></script>
    </head>
    <center><img src="vistas/Imagenes/Banner_Centro_de_Control.jpg" alt=""/></center>
    <nav class="navbar navbar-default" >
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php?ctl=principal"><b>Jefatura Seguridad</b></a>
            </div>
            
            <ul class="nav navbar-nav">
                <?php 
                //************************************************Pinta Menu de Seguridad***************************************************************
                if (($_SESSION['modulos']['Seguridad-Módulos']==1)||($_SESSION['modulos']['Seguridad-Roles']==1)||
                        ($_SESSION['modulos']['Seguridad-Usuarios']==1)||($_SESSION['modulos']['Seguridad-Trazabilidad']==1)){ ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Seguridad
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <?php if ($_SESSION['modulos']['Seguridad-Módulos']==1){ ?>
                                <li><a href="index.php?ctl=modulos_listar">Módulos</a></li>
                            <?php };  ?>

                            <?php   if ($_SESSION['modulos']['Seguridad-Roles']==1){ ?>
                                <li><a href="index.php?ctl=listar_roles">Roles</a></li>
                            <?php }; ?>

                            <?php  if ($_SESSION['modulos']['Seguridad-Usuarios']==1){?>
                                <li><a href="index.php?ctl=listar_usuarios">Usuarios</a></li>
                            <?php }; ?>   

                            <?php if ($_SESSION['modulos']['Seguridad-Trazabilidad']==1){ ?>
                                <li><a href="index.php?ctl=principal">Trazabilidad</a></li> 
                            <?php }; ?>

                        </ul>
                    </li>
                <?php  };    ?>

                <?php 
                //************************************************Pinta Menu de Catalogos***************************************************************
                if (($_SESSION['modulos']['Catálogos-Empresas']==1||$_SESSION['modulos']['Catálogos-Tipo Evento']==1||
                       $_SESSION['modulos']['Importar- Prontuario']==1||$_SESSION['modulos']['Catálogos-Direcciones IP']==1||
                       $_SESSION['modulos']['Catálogos-Horarios']==1||$_SESSION['modulos']['Catálogos-Unidades Ejecutoras']==1||
                       $_SESSION['modulos']['Catálogos-Tipo Teléfono']==1||$_SESSION['modulos']['Catálogos-Tipo Punto']==1||
                       $_SESSION['modulos']['Catálogos-Gerente Zona']==1|| $_SESSION['modulos']['Catálogos-Supervisor Zona']==1||
                       $_SESSION['modulos']['Catálogos-Proveedor enlaces']==1||$_SESSION['modulos']['Catálogos-Tipo enlaces']==1||
                       $_SESSION['modulos']['Catálogos-Medio enlaces']==1|| $_SESSION['modulos']['Catálogos-Unidades de Video']==1||
                       $_SESSION['modulos']['Catálogos-Cencon']==1 || $_SESSION['modulos']['Catálogos-Puestos de Monitoreo']==1
                        || $_SESSION['modulos']['Catálogos-Inconsistencias de Video']==1)){  ?>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Catálogos
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <?php if ($_SESSION['modulos']['Catálogos-Empresas']==1){ ?>
                                <li><a href="index.php?ctl=empresas_listar">Empresas</a></li>
                            <?php };?>   

                            <?php if ($_SESSION['modulos']['Catálogos-Tipo Evento']==1){ ?>
                                <li><a href="index.php?ctl=tipo_eventos_listar">Tipo Evento</a></li>
                            <?php }; ?>

                            <?php  if ($_SESSION['modulos']['Catálogos-Direcciones IP']==1){?>
                                <li><a href="index.php?ctl=direcciones_ip_listar">Direcciones IP's</a></li> 
                            <?php  }; ?>  

                            <?php  if ($_SESSION['modulos']['Catálogos-Horarios']==1){?>
                                <li><a href="index.php?ctl=horario_listar">Horarios BCR</a></li> 
                            <?php  }; ?>     

                            <?php  if ($_SESSION['modulos']['Catálogos-Unidades Ejecutoras']==1){?>
                                <li><a href="index.php?ctl=unidad_ejecutora_listar">Unidades Ejecutoras</a></li>
                            <?php  }; ?> 

                            <?php  if ($_SESSION['modulos']['Catálogos-Tipo Teléfono']==1){?>
                                <li><a href="index.php?ctl=tipo_telefono_listar">Tipo Teléfono</a></li>
                            <?php  }; ?> 

                            <?php  if ($_SESSION['modulos']['Catálogos-Tipo Punto']==1){?>
                                <li><a href="index.php?ctl=tipo_punto_listar">Tipo Punto</a></li>
                            <?php  }; ?>

                            <?php  if ($_SESSION['modulos']['Catálogos-Gerente Zona']==1){?>
                                <li><a href="index.php?ctl=gerente_zona_listar">Gerentes de Zona</a></li>
                            <?php  }; ?> 

                            <?php  if ($_SESSION['modulos']['Catálogos-Supervisor Zona']==1){?>
                                <li><a href="index.php?ctl=supervisor_zona_listar">Supervisor de Zona</a></li>
                            <?php  }; ?>
                            
                            <?php  if ($_SESSION['modulos']['Catálogos-Proveedor enlaces']==1){?>
                                <li><a href="index.php?ctl=proveedor_listar">Proveedores enlaces</a></li> 
                            <?php  }; ?>

                            <?php  if ($_SESSION['modulos']['Catálogos-Tipo enlaces']==1){?>
                                <li><a href="index.php?ctl=tipo_enlace_listar">Tipos de enlaces</a></li> 
                            <?php  }; ?>

                            <?php  if ($_SESSION['modulos']['Catálogos-Medio enlaces']==1){?>
                                <li><a href="index.php?ctl=medio_enlace_listar">Medios de enlaces</a></li> 
                            <?php  }; ?>   

                            <?php  if ($_SESSION['modulos']['Catálogos-Unidades de Video']==1){?>
                               <li><a href="index.php?ctl=unidades_de_video_listar">Unidades de Video</a></li>
                            <?php  }; ?>
                               
                            <?php  if ($_SESSION['modulos']['Catálogos-Inconsistencias de Video']==1){?>
                               <li><a href="index.php?ctl=inconsistencias_de_video_listar">Inconsistencias de Video</a></li>
                            <?php  }; ?>

                            <?php  if ($_SESSION['modulos']['Catálogos-Puestos de Monitoreo']==1){?>
                               <li><a href="index.php?ctl=puestos_de_monitoreo_listar">Puestos de Monitoreo</a></li>
                            <?php  }; ?>

                            <?php  if ($_SESSION['modulos']['Catálogos-Cencon']==1){?>
                               <li><a href="index.php?ctl=cencon_gestion">Registro Cencon</a></li>
                            <?php  }; ?>

                            <?php  if ($_SESSION['modulos']['Importar- Prontuario']==1){?>
                               <li><a href="index.php?ctl=frm_importar_prontuario_paso_1">Importar Prontuario</a></li> 
                            <?php  }; ?>  

                        </ul>
                    </li>

                <?php }; ?>

                <?php 
                //************************************************Pinta Menu de Reportes***************************************************************
                if (($_SESSION['modulos']['Reportes-Eventos']==1)||($_SESSION['modulos']['Reportes-Oficinas']==1)||

                        ($_SESSION['modulos']['Reportes-Personal']==1)||($_SESSION['modulos']['Reportes-Alertas']==1)||
                        ($_SESSION['modulos']['Reportes-Enlaces Telecom']==1)||($_SESSION['modulos']['Reportes-Líneas teléfonicas']==1)||
                        ($_SESSION['modulos']['Reportes-Trazabilidad']==1)||($_SESSION['modulos']['Reportes-Historico seguimientos']==1)||
                        ($_SESSION['modulos']['Reportes-Activaciones provincia']==1)||($_SESSION['modulos']['Reportes-Cencon']==1)){ ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <!-- <?php if ($_SESSION['modulos']['Reportes-Eventos']==1){ ?>
                                <li><a href="index.php?ctl=principal">Eventos</a></li>
                            <?php  }; ?>

                            <?php if ($_SESSION['modulos']['Reportes-Oficinas']==1){?>
                                <li><a href="index.php?ctl=principal">Oficinas</a></li>
                            <?php  }; ?>

                            <?php if ($_SESSION['modulos']['Reportes-Personal']==1){ ?>
                                <li><a href="index.php?ctl=principal">Personal</a></li>
                            <?php }; ?>   

                            <?php if ($_SESSION['modulos']['Reportes-Alertas']==1){ ?>
                                <li><a href="index.php?ctl=principal">Alertas</a></li> 
                            <?php }; ?> -->

                            <?php if ($_SESSION['modulos']['Reportes-Enlaces Telecom']==1){ ?>
                                <li><a href="index.php?ctl=enlace_reporte">Enlaces Telecom</a></li> 
                            <?php }; ?>
    
                            <?php if ($_SESSION['modulos']['Reportes-Líneas teléfonicas']==1){ ?>
                                <li><a href="index.php?ctl=reporte_lineas_telefonicas">Líneas teléfonicas</a></li> 
                            <?php }; ?>
                             
                            <?php if ($_SESSION['modulos']['Reportes-Cencon']==1){ ?>
                                <li><a href="index.php?ctl=reporte_cencon">Reporte Cencon</a></li> 
                            <?php }; ?>
                            
                            <?php if ($_SESSION['modulos']['Reportes-Historico seguimientos']==1){ ?>
                                <li><a href="index.php?ctl=reporte_seguimiento_eventos">Histórico Seguimiento Usuarios</a></li> 
                            <?php }; ?>

                            <?php if ($_SESSION['modulos']['Reportes-Activaciones provincia']==1){ ?>
                                <li><a href="index.php?ctl=reporte_eventos_provincia">Activaciones por Provincia</a></li> 
                            <?php }; ?>
                            
                            <?php if ($_SESSION['modulos']['Módulo-Pruebas alarma']==1){ ?>
                                <li><a href="index.php?ctl=reporte_prueba_alarma">Pruebas alarma reportadas</a></li> 
                            <?php }; ?>
                            
                            <?php if ($_SESSION['modulos']['Reportes-Trazabilidad']==1){ ?>
                                <li><a href="index.php?ctl=frm_trazabilidad_listar">Trazabilidad</a></li> 
                            <?php }; ?>   
                            
                            <?php if ($_SESSION['modulos']['Reportes-Alertas Generales']==1){ ?>
                                <li><a href="index.php?ctl=alertas_generales">Alertas Generales</a></li> 
                            <?php }; ?>   
                                
                            <?php if ($_SESSION['modulos']['Reportes-Controles de Video']==1){ ?>
                                <li><a href="index.php?ctl=reporte_controles_de_video_listar">Estadisticas Controles de Video</a></li> 
                            <?php }; ?>   
                               
                            <?php if ($_SESSION['modulos']['Reportes-Controles de Video']==1){ ?>
                                <li><a href="index.php?ctl=reporte_revisiones_video">Revisiones de Video</a></li> 
                            <?php }; ?>   
                                
                            <?php if ($_SESSION['modulos']['Reportes-TL300 Puntos BCR']==1){ ?>
                                <li><a href="index.php?ctl=reporte_tl300_en_puntos_bcr_listar">TL300 en Puntos BCR</a></li> 
                            <?php }; ?> 
                        </ul>
                    </li>

                <?php }; ?>

                <?php 

                //************************************************Pinta Menu de Módulos***************************************************************
                if (($_SESSION['modulos']['Módulo-Bitácora Digital']==1)||($_SESSION['modulos']['Módulo-MRI BCR']==1)||
                        ($_SESSION['modulos']['Módulo-Control de Video']==1)||($_SESSION['modulos']['Módulo-PuntosBCR']==1)||
                        ($_SESSION['modulos']['Módulo-Personal']==1)||($_SESSION['modulos']['Módulo-Áreas de Apoyo']==1)||
                        ($_SESSION['modulos']['Módulo-Personal Externo']==1)||($_SESSION['modulos']['Módulo-Cencon']==1)||
                        ($_SESSION['modulos']['Módulo-Pruebas alarma']==1)){?>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Módulos
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <?php if ($_SESSION['modulos']['Módulo-Bitácora Digital']==1){ ?>
                                <li><a href="index.php?ctl=frm_eventos_listar">Bitácora Digital</a></li>
                            <?php }; ?>

                            <?php  if ($_SESSION['modulos']['Módulo-MRI BCR']==1){ ?>
                                <!--<li><a href="#">MRI-BCR</a></li>-->
                            <?php }; ?>

                            <?php if ($_SESSION['modulos']['Módulo-PuntosBCR']==1){ ?>
                                <li><a href="index.php?ctl=puntos_bcr_listar">Puntos BCR</a></li>
                            <?php }; ?>

                            <?php if ($_SESSION['modulos']['Módulo-Personal']==1){ ?>
                                <li><a href="index.php?ctl=personal_listar">Personal BCR</a></li>
                            <?php }; ?>

                            <?php if ($_SESSION['modulos']['Módulo-Personal Externo']==1){?>
                                <li><a href="index.php?ctl=personal_externo_listar">Personal Externo</a></li>
                            <?php }; ?>

                            <?php if ($_SESSION['modulos']['Módulo-Áreas de Apoyo']==1){ ?>
                                <li><a href="index.php?ctl=areas_apoyo_listar">Áreas de Apoyo</a></li>
                            <?php }; ?>
                               
                            <?php if ($_SESSION['modulos']['Módulo-Cencon']==1){?>
                                <li><a href="index.php?ctl=eventos_cencon">Cencon</a></li> 
                            <?php }; ?>

<!--                             <?php if ($_SESSION['modulos']['Módulo-Puestos de Monitoreo']==1){?>
                                <li><a href="index.php?ctl=puestos_de_monitoreo_listar">Puestos de Monitoreo</a></li>
                            <?php }; ?>   -->
                            
                            <?php if ($_SESSION['modulos']['Módulo-Puestos de Monitoreo']==1){?>
                                <li><a href="index.php?ctl=controles_de_video_listar">Control de Video</a></li>
                            <?php }; ?>   

                            <?php if ($_SESSION['modulos']['Módulo-Pruebas alarma']==1){?>
                                <li><a href="index.php?ctl=pruebas_alarma">Pruebas alarma</a></li> 
                            <?php }; ?>
                                
                            <?php if ($_SESSION['modulos']['Módulo-Control de Video']==1){?>
                                <!--<li><a href="http://10.170.5.80/Operaciones_de_Seguridad/ctrlvideo/consulta.html">Controles de Video</a></li>-->
                            <?php }; ?>

                        </ul>
                    </li>

                <?php }; ?>

                   <?php 
                //************************************************Pinta Menu de Ayuda***************************************************************
                if (($_SESSION['modulos']['Ayuda']==1)){ ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Ayuda
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?ctl=manual_ayuda_privado&manual=Usuario_Inicial">Manual Usuario Inicial</a></li>
                            
                            <?php if ($_SESSION['modulos']['Módulo-Bitácora Digital']==1){ ?>
                                <li><a href="index.php?ctl=manual_ayuda_privado&manual=Bitacora_Digital">Manual Bitácora Digital</a></li>
                            <?php }; ?>    
                                
                            <?php if ($_SESSION['modulos']['Módulo-PuntosBCR']==1){ ?>
                                <li><a href="index.php?ctl=manual_ayuda_privado&manual=Puntos_BCR">Manual Puntos BCR</a></li>
                            <?php }; ?>
                                
                            <?php if ($_SESSION['modulos']['Módulo-Personal']==1){ ?>
                                <li><a href="index.php?ctl=manual_ayuda_privado&manual=Personal_BCR">Manual Personal BCR</a></li>
                            <?php }; ?>
                                
                            <?php if ($_SESSION['modulos']['Módulo-Personal Externo']==1){ ?>
                                <li><a href="index.php?ctl=manual_ayuda_privado&manual=Personal_Externo">Manual Personal Externo</a></li>
                            <?php }; ?>
                             
                            <?php if ($_SESSION['modulos']['Módulo-Cencon']==1){ ?>
                                <li><a href="index.php?ctl=manual_ayuda_privado&manual=Cencon">Manual Cencon</a></li>
                            <?php }; ?>
                                
                            <?php if ($_SESSION['modulos']['Módulo-Puestos de Monitoreo']==1){ ?>
                                <li><a href="index.php?ctl=manual_ayuda_privado&manual=Control_Video">Manual Control de Video</a></li>
                            <?php }; ?>  
                                
                            <?php if ($_SESSION['modulos']['Módulo-Pruebas alarma']==1){ ?>
                                <li><a href="index.php?ctl=manual_ayuda_privado&manual=Prueba_Alarma">Manual Pruebas Alarma</a></li>
                            <?php }; ?>
                                 
                            <?php if ($_SESSION['modulos']['Módulo-Asistencia de Personal']==1||$_SESSION['modulos']['Módulo-Asistencia encargado empresa']==1||$_SESSION['modulos']['Módulo-Asistencia encargado empresa']==1){?>
                                <li><a href="index.php?ctl=manual_ayuda_privado&manual=Asistencia">Manual Pruebas Alarma</a></li>
                            <?php }; ?>
                        </ul>
                    </li>
                <?php }; ?>       
            </ul>  

            <ul class="nav navbar-nav navbar-right">    
                <li><a href="index.php?ctl=principal"><span class="glyphicon glyphicon-th-large"></span><?php echo $_SESSION['name']." ".$_SESSION['apellido'];?></a></li>
                <li><a href="index.php?ctl=cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Cerrar Sesión</a></li>    
            </ul>
      </div>
    </nav>
</html>