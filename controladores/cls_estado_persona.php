<?php

class cls_estado_persona {
    public $id;
    public $estado_persona;
    public $descripcion;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    
    function getId() {
        return $this->id;
    }

    function getEstado_persona() {
        return $this->estado_persona;
    }

    function getDescripcion() {
        return $this->descripcion;
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

    function setId($id) {
        $this->id = $id;
    }

    function setEstado_persona($estado_persona) {
        $this->estado_persona = $estado_persona;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
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

        
    public function __construct() {
        $this->id="";
        $this->estado_persona="";
        $this->descripcion="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }
    
    public function obtener_todos_estados_personas(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_EstadoPersona", "*", "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_EstadoPersona", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
}
