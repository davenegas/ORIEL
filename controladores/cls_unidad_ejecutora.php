<?php
 class cls_unidad_ejecutora{
    public $id;
    public $id2;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    public $estado;
    public $observaciones;
    public $departamento;
    public $numero_ue; 
    
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

    function getEstado() {
        return $this->estado;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getDepartamento() {
        return $this->departamento;
    }

    function getNumero_ue() {
        return $this->numero_ue;
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

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    function setNumero_ue($numero_ue) {
        $this->numero_ue = $numero_ue;
    }

    public function __construct() {
        $this->id="";
        $this->id2="";
        $this->condicion="";
        $this->arreglo;
        $this->obj_data_provider=new Data_Provider();
        $this->observaciones="";
        $this->estado="";
        $this->departamento="";
        $this->numero_ue=""; 
    }
    
    public function obtener_unidades_ejecutoras() {
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_UnidadEjecutora", 
                    "*",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_UnidadEjecutora", 
                    "*",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function agregar_puntobcr_ue(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_UE_PuntoBCR", "ID_PuntoBCR, ID_Unidad_Ejecutora", "'".$this->id2."','".$this->id."'");
        $this->obj_data_provider->desconectar();
    }
    public function eliminar_relacion_puntobcr_ue(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("T_UE_PuntoBCR", "ID_PuntoBCR='".$this->id2."' AND ID_Unidad_Ejecutora='".$this->id."'");
        $this->obj_data_provider->desconectar();
    }
   
 }?>