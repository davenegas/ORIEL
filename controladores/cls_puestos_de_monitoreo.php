<?php
class cls_puestos_de_monitoreo{
    
    public $obj_data_provider;
    public $id_puesto_monitoreo;
    public $id_puesto_monitoreo_unidad_video;
    public $id_unidad_video;
    public $id_usuario;
    public $descripcion;
    public $arreglo;
    private $condicion;
    public $nombre;
    public $estado;
    public $campos_valores;
    public $observaciones;
    public $tiempo_estandar_revision;
    public $tiempo_personalizado_revision;
    
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
        $this->id_usuario="";
        $this->obj_data_provider=new Data_Provider();
        $this->condicion="";
        $this->arreglo;
        $this->descripcion="";
        $this->nombre="";
        $this->observaciones="";
        $this->estado="";
        $this->id_puesto_monitoreo_unidad_video="";
        $this->id_unidad_video="";
        $this->tiempo_personalizado_revision="";
    
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
                    "T_PuestoMonitoreo", 
                    "*",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_PuestoMonitoreo", 
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
    
    
    function cambiar_estado_puesto_monitoreo(){
        
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_PuestoMonitoreo","Estado='".$this->estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    public function agregar_nuevo_puesto_monitoreo(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("t_PuestoMonitoreo", "ID_Puesto_Monitoreo, Nombre,Descripcion, Observaciones,Tiempo_Estandar_Revision,Estado", "null,'".$this->nombre."','".$this->descripcion."','".$this->observaciones."',".$this->tiempo_estandar_revision.",".$this->estado);
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
    
    function eliminar_registros_puesto_de_monitoreo(){
          
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos_para_prontuario("t_puestomonitoreounidadvideo", $this->condicion);
        $this->obj_data_provider->desconectar();
  
    }
    
     public function agregar_nueva_unidad_de_video_a_puesto_de_monitoreo(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_PuestoMonitoreoUnidadVideo", "`ID_Puesto_Monitoreo_Unidad_Video`,`ID_Puesto_Monitoreo`,`ID_Unidad_Video`,`Tiempo_Personalizado_Revision`", "null,".$this->id_puesto_monitoreo.",".$this->id_unidad_video.",".$this->tiempo_personalizado_revision);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
      
    }
   
}?>