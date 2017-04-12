  <?php
class cls_puestos_de_monitoreo{
    
    public $obj_data_provider;
    public $id_puesto_monitoreo;
    public $id_puesto_monitoreo_unidad_video;
    public $id_bitacora_control_puesto_monitoreo;
    public $id_bitacora_revision_video;
    public $fecha_toma_control;
    public $hora_toma_control;
    public $fecha_libera_control;
    public $hora_libera_control;
    public $fecha_inicia_revision;
    public $hora_inicia_revision;
    public $id_ultimo_toma_puesto_ingresada;
    public $fecha_termina_revision;
    public $hora_termina_revision;
    public $id_unidad_video;
    public $id_usuario;
    public $retraso_segundos;
    public $justificacion_retraso;
    public $resultado_conexion;
    public $duracion_revision;
    public $posicion;
    public $ultima_posicion_concluida;
    public $requirio_mantenimiento;
    public $reporta_situacion;
    public $descripcion;
    public $arreglo;
    private $condicion;
    public $nombre;
    public $estado;
    public $campos_valores;
    public $observaciones;
    public $tiempo_estandar_revision;
    public $tiempo_personalizado_revision;
    
    public $id_inconsistencia_video;
    public $estado_inconsistencia;
    public $tipo_inconsistencia;
    public $fecha_validacion;
    public $hora_validacion;
    public $fecha_reporta;
    public $hora_reporta;
    public $fecha_solucion;
    public $hora_solucion;
    public $id_averia;
    
    function getFecha_solucion() {
        return $this->fecha_solucion;
    }

    function getHora_solucion() {
        return $this->hora_solucion;
    }

    function setFecha_solucion($fecha_solucion) {
        $this->fecha_solucion = $fecha_solucion;
    }

    function setHora_solucion($hora_solucion) {
        $this->hora_solucion = $hora_solucion;
    }
   
    function getFecha_reporta() {
        return $this->fecha_reporta;
    }

    function getHora_reporta() {
        return $this->hora_reporta;
    }

    function getId_averia() {
        return $this->id_averia;
    }

    function setFecha_reporta($fecha_reporta) {
        $this->fecha_reporta = $fecha_reporta;
    }

    function setHora_reporta($hora_reporta) {
        $this->hora_reporta = $hora_reporta;
    }

    function setId_averia($id_averia) {
        $this->id_averia = $id_averia;
    }

        function getFecha_validacion() {
        return $this->fecha_validacion;
    }

    function getHora_validacion() {
        return $this->hora_validacion;
    }

    function setFecha_validacion($fecha_validacion) {
        $this->fecha_validacion = $fecha_validacion;
    }

    function setHora_validacion($hora_validacion) {
        $this->hora_validacion = $hora_validacion;
    }

        
    function getTipo_inconsistencia() {
        return $this->tipo_inconsistencia;
    }

    function setTipo_inconsistencia($tipo_inconsistencia) {
        $this->tipo_inconsistencia = $tipo_inconsistencia;
    }

        
    function getEstado_inconsistencia() {
        return $this->estado_inconsistencia;
    }

    function setEstado_inconsistencia($estado_inconsistencia) {
        $this->estado_inconsistencia = $estado_inconsistencia;
    }
   
    function getId_inconsistencia_video() {
        return $this->id_inconsistencia_video;
    }

    function setId_inconsistencia_video($id_inconsistencia_video) {
        $this->id_inconsistencia_video = $id_inconsistencia_video;
    }

        
    function getUltima_posicion_concluida() {
        return $this->ultima_posicion_concluida;
    }

    function setUltima_posicion_concluida($ultima_posicion_concluida) {
        $this->ultima_posicion_concluida = $ultima_posicion_concluida;
    }
    
    function getId_ultimo_toma_puesto_ingresada() {
        return $this->id_ultimo_toma_puesto_ingresada;
    }

    function setId_ultimo_toma_puesto_ingresada($id_ultimo_toma_puesto_ingresada) {
        $this->id_ultimo_toma_puesto_ingresada = $id_ultimo_toma_puesto_ingresada;
    }

        
    function getId_bitacora_revision_video() {
        return $this->id_bitacora_revision_video;
    }

    function getFecha_inicia_revision() {
        return $this->fecha_inicia_revision;
    }

    function getHora_inicia_revision() {
        return $this->hora_inicia_revision;
    }

    function getFecha_termina_revision() {
        return $this->fecha_termina_revision;
    }

