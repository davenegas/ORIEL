<?php
//Inicio de sesión de usuario para el control de la seguridad
/*
 * El manejo de sesiones permite establecer la seguridad y manejo de usuarios dentro del sistema,
 * trabaja de la mano y en conjunto con los roles, módulos y usuarios del sistema.
 */
session_start();
// carga del modelo y los controladores
//Controlador requerido para la capa de datos
/*
 En este momento y mediante la llamada del index, se realiza una sola vez la importación de todas
 * las librerías, componentes y elementos que el sitio requerirá dentro de toda su funcionalidad.
 * Para esto se utiliza la variable reservada DIR, haciendo referencia al directorio raíz contenedor
 * del proyecto ORIEL. La instrucción require_once importa la clase o el componente dentro del proyecto
 * para su futura utilización.
 */
require_once __DIR__ . '/modelos/Data_Provider.php';
require_once __DIR__ . '/modelos/Access_Provider.php';
//Libreria de clases --> Control de BD RapidEye
require_once __DIR__ . '/controladores/cls_rapid_eye_db.php';
//Libreria de clases --> Control de usuarios
require_once __DIR__ . '/controladores/cls_usuarios.php';
//Libreria de clases --> Control de roles de usuarios
require_once __DIR__ . '/controladores/cls_roles.php';
//Libreria de clases --> Control de módulos y funcionalidades de seguridad
require_once __DIR__ . '/controladores/cls_modulos.php';
//Libreria de clases --> Control de eventos de bitácora
require_once __DIR__ . '/controladores/cls_eventos.php';
//Libreria de clases --> Control de Puestos de Monitoreo
require_once __DIR__ . '/controladores/cls_puestos_de_monitoreo.php';
//Libreria de clases --> Control de Unidades de Video
require_once __DIR__ . '/controladores/cls_unidad_video.php';
//Libreria de clases --> Control de áreas de apoyo
require_once __DIR__ . '/controladores/cls_areasapoyo.php';
//Libreria de clases --> Control de Puntos BCR
require_once __DIR__ . '/controladores/cls_puntosBCR.php';
//Libreria de clases --> Control de Empresas
require_once __DIR__ . '/controladores/cls_empresa.php';
//Libreria de clases --> Control de personal(interno y externo)
require_once __DIR__ . '/controladores/cls_personal.php';
//Libreria de clases --> Control de personal
require_once __DIR__ . '/controladores/cls_personal_externo.php';
//Libreria de clases --> Control de horarios
require_once __DIR__ . '/controladores/cls_horario.php';
//Libreria de clases --> Control de direcciones IP
require_once __DIR__ . '/controladores/cls_direccionIP.php';
//Libreria de clases --> Control de trazabilidad (seguimiento a la actividad de usarios dentro del sistema)
require_once __DIR__ . '/controladores/cls_trazabilidad.php';
//Libreria de clases --> Control de elementos y funcionalidades generales 
require_once __DIR__ . '/controladores/cls_general.php';
//Libreria de clases --> Control de Gerentes de Zona
require_once __DIR__ . '/controladores/cls_gerente_zona.php';
//Libreria de clases --> Control de teléfonos 
require_once __DIR__ . '/controladores/cls_telefono.php';
//Libreria de clases --> Control de unidades ejecutoras
require_once __DIR__ . '/controladores/cls_unidad_ejecutora.php';
//Libreria de clases --> Controladores de tipo telefono
require_once __DIR__ . '/controladores/cls_tipo_telefono.php';
//Libreria de clases --> Controladores de tipo punto
require_once __DIR__ . '/controladores/cls_tipo_punto.php';
//Libreria de clases --> Controladores supervisor de zona
require_once __DIR__ . '/controladores/cls_supervisor_zona.php';
//Libreria de clases --> Control de puestos 
require_once __DIR__ . '/controladores/cls_puestos.php';
//Libreria de clases --> Control de horarios
require_once __DIR__ . '/controladores/cls_proveedor_enlace.php';
//Libreria de clases --> Control de tipos de enlaces en el sistema
require_once __DIR__ . '/controladores/cls_tipo_enlace.php';
//Libreria de clases --> Control de medios de enlace
require_once __DIR__ . '/controladores/cls_medio_enlace.php';
//Libreria de clases --> Control de padrones fotográficos para puntos BCR
require_once __DIR__ . '/controladores/cls_padron_fotografico_puntosbcr.php';
//Libreria de clases --> Control de padrones fotográficos para unidades de video
require_once __DIR__ . '/controladores/cls_padron_fotografico_unidades_de_video.php';
//Libreria de clases --> Control de enlaces del departamento de telecomunicaciones
require_once __DIR__ . '/controladores/cls_enlace_telecom.php';
//Libreria de clases --> Control de estado civil
require_once __DIR__ . '/controladores/cls_estado_civil.php';
//Libreria de clases --> Control de estado del personal
require_once __DIR__ . '/controladores/cls_estado_persona.php';
//Libreria de clases --> Control de nacionalidad
require_once __DIR__ . '/controladores/cls_nacionalidad.php';
//Libreria de clases --> Control de nivel academico
require_once __DIR__ . '/controladores/cls_nivel_academico.php';
//Libreria de clases --> Control de Cencon
require_once __DIR__ . '/controladores/cls_cencon.php';
//Libreria de clases --> Control de Pruebas de alarma
require_once __DIR__ . '/controladores/cls_prueba_alarma.php';
//Libreria de clases --> Control para sistemad de reportes
require_once __DIR__ . '/controladores/cls_reporteria.php';
//
require_once __DIR__ . '/controladores/cls_control_acceso.php';
//
require_once __DIR__ . '/controladores/cls_programacion.php';
//Libreria de clases --> Control para sistema de biblioteca
require_once __DIR__ . '/controladores/cls_biblioteca.php';
//Libreria de clases --> Control para Botones RF
require_once __DIR__ . '/controladores/cls_botones.php';
//Libreria de clases --> Control para correos
require_once __DIR__ . '/controladores/cls_correos.php';
//Libreria de clases --> Control para andru_preguntas
require_once __DIR__ . '/controladores/cls_andru_preguntas.php';
//Libreria de clases --> Control para andru_fases
require_once __DIR__ . '/controladores/cls_andru_fases.php';
//Libreria de clases --> Control para andru_categoria
require_once __DIR__ . '/controladores/cls_andru_categoria.php';
//Libreria de clases --> Control para andru_tipos_porcentajes
require_once __DIR__ . '/controladores/cls_andru_tipos_porcentajes.php';
//Libreria de clases --> Control para andru_preguntas_porcentajes
require_once __DIR__ . '/controladores/cls_andru_preguntas_porcentajes.php';
//Libreria de clases --> Control para andru_preguntas_respuestas
require_once __DIR__ . '/controladores/cls_andru_preguntas_respuestas.php';
//Libreria de clases --> Control para andru_cuestionario
require_once __DIR__ . '/controladores/cls_andru_cuestionario.php';
//Libreria de clases --> Control para andru_cuestionario_respuestas
require_once __DIR__ . '/controladores/cls_andru_cuestionario_respuestas.php';
//Libreria de clases --> Control para alerta_general_detalle
require_once __DIR__ . '/controladores/cls_alerta_general_detalle.php';
//Libreria de clases --> Control para puntobcr_correo
require_once __DIR__ . '/controladores/cls_puntobcr_correo.php';

