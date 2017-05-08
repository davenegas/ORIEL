<?php

class cls_horario_usuario{
    
    private $id;
    private $id2;
    private $descripcion;
    private $observaciones;
    private $estado;
    private $arreglo;
    private $obj_data_provider;
    private $condicion;
    private $resultado_operacion;
    private $fecha_inicio;
    private $fecha_final;
    private $hora_entrada_domingo;
    private $hora_salida_domingo;
    private $hora_entrada_lunes;
    private $hora_salida_lunes;
    private $hora_entrada_martes;
    private $hora_salida_martes;
    private $hora_entrada_miercoles;
    private $hora_salida_miercoles;
    private $hora_entrada_jueves;
    private $hora_salida_jueves;
    private $hora_entrada_viernes;
    private $hora_salida_viernes;
    private $hora_entrada_sabado;
    private $hora_salida_sabado;
    private $tipo_horario;

    function getId() {
        return $this->id;
    }

    function getId2() {
        return $this->id2;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getEstado() {
        return $this->estado;
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

    function getFecha_inicio() {
        return $this->fecha_inicio;
    }

    function getFecha_final() {
        return $this->fecha_final;
    }

    function getHora_entrada_domingo() {
        return $this->hora_entrada_domingo;
    }

    function getHora_salida_domingo() {
        return $this->hora_salida_domingo;
    }

    function getHora_entrada_lunes() {
        return $this->hora_entrada_lunes;
    }

    function getHora_salida_lunes() {
        return $this->hora_salida_lunes;
    }

    function getHora_entrada_martes() {
        return $this->hora_entrada_martes;
    }

    function getHora_salida_martes() {
        return $this->hora_salida_martes;
    }

    function getHora_entrada_miercoles() {
        return $this->hora_entrada_miercoles;
    }

    function getHora_salida_miercoles() {
        return $this->hora_salida_miercoles;
    }

    function getHora_entrada_jueves() {
        return $this->hora_entrada_jueves;
    }

    function getHora_salida_jueves() {
        return $this->hora_salida_jueves;
    }

    function getHora_entrada_viernes() {
        return $this->hora_entrada_viernes;
    }

    function getHora_salida_viernes() {
        return $this->hora_salida_viernes;
    }

    function getHora_entrada_sabado() {
        return $this->hora_entrada_sabado;
    }

    function getHora_salida_sabado() {
        return $this->hora_salida_sabado;
    }

    function getTipo_horario() {
        return $this->tipo_horario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId2($id2) {
        $this->id2 = $id2;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
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

    function setFecha_inicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }

    function setFecha_final($fecha_final) {
        $this->fecha_final = $fecha_final;
    }

    function setHora_entrada_domingo($hora_entrada_domingo) {
        $this->hora_entrada_domingo = $hora_entrada_domingo;
    }

    function setHora_salida_domingo($hora_salida_domingo) {
        $this->hora_salida_domingo = $hora_salida_domingo;
    }

    function setHora_entrada_lunes($hora_entrada_lunes) {
        $this->hora_entrada_lunes = $hora_entrada_lunes;
    }

    function setHora_salida_lunes($hora_salida_lunes) {
        $this->hora_salida_lunes = $hora_salida_lunes;
    }

    function setHora_entrada_martes($hora_entrada_martes) {
        $this->hora_entrada_martes = $hora_entrada_martes;
    }

    function setHora_salida_martes($hora_salida_martes) {
        $this->hora_salida_martes = $hora_salida_martes;
    }

    function setHora_entrada_miercoles($hora_entrada_miercoles) {
        $this->hora_entrada_miercoles = $hora_entrada_miercoles;
    }

    function setHora_salida_miercoles($hora_salida_miercoles) {
        $this->hora_salida_miercoles = $hora_salida_miercoles;
    }

    function setHora_entrada_jueves($hora_entrada_jueves) {
        $this->hora_entrada_jueves = $hora_entrada_jueves;
    }

    function setHora_salida_jueves($hora_salida_jueves) {
        $this->hora_salida_jueves = $hora_salida_jueves;
    }

    function setHora_entrada_viernes($hora_entrada_viernes) {
        $this->hora_entrada_viernes = $hora_entrada_viernes;
    }

    function setHora_salida_viernes($hora_salida_viernes) {
        $this->hora_salida_viernes = $hora_salida_viernes;
    }

    function setHora_entrada_sabado($hora_entrada_sabado) {
        $this->hora_entrada_sabado = $hora_entrada_sabado;
    }

    function setHora_salida_sabado($hora_salida_sabado) {
        $this->hora_salida_sabado = $hora_salida_sabado;
    }

    function setTipo_horario($tipo_horario) {
        $this->tipo_horario = $tipo_horario;
    }

      
    public function __construct() {
        $this->id="";
        $this->id2="";
        $this->descripcion="";
        $this->observaciones="";
        $this->estado="";
        $this->arreglo;
        $this->obj_data_provider=new Data_Provider();
        $this->condicion="";
        $this->resultado_operacion="";
        $this->fecha_inicio="";
        $this->fecha_final="";
        $this->hora_entrada_domingo="";
        $this->hora_salida_domingo="";
        $this->hora_entrada_lunes="";
        $this->hora_salida_lunes="";
        $this->hora_entrada_martes="";
        $this->hora_salida_martes="";
        $this->hora_entrada_miercoles="";
        $this->hora_salida_miercoles="";
        $this->hora_entrada_jueves="";
        $this->hora_salida_jueves="";
        $this->hora_entrada_viernes="";
        $this->hora_salida_viernes="";
        $this->hora_entrada_sabado="";
        $this->hora_salida_sabado="";
        $this->tipo_horario="";
    }
    
    ///////////FUNCIONES PARA HORARIO USUARIOS//////////////////
    public function obtener_horarios(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("T_HorarioUsuario", 
                    "*", 
                    "");
        }else{
            $this->arreglo=$this->obj_data_provider->trae_datos("T_HorarioUsuario", 
                    "*",
                    $this->condicion);
        }
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true; 
    }
    public function agregar_horario(){
        $this->obj_data_provider->conectar();
        $this->arreglo= $this->obj_data_provider->inserta_datos("T_HorarioUsuario", "ID_Usuario, Fecha_Inicio, Fecha_Final, Hora_Entrada_Domingo, Hora_Salida_Domingo, Hora_Entrada_Lunes, Hora_Salida_Lunes, Hora_Entrada_Martes, Hora_Salida_Martes,Hora_Entrada_Miercoles, Hora_Salida_Miercoles, "
                . "Hora_Entrada_Jueves, Hora_Salida_Jueves, Hora_Entrada_Viernes, Hora_Salida_Viernes, Hora_Entrada_Sabado, Hora_Salida_Sabado, Tipo_Horario, Observaciones, Estado",
                        "'".$this->id."','".$this->fecha_inicio."','".$this->fecha_final."','".$this->hora_entrada_domingo."','".$this->hora_salida_domingo."','".$this->hora_entrada_lunes."','".$this->hora_salida_lunes."','".$this->hora_entrada_martes."','".$this->hora_salida_martes."','".$this->hora_entrada_miercoles."','".$this->hora_salida_miercoles."','"
                .$this->hora_salida_jueves."','".$this->hora_salida_jueves."','".$this->hora_entrada_viernes."','".$this->hora_salida_viernes."','".$this->hora_entrada_sabado."','".$this->hora_salida_sabado."','".$this->tipo_horario."','".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}