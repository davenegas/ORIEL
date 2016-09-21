<?php

 class Controller{
    /*Inicio del sitio web, llamada a la pantalla principal para inicio de sesion*/
    public function inicio(){
        $tipo_de_alerta="alert alert-info";
        $validacion="Verificación de Identidad";
        require __DIR__ . '/../vistas/plantillas/frm_principal_publica.php';
        //require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
    }

    ////////////////////////////////////////////////////////////////////////////
    //Metodos de Acceso publico
    //
    public function personal_listar_publico(){
        $obj_personal=new cls_personal();
        $obj_personal->obtiene_todo_el_personal_filtrado();
        $personas= $obj_personal->getArreglo();
        require __DIR__ . '/../vistas/plantillas/frm_personal_listar_publico.php';
    }
    
    public function puntobcr_listar_publico(){
        $obj_puntobcr= new cls_puntosBCR();
        $obj_puntobcr->obtiene_todos_los_puntos_bcr_publico();
        $puntosbcr = $obj_puntobcr->getArreglo();
        require __DIR__ . '/../vistas/plantillas/frm_puntobcr_listar_publico.php';
    }
    
    //////////////////////////
    /*Metodos relacionados del area de Modulos de Seguridad del Sistema*/
    //////////////////////////
     
    public function iniciar_sesion(){
        $tipo_de_alerta="alert alert-info";
        $validacion="Verificación de Identidad";
        require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
    }
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

    // Obtiene lista completa de roles del sistema
    public function frm_importar_prontuario_paso_1(){
        if(isset($_SESSION['nombre'])){
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_1.php';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }    
    
    public function frm_importar_prontuario_paso_2(){
        if(isset($_SESSION['nombre'])){
               
            $recepcion_archivo=$_FILES['seleccionar_archivo']['error'];
            
            if (!($_FILES['seleccionar_archivo']['type']==="application/vnd.ms-excel")){
                echo "<script type=\"text/javascript\">alert('Debe Importar un archivo tipo CSV!!!!');history.go(-1);</script>";;
                //echo 'Prueba';
                exit();
            }

            $handle= fopen ($_FILES['seleccionar_archivo']['tmp_name'],"r");
            
            $params=$record = fgetcsv($handle);
                    
            $prontuario =array();
            
            $i=0;
            while ($record = fgetcsv($handle,0,";")){
                $prontuario[]=$record;
                $i++;
            }
            
           $_SESSION['prontuario']=$prontuario;    
           $mensaje="Fue recibida la información correspondiente a ".$i." personas."; 
            
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_2.php';
                          
        }else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    // Paso de importación del prontuario que permite actualizar la tabla de unidades ejecutoras en el sistema
    public function frm_importar_prontuario_paso_3(){
        if(isset($_SESSION['nombre'])){
            
            //Crea objeto de tipo unidad ejecutora para administración de la tabla
            $obj_unidades_ejecutoras = new cls_unidad_ejecutora();
 
            // Crea vector para almacenar las unidades ejecutoras que vienen en el prontuario pero en modo disctinct
            $unidades_ejecutoras=array();
            
            // Lee las unidades ejecutoras que se encuentran en el prontuario y las pasa a un vector separado en modo distinct
            for ($i = 0; $i < count($_SESSION['prontuario']); $i++) {
                if (count($unidades_ejecutoras)>0){
                    $bandera=0;
                    for ($x = 0; $x < count($unidades_ejecutoras); $x++) {
                        if ($_SESSION['prontuario'][$i][6]==$unidades_ejecutoras[$x]){
                            $bandera=1;
                        }
                    }
                    if ($bandera==0){
                        $unidades_ejecutoras[]=$_SESSION['prontuario'][$i][6];
                    }else{
                        $bandera=0;
                    }
                }else{
                    $unidades_ejecutoras[]=$_SESSION['prontuario'][$i][6];
                }
            }
            
            // Mediante este ciclo se edita la tabla de unidades ejecutoras completamente, nuevas, duplicadas, modificadas
            
            $nuevas=0;
            $editadas=0;
            
            for ($i = 0; $i < count($unidades_ejecutoras); $i++){
                $obj_unidades_ejecutoras->setCondicion("Departamento Like '".substr($unidades_ejecutoras[$i],0,strpos($unidades_ejecutoras[$i],"-")+1)."%'");
                $obj_unidades_ejecutoras->obtener_unidades_ejecutoras();
            
                if (count($obj_unidades_ejecutoras->getArreglo())>1){
                    $obj_unidades_ejecutoras->setNumero_ue(substr($unidades_ejecutoras[$i],0,strpos($unidades_ejecutoras[$i],"-")-1));
                    $obj_unidades_ejecutoras->setDepartamento($unidades_ejecutoras[$i]);
                    $obj_unidades_ejecutoras->setObservaciones("");
                    $obj_unidades_ejecutoras->setEstado("1");
                    $obj_unidades_ejecutoras->agregar_nueva_ue_para_prontuario();
                    $obj_unidades_ejecutoras->obtiene_id_ultima_ue_ingresada();
                    
                    for ($x = 0; $x < count($obj_unidades_ejecutoras->getArreglo()); $x++) {
                        $obj_unidades_ejecutoras->setCondicion("ID_Unidad_Ejecutora=".$obj_unidades_ejecutoras->getArreglo()[$x]['ID_Unidad_Ejecutora']);
                        $obj_unidades_ejecutoras->edita_ue_de_personas_para_prontuario();
                        $obj_unidades_ejecutoras->edita_ue_de_sitios_bcr_para_prontuario();
                        $obj_unidades_ejecutoras->eliminar_ue_sobrantes_para_prontuario();
                    }
                    $editadas++;
                }
                if (count($obj_unidades_ejecutoras->getArreglo())==1){
                    if (!($obj_unidades_ejecutoras->getArreglo()[0]['Departamento']==$unidades_ejecutoras[$i])){
                        $obj_unidades_ejecutoras->setNumero_ue(substr($unidades_ejecutoras[$i],0,strpos($unidades_ejecutoras[$i],"-")-1));
                        $obj_unidades_ejecutoras->setDepartamento($unidades_ejecutoras[$i]);
                        $obj_unidades_ejecutoras->setObservaciones("");
                        $obj_unidades_ejecutoras->setEstado("1");
                        $obj_unidades_ejecutoras->setCondicion("ID_Unidad_Ejecutora=".$obj_unidades_ejecutoras->getArreglo()[0]['ID_Unidad_Ejecutora']);
                        $obj_unidades_ejecutoras->edita_ue_para_prontuario();
                        $editadas++;
                    }
                }
                if ($obj_unidades_ejecutoras->getArreglo()==null){
                    $obj_unidades_ejecutoras->setNumero_ue(substr($unidades_ejecutoras[$i],0,strpos($unidades_ejecutoras[$i],"-")-1));
                    $obj_unidades_ejecutoras->setDepartamento($unidades_ejecutoras[$i]);
                    $obj_unidades_ejecutoras->setObservaciones("");
                    $obj_unidades_ejecutoras->setEstado("1");
                    $obj_unidades_ejecutoras->agregar_nueva_ue_para_prontuario();
                    $nuevas++;
                }
                
            }
            $obj_unidades_ejecutoras->setCondicion("Not ID_Unidad_Ejecutora In (Select ID_Unidad_Ejecutora From t_personal)and not ID_Unidad_Ejecutora In (Select ID_Unidad_Ejecutora From t_ue_puntobcr)");
            $obj_unidades_ejecutoras->obtener_unidades_ejecutoras();
            
            if (count($obj_unidades_ejecutoras->getArreglo())==null){
                $cuenta_ue_inactivas=0;
            }else{
                $cuenta_ue_inactivas=count($obj_unidades_ejecutoras->getArreglo());
            }
            $total_unidades_ejecutoras="Se identificaron un total de ".count($unidades_ejecutoras)." unidades ejecutoras en el prontuario adjunto.";
            $nuevas_unidades_ejecutoras="Se agregaron un total de ".$nuevas." unidades ejecutoras nuevas al sistema.";
            $unidades_inactivas="Se identificaron un total de ".$cuenta_ue_inactivas." unidades ejecutoras no ligadas a ninguna persona ni punto BCR (probablemente están en desuso o inactivas).";
            $unidades_editadas="Se editaron un total de ".$editadas." unidades ejecutoras";
            
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_3.php';
     
        }else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    // Paso de importación del prontuario que permite actualizar la tabla de puestos en el sistema
    public function frm_importar_prontuario_paso_4(){
        if(isset($_SESSION['nombre'])){
            
            //Crea objeto de tipo puestos para administración de la tabla
            $obj_puestos = new cls_puestos();
 
            // Crea vector para almacenar los puestos que vienen en el prontuario pero en modo disctinct
            $arreglo_puestos=array();
            
            // Lee los puestos que se encuentran en el prontuario y los pasa a un vector separado en modo distinct
            for ($i = 0; $i < count($_SESSION['prontuario']); $i++) {
                if (count($arreglo_puestos)>0){
                    $bandera=0;
                    for ($x = 0; $x < count($arreglo_puestos); $x++) {
                        if ($_SESSION['prontuario'][$i][3]==$arreglo_puestos[$x]){
                            $bandera=1;
                        }
                    }
                    if ($bandera==0){
                        $arreglo_puestos[]=$_SESSION['prontuario'][$i][3];
                    }else{
                        $bandera=0;
                    }
                }else{
                    $arreglo_puestos[]=$_SESSION['prontuario'][$i][3];
                }
            }
            
            // Mediante este ciclo se edita la tabla puestos completamente, nuevos, duplicados, modificados
            
            $nuevos=0;
            $editados=0;
            
            for ($i = 0; $i < count($arreglo_puestos); $i++){
                $obj_puestos->setCondicion("Puesto='".$arreglo_puestos[$i]."'");
                $obj_puestos->obtener_puestos();
            
                 $obj_puestos->setPuesto($arreglo_puestos[$i]);
                 $obj_puestos->setObservaciones("");
                 $obj_puestos->setEstado("1");
                    
                if (count($obj_puestos->getArreglo())>1){
                   
                    $obj_puestos->agregar_nuevo_puesto_para_prontuario();
                    $obj_puestos->obtiene_id_ultimo_puesto_ingresado();
                    
                    for ($x = 0; $x < count($obj_puestos->getArreglo()); $x++) {
                        $obj_puestos->setCondicion("ID_Puesto=".$obj_puestos->getArreglo()[$x]['ID_Puesto']);
                        $obj_puestos->edita_puesto_de_personas_para_prontuario();
                        $obj_puestos->eliminar_puestos_sobrantes_para_prontuario();
                    }
                    $editados++;
                }
                if (count($obj_puestos->getArreglo())==1){
                    if (!($obj_puestos->getArreglo()[0]['Puesto']==$arreglo_puestos[$i])){
                        
                        $obj_puestos->setCondicion("ID_Puesto=".$obj_puestos->getArreglo()[0]['ID_Puesto']);
                        $obj_puestos->edita_puesto_para_prontuario();
                        $editados++;
                    }
                }
                if ($obj_puestos->getArreglo()==null){
                    
                    $obj_puestos->agregar_nuevo_puesto_para_prontuario();
                    $nuevos++;
                }
                
            }
            $obj_puestos->setCondicion("Not ID_Puesto In (Select ID_Puesto From t_personal)");
            $obj_puestos->obtener_puestos();
            
            if (count($obj_puestos->getArreglo())==null){
                $cuenta_puestos_inactivos=0;
            }else{
                $cuenta_puestos_inactivos=count($obj_puestos->getArreglo());
            }
            $total_puestos="Se identificaron un total de ".count($arreglo_puestos)." puestos en el prontuario adjunto.";
            $nuevos_puestos="Se agregaron un total de ".$nuevos." puestos nuevos al sistema.";
            $puestos_inactivos="Se identificaron un total de ".$cuenta_puestos_inactivos." puestos no ligados a ninguna persona.";
            $puestos_editados="Se editaron un total de ".$editados." puestos.";
            
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_4.php';
     
        }else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
        
    // Paso de importación del prontuario que permite actualizar la tabla de personas en el sistema
    public function frm_importar_prontuario_paso_5(){
        
        if(isset($_SESSION['nombre'])){

            //Crea objeto de tipo puestos para administración de la tabla
            $obj_personal = new cls_personal();
            $obj_puesto = new cls_puestos();
            $obj_ue = new cls_unidad_ejecutora();
 
            // Crea vector para almacenar los puestos que vienen en el prontuario pero en modo disctinct
            $arreglo_personal=array();
            
            // Lee los puestos que se encuentran en el prontuario y los pasa a un vector separado en modo distinct
            for ($i = 0; $i < count($_SESSION['prontuario']); $i++) {
                
                    $arreglo_personal[]=array($_SESSION['prontuario'][$i][0],$_SESSION['prontuario'][$i][1],$_SESSION['prontuario'][$i][3],$_SESSION['prontuario'][$i][6],$_SESSION['prontuario'][$i][7]);
               
            }
            
            // Mediante este ciclo se edita la tabla puestos completamente, nuevos, duplicados, modificados
            
            $nuevos=0;
            $editados=0;
            $eliminadas=0;
            
            for ($i = 0; $i < count($arreglo_personal); $i++){

                $obj_personal->setCondicion("Cedula='".$arreglo_personal[$i][1]."' and ID_Empresa=1");
                $obj_personal->obtener_personas_prontuario();
            
                $obj_personal->setApellidonombre($arreglo_personal[$i][0]);
                    
                $obj_puesto->setPuesto($arreglo_personal[$i][2]);
                $obj_puesto->obtiene_id_puesto_por_nombre();
                $obj_personal->setId_puesto($obj_puesto->getId());

                $obj_personal->setCedula($arreglo_personal[$i][1]);

                $obj_ue->setDepartamento($arreglo_personal[$i][3]);
                $obj_ue->obtiene_id_ue_por_nombre();
                $obj_personal->setId_unidad_ejecutora($obj_ue->getId());

                $obj_personal->setDireccion($arreglo_personal[$i][4]);

                $obj_personal->setLinkfoto("http://bcr0157uco01/foto/".$arreglo_personal[$i][1].".jpg?rnd=7055");
                $obj_personal->setId_empresa("1");

                $obj_personal->setObservaciones("");
                $obj_personal->setEstado("1");
                
                if (count($obj_personal->getArreglo())>1){
                   
                    $obj_personal->agregar_nueva_persona_para_prontuario();
                    $obj_personal->obtiene_id_ultima_persona_ingresada();
                    
                    for ($x = 0; $x < count($obj_personal->getArreglo()); $x++) {
                        $obj_personal->setCondicion("(ID=".$obj_personal->getArreglo()[$x]['ID_Persona'].") AND (ID_Tipo_Telefono=2 or ID_Tipo_Telefono=3 or ID_Tipo_Telefono=4 or ID_Tipo_Telefono=27)");
                        $obj_personal->edita_id_persona_en_tabla_telefonos_para_prontuario();
                        $obj_personal->setCondicion("ID_Persona=".$obj_personal->getArreglo()[$x]['ID_Persona']);
                        $obj_personal->edita_id_persona_en_tabla_gerente_zona_bcr_para_prontuario();
                        $obj_personal->eliminar_personas_sobrantes_para_prontuario();
                    }
                    $editados++;
                }
                if (count($obj_personal->getArreglo())==1){

                    $obj_personal->edita_persona_para_prontuario();
                    $editados++;
                    
                }
                if ($obj_personal->getArreglo()==null){
                    
                    $obj_personal->agregar_nueva_persona_para_prontuario();
                    $nuevos++;
                }
                
            }
          
            $total_personas="Se identificaron un total de ".count($arreglo_personal)." personas en el prontuario adjunto.";
            $nuevas_personas="Se agregaron un total de ".$nuevos." personas nuevas al sistema.";
            $personas_editadas="Se editaron un total de ".$editados." personas.";
            
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_5.php';
     
        }else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    // Paso de importación del prontuario que permite actualizar la tabla de personas en el sistema
    public function frm_importar_prontuario_paso_6(){
        
        if(isset($_SESSION['nombre'])){
            
            //Crea objeto de tipo puestos para administración de la tabla
            $obj_personal = new cls_personal();
             
            // Crea vector para almacenar los puestos que vienen en el prontuario pero en modo disctinct
            $arreglo_personal=array();
            
            // Lee los puestos que se encuentran en el prontuario y los pasa a un vector separado en modo distinct
            for ($i = 0; $i < count($_SESSION['prontuario']); $i++) {
                
                    $arreglo_personal[]=array($_SESSION['prontuario'][$i][0],$_SESSION['prontuario'][$i][1],$_SESSION['prontuario'][$i][3],$_SESSION['prontuario'][$i][6],$_SESSION['prontuario'][$i][7]);
               
            }
            
            $personas_eliminadas=0;
            $excepciones="";
            
            $obj_personal->setCondicion("ID_Empresa=1");
            $obj_personal->obtener_personas_prontuario();
            $params=$obj_personal->getArreglo();

            for ($i = 0; $i < count($params); $i++){
                    
                $bandera=0;
                for ($x = 0; $x < count($arreglo_personal); $x++) {
                    
                    if ($params[$i]['Cedula']==$arreglo_personal[$x][1]){
                       $bandera=1;
                    }   
                }
                if ($bandera==0){
                    $personas_eliminadas++;
                    $obj_personal->setCondicion("ID=".$params[$i]['ID_Persona']);
                    $obj_personal->eliminar_telefonos_personas_bcr_fuera_de_prontuario_para_prontuario();
                    $obj_personal->setCondicion("ID_Persona=".$params[$i]['ID_Persona']);
                    $obj_personal->eliminar_personas_bcr_fuera_de_prontuario_para_prontuario();
                }
                
            }   

            $personas_fuera="Se eliminaron un total de ".$personas_eliminadas." personas de la base de datos.";
            $excepciones="Prueba";
                        
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_6.php';
     
        }else {
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
            $obj_modulos = new cls_modulos();
            
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
                                        $_SESSION['modulos']=array();
                                        
                                        $obj_modulos->obtiene_todos_los_modulos();
                                        $modulos= $obj_modulos->getArreglo();
                                        $obj_modulos->obtiene_lista_de_modulos_por_rol($obj_usuarios->getRol());
                                        $roles = $obj_modulos->getArreglo();
                                        $tam = count($modulos);
                                        $tam2 = count($roles);
                                        $estado=0;
                                        for($i=0; $i<$tam;$i++){
                                            for($c=0;$c<$tam2;$c++){
                                                if($modulos[$i]['Descripcion']==$roles[$c]['Descripcion']){
                                                    $estado = 1;
                                                    break;
                                                }
                                            }
                                            $_SESSION['modulos']= array_merge($_SESSION['modulos'],[($modulos[$i]['Descripcion'])=>($estado)]);
                                            $estado= 0;
                                        }
                                        
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
                        header ("location:/ORIEL/index.php?ctl=guardar_modulo_rol($id_ult_rol)");
                        //$this->guardar_modulo_rol($id_ult_rol);
                    }   else    {
                         header ("location:/ORIEL/index.php?ctl=gestion_roles");
                        //$this->gestion_roles();
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
                        $ultimo_modulo = $obj_modulos->getArreglo();
                        $obj_modulos->insertar_rolesModulo("1", $ultimo_modulo[0]['ID_Modulo']);
                    }   else    {
                        header ("location:/ORIEL/index.php?ctl=modulos_gestion");
                        //$this->modulos_gestion();
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
                    header ("location:/ORIEL/index.php?ctl=listar_usuarios");
                    //$this->listar_usuarios();
                 }   else    {
                    header ("location:/ORIEL/index.php?ctl=gestion_usuarios");
                    //$this->gestion_usuarios();
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
        $obj_modulos = new cls_modulos();

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
                            
                            $_SESSION['modulos']=array();
                            $obj_modulos->obtiene_todos_los_modulos();
                            $modulos= $obj_modulos->getArreglo();
                            $obj_modulos->obtiene_lista_de_modulos_por_rol($obj_usuarios->getRol());
                            $roles = $obj_modulos->getArreglo();
                            $tam = count($modulos);
                            $tam2 = count($roles);
                            $estado=0;
                            for($i=0; $i<$tam;$i++){
                                for($c=0;$c<$tam2;$c++){
                                    if($modulos[$i]['Descripcion']==$roles[$c]['Descripcion']){
                                        $estado = 1;
                                        break;
                                    }
                                }
                                $_SESSION['modulos']= array_merge($_SESSION['modulos'],[($modulos[$i]['Descripcion'])=>($estado)]);
                                $estado= 0;
                            }
//                            echo "<pre>";
//                            print_r($_SESSION['modulos']);
//                            echo "</pre>";
                            
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
            $obj_modulos =  new cls_modulos();
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
                        $_SESSION['modulos']=array();
                        $obj_modulos->obtiene_todos_los_modulos();
                        $modulos= $obj_modulos->getArreglo();
                        $obj_modulos->obtiene_lista_de_modulos_por_rol($obj_usuarios->getRol());
                        $roles = $obj_modulos->getArreglo();
                        $tam = count($modulos);
                        $tam2 = count($roles);
                        $estado=0;
                        for($i=0; $i<$tam;$i++){
                            for($c=0;$c<$tam2;$c++){
                                if($modulos[$i]['Descripcion']==$roles[$c]['Descripcion']){
                                    $estado = 1;
                                    break;
                                }
                            }
                            $_SESSION['modulos']= array_merge($_SESSION['modulos'],[($modulos[$i]['Descripcion'])=>($estado)]);
                            $estado= 0;
                        }    
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
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$i]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();

                if(count($obj_eventos->getArreglo())>0){
                    if ($i==0){
                        $todos_los_seguimientos_juntos=$obj_eventos->getArreglo();
                    }else{
                        $todos_los_seguimientos_juntos = array_merge($todos_los_seguimientos_juntos,$obj_eventos->getArreglo());                 
                    }
                }
                
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$i]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc limit 0,1");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();
                $ultimo_seguimiento_asociado= $obj_eventos->getArreglo();

                //Verifica si existen seguimientos asociados al evento actual
                if(count($ultimo_seguimiento_asociado)>0){
                    if ($i==0){
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]);
                    }else{
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]));  
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
            $obj_eventos->setCondicion("(T_Evento.ID_EstadoEvento=3 OR T_Evento.ID_EstadoEvento=5) AND T_Evento.Fecha='".date("Y-m-d")."'");
            $obj_eventos ->obtiene_todos_los_eventos(); 
            $params= $obj_eventos->getArreglo();
            
            $obj_eventos->obtener_todas_las_provincias();
            $lista_provincias=$obj_eventos->getArreglo();
            
            //Obtiene todos lps tipos de puntos BCR que se encuentran activos en la base de datos
            $obj_eventos->obtener_todos_los_tipos_de_puntos_BCR();
            $lista_tipos_de_puntos_bcr=$obj_eventos->getArreglo();
            
            //Obtiene las oficinas de san jose
                    
            $obj_eventos->setTipo_punto("1");
            $obj_eventos->setProvincia("1");
            
            $obj_eventos->filtra_sitios_bcr_bitacora();
            $lista_puntos_bcr_oficinas_sj=$obj_eventos->getArreglo(); 
            
            $tamano=count($params);
            if (count($params)>0){
                        
                for ($x = 0; $x <$tamano; $x++) {

                    $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$x]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                    //Obtiene los seguimientos del evento seleccionado, si los hubiere
                    $obj_eventos->obtiene_detalle_evento();


                    if(count($obj_eventos->getArreglo())>0){
                        if ($x==0){
                            $todos_los_seguimientos_juntos=$obj_eventos->getArreglo();
    //                     
                        }else{
                            $todos_los_seguimientos_juntos = array_merge($todos_los_seguimientos_juntos,$obj_eventos->getArreglo());
    //                      
                        }
                    }
                    
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$x]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc limit 0,1");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();
                $ultimo_seguimiento_asociado= $obj_eventos->getArreglo();
                
                
                //Verifica si existen seguimientos asociados al evento actual
                if(count($ultimo_seguimiento_asociado)>0){
                    if ($x==0){
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]);
//                     
                    }else{
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]));
//                      
                    }
                }else{
                    if ($x==0){
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$x]['Nombre_Usuario']." ".$params[$x]['Apellido']]);
                    }else{
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$x]['Nombre_Usuario']." ".$params[$x]['Apellido']]));
                    }
                }
                }
            }
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
                
                //Vector que almacena la lista completa de puntos bcr con tipo oficina y de san josé (cuando se agrega un nuevo evento) para cargarla en el dropdownlistbox correspondiente
                $lista_puntos_bcr_oficinas_sj="";
                
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
                    
                    //Obtiene las oficinas de san jose
                    
                    $obj_eventos->setTipo_punto("1");
                    $obj_eventos->setProvincia("1");

                    $obj_eventos->filtra_sitios_bcr_bitacora();
                    $lista_puntos_bcr_oficinas_sj=$obj_eventos->getArreglo(); 
                    
                    /*echo "<pre>";
                    
                    print_r($lista_puntos_bcr_oficinas_sj);
                    
                    echo "</pre>";*/
                    
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
   
    public function actualiza_en_vivo_reporte_trazabilidad(){
            sleep(2);       
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
                    $html="<table id='tabla' class='display2'>";
                    //$html.="<h2 id='titulo'>Movimientos de acuerdo a parámetros:</h2>";
                    $html.="<thead>";   
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
                    
                    $html.="<tbody id='cuerpo'>";
                    $tam=count($params);

                    //$html="";
                    
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

                    $html.=" </table>";
                    
                    echo $html;
                    exit;
                }else{
                     $html="<h4>No se encontraron eventos para este filtro.</h4>";
                     echo $html;
                     exit;
                }    
                //require __DIR__.'/../vistas/plantillas/frm_trazabilidad_listar.php';
                echo $html;
            }else {
               $tipo_de_alerta="alert alert-warning";
               $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }
       
       
        
    }
    
    public function actualiza_en_vivo_reporte_cerrados(){
            sleep(2);       
            if(isset($_SESSION['nombre'])){
                
                $obj_eventos = new cls_eventos();
                
                $fecha_inicial=$_POST['fecha_inicial'];
                $fecha_final=$_POST['fecha_final'];
                $id_punto_bcr=$_POST['id_punto_bcr'];
                               
                $condicion="(T_Evento.Fecha between '".$fecha_inicial."' AND '".$fecha_final."') AND (T_Evento.ID_EstadoEvento=3 OR T_Evento.ID_EstadoEvento=5) AND T_Evento.ID_PuntoBCR=".$id_punto_bcr;
                            
                $obj_eventos->setCondicion($condicion);
                $obj_eventos ->obtiene_todos_los_eventos(); 
                $params= $obj_eventos->getArreglo();
                $todos_los_seguimientos_juntos="";
                
                $tamano=count($params);
                
                if (count($params)>0){

                    for ($x = 0; $x <$tamano; $x++) {

                        $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$x]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                        //Obtiene los seguimientos del evento seleccionado, si los hubiere
                        $obj_eventos->obtiene_detalle_evento();

                        if(count($obj_eventos->getArreglo())>0){
                            if ($x==0){
                                $todos_los_seguimientos_juntos=$obj_eventos->getArreglo();
        //                     
                            }else{
                                $todos_los_seguimientos_juntos = array_merge($todos_los_seguimientos_juntos,$obj_eventos->getArreglo());
        //                      
                            }
                        }
                        
                        $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$x]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc limit 0,1");
                        //Obtiene los seguimientos del evento seleccionado, si los hubiere
                        $obj_eventos->obtiene_detalle_evento();
                        $ultimo_seguimiento_asociado= $obj_eventos->getArreglo();


                        //Verifica si existen seguimientos asociados al evento actual
                        if(count($ultimo_seguimiento_asociado)>0){
                            if ($x==0){
                                $detalle_y_ultimo_usuario= array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]);
        //                     
                            }else{
                                $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]));
        //                      
                            }
                        }else{
                            if ($x==0){
                                $detalle_y_ultimo_usuario= array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$x]['Nombre_Usuario']." ".$params[$x]['Apellido']]);
                            }else{
                                $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$x]['Nombre_Usuario']." ".$params[$x]['Apellido']]));
                            }
                        }   
                        
                    }
                }

                if (count($params)>0){
                    
                    //$html="<h2>Listado de Eventos Relacionados a este Punto BCR</h2>";
                    $html="<table id='tabla' class='display2'>";
                    //$html.="<h2 id='titulo'>Movimientos de acuerdo a parámetros:</h2>";
                    $html.="<thead>";   
                    $html.="<tr>";
                    $html.="<th hidden='true'>ID_Evento</th>";
                    $html.="<th>Fecha</th>";
                    $html.="<th>Hora</th>";
                    $html.="<th>Provincia</th>";
                    $html.="<th>Tipo Punto</th>";
                    $html.="<th>Punto BCR</th>";
                    $html.="<th>Codigo</th>";
                    $html.="<th>Tipo de Evento</th>";
                    $html.="<th>Estado del Evento</th>";
                    $html.="<th>Cerrado Por</th>";
                    if ($_SESSION['rol']!=2){  
                        $html.="<th>Gestión</th>";
                    }
                    $html.="<th>Consulta</th>";
                    $html.="<th hidden='true'>Seguimientos</th> ";
                    $html.="</tr>";
                    $html.="</thead>";
                    
                    $html.="<tbody id='cuerpo'>";
                    $tam=count($params);

                    //$html="";
                    
                    for ($i = 0; $i <$tam; $i++) {
           
                        $html.="<tr data-toggle='tooltip' title='".$detalle_y_ultimo_usuario[$i]['Detalle']."'>";
           
                        $fecha_evento = date_create($params[$i]['Fecha']);
                        $fecha_actual = date_create(date("d-m-Y"));
                        $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            
                        
                        $html.="<td hidden='true'>".$params[$i]['ID_Evento']."</td>";
                        $html.="<td>".date_format($fecha_evento, 'd/m/Y')."</td>";   
                        $html.="<td>".$params[$i]['Hora']."</td>";
                        $html.="<td>".$params[$i]['Nombre_Provincia']."</td>";
                        $html.="<td>".$params[$i]['Tipo_Punto']."</td>";
                        $html.="<td>".$params[$i]['Nombre']."</td>";
                        $html.="<td>".$params[$i]['Codigo']."</td>";
                        $html.="<td>".$params[$i]['Evento']."</td>";
                        $html.="<td>".$params[$i]['Estado_Evento']."</td>";                
                        $html.="<td>".$detalle_y_ultimo_usuario[$i]['Usuario']."</td>";
                        //$html.="<td>".$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']."</td>";
                        
                        if ($_SESSION['rol']!=2){  
                            $html.="<td align='center'><a onclick='recuperar_evento(".$params[$i]['ID_Evento'].",".$params[$i]['ID_PuntoBCR'].",".$params[$i]['ID_Tipo_Evento'].")'>Recuperar Evento</a></td>";
                        }   
                        $html.="<td align='center'><a href='index.php?ctl=frm_eventos_editar&accion=consulta_cerrados&id=".$params[$i]['ID_Evento']."'>Ver detalle</a></td>";
                        
//                        $html.="<table id='segunda'>";
//                        $html.="<thead>";
//                        $html.="<tr>";
//                        $html.="<th>Fecha de Seguimiento</th>";
//                        $html.="<th>Detalle del Seguimiento</th>";
//                        $html.="</tr>";
//                        $html.="</thead>";
//                        $html.="<tbody>";
//                        
                        $tama=count($todos_los_seguimientos_juntos);
                        $cadena="";
                        for ($j = 0; $j <$tama; $j++) {
                        
                            //$html.="<tr>";
                            $fecha_evento = date_create($todos_los_seguimientos_juntos[$j]['Fecha']);
                            $fecha_actual = date_create(date("d-m-Y"));
                            $dias_abierto= date_diff($fecha_evento, $fecha_actual);
                            if ($params[$i]['ID_Evento']==$todos_los_seguimientos_juntos[$j]['ID_Evento']){
                               $cadena.=date_format($fecha_evento, 'd/m/Y')." ".$todos_los_seguimientos_juntos[$j]['Detalle']."\n";
                            }
                        }
                        $html.="<td hidden='true'>".$cadena."</td>";
//                        $html.="</tbody>";
//                        $html.="</table>";
//                        $html.="</td>";
                        $html.="</tr>";
                    }

                    $html.="</tbody>";

                    $html.=" </table>";
                    
                    echo $html;
                    exit;
                }else{
                     $html="<h4>No se encontraron eventos para este filtro.</h4>";
                     echo $html;
                     exit;
                }    
                //require __DIR__.'/../vistas/plantillas/frm_trazabilidad_listar.php';
                echo $html;
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
                //$obj_eventos->setCondicion("T_Evento.ID_PuntoBCR=".$_POST['id_punto_bcr']." Limit 0,5");
                $obj_eventos->setCondicion("T_Evento.ID_PuntoBCR=".$_POST['id_punto_bcr']);
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
        //echo "<script type=\"text/javascript\">alert('Evento recuperado con Éxito!!!');</script>";
        if(isset($_SESSION['nombre'])){
            $obj_eventos= new cls_eventos();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $obj_eventos->setFecha(date("Y-m-d")); 
                $obj_eventos->setHora(date("H:i", time()));
                $obj_eventos->setTipo_evento($_POST['id_tipo_evento']);
                $obj_eventos->setPunto_bcr($_POST['id_puntobcr']);
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
                    $obj_eventos->setId($_POST['id_evento']);
                    $obj_eventos->edita_estado_evento("1");
                    $obj_eventos->setAdjunto("N/A");
                    $obj_eventos->ingresar_seguimiento_evento();  
                    
                    //echo "<script type=\"text/javascript\">alert('Evento recuperado con Éxito!!!');history.go(-1);</script>";
                    
                    header ("location:/ORIEL/index.php?ctl=frm_eventos_lista_cerrados");
                    echo "0";
                    //$this->frm_eventos_lista_cerrados();
                }else{
                    //echo '<script>alert("Ya existe este evento abierto para este punto BCR. Proceda a cerrarlo o agregue un seguimiento!!!")</script>';
                    //require __DIR__ . '/../vistas/plantillas/frm_eventos_agregar.php';
                    echo "1";
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
                $fecha_seguimiento = strtotime($_POST['fecha']);
                $fecha_seguimiento = date("Y-m-d", $fecha_seguimiento);

                if ($fecha_seguimiento >  date("Y-m-d")){
                    echo "<script type=\"text/javascript\">alert('No es posible ingresar eventos futuros!!!!');history.go(-1);</script>";;
                    exit();
                }else{
                     $hora_seguimiento = strtotime($_POST['hora']);
                     $hora_seguimiento = date("H:i", $hora_seguimiento);

                     if ($hora_seguimiento >  date("H:i", time())){
                        echo "<script type=\"text/javascript\">alert('No es posible ingresar eventos futuros!!!!');history.go(-1);</script>";;
                        exit();
                     }
                }
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
                       $obj_eventos->setAdjunto("N/A");
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
                     $estado_evento=$params[0]['Estado_Evento']; 
                     //echo $estado_evento;
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
            
            $fecha_seguimiento = strtotime($_POST['Fecha']);
	    $fecha_seguimiento = date("Y-m-d", $fecha_seguimiento);
            
            if ($fecha_seguimiento >  date("Y-m-d")){
                echo "<script type=\"text/javascript\">alert('No es posible ingresar eventos futuros!!!!');history.go(-1);</script>";;
                exit();
            }else{
                 $hora_seguimiento = strtotime($_POST['Hora']);
                 $hora_seguimiento = date("H:i", $hora_seguimiento);
            
                 if ($hora_seguimiento >  date("H:i", time())){
                    echo "<script type=\"text/javascript\">alert('No es posible ingresar eventos futuros!!!!');history.go(-1);</script>";;
                    exit();
                 }
            }
             
            $obj_eventos->setFecha(($_POST['Fecha']));
            $obj_eventos->setHora(($_POST['Hora']));
            $obj_eventos->setDetalle(($_POST['DetalleSeguimiento']));
            $obj_eventos->setId_usuario($_SESSION['id']);
            
            //$this->frm_eventos_listar();
            
            $recepcion_archivo=$_FILES['archivo_adjunto']['error'];
            
            //echo basename($_FILES['archivo_adjunto']['tmp_name']);
            //echo basename($_FILES['archivo_adjunto']['type']);
            $date=new DateTime(); //this returns the current date time
            $result = $date->format('Y-m-d-H-i-s');
            //echo $result;
            $krr = explode('-',$result);
            $result = implode("",$krr);
                       
            $raiz=$_SERVER['DOCUMENT_ROOT'];
                       
            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            
            $ruta=  $raiz."Adjuntos_Bitacora/".Encrypter::quitar_tildes($result.$_FILES['archivo_adjunto']['name']);
            //$ruta=  $_SERVER['DOCUMENT_ROOT']."Adjuntos_Bitacora/".$result.$_FILES['archivo_adjunto']['name'];
          
            switch ($recepcion_archivo) {
                case 0:{
                    
                    if (move_uploaded_file($_FILES['archivo_adjunto']['tmp_name'], $ruta)){
                        $obj_eventos->setAdjunto(Encrypter::quitar_tildes($result.$_FILES['archivo_adjunto']['name'])); 
                        $obj_eventos->ingresar_seguimiento_evento();
                        $obj_eventos->edita_estado_evento($_POST['estado_del_evento']);
                        header ("location:/ORIEL/index.php?ctl=frm_eventos_listar");
                    }  else {
                        //echo "<script type=\"text/javascript\">alert('Hubo un problema al subir el archivo al servidor!!!');history.go(-1);</script>";;
                        $obj_eventos->setAdjunto("N/A");
                        $obj_eventos->ingresar_seguimiento_evento();
                        $obj_eventos->edita_estado_evento($_POST['estado_del_evento']);
                        header ("location:/ORIEL/index.php?ctl=frm_eventos_listar");
                        //echo "<script type=\"text/javascript\">alert('No fue seleccionado ningun archivo!!!!');history.go(-1);</script>";;
                    }
                    break;
                }
                    
                case 2:{
                    echo "<script type=\"text/javascript\">alert('El archivo consume mayor espacio del permitido (1 mb) !!!!');history.go(-1);</script>";;
                    break;
                }
                case 4:{ 
                    $obj_eventos->setAdjunto("N/A");
                    $obj_eventos->ingresar_seguimiento_evento();
                    $obj_eventos->edita_estado_evento($_POST['estado_del_evento']);
                    header ("location:/ORIEL/index.php?ctl=frm_eventos_listar");
                    //echo "<script type=\"text/javascript\">alert('No fue seleccionado ningun archivo!!!!');history.go(-1);</script>";;
                    break;
                }
                 case 6:{
                    echo "<script type=\"text/javascript\">alert('El servidor no tiene acceso a la carpeta temporal de almacenamiento!!!!');history.go(-1);</script>";
                    break;
                 } 
                case 7:{
                    echo "<script type=\"text/javascript\">alert('No es posible escribir en el disco duro del servidor!!!!');history.go(-1);</script>";;
                    break;
                }  
                case 8:{
                    echo "<script type=\"text/javascript\">alert('Fue detenida la carga del archivo debido a una extension de PHP!!!!');history.go(-1);</script>";;
                    break;
                }   
            }
            
                   
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
                header ("location:/ORIEL/index.php?ctl=tipo_eventos_listar");
                //$this->tipo_eventos_listar();
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
            header ("location:/ORIEL/index.php?ctl=tipo_eventos_listar");
            //$this->tipo_eventos_listar();
        } else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function areas_apoyo_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_areasApoyo=new cls_areasapoyo();
            $obj_areasApoyo->setCondicion("");
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
                header ("location:/ORIEL/index.php?ctl=empresas_listar");
                //$this->empresas_listar();
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
                    header ("location:/ORIEL/index.php?ctl=empresas_listar");
                    //$this->empresas_listar();
                }
            }
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //Editar Punto BCR, información completa 
    ////////////////////////////////////////////////////////////////////////////
    public function gestion_punto_bcr(){
        if(isset($_SESSION['nombre'])){
            $obj_Puntobcr = new cls_puntosBCR();
            $obj_Personal = new cls_personal();
            $obj_areasapoyo = new cls_areasapoyo();
            $obj_empresa = new cls_empresa();
            $obj_horario = new cls_horario();
            $obj_direccionIP = new cls_direccionIP();
            $obj_telefono = new cls_telefono();
            $obj_unidad_ejecutora = new cls_unidad_ejecutora();
            
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
            }   else    {
                
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
                $obj_telefono->setCondicion("T_Telefono.ID='".$_GET['id']."'");
                $obj_telefono->obtiene_telefonos_puntoBCR();
                $telefonos= $obj_telefono->getArreglo();
                
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
                        if($tam>$i && $tam-1<>$i)
                        {
                            $condicion=$condicion." OR ";
                        }
                    }
                    $obj_Personal->setCondicion($condicion);
                    $obj_Personal->obtiene_todo_el_personal();
                    $personal = $obj_Personal->getArreglo();
                }
                else{
                    $personal=null;
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
                
                //Obtiene los tipos de telefono
                $obj_telefono->setCondicion("");
                $obj_telefono->obtiene_tipo_telefonos();
                $tipo_telefono= $obj_telefono->getArreglo();
                
                //Obtiene Unidades Ejecutoras
                $obj_unidad_ejecutora->setCondicion("");
                $obj_unidad_ejecutora->obtener_unidades_ejecutoras();
                $todas_ue = $obj_unidad_ejecutora->getArreglo();

                //Obtiene los tipos de area de apoyo
                $obj_areasapoyo->setCondicion("");
                $obj_areasapoyo->obtiene_tipo_area_apoyo();
                $tipos_areas_apoyo= $obj_areasapoyo->getArreglo();
                
                //Obtiene todas las areas de apoyo
                $obj_areasapoyo->setCondicion("");
                $obj_areasapoyo->obtiene_todos_las_areas_apoyo();
                $todas_areas_apoyo =$obj_areasapoyo->getArreglo();
                
                //Obtiene todas las direcciones IP
                $obj_direccionIP->setCondicion("");
                $obj_direccionIP->obtiene_direccionesIP();
                $todas_direccionIP=$obj_direccionIP->getArreglo();
                
                //Obtiene todos los tipos de Direcciones IP
                $obj_direccionIP->setCondicion("");
                $obj_direccionIP->obtiene_tipo_direcciones_ip();
                $tipos_direccion_ip= $obj_direccionIP->getArreglo();
                
                //Obtiene todos los gerente de zona del BCR
                $obj_Personal->setCondicion("");
                $obj_Personal->obtener_gerentes_zona_bcr();
                $gerente_zona_bcr= $obj_Personal->getArreglo();
                
                //Obtiene todos los supervisores
                $obj_Personal->setCondicion("");
                $obj_Personal->obtener_supervisor_zona();
                $supervisor_zona_externo = $obj_Personal->getArreglo();
                
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
                $obj_Puntobcr->sethoraslaborales("1");

                $obj_Puntobcr->guardar_punto_bcr();

            }
            header ("location:/ORIEL/index.php?ctl=puntos_bcr_listar");
            //$this->puntos_bcr_listar();
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function puntobcr_desligar_telefono(){
        if(isset($_SESSION['nombre'])){
            $obj_telefono = new cls_telefono();
            $obj_telefono->setId($_POST['id_telefono']);
            $obj_telefono->setCondicion("ID_Telefono='".$_POST['id_telefono']."'");
            $obj_telefono->eliminar_telefono();

        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function puntobcr_desligar_ue(){
        if(isset($_SESSION['nombre'])){
            $obj_unidad_ejecutora = new cls_unidad_ejecutora();
            $obj_unidad_ejecutora->setId($_POST['id_unidad_ejecutora']);
            $obj_unidad_ejecutora->setId2($_POST['id_puntobcr']);
            $obj_unidad_ejecutora->eliminar_relacion_puntobcr_ue();

        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_agregar_ue(){
        if(isset($_SESSION['nombre'])){
            $obj_unidad_ejecutora = new cls_unidad_ejecutora();
            $obj_unidad_ejecutora->setId($_POST['id_unidad_ejecutora']);
            $obj_unidad_ejecutora->setId2($_POST['id_puntobcr']);
            $obj_unidad_ejecutora->agregar_puntobcr_ue();
            
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
    
    public function puntobcr_numero_telefono_guardar(){
        if(isset($_SESSION['nombre'])){   
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_telefono = new cls_telefono();
                $obj_telefono->setId($_POST['ID_Tipo_Telefono']);
                $obj_telefono->setId2($_POST['ID_PuntoBCR']);
                $obj_telefono->setTipo_telefono($_POST['Tipo_Telefono']);
                $obj_telefono->setNumero($_POST['numero']);
                $obj_telefono->setObservaciones($_POST['observaciones']);
                $obj_telefono->guardar_telefono();
                header("location:/ORIEL/index.php?ctl=gestion_punto_bcr&id=".$_POST['ID_PuntoBCR']);
            }
        }   else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_asignar_area_apoyo(){
        if(isset($_SESSION['nombre'])){
            $obj_area_apoyo = new cls_areasapoyo();
            $obj_area_apoyo->setId($_POST['id_area_apoyo']);
            $obj_area_apoyo->setId2($_POST['id_puntobcr']);
            $obj_area_apoyo->setCondicion("T_PuntoBCRAreaApoyo.ID_PuntoBCR='".$_POST['id_puntobcr']."' AND T_PuntoBCRAreaApoyo.ID_Area_Apoyo='".$_POST['id_area_apoyo']."'");
            $obj_area_apoyo->obtiene_todos_las_areas_apoyo();
            $areas_apoyo =$obj_area_apoyo->getArreglo();
            if($areas_apoyo==""){
                $obj_area_apoyo->agregar_PuntoBCR_AreaApoyo();
            }   else    {
                echo "El Area de Apoyo ya se encuentra asignada al PuntoBCR";
            }
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function Area_apoyo_agregar(){
        if(isset($_SESSION['nombre'])){
            $obj_area_apoyo= new cls_areasapoyo();
            $obj_telefono = new cls_telefono();
            //Crea nueva area de apoyo
            $obj_area_apoyo->setId(null);
            $obj_area_apoyo->setTipo_area($_POST['Tipo_Area_Apoyo']);
            $obj_area_apoyo->setDistrito($_POST['distrito']);
            $obj_area_apoyo->setNombre_area($_POST['nombre']);
            $obj_area_apoyo->setDireccion($_POST['direccion']);
            $obj_area_apoyo->setObservaciones($_POST['observaciones']);
            $obj_area_apoyo->setCondicion("");
            $obj_area_apoyo->agregar_area_apoyo();
            $area_apoyo = $obj_area_apoyo->getArreglo();
            if($area_apoyo==""){
                echo 'Error al traer area de apoyo nueva';
            }   else    {
                //Crea el número del area de apoyo nueva
                $obj_telefono->setId(null);
                $obj_telefono->setNumero($_POST['numero']);
                $obj_telefono->setTipo_telefono($_POST['Tipo_Telefono']);
                $obj_telefono->setId2($area_apoyo[0]['ID_Area_Apoyo']); 
                $obj_telefono->setObservaciones("");
                $obj_telefono->guardar_telefono();
            }
            //Asigna el area de apoyo al puntoBCR
            $obj_area_apoyo = new cls_areasapoyo();
            $obj_area_apoyo->setId($area_apoyo[0]['ID_Area_Apoyo']);
            $obj_area_apoyo->setId2($_POST['ID_PuntoBCR']);
            $obj_area_apoyo->setCondicion("T_PuntoBCRAreaApoyo.ID_PuntoBCR='".$_POST['id_puntobcr']."' AND T_PuntoBCRAreaApoyo.ID_Area_Apoyo='".$_POST['id_area_apoyo']."'");
            $obj_area_apoyo->obtiene_todos_las_areas_apoyo();
            $areas_apoyo =$obj_area_apoyo->getArreglo();
            if($areas_apoyo==""){
                $obj_area_apoyo->agregar_PuntoBCR_AreaApoyo();
            }   else    {
                echo "El Area de Apoyo ya se encuentra asignada al PuntoBCR";
            }
            
            header("location:/ORIEL/index.php?ctl=gestion_punto_bcr&id=".$_POST['ID_PuntoBCR']);
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_desligar_area_apoyo(){
        if(isset($_SESSION['nombre'])){
            $obj_area_apoyo = new cls_areasapoyo();
            $obj_area_apoyo->setId($_POST['id_area_apoyo']);
            $obj_area_apoyo->setId2($_POST['id_puntobcr']);
            $obj_area_apoyo->setCondicion("");
            $obj_area_apoyo->eliminar_puntobcr_area_apoyo();
            
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_desligar_direccion_ip(){
        if(isset($_SESSION['nombre'])){
            $obj_direccion = new cls_direccionIP();
            $obj_direccion->setId($_POST['id_direccion_ip']);
            $obj_direccion->setId2($_POST['id_puntobcr']);
            $obj_direccion->setCondicion("");
            $obj_direccion->eliminar_puntobcr_direccion_ip();
            
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_asignar_direccion_ip(){
        if(isset($_SESSION['nombre'])){
            $obj_direccion = new cls_direccionIP();
            $obj_direccion->setId($_POST['id_direccion_ip']);
            $obj_direccion->setId2($_POST['id_puntobcr']);
            $obj_direccion->setCondicion("T_puntoBCRDireccionIP.ID_PuntoBCR='".$_POST['id_puntobcr']."' AND T_puntoBCRDireccionIP.ID_Direccion_IP='".$_POST['id_direccion_ip']."'");
            
            $obj_direccion->obtiene_direccionesIP();
            $direcciones_ip =$obj_direccion->getArreglo();
            if($direcciones_ip==""){
                $obj_direccion->agregar_PuntoBCR_direccionIP();
            }   else    {
                echo "La dirección IP ya se encuentra asignada al PuntoBCR";
            }
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function direccionIP_agregar(){
        if(isset($_SESSION['nombre'])){
            echo "<script>alert('test msgbox')</script>";
            $obj_direccion_ip = new cls_direccionIP();
            //Crea nueva area de apoyo
            $obj_direccion_ip->setId(null);
            $obj_direccion_ip->setTipo_IP($_POST['tipo_ip']);
            $obj_direccion_ip->setDireccionIP($_POST['direccion_ip']);
            $obj_direccion_ip->setObservaciones($_POST['observaciones']);
            $obj_direccion_ip->setCondicion("");
            $obj_direccion_ip->agregar_direccion_ip();
            
            $nueva_ip= $obj_direccion_ip->getArreglo();
            
            //Asigna el area de apoyo al puntoBCR
            $obj_direccion_ip->setId($nueva_ip[0]['ID_Direccion_IP']);
            $obj_direccion_ip->setId2($_POST['ID_PuntoBCR']);
            $obj_direccion_ip->setCondicion("T_puntoBCRDireccionIP.ID_PuntoBCR='".$_POST['ID_PuntoBCR']."' AND T_puntoBCRDireccionIP.ID_Direccion_IP='".$nueva_ip[0]['ID_Direccion_IP']."'");
            
            $obj_direccion_ip->obtiene_direccionesIP();
            $direcciones_ip =$obj_direccion_ip->getArreglo();
            if($direcciones_ip==""){
                $obj_direccion_ip->agregar_PuntoBCR_direccionIP();
            }   else    {
                echo "La dirección IP ya se encuentra asignada al PuntoBCR";
            }
            
            header("location:/ORIEL/index.php?ctl=gestion_punto_bcr&id=".$_POST['ID_PuntoBCR']);
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function PuntoBCR_actualiza_informacion_adicional(){
        if(isset($_SESSION['nombre'])){
            $obj_puntobcr = new cls_puntosBCR();
            $obj_puntobcr->setCondicion("ID_PuntoBCR='".$_POST['id_puntobcr']."'");
            
            $obj_puntobcr->setEmpresa($_POST['id_empresa']);
            $obj_puntobcr->setHorario($_POST['id_horario']);
            $obj_puntobcr->setObservaciones($_POST['observaciones']);
            $obj_puntobcr->setGerente($_POST['id_gerente']);
            $obj_puntobcr->setSupervisor($_POST['id_supervisor']);
            $obj_puntobcr->actualizar_informacion_adicional_puntobcr();
            //echo 'Se actualizó la ubicacion del PuntoBCR';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function punto_bcr_cambiar_estado(){
        if(isset($_SESSION['nombre'])){
            if (isset($_GET['id'])) {
                if (isset($_GET['estado'])) { 
                    $obj_puntobcr = new cls_puntosBCR();
                    
                    if($_GET['estado']==1){
                        $obj_puntobcr->setEstado("0");
                    }
                    else {
                        $obj_puntobcr->setEstado("1");
                    }
                    $obj_puntobcr->setCondicion("ID_PuntoBCR='".$_GET['id']."'");
                    $obj_puntobcr->actualizar_estado_puntobcr();
                    header ("location:/ORIEL/index.php?ctl=puntos_bcr_listar");
                }
            }
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    ////////////////////////////////////////////////////////////////////////////
    //MANTENIMIENTO DE PERSONAL
    //
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
    
    public function personal_cambiar_estado(){
        if(isset($_SESSION['nombre'])){
            if (isset($_GET['id'])) {
                if (isset($_GET['estado'])) { 
                    $obj_personal = new cls_personal();
                    
                    if($_GET['estado']==1){
                        $obj_personal->setEstado("0");
                    }
                    else {
                        $obj_personal->setEstado("1");
                    }
                    $obj_personal->setCondicion("ID_Persona='".$_GET['id']."'");
                    $obj_personal->actualizar_estado_persona();
                    header ("location:/ORIEL/index.php?ctl=personal_listar");
                }
            }
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function personal_gestion(){
        if(isset($_SESSION['nombre'])){
            $obj_personal=new cls_personal();
            $obj_empresa = new cls_empresa();
            $obj_unidad_ejecutora = new cls_unidad_ejecutora();
            $obj_telefono = new cls_telefono();
            
            
            $ide=$_GET['id'];
            $obj_personal->setCondicion("T_Personal.ID_Persona='".$_GET['id']."'");
            $obj_personal->obtiene_todo_el_personal();
            $params= $obj_personal->getArreglo();
            
            //Obtiene empresa remesera
            $obj_empresa->setCondicion("");
            $obj_empresa->obtiene_todas_las_empresas();
            $empresas= $obj_empresa->getArreglo();
				
            //Obtiene Unidades Ejecutoras
            $obj_unidad_ejecutora->setCondicion("");
            $obj_unidad_ejecutora->obtener_unidades_ejecutoras();
            $todas_ue = $obj_unidad_ejecutora->getArreglo();
            
            //Obtiene todos los Puestos
            $obj_personal->setCondicion("");
            $obj_personal->obtener_todos_puestos();
            $puestos= $obj_personal->getArreglo();
            
            //Obtiene los tipos de telefono
            $obj_telefono->setCondicion("");
            $obj_telefono->obtiene_tipo_telefonos();
            $tipo_telefono = $obj_telefono->getArreglo();
            
                
            require __DIR__ . '/../vistas/plantillas/frm_personal_detalle.php';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function personal_eliminar_telefono(){
       if(isset($_SESSION['nombre'])){
            $obj_telefono = new cls_telefono();
            $obj_telefono->setId($_POST['id_telefono']);
            $obj_telefono->setCondicion("ID_Telefono='".$_POST['id_telefono']."'");
            $obj_telefono->eliminar_telefono();

        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function personal_numero_telefono_guardar(){
        if(isset($_SESSION['nombre'])){   
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_telefono = new cls_telefono();
                echo '<script>alert("Ingresa");</script>';
                $obj_telefono->setId($_POST['ID_Telefono']);
                $obj_telefono->setId2($_POST['ID_Persona']);
                $obj_telefono->setTipo_telefono($_POST['Tipo_Telefono']);
                $obj_telefono->setNumero($_POST['numero']);
                $obj_telefono->setObservaciones($_POST['observaciones']);
                if($_POST['ID_Telefono']==0){
                    echo '<script>alert("Nuevo Numero");</script>';
                    $obj_telefono->guardar_telefono();
                }
                else{
                    echo '<script>alert("Actualiza Numero");</script>';
                    $obj_telefono->setCondicion("ID_Telefono='".$_POST['ID_Telefono']."'");
                    $obj_telefono->actualizar_telefono();
                }
                header("location:/ORIEL/index.php?ctl=personal_gestion&id=".$_POST['ID_Persona']);
            }
        }   else    {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function personal_cambiar_ue(){
        if(isset($_SESSION['nombre'])){
            $obj_persona = new cls_personal();
            
            $obj_persona->setId2($_POST['id_unidad_ejecutora']);
            $obj_persona->setCondicion("ID_Persona='".$_POST['id_persona']."'");
            $obj_persona->cambiar_ue_persona();
            
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function personal_cambiar_puesto() {
        if(isset($_SESSION['nombre'])){
            $obj_persona = new cls_personal();
            
            $obj_persona->setId2($_POST['id_puesto']);
            $obj_persona->setCondicion("ID_Persona='".$_POST['id_persona']."'");
            $obj_persona->cambiar_puesto_persona();
            
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function persona_guardar_informacion_general(){
        if(isset($_SESSION['nombre'])){
            $obj_persona = new cls_personal();
            
            $obj_persona->setCedula($_POST['cedula']);
            $obj_persona->setApellidonombre($_POST['nombre']);
            $obj_persona->setEmpresa($_POST['empresa']);
            $obj_persona->setObservaciones($_POST['observaciones']);
            $obj_persona->setGafete($_POST['numero_gafete']);
            $obj_persona->setCorreo($_POST['correo']);
            $obj_persona->setDireccion($_POST['direccion']);
            
            $obj_persona->setCondicion("ID_Persona='".$_POST['id_persona']."'");
            $obj_persona->actualizar_informacion_general_persona();
            
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    ////////////////////////////////////////////////////////////////////////////
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