//Libreria de clases --> Control para clave_tipo
require_once __DIR__ . '/controladores/cls_clave_tipo.php';

//Libreria de clases --> Control para clave
require_once __DIR__ . '/controladores/cls_clave.php';

//Libreria de clases --> Control para tipoip
require_once __DIR__ . '/controladores/cls_tipoip.php';
//Libreria de clases --> Control para net_test
require_once __DIR__ . '/controladores/cls_net_test.php';
//Libreria de clases --> Control para net_puesto
require_once __DIR__ . '/controladores/cls_net_puesto.php';
//Libreria de clases --> Control para pruebaalarmad
require_once __DIR__ . '/controladores/cls_pruebaalarmad.php';
//Libreria de clases --> Control para recepcion_puesto
require_once __DIR__ . '/controladores/cls_recepcion_puesto.php';
//Libreria de clases --> Control para recepcion_puesto_tipos
require_once __DIR__ . '/controladores/cls_recepcion_puesto_tipos.php';
//Libreria de clases --> Control para recepcion_apertura
require_once __DIR__ . '/controladores/cls_recepcion_apertura.php';
//Libreria de clases --> Control para recepcion_inventario
require_once __DIR__ . '/controladores/cls_recepcion_inventario.php';
//Libreria de clases --> Control para recepcion_parqueo
require_once __DIR__ . '/controladores/cls_recepcion_parqueo.php';
//Libreria de clases --> Control para recepcion_parqueobitacora
require_once __DIR__ . '/controladores/cls_recepcion_parqueobitacora.php';
//Libreria de clases --> Control para recepcion_visita
require_once __DIR__ . '/controladores/cls_recepcion_visita.php';
/*
* El elemento controller, constituye la base y esencia de toda la lógica del negocio, en este
* se almacenan cada una de las funcionales de ORIEl. El archivo en sí, se compone de "n" cantidad
* de eventos de clase que son llamados según las necesidades del usuario y el sistema en si.
*/
require_once __DIR__ . '/modelos/Controller.php';
/*
* Componente que permite realizar funciones especiales dentro del sistema, dentro de las cuales
* están: encriptar información sensible, quitar tíldes, caracteres especiales, etc.
*/
require_once __DIR__ . '/modelos/Encrypter.php';
// Librería open source para el manejo y transacción de correos electrónicos.
require_once __DIR__ . '/modelos/PHPMailerAutoload.php';
/*
* Librería open source para el manejo y transacción de correos electrónicos. Trabaja en conjunto con
* la anterior.
*/
require_once __DIR__ . '/modelos/class.phpmailer.php';
/*
* Librería open source para el manejo y transacción de correos electrónicos. Trabaja en conjunto con
* la anterior.
*/
require_once __DIR__ . '/modelos/class.smtp.php';
/*
* Librería de clase, para el manejo y envío de correos electrónicos, hecha exclusivamente para el proyecto
* ORIEL. Integra las tres librerías OPEN SOURCE anteriormente citadas.
*/
require_once __DIR__ . '/modelos/Mail_Provider.php';
/*
* Dentro del concepto de modelo vista controlador, se maneja el siguiente vector de nombres  de eventos de la clase controlador.
* Permite declarar cada funcionalidad definida en el controlador para su correcta utilización. Si no se declara el nombre del evento
* en este vector, no será posible utilizar su definición dentro del sistema ORIEL. 
*/
// enrutamiento, se enlistan cada una de las funcionalidades del controller entre comillas, tanto al inicio como al final de la línea (deben de coincidir)
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
    'ejecucion_automatico_proceso' => array('controller' =>'Controller', 'action' =>'ejecucion_automatico_proceso'),
    
    'comite_crisis' => array('controller' =>'Controller', 'action' =>'comite_crisis'),
    
    //Controlador de Manuales de ayuda
    'manual_ayuda_privado'=>array('controller'=>'Controller', 'action'=>'manual_ayuda_privado'),
    'manual_personal_externo_publico'=>array('controller'=>'Controller', 'action'=>'manual_personal_externo_publico'),
    
    //Controlador de Reportes
    'reporte_seguimiento_eventos'=>array('controller'=>'Controller', 'action'=>'reporte_seguimiento_eventos'),
    'reporte_eventos_provincia'=>array('controller'=>'Controller', 'action'=>'reporte_eventos_provincia'),
    'reporte_lineas_telefonicas'=>array('controller'=>'Controller', 'action'=>'reporte_lineas_telefonicas'),
    'alertas_generales'=>array('controller'=>'Controller', 'action'=>'alertas_generales'),
    'reporte_inconsistencias_pruebas'=>array('controller'=>'Controller', 'action'=>'reporte_inconsistencias_pruebas'),
    'enlace_reporte'=>array('controller'=>'Controller', 'action'=>'enlace_reporte'),
    'reporte_tl300_en_puntos_bcr_listar'=>array('controller'=>'Controller', 'action'=>'reporte_tl300_en_puntos_bcr_listar'),
    'reporte_eventos_bitacora_digital'=>  array('controller'=>'Controller','action'=>  'reporte_eventos_bitacora_digital'),
    'actualiza_en_vivo_reporte_eventos'=>  array('controller'=>'Controller','action'=>  'actualiza_en_vivo_reporte_eventos'),
    'actualiza_en_vivo_reporte_eventos_cerrados'=>  array('controller'=>'Controller','action'=>  'actualiza_en_vivo_reporte_eventos_cerrados'),
    'reporte_aperturas_cierres'=>  array('controller'=>'Controller','action'=>  'reporte_aperturas_cierres'),
    'actualiza_en_vivo_reporte_aperturas_cierres'=>  array('controller'=>'Controller','action'=>  'actualiza_en_vivo_reporte_aperturas_cierres'),
    
    //Información pública
    'personal_listar_publico'=>array('controller'=>'Controller', 'action'=>'personal_listar_publico'),
    'puntobcr_listar_publico'=>array('controller'=>'Controller', 'action'=>'puntobcr_listar_publico'),
    'personal_externo_listar_publico'=>array('controller'=>'Controller', 'action'=>'personal_externo_listar_publico'),
    'frm_contacto_publico'=>array('controller'=>'Controller', 'action'=>'frm_contacto_publico'),
    'cuenta_visitas_a_la_pagina'=>array('controller'=>'Controller', 'action'=>'cuenta_visitas_a_la_pagina'),
    'cuenta_visitas_a_personal_publico'=>array('controller'=>'Controller', 'action'=>'cuenta_visitas_a_personal_publico'),
    'cuenta_visitas_a_personal_privado'=>array('controller'=>'Controller', 'action'=>'cuenta_visitas_a_personal_privado'),
    'cuenta_visitas_a_puntos_bcr_publico'=>array('controller'=>'Controller', 'action'=>'cuenta_visitas_a_puntos_bcr_publico'),
    'cuenta_visitas_a_puntos_bcr_privado'=>array('controller'=>'Controller', 'action'=>'cuenta_visitas_a_puntos_bcr_privado'),
    'cuenta_visitas_a_bitacora_digital'=>array('controller'=>'Controller', 'action'=>'cuenta_visitas_a_bitacora_digital'),
    
    //Controles de Video
    'unidades_de_video_listar'=>array('controller'=>'Controller', 'action'=>'unidades_de_video_listar'),
    'editar_campo_unidades_de_video'=>array('controller'=>'Controller', 'action'=>'editar_campo_unidades_de_video'),
    'agregar_nueva_unidad_de_video'=>array('controller'=>'Controller', 'action'=>'agregar_nueva_unidad_de_video'),
    'frm_unidades_de_video_padron_fotografico'=>array('controller'=>'Controller','action'=> 'frm_unidades_de_video_padron_fotografico'),
    'guardar_imagen_unidades_de_video'=>array('controller'=>'Controller','action'=> 'guardar_imagen_unidades_de_video'), 
    'eliminar_imagen_padron_unidades_de_video'=>array('controller'=>'Controller','action'=> 'eliminar_imagen_padron_unidades_de_video'), 
    'puestos_de_monitoreo_listar'=>array('controller'=>'Controller','action'=> 'puestos_de_monitoreo_listar'), 
    'puestos_de_monitoreo_editar'=>array('controller'=>'Controller','action'=> 'puestos_de_monitoreo_editar'), 
    'puesto_monitoreo_guardar'=>array('controller'=>'Controller','action'=> 'puesto_monitoreo_guardar'), 
    'puesto_monitoreo_cambiar_estado'=>array('controller'=>'Controller','action'=> 'puesto_monitoreo_cambiar_estado'), 
    'actualiza_puesto_de_monitoreo'=>array('controller'=>'Controller','action'=> 'actualiza_puesto_de_monitoreo'), 
    'tomar_puesto_de_monitoreo'=>array('controller'=>'Controller','action'=> 'tomar_puesto_de_monitoreo'),
    'liberar_puesto_de_monitoreo'=>array('controller'=>'Controller','action'=> 'liberar_puesto_de_monitoreo'),    
    'controles_de_video_listar'=>array('controller'=>'Controller','action'=> 'controles_de_video_listar'),    
    'actualiza_segundero_revision_video'=>array('controller'=>'Controller','action'=> 'actualiza_segundero_revision_video'),    
    'guarda_revision_de_video_actual'=>array('controller'=>'Controller','action'=> 'guarda_revision_de_video_actual'),    
    'guarda_justificacion_retraso_control_de_video'=>array('controller'=>'Controller','action'=> 'guarda_justificacion_retraso_control_de_video'),    
    'inconsistencias_de_video_listar'=>array('controller'=>'Controller','action'=> 'inconsistencias_de_video_listar'),    
    'validar_inconsistencias_video_guardar'=>array('controller'=>'Controller','action'=> 'validar_inconsistencias_video_guardar'),    
    'reportar_inconsistencias_video_guardar'=>array('controller'=>'Controller','action'=> 'reportar_inconsistencias_video_guardar'),    
    'solucionar_inconsistencias_video_guardar'=>array('controller'=>'Controller','action'=> 'solucionar_inconsistencias_video_guardar'),    
    'reporte_controles_de_video'=>array('controller'=>'Controller', 'action'=>'reporte_controles_de_video'),  
    'reporte_controles_de_video_listar'=>array('controller'=>'Controller', 'action'=>'reporte_controles_de_video_listar'),
    'reporte_revisiones_video'=>array('controller'=>'Controller', 'action'=>'reporte_revisiones_video'),
    'reporte_ultimas_revisiones_video'=>array('controller'=>'Controller', 'action'=>'reporte_ultimas_revisiones_video'),
    'reporte_ultimas_revisiones_video_completo'=>array('controller'=>'Controller', 'action'=>'reporte_ultimas_revisiones_video_completo'),
    'reporte_tiempo_revision_actual'=>array('controller'=>'Controller', 'action'=>'reporte_tiempo_revision_actual'),
    'revision_controles_desatendidos'=>array('controller'=>'Controller', 'action'=>'revision_controles_desatendidos'),
    'sincronizacion_base_de_datos_rapid_eye'=>array('controller'=>'Controller', 'action'=>'sincronizacion_base_de_datos_rapid_eye'),
    'actualizar_serie_y_descripcion_en_unidad_de_video'=>array('controller'=>'Controller', 'action'=>'actualizar_serie_y_descripcion_en_unidad_de_video'),
    'subir_bd_rapid_al_servidor'=>array('controller'=>'Controller', 'action'=>'subir_bd_rapid_al_servidor'),
    
    
    //Información Proveedor enlaces
    'proveedor_listar'=>array('controller'=>'Controller', 'action'=>'proveedor_listar'),
    'proveedor_enlace_guardar'=>array('controller'=>'Controller', 'action'=>'proveedor_enlace_guardar'),
    'proveedor_enlace_cambiar_estado'=>array('controller'=>'Controller', 'action'=>'proveedor_enlace_cambiar_estado'),
    
    //Información Tipos de enlaces
    'tipo_enlace_listar'=>array('controller'=>'Controller', 'action'=>'tipo_enlace_listar'),
    'tipo_enlace_cambiar_estado'=>array('controller'=>'Controller', 'action'=>'tipo_enlace_cambiar_estado'),
    'tipo_enlace_guardar'=>array('controller'=>'Controller', 'action'=>'tipo_enlace_guardar'),
    
    //Controlador de medio de enlace
    'medio_enlace_listar'=>array('controller'=>'Controller', 'action'=>'medio_enlace_listar'),
    'medio_enlace_guardar'=>array('controller'=>'Controller', 'action'=>'medio_enlace_guardar'),
    'medio_enlace_cambiar_estado'=>array('controller'=>'Controller', 'action'=>'medio_enlace_cambiar_estado'),
    
    //Controlador de Unidades Ejecutoras
    'unidad_ejecutora_listar'=>array('controller'=>'Controller', 'action'=>'unidad_ejecutora_listar'),
    'unidad_ejecutora_catalogo'=>array('controller'=>'Controller', 'action'=>'unidad_ejecutora_catalogo'),
    'unidad_ejecutora_guardar'=>array('controller'=>'Controller', 'action'=>'unidad_ejecutora_guardar'),
    'unidad_ejecutora_cambiar_estado'=>array('controller'=>'Controller', 'action'=>'unidad_ejecutora_cambiar_estado'),
   
    //Controlador de Supervisor de Zona
    'supervisor_zona_listar'=>array('controller'=>'Controller', 'action'=>'supervisor_zona_listar'),
    'supervisor_zona_guardar'=>array('controller'=>'Controller', 'action'=>'supervisor_zona_guardar'),
    'supervisor_zona_editar'=>array('controller'=>'Controller','action'=>'supervisor_zona_editar'),
    'supervisor_zona_cambiar_estado'=>array('controller'=>'Controller', 'action'=>'supervisor_zona_cambiar_estado'),
    
    //Controlador de telefonos
    'tipo_telefono_listar'=>array('controller'=>'Controller', 'action'=>'tipo_telefono_listar'),
    'tipo_telefono_guardar'=>array('controller'=>'Controller', 'action'=>'tipo_telefono_guardar'),
    'tipo_telefono_cambiar_estado'=>array('controller'=>'Controller', 'action'=>'tipo_telefono_cambiar_estado'),
    
    //Controlador de gerentes de zona
    'gerente_zona_listar'=>array('controller'=>'Controller', 'action'=>'gerente_zona_listar'),
    'gerente_zona_guardar'=>array('controller'=>'Controller', 'action'=>'gerente_zona_guardar'),
    'gerente_zona_editar'=>array('controller'=>'Controller','action'=>'gerente_zona_editar'),
    'gerente_zona_cambiar_estado'=>array('controller'=>'Controller', 'action'=>'gerente_zona_cambiar_estado'),
    
    //Controlador de Punto
    'tipo_punto_listar'=>array('controller'=>'Controller', 'action'=>'tipo_punto_listar'),
    'tipo_punto_guardar'=>array('controller'=>'Controller', 'action'=>'tipo_punto_guardar'),
    'tipo_punto_cambiar_estado'=>array('controller'=>'Controller', 'action'=>'tipo_punto_cambiar_estado'),

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
     
    //Controlador de Cencon
    'eventos_cencon'=>array('controller'=>'Controller', 'action'=>'eventos_cencon'),
    'cencon_gestion'=>array('controller'=>'Controller', 'action'=>'cencon_gestion'),
    'cencon_agregar_relacion'=>array('controller'=>'Controller', 'action'=>'cencon_agregar_relacion'),
    'cencon_buscar_relaciones'=>array('controller'=>'Controller', 'action'=>'cencon_buscar_relaciones'),
    'cencon_eliminar_relacion'=>array('controller'=>'Controller', 'action'=>'cencon_eliminar_relacion'),
    'evento_buscar_cajero'=>array('controller'=>'Controller', 'action'=>'evento_buscar_cajero'),
    'evento_buscar_persona'=>array('controller'=>'Controller', 'action'=>'evento_buscar_persona'),
    'evento_buscar_relaciones'=>array('controller'=>'Controller', 'action'=>'evento_buscar_relaciones'),
    'evento_nuevo_guardar'=>array('controller'=>'Controller', 'action'=>'evento_nuevo_guardar'),
    'evento_cencon_cerrar'=>array('controller'=>'Controller', 'action'=>'evento_cencon_cerrar'),
    'evento_cencon_observaciones'=>array('controller'=>'Controller', 'action'=>'evento_cencon_observaciones'),
    'evento_cencon_seguimiento'=>array('controller'=>'Controller', 'action'=>'evento_cencon_seguimiento'),
    'cencon_observaciones'=>array('controller'=>'Controller', 'action'=>'cencon_observaciones'),
    'evento_cencon_reasignar'=>array('controller'=>'Controller', 'action'=>'evento_cencon_reasignar'),
    'reporte_cencon'=>array('controller'=>'Controller', 'action'=>'reporte_cencon'),
    'actualiza_en_vivo_reporte_cencon'=>array('controller'=>'Controller', 'action'=>'actualiza_en_vivo_reporte_cencon'),
    'todos_cajero_relacion'=>array('controller'=>'Controller', 'action'=>'todos_cajero_relacion'),
    'cencon_lista_sin_coordinar'=>array('controller'=>'Controller', 'action'=>'cencon_lista_sin_coordinar'),
    'reporte_seguimiento_cencon'=>array('controller'=>'Controller', 'action'=>'reporte_seguimiento_cencon'),
    'reporte_contador_video'=>array('controller'=>'Controller', 'action'=>'reporte_contador_video'),
    
    //Controlador de pruebas de alarma
    'pruebas_alarma'=>array('controller'=>'Controller', 'action'=>'pruebas_alarma'),
    'buscar_punto_prueba_alarma'=>array('controller'=>'Controller', 'action'=>'buscar_punto_prueba_alarma'),
    'buscar_prueba_alarma'=>array('controller'=>'Controller', 'action'=>'buscar_prueba_alarma'),
    'prueba_alarma_guardar'=>array('controller'=>'Controller', 'action'=>'prueba_alarma_guardar'),
    'prueba_alarma_eliminar'=>array('controller'=>'Controller', 'action'=>'prueba_alarma_eliminar'),
    'reporte_prueba_alarma'=>array('controller'=>'Controller', 'action'=>'reporte_prueba_alarma'),
    'pruebas_alarma_anteriores'=>array('controller'=>'Controller', 'action'=>'pruebas_alarma_anteriores'),
    'numero_zona_prueba_realizadas'=>array('controller'=>'Controller', 'action'=>'numero_zona_prueba_realizadas'),
    
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
    'eventos_listar_filtrado'=>  array('controller'=>'Controller','action'=>  'eventos_listar_filtrado'),
    'notas_coordinacion_bitacora_guardar'=>  array('controller'=>'Controller','action'=>  'notas_coordinacion_bitacora_guardar'),
    'mezcla_eventos_bitacora_digital'=>  array('controller'=>'Controller','action'=>  'mezcla_eventos_bitacora_digital'),
    'eliminar_mezcla_eventos_bitacora'=>  array('controller'=>'Controller','action'=>  'eliminar_mezcla_eventos_bitacora'),
    'dibuja_tabla_seguimiento_evento'=>  array('controller'=>'Controller','action'=>  'dibuja_tabla_seguimiento_evento'),
    
    //Tipo de eventos
    'tipo_eventos_listar'=>array('controller'=>'Controller','action'=> 'tipo_eventos_listar'),
    'tipo_eventos_guardar'=>array('controller'=>'Controller','action'=> 'tipo_eventos_guardar'),
    'tipo_eventos_gestion'=>array('controller'=>'Controller','action'=> 'tipo_eventos_gestion'),
    'tipo_eventos_cambiar_estado'=>array('controller'=>'Controller','action'=> 'tipo_eventos_cambiar_estado'),
    'actualiza_en_vivo_estado_evento'=>array('controller'=>'Controller','action'=> 'actualiza_en_vivo_estado_evento'),
    'tipo_evento_cierre_guardar'=>array('controller'=>'Controller','action'=> 'tipo_evento_cierre_guardar'),

    //Areas de apoyo
    'areas_apoyo_listar'=>array('controller'=>'Controller','action'=> 'areas_apoyo_listar'),
    'Area_apoyo_agregar'=>array('controller'=>'Controller','action'=> 'Area_apoyo_agregar'), //Puntos BCR
    'area_apoyo_actualizar'=>array('controller'=>'Controller','action'=> 'area_apoyo_actualizar'),
    'area_apoyo_gestion'=>array('controller'=>'Controller','action'=> 'area_apoyo_gestion'),       
    'area_apoyo_eliminar_telefono'=>array('controller'=>'Controller','action'=> 'area_apoyo_eliminar_telefono'),  
    'area_apoyo_numero_telefono_guardar'=>array('controller'=>'Controller','action'=> 'area_apoyo_numero_telefono_guardar'),  
    
    //Controlador de Direcciones ip 
    'direcciones_ip_listar'=>array('controller'=>'Controller','action'=> 'direcciones_ip_listar'),
    'direcciones_ip_guardar'=>array('controller'=>'Controller', 'action'=>'direcciones_ip_guardar'),
    'direcciones_ip_cambiar_estado'=>array('controller'=>'Controller', 'action'=>'direcciones_ip_cambiar_estado'),
    
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
    'enlace_puntobcr_guardar'=>array('controller'=>'Controller','action'=> 'enlace_puntobcr_guardar'),
    'puntobcr_eliminar_enlace'=>array('controller'=>'Controller','action'=> 'puntobcr_eliminar_enlace'),
    'frm_puntos_bcr_padron_fotografico'=>array('controller'=>'Controller','action'=> 'frm_puntos_bcr_padron_fotografico'),
    'guardar_imagen_puntos_bcr'=>array('controller'=>'Controller','action'=> 'guardar_imagen_puntos_bcr'), 
    'eliminar_imagen_padron_puntobcr'=>array('controller'=>'Controller','action'=> 'eliminar_imagen_padron_puntobcr'), 
    'puntobcr_eliminar_horario'=>array('controller'=>'Controller','action'=> 'puntobcr_eliminar_horario'), 
    'enlace_guardar'=>array('controller'=>'Controller','action'=> 'enlace_guardar'), 
    'enlace_exportar'=>array('controller'=>'Controller','action'=> 'enlace_exportar'), 
   
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
    'telefono_cambiar_estado'=>array('controller'=>'Controller','action'=> 'telefono_cambiar_estado'),
    
    
    //Control de Acceso
        //Controller
    'actualizar_controladores_inicio'=>array('controller'=>'Controller','action'=> 'actualizar_controladores_inicio'),
    'actualizar_controladores_paso_1'=>array('controller'=>'Controller','action'=> 'actualizar_controladores_paso_1'),
    'actualizar_controladores_paso_2'=>array('controller'=>'Controller','action'=> 'actualizar_controladores_paso_2'),
        //Puertas controladas
    'actualizar_puerta_controlada_inicio'=>array('controller'=>'Controller','action'=> 'actualizar_puerta_controlada_inicio'),
    'actualizar_puertas_paso_1'=>array('controller'=>'Controller','action'=> 'actualizar_puertas_paso_1'),
    'actualizar_puertas_paso_2'=>array('controller'=>'Controller','action'=> 'actualizar_puertas_paso_2'),
        //Módulos de puertas controladas
    'actualizar_modulo_puerta_inicio'=>array('controller'=>'Controller','action'=> 'actualizar_modulo_puerta_inicio'),
    'actualizar_modulo_puerta_paso_1'=>array('controller'=>'Controller','action'=> 'actualizar_modulo_puerta_paso_1'),
    'actualizar_modulo_puerta_paso_2'=>array('controller'=>'Controller','action'=> 'actualizar_modulo_puerta_paso_2'),
        //Accesos programados
    'programacion_accesos'=>array('controller'=>'Controller','action'=> 'programacion_accesos'),
    'programacion_guardar'=>array('controller'=>'Controller','action'=> 'programacion_guardar'),
    'actualiza_en_vivo_reporte_programaciones'=>array('controller'=>'Controller','action'=> 'actualiza_en_vivo_reporte_programaciones'),
    'dibuja_tabla_modulos_programados'=>array('controller'=>'Controller','action'=> 'dibuja_tabla_modulos_programados'),
    'programacion_completar'=>array('controller'=>'Controller','action'=> 'programacion_completar'),
    
    //Controlador de Personal Externo
    'personal_externo_listar'=>array('controller'=>'Controller','action'=> 'personal_externo_listar'), 
    'personal_externo_gestion'=>array('controller'=>'Controller','action'=> 'personal_externo_gestion'), 
    'personal_externo_numero_telefono_guardar'=>array('controller'=>'Controller','action'=> 'personal_externo_numero_telefono_guardar'), 
    'personal_externo_eliminar_telefono'=>array('controller'=>'Controller','action'=> 'personal_externo_eliminar_telefono'), 
    'persona_externa_guardar_informacion'=>array('controller'=>'Controller','action'=> 'persona_externa_guardar_informacion'), 
    'guardar_imagen_persona_externa'=>array('controller'=>'Controller','action'=> 'guardar_imagen_persona_externa'), 
    'eliminar_imagen_personal_externo'=>array('controller'=>'Controller','action'=> 'eliminar_imagen_personal_externo'), 
    'personal_externo_validar'=>array('controller'=>'Controller','action'=> 'personal_externo_validar'), 
    'guardar_historia_persona_externa'=>array('controller'=>'Controller','action'=> 'guardar_historia_persona_externa'), 
    
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
    
    //Solicitud de Permisos
    'solicitud_permiso'=>array('controller'=>'Controller','action'=> 'solicitud_permiso'),
    
    //Biblioteca
    'biblioteca_listar'=>array('controller'=>'Controller','action'=> 'biblioteca_listar'),
    'guardar_Biblioteca'=>array('controller'=>'Controller','action'=> 'guardar_Biblioteca'),
    
    //Agregar los action al controler de la clase cls_andru_preguntas
    'andru_preguntas_listar'=>array('controller'=>'Controller','action'=> 'andru_preguntas_listar'),
    'andru_preguntas_guardar'=>array('controller'=>'Controller','action'=> 'andru_preguntas_guardar'),
    'andru_preguntas_cambiar_estado'=>array('controller'=>'Controller','action'=> 'andru_preguntas_cambiar_estado'),
    
    //Agregar los action al controler de la clase cls_andru_cuestionario
    'andru_cuestionario'=>array('controller'=>'Controller','action'=> 'andru_cuestionario'),
    'andru_cuestionario_listar'=>array('controller'=>'Controller','action'=> 'andru_cuestionario_listar'),
    'andru_cuestionario_guardar'=>array('controller'=>'Controller','action'=> 'andru_cuestionario_guardar'),
    'andru_cuestionario_cambiar_estado'=>array('controller'=>'Controller','action'=> 'andru_cuestionario_cambiar_estado'),
    
    //Agregar los action al controler de la clase cls_andru_fases
    'andru_fases_listar'=>array('controller'=>'Controller','action'=> 'andru_fases_listar'),
    'andru_fases_guardar'=>array('controller'=>'Controller','action'=> 'andru_fases_guardar'),
    'andru_fases_cambiar_estado'=>array('controller'=>'Controller','action'=> 'andru_fases_cambiar_estado'),

    //Agregar los action al controler de la clase cls_andru_categoria
    'andru_categoria_listar'=>array('controller'=>'Controller','action'=> 'andru_categoria_listar'),
    'andru_categoria_guardar'=>array('controller'=>'Controller','action'=> 'andru_categoria_guardar'),
    'andru_categoria_cambiar_estado'=>array('controller'=>'Controller','action'=> 'andru_categoria_cambiar_estado'),
    
    //Agregar los action al controler de la clase cls_andru_tipos_porcentajes
    'andru_tipos_porcentajes_listar'=>array('controller'=>'Controller','action'=> 'andru_tipos_porcentajes_listar'),
    'andru_tipos_porcentajes_guardar'=>array('controller'=>'Controller','action'=> 'andru_tipos_porcentajes_guardar'),
    'andru_tipos_porcentajes_cambiar_estado'=>array('controller'=>'Controller','action'=> 'andru_tipos_porcentajes_cambiar_estado'),
    'andru_preguntas_porcentajes_trae'=>array('controller'=>'Controller','action'=> 'andru_preguntas_porcentajes_trae'),
    'andru_preguntas_respuestas_trae'=>array('controller'=>'Controller','action'=> 'andru_preguntas_respuestas_trae'),
    'andru_preguntas_totales'=>array('controller'=>'Controller','action'=> 'andru_preguntas_totales'),
    'andru_preguntas_totalesD'=>array('controller'=>'Controller','action'=> 'andru_preguntas_totalesD'),
	//Asignar supervisor a zonas según puntos bcr
	'supervisor_por_zona_listar'=>array('controller'=>'Controller', 'action'=>'supervisor_por_zona_listar'),
    'supervisor_por_zona_guardar'=>array('controller'=>'Controller', 'action'=>'supervisor_por_zona_guardar'),
    
    //Agregar los action al controler de la clase cls_alerta_general_detalle
    'reporte_general_detalle_listar'=>array('controller'=>'Controller','action'=> 'reporte_general_detalle_listar'),
	
    //Botones RF
    'botones_listar'=> array('controller'=>'Controller','action'=>'botones_listar'),
    'botones_selec_guardar'=> array('controller'=>'Controller','action'=>'botones_selec_guardar'),
    'botones_guardar'=> array('controller'=>'Controller','action'=>'botones_guardar'),
    'botones_selec_editar'=> array('controller'=>'Controller','action'=>'botones_selec_editar'),
    'botones_editar'=> array('controller'=>'Controller','action'=>'botones_editar'),
    
    //Controlador de Usuarios 
    'listar_usuarios'=> array('controller'=>'Controller','action'=>'listar_usuarios'),
    'gestion_usuarios' => array('controller'=> 'Controller','action'=>'gestion_usuarios'),
    'guardar_usuario' => array('controller'=> 'Controller','action'=>'guardar_usuario'),
    'cambiar_estado_usuario' => array('controller'=>'Controller','action'=>'cambiar_estado_usuario'),
    'reset_password'=>array('controller'=>'Controller', 'action'=>'reset_password'),
    'cambiar_password'=>array('controller'=>'Controller', 'action'=>'cambiar_password'),
    'recordar_password'=>array('controller'=>'Controller', 'action'=>'recordar_password'),
    'iniciar_sistema_cambiando_clave'=>array('controller'=>'Controller', 'action'=>'iniciar_sistema_cambiando_clave'),
    'cambia_clave_usuario_post'=>array('controller'=>'Controller', 'action'=>'cambia_clave_usuario_post') ,
    'forzar_puesto_de_monitoreo'=>array('controller'=>'Controller', 'action'=>'forzar_puesto_de_monitoreo') ,
    'andru_cuestionario_copiar'=>array('controller'=>'Controller', 'action'=>'andru_cuestionario_copiar'),
    //Agregar los action al controler de la clase cls_clave_tipo
    'clave_tipo_listar'=>array('controller'=>'Controller','action'=> 'clave_tipo_listar'),
    'clave_tipo_guardar'=>array('controller'=>'Controller','action'=> 'clave_tipo_guardar'),
    'clave_tipo_cambiar_estado'=>array('controller'=>'Controller','action'=> 'clave_tipo_cambiar_estado'),
    
    //Agregar los action al controler de la clase cls_clave
    'clave_listar'=>array('controller'=>'Controller','action'=> 'clave_listar'),
    'clave_guardar'=>array('controller'=>'Controller','action'=> 'clave_guardar'),
    'clave_cambiar_estado'=>array('controller'=>'Controller','action'=> 'clave_cambiar_estado'),
    
     //Agregar los action al controler de la clase cls_tipoip
    'tipoip_listar'=>array('controller'=>'Controller','action'=> 'tipoip_listar'),
    'tipoip_guardar'=>array('controller'=>'Controller','action'=> 'tipoip_guardar'),
    'tipoip_cambiar_estado'=>array('controller'=>'Controller','action'=> 'tipoip_cambiar_estado'),
    'net_test_Buscar'=>array('controller'=>'Controller','action'=> 'net_test_Buscar'),
    //Agregar los action al controler de la clase cls_net_puesto
    'net_puesto_listar'=>array('controller'=>'Controller','action'=> 'net_puesto_listar'),
    'net_puesto_guardar'=>array('controller'=>'Controller','action'=> 'net_puesto_guardar'),
    'net_puesto_cambiar_estado'=>array('controller'=>'Controller','action'=> 'net_puesto_cambiar_estado'),
    'buscar_NetTest_PuntoBCR'=>array('controller'=>'Controller','action'=> 'buscar_NetTest_PuntoBCR'),
     //Agregar los action al controler de la clase cls_recepcion_puesto
    'recepcion_puesto_listar'=>array('controller'=>'Controller','action'=> 'recepcion_puesto_listar'),
    'recepcion_puesto_guardar'=>array('controller'=>'Controller','action'=> 'recepcion_puesto_guardar'),
    'recepcion_puesto_cambiar_estado'=>array('controller'=>'Controller','action'=> 'recepcion_puesto_cambiar_estado'),
    'recepcion_puesto_tomar'=>array('controller'=>'Controller','action'=> 'recepcion_puesto_tomar'),
    'recepcion_puesto_revision'=>array('controller'=>'Controller','action'=> 'recepcion_puesto_revision'),
    'recepcion_puesto_apertura'=>array('controller'=>'Controller','action'=> 'recepcion_puesto_apertura'),
    'recepcion_apertura_guardar'=>array('controller'=>'Controller','action'=> 'recepcion_apertura_guardar'),
    'recepcion_inventario_guardar'=>array('controller'=>'Controller','action'=> 'recepcion_inventario_guardar'),
    'recepcion_inventario_borrar'=>array('controller'=>'Controller','action'=> 'recepcion_inventario_borrar'),
    'recepcion_inventario_lugares'=>array('controller'=>'Controller','action'=> 'recepcion_inventario_lugares'),
    'recepcion_lugar_numcampo'=>array('controller'=>'Controller','action'=> 'recepcion_lugar_numcampo'),
    'recepcion_lugar_reservar'=>array('controller'=>'Controller','action'=> 'recepcion_lugar_reservar'),
    'recepcion_apertura_liberar'=>array('controller'=>'Controller','action'=> 'recepcion_apertura_liberar'),
    'recepcion_parqueo_consulta'=>array('controller'=>'Controller','action'=> 'recepcion_parqueo_consulta'),
    'recepcion_visita_lugares'=>array('controller'=>'Controller','action'=> 'recepcion_visita_lugares'),
    'recepcion_visita_guardar'=>array('controller'=>'Controller','action'=> 'recepcion_visita_guardar'),
    'recepcion_visita_salir'=>array('controller'=>'Controller','action'=> 'recepcion_visita_salir'),
    'recepcion_buscar_visita'=>array('controller'=>'Controller','action'=> 'recepcion_buscar_visita')
    );
 // Parseo de la ruta
