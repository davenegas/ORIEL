    <?php       
    function nota_obtener() {
        $obj_general = new cls_general();
        $obj_general->obtener_notas();
        $notas= $obj_general->getArreglo(); 
        
//        echo "<pre>";
//        print_r($notas);
//        echo "</pre>";
        return $notas;
    }
    ?>
    

<html lang="en"> 
    <head>
        <link rel="stylesheet" href="vistas/css/main.css">
        <script src="vistas/js/jquery-1-4-2-min.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_encabezado.js"></script>
    </head>
    <br>
     <center><img src="vistas/Imagenes/Banner_Centro_de_Control.jpg" alt=""/></center>
     <?php
     if($_SESSION['modulos']['Notas Importantes']==1){ ?>
        <!--Ventana de Notas Pendientes, deslizable-->
        <div class="esthela" style="right: -400px;">
        <div style="color: rgb(255, 255, 255); padding: 8px 5px 0pt 50px;">
            <div class="">
                <?php $notas=nota_obtener();?>
                <label for="notas">Pendientes</label>
                <textarea class="form-control" rows="10" id="notas" name="notas" placeholder="Notas importantes para seguimientos" onchange="guardar_informacion();"><?php echo $notas[0]['Nota'];?> </textarea>
            </div>
        </div>
        </div>
     <?php } ?>
     
    <nav class="navbar navbar-default" >
      <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php?ctl=principal"><b>Jefatura Seguridad</b></a>
        </div>
            <ul class="nav navbar-nav">

            <?php 
            //************************************************Pinta Menu de Seguridad***************************************************************
            if (($_SESSION['modulos']['Seguridad-Módulos']==1)||($_SESSION['modulos']['Seguridad-Roles']==1)||
                    ($_SESSION['modulos']['Seguridad-Usuarios']==1)||($_SESSION['modulos']['Seguridad-Trazabilidad']==1)){
            ?>
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Seguridad
            <span class="caret"></span></a>
            <ul class="dropdown-menu">

                <?php if ($_SESSION['modulos']['Seguridad-Módulos']==1){ ?>
                    <li><a href="index.php?ctl=modulos_listar">Módulos</a></li>
                <?php  };  ?>

                <?php   if ($_SESSION['modulos']['Seguridad-Roles']==1){ ?>
                    <li><a href="index.php?ctl=listar_roles">Roles</a></li>
                <?php  }; ?>

                <?php  if ($_SESSION['modulos']['Seguridad-Usuarios']==1){?>
                    <li><a href="index.php?ctl=listar_usuarios">Usuarios</a></li>
                <?php    }; ?>   

                <?php if ($_SESSION['modulos']['Seguridad-Trazabilidad']==1){ ?>
                    <li><a href="index.php?ctl=principal">Trazabilidad</a></li> 
                <?php    }; ?>

            </ul>
            </li>

            <?php  };    ?>


            <?php 
            //************************************************Pinta Menu de Catalogos***************************************************************
            if (($_SESSION['modulos']['Catálogos-Empresas']==1||$_SESSION['modulos']['Catálogos-Tipo Evento']==1||
                   $_SESSION['modulos']['Importar- Prontuario']==1||$_SESSION['modulos']['Catálogos-Direcciones IP']==1||
                   $_SESSION['modulos']['Catálogos-Horarios']==1)){  ?>

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
                   
                <?php  if ($_SESSION['modulos']['Catálogos-Horarios']==1){?>
                   <li><a href="index.php?ctl=unidad_ejecutora_listar">Unidades Ejecutoras</a></li> 
                <?php  }; ?>
                   
                <!--Catalogos de Enlace de Telecomunicaciones-->
                <?php  if ($_SESSION['modulos']['Catálogos-Proveedor enlaces']==1){?>
                   <li><a href="index.php?ctl=proveedor_listar">Proveedores enlaces</a></li> 
                <?php  }; ?> 
                
                <?php  if ($_SESSION['modulos']['Catálogos-Tipo enlaces']==1){?>
                   <li><a href="index.php?ctl=tipo_enlace_listar">Tipos de enlaces</a></li> 
                <?php  }; ?>
                   
                <?php  if ($_SESSION['modulos']['Catálogos-Medio enlaces']==1){?>
                   <li><a href="index.php?ctl=medio_enlace_listar">Medios de enlaces</a></li> 
                <?php  }; ?>
                   
                <!--Catalogos Prontuario--> 
                <?php  if ($_SESSION['modulos']['Importar- Prontuario']==1){?>
                   <li><a href="index.php?ctl=frm_importar_prontuario_paso_1">Importar Prontuario</a></li> 
                <?php  }; ?>  
              
            </ul>
            </li>

          <?php 
          };
          ?>


            <?php 

           //************************************************Pinta Menu de Reportes***************************************************************
           if (($_SESSION['modulos']['Reportes-Eventos']==1)||($_SESSION['modulos']['Reportes-Oficinas']==1)||
                   ($_SESSION['modulos']['Reportes-Personal']==1)||($_SESSION['modulos']['Reportes-Alertas']==1)||
                   ($_SESSION['modulos']['Reportes-Trazabilidad']==1)){ ?>

            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes
            <span class="caret"></span></a>
            <ul class="dropdown-menu">

                <?php if ($_SESSION['modulos']['Reportes-Eventos']==1){ ?>
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
                <?php }; ?>   

                 <?php if ($_SESSION['modulos']['Reportes-Trazabilidad']==1){ ?>
                    <li><a href="index.php?ctl=frm_trazabilidad_listar">Trazabilidad</a></li> 
                <?php }; ?>   

            </ul>
            </li>

          <?php 
          };
          ?>


            <?php 

            //************************************************Pinta Menu de Módulos***************************************************************
            if (($_SESSION['modulos']['Módulo-Bitácora Digital']==1)||($_SESSION['modulos']['Módulo-MRI BCR']==1)||
                    ($_SESSION['modulos']['Módulo-Control de Video']==1)||($_SESSION['modulos']['Módulo-PuntosBCR']==1)||
                    ($_SESSION['modulos']['Módulo-Personal']==1)||($_SESSION['modulos']['Módulo-Áreas de Apoyo']==1)){
            ?>

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
                     <li><a href="index.php?ctl=personal_listar">Personal</a></li>
                <?php }; ?>

                <?php if ($_SESSION['modulos']['Módulo-Áreas de Apoyo']==1){ ?>
                     <li><a href="index.php?ctl=areas_apoyo_listar">Áreas de Apoyo</a></li>
                <?php }; ?>  

                 <?php if ($_SESSION['modulos']['Módulo-Control de Video']==1){?>
                    <!--<li><a href="#">Controles de Video</a></li>--> 
               <?php }; ?>   

            </ul>
            </li>

          <?php 
          };
          ?>
            
            
               <?php 
            //************************************************Pinta Menu de Ayuda***************************************************************
            if (($_SESSION['modulos']['Ayuda']==1)){
            ?>
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Ayuda
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <!--<li><a href="#">Ayuda</a></li>--> 
            </ul>
            </li>
           <?php 
           };
           ?>       
           </ul>  



          <ul class="nav navbar-nav navbar-right">
              
            <?php 
            //************************************************Pinta Menu de Otros enlaces***************************************************************
            if (($_SESSION['modulos']['Controles de Video']==1)||($_SESSION['modulos']['Oficiales']==1)||
                   ($_SESSION['modulos']['Padrón Fotográfico']==1)||($_SESSION['modulos']['Personal Externo']==1)){
            ?>

            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Otros Enlaces
            <span class="caret"></span></a>
            <ul class="dropdown-menu">

                <?php if ($_SESSION['modulos']['Controles de Video']==1){ ?>
                    <li><a href="http://10.170.5.80/Operaciones_de_Seguridad/ctrlvideo/consulta.html">Controles de Video</a></li>
                <?php }; ?>

                <?php if ($_SESSION['modulos']['Oficiales']==1){ ?>
                    <li><a href="http://10.170.5.80/Operaciones_de_Seguridad">Oficiales</a></li>
                <?php }; ?>

                <?php if ($_SESSION['modulos']['Padrón Fotográfico']==1){ ?>
                    <li><a href="http://10.170.5.80/Operaciones_de_Seguridad/oficinas/consultaofic.htm">Padrón Fotográfico</a></li>
                <?php }; ?>   

                 <?php if ($_SESSION['modulos']['Personal Externo']==1){ ?>
                    <li><a href="http://10.170.5.80/Operaciones_de_Seguridad/externos/index.php">Personal Externo</a></li> 
                <?php }; ?>   

            </ul>
            </li>

          <?php 
          };
          ?>
            
            <li><a href="index.php?ctl=principal"><span class="glyphicon glyphicon-th-large"></span><?php echo $_SESSION['name']." ".$_SESSION['apellido'];?></a></li>
          <li><a href="index.php?ctl=cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Cerrar Sesión</a></li>    
        </ul>

      </div>
    </nav>
</html>

