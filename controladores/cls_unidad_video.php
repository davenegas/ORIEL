<?php
class cls_unidad_video{
    public $obj_data_provider;
    public $id_unidad_video;
    public $id_punto_bcr;
    public $arreglo;
    private $condicion;
    public $descripcion;
    public $promedio_dias;
    public $capacidad_disco_duro;
    public $version_software;
    public $mac_address;
    public $serie;
    public $regulacion;
    public $estado;
    public $campos_valores;
    public $cantidad_entradas_video;
    public $camaras_habilitadas;
    public $cuadros_por_segundo;
    public $resolucion;
    public $calidad;
    public $nombre_punto_bcr;
    public $observaciones;
    public $arranque_automatico;
        
    function getCampos_valores() {
        return $this->campos_valores;
    }

    function setCampos_valores($campos_valores) {
        $this->campos_valores = $campos_valores;
    }

    
    function getId_unidad_video() {
        return $this->id_unidad_video;
    }

    function getId_punto_bcr() {
        return $this->id_punto_bcr;
    }

    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function getArreglo() {
        return $this->arreglo;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPromedio_dias() {
        return $this->promedio_dias;
    }

    function getCapacidad_disco_duro() {
        return $this->capacidad_disco_duro;
    }

    function getVersion_software() {
        return $this->version_software;
    }

    function getMac_address() {
        return $this->mac_address;
    }

    function getSerie() {
        return $this->serie;
    }

    function getRegulacion() {
        return $this->regulacion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCantidad_entradas_video() {
        return $this->cantidad_entradas_video;
    }

    function getCamaras_habilitadas() {
        return $this->camaras_habilitadas;
    }

    function getCuadros_por_segundo() {
        return $this->cuadros_por_segundo;
    }

    function getResolucion() {
        return $this->resolucion;
    }

    function getCalidad() {
        return $this->calidad;
    }

    function getNombre_punto_bcr() {
        return $this->nombre_punto_bcr;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getArranque_automatico() {
        return $this->arranque_automatico;
    }

    function setId_unidad_video($id_unidad_video) {
        $this->id_unidad_video = $id_unidad_video;
    }

    function setId_punto_bcr($id_punto_bcr) {
        $this->id_punto_bcr = $id_punto_bcr;
    }

    function setObj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPromedio_dias($promedio_dias) {
        $this->promedio_dias = $promedio_dias;
    }

    function setCapacidad_disco_duro($capacidad_disco_duro) {
        $this->capacidad_disco_duro = $capacidad_disco_duro;
    }

    function setVersion_software($version_software) {
        $this->version_software = $version_software;
    }

    function setMac_address($mac_address) {
        $this->mac_address = $mac_address;
    }

    function setSerie($serie) {
        $this->serie = $serie;
    }

    function setRegulacion($regulacion) {
        $this->regulacion = $regulacion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCantidad_entradas_video($cantidad_entradas_video) {
        $this->cantidad_entradas_video = $cantidad_entradas_video;
    }

    function setCamaras_habilitadas($camaras_habilitadas) {
        $this->camaras_habilitadas = $camaras_habilitadas;
    }

    function setCuadros_por_segundo($cuadros_por_segundo) {
        $this->cuadros_por_segundo = $cuadros_por_segundo;
    }

    function setResolucion($resolucion) {
        $this->resolucion = $resolucion;
    }

    function setCalidad($calidad) {
        $this->calidad = $calidad;
    }

    function setNombre_punto_bcr($nombre_punto_bcr) {
        $this->nombre_punto_bcr = $nombre_punto_bcr;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setArranque_automatico($arranque_automatico) {
        $this->arranque_automatico = $arranque_automatico;
    }

    public function __construct() {
        $this->id_punto_bcr="";
        $this->id_unidad_video="";
        $this->obj_data_provider=new Data_Provider();
        $this->condicion="";
        $this->arreglo;
        $this->descripcion="";
        $this->promedio_dias="";
        $this->capacidad_disco_duro="";
        $this->version_software="";
        $this->mac_address="";
        $this->serie="";
        $this->observaciones="";
        $this->estado="";
        $this->regulacion="";
        $this->cantidad_entradas_video="";
        $this->camaras_habilitadas="";
        $this->cuadros_por_segundo="";
        $this->resolucion="";
        $this->calidad="";
        $this->nombre_punto_bcr="";
        $this->arranque_automatico="";
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
        } else {
            return false;
        }    
    }
    
    public function obtiene_todas_las_unidades_de_video(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "t_unidadvideo 
                    left join t_puntoBCR on t_unidadvideo.ID_PuntoBCR=t_puntoBCR.ID_PuntoBCR 
                    left join t_distrito on t_puntoBCR.ID_distrito=t_distrito.ID_distrito
                    left join t_canton on t_distrito.ID_canton=t_canton.ID_canton
                    left join t_provincia on t_canton.ID_provincia=t_provincia.ID_provincia
                    left join T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto", 
                "*,t_Provincia.Nombre_Provincia,t_unidadvideo.Estado as Estad,t_unidadvideo.Observaciones as Obser,t_puntoBCR.Nombre,T_TipoPuntoBCR.Tipo_Punto",
                "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        } else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "t_unidadvideo 
                left join t_puntoBCR on t_unidadvideo.ID_PuntoBCR=t_puntoBCR.ID_PuntoBCR 
                left join t_distrito on t_puntoBCR.ID_distrito=t_distrito.ID_distrito
                left join t_canton on t_distrito.ID_canton=t_canton.ID_canton
                left join t_provincia on t_canton.ID_provincia=t_provincia.ID_provincia
                left join T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto", 
                "*,t_Provincia.Nombre_Provincia,t_unidadvideo.Estado as Estad,t_unidadvideo.Observaciones as Obser,t_puntoBCR.Nombre,T_TipoPuntoBCR.Tipo_Punto",
                $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        } 
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
        } else{
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
    
   
}?>