    function getHora_termina_revision() {
        return $this->hora_termina_revision;
    }

    function getRetraso_segundos() {
        return $this->retraso_segundos;
    }

    function getJustificacion_retraso() {
        return $this->justificacion_retraso;
    }

    function getResultado_conexion() {
        return $this->resultado_conexion;
    }

    function getDuracion_revision() {
        return $this->duracion_revision;
    }

    function getRequirio_mantenimiento() {
        return $this->requirio_mantenimiento;
    }

    function getReporta_situacion() {
        return $this->reporta_situacion;
    }

    function setId_bitacora_revision_video($id_bitacora_revision_video) {
        $this->id_bitacora_revision_video = $id_bitacora_revision_video;
    }

    function setFecha_inicia_revision($fecha_inicia_revision) {
        $this->fecha_inicia_revision = $fecha_inicia_revision;
    }

    function setHora_inicia_revision($hora_inicia_revision) {
        $this->hora_inicia_revision = $hora_inicia_revision;
    }

    function setFecha_termina_revision($fecha_termina_revision) {
        $this->fecha_termina_revision = $fecha_termina_revision;
    }

    function setHora_termina_revision($hora_termina_revision) {
        $this->hora_termina_revision = $hora_termina_revision;
    }

    function setRetraso_segundos($retraso_segundos) {
        $this->retraso_segundos = $retraso_segundos;
    }

    function setJustificacion_retraso($justificacion_retraso) {
        $this->justificacion_retraso = $justificacion_retraso;
    }

    function setResultado_conexion($resultado_conexion) {
        $this->resultado_conexion = $resultado_conexion;
    }

    function setDuracion_revision($duracion_revision) {
        $this->duracion_revision = $duracion_revision;
    }

    function setRequirio_mantenimiento($requirio_mantenimiento) {
        $this->requirio_mantenimiento = $requirio_mantenimiento;
    }

    function setReporta_situacion($reporta_situacion) {
        $this->reporta_situacion = $reporta_situacion;
    }
    
    function getId_bitacora_control_puesto_monitoreo() {
        return $this->id_bitacora_control_puesto_monitoreo;
    }

    function getFecha_toma_control() {
        return $this->fecha_toma_control;
    }

    function getHora_toma_control() {
        return $this->hora_toma_control;
    }

    function getFecha_libera_control() {
        return $this->fecha_libera_control;
    }

    function getHora_libera_control() {
        return $this->hora_libera_control;
    }

    function setId_bitacora_control_puesto_monitoreo($id_bitacora_control_puesto_monitoreo) {
        $this->id_bitacora_control_puesto_monitoreo = $id_bitacora_control_puesto_monitoreo;
    }

    function setFecha_toma_control($fecha_toma_control) {
        $this->fecha_toma_control = $fecha_toma_control;
    }

    function setHora_toma_control($hora_toma_control) {
        $this->hora_toma_control = $hora_toma_control;
    }

    function setFecha_libera_control($fecha_libera_control) {
        $this->fecha_libera_control = $fecha_libera_control;
    }

    function setHora_libera_control($hora_libera_control) {
        $this->hora_libera_control = $hora_libera_control;
    }

    function getPosicion() {
        return $this->posicion;
    }

    function setPosicion($posicion) {
        $this->posicion = $posicion;
    }
    
    function getId_puesto_monitoreo_unidad_video() {
        return $this->id_puesto_monitoreo_unidad_video;
    }

    function getId_unidad_video() {
        return $this->id_unidad_video;
    }

    function getTiempo_personalizado_revision() {
        return $this->tiempo_personalizado_revision;
    }

    function setId_puesto_monitoreo_unidad_video($id_puesto_monitoreo_unidad_video) {
        $this->id_puesto_monitoreo_unidad_video = $id_puesto_monitoreo_unidad_video;
    }

    function setId_unidad_video($id_unidad_video) {
        $this->id_unidad_video = $id_unidad_video;
    }

    function setTiempo_personalizado_revision($tiempo_personalizado_revision) {
        $this->tiempo_personalizado_revision = $tiempo_personalizado_revision;
    }

