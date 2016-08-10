<?php
session_start();
 // carga del modelo y los controladores
require_once __DIR__ . '/modelos/Data_Provider.php';
require_once __DIR__ . '/controladores/cls_usuarios.php';
require_once __DIR__ . '/controladores/cls_roles.php';
require_once __DIR__ . '/controladores/cls_modulos.php';
require_once __DIR__ . '/controladores/cls_eventos.php';
require_once __DIR__ . '/controladores/cls_areasapoyo.php';
require_once __DIR__ . '/controladores/cls_puntosBCR.php';
require_once __DIR__ . '/controladores/cls_empresa.php';
require_once __DIR__ . '/controladores/cls_personal.php';
require_once __DIR__ . '/controladores/cls_horario.php';
require_once __DIR__ . '/controladores/cls_direccionIP.php';
require_once __DIR__ . '/modelos/Controller.php';
require_once __DIR__ . '/modelos/Encrypter.php';
require_once __DIR__ . '/modelos/PHPMailerAutoload.php';
require_once __DIR__ . '/modelos/class.phpmailer.php';
require_once __DIR__ . '/modelos/class.smtp.php';
require_once __DIR__ . '/modelos/Mail_Provider.php';

// enrutamiento
$map = array(
    //Controlador General
    'inicio' => array('controller' =>'Controller', 'action' =>'inicio'),
    'listar' => array('controller' =>'Controller', 'action' =>'listar'),
    'cerrar_sesion' => array('controller' =>'Controller', 'action' =>'cerrar_sesion'),
    'insertar' => array('controller' =>'Controller', 'action' =>'insertar'),
    'buscar' => array('controller' =>'Controller', 'action' =>'buscarPorNombre'),
    'ver' => array('controller' =>'Controller', 'action' =>'ver'),
    'principal' => array('controller' =>'Controller', 'action' =>'principal'),
         
    //Controlador de Modulos
    'listar_modulos' => array('controller' =>'Controller', 'action' =>'listar_modulos'),
    'gestion_modulos' => array('controller' =>'Controller', 'action' =>'gestion_modulos'),
    'cambiar_estado_modulo' => array('controller' =>'Controller', 'action' =>'cambiar_estado_modulo'),
    'guardar_modulo' => array('controller' =>'Controller', 'action' =>'guardar_modulo'),
     
    //Controlador de roles
    'guardar_rol' =>  array('controller'=>'Controller','action'=>'guardar_rol'),
    'listar_roles' =>  array('controller'=>'Controller','action'=>'listar_roles'),
    'cambiar_estado_rol' => array('controller' =>'Controller', 'action' =>'cambiar_estado_rol'),
    'gestion_roles'=>array('controller'=>'Controller', 'action'=>'gestion_roles'),
     
     //Controlador de Eventos (Bitacora Digital)
    'frm_eventos_listar' =>  array('controller'=>'Controller','action'=>'frm_eventos_listar'),
    'frm_eventos_agregar' =>  array('controller'=>'Controller','action'=>'frm_eventos_agregar'),
    'guardar_evento' =>  array('controller'=>'Controller','action'=>'guardar_evento'),
    'guardar_seguimiento_evento'=>  array('controller'=>'Controller','action'=> 'guardar_seguimiento_evento'),
    'frm_eventos_editar'=>  array('controller'=>'Controller','action'=>  'frm_eventos_editar'),
    
    //Tipo de eventos
    'tipo_eventos_listar'=>array('controller'=>'Controller','action'=> 'tipo_eventos_listar'),
    'tipo_eventos_guardar'=>array('controller'=>'Controller','action'=> 'tipo_eventos_guardar'),
    'tipo_eventos_gestion'=>array('controller'=>'Controller','action'=> 'tipo_eventos_gestion'),
    
    //Areas de apoyo
    'areas_apoyo_listar'=>array('controller'=>'Controller','action'=> 'areas_apoyo_listar'),
    
    //PuntosBCR
    'puntos_bcr_listar'=>array('controller'=>'Controller','action'=> 'puntos_bcr_listar'),
    'gestion_punto_bcr'=>array('controller'=>'Controller','action'=> 'gestion_punto_bcr'),

    //Empresas
    'empresas_listar'=>array('controller'=>'Controller','action'=> 'empresas_listar'),
    'empresa_gestion'=>array('controller'=>'Controller','action'=> 'empresa_gestion'),
    'empresa_guardar'=>array('controller'=>'Controller','action'=> 'empresa_guardar'),
    'empresa_cambiar_estado'=>array('controller'=>'Controller','action'=> 'empresa_cambiar_estado'),
    
    //Personal
    'personal_listar'=>array('controller'=>'Controller','action'=> 'personal_listar'),    

    //Controlador de Usuarios
    'listar_usuarios'=> array('controller'=>'Controller','action'=>'listar_usuarios'),
    'gestion_usuarios' => array('controller'=> 'Controller','action'=>'gestion_usuarios'),
    'guardar_usuario' => array('controller'=> 'Controller','action'=>'guardar_usuario'),
    'cambiar_estado_usuario' => array('controller'=>'Controller','action'=>'cambiar_estado_usuario'),
    'reset_password'=>array('controller'=>'Controller', 'action'=>'reset_password'),
    'cambiar_password'=>array('controller'=>'Controller', 'action'=>'cambiar_password'),
    'recordar_password'=>array('controller'=>'Controller', 'action'=>'recordar_password'),
    'iniciar_sistema_cambiando_clave'=>array('controller'=>'Controller', 'action'=>'iniciar_sistema_cambiando_clave'),
    'cambia_clave_usuario_post'=>array('controller'=>'Controller', 'action'=>'cambia_clave_usuario_post')

    );
 

 // Parseo de la ruta
if (isset($_GET['ctl'])) {
    if (isset($map[$_GET['ctl']])) {
        $ruta = $_GET['ctl'];
    } else {
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                $_GET['ctl'] .
                '</p></body></html>';
        exit;
    }
} else {
    $ruta = 'inicio';
}

$controlador = $map[$ruta];
// Ejecución del controlador asociado a la ruta

if (method_exists($controlador['controller'],$controlador['action'])) {
    call_user_func(array(new $controlador['controller'], $controlador['action']));
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
            $controlador['controller'] .
            '->' .
            $controlador['action'] .
            '</i> no existe</h1></body></html>';
}