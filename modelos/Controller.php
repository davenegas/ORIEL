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
                                        $obj_usuarios->setNombre($usuario);
                                        $obj_usuarios->setClave($clave_nueva);
                                        $obj_usuarios->edita_passsword();
                                        $_SESSION['nombre']=$usuario;
                                        $obj_usuarios->obtiene_rol_nombre_apellido_de_usuario($usuario);
                                        $_SESSION['rol']=$obj_usuarios->getRol();
                                        $_SESSION['name']=$obj_usuarios->getNombre();
                                        $_SESSION['apellido']=$obj_usuarios->getApellido();
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
     
    public function guardar_modulo_rol($id_Rol){
        if(isset($_SESSION['nombre'])){
            if (isset($_POST["lista"])){
                $listaModulos = $_POST["lista"];
                $obj_roles = new cls_roles();
                if($id_Rol!=0){
                    $obj_roles->insertar_rolesModulo($id_Rol,$listaModulos);
                }   else
                    echo ($id_Rol).'No se ingresaron los modulos';
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
                    $obj_roles->inserta_rol();
                    $obj_roles->obtiene_id_ultimo_rol_ingresado();
                    $id_ult_rol=$obj_roles->getId_ultimo_rol_ingresado();
                    $this->guardar_modulo_rol($id_ult_rol);
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
    public function listar_modulos(){      
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
    public function guardar_modulo(){
        if(isset($_SESSION['nombre'])){   
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_modulos=new cls_modulos();
                $obj_modulos->setDescripcion($_POST['descripcion']);
                $obj_modulos->setEstado($_POST['estado']);
              
                if ($_GET['id']==0){
                    $obj_modulos->inserta_modulo();
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
     
    public function cambiar_estado_modulo(){
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

    public function gestion_modulos(){
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
                    require __DIR__ . '/../vistas/plantillas/lista_de_usuarios.php';
                    
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
            $obj_eventos ->obtiene_todos_los_eventos(); 
            $params= $obj_eventos->getArreglo();
            require __DIR__.'/../vistas/plantillas/frm_eventos_listar.php';
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
                
                if ($_GET['id']==0){
                  
                    $obj_eventos = new cls_eventos();
                    $obj_eventos->obtener_todos_los_tipos_eventos();
                    $lista_tipos_de_eventos=$obj_eventos->getArreglo();
                    //print_r($lista_tipos_de_eventos);
                    $ide=0;
                    $params[0]['Fecha']="";
                    $params[0]['Hora']="";
                    $params[0]['Nombre_Provincia']="";
                    $params[0]['Tipo_Punto']="";
                    $params[0]['Nombre']="";
                    $params[0]['Evento']="";
                    $params[0]['Seguimiento']="1";
                    require __DIR__ . '/../vistas/plantillas/frm_eventos_agregar.php';
                }else{             
                    $ide=$_GET['id'];
                    $obj_eventos = new cls_eventos();
                    $obj_eventos->setCondicion("ID_Evento=$ide");
                    $obj_eventos->obtiene_todos_los_eventos();
                    $params= $obj_eventos->getArreglo();
                    $obj_eventos->obtiene_detalle_evento();
                    $detalleEvento= $obj_eventos->getArreglo();
    //              print_r($params);
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
    
    public function guardar_evento(){
        if(isset($_SESSION['nombre'])){
            $obj_eventos= new cls_eventos();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_eventos->setId($_GET['id']); 
            }
            else {}
                  $obj_usuarios->obtiene_todos_los_usuarios();
                  $params = $obj_usuarios->getArreglo();
                 require __DIR__ . '/../vistas/plantillas/lista_de_usuarios.php';
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
                //Obtiene los detalles del evento seleccionado
                $obj_eventos->obtiene_detalle_evento();
                $detalleEvento= $obj_eventos->getArreglo();
                //Obtiene los diferentes seguimientos
                $obj_eventos->obtener_seguimientos();
                $seguimiento = $obj_eventos->getArreglo();
                
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
            $obj_eventos->ingresar_seguimiento_evento();
            $this->frm_eventos_editar();
            //actualiza Seguimiento PENDIENTE
            
        }else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
} 
     