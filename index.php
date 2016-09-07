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
require_once __DIR__ . '/controladores/cls_trazabilidad.php';
require_once __DIR__ . '/controladores/cls_general.php';
require_once __DIR__ . '/controladores/cls_telefono.php';
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
    'nota_guardar' => array('controller' =>'Controller', 'action' =>'nota_guardar'),
    'nota_obtener' => array('controller' =>'Controller', 'action' =>'nota_obtener'),
    
    //Controlador de Modulos
    'modulos_listar' => array('controller' =>'Controller', 'action' =>'modulos_listar'),
    'modulos_gestion' => array('controller' =>'Controller', 'action' =>'modulos_gestion'),
    'modulos_cambiar_estado' => array('controller' =>'Controller', 'action' =>'modulos_cambiar_estado'),
    'modulos_guardar' => array('controller' =>'Controller', 'action' =>'modulos_guardar'),
     
    //Controlador de roles
    'guardar_rol' =>  array('controller'=>'Controller','action'=>'guardar_rol'),
    'listar_roles' =>  array('controller'=>'Controller','action'=>'listar_roles'),
    'cambiar_estado_rol' => array('controller' =>'Controller', 'action' =>'cambiar_estado_rol'),
    'gestion_roles'=>array('controller'=>'Controller', 'action'=>'gestion_roles'),
     
     //Controlador de Eventos (Bitacora Digital)
    
    'frm_eventos_listar' =>  array('controller'=>'Controller','action'=>'frm_eventos_listar'),
    'frm_eventos_agregar' =>  array('controller'=>'Controller','action'=>'frm_eventos_agregar'),
    'dibuja_tabla_eventos_relacionados_a_punto_bcr' =>  array('controller'=>'Controller','action'=>'dibuja_tabla_eventos_relacionados_a_punto_bcr'),
    'frm_eventos_lista_cerrados'=>  array('controller'=>'Controller','action'=>'frm_eventos_lista_cerrados'),
    'frm_eventos_recuperar' =>  array('controller'=>'Controller','action'=>'frm_eventos_recuperar'),
    'guardar_evento' =>  array('controller'=>'Controller','action'=>'guardar_evento'),
    'guardar_seguimiento_evento'=>  array('controller'=>'Controller','action'=> 'guardar_seguimiento_evento'),
    'frm_eventos_editar'=>  array('controller'=>'Controller','action'=>  'frm_eventos_editar'),
    'actualiza_en_vivo_punto_bcr'=>  array('controller'=>'Controller','action'=>  'actualiza_en_vivo_punto_bcr'),
    'alerta_en_vivo_mismo_punto_bcr_y_evento'=>  array('controller'=>'Controller','action'=>  'alerta_en_vivo_mismo_punto_bcr_y_evento'),
    'actualiza_en_vivo_reporte_cerrados'=>  array('controller'=>'Controller','action'=>  'actualiza_en_vivo_reporte_cerrados'),
        
    //Tipo de eventos
    'tipo_eventos_listar'=>array('controller'=>'Controller','action'=> 'tipo_eventos_listar'),
    'tipo_eventos_guardar'=>array('controller'=>'Controller','action'=> 'tipo_eventos_guardar'),
    'tipo_eventos_gestion'=>array('controller'=>'Controller','action'=> 'tipo_eventos_gestion'),
    'tipo_eventos_cambiar_estado'=>array('controller'=>'Controller','action'=> 'tipo_eventos_cambiar_estado'),
    'actualiza_en_vivo_estado_evento'=>array('controller'=>'Controller','action'=> 'actualiza_en_vivo_estado_evento'),

    //Areas de apoyo
    'areas_apoyo_listar'=>array('controller'=>'Controller','action'=> 'areas_apoyo_listar'),
    
    //Trazabilidad
    'frm_trazabilidad_listar'=>array('controller'=>'Controller','action'=> 'frm_trazabilidad_listar'),
    'actualiza_en_vivo_reporte_trazabilidad'=>array('controller'=>'Controller','action'=> 'actualiza_en_vivo_reporte_trazabilidad'),
    
    //PuntosBCR
    'puntos_bcr_listar'=>array('controller'=>'Controller','action'=> 'puntos_bcr_listar'),
    'gestion_punto_bcr'=>array('controller'=>'Controller','action'=> 'gestion_punto_bcr'),
    'actualiza_en_vivo_canton'=>array('controller'=>'Controller','action'=> 'actualiza_en_vivo_canton'),
    'actualiza_en_vivo_distrito'=>array('controller'=>'Controller','action'=> 'actualiza_en_vivo_distrito'),
    'distrito_PuntoBCR_guardar'=>array('controller'=>'Controller','action'=> 'distrito_PuntoBCR_guardar'),
    'puntoBCR_guardar_informacion_general'=>array('controller'=>'Controller','action'=> 'puntoBCR_guardar_informacion_general'),
    'puntobcr_desligar_telefono'=>array('controller'=>'Controller','action'=> 'puntobcr_desligar_telefono'),
    'punto_bcr_guardar'=>array('controller'=>'Controller','action'=> 'punto_bcr_guardar'),
    'puntobcr_numero_telefono_guardar'=>array('controller'=>'Controller','action'=> 'puntobcr_numero_telefono_guardar'),
    
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