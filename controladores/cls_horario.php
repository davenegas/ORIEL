<?php

class cls_horario{
    
    private $id;
    private $descripcion;
    private $estado;
    private $dias_laborados;
    private $horas_laboradas;
    private $arreglo;
    private $obj_data_provider;
    private $condicion;
    private $resultado_operacion;

    function getId() {
        return $this->id;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getDias_laborados() {
        return $this->dias_laborados;
    }

    function getHoras_laboradas() {
        return $this->horas_laboradas;
    }

    function getArreglo() {
        return $this->arreglo;
    }

    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function getResultado_operacion() {
        return $this->resultado_operacion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setDias_laborados($dias_laborados) {
        $this->dias_laborados = $dias_laborados;
    }

    function setHoras_laboradas($horas_laboradas) {
        $this->horas_laboradas = $horas_laboradas;
    }

    function setArreglo_modulos($arreglo_modulos) {
        $this->arreglo_modulos = $arreglo_modulos;
    }

    function setObj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    function setResultado_operacion($resultado_operacion) {
        $this->resultado_operacion = $resultado_operacion;
    }

        
    public function __construct() {
      $this->id="";
      $this->descripcion="";
      $this->estado="";
      $this->dias_laborados="";
      $this->horas_laboradas="";
      $this->arreglo;
      $this->obj_data_provider=new Data_Provider();
      $this->condicion="";
    }
    
    public function obtiene_todos_los_horarios(){
       $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_Horario", 
                    "*",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_TipoPuntoBCR", 
                    "*",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  
    }
    
}