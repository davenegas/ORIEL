<?php
class cls_areasapoyo{
    public $id;
    public $id2;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    public $nombre_area;
    public $direccion;
    public $observaciones;
    public $tipo_area;
    public $estado;
    public $detalle;
    
    function getId() {
        return $this->id;
    }

    function getId2() {
        return $this->id2;
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

    function getNombre_area() {
        return $this->nombre_area;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getTipo_area() {
        return $this->tipo_area;
    }

    function getEstado() {
        return $this->estado;
    }

    function getDetalle() {
        return $this->detalle;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId2($id2) {
        $this->id2 = $id2;
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

    function setNombre_area($nombre_area) {
        $this->nombre_area = $nombre_area;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setTipo_area($tipo_area) {
        $this->tipo_area = $tipo_area;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    public function __construct() {
        $this->id="";
        $this->id2="";
        $this->condicion="";
        $this->arreglo;
        $this->obj_data_provider=new Data_Provider();
        $this->nombre_area="";
        $this->direccion="";
        $this->observaciones="";
        $this->tipo_area="";
        $this->estado="";
        $this->detalle="";
        ;
    }
    public function obtiene_todos_las_areas_apoyo(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_AreasApoyo
                        LEFT OUTER JOIN T_TipoAreaApoyo ON T_AreasApoyo.ID_Tipo_Area_Apoyo= T_TipoAreaApoyo.ID_Tipo_Area_Apoyo
                        LEFT OUTER JOIN T_Distrito ON T_AreasApoyo.ID_Distrito = T_Distrito.ID_Distrito", 
                    "T_AreasApoyo.ID_Area_Apoyo, T_AreasApoyo.Nombre_Area, T_AreasApoyo.Direccion,
			T_AreasApoyo.Observaciones, T_AreasApoyo.Estado,
			T_TipoAreaApoyo.ID_Tipo_Area_Apoyo, T_TipoAreaApoyo.Nombre_Tipo_Area,
			T_Distrito.ID_Distrito,T_Distrito.Nombre_Distrito",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_AreasApoyo
                        LEFT OUTER JOIN T_TipoAreaApoyo ON T_AreasApoyo.ID_Tipo_Area_Apoyo= T_TipoAreaApoyo.ID_Tipo_Area_Apoyo
                        LEFT OUTER JOIN T_Distrito ON T_AreasApoyo.ID_Distrito = T_Distrito.ID_Distrito", 
                    "T_AreasApoyo.ID_Area_Apoyo, T_AreasApoyo.Nombre_Area, T_AreasApoyo.Direccion,
			T_AreasApoyo.Observaciones, T_AreasApoyo.Estado,
			T_TipoAreaApoyo.ID_Tipo_Area_Apoyo, T_TipoAreaApoyo.Nombre_Tipo_Area,
			T_Distrito.ID_Distrito,T_Distrito.Nombre_Distrito",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
}?>
