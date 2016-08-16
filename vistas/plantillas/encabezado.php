      <?php 

      function encuentra_coincidencia($modulo){
          
      $obj_mod= new cls_modulos();
      $obj_mod->obtiene_lista_de_modulos_por_rol($_SESSION['rol']);
      $lista_modulos_por_usuario=$obj_mod->getArreglo();
          
      //echo "<pre>";
      //print_r($lista_modulos_por_usuario);
      //echo "</pre>";
         
          for ($index = 0; $index < count($lista_modulos_por_usuario); $index++) {
              if ($lista_modulos_por_usuario[$index]["Descripcion"]===$modulo){
                 
                  return true;
              }
          }
          return false;
      }
      
      ?>
    

<html lang="en">
    <br>
     <center><img src="vistas/Imagenes/Banner_Centro_de_Control.jpg" alt=""/></center>
    
<nav class="navbar navbar-default" >
  <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php?ctl=principal">Jefatura Seguridad</a>
    </div>
      <ul class="nav navbar-nav">
            
      <?php 
      //************************************************Pinta Menu de Seguridad***************************************************************
       if ((encuentra_coincidencia("Seguridad-Módulos"))||(encuentra_coincidencia("Seguridad-Roles"))||(encuentra_coincidencia("Seguridad-Usuarios"))||(encuentra_coincidencia("Seguridad-Trazabilidad"))){
      ?>
           
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Seguridad
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
      
       <?php 
       if ((encuentra_coincidencia("Seguridad-Módulos"))){
       ?>
            <li><a href="index.php?ctl=modulos_listar">Módulos</a></li>
       <?php 
       };
       ?>
            
       <?php 
       if ((encuentra_coincidencia("Seguridad-Roles"))){
       ?>
            <li><a href="index.php?ctl=listar_roles">Roles</a></li>
       <?php 
       };
       ?>
       
       <?php 
       if ((encuentra_coincidencia("Seguridad-Usuarios"))){
       ?>
            <li><a href="index.php?ctl=listar_usuarios">Usuarios</a></li>
       <?php 
       };
       ?>   
       
        <?php 
       if ((encuentra_coincidencia("Seguridad-Trazabilidad"))){
       ?>
           <li><a href="index.php?ctl=principal">Trazabilidad</a></li> 
       <?php 
       };
       ?>   
            
        </ul>
        </li>
      
      <?php 
      };
      ?>
      
      
        
       <?php 
       //************************************************Pinta Menu de Catalogos***************************************************************
       if ((encuentra_coincidencia("Catálogos-Sitios BCR"))||(encuentra_coincidencia("Catálogos-Personal"))||(encuentra_coincidencia("Catálogos-Áreas de Apoyo"))||(encuentra_coincidencia("Catálogos-Empresas"))){
      ?>
           
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Catálogos
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
      
       <?php 
       if ((encuentra_coincidencia("Catálogos-Sitios BCR"))){
       ?>
            <li><a href="index.php?ctl=puntos_bcr_listar">Sitios BCR</a></li>
       <?php 
       };
       ?>
            
       <?php 
       if ((encuentra_coincidencia("Catálogos-Personal"))){
       ?>
            <li><a href="index.php?ctl=personal_listar">Personal</a></li>
       <?php 
       };
       ?>
       
       <?php 
       if ((encuentra_coincidencia("Catálogos-Áreas de Apoyo"))){
       ?>
            <li><a href="index.php?ctl=areas_apoyo_listar">Áreas de Apoyo</a></li>
       <?php 
       };
       ?>   
       
        <?php 
       if ((encuentra_coincidencia("Catálogos-Empresas"))){
       ?>
           <li><a href="index.php?ctl=empresas_listar">Empresas</a></li> 
           <li><a href="index.php?ctl=tipo_eventos_listar">Tipo Evento</a></li>
       <?php 
       };
       ?>   
            
        </ul>
        </li>
      
      <?php 
      };
      ?>
      
        
       <?php 
       
       //************************************************Pinta Menu de Reportes***************************************************************
       if ((encuentra_coincidencia("Reportes-Eventos"))||(encuentra_coincidencia("Reportes-Oficinas"))||(encuentra_coincidencia("Reportes-Personal"))||(encuentra_coincidencia("Reportes-Alertas"))){
      ?>
           
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
      
       <?php 
       if ((encuentra_coincidencia("Reportes-Eventos"))){
       ?>
            <li><a href="index.php?ctl=principal">Eventos</a></li>
       <?php 
       };
       ?>
            
       <?php 
       if ((encuentra_coincidencia("Reportes-Oficinas"))){
       ?>
            <li><a href="index.php?ctl=principal">Oficinas</a></li>
       <?php 
       };
       ?>
       
       <?php 
       if ((encuentra_coincidencia("Reportes-Personal"))){
       ?>
            <li><a href="index.php?ctl=principal">Personal</a></li>
       <?php 
       };
       ?>   
       
        <?php 
       if ((encuentra_coincidencia("Reportes-Alertas"))){
       ?>
           <li><a href="index.php?ctl=principal">Alertas</a></li> 
       <?php 
       };
       ?>   
           
        <?php 
       if ((encuentra_coincidencia("Reportes-Trazabilidad"))){
       ?>
           <li><a href="index.php?ctl=frm_trazabilidad_listar">Trazabilidad</a></li> 
       <?php 
       };
       ?>   
            
        </ul>
        </li>
      
      <?php 
      };
      ?>
     
      
        <?php 
       
       //************************************************Pinta Menu de Módulos***************************************************************
      if ((encuentra_coincidencia("Módulos-Bitácora Digital"))||(encuentra_coincidencia("Módulos-MPI BCR"))||(encuentra_coincidencia("Módulos-Guía de Monitoreo"))||(encuentra_coincidencia("Módulos-Controles de Video"))){
      ?>
           
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Módulos
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
      
       <?php 
       if ((encuentra_coincidencia("Módulos-Bitácora Digital"))){
       ?>
            <li><a href="index.php?ctl=frm_eventos_listar">Bitácora Digital</a></li>
       <?php 
       };
       ?>
            
       <?php 
       if ((encuentra_coincidencia("Módulos-MRI BCR"))){
       ?>
            <li><a href="#">MRI-BCR</a></li>
       <?php 
       };
       ?>
       
       <?php 
       if ((encuentra_coincidencia("Módulos-Guía de Monitoreo"))){
       ?>
            <li><a href="#">Guía de Monitoreo</a></li>
       <?php 
       };
       ?>   
       
        <?php 
       if ((encuentra_coincidencia("Módulos-Controles de Video"))){
       ?>
           <li><a href="#">Controles de Video</a></li> 
      <?php 
       };
       ?>   
            
        </ul>
        </li>
      
      <?php 
      };
      ?>
           <?php 
      //************************************************Pinta Menu de Ayuda***************************************************************
       if ((encuentra_coincidencia("Ayuda"))){
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
      //************************************************Pinta Menu de Módulo de Controles de Video***************************************************************
       if ((encuentra_coincidencia("Controles de Video"))){
       ?>
      
         <li><a href="http://10.170.5.80/Operaciones_de_Seguridad/ctrlvideo/consulta.html"><span class="glyphicon glyphicon-eye-open"></span> Controles de Video</a></li>
      
       <?php 
       };
       ?>       
         
              <?php 
      //************************************************Pinta Menu de Oficiales***************************************************************
       if ((encuentra_coincidencia("Oficiales"))){
       ?>
      
         <li><a href="http://10.170.5.80/Operaciones_de_Seguridad"><span class="glyphicon glyphicon-user"></span> Oficiales</a></li>
      
       <?php 
       };
       ?>       
         
         
               <?php 
      //************************************************Pinta Menu de Padrón Fotográfico***************************************************************
       if ((encuentra_coincidencia("Padrón Fotográfico"))){
       ?>
      
         <li><a href="http://10.170.5.80/Operaciones_de_Seguridad/oficinas/consultaofic.htm"><span class="glyphicon glyphicon-picture"></span> Padrón</a></li>
      
       <?php 
       };
       ?>       
         
                 <?php 
      //************************************************Pinta Menu de Personal Externo***************************************************************
       if ((encuentra_coincidencia("Personal Externo"))){
       ?>
      
         <li><a href="http://10.170.5.80/Operaciones_de_Seguridad/externos/index.php"><span class="glyphicon glyphicon-user"></span> Personal Externo</a></li>
      
       <?php 
       };
       ?>       
         
      <li><a href="index.php?ctl=cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Cerrar Sesión</a></li>    
    </ul>
        
  </div>
</nav>


</html>

