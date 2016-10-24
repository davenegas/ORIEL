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
require_once __DIR__ . '/controladores/cls_unidad_ejecutora.php';
require_once __DIR__ . '/controladores/cls_puestos.php';
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
    'iniciar_sesion' => array('controller' =>'Controller', 'action' =>'iniciar_sesion'),
     
    //Información pública
    'personal_listar_publico'=>array('controller'=>'Controller', 'action'=>'personal_listar_publico'),
    'puntobcr_listar_publico'=>array('controller'=>'Controller', 'action'=>'puntobcr_listar_publico'),
    'frm_contacto_publico'=>array('controller'=>'Controller', 'action'=>'frm_contacto_publico'),
    'cuenta_visitas_a_la_pagina'=>array('controller'=>'Controller', 'action'=>'cuenta_visitas_a_la_pagina'),
    'cuenta_visitas_a_personal_publico'=>array('controller'=>'Controller', 'action'=>'cuenta_visitas_a_personal_publico'),
    'cuenta_visitas_a_personal_privado'=>array('controller'=>'Controller', 'action'=>'cuenta_visitas_a_personal_privado'),
    'cuenta_visitas_a_puntos_bcr_publico'=>array('controller'=>'Controller', 'action'=>'cuenta_visitas_a_puntos_bcr_publico'),
    'cuenta_visitas_a_puntos_bcr_privado'=>array('controller'=>'Controller', 'action'=>'cuenta_visitas_a_puntos_bcr_privado'),
    'cuenta_visitas_a_bitacora_digital'=>array('controller'=>'Controller', 'action'=>'cuenta_visitas_a_bitacora_digital'),
    
    //Controlador de Horarios
    'horario_listar'=>array('controller'=>'Controller', 'action'=>'horario_listar'),
    'horario_gestion'=>array('controller'=>'Controller', 'action'=>'horario_gestion'),
    'horario_guardar'=>array('controller'=>'Controller', 'action'=>'horario_guardar'),
    
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
    'Area_apoyo_agregar'=>array('controller'=>'Controller','action'=> 'Area_apoyo_agregar'), //Puntos BCR
    'Area_apoyo_nueva'=>array('controller'=>'Controller','action'=> 'Area_apoyo_nueva'),
    'area_apoyo_gestion'=>array('controller'=>'Controller','action'=> 'area_apoyo_gestion'),       
    'area_apoyo_eliminar_telefono'=>array('controller'=>'Controller','action'=> 'area_apoyo_eliminar_telefono'),  
    'area_apoyo_numero_telefono_guardar'=>array('controller'=>'Controller','action'=> 'area_apoyo_numero_telefono_guardar'),  
    
    //Controlador de Direcciones ip 
    'direcciones_ip_listar'=>array('controller'=>'Controller','action'=> 'direcciones_ip_listar'), 
    
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
    'puntobcr_agregar_ue'=>array('controller'=>'Controller','action'=> 'puntobcr_agregar_ue'),
    'puntobcr_desligar_ue'=>array('controller'=>'Controller','action'=> 'puntobcr_desligar_ue'),
    'puntobcr_asignar_area_apoyo'=>array('controller'=>'Controller','action'=> 'puntobcr_asignar_area_apoyo'),
    'puntobcr_desligar_area_apoyo'=>array('controller'=>'Controller','action'=> 'puntobcr_desligar_area_apoyo'),
    'direccionIP_agregar'=>array('controller'=>'Controller','action'=> 'direccionIP_agregar'),
    'puntobcr_asignar_direccion_ip'=>array('controller'=>'Controller','action'=> 'puntobcr_asignar_direccion_ip'),
    'puntobcr_desligar_direccion_ip'=>array('controller'=>'Controller','action'=> 'puntobcr_desligar_direccion_ip'),
    'PuntoBCR_actualiza_informacion_adicional'=>array('controller'=>'Controller','action'=> 'PuntoBCR_actualiza_informacion_adicional'),
    'punto_bcr_cambiar_estado'=>array('controller'=>'Controller','action'=> 'punto_bcr_cambiar_estado'),
    'puntobcr_asignar_horario'=>array('controller'=>'Controller','action'=> 'puntobcr_asignar_horario'),
     
    //Empresas
    'empresas_listar'=>array('controller'=>'Controller','action'=> 'empresas_listar'),
    'empresa_gestion'=>array('controller'=>'Controller','action'=> 'empresa_gestion'),
    'empresa_guardar'=>array('controller'=>'Controller','action'=> 'empresa_guardar'),
    'empresa_cambiar_estado'=>array('controller'=>'Controller','action'=> 'empresa_cambiar_estado'),
    
    //Personal
    'personal_listar'=>array('controller'=>'Controller','action'=> 'personal_listar'), 
    'personal_cambiar_estado'=>array('controller'=>'Controller','action'=> 'personal_cambiar_estado'),
    'personal_gestion'=>array('controller'=>'Controller','action'=> 'personal_gestion'),
    'personal_numero_telefono_guardar'=>array('controller'=>'Controller','action'=> 'personal_numero_telefono_guardar'),
    'personal_eliminar_telefono'=>array('controller'=>'Controller','action'=> 'personal_eliminar_telefono'),
    'personal_cambiar_ue'=>array('controller'=>'Controller','action'=> 'personal_cambiar_ue'),
    'personal_cambiar_puesto'=>array('controller'=>'Controller','action'=> 'personal_cambiar_puesto'),
    'persona_guardar_informacion_general'=>array('controller'=>'Controller','action'=> 'persona_guardar_informacion_general'),
    
    //Importación de Prontuario
    'frm_importar_prontuario_paso_1'=>array('controller'=>'Controller','action'=> 'frm_importar_prontuario_paso_1'),
    'frm_importar_prontuario_paso_2'=>array('controller'=>'Controller','action'=> 'frm_importar_prontuario_paso_2'),
    'frm_importar_prontuario_paso_3'=>array('controller'=>'Controller','action'=> 'frm_importar_prontuario_paso_3'),
    'frm_importar_prontuario_paso_4'=>array('controller'=>'Controller','action'=> 'frm_importar_prontuario_paso_4'),
    'frm_importar_prontuario_paso_5'=>array('controller'=>'Controller','action'=> 'frm_importar_prontuario_paso_5'),
    'frm_importar_prontuario_paso_6'=>array('controller'=>'Controller','action'=> 'frm_importar_prontuario_paso_6'),
    'frm_importar_prontuario_paso_7'=>array('controller'=>'Controller','action'=> 'frm_importar_prontuario_paso_7'),
    'frm_importar_prontuario_paso_8'=>array('controller'=>'Controller','action'=> 'frm_importar_prontuario_paso_8'),
    'frm_importar_prontuario_paso_9'=>array('controller'=>'Controller','action'=> 'frm_importar_prontuario_paso_9'),
    'frm_importar_prontuario_paso_10'=>array('controller'=>'Controller','action'=> 'frm_importar_prontuario_paso_10'),
    'frm_importar_prontuario_paso_11'=>array('controller'=>'Controller','action'=> 'frm_importar_prontuario_paso_11'),

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