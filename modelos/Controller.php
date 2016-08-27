<?php

 class Controller{
    /*Inicio del sitio web, llamada a la pantalla principal para inicio de sesion*/
    public function inicio(){
        $tipo_de_alerta="alert alert-info";
        $validacion="Verificación de Identidad";
        require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
    }

    //////////////////////////
    /*Metodos relacionados del area de Modulos de Seguridad del Sistema*/
    //////////////////////////
     
    // Obtiene lista completa de roles del sistema
    public function listar_roles(){
        if(isset($_SESSION['nombre'])){
            $obj_roles= new cls_roles();
            $obj_roles->obtiene_todos_los_roles();
            $params = $obj_roles->getArreglo();
            require __DIR__.'/../vistas/plantillas/lista_de_roles.php';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }    
     
    // Obtiene lista completa de roles del sistema
    public function principal(){
        if(isset($_SESSION['nombre'])){
            require __DIR__ . '/../vistas/plantillas/frm_principal.php';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }    
     
    // Prepara las variables y el formulario respectivo para cambio de clave
    public function cambiar_password(){   
        $usuario = "";       
        $clave = "";  
        $tipo_de_alerta="alert alert-info";
        $validacion="En proceso de cambio de clave";
        require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
    }
    
        
    public function cambia_clave_usuario_post(){
        $usuario = "";       
        $clave = "";  
        $tipo_de_alerta="alert alert-info";
        $validacion="En proceso de cambio de clave";

        $obj_usuarios= new cls_usuarios();         
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['usu'];
            $clave= $_POST['password_antiguo'];
            $clave_nueva=$_POST['password_nuevo'];
            $confirmacion_clave=$_POST['confirmacion_password'];
           
            if (strlen($usuario)>0){
                if ($obj_usuarios->existe_usuario($usuario)){
                    if ($obj_usuarios->valida_password_de_usuario($usuario, $clave)){
                        if ($obj_usuarios->el_usuario_esta_activo($usuario, $clave)){
                            if ((strlen($clave_nueva)>0) && (strlen($confirmacion_clave)>0)){
                                if ($clave_nueva===$confirmacion_clave){
                                    if ($clave_nueva!=$clave){
                                        $_SESSION['nombre']=$usuario;
                                        $obj_usuarios->obtiene_rol_nombre_apellido_de_usuario($usuario);
                                        $_SESSION['rol']=$obj_usuarios->getRol();
                                        $_SESSION['name']=$obj_usuarios->getNombre();
                                        $_SESSION['apellido']=$obj_usuarios->getApellido();
                                        $_SESSION['id']=$obj_usuarios->getId();
                                        $obj_usuarios->setNombre($usuario);
                                        $obj_usuarios->setClave($clave_nueva);
                                        $obj_usuarios->edita_passsword();
                                        
                                        require __DIR__ . '/../vistas/plantillas/frm_principal.php';

                                    }else{
                                        $validacion="La nueva contraseña debe ser diferente a la contraseña actual. Proceda a revisar.";
                                        $tipo_de_alerta="alert alert-danger";
                                        require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                                    }
                                    }else{
                                        $validacion="La nueva contraseña y confirmación no coinciden. Proceda a revisar.";
                                        $tipo_de_alerta="alert alert-danger";
                                        require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                                    }
                                   
                                }else{
                                    $validacion="Recuerde que los espacios para nueva clave y confirmación, no pueden quedar vacíos";
                                    $tipo_de_alerta="alert alert-danger";
                                    require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                                }
                            }else{
                                $validacion="Usuario Inactivo, contacte al administrador del sistema!!!";
                                $tipo_de_alerta="alert alert-danger";
                                require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                            }
                        }else{
                            $validacion="La Contraseña actual del usuario no es correcta";
                            $tipo_de_alerta="alert alert-danger";
                            $clave="";
                            require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                        }
                    }else{
                        $validacion="El usuario no se encuentra registrado en la base de datos";
                        $tipo_de_alerta="alert alert-danger";
                        $usuario="";
                        $clave="";
                        require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
                    }
                }else {
                    $tipo_de_alerta="alert alert-danger";
                    $validacion="Debe completar el espacio de usuario para poder continuar con el proceso";
                    $usuario="";
                    $clave="";
                    require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
                }
            }else {
                $tipo_de_alerta="alert alert-danger";
                $validacion="Es necesario completar la infornación requerida para cambiar la contraseña";
                require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
            }
    }  
     
     // Cambia estado del rol (activo/inactivo)
    public function cambiar_estado_rol(){
        if(isset($_SESSION['nombre'])){
            if (isset($_GET['id'])) {
                if (isset($_GET['estado'])) {
                    $obj_roles=new cls_roles();
                    $obj_roles->setId($_GET['id']);
                    $obj_roles->setEstado($_GET['estado']);
                    $obj_roles->edita_estado_rol();
                    
                    //$obj_roles->desactivar_usuario_rol_inactivo();
                    $obj_roles=new cls_roles();
                    $obj_roles->obtiene_todos_los_roles();
                    $params= $obj_roles->getArreglo();
                    
                    require __DIR__ . '/../vistas/plantillas/lista_de_roles.php';
                }
             }
               
      }else{
          $tipo_de_alerta="alert alert-warning";
          $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
          require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
      }
    }

    // Metodo que permite cerrar o destruir la sesión actual de usuario, para poder 
     //validar nuevamente el ingreso y validacion de usuario
    public function cerrar_sesion(){
       //Envia un tipo de alerta de información, indicando que el sistema cerró la sesion actual
       $tipo_de_alerta="alert alert-info";
       $validacion="Verificación de Identidad";
       require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
       session_destroy();
     }
    
    public function nota_obtener() {
        if(isset($_SESSION['nombre'])){
            $obj_general = new cls_general();
            $obj_general->obtener_notas();
            $notas= $obj_general->getArreglo(); 
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    public function nota_guardar() {
        if(isset($_SESSION['nombre'])){
            $obj_general = new cls_general();
            $obj_general->setId($_POST['id']);
            $obj_general->setNota($_POST['nota']);
            $obj_general->guardar_nota();            
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }    
    }
    public function guardar_modulo_rol($id_Rol){
        if(isset($_SESSION['nombre'])){
            if (isset($_POST["lista"])){
                $listaModulos = $_POST["lista"];
                $obj_roles = new cls_roles();
                if($id_Rol!=0){
                    $obj_roles->insertar_rolesModulo($id_Rol,$listaModulos);
                }   else{
                    echo ($id_Rol).'No se ingresaron los modulos';
                    }
            }
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    // Guarda un nuevo Rol del sistema
    public function guardar_rol(){         
        if(isset($_SESSION['nombre'])){
           if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_roles=new cls_roles();
                $obj_roles->setDescripcion($_POST['descripcion']);
                $obj_roles->setEstado($_POST['estado']);
              
                if ($_GET['id']==0){
                    $obj_roles->obtiene_todos_los_roles();
                    $validacion = $obj_roles->getArreglo();
                    $tam = count($validacion);
                    $correcto=0;
                    for($i=0; $i<$tam;$i++){
                        if($_POST['descripcion']==$validacion[$i]['Descripcion']){
                        $correcto=1;
                        echo '<script>alert("Este Rol ya se encuentra registrado en el sistema");</script>';
                        }
                    }
                    if($correcto==0){
                        $obj_roles->inserta_rol();
                        $obj_roles->obtiene_id_ultimo_rol_ingresado();
                        $id_ult_rol=$obj_roles->getId_ultimo_rol_ingresado();
                        $this->guardar_modulo_rol($id_ult_rol);
                    }   else    {
                        $this->gestion_roles();
                    }
                }   else    {
                    $obj_roles->setId($_GET['id']);
                    $obj_roles->edita_rol();
                    $this->guardar_modulo_rol($_GET['id']);
                }
                $obj_roles->obtiene_todos_los_roles();
                $params = $obj_roles->getArreglo();
        }
       
        require __DIR__ . '/../vistas/plantillas/lista_de_roles.php';
               
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    public function gestion_roles(){
        if(isset($_SESSION['nombre'])){
            if ($_GET['id']==0){
                $desc="";
                $esta=1;
                $ide=$_GET['id'];
                $lista= array();
            }   else   {
                $ide=$_GET['id'];
                $desc=$_GET['descripcion'];
                $esta=$_GET['estado']; 
            
                $obj_roles= new cls_roles();
                $obj_roles->obtiene_todos_los_modulos_por_rol($ide);
                $lista= $obj_roles->getArreglo();
            }
            $obj_modulos=new cls_modulos();
            $obj_modulos->setCondicion("Estado=1");
            $obj_modulos->obtiene_todos_los_modulos();
            $params= $obj_modulos->getArreglo();
            require __DIR__ . '/../vistas/plantillas/gestion_roles.php';
               
        }   else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }     
     //Trae la lista completa de modulos del sistema
    public function modulos_listar(){      
        if(isset($_SESSION['nombre'])){
            $obj_modulos=new cls_modulos();
            $obj_modulos->obtiene_todos_los_modulos();
            $params= $obj_modulos->getArreglo();
            require __DIR__ . '/../vistas/plantillas/lista_de_modulos.php';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
     
    //Ingresa un nuevo módulo de seguridad en la base de datos
    public function modulos_guardar(){
        if(isset($_SESSION['nombre'])){   
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_modulos=new cls_modulos();
                $obj_modulos->setDescripcion($_POST['descripcion']);
                $obj_modulos->setEstado($_POST['estado']);
              
                if ($_GET['id']==0){
                    $obj_modulos->obtiene_todos_los_modulos();
                    $validacion= $obj_modulos->getArreglo();
                    $tam = count($validacion);
                    $correcto=0;
                    for($i=0; $i<$tam;$i++){
                        if($_POST['descripcion']==$validacion[$i]['Descripcion']){
                        $correcto=1;
                        echo '<script>alert("Este Modulo ya se encuentra registrado en el sistema");</script>';
                        }
                    }
                    if($correcto==0){
                    $obj_modulos->inserta_modulo();
                    }   else    {
                        $this->modulos_gestion();
                    }
                }   else   {
                    $obj_modulos->setId($_GET['id']);
                    $obj_modulos->edita_modulo();
                }
                $obj_modulos->obtiene_todos_los_modulos();
                $params= $obj_modulos->getArreglo();
            }
            require __DIR__ . '/../vistas/plantillas/lista_de_modulos.php';
        }   else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    public function modulos_cambiar_estado(){
        if(isset($_SESSION['nombre'])){
            if (isset($_GET['id'])) {
                if (isset($_GET['estado'])) { 
                    $obj_modulos=new cls_modulos();
                    $obj_modulos->setId($_GET['id']);
                    $obj_modulos->setEstado($_GET['estado']);
                    $obj_modulos->edita_estado_modulo();
              
                    $obj_modulos=new cls_modulos();
                    $obj_modulos->obtiene_todos_los_modulos();
                    $params= $obj_modulos->getArreglo();
                    $obj_modulos->eliminar_modulos_roles($_GET['id']);
                require __DIR__ . '/../vistas/plantillas/lista_de_modulos.php';
                }
            }
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    public function modulos_gestion(){
        if(isset($_SESSION['nombre'])){
            if ($_GET['id']==0){
                $desc="";
                $esta=1;
                $ide=$_GET['id'];
            }   else   {
                $ide=$_GET['id'];
                $desc=$_GET['descripcion'];
                $esta=$_GET['estado'];
            }
            require __DIR__ . '/../vistas/plantillas/gestion_modulos.php';
        }   else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function listar_usuarios(){
        if(isset($_SESSION['nombre'])){
            $obj_usuarios= new cls_usuarios();
            $obj_usuarios ->obtiene_todos_los_usuarios();
            $params= $obj_usuarios->getArreglo();
            require __DIR__.'/../vistas/plantillas/lista_de_usuarios.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    public function gestion_usuarios(){
        if(isset($_SESSION['nombre'])){
            $params="";
            $obj_roles= new cls_roles();
            $obj_roles->setCondicion("Estado=1");
            $obj_roles->obtiene_todos_los_roles();
            $roles = $obj_roles->getArreglo();
            
            if ($_GET['id']==0){
                $ide=0;
                $params[0]['Nombre']="";
                $params[0]['Apellido']="";
                $params[0]['Cedula']="";
                $params[0]['Correo']="";
                $params[0]['Rol']="";
                $params[0]['Observaciones']="";
                $params[0]['Estado']="1";

            }
            if($_GET['id']==-1){
                $ide=0;
                $params[0]['Nombre']=$_POST['Nombre'];
                $params[0]['Apellido']=$_POST['Apellido'];
                $params[0]['Cedula']=$_POST['Cedula'];
                $params[0]['Correo']=$_POST['Correo'];
                $params[0]['Rol']="";
                $params[0]['Observaciones']=$_POST['Observaciones'];
                $params[0]['Estado']="1";
            }
            else    {
                $ide=$_GET['id'];
                $obj_usuario = new cls_usuarios();
                $obj_usuario->setCondicion("ID_Usuario=$ide");
                $obj_usuario->obtiene_todos_los_usuarios();
                $params= $obj_usuario->getArreglo();
            }

            require __DIR__ . '/../vistas/plantillas/gestion_usuarios.php';
        }   else   {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    public function guardar_usuario(){
        if(isset($_SESSION['nombre'])){
            $obj_usuarios= new cls_usuarios();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Validar información 
                $obj_usuarios->setCondicion("ID_Usuario<>".$_GET['id']);
                $obj_usuarios->obtiene_todos_los_usuarios();
                $validacion = $obj_usuarios->getArreglo();
                $tam = count($validacion);
                $correcto=0;
                    for($i=0; $i<$tam;$i++){
                        if($_POST['Cedula']==$validacion[$i]['Cedula']){
                            $correcto=1;
                            echo '<script>alert("Esta Cedula ya se encuentra registrada en el sistema");</script>';
                            $_POST['Cedula']="";
                            $_GET['id']=-1;
                        }
                        if($_POST['Correo']==$validacion[$i]['Correo']){
                            $correcto=1;
                            echo '<script>alert("Este correo ya se encuentra registrado en el sistema");</script>';
                            $_POST['Correo']="";
                            $_GET['id']=-1;
                        }
                    }
                if($correcto==0){
                    $obj_usuarios->setId($_GET['id']);
                    $obj_usuarios->setNombre($_POST['Nombre']);
                    $obj_usuarios->setApellido($_POST['Apellido']);
                    $obj_usuarios->setCedula($_POST['Cedula']);
                    $obj_usuarios->setCorreo($_POST['Correo']);
                    $obj_usuarios->setObservaciones($_POST['Observaciones']);
                    $obj_usuarios->setRol($_POST['Rol']);
                    $obj_usuarios->setEstado($_POST['Estado']);
                    $obj_usuarios->guardar_usuario();
                    $obj_usuarios->obtiene_todos_los_usuarios();
                    $params = $obj_usuarios->getArreglo();
                    $this->listar_usuarios();
                 }   else    {
                    $this->gestion_usuarios();
                }
            }
            
        } else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    public function cambiar_estado_usuario(){
        $obj_roles= new cls_roles();
        $obj_usuario= new cls_usuarios(); 
        if(isset($_SESSION['nombre'])){
             
            if (isset($_GET['id'])) {
                if (isset($_GET['estado'])){
                    $obj_roles->setCondicion("ID_Rol=".$_GET['rol']);
                    $obj_roles->obtiene_todos_los_roles();
                    $rolusuario=($obj_roles->getArreglo());
                    if($rolusuario[0]['Estado']==1){
                        $obj_usuario->setId($_GET['id']);
                        $obj_usuario->setEstado($_GET['estado']);
                        $obj_usuario->edita_estado_usuario();
                        $obj_usuario->obtiene_todos_los_usuarios();
                        $params= $obj_usuario->getArreglo();
                    }
                    else{
                        echo '<script>alert("Rol Desactivado");</script>';
                        $obj_usuario->obtiene_todos_los_usuarios();
                        $params= $obj_usuario->getArreglo();
                    }
                require __DIR__ . '/../vistas/plantillas/lista_de_usuarios.php';
                }
            }    
        }else   {
            $tipo_de_alerta="alert alert-danger";
            $validacion="Es necesario iniciar sesión para ingresar al sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    public function reset_password(){ 
        if(isset($_SESSION['nombre'])){
            if (isset($_GET['id'])) {
                $obj_usuario= new cls_usuarios();
                $obj_usuario->setId($_GET['id']);
                $obj_usuario->setClave($_GET['cedula']);
                $obj_usuario->reset_password_usuario();
                $obj_usuario->obtiene_todos_los_usuarios();
                $params= $obj_usuario->getArreglo();
                
                require __DIR__ . '/../vistas/plantillas/lista_de_usuarios.php';
            }
        }
        else{
            $tipo_de_alerta="alert alert-danger";
            $validacion="Es necesario iniciar sesión para ingresar al sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    public function recordar_password(){
        $validacion="";
        $obj_usuarios= new cls_usuarios();
        $obj_correo=new Mail_Provider();
         
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
             $usuario = $_GET['nom'];
                   
             if ($obj_usuarios->existe_usuario($usuario)){
                    $obj_usuarios->obtiene_correo_y_password_de_usuario($usuario);   
                    $correo=$obj_usuarios->getCorreo();
                    $pass=$obj_usuarios->getClave();
                    
                    $obj_correo->agregar_asunto_de_correo("Recordatorio Clave Sistema Oriel");
                    $obj_correo->agregar_detalle_de_correo("Este es un mensaje automático, favor no responderlo.</br> Su clave del sistema Oriel es: ".$pass);
                    $obj_correo->agregar_direccion_de_correo($correo, $usuario);
                    $obj_correo->enviar_correo();
                    $tipo_de_alerta="alert alert-info";
                    $validacion="Se ha enviado un recordatorio de password a su correo electrónico";  
                    require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
             }else
                 {
                    $tipo_de_alerta="alert alert-danger";
                    $validacion="Debe digitar un nombre de usuario válido para recordar el password";  
                    require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
                 }
        }
    }
    
    public function listar(){
        $validacion="";
        $obj_usuarios= new cls_usuarios();
         
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['nombre'];
            $clave= $_POST['password'];
        
            if ($obj_usuarios->existe_usuario($usuario)){
                if ($obj_usuarios->valida_password_de_usuario($usuario, $clave)){
                    if ($obj_usuarios->el_usuario_esta_activo($usuario, $clave)){        
                        if (!$obj_usuarios->tiene_clave_por_defecto($usuario,$clave)){
                            $obj_usuarios->obtiene_todos_los_usuarios();
                            $params=$obj_usuarios->getArreglo();
                            $_SESSION['nombre']=$usuario;
                            $obj_usuarios->obtiene_rol_nombre_apellido_de_usuario($usuario);
                            $_SESSION['rol']=$obj_usuarios->getRol();
                            $_SESSION['name']=$obj_usuarios->getNombre();
                            $_SESSION['apellido']=$obj_usuarios->getApellido();
                            $_SESSION['id']=$obj_usuarios->getId();
                            require __DIR__ . '/../vistas/plantillas/frm_principal.php';
   
                        }else{
                            $tipo_de_alerta="alert alert-info";
                            $validacion="Es necesario cambiar su clave para poder ingresar al sistema";   
                            require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
                        }
                        
                    }else{
                        $validacion="Usuario Inactivo, contacte al administrador del sistema!!!";
                        $tipo_de_alerta="alert alert-danger";
                        require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
                    }
                      
                }else {
                    $validacion="Contraseña Incorrecta, vuelva a intentarlo";
                    $tipo_de_alerta="alert alert-danger";
                    require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
                }
            }    
            else{
                $validacion="El usuario no se encuentra registrado en la base de datos";
                $tipo_de_alerta="alert alert-danger";
                require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }
        }else
        {
            $tipo_de_alerta="alert alert-danger";
            $validacion="Es necesario iniciar sesión para ingresar al sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    public function iniciar_sistema_cambiando_clave(){
        $validacion="";
        $obj_usuarios= new cls_usuarios();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['nombre'];
            $clave= $_POST['password'];
            if ($obj_usuarios->existe_usuario($usuario)){
                if ($obj_usuarios->valida_password_de_usuario($usuario, $clave)){
                    if ($obj_usuarios->el_usuario_esta_activo($usuario, $clave)){
                        $obj_usuarios->obtiene_todos_los_usuarios();
                        $params=$obj_usuarios->getArreglo();
                        $_SESSION['nombre']=$usuario;
                        $obj_usuarios->obtiene_rol_nombre_apellido_de_usuario($usuario);
                        $_SESSION['rol']=$obj_usuarios->getRol();
                        $_SESSION['name']=$obj_usuarios->getNombre();
                        $_SESSION['apellido']=$obj_usuarios->getApellido();
                        $_SESSION['id']=$obj_usuarios->getId();
                        require __DIR__ . '/../vistas/plantillas/frm_principal.php';
                    }   else{
                        $validacion="Usuario Inactivo, contacte al administrador del sistema!!!";
                        $tipo_de_alerta="alert alert-danger";
                        require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
                    }
                      
                }   else   {
                    $validacion="Contraseña Incorrecta, vuelva a intentarlo";
                    $tipo_de_alerta="alert alert-danger";
                    require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
                }
            }    else   {
                $validacion="El usuario no se encuentra registrado en la base de datos";
                $tipo_de_alerta="alert alert-danger";
                require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }

        }   else   {
            $tipo_de_alerta="alert alert-danger";
            $validacion="Es necesario iniciar sesión para ingresar al sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }

    }
    //FUNCIONES PARA EVENTOS
    public function frm_eventos_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_eventos = new cls_eventos();
            $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5");
            $obj_eventos ->obtiene_todos_los_eventos(); 
            $params= $obj_eventos->getArreglo();
            
            //Implementación para obtener el último seguimiento de cada evento, además del último usuario que lo agregó
            
        $tam=count($params);
        if (count($params)>0){
                        
            for ($i = 0; $i <$tam; $i++) {
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$i]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc limit 0,1");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();
                $ultimo_seguimiento_asociado= $obj_eventos->getArreglo();
                
                
                //Verifica si existen seguimientos asociados al evento actual
                if(count($ultimo_seguimiento_asociado)>0){
                    if ($i==0){
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]);
//                     
                    }else{
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]));
//                      
                    }
                }else{
                    if ($i==0){
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']]);
                    }else{
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']]));
                    }
                }
            }
//            echo '<pre>';
//            print_r($detalle_y_ultimo_usuario);
//            echo '</pre>';
        } 
       
        require __DIR__.'/../vistas/plantillas/frm_eventos_listar.php';
        
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function frm_eventos_lista_cerrados(){
        if(isset($_SESSION['nombre'])){
            $obj_eventos = new cls_eventos();
            $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento=3 OR T_Evento.ID_EstadoEvento=5");
            $obj_eventos ->obtiene_todos_los_eventos(); 
            $params= $obj_eventos->getArreglo();
            require __DIR__.'/../vistas/plantillas/frm_eventos_lista_cerrados.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function frm_eventos_agregar(){
        try {
            if(isset($_SESSION['nombre'])){
                $params="";
                //Vector que almacena la lista completa de tipos de evento para cargarla en el dropdownlistbox correspondiente
                $lista_tipos_de_eventos="";
                //Vector que almacena la lista completa de provincias para cargarla en el dropdownlistbox correspondiente
                $lista_provincias="";
                //Vector que almacena la lista completa de tipos de puntos bcr para cargarla en el dropdownlistbox correspondiente
                $lista_tipos_de_puntos_bcr="";
                
                if ($_GET['id']==0){
                  
                    $ide=0;
                    
                    //Crea objeto de tipo eventos para cargar las listas correspondientes
                    $obj_eventos = new cls_eventos();
                    $params[0]['Nombre']=null;
                    //Obtiene todos los tipos de eventos que se encuentran activos en la base de datos
                    $obj_eventos->obtener_todos_los_tipos_eventos();
                    $lista_tipos_de_eventos=$obj_eventos->getArreglo();
                    
                    //Obtiene todas las provincias que se encuentran activas en la base de datos
                    $obj_eventos->obtener_todas_las_provincias();
                    $lista_provincias=$obj_eventos->getArreglo();
                    
                    //Obtiene todos lps tipos de puntos BCR que se encuentran activos en la base de datos
                    $obj_eventos->obtener_todos_los_tipos_de_puntos_BCR();
                    $lista_tipos_de_puntos_bcr=$obj_eventos->getArreglo();
                    
                    //Obtiene los diferentes seguimientos
                    $obj_eventos->obtener_seguimientos();
                    $estadoEventos = $obj_eventos->getArreglo();
                    
                    require __DIR__ . '/../vistas/plantillas/frm_eventos_agregar.php';
                    
                }else{   
                    $ide=$_GET['id'];
                    $obj_Puntobcr = new cls_puntosBCR();
                    $obj_eventos = new cls_eventos();

                    $obj_Puntobcr->setCondicion("T_PuntoBCR.ID_PuntoBCR=".$_GET['id']);
                    $obj_Puntobcr->obtiene_todos_los_puntos_bcr();
                    $params= $obj_Puntobcr->getArreglo();
                    
                    $obj_eventos->setCondicion("");
                    $obj_eventos->obtener_todos_los_tipos_eventos();
                    $lista_tipos_de_eventos=$obj_eventos->getArreglo();
                    
                    //Obtiene Distrito->Cantón->Provincia
                        //Distritos
                    $obj_Puntobcr->setCondicion("");
                    $obj_Puntobcr->obtiene_distritos();
                    $distritos = array_merge(array(['ID_Distrito'=>0]+['Nombre_Distrito'=>""]),$obj_Puntobcr->getArreglo());
                        //Cantones
                    $obj_Puntobcr->setCondicion("");
                    $obj_Puntobcr->obtiene_cantones();
                    $cantones   = array_merge(array(['ID_Canton'=>0]+['Nombre_Canton'=>""]),$obj_Puntobcr->getArreglo());
                        //Provincias
                    $obj_Puntobcr->setCondicion("");
                    $obj_Puntobcr->obtiene_provincias();
                    $lista_provincias = array_merge(array(['ID_Provincia'=>0]+['Nombre_Provincia'=>""]),$obj_Puntobcr->getArreglo());
                    
                    $obj_eventos->setCondicion("");
                    $obj_eventos->obtener_todos_los_tipos_de_puntos_BCR();
                    $lista_tipos_de_puntos_bcr=$obj_eventos->getArreglo();
                    
                    $obj_eventos->setCondicion("T_Evento.ID_PuntoBCR=".$ide);
                    $obj_eventos->obtiene_todos_los_eventos();
                    $eventos_relacionados=$obj_eventos->getArreglo();
                    
                    require __DIR__ . '/../vistas/plantillas/frm_eventos_agregar.php';
                }
                
            }else
            {
                $tipo_de_alerta="alert alert-warning";
                $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
                require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }
        }catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }  
    }
       
    public function alerta_en_vivo_mismo_punto_bcr_y_evento(){
                
        if(isset($_POST['id_punto_bcr'])&& (isset($_POST['id_tipo_evento']))){
            
            if(isset($_SESSION['nombre'])){
            $obj_eventos= new cls_eventos();
            $obj_eventos->setTipo_evento($_POST['id_tipo_evento']);
            $obj_eventos->setPunto_bcr($_POST['id_punto_bcr']);
            
                if ($obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio()){
                     echo "Ya existe este evento abierto para este punto BCR. Proceda a cerrarlo o agregue un seguimiento!!!";
                     exit;
                }else
                {
                     echo "";
                     exit;
                }
            }else {
               $tipo_de_alerta="alert alert-warning";
               $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
           }
        }else
        {
            echo "";
            exit;
        }
    }
   
    public function  actualiza_en_vivo_reporte_trazabilidad(){
                            
            if(isset($_SESSION['nombre'])){
                
                $fecha_inicial=$_POST['fecha_inicial'];
                $fecha_final=$_POST['fecha_final'];
                $usuario=$_POST['usuario'];
                $tabla_afectada=$_POST['tabla'];
                
                $condicion="t_traza.Fecha between '".$fecha_inicial."' AND '".$fecha_final."' ";
                
                if (!$usuario=="0"){
                    $condicion.="AND t_traza.ID_Usuario=".$usuario." ";
                }
                
                if ($tabla_afectada!="todas"){
                    $condicion.="AND t_traza.Tabla_Afectada='".$tabla_afectada."'";
                }
                  
                $obj_trazabilidad= new cls_trazabilidad();
                $obj_trazabilidad->setCondicion($condicion);
                $obj_trazabilidad->obtiene_trazabilidad();
                $params=$obj_trazabilidad->getArreglo();

                if (count($params)>0){
                    
                    //$html="<h2>Listado de Eventos Relacionados a este Punto BCR</h2>";
                    $html="<thead>";   
                    $html.="<tr>";
                    $html.="<th>ID_Traza</th>";
                    $html.="<th>Fecha</th>";
                    $html.="<th>Hora</th>";
                    $html.="<th>Antiguedad Dias</th>";
                    $html.="<th>Usuario</th>";
                    $html.="<th>Tabla Afectada</th>";
                    $html.="<th>Dato Actualizado</th>";
                    $html.="<th>Dato Anterior</th>";
                    $html.="</tr>";
                    $html.="</thead>";
                    
                    $html.="<tbody>";
                    $tam=count($params);

                    for ($i = 0; $i <$tam; $i++) {
           
                        $html.="<tr>";
           
                        $fecha_evento = date_create($params[$i]['Fecha']);
                        $fecha_actual = date_create(date("d-m-Y"));
                        $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            
                        $html.="<td>".$params[$i]['ID_Traza']."</td>";
                        $html.="<td>".date_format($fecha_evento, 'd/m/Y')."</td>";
                        $html.="<td>".$params[$i]['Hora']."</td>";
                        $html.="<td align='center'>".$dias_abierto->format('%a')."</td>";
                        $html.="<td>".$params[$i]['Nombre']." ".$params[$i]['Apellido']."</td>";
                        $html.="<td>".$params[$i]['Tabla_Afectada']."</td>";
                        $html.="<td>".$params[$i]['Dato_Actualizado']."</td>";
                        $html.="<td>".$params[$i]['Dato_Anterior']."</td>";
                        
                        $html.="</tr>";
                         }
            
                    $html.="</tbody>";

                    //$html.=" </table>";
                    
                    echo $html;
                    exit;
                }else{
                     $html="<h4>No se encontraron eventos para este filtro.</h4>";
                     echo $html;
                     exit;
                }    

            }else {
               $tipo_de_alerta="alert alert-warning";
               $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }
       
       
        
    }
    
    
    public function dibuja_tabla_eventos_relacionados_a_punto_bcr(){
                
       if(isset($_POST['id_punto_bcr'])){
            
            if(isset($_SESSION['nombre'])){
                $obj_eventos= new cls_eventos();
                $obj_eventos->setCondicion("T_Evento.ID_PuntoBCR=".$_POST['id_punto_bcr']." Limit 0,5");
                $obj_eventos->obtiene_todos_los_eventos();
                $params=$obj_eventos->getArreglo();

                if (count($params)>0){
                    
                    //$html="<h2>Listado de Eventos Relacionados a este Punto BCR</h2>";
                    $html="<thead>";   
                    $html.="<tr>";
                    $html.="<th align='center'>Fecha</th>";
                    $html.="<th>Hora</th>";
                    $html.="<th>Lapso</th>";
                    $html.="<th>Provincia</th>";
                    $html.="<th>Tipo Punto</th>";
                    $html.="<th>Punto BCR</th>";
                    $html.="<th>Tipo de Evento</th>";
                    $html.="<th>Estado del Evento</th>";
                    $html.="<th>Ingresado Por</th>";
                    $html.="<th>Consulta</th>";
                    $html.="</tr>";
                    $html.="</thead>";
                    
                    $html.="<tbody>";
                    $tam=count($params);

                    for ($i = 0; $i <$tam; $i++) {
           
                        $html.="<tr>";
           
                        $fecha_evento = date_create($params[$i]['Fecha']);
                        $fecha_actual = date_create(date("d-m-Y"));
                        $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            
                        $html.="<td align='center'>".date_format($fecha_evento, 'd/m/Y')."</td>";
                        $html.="<td>".$params[$i]['Hora']."</td>";
                        $html.="<td align='center'>".$dias_abierto->format('%a')."</td>";
                        $html.="<td>".$params[$i]['Nombre_Provincia']."</td>";
                        $html.="<td>".$params[$i]['Tipo_Punto']."</td>";
                        $html.="<td>".$params[$i]['Nombre']."</td>";
                        $html.="<td>".$params[$i]['Evento']."</td>";
                        $html.="<td>".$params[$i]['Estado_Evento']."</td>";
                        $html.="<td>".$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']."</td>";
                        $html.="<td align='center'><a href='index.php?ctl=frm_eventos_editar&accion=consulta_relacionados&id=".$params[$i]['ID_Evento']."'>Ver detalle</a></td>";
                        $html.="</tr>";
                         }
            
                    $html.="</tbody>";

                    //$html.=" </table>";
                    
                    echo $html;
                    exit;
                }else{
                     $html="<h4>No se encontraron eventos para este sitio.</h4>";
                     echo $html;
                     exit;
                }    

            }else {
               $tipo_de_alerta="alert alert-warning";
               $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }
        }else
        {
            echo "";
            exit;
        }
       
        
    }
    
    public function frm_eventos_recuperar(){
        if(isset($_SESSION['nombre'])){
            $obj_eventos= new cls_eventos();
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                
                $obj_eventos->setFecha(date("Y-m-d")); 
                $obj_eventos->setHora(date("H:i", time()));
                $obj_eventos->setTipo_evento($_GET['id_tipo_evento']);
                $obj_eventos->setPunto_bcr($_GET['id_puntobcr']);
                $obj_eventos->setEstado_evento("1");
                $obj_eventos->setId_usuario($_SESSION['id']);
                $obj_eventos->setEstado(1);
                //echo "1 ingresa";
                
                if (!$obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio()){
                    //$obj_eventos->ingresar_evento();
                    //echo "2 guarda evento";
                    
                    //echo 'alert("si entro")'; 
                    $obj_eventos->setDetalle("Evento re-abierto (recuperado) por ".$_SESSION['name']." ".$_SESSION['apellido']);
                    $obj_eventos->setId2(0);
                    $obj_eventos->setId($_GET['id_evento']);
                    $obj_eventos->edita_estado_evento("1");
                    $obj_eventos->ingresar_seguimiento_evento();  
                    //echo "3 guarda seguimiento";
                    echo "<script type=\"text/javascript\">alert('Evento recuperado con Éxito!!!');history.go(-1);</script>";
                    
                    header ("location:/ORIEL/index.php?ctl=frm_eventos_lista_cerrados");
                    //$this->frm_eventos_lista_cerrados();
                }else{
                    //echo '<script>alert("Ya existe este evento abierto para este punto BCR. Proceda a cerrarlo o agregue un seguimiento!!!")</script>';
                    //require __DIR__ . '/../vistas/plantillas/frm_eventos_agregar.php';
                    echo "<script type=\"text/javascript\">alert('No es posible recuperar este evento, ya existe otro evento del mismo tipo abierto para este punto BCR. Proceda a cerrarlo o agregue un seguimiento!!!');history.go(-1);</script>";
                    exit;
                     
                }
            }
        }else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function guardar_evento(){
        if(isset($_SESSION['nombre'])){
            $obj_eventos= new cls_eventos();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_eventos->setFecha($_POST['fecha']); 
                $obj_eventos->setHora($_POST['hora']);
                $obj_eventos->setTipo_evento($_POST['tipo_evento']);
                $obj_eventos->setProvincia($_POST['nombre_provincia']); 
                $obj_eventos->setTipo_punto($_POST['tipo_punto']); 
                $obj_eventos->setPunto_bcr($_POST['punto_bcr']);
                $obj_eventos->setEstado_evento($_POST['estado_evento']);
                $obj_eventos->setId_usuario($_SESSION['id']);
                $obj_eventos->setEstado(1);
                //echo "1 ingresa";
                
                if (!$obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio()){
                    $obj_eventos->ingresar_evento();
                    //echo "2 guarda evento";
                    if(isset($_POST['seguimiento'])&&($_POST['seguimiento']!="")){
                       //echo 'alert("si entro")'; 
                       $obj_eventos->setDetalle($_POST['seguimiento']);
                       $obj_eventos->setId2(0);
                       $obj_eventos->obtiene_id_ultimo_evento_ingresado(); 
                       $obj_eventos->setId($obj_eventos->getId_ultimo_evento_ingresado());
                       $obj_eventos->ingresar_seguimiento_evento();  
                       //echo "3 guarda seguimiento";
                    }
                    //$this->frm_eventos_listar();
                    header ("location:/ORIEL/index.php?ctl=frm_eventos_listar");
                }else{
                    //echo '<script>alert("Ya existe este evento abierto para este punto BCR. Proceda a cerrarlo o agregue un seguimiento!!!")</script>';
                    //require __DIR__ . '/../vistas/plantillas/frm_eventos_agregar.php';
                    echo "<script type=\"text/javascript\">alert('Ya existe este evento abierto para este punto BCR. Proceda a cerrarlo o agregue un seguimiento!!!');history.go(-1);</script>";
                    exit;
                     
                }
            }
        }else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function frm_eventos_editar(){
        if(isset($_SESSION['nombre'])){
            try {
                $ide=$_GET['id'];
                $obj_eventos = new cls_eventos();
                //Obtiene el evento que se muesta en la ventana
                $obj_eventos->setCondicion("ID_Evento=$ide");
                $obj_eventos->obtiene_todos_los_eventos();
                $params= $obj_eventos->getArreglo();
                
                if (count($params)>0){
                     $obj_eventos->setTipo_evento($params[0]['ID_Tipo_Evento']);
                     $prioridad_evento=$obj_eventos->obtiene_prioridad_de_tipo_de_evento();
                     
                }
               
                $obj_eventos->setCondicion("ID_Evento=$ide"." "."order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                //Obtiene los detalles del evento seleccionado
                $obj_eventos->obtiene_detalle_evento();
                $detalleEvento= $obj_eventos->getArreglo();
                //Obtiene los diferentes seguimientos
                $obj_eventos->obtener_seguimientos();
                $estadoEventos = $obj_eventos->getArreglo();
                
                require __DIR__ . '/../vistas/plantillas/frm_eventos_editar.php';
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        } else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function guardar_seguimiento_evento(){
        if(isset($_SESSION['nombre'])){
            $obj_eventos = new cls_eventos();
            $obj_eventos->setId($_GET['id']);
            $obj_eventos->setId2(0);
            $obj_eventos->setFecha(($_POST['Fecha']));
            $obj_eventos->setHora(($_POST['Hora']));
            $obj_eventos->setDetalle(($_POST['DetalleSeguimiento']));
            $obj_eventos->setId_usuario($_SESSION['id']);
            $obj_eventos->ingresar_seguimiento_evento();
            $obj_eventos->edita_estado_evento($_POST['estado_del_evento']);
            //$this->frm_eventos_listar();
            header ("location:/ORIEL/index.php?ctl=frm_eventos_listar");
            //actualiza Seguimiento PENDIENTE
            
        }else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    //////////////////////////
    /*Metodos relacionados del area de Tipos de Evento de Seguridad del Sistema*/
    //////////////////////////
    
    public function tipo_eventos_listar(){      
        if(isset($_SESSION['nombre'])){
            $obj_eventos=new cls_eventos();
            $obj_eventos->obtener_los_tipos_de_eventos();
            $params= $obj_eventos->getArreglo();
            require __DIR__ . '/../vistas/plantillas/frm_tipo_eventos_listar.php';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function tipo_eventos_gestion(){
        if(isset($_SESSION['nombre'])){
            if ($_GET['id']==0){
                $observaciones="";
                $estado=1;
                $ide=$_GET['id'];
                $evento="";
            }   else   {
                $ide=$_GET['id'];
                $evento=$_GET['evento'];
                $observaciones=$_GET['observaciones'];
                $prioridad = $_GET['prioridad'];
                $estado=$_GET['estado'];
            }
            require __DIR__ . '/../vistas/plantillas/frm_tipo_eventos_gestion.php';
        }   else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function tipo_eventos_guardar(){
        if(isset($_SESSION['nombre'])){
            $obj_eventos = new cls_eventos();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_eventos->setId($_GET['id']);
                $obj_eventos->setTipo_evento($_POST['evento']);
                $obj_eventos->setObservaciones($_POST['observaciones']);
                $obj_eventos->setEstado($_POST['estado']);
                $obj_eventos->setPrioridad($_POST['prioridad']);
                $obj_eventos->guardar_tipo_evento();
                $this->tipo_eventos_listar();
            }
        } else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }      
    }
    
    public function tipo_eventos_cambiar_estado() {
      if(isset($_SESSION['nombre'])){
            $obj_eventos = new cls_eventos();
            $obj_eventos->setId($_GET['id']);
            $obj_eventos->setTipo_evento($_GET['evento']);
            $obj_eventos->setObservaciones($_GET['observaciones']);
            $obj_eventos->setEstado($_GET['estado']);
            $obj_eventos->setPrioridad($_GET['prioridad']);
            $obj_eventos->guardar_tipo_evento();
            $this->tipo_eventos_listar();
        } else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function areas_apoyo_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_areasApoyo=new cls_areasapoyo();
            $obj_areasApoyo->obtiene_todos_las_areas_apoyo();
            $params= $obj_areasApoyo->getArreglo();
            require __DIR__ . '/../vistas/plantillas/frm_areas_apoyo_listar.php';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntos_bcr_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_puntosbcr=new cls_puntosBCR();
            $obj_puntosbcr->obtiene_todos_los_puntos_bcr();
            $params= $obj_puntosbcr->getArreglo();
            require __DIR__ . '/../vistas/plantillas/frm_puntos_bcr_listar.php';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    //////////////////////////
    /*Metodos relacionados del area de Empresas de Seguridad del Sistema*/
    //////////////////////////

  // Metodo que permite actualizar en tiempo real la lista de estado de evento de bitacora dependiendo
    // de la prioridad del tipo de evento y rol de usuario que esté manipulando la información
    public function actualiza_en_vivo_estado_evento(){
        
        if(isset($_SESSION['nombre'])){
        
             $obj_even = new cls_eventos();
        
             $id_tipo_evento= $_POST['id_tipo_evento'];
             
             $obj_even->setTipo_evento($id_tipo_evento);
             $prioridad_tipo_evento= $obj_even->obtiene_prioridad_de_tipo_de_evento();
             
             $obj_even->obtener_seguimientos();
             $estadoEven = $obj_even->getArreglo(); 
      
             $tam = count($estadoEven);

             for($i=0; $i<$tam;$i++){
                //if($estadoEventos[$i]['Estado_Evento']==$params[0]['Estado_Evento']){
                if ($estadoEven[$i]['Estado_Evento']!="Abierto por Error"){
                    if ($_SESSION['rol']==2){
                      if ($prioridad_tipo_evento!=1){ 
                          if ($estadoEven[$i]['Estado_Evento']!="Cerrado"){
                            $html .= '<option value="'.$estadoEven[$i]['ID_EstadoEvento'].'">'.$estadoEven[$i]['Estado_Evento'].'</option>';
                          }
                      }else{
                          if ($estadoEven[$i]['Estado_Evento']!="Solicitar Cierre"){
                            $html .= '<option value="'.$estadoEven[$i]['ID_EstadoEvento'].'">'.$estadoEven[$i]['Estado_Evento'].'</option>';
                          }                       
                      }
                    }else{
                        if ($estadoEven[$i]['Estado_Evento']!="Solicitar Cierre"){
                            $html .= '<option value="'.$estadoEven[$i]['ID_EstadoEvento'].'">'.$estadoEven[$i]['Estado_Evento'].'</option>';
                          }     
                    }
                 }      
             }
             echo $html;
             
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
       
    }
    
    public function empresas_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_empresas=new cls_empresa();
            $obj_empresas->obtiene_todas_las_empresas();
            $params= $obj_empresas->getArreglo();
            require __DIR__ . '/../vistas/plantillas/frm_empresas_listar.php';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function empresa_gestion(){
        if(isset($_SESSION['nombre'])){
            if ($_GET['id']==0){
                $observaciones="";
                $estado=1;
                $ide=$_GET['id'];
                $empresa="";
            }   else   {
                $ide=$_GET['id'];
                $observaciones=$_GET['observaciones'];
                $estado=$_GET['estado'];
                $empresa=$_GET['empresa'];
            }
            require __DIR__ . '/../vistas/plantillas/frm_empresas_editar.php';
        }   else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function empresa_guardar(){
        if(isset($_SESSION['nombre'])){
            $obj_empresas = new cls_empresa();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_empresas->setId($_GET['id']);
                $obj_empresas->setEmpresa($_POST['empresa']);
                $obj_empresas->setObservaciones($_POST['observaciones']);
                $obj_empresas->setEstado($_POST['estado']);
                $obj_empresas->guardar_empresa();
                $this->empresas_listar();
            }
            
        } else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }      
    }
    
    public function empresa_cambiar_estado() {
        if(isset($_SESSION['nombre'])){
            if (isset($_GET['id'])) {
                if (isset($_GET['estado'])) { 
                    $obj_empresas = new cls_empresa();
                    $obj_empresas->setId($_GET['id']);
                    $obj_empresas->setEmpresa($_GET['empresa']);
                    $obj_empresas->setObservaciones($_GET['observaciones']);
                    if($_GET['estado']==1){
                        $obj_empresas->setEstado("0");
                    }
                    else {
                        $obj_empresas->setEstado("1");
                    }
                    $obj_empresas->guardar_empresa();
                    $this->empresas_listar();
                }
            }
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function personal_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_personal=new cls_personal();
            $obj_personal->obtiene_todo_el_personal();
            $personas= $obj_personal->getArreglo();
            require __DIR__ . '/../vistas/plantillas/frm_personal_listar.php';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    //Editar Punto BCR, información completa 
    public function gestion_punto_bcr(){
        if(isset($_SESSION['nombre'])){
            $obj_Puntobcr = new cls_puntosBCR();
            $obj_Personal = new cls_personal();
            $obj_areasapoyo = new cls_areasapoyo();
            $obj_empresa = new cls_empresa();
            $obj_horario = new cls_horario();
            $obj_direccionIP = new cls_direccionIP();
            
            if ($_GET['id']==0){
                
                $ide=0;
                $params[0]['Codigo']="";
                $params[0]['Cuenta_SIS']="BCR-";
                $params[0]['Nombre']="";
                $params[0]['Direccion']="";
                $params[0]['Observaciones']="";
                $params[0]['Estado']=1;
                
                //Obtiene todos los tipos de puntos BCR para listarlos
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_los_tipo_puntos();
                $tipo_puntos = $obj_Puntobcr->getArreglo();
                
                //Obtiene Distrito->Cantón->Provincia
                    //Distritos
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_distritos();
                $distritos = $obj_Puntobcr->getArreglo();
                    //Cantones
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_cantones();
                $cantones = $obj_Puntobcr->getArreglo();
                    //Provincias
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_provincias();
                $provincias = $obj_Puntobcr->getArreglo();
                
                //Obtiene empresa remesera
                $obj_empresa->setCondicion("");
                $obj_empresa->obtiene_todas_las_empresas();
                $empresas= $obj_empresa->getArreglo();
                
                
                require __DIR__ . '/../vistas/plantillas/frm_puntos_bcr_nuevo.php';
            }   else   {
                
                $ide=$_GET['id'];
                //Obtiene la informacion del PuntoBCR
                $ide=$_GET['id'];
                $obj_Puntobcr->setCondicion("T_PuntoBCR.ID_PuntoBCR='".$_GET['id']."'");
                $obj_Puntobcr->obtiene_todos_los_puntos_bcr();
                $params= $obj_Puntobcr->getArreglo();
                
                //Obtiene todos los tipos de puntos BCR para listarlos
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_los_tipo_puntos();
                $tipo_puntos = $obj_Puntobcr->getArreglo();
                
                //Obtiene los telefonos del PuntoBCR
                $obj_Puntobcr->setCondicion("T_Telefono.ID='".$_GET['id']."'");
                $obj_Puntobcr->obtiene_telefonos_puntoBCR();
                $telefonos= $obj_Puntobcr->getArreglo();
                
                //Obtiene Unidades Ejecutoras asignadas al Punto BCR
                $obj_Puntobcr->setCondicion("T_UE_PuntoBCR.ID_PuntoBCR='".$_GET['id']."'");
                $obj_Puntobcr->obtiene_unidades_ejecutoras();
                $unidad_ejecutora= $obj_Puntobcr->getArreglo();
                
                //Obtiene Distrito->Cantón->Provincia
                    //Distritos
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_distritos();
                $distritos = array_merge(array(['ID_Distrito'=>0]+['Nombre_Distrito'=>""]),$obj_Puntobcr->getArreglo());
                    //Cantones
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_cantones();
                $cantones   = array_merge(array(['ID_Canton'=>0]+['Nombre_Canton'=>""]),$obj_Puntobcr->getArreglo());
                    //Provincias
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_provincias();
                $provincias = array_merge(array(['ID_Provincia'=>"0"]+['Nombre_Provincia'=>""]),$obj_Puntobcr->getArreglo());
                
                //obtiene las areas de apoyo del sitio
                $obj_areasapoyo->setCondicion("T_PuntoBCRAreaApoyo.ID_PuntoBCR='".$_GET['id']."'");
                $obj_areasapoyo->obtiene_todos_las_areas_apoyo();
                $areas_apoyo =$obj_areasapoyo->getArreglo();
                
                //Obtiene la informacion del personal
                $obj_Personal->setCondicion("");
                $condicion="";                
                $tam=count($unidad_ejecutora);
                if($tam>0){
                    for ($i = 0; $i <$tam; $i++) {
                        $condicion=$condicion."T_UnidadEjecutora.Numero_UE='".$unidad_ejecutora[$i]['Numero_UE']."'";
                        if($tam<$i)
                        {
                            $condicion=$condicion." OR ";
                        }
                    }
                    $obj_Personal->setCondicion($condicion);
                    $obj_Personal->obtiene_todo_el_personal();
                    $personal = $obj_Personal->getArreglo();
                }
                
                //Obtiene empresa remesera
                $obj_empresa->setCondicion("");
                $obj_empresa->obtiene_todas_las_empresas();
                $empresas= $obj_empresa->getArreglo();
                
                //Obtiene Horarios
                $obj_horario->setCondicion("");
                $obj_horario->obtiene_todos_los_horarios();
                $horarios= $obj_horario->getArreglo();
                
                //Obtiene Direcciones IP del sitio
                $obj_direccionIP->setCondicion("T_PuntoBCRDireccionIP.ID_PuntoBCR='".$_GET['id']."'");
                $obj_direccionIP->obtiene_direccionesIP();
                $direccionIP = $obj_direccionIP->getArreglo();
                require __DIR__ . '/../vistas/plantillas/frm_puntos_bcr_editar.php';
            }
            
        }   else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    // Metodo que permite actualizar en tiempo real la lista de cantones
    public function actualiza_en_vivo_canton(){
        if(isset($_SESSION['nombre'])){
            $obj_puntos_bcr = new cls_puntosBCR();
            $id_provincia= $_POST['id_provincia'];
            $obj_puntos_bcr->setCondicion("ID_Provincia=".$id_provincia);
            $obj_puntos_bcr->obtiene_cantones();
            $cantones=$obj_puntos_bcr->getArreglo(); 
            $tam = count($cantones);
            $html .= '<option value="0"></option>';   
            for($i=0; $i<$tam;$i++){
                $html .= '<option value="'.$cantones[$i]['ID_Canton'].'">'.$cantones[$i]['Nombre_Canton'].'</option>';            
            }        
            echo $html;
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function actualiza_en_vivo_distrito(){
        if(isset($_SESSION['nombre'])){
            $obj_puntos_bcr = new cls_puntosBCR();
            $id_canton= $_POST['id_canton'];
            $obj_puntos_bcr->setCondicion("ID_Canton=".$id_canton);
            $obj_puntos_bcr->obtiene_distritos();
            $distritos=$obj_puntos_bcr->getArreglo(); 
            $tam = count($distritos);
            
            //$html .= '<option value="0"></option>';
            for($i=0; $i<$tam;$i++){
                $html .= '<option value="'.$distritos[$i]['ID_Distrito'].'">'.$distritos[$i]['Nombre_Distrito'].'</option>';            
            }        
            echo $html;
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    // Metodo que permite actualizar en tiempo real la lista de puntos bcr
    public function actualiza_en_vivo_punto_bcr(){
        if(isset($_SESSION['nombre'])){
            
            $obj_ev =new cls_eventos();
            $id_tipo_punto_bcr= $_POST['id_tipo_punto_bcr'];
            $id_provincia= $_POST['id_provincia'];
            
            $obj_ev->setTipo_punto($id_tipo_punto_bcr);
            $obj_ev->setProvincia($id_provincia);
            
            $obj_ev->filtra_sitios_bcr_bitacora();
            $sitios=$obj_ev->getArreglo(); 
            $tam = count($sitios);
            
            for($i=0; $i<$tam;$i++){
                $html .= '<option value="'.$sitios[$i]['ID_PuntoBCR'].'">'.$sitios[$i]['Nombre'].'</option>';            
            }        
            echo $html;
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function punto_bcr_guardar() {
        if(isset($_SESSION['nombre'])){
            $obj_Puntobcr = new cls_puntosBCR();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                echo ($_GET['id']);
                $obj_Puntobcr->setId($_GET['id']);
                $obj_Puntobcr->setCodigo($_POST['Codigo']);
                $obj_Puntobcr->setCuentasis($_POST['Cuenta_SIS']);
                $obj_Puntobcr->setNombre($_POST['Nombre']);
                $obj_Puntobcr->setDireccion($_POST['Direccion']);
                $obj_Puntobcr->setObservaciones($_POST['Observaciones']);
                $obj_Puntobcr->setEstado($_POST['Estado']);
                $obj_Puntobcr->setTipo_punto($_POST['Tipo_Punto']);
                $obj_Puntobcr->setDistrito($_POST['Distrito']);
                $obj_Puntobcr->setEmpresa($_POST['Empresa']);
                $obj_Puntobcr->sethoraslaborales="1";
                
                $obj_Puntobcr->guardar_punto_bcr();

            }
           $this->puntos_bcr_listar();
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function puntobcr_desligar_telefono(){
        if(isset($_SESSION['nombre'])){
            $obj_puntosbcr = new cls_puntosBCR();
            $obj_puntosbcr->setId($_POST['id_telefono']);
            $obj_puntosbcr->setCondicion("ID='".$_POST['id_telefono']);
            $obj_puntosbcr->eliminar_telefono_puntobcr();
            
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function puntoBCR_guardar_informacion_general(){
        if(isset($_SESSION['nombre'])){
            $obj_puntobcr = new cls_puntosBCR();
            $obj_puntobcr->setCondicion("ID_PuntoBCR='".$_POST['id_puntobcr']."'");
            
            $obj_puntobcr->setCodigo($_POST['codigo']);
            $obj_puntobcr->setCuentasis($_POST['cuenta']);
            $obj_puntobcr->setNombre($_POST['nombre']);
            $obj_puntobcr->setId($_POST['tipo_punto']);
            $obj_puntobcr->actualizar_informacion_general_puntobcr();
            //echo 'Se actualizó la ubicacion del PuntoBCR';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function distrito_PuntoBCR_guardar(){
        if(isset($_SESSION['nombre'])){
            $obj_puntobcr = new cls_puntosBCR();
            $obj_puntobcr->setCondicion("ID_PuntoBCR='".$_POST['id_puntobcr']."'");
            $obj_puntobcr->setId($_POST['id_distrito']);
            $obj_puntobcr->setDireccion($_POST['direccion']);
            $obj_puntobcr->actualizar_ubicacion_puntobcr();
            //echo 'Se actualizó la informacion general del PuntoBCR';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Trazabilidad
    //FUNCIONES PARA EVENTOS

    public function frm_trazabilidad_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_traza = new cls_trazabilidad();
            $obj_traza->setCondicion("Fecha='".date("Y-m-d")."'");
            $obj_traza ->obtiene_trazabilidad(); 
            $params= $obj_traza->getArreglo();
            $obj_traza->setCondicion("");
            $obj_traza->obtiene_lista_usuarios_que_han_modificado_base_de_datos();
            $lista_de_usuarios=$obj_traza->getArreglo();
            $obj_traza->setCondicion("");
            $obj_traza->obtiene_lista_tablas_afectadas_en_el_sistema();
            $lista_tablas_afectadas=$obj_traza->getArreglo();
            require __DIR__.'/../vistas/plantillas/frm_trazabilidad_listar.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    } 
} 