/*
 * Todo el manejo de llamada y uso de funcionalidades del sistema, se usa por medio de una variable que se utiliza dentro del 
 * método GET de cada llamada a los formularios de la capa de vista o interfaz gráfica. Esta variable lleva el nombre  de CTL
 * Esta siguiente validación comprueba si el sistema está arrancando o si ya es una llamada subsecuente a la primera (por ejemplo
 * segunda, tercera, etc). 
 * En este caso, si la variable CTL está definida, agrega a la ruta el valor que trar CTL (en este caso la funcionalida especifica
 * del sistema que se está requiriendo), siempre y cuando se encuentre en el vector de funcionalidaes definido anteriormente 
 * dentro de este archivo, de lo contrario muestra un error indicando que la ruta del controlador no existe. Si la variable CTL
 * no está definida, indica que está iniciando el sistema por lo que ruta queda asignada a inicio para mostrar la pantalla principal
 * del sistema.
 */
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

// Una vez verificado lo que se ocupa mostrar en pantalla, asigna la posición del vector correspondiente a la variable controlador
// Esto para llamar al evento respectivo.
$controlador = $map[$ruta];
// Ejecución del controlador asociado a la ruta

/*
 * Utlizando la verificacion reservada de PHP (method_exists), valida que el metodo que se ocupa llamar exista en el 
 * componente Controller.php, si es así lo ejecuta por medio de la funcionalidad reservada de PHP llamada call_user_func
 * de lo contrario mostrará un mensaje de error en pantalla.
 */

if (method_exists($controlador['controller'],$controlador['action'])) {
    call_user_func(array(new $controlador['controller'], $controlador['action']));
} else {
    //Muestra error en pantalla para indicar que no encontró el elemento
    header('Status: 404 Not Found');
    //Arma el mensaje de error, mostrando posteriormente en pantalla.
    echo '<html><body><h1>Error 404: El controlador <i>' .
            $controlador['controller'] .
            '->' .
            $controlador['action'] .
            '</i> no existe</h1></body></html>';
}