        function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function getId_puesto_monitoreo() {
        return $this->id_puesto_monitoreo;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getArreglo() {
        return $this->arreglo;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCampos_valores() {
        return $this->campos_valores;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getTiempo_estandar_revision() {
        return $this->tiempo_estandar_revision;
    }

    function setObj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    function setId_puesto_monitoreo($id_puesto_monitoreo) {
        $this->id_puesto_monitoreo = $id_puesto_monitoreo;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCampos_valores($campos_valores) {
        $this->campos_valores = $campos_valores;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setTiempo_estandar_revision($tiempo_estandar_revision) {
        $this->tiempo_estandar_revision = $tiempo_estandar_revision;
    }

        public function __construct() {
        $this->id_puesto_monitoreo="";
        $this->id_bitacora_control_puesto_monitoreo="";
        $this->fecha_toma_control="";
        $this->fecha_libera_control="";
        $this->hora_libera_control="";
        $this->hora_toma_control="";
        $this->id_usuario="";
        $this->obj_data_provider=new Data_Provider();
        $this->id_bitacora_revision_video="";
        $this->fecha_inicia_revision="";
        $this->fecha_termina_revision="";
        $this->hora_inicia_revision="";
        $this->hora_termina_revision="";
        $this->retraso_segundos="";
        $this->justificacion_retraso="";
        $this->resultado_conexion="";
        $this->duracion_revision="";
        $this->requirio_mantenimiento="";
        $this->id_ultimo_toma_puesto_ingresada="";
        $this->ultima_posicion_concluida="";
        $this->reporta_situacion="";
        $this->condicion="";
        $this->arreglo;
        $this->descripcion="";
        $this->nombre="";
        $this->observaciones="";
        $this->estado="";
        $this->estado_inconsistencia="";
        $this->id_puesto_monitoreo_unidad_video="";
        $this->id_unidad_video="";
        $this->posicion="";
        $this->tiempo_personalizado_revision="";
        $this->id_inconsistencia_video="";
        $this->tipo_inconsistencia="";
    
   }
   
   //Valida que no se ingrese el mismo tipo de evento en un sitio, si ya hay uno pendiente
    
    function existe_este_dato_en_la_tabla_unidades_video(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("T_UnidadVideo","*",$this->condicion);
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=true;
      
      if (count($this->arreglo)>0){
        return true;
      }else
      {
        return false;
      }    
  }
    
  public function obtiene_todos_puestos_de_monitoreo(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_puestomonitoreo left outer join t_usuario on t_puestomonitoreo.ID_Usuario=t_usuario.ID_Usuario", 
                    "t_puestomonitoreo.*,IFNULL(concat(concat(t_usuario.Nombre,' '),t_usuario.Apellido),'Libre') Nombre_Completo",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_puestomonitoreo left outer join t_usuario on t_puestomonitoreo.ID_Usuario=t_usuario.ID_Usuario", 
                    "t_puestomonitoreo.*,IFNULL(concat(concat(t_usuario.Nombre,' '),t_usuario.Apellido),'Libre') Nombre_Completo",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        } 
    }
     
    public function obtiene_bitacora_puestos_de_monitoreo(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_bitacoracontrolpuestomonitoreo", 
                    "*",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_bitacoracontrolpuestomonitoreo", 
                    "*",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        } 
    }
    
    public function obtiene_estadistica_general_puestos_de_monitoreo(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_PuestoMonitoreoUnidadVideo
                        inner join T_UnidadVideo on T_UnidadVideo.ID_Unidad_Video=T_PuestoMonitoreoUnidadVideo.ID_Unidad_Video group by T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo", 
                    "round(sum(Tiempo_Personalizado_Revision)/60) Total_Minutos,count(Tiempo_Personalizado_Revision) Total_Unidades, sum(Camaras_Habilitadas) Total_Camaras",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_PuestoMonitoreoUnidadVideo
                        inner join T_UnidadVideo on T_UnidadVideo.ID_Unidad_Video=T_PuestoMonitoreoUnidadVideo.ID_Unidad_Video", 
                    "round(sum(Tiempo_Personalizado_Revision)/60) Total_Minutos,count(Tiempo_Personalizado_Revision) Total_Unidades, sum(Camaras_Habilitadas) Total_Camaras",
                    $this->condicion." group by T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        } 
    }
    
    public function obtiene_todas_las_unidades_asociadas_a_un_puesto_de_monitoreo(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_PuestoMonitoreoUnidadVideo
                        inner join T_PuestoMonitoreo on T_PuestoMonitoreo.ID_Puesto_Monitoreo=T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo
                        inner join T_UnidadVideo on T_UnidadVideo.ID_Unidad_Video=T_PuestoMonitoreoUnidadVideo.ID_Unidad_Video
                        inner join t_puntoBCR on t_unidadvideo.ID_PuntoBCR=t_puntoBCR.ID_PuntoBCR 
                        inner join T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto order by T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo_Unidad_Video ", 
                    "T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo_Unidad_Video,T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo,
                        T_UnidadVideo.ID_Unidad_Video,t_puntoBCR.Nombre,T_UnidadVideo.Descripcion,T_TipoPuntoBCR.Tipo_Punto,
                        T_UnidadVideo.Camaras_Habilitadas,Tiempo_Personalizado_Revision,T_PuestoMonitoreo.Tiempo_Estandar_Revision",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                                   "T_PuestoMonitoreoUnidadVideo
                                        inner join T_PuestoMonitoreo on T_PuestoMonitoreo.ID_Puesto_Monitoreo=T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo
                                        inner join T_UnidadVideo on T_UnidadVideo.ID_Unidad_Video=T_PuestoMonitoreoUnidadVideo.ID_Unidad_Video
                                        inner join t_puntoBCR on t_unidadvideo.ID_PuntoBCR=t_puntoBCR.ID_PuntoBCR 
                                        inner join T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto", 
                    "T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo_Unidad_Video,T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo,
                        T_UnidadVideo.ID_Unidad_Video,t_puntoBCR.Nombre,T_UnidadVideo.Descripcion,T_TipoPuntoBCR.Tipo_Punto,
                        T_UnidadVideo.Camaras_Habilitadas,Tiempo_Personalizado_Revision,T_PuestoMonitoreo.Tiempo_Estandar_Revision",
                    $this->condicion. " order by T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo_Unidad_Video ");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        } 
    }
    
    public function obtiene_las_unidades_siguientes_para_revision(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_PuestoMonitoreoUnidadVideo
                        inner join T_PuestoMonitoreo on T_PuestoMonitoreo.ID_Puesto_Monitoreo=T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo
                        inner join T_UnidadVideo on T_UnidadVideo.ID_Unidad_Video=T_PuestoMonitoreoUnidadVideo.ID_Unidad_Video
                        inner join t_puntoBCR on t_unidadvideo.ID_PuntoBCR=t_puntoBCR.ID_PuntoBCR 
                        inner join T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto order by T_PuestoMonitoreoUnidadVideo.Posicion ", 
                    "T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo_Unidad_Video,T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo,
                        T_UnidadVideo.ID_Unidad_Video,t_puntoBCR.Nombre,T_UnidadVideo.Descripcion,T_TipoPuntoBCR.Tipo_Punto,
                        T_UnidadVideo.Camaras_Habilitadas,Tiempo_Personalizado_Revision,T_PuestoMonitoreo.Tiempo_Estandar_Revision",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                                   "T_PuestoMonitoreoUnidadVideo
                                        inner join T_PuestoMonitoreo on T_PuestoMonitoreo.ID_Puesto_Monitoreo=T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo
                                        inner join T_UnidadVideo on T_UnidadVideo.ID_Unidad_Video=T_PuestoMonitoreoUnidadVideo.ID_Unidad_Video
                                        inner join t_puntoBCR on t_unidadvideo.ID_PuntoBCR=t_puntoBCR.ID_PuntoBCR 
                                        inner join T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto", 
                    "T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo_Unidad_Video,T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo,
                        T_UnidadVideo.ID_Unidad_Video,t_puntoBCR.Nombre,T_UnidadVideo.Descripcion,T_TipoPuntoBCR.Tipo_Punto,
                        T_UnidadVideo.Camaras_Habilitadas,Tiempo_Personalizado_Revision,T_PuestoMonitoreo.Tiempo_Estandar_Revision",
                    $this->condicion. " order by T_PuestoMonitoreoUnidadVideo.Posicion ");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            
        } 
    }
    
    function liberar_puesto_monitoreo(){
        
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_PuestoMonitoreo","ID_Usuario=0",$this->condicion);
        $this->obj_data_provider->edita_datos("t_bitacoracontrolpuestomonitoreo","Estado=".$this->estado.",Fecha_Libera_Control='".$this->fecha_libera_control."',Hora_Libera_Control='".$this->hora_libera_control."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    function cambiar_estado_puesto_monitoreo(){
        
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_PuestoMonitoreo","Estado='".$this->estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    public function agregar_nuevo_puesto_monitoreo(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("t_PuestoMonitoreo", "ID_Puesto_Monitoreo, Nombre,Descripcion, Observaciones,Tiempo_Estandar_Revision,Estado,ID_Usuario", "null,'".$this->nombre."','".$this->descripcion."','".$this->observaciones."',".$this->tiempo_estandar_revision.",".$this->estado.",0");
        $this->obj_data_provider->desconectar();
    }
    
     public function insertar_toma_de_puesto_de_monitoreo(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("t_bitacoracontrolpuestomonitoreo", "ID_Bitacora_Control_Puesto_Monitoreo, Fecha_Toma_Control,Hora_Toma_Control,ID_Usuario,ID_Puesto_Monitoreo,Estado", "null,'".$this->fecha_toma_control."','".$this->hora_toma_control."',".$this->id_usuario.",".$this->id_puesto_monitoreo.",".$this->estado);
        $this->obj_data_provider->edita_datos("t_PuestoMonitoreo","ID_Usuario=".$this->id_usuario,$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    
    public function obtiene_unidades_de_video_que_tienen_punto_bcr(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_unidadvideo 
                        inner join t_puntoBCR on t_unidadvideo.ID_PuntoBCR=t_puntoBCR.ID_PuntoBCR 
                        inner join t_distrito on t_puntoBCR.ID_distrito=t_distrito.ID_distrito
                        inner join t_canton on t_distrito.ID_canton=t_canton.ID_canton
                        inner join t_provincia on t_canton.ID_provincia=t_provincia.ID_provincia
                        inner join T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto", 
                    "*,t_Provincia.Nombre_Provincia,t_unidadvideo.Estado as Estad,t_unidadvideo.Observaciones as Obser,t_puntoBCR.Nombre,T_TipoPuntoBCR.Tipo_Punto",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                                   "t_unidadvideo 
                        inner join t_puntoBCR on t_unidadvideo.ID_PuntoBCR=t_puntoBCR.ID_PuntoBCR 
                        inner join t_distrito on t_puntoBCR.ID_distrito=t_distrito.ID_distrito
                        inner join t_canton on t_distrito.ID_canton=t_canton.ID_canton
                        inner join t_provincia on t_canton.ID_provincia=t_provincia.ID_provincia
                        inner join T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto", 
                    "*,t_Provincia.Nombre_Provincia,t_unidadvideo.Estado as Estad,t_unidadvideo.Observaciones as Obser,t_puntoBCR.Nombre,T_TipoPuntoBCR.Tipo_Punto",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        } 
    }
   
    public function obtiene_inconsistencias_de_video(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(" t_inconsistenciavideo INNER JOIN t_bitacorarevisionesvideo ON t_bitacorarevisionesvideo.ID_Bitacora_Revision_Video = t_inconsistenciavideo.ID_Bitacora_Revision_Video
                    INNER JOIN t_usuario ON t_usuario.ID_Usuario = T_BitacoraRevisionesVideo.ID_Usuario
                    Inner join t_unidadvideo on t_unidadvideo.ID_Unidad_Video=t_bitacorarevisionesvideo.ID_Unidad_Video
                    inner join T_PuestoMonitoreo on T_PuestoMonitoreo.ID_Puesto_Monitoreo=t_bitacorarevisionesvideo.ID_Puesto_Monitoreo
                    left join t_usuario tuv on t_inconsistenciavideo.ID_Usuario_Valida=tuv.ID_Usuario
                    left join t_usuario tur on t_inconsistenciavideo.ID_Usuario_Reporta_SE=tur.ID_Usuario
                    left join t_usuario tus on t_inconsistenciavideo.ID_Usuario_Reporta_Solucionada=tus.ID_Usuario
                    order by ID_Inconsistencia_Video",
                    "t_inconsistenciavideo . * ,T_BitacoraRevisionesVideo.ID_Unidad_Video ,T_BitacoraRevisionesVideo.Reporta_Situacion, CONCAT( CONCAT( t_usuario.Nombre,  ' ' ) , t_usuario.Apellido ) AS Detectado_Por,CONCAT( CONCAT( tuv.Nombre,  ' ' ) , tuv.Apellido ) AS Validado_Por,CONCAT( CONCAT( tur.Nombre,  ' ' ) , tur.Apellido ) AS Reportado_Por,CONCAT( CONCAT( tus.Nombre,  ' ' ) , tus.Apellido ) AS Solucionado_Por,case t_inconsistenciavideo.Estado  when 0 then 'Pendiente'  when 1 then 'Atendida'  when 2 then 'Validada SE' when 3 then 'Validada ATMs' when 4 then 'Validada Mant.' when 5 then 'Reportada SE' when 6 then 'Reportada ATMs' when 7 then 'Reportada Mant.' when 8 then 'Reparada SE' when 9 then 'Reparada ATMs' when 10 then 'Reparada Mant.' end as Estado_Traducido,t_unidadvideo.Descripcion,T_PuestoMonitoreo.Nombre as Nombre_Puesto","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
        $this->arreglo=$this->obj_data_provider->trae_datos(" t_inconsistenciavideo INNER JOIN t_bitacorarevisionesvideo ON t_bitacorarevisionesvideo.ID_Bitacora_Revision_Video = t_inconsistenciavideo.ID_Bitacora_Revision_Video
                    INNER JOIN t_usuario ON t_usuario.ID_Usuario = T_BitacoraRevisionesVideo.ID_Usuario
                    Inner join t_unidadvideo on t_unidadvideo.ID_Unidad_Video=t_bitacorarevisionesvideo.ID_Unidad_Video
                    inner join T_PuestoMonitoreo on T_PuestoMonitoreo.ID_Puesto_Monitoreo=t_bitacorarevisionesvideo.ID_Puesto_Monitoreo
                    left join t_usuario tuv on t_inconsistenciavideo.ID_Usuario_Valida=tuv.ID_Usuario
                    left join t_usuario tur on t_inconsistenciavideo.ID_Usuario_Reporta_SE=tur.ID_Usuario
                    left join t_usuario tus on t_inconsistenciavideo.ID_Usuario_Reporta_Solucionada=tus.ID_Usuario",
                    "t_inconsistenciavideo . * ,T_BitacoraRevisionesVideo.ID_Unidad_Video ,T_BitacoraRevisionesVideo.Reporta_Situacion, CONCAT( CONCAT( t_usuario.Nombre,  ' ' ) , t_usuario.Apellido ) AS Detectado_Por,CONCAT( CONCAT( tuv.Nombre,  ' ' ) , tuv.Apellido ) AS Validado_Por,CONCAT( CONCAT( tur.Nombre,  ' ' ) , tur.Apellido ) AS Reportado_Por,CONCAT( CONCAT( tus.Nombre,  ' ' ) , tus.Apellido ) AS Solucionado_Por,case t_inconsistenciavideo.Estado  when 0 then 'Pendiente'  when 1 then 'Atendida'  when 2 then 'Validada' when 3 then 'Reportada' when 4 then 'Reparada' end as Estado_Traducido,t_unidadvideo.Descripcion,T_PuestoMonitoreo.Nombre as Nombre_Puesto",
                    $this->condicion." order by ID_Inconsistencia_Video");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        } 
    }
   
    public function obtiene_distribucion_unidades_de_video_en_puestos_de_monitoreo(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("t_unidadvideo
                left OUTER join t_puestomonitoreounidadvideo on t_puestomonitoreounidadvideo.ID_Unidad_Video = t_unidadvideo.ID_Unidad_Video
                 LEFT OUTER JOIN t_puestomonitoreo ON t_puestomonitoreo.ID_Puesto_Monitoreo = t_puestomonitoreounidadvideo.ID_Puesto_Monitoreo GROUP BY t_unidadvideo.ID_Unidad_Video",
                    "t_unidadvideo.Descripcion descrip, COUNT(t_puestomonitoreo.ID_Puesto_Monitoreo) Cantidad_Puestos, GROUP_CONCAT(t_puestomonitoreo.Nombre, ' ') Lista_Puestos,t_unidadvideo.Camaras_Habilitadas","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
        $this->arreglo=$this->obj_data_provider->trae_datos("t_unidadvideo
	left OUTER join t_puestomonitoreounidadvideo on t_puestomonitoreounidadvideo.ID_Unidad_Video = t_unidadvideo.ID_Unidad_Video
    LEFT OUTER JOIN t_puestomonitoreo ON t_puestomonitoreo.ID_Puesto_Monitoreo = t_puestomonitoreounidadvideo.ID_Puesto_Monitoreo",
                    "t_unidadvideo.Descripcion descrip, COUNT(t_puestomonitoreo.ID_Puesto_Monitoreo) Cantidad_Puestos, GROUP_CONCAT(t_puestomonitoreo.Nombre, ' ') Lista_Puestos,t_unidadvideo.Camaras_Habilitadas",
                    $this->condicion." GROUP BY t_unidadvideo.ID_Unidad_Video");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        } 
    }
    
    public function actualizar_campo_unidades_de_video(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->edita_datos("t_unidadvideo", $this->campos_valores ,$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
 
    }
    public function agregar_nueva_unidad_de_video(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_UnidadVideo", "`ID_Unidad_Video`, `Descripcion`, `Promedio_Dias`, `Capacidad_Disco_Duro`, `Version_Software`, `Mac_Address`, `Serie`, `Regulacion`, `Cantidad_Entradas_Video`, `Camaras_Habilitadas`, `Cuadros_Por_Segundo`, `Resolucion`, `Calidad`, `ID_PuntoBCR`, `Observaciones`, `Arranque_Automatico`, `Fecha_Actualizacion`, `Estado`", "null,'',0,0,0,'00000000000000000','0000000',0,0,0,0,'0X0',0,0,'',1,'0000-00-00',1");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_puesto_monitoreo(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_PuestoMonitoreo","Nombre='".$this->nombre."',Descripcion='".$this->descripcion."',Observaciones='".$this->observaciones."',Tiempo_Estandar_Revision=".$this->tiempo_estandar_revision,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_tiempo_en_unidades_de_video_ligadas_al_puesto(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_PuestoMonitoreounidadvideo","Tiempo_Personalizado_Revision=".$this->tiempo_estandar_revision,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    function eliminar_registros_puesto_de_monitoreo(){
          
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos_para_prontuario("t_puestomonitoreounidadvideo", $this->condicion);
        $this->obj_data_provider->desconectar();
  
    }
    
     public function agregar_nueva_unidad_de_video_a_puesto_de_monitoreo(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_PuestoMonitoreoUnidadVideo", "`ID_Puesto_Monitoreo_Unidad_Video`,`ID_Puesto_Monitoreo`,`ID_Unidad_Video`,`Tiempo_Personalizado_Revision`,`Posicion`", "null,".$this->id_puesto_monitoreo.",".$this->id_unidad_video.",".$this->tiempo_personalizado_revision.",".$this->posicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
    }
    
     //Valida que no se ingrese el mismo tipo de evento en un sitio, si ya hay uno pendiente
    function existe_revision_de_video_pendiente_en_bitacora(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("T_BitacoraRevisionesVideo","*",$this->condicion);
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=true;
      
      if (count($this->arreglo)>0){
        return true;
      }else
      {
        return false;
      }    
    }
    
      //Valida que no se ingrese el mismo tipo de evento en un sitio, si ya hay uno pendiente
    function obtiene_ultima_posicion_de_un_puesto_de_monitoreo(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("t_puestomonitoreounidadvideo","*",$this->condicion." order by Posicion desc");
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=true;
      
      if (count($this->arreglo)>0){
        return intval($this->arreglo[0]['Posicion']);
      }else
      {
        return 0;
      }    
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_usuario_y_tiempo_de_inicio_en_revision_de_video(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("T_BitacoraRevisionesVideo","Fecha_Inicia_Revision='".$this->fecha_inicia_revision."',Hora_Inicia_Revision='".$this->hora_inicia_revision."',ID_Usuario=".$this->id_usuario.",ID_Bitacora_Control_Puesto_Monitoreo=".$this->id_ultimo_toma_puesto_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_tiempo_de_inicio_en_revision_de_video(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("T_BitacoraRevisionesVideo","Fecha_Inicia_Revision='".$this->fecha_inicia_revision."',Hora_inicia_Revision=".$this->hora_inicia_revision."",$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function guarda_y_concluye_una_revision_de_video(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("T_BitacoraRevisionesVideo","Fecha_Termina_Revision='".$this->fecha_termina_revision."',Hora_Termina_Revision='".$this->hora_termina_revision."',Estado=".$this->estado.",Requirio_Mantenimiento=".$this->requirio_mantenimiento.",Duracion_Revision=".$this->duracion_revision.",Retraso_Segundos=".$this->retraso_segundos.",Resultado_Conexion=".$this->resultado_conexion.",Reporta_Situacion='".$this->reporta_situacion."',Justificacion_Retraso='".$this->justificacion_retraso."'",$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function agrega_justificacion_en_retraso_de_una_revision_de_video(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("T_BitacoraRevisionesVideo","Justificacion_Retraso='".$this->justificacion_retraso."'",$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_toma_de_puesto_en_revision_de_video_pendiente(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("T_BitacoraRevisionesVideo","ID_Bitacora_Control_Puesto_Monitoreo=".$this->id_ultimo_toma_puesto_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    //Obtener el último id de evento para saber que se debe ingresar
    function obtiene_id_ultimo_toma_puesto_ingresada(){
        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();

        $this->obj_data_provider->trae_datos("t_bitacoracontrolpuestomonitoreo","max(ID_Bitacora_Control_Puesto_Monitoreo) ID_Bitacora_Control_Puesto_Monitoreo",$this->condicion);

        $this->arreglo=$this->obj_data_provider->getArreglo();

        $this->obj_data_provider->desconectar();

        if (count($this->arreglo)>0){
            $this->setId_ultimo_toma_puesto_ingresada($this->arreglo[0]['ID_Bitacora_Control_Puesto_Monitoreo']);

        }else
        {
            $this->setId_ultimo_toma_puesto_ingresada(0);
      }   
    }
    
    
     //Obtener el último id de evento para saber que se debe ingresar
    function obtiene_ultima_posicion_concluida_en_puesto_de_monitoreo(){
        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();

        //$this->obj_data_provider->trae_datos("t_bitacorarevisionesvideo","max(ID_Bitacora_Revision_Video) ID_Bitacora_Revision_Video,Posicion",$this->condicion);
        $this->obj_data_provider->trae_datos("t_bitacorarevisionesvideo","ID_Bitacora_Revision_Video,Posicion",$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();

        $this->obj_data_provider->desconectar();

        if (count($this->arreglo)>0){
            $this->setUltima_posicion_concluida($this->arreglo[0]['Posicion']);

        }else
        {
            $this->setUltima_posicion_concluida(0);
        }   
           
    }
    
     //Valida que no se ingrese el mismo tipo de evento en un sitio, si ya hay uno pendiente
    function existe_esta_posicion_en_este_puesto_de_monitoreo(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("t_puestomonitoreounidadvideo","*",$this->condicion);
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=true;
      
      if (count($this->arreglo)>0){
        $this->setId_unidad_video($this->arreglo[0]['ID_Unidad_Video']);
        return true;
      }else
      {
        return false;
      }    
    }
    
    public function agregar_nuevo_registro_bitacora_revisiones_de_video(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("t_bitacorarevisionesvideo", "ID_Bitacora_Revision_Video,Fecha_Inicia_Revision,Hora_Inicia_Revision,ID_Bitacora_Control_Puesto_Monitoreo,ID_Usuario,ID_Unidad_Video,ID_Puesto_Monitoreo,Posicion,Observaciones,Estado", "null,'".$this->fecha_inicia_revision."','".$this->hora_inicia_revision."',".$this->id_ultimo_toma_puesto_ingresada.",".$this->id_usuario.",".$this->id_unidad_video.",".$this->id_puesto_monitoreo.",".$this->posicion.",'".$this->observaciones."',".$this->estado);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_validacion_inconsistencia_de_video(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("T_InconsistenciaVideo","ID_Usuario_Valida=".$this->id_usuario.",Fecha_Validacion='".$this->fecha_validacion."',Hora_Validacion='".$this->hora_validacion."',Estado=".$this->estado.",Tipo_Inconsistencia=".$this->tipo_inconsistencia.",Observaciones_Validacion='".$this->observaciones."'",$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_reporte_inconsistencia_de_video(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("T_InconsistenciaVideo","ID_Usuario_Reporta_SE=".$this->id_usuario.",Fecha_Reporta='".$this->fecha_reporta."',Hora_Reporta='".$this->hora_reporta."',Estado=".$this->estado.",ID_Averia='".$this->id_averia."',Observaciones_Reporte='".$this->observaciones."'",$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_solucion_inconsistencia_de_video(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("T_InconsistenciaVideo","ID_Usuario_Reporta_Solucionada=".$this->id_usuario.",Fecha_Solucionada='".$this->fecha_solucion."',Hora_Solucionada='".$this->hora_solucion."',Estado=".$this->estado.",Observaciones_Solucionada='".$this->observaciones."'",$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
     public function agregar_nuevo_registro_inconsistencias_de_video(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_InconsistenciaVideo", "ID_Inconsistencia_Video,ID_Bitacora_Revision_Video,Estado,Tipo_Inconsistencia", "null,".$this->id_bitacora_revision_video.",".$this->estado_inconsistencia.",".$this->tipo_inconsistencia);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
    }
 
    public function obtiene_revisiones_de_video(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_bitacorarevisionesvideo", 
                    "*",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_bitacorarevisionesvideo", 
                    "*",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        } 
    }
    